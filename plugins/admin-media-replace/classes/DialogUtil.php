<?php

// Do not call until Grav 'twig' is initialized and the base twig extensions are loaded.
function addModalForm($jsid, $twigName)
{
    //TODO parametize
    $bpNewPage = new \Grav\Common\Data\Blueprint("media-replace.yaml");
    $bpNewPage->setContext(__DIR__ . "/../blueprints");
    $bpNewPage = $bpNewPage->load()->init();

    $params = [];
    $params["remodalId"] = $jsid;
    $params["fields"] = $bpNewPage->toArray()['form']['fields'];

    $grav = \Grav\Common\Grav::instance();
    $rendered = $grav['twig']->twig()->render($twigName, $params);
    $arr = [
        'MODAL' => $rendered
    ];

    $grav['assets']->addInlineJs("var $jsid = " . json_encode($arr) . ';', -1000, false);

    $modalReg = "
    $(function () {
        $('body').append($jsid.MODAL);
    });";
    $grav['assets']->addInlineJs($modalReg, -999, false);

}