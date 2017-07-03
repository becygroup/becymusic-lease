<?php

	$errors = array();

	// Check if name has been entered
	if (!isset($_POST['name'])) {
		$errors['name'] = 'Prosím, vyplň jméno';
	}

	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Prosím, vyplň tvoji e-tmailovou adresu';
	}

	//Check if message has been entered
	if (!isset($_POST['message'])) {
		$errors['message'] = 'Prosím, vyplň zprávu';
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}



	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$from = $email;
	$to = 'honza@becydog.cz';
	$subject = 'Mám zájem o zkušebnu';

	$body = $name . ' <' . $email . '>: ' . $message . "\n";

	//send the email
	$result = '';
	if (false !== file_put_contents('../maily.txt', date('Y-m-d H:i:s') . ': ' . $body, FILE_APPEND)) {
		$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'Díky! Brzy se ozveme.';
		$result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Něco se pokazilo. Zkus to později znovu nebo zavolej';
	$result .= '</div>';

	echo $result;
