<h3>Kurse</h3>
<?php
$query = 'SELECT kunden_kundennummer as nr, kunden_vorname as vn, kunden_nachname as nn, kunden_email as mail, kunden_telefon as tel FROM kunden ORDER BY kunden_nachname';

$stmt = $db->prepare($query) or trigger_error($stmt->error, E_USER_ERROR);
$stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
$result = $stmt->get_result() or trigger_error($stmt->error, E_USER_ERROR);

if ($result->num_rows > 0):
?>
<table class="pure-table pure-table-striped">
	<thead>
		<tr>
			<th>KdNr</th>
			<th>Vorname</th>
			<th>Nachname</th>
			<th>E-Mail</th>
			<th>Tel</th>
		</tr>
	</thead>
	<tbody>
<?php


echo '</tbody></table>';	
endif; // endif num_rows > 0
?>