<!DOCTYPE html>
<html>
<head>
	<title>Dépôt de fichier</title>
</head>
<body>

	<h1>Dépôt de fichier</h1>

	<?php

	if(isset($_FILES['file'])) {
	    $allowed_types = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text'); // Types de fichiers autorisés
	    $max_size = 5242880; // Taille maximale du fichier (en bytes)

	    if(in_array($_FILES['file']['type'], $allowed_types) && $_FILES['file']['size'] <= $max_size) { // Vérification du type et de la taille du fichier
	        $to_email = "votre_adresse_email@example.com"; // Adresse email de destination
	        $subject = "Nouveau fichier téléchargé"; // Sujet de l'email
	        $message = "Un nouveau fichier a été téléchargé."; // Message de l'email

	        $filename = $_FILES['file']['name']; // Nom du fichier
	        $filetmp = $_FILES['file']['tmp_name']; // Emplacement temporaire du fichier
	        $filetype = $_FILES['file']['type']; // Type de fichier

	        $attachment = chunk_split(base64_encode(file_get_contents($filetmp))); // Encodage de la pièce jointe

	        $boundary = md5(date('r', time())); // Création d'un identifiant unique pour l'email

	        // Création de l'en-tête de l'email
	        $headers = "From: votre_adresse_email@example.com\r\nReply-To: votre_adresse_email@example.com";
	        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"" . $boundary . "\"";

	        // Création du corps de l'email
	        $message = "--" . $boundary . "\r\n";
	        $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\r\n";
	        $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
	        $message .= $message . "\r\n\r\n";
	        $message .= "--" . $boundary . "\r\n";
	        $message .= "Content-Type: " . $filetype . "; name=\"" . $filename . "\"\r\n";
	        $message .= "Content-Transfer-Encoding: base64\r\n";
	        $message .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
	        $message .= $attachment . "\r\n\r\n";
	        $message .= "--" . $boundary . "--";

	        // Envoi de l'email
	        mail($to_email, $subject, $message, $headers);

	        echo "Le fichier a été téléchargé avec succès et l'email a été envoyé.";
	    } else {
	        echo "Veuillez sélectionner un fichier de type .docx ou .odt, dont la taille est inférieure ou égale à 5 Mo.";
	    }
	}

	?>

	<form action="" method="post" enctype="multipart/form-data">
	    <input type="file" name="file" accept=".docx, .odt"><br><br>
	    <input type="submit" value="Télécharger">
	</form>

</body>
</html>
