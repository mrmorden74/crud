<?php
require_once 'inc/SimpleValidator/Validator.php';
require_once 'inc/SimpleValidator/SimpleValidatorException.php';

$vals = ['vorname' => 'Tho3mas', 'email' => 'bla@bla.at'];

$rules = [
	'vorname' => [
		'required',
		'alpha'
	],
	'email' => [
		'required',
		'email'
	]
];

$validation_result = SimpleValidator\Validator::validate($vals, $rules);

if ($validation_result->isSuccess() == true) {
	echo "Jipie";
}
else {
	var_dump($validation_result->getErrors());
}
?>
