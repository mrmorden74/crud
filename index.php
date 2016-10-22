<?php
require_once 'inc/db-connect.inc.php';
require_once 'inc/utilities.inc.php';
require_once 'inc/SimpleValidator/SimpleValidatorException.php';
require_once 'inc/SimpleValidator/Validator.php';


$db = connectDB('root', '', 'localhost', 'kurse');

// Initialisierung
$isSent = false;
$isAdded = false;
$isValid = false;
$hasErrros = false;
$isUpdated = false;
$errorMsg = '';
$formErrors = [];


// Seiten unterscheiden durch action
$action = $_GET['action'] ?? 'r';
$msg = '';

if ( !in_array($action, ['c', 'r', 'u', 'd']) ) {
	$action = 'r';
}

// Löschen abfragen
if ($action == 'd') {
    include 'delete-kunden.php';
}
?><!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>CRUD Entry</title>
	<link rel="stylesheet" href="css/pure-min.css">
	<link rel="stylesheet" href="css/layout.css">
</head>
<body>
<div class="wrapper">
	<header class="main-header">
		<h1>CRUD Startseite</h1>
	</header>
	<main>
		<h2>CRUD - Create, Read, Update, Delete</h2>
		<?php
		echo $msg;

		// action unterscheidet die darzustellenden Inhalte
		switch ($action) {
			case 'c':
				// Neuen Kunden erstellen
				include 'create-kunden.php';
				break;
			// case r or d
			case 'r':
			case 'd':
				// Default Ansicht, auslesen der Daten
				include 'read-kunden.php';
				break;
			case 'u':
				// Default Ansicht, auslesen der Daten
				include 'update-kunden.php';
				break;
		}
		?>
	</main>
</div>

</body>
</html>
