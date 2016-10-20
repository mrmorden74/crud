<?php
require_once 'inc/db-connect.inc.php';
$db = connectDB('root', '', 'localhost', 'kurse');

// Seiten unterscheiden durch action
$action = $_GET['action'] ?? 'r';
if ( !in_array($action, ['c', 'r', 'u', 'd']) ) {
	$action = 'r';
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
		// action unterscheidet die darzustellenden Inhalte
		switch ($action) {
			case 'c':
				// Neuen Kunden erstellen
				include 'create-kunden.php';
				break;
			case 'r':
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