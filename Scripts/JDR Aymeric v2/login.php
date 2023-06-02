<?php
session_start();

// Durée de validité de la session en secondes (10 minutes)
$sessionLifetime = 600;

// Définir la durée de vie du cookie de session
session_set_cookie_params($sessionLifetime);

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true && isset($_SESSION['last_activity'])) {
    // Vérifier si la session est toujours valide en fonction du dernier moment d'activité
    $currentTime = time();
    $lastActivity = $_SESSION['last_activity'];

    if (($currentTime - $lastActivity) > $sessionLifetime) {
        // La session a expiré, détruire la session et rediriger vers la page de connexion
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit;
    } else {
        // Mettre à jour le dernier moment d'activité de la session
        $_SESSION['last_activity'] = $currentTime;
    }

    // Rediriger vers la page admin ou toute autre page sécurisée
    header('Location: admin.php');
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le mot de passe soumis dans le formulaire
    $password = $_POST['password'];

    // Vérifier si le mot de passe est correct
    $hashedPassword = '$2y$10$/sSG8CpwCWEoMno2On8hneI6ooClDZdMH8UQhKxan4b6t.mOa5qq2'; // Remplacez <HASHED_PASSWORD> par le mot de passe haché de votre choix

    if (password_verify($password, $hashedPassword)) {
        // Le mot de passe est correct, définir la session d'authentification
        $_SESSION['authenticated'] = true;

        // Définir le dernier moment d'activité de la session
        $_SESSION['last_activity'] = time();

        // Rediriger vers la page admin ou toute autre page sécurisée
        header('Location: admin.php');
        exit;
    } else {
        // Le mot de passe est incorrect, afficher un message d'erreur
        $error = 'Mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Connexion</h1>

    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form action="login.php" method="POST">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
