<?php
$isSent = isFormPosted();

if ($isSent) {
    // Validation 
	echo 'test';
    $rules = [
        'Vorname' => [ 'required', 'alpha'],
        'Nachname' => [ 'required', 'alpha'],
        'Adresse' => [ 'required'],
        'PLZ' => [ 'required', 'numeric', 'exact_length(4)'],
        'Ort' => ['required', 'alpha' ],
        'Telefon' => [ 'required', 'numeric'],
        'Email' => [ 'required', 'email']
    ];
    $validation_result = SimpleValidator\Validator::validate($_POST, $rules);
        if ($validation_result->isSuccess() == true) {
            // echo "validation ok";
			$id = $_GET['id'] ?? 0;
            $query = 'UPDATE kunden SET kunden_vorname=?, kunden_nachname=?, kunden_adresse=?, kunden_plz=?,
			 kunden_ort=?, kunden_telefon=?, kunden_email=? WHERE kunden_id=?';
            $stmt = $db->prepare($query) or trigger_error($stmt->error, E_USER_ERROR);
            $stmt->bind_param("ssssssss", $_POST['Vorname'], $_POST['Nachname'], $_POST['Adresse'], $_POST['PLZ'], $_POST['Ort'], $_POST['Telefon'], $_POST['Email'], $id);
            // echo $query;
            $stmt->execute();

            if ($stmt->affected_rows && !$stmt->error) {
                $msg = '<p class="success">Datensatz '.$_POST['Vorname'].' '.$_POST['Nachname'].' ('.$_POST['Kundennummer'].') '.'erfolgreich aktualisert!</p>';
   				$isUpdated = true;
				header('location:index.php');
            } else {
                if ($stmt->errno === 1062) {
                $msg = '<p class="error">Die Kundennummer ist bereits in Verwendung</p>';
                } else {
                $msg = '<p class="error">Datensatz wurde nicht aktualisiert!<br>Fehlernummer: '.$stmt->errno.'</p>';
                }
            }

      } else {
            // echo "validation not ok";
            $errors=($validation_result->getErrors('de'));
            foreach ($errors AS $error) {
                $errorMsg .= "<p class='error'>$error</p>"; 
            }   
        }
}
// Daten für ausgewählten Datensatz auslesen
$id = $_GET['id'] ?? 0;
$query = 'SELECT kunden_kundennummer, kunden_vorname, kunden_nachname, kunden_adresse, kunden_plz, kunden_ort, kunden_telefon, kunden_email FROM kunden WHERE kunden_id=?';
$stmt = $db->prepare($query) or trigger_error($stmt->error, E_USER_ERROR);
$stmt->bind_param("i", $id);
$stmt->execute();
if (!$stmt->affected_rows && $stmt->error) {
	$msg = '<p class="error">Datensatz wurde nicht gefunden!</p>';
} else {
    $result = $stmt->get_result();
	$line = $result->fetch_assoc();
?>
<p><?php echo $msg; ?></p>
<form action="" method="post" class="pure-form pure-form-stacked">
<label for="kdnr">Kundennummer</label>
<p class="input"><?php  echo  $_POST['Kundennummer'] ?? $line['kunden_kundennummer']; ?></p>
<label for="vorname">Vorname</label>
<input type="text" name="Vorname" id="vorname" value= "<?php echo  $_POST['Vorname'] ?? $line['kunden_vorname']; ?>">
<label for="nachname">Nachname</label>
<input type="text" name="Nachname" id="nachname" value= "<?php echo  $_POST['Nachname'] ?? $line['kunden_nachname']; ?>">
<label for="adresse">Adresse</label>
<input type="text" name="Adresse" id="adresse" value= "<?php echo  $_POST['Adresse'] ?? $line['kunden_adresse']; ?>">
<label for="plz">PLZ</label>
<input type="text" name="PLZ" id="plz" value= "<?php echo  $_POST['PLZ'] ?? $line['kunden_plz']; ?>">
<label for="ort">Ort</label>
<input type="text" name="Ort" id="ort" value= "<?php echo  $_POST['Ort'] ?? $line['kunden_ort']; ?>">
<label for="tel">Telefon</label>
<input type="text" name="Telefon" id="tel" value= "<?php echo  $_POST['Telefon'] ?? $line['kunden_telefon']; ?>">
<label for="mail">Email</label>
<input type="email" name="Email" id="mail" value= "<?php echo  $_POST['Email'] ?? $line['kunden_email']; ?>">
<?php echo $errorMsg; ?>
<button type="submit" value="Speichern" class="pure-button pure-button-primary">Speichern</button>
<?php// TODO: Reset Button?>
</form>
<?php 
}
?>
<p><a href="./">zurück</a></p>
