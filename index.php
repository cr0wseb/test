<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>Exercice 8</title>
	  <link rel="stylesheet" href="style.css">
	</head>
	<body>
	<a href="\">Home</a><br/>
	<br/>
	<form method="POST" action="#">
		<input type="text" name="u_login" placeholder="Login"/>*<br/>
		<input type="password" name="u_password" placeholder="Password"/>*<br/>
		<input type="text" name="u_prenom" placeholder="Prénom"/>*<br/>
		<input type="text" name="u_nom" placeholder="Nom"/>*<br/>
		<input type="submit" value="Insérer" name="push"/>
	</form>
	<?php
	require_once 'toolbox.inc.php';
	
	// Connection
	$pdo = connectPDO();
	
	// On vérifie que le formulaire a été soumis
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		// Formulaire envoyé / Récupération
		
		// Inserer les informations 
		insertNewData($_POST['u_login'], $_POST['u_password'], $_POST['u_prenom'], $_POST['u_nom']);
	} else {
		// Rien à faire
	}
	
	// On affiche le tableau !
	displayTable();
	?>
	</body>
</html>