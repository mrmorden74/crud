	<h3>Read Kunden</h3>
<?php
$sql = 'SELECT kunden_id as id, kunden_kundennummer as nr, kunden_vorname as vn, kunden_nachname as nm, kunden_email as mail, kunden_telefon as tel FROM kunden ORDER BY kunden_nachname';	

$stmt = $db->prepare($sql) or
	 trigger_error ($stmt->connect_errno, E_USER_ERROR);
$stmt->execute() or 
	 trigger_error ($stmt->connect_errno, E_USER_ERROR);
$result = $stmt->get_result() or
	 trigger_error ($stmt->connect_errno, E_USER_ERROR);
	 	 
if ($result->num_rows):
?>
<table class="pure-table pure-table-striped">
	<thead>
	<tr>
		<th>KdNr</th>
		<th>Vorname</th>
		<th>Nachname</th>
		<th>E-Mail</th>
		<th>Tel</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
<?php 
$ignores = ['id'];
	while ($line = $result->fetch_assoc()) {
		echo '<tr>';
		foreach($line as $key => $val) {
			if (in_array($key, $ignores)) continue;	
			echo '<td>', $val, '</td>';
		}
		echo '<td>';	
		echo '<a href="./?action=u&id=', $line['id'], '" class="icon"><img src="img/edit.svg" alt="Bearbeiten"></a>';
		echo '</td>';	
		echo '<td>';	
		echo '<a href="./?action=d&id=', $line['id'], '" class="icon"',
			" onclick=\"return confirm('Wirklich löschen?');\">",
			'<img src="img/delete.svg" alt="Löschen"></a>';
		echo '</td>';	
		echo '</tr>';
	}		
?>
	</tbody>
</table>
<p><a href="./action=c" class="pure-button pure-button-primary">Neue Kunden</a></p>
<?php 
endif;	 
?>	