<?php
/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2018 TwelveTone LLC
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Grav\Plugin;

use Grav\Common\Grav;
use Grav\Common\Page\Media;
use Grav\Common\Plugin;
use Grav\Common\Utils;

include_once 'classes/DialogUtil.php';

function array_get($arr, $key, $default = null)
{
    if (!isset($arr[$key])) {
        if ($default === null) {
            throw new \Exception("A key is missing: " . $key);
        } else {
            return $default;
        }
    }
    return $arr[$key];
}

/**
 * Class AdminMediaReplacePlugin
 * @package Grav\Plugin
 */
class AdminMediaReplacePlugin extends Plugin
{

    const ROUTE = '/admin-media-replace';

    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    public function onPluginsInitialized()
    {
        if (!$this->isAdmin() || !$this->grav['user']->authenticated) {
            return;
        }

        if (!self::_checkDependencies($this)) {
            return;
        }

        $this->enable([
            'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'onTwigExtensions' => ['onTwigExtensions', -1],
            'onPageNotFound' => ['onPageNotFound', 1],
        ]);

        $this->grav['media-actions']->addAction([
            'actionId' => "MediaReplace",
            'caption' => "Replace",
            'icon' => "exchange",
            'handler' => function ($page, $mediaName, $payload) {
                $ret = [
                    "error" => false
                ];
                return $ret;
            }
        ]);
    }

    public function onPageNotFound($e)
    {
        if (!$this->isAdmin()) {
            return;
        }

        $route = $this->grav['admin']->location . "/" . $this->grav['admin']->route;
        switch ($route) {
            case "admin-media-replace/replace":
                try {
                    $filename = array_get($_POST, "media-new-filename");
                    $route = array_get($_POST, "media-route");
                    $media = array_get($_POST, "media-filename");

                    $media_rename = array_get($_POST, "media-rename", "1") === "1";
                    $require_image = array_get($_POST, "media-require-image", "1") === "1";
                    $match_extension = array_get($_POST, "media-match-extension", "1") === "1";

                    $page = $this->grav['pages']->find($route);
                    if (!$page) {
                        throw new \Exception("Page not found.");
                    }
                    $mediaPath = $page->path() . "/" . $media;
                    if (!is_file($mediaPath)) {
                        throw new \Exception("Media not found.");
                    }

                    $tmp_name = $_FILES['mediaupload']['tmp_name'];

                    if ($match_extension) {
                        if (basename($filename) !== basename($media)) {
                            throw new \Exception("Media extensions do not match.");
                        }
                    }

                    if ($require_image) {
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mime = finfo_file($finfo, $_FILES['mediaupload']['tmp_name']);
                        finfo_close($finfo);
                        if (!Utils::startsWith($mime, "image/")) {
                            throw new \Exception("Media must be an image.");
                        }
                    }

                    if ($media_rename) {
                        // overwrite current file
                        $finalName = basename($mediaPath);
                    } else {
                        // delete current file
                        unlink($page->path() . '/' . $media);
                        $finalName = basename($filename);
                    }

                    move_uploaded_file($tmp_name, $page->path() . '/' . $finalName);
                    //$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                    // basename() may prevent filesystem traversal attacks;
                    // further validation/sanitation of the filename may be appropriate
                    //$name = basename($_FILES["pictures"]["name"][$key]);

                    $media1 = new Media($page->path());
                    $medium = $media1[basename($finalName)];
                    $url = $medium->display($medium->get('extension') === 'svg' ? 'source' : 'thumbnail')->cropZoom(400, 300)->url();

                    $ret = ["thumbnail" => $url];
                    $ret['newName'] = $finalName;
//                    if (!$media_rename) {
//                        $ret['toast'] = "Refresh the page to update the new page media name.";
//                    }
                    die(json_encode($ret));

                    // Get original name
                    //$source = $medium->higherQualityAlternative()->get('filename');
                    //$media_list[$name] = ['url' => $medium->display($medium->get('extension') === 'svg' ? 'source' : 'thumbnail')->cropZoom(400, 300)->url(), 'size' => $medium->get('size'), 'metadata' => $metadata, 'original' => $source->get('filename')];

                } catch
                (\Exception $exception) {
//                    die(print_r($_SERVER));
                    die(json_encode(["error" => $exception->getMessage()]));
                }
                break;
        }
    }

    public
    function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public
    function onTwigInitialized()
    {
        $this->grav['assets']->addJs('plugin://admin-media-replace/assets/dialog_util.js', -1000, false);
        $this->grav['assets']->addJs('plugin://admin-media-replace/assets/media_replace_action.js', -1000, false);
        if ($this->config->get("plugins.admin-media-replace.quicksend", false)) {
            $this->grav['assets']->addInlineJs("const _media_replace_isQuicksend = true;");
        }
    }

    public
    function onTwigExtensions()
    {
        if (!$this->isAdmin()) {
            return;
        }
        addModalForm("MediaReplace", "generic-modal.twig.html");
    }

    public
    function onAdminTwigTemplatePaths($event)
    {
        $event['paths'] = array_merge($event['paths'], [__DIR__ . '/templates']);
        return $event;
    }

    public
    function outputError($msg)
    {
        header('HTTP/1.1 400 Bad Request');
        die(json_encode(['error' => ['msg' => $msg]]));
    }

    /**
     * Checks plugin dependencies.  Call this after all plugins have been loaded and are enabled.
     *
     * @param $plugin
     * @param $issues array Receives issues as strings.  If null, grav['messages'] is used.
     * @return bool true if dependencies are met.
     */
    public static function _checkDependencies($plugin, &$issues = null)
    {
        $grav = Grav::instance();
        $errors = 0;
        $messages = $grav['messages'];
        $plugins = $grav['plugins'];

        $deps = $plugin->getBlueprint()->dependencies;
        if ($deps) {
            foreach ($deps as $dep) {
                $name = $dep['name'];
                if ($name === 'grav') {
                    //TODO check grav version
                    continue;
                }
                $version = $dep['version'];
                if (!preg_match("#^([<>=]+)?(.*)#", $version, $m)) {
                    continue;
                }
                $compare = $m[1];
                $version = $m[2];
                if (!$compare) {
                    $compare = '=';
                }

                $found = $plugins->get($name);
                if (!$found) {
                    $msg = "Missing Dependency: '$name'";
                    if (is_array($issues)) {
                        $issues[] = $msg;
                    } else {
                        $messages->add($msg, 'error');
                    }
                    $errors++;
                    continue;
                }
                if (!$grav['config']->get("plugins.$name.enabled")) {
                    //BUG admin should always be enabled if installed
                    if ($name !== 'admin') {
                        $msg = "Dependency Not Enabled: '$name'";
                        if (is_array($issues)) {
                            $issues[] = $msg;
                        } else {
                            $messages->add($msg, 'error');
                        }
                        $errors++;
                        continue;
                    }
                }
                $realVersion = $found->blueprints()->version;
                if (!version_compare($realVersion, $version, $compare)) {
                    $msg = "Missing Dependency: '$name' $version";
                    if (is_array($issues)) {
                        $issues[] = $msg;
                    } else {
                        $messages->add($msg, 'error');
                    }
                    $errors++;
                    continue;
                }
            }
        }
        if ($errors > 0) {
            $msg = "Plugin '$plugin->name' was not loaded due to dependency issues";
            if (is_array($issues)) {
                $issues[] = $msg;
            } else {
                $messages->add($msg, 'error');
            }
        }
        return $errors === 0;
    }


}
