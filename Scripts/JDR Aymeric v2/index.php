<?php

// Fonction pour lire les éléments d'une liste à partir d'un fichier CSV
function lectureTXT($listName) {
    $listFile = './data/' . $listName . '.txt';
    
return file($listFile, FILE_IGNORE_NEW_LINES);
    }

// Partie génération

$alea = random_int(1, 200);



$totalPossible1 =count(lectureTXT("alea1"))*count(lectureTXT("alea2"))*count(lectureTXT("alea3"))*count(lectureTXT("alea4"))*count(lectureTXT("alea5"));
$totalPossible2 =count(lectureTXT("RP1"))*count(lectureTXT("RP2"))*count(lectureTXT("RP3"))*count(lectureTXT("RP4"))*count(lectureTXT("RP5"));
$totalPossible3 =count(lectureTXT("l1"))*count(lectureTXT("l2"))*count(lectureTXT("l3"))*count(lectureTXT("l4"))*count(lectureTXT("l5"));

$totalPossible = $totalPossible1+$totalPossible2+$totalPossible3;

if ($alea >= 200){

 // Partie Attentat 0.5% de proba

 // Lire les fichiers CSV des listes
$titre = lectureTXT("alea1");
$Ligne1 = lectureTXT("alea2");
$Ligne2 = lectureTXT("alea3");
$Ligne3=lectureTXT("alea4");
$Ligne4=lectureTXT("alea5");

// Générer une action aléatoire seulement si les listes ne sont pas vides et sont activées
if (!empty($titre) && !empty($Ligne1) && !empty($Ligne2)) {
    $titreRandom = $titre[array_rand($titre)];
    $Ligne1Random = $Ligne1[array_rand($Ligne1)];
    $Ligne2Random = $Ligne2[array_rand($Ligne2)];
    $Ligne3Random = $Ligne3[array_rand($Ligne3)];
    $Ligne4Random = $Ligne4[array_rand($Ligne4)];
} else {
    $titreRandom = 'Error, contactez Dieu...';
    $Ligne1Random = 'Error, contactez Dieu...';
    $Ligne2Random = 'Error, contactez Dieu...';
    $Ligne3Random= 'Error, contactez Dieu...';
    $Ligne4Random= 'Error, contactez Dieu...';
}

}

elseif($alea <= 21){

// partie RP 10% de proba

// Lire les fichiers CSV des listes
$titre = lectureTXT("RP1");
$Ligne1 = lectureTXT("RP2");
$Ligne2 = lectureTXT("RP3");
$Ligne3=lectureTXT("RP4");
$Ligne4=lectureTXT("RP5");

// Générer une action aléatoire seulement si les listes ne sont pas vides et sont activées
if (!empty($titre) && !empty($Ligne1) && !empty($Ligne2)) {
    $titreRandom = $titre[array_rand($titre)];
    $Ligne1Random = $Ligne1[array_rand($Ligne1)];
    $Ligne2Random = $Ligne2[array_rand($Ligne2)];
    $Ligne3Random = $Ligne3[array_rand($Ligne3)];
    $Ligne4Random = $Ligne4[array_rand($Ligne4)];
} else {
    $titreRandom = 'Error, contactez Dieu...';
    $Ligne1Random = 'Error, contactez Dieu...';
    $Ligne2Random = 'Error, contactez Dieu...';
    $Ligne3Random= 'Error, contactez Dieu...';
    $Ligne4Random= 'Error, contactez Dieu...';
}

}


else {
  


// Lire les fichiers CSV des listes
$titre = lectureTXT("l1");
$Ligne1 = lectureTXT("l2");
$Ligne2 = lectureTXT("l3");
$Ligne3=lectureTXT("l4");
$Ligne4=lectureTXT("l5");

// Générer une action aléatoire seulement si les listes ne sont pas vides et sont activées
if (!empty($titre) && !empty($Ligne1) && !empty($Ligne2)) {
    $titreRandom = $titre[array_rand($titre)];
    $Ligne1Random = $Ligne1[array_rand($Ligne1)];
    $Ligne2Random = $Ligne2[array_rand($Ligne2)];
    $Ligne3Random = $Ligne3[array_rand($Ligne3)];
    $Ligne4Random = $Ligne4[array_rand($Ligne4)];
} else {
    $titreRandom = 'Error, contactez Dieu...';
    $Ligne1Random = 'Error, contactez Dieu...';
    $Ligne2Random = 'Error, contactez Dieu...';
    $Ligne3Random= 'Error, contactez Dieu...';
    $Ligne4Random= 'Error, contactez Dieu...';
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
        
        <div id="random-action">
            <?php echo '<h2>'.$titreRandom . '</h2> </br> ' . $Ligne1Random . '</br></br> ' . $Ligne2Random . ' </br></br>' . $Ligne3Random . ' </br></br>' . $Ligne4Random . '</br></br>'; ?>
</div>
<br/>
       
        <button class="btn" onclick="document.location.reload(false)" >Générer un événement <img src="https://img.uxwing.com/wp-content/themes/uxwing/download/sport-awards/dice-game-icon.png" style="width:25px; margin-left:3px; margin-right:4px; flex-direction: row-reverse;"></button>
        <br/><br/>
        <p> Pour un total de <?php echo $totalPossible; ?> possibilités. </p><br/>
    

    <a href="admin.php">Cliquer ici pour modifier les listes</a>
    
    </div>

</body>
</html>
