<?php
/*
	Diverse Hilfsfunktionen
*/

/**
*	Fügt pre Tag um var_dump ein
*	@param $val mixed
*/
function dumpPre($val) {
	echo '<pre>';
	var_dump( $val );
	echo '</pre>';
}

/***** Form Functions *****/
/**
*	Prüft, ob ein POST Request gesetzt wurde
*	@return boolean
*/
function isFormPosted() {
	return count($_POST) > 0;
}

/**
*	Validiert alle Felder, die im Array $conf mitgegeben werden.
*	@param $conf array
*	@param $errors Referenz auf außerhalb liegendes Array (pass by reference)
*	@return boolean
*/
function validateForm($conf, &$errors) {
	// 
	$formErrors = count($conf);

	// Schleife über config
	foreach ($conf as $fieldName => $fieldConf) {
		// Wert aus Formular ermitteln
		$fieldValue = '';
		if ( isset($_POST[$fieldName]) ) {
			$fieldValue = trim( $_POST[$fieldName] );
		}

		// required prüfen
		if ( $fieldConf['required'] === true && validate_empty($fieldValue) === true ) {
			// Fehler schreiben
			$errors[$fieldName] = 'Feld darf nicht leer sein';
			// Schleifendurchlauf des foreach abbrechen
			continue;
		}
		// Weitere Validierungen nur, wenn ein Wert gesendet wurde
		if ($fieldValue !== '') {
			// Alternative if/else Form. Wird verwendet, wenn die Werte einer Variable bekannt sind.
			switch( $fieldConf['dataType'] ) {
				case 'text':
					break;
				case 'name':
					break;
				case 'email':
					if ( validate_email($fieldValue) === false ) {
						// Fehler schreiben
						$errors[$fieldName] = 'Ungültige E-Mail Adresse';
						continue 2; // bricht foreach ab, zählt continues von innen nach außen
					}
					break; // bricht den aktuellen case ab, geht aus switch raus
				case 'int':
					if ( validate_int($fieldValue) === false ) {
						// Fehler schreiben
						$errors[$fieldName] = 'Bitte nur Ganzzahlen eingeben';
						continue 2; // bricht foreach ab, zählt continues von innen nach außen
					}
					break;
				case 'float':
					break;
				case 'number':
					break;
				case 'phone':
					break;
				case 'custom':
					break;
				default:
					break;
			}

			// restliche Validierungen, minLength, maxLength etc.
			if (isset($fieldConf['minVal']) && !validate_minVal($fieldValue, $fieldConf['minVal'])) {
				$errors[$fieldName] = 'Wert muss mindestens ' . $fieldConf['minVal'] . ' hoch sein';
				continue;
			}

			if (isset($fieldConf['maxVal']) && !validate_maxVal($fieldValue, $fieldConf['maxVal'])) {
				$errors[$fieldName] = 'Wert darf höchstens ' . $fieldConf['maxVal'] . ' hoch sein';
				continue;
			}
		} // ungleich Leerstring

		//
		$formErrors--;
	}
	// Wenn formErrors vorhanden sind ist das Formular nicht valide
	if ( $formErrors > 0 ) {
		echo 'Fehler: ', $formErrors;
		return false;
	}

	echo 'Fehlerfrei';
	return true;
}

/**
*	Validiert, ob der Wert kein Leerstring oder ungleich NULL ist
*	@param $val string
*	@return boolean
*/
function validate_empty($val) {
	if ($val === NULL || $val === '') {
		return true;
	}
	return false;
}

/**
*	Validiert, ob $val eine gültige E-Mail Adresse darstellt
*	@param $val string
*	@return boolean
*/
function validate_email($val) {
	if (filter_var($val, FILTER_VALIDATE_EMAIL) === false) {
		return false;
	}

	return true;
}

/**
*	Validiert, ob $val eine gültige Ganzzahl darstellt
*	@param $val mixed
*	@return boolean
*/
function validate_int($val) {
	if (filter_var($val, FILTER_VALIDATE_INT) === false) {
		return false;
	}

	return true;
}

/**
*	Validiert, ob $val größer oder gleich $min ist
*	@param $val number
*	@param $min number
*	@return boolean
*/
function validate_minVal($val, $min) {
	if (is_numeric($val) && $val >= $min) {
		return true;
	}

	return false;
}

/**
*	Validiert, ob $val kleiner oder gleich $min ist
*	@param $val number
*	@param $max number
*	@return boolean
*/
function validate_maxVal($val, $max) {
	if (is_numeric($val) && $val <= $max) {
		return true;
	}

	return false;
}
