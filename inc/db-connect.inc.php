<?php
/**
*	Verbindet sich zu mysql und gibt ein mysqli Objekt zurück
*	@param $user string 			Username
*	@param $pw string 				Passwort
*	@param $host string 			Adresse des MySQL Servers
*	@param $user db 				Name der Datenbank
*/
function connectDB(string $user, string $pw, string $host, string $db) : mysqli {
	$mysqli = new mysqli($host, $user, $pw, $db);
	// Prüfen, ob ein Fehler auftrat
	if ($mysqli->connect_errno) {
		// TODO: in Log-File schreiben
		echo 'Fehler beim Verbinden zur Datenbank.: ', $mysqli->connect_errno;

	}
	return $mysqli;	
}