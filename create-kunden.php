<?php
// Form validieren
$isSent = isFormPosted();

if ($isSent) {
    // Validation 

    $rules = [
        'Kundennummer' => [ 'required', 'kdnr_korr' => function($input) {
            if (preg_match("`KdNr-`", $input) && 	preg_match("`[0-9]`", $input))
               return true; 
           return false; 
        }
    ],
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
 
            $query = 'INSERT INTO kunden SET kunden_kundennummer=? , kunden_vorname=?, kunden_nachname=?, kunden_adresse=?, kunden_plz=?, kunden_ort=?, kunden_telefon=?, kunden_email=?';
            $stmt = $db->prepare($query) or trigger_error($stmt->error, E_USER_ERROR);
            $stmt->bind_param("ssssssss", $_POST['Kundennummer'], $_POST['Vorname'], $_POST['Nachname'], $_POST['Adresse'], $_POST['PLZ'], $_POST['Ort'], $_POST['Telefon'], $_POST['Email']);
            // echo $query;
            $stmt->execute();

            if ($stmt->affected_rows && !$stmt->error) {
                $msg = '<p class="success">Datensatz '.$_POST['Vorname'].' '.$_POST['Nachname'].' ('.$_POST['Kundennummer'].') '.'erfolgreich hinzugefügt!</p>';
   				$isAdded = true;
				foreach($_POST as $key => $val) {
					$_POST[$key]=''; // Formular löschen für weiteren Datensatz
				}
            } else {
                if ($stmt->errno === 1062) {
                $msg = '<p class="error">Die Kundennummer ist bereits in Verwendung</p>';
                } else {
                $msg = '<p class="error">Datensatz konnte nicht hinzugefügt werden!<br>Fehlernummer: '.$stmt->errno.'</p>';
                }
            }

      } else {
            // echo "validation not ok";
            $errors=($validation_result->getErrors('de'));
            foreach ($errors AS $error) {
                $errorMsg .= "<p class='error'>$error</p>"; 
            }   
        }
// echo $value = $_POST['Vorname'] ?? '';
}
?>
<p><?php echo $msg; ?></p>
<form action="" method="post" class="pure-form pure-form-stacked">
<label for="kdnr">Kundennummer<br>(KdNr-000000)</label>
<input type="text" name="Kundennummer" id="kdnr" value= "<?php echo  $_POST['Kundennummer'] ?? 'KdNr-000'; ?>">
<label for="vorname">Vorname</label>
<input type="text" name="Vorname" id="vorname" value= "<?php echo  $_POST['Vorname'] ?? ''; ?>">
<label for="nachname">Nachname</label>
<input type="text" name="Nachname" id="nachname" value= "<?php echo  $_POST['Nachname'] ?? ''; ?>">
<label for="adresse">Adresse</label>
<input type="text" name="Adresse" id="adresse" value= "<?php echo  $_POST['Adresse'] ?? ''; ?>">
<label for="plz">PLZ</label>
<input type="text" name="PLZ" id="plz" value= "<?php echo  $_POST['PLZ'] ?? ''; ?>">
<label for="ort">Ort</label>
<input type="text" name="Ort" id="ort" value= "<?php echo  $_POST['Ort'] ?? ''; ?>">
<label for="tel">Telefon</label>
<input type="text" name="Telefon" id="tel" value= "<?php echo  $_POST['Telefon'] ?? ''; ?>">
<label for="mail">Email</label>
<input type="email" name="Email" id="mail" value= "<?php echo  $_POST['Email'] ?? ''; ?>">
<?php echo $errorMsg; ?>
<button type="submit" value="Speichern" class="pure-button pure-button-primary">Speichern</button>
<?php// TODO: Reset Button?>
</form>
<p><a href="./">zurück</a></p>
