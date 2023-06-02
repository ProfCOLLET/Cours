<?php

session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Rediriger vers la page de connexion
    header('Location: login.php');
    exit;
}


// Vérifier si les paramètres GET sont définis
if (isset($_GET['list']) && $_GET['list'] !== '') {
    // Récupérer le nom de la liste à partir des paramètres GET
    $listName = $_GET['list'];

    // Vérifier si le fichier de la liste existe
    $listFile = 'data/' . $listName . '.txt';
    if (file_exists($listFile)) {
        // Lire le contenu actuel du fichier
        $listContent = file_get_contents($listFile);
    } else {
        // Le fichier de la liste n'existe pas, afficher un message d'erreur
        echo '<p>La liste spécifiée n\'existe pas.</p>';
        exit;
    }
} else {
    // Les paramètres GET ne sont pas définis, afficher un message d'erreur
    echo '<p>Liste non spécifiée.</p>';
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_POST['content']) && $_POST['content'] !== '') {
        // Récupérer le nouveau contenu de la liste à partir du champ de formulaire
        $newContent = $_POST['content'];

        // Écrire le nouveau contenu dans le fichier de la liste
        file_put_contents($listFile, $newContent);

        // Rediriger vers la page d'administration ou afficher un message de succès
        header('Location: admin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier la liste <?php echo $listName; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Modifier la liste <?php echo $listName; ?></h1>

    <form action="edit.php?list=<?php echo $listName; ?>" method="POST">
        <label for="content">Contenu :</label>
        <textarea id="content" name="content" rows="10" required><?php echo $listContent; ?></textarea>
        <br>
        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>
