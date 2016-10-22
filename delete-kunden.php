<?php
$id = $_GET['id'] ?? 0;

$query = 'DELETE FROM kunden WHERE kunden_id=?';
$stmt = $db->prepare($query) or trigger_error($stmt->error, E_USER_ERROR);
$stmt->bind_param("i", $id);
$stmt->execute(); // or trigger_error($stmt->error, E_USER_ERROR);

if ($stmt->affected_rows && !$stmt->error) {
    $msg = '<p class="success">Datensatz erfolgreich gelöscht!</p>';
    $msg = '<p class="success">Datensatz erfolgreich gelöscht!</p>';
    } else {
    $msg = '<p class="error">Datensatz konnte nicht gelöscht werden!</p>';
    }

?>
