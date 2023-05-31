<?php
// Fonction pour lire les éléments d'une liste à partir d'un fichier CSV
function readList($listName) {
    $listFile = 'data/' . $listName . '.csv';
    if (file_exists($listFile)) {
        return file($listFile, FILE_IGNORE_NEW_LINES);
    }
    return [];
}

// Lire les listes depuis les fichiers CSV
$names = readList('names');
$places = readList('places');
$actions = readList('actions');

// Générer une action aléatoire
$randomName = $names[array_rand($names)];
$randomPlace = $places[array_rand($places)];
$randomAction = $actions[array_rand($actions)];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jeu de plateau JDR</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Jeu de plateau JDR</h1>

    <div id="action-container">
        <h2>Action aléatoire :</h2>
        <p id="random-action"><?php echo $randomName; ?> <?php echo $randomAction; ?> <?php echo $randomPlace; ?></p>
        <button id="generate-button">Générer</button>
    </div>

    <script src="script.js"></script>
</body>
</html>
