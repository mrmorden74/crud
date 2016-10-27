	<h3>Update Kunden</h3>
<?php
require_once 'inc/SimpleValidator/Validator.php';
require_once 'inc/SimpleValidator/SimpleValidatorException.php';



$vals = [	'vorname' => 'thomas1',
			'email' => 'blala@bla.at'];

$rules = [
	'vorname' => [
		'required',
		'alpha'
	],
	'email' => [
		'required' ,
		'email'
	]
];			
$validation_result = SimpleValidator\Validator::validate($vals, $rules);
if ($validation_result->isSuccess() == true) {
    echo "validation ok";
} else {
    echo "validation not ok";
    var_dump($validation_result->getErrors('de'));
}
?>
