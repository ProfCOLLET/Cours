<?php

session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Rediriger vers la page de connexion
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page d'administration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Page d'administration</h1>
    <p> <a href="index.php"> Retour au site </a> </p>

    <h2>Listes actuelles</h2>

    <?php
    $dataPath = 'data/'; // Chemin vers le dossier contenant les fichiers

    // Récupérer la liste des fichiers dans le dossier
    $files = glob($dataPath . '*.txt');

   /* if (empty($files)) {
        echo '<p>Aucune liste trouvée.</p>';
    } else {
        echo '<ul>';
        foreach ($files as $file) {
            $listName = basename($file, '.txt');
            echo '<li>' . $listName . '</li>';
        }
        echo '</ul>';
    }
*/
    if (empty($files)) {
        echo '<p>Aucune liste trouvée.</p>';
    } else {
        echo '<ul>';
        foreach ($files as $file) {
            $listName = basename($file, '.txt');
            echo '<li><h2>' . $listName . '</h2></li>';
            echo ' <a href="edit.php?list=' . $listName . '">Modifier</a>';
    
            // Lire le contenu du fichier
            $content = file_get_contents($file);
            $items = explode("\n", $content);
    
            // Afficher le contenu du fichier sous forme de tableau
            echo '<div class="table-container">';
            echo '<table>';
            echo '<tr><th>Contenu de la liste</th></tr>';
            foreach ($items as $item) {
                echo '<tr><td>' . $item . '</td></tr>';
            }
            echo '</table></div></br>';
        }
        echo '</ul>';
    }
    
    
    ?>

</body>
</html>
