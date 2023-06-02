<?php

// Fonction pour lire les éléments d'une liste à partir d'un fichier CSV
function readCSV($listName) {
    $listFile = './data/' . $listName . '.txt';
    
return file($listFile, FILE_IGNORE_NEW_LINES);
    }

// Partie génération

$alea = rand(1, 200);



$totalPossible1 =count(readCSV("alea1"))*count(readCSV("alea2"))*count(readCSV("alea3"))*count(readCSV("alea4"))*count(readCSV("alea5"));
$totalPossible2 =count(readCSV("RP1"))*count(readCSV("RP2"))*count(readCSV("RP3"))*count(readCSV("RP4"))*count(readCSV("RP5"));
$totalPossible3 =count(readCSV("l1"))*count(readCSV("l2"))*count(readCSV("l3"))*count(readCSV("l4"))*count(readCSV("l5"));

$totalPossible = $totalPossible1+$totalPossible2+$totalPossible3;

if ($alea >= 199){

 // Partie Attentat

 // Lire les fichiers CSV des listes
$names = readCSV("alea1");
$places = readCSV("alea2");
$actions = readCSV("alea3");
$l4=readCSV("alea4");
$l5=readCSV("alea5");

// Générer une action aléatoire seulement si les listes ne sont pas vides et sont activées
if (!empty($names) && !empty($places) && !empty($actions)) {
    $randomName = $names[array_rand($names)];
    $randomPlace = $places[array_rand($places)];
    $randomAction = $actions[array_rand($actions)];
    $randomL4 = $l4[array_rand($l4)];
    $randomL5 = $l5[array_rand($l5)];
} else {
    $randomName = 'Error, contactez Dieu...';
    $randomPlace = 'Error, contactez Dieu...';
    $randomAction = 'Error, contactez Dieu...';
    $randomL4= 'Error, contactez Dieu...';
    $randomL5= 'Error, contactez Dieu...';
}

}

elseif($alea <= 21){

// partie RP

// Lire les fichiers CSV des listes
$names = readCSV("RP1");
$places = readCSV("RP2");
$actions = readCSV("RP3");
$l4=readCSV("RP4");
$l5=readCSV("RP5");

// Générer une action aléatoire seulement si les listes ne sont pas vides et sont activées
if (!empty($names) && !empty($places) && !empty($actions)) {
    $randomName = $names[array_rand($names)];
    $randomPlace = $places[array_rand($places)];
    $randomAction = $actions[array_rand($actions)];
    $randomL4 = $l4[array_rand($l4)];
    $randomL5 = $l5[array_rand($l5)];
} else {
    $randomName = 'Error, contactez Dieu...';
    $randomPlace = 'Error, contactez Dieu...';
    $randomAction = 'Error, contactez Dieu...';
    $randomL4= 'Error, contactez Dieu...';
    $randomL5= 'Error, contactez Dieu...';
}

}


else {
  


// Lire les fichiers CSV des listes
$names = readCSV("l1");
$places = readCSV("l2");
$actions = readCSV("l3");
$l4=readCSV("l4");
$l5=readCSV("l5");

// Générer une action aléatoire seulement si les listes ne sont pas vides et sont activées
if (!empty($names) && !empty($places) && !empty($actions)) {
    $randomName = $names[array_rand($names)];
    $randomPlace = $places[array_rand($places)];
    $randomAction = $actions[array_rand($actions)];
    $randomL4 = $l4[array_rand($l4)];
    $randomL5 = $l5[array_rand($l5)];
} else {
    $randomName = 'Error, contactez Dieu...';
    $randomPlace = 'Error, contactez Dieu...';
    $randomAction = 'Error, contactez Dieu...';
    $randomL4= 'Error, contactez Dieu...';
    $randomL5= 'Error, contactez Dieu...';
}

}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDR - Générateur</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>

</head>
<body>
    <div id="action-container">
        
        <h1>Générateur de scénario aléatoire</h1>
        
        <p id="random-action">
            <?php echo '<h3>'.$randomName . '</h2> </br> ' . $randomPlace . '</br></br> ' . $randomAction . ' </br></br>' . $randomL4 . ' </br></br>' . $randomL5 . '</br>'; ?>
        </p>
<br/>
        <button id="generate-button" onclick="document.location.reload(false)"> Générer une nouvelle fois </button>
        <br/><br/>
        <p> Pour un total de <?php echo $totalPossible; ?> possibilités. </p><br/>
    

    <a href="admin.php">Cliquer ici pour modifier les listes</a>
    
    </div>

</body>
</html>
