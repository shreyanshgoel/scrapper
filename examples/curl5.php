<?php


	$userEmail = 'name@email.com'; // Setting your email address for site login
	$userPass = 'password123'; // Setting your password for site login
	$postUrl = 'https://www.packtpub.com/account';

	// Setting URL to
	// Setting form input fields as 'name' => 'value'
	$postFields = array('email' => $userEmail,
	'password' => $userPass,
	'destination' => 'account',
	'form_id' => 'packt_login_form'
	);

	$successString = 'You are logged in as';

	$loggedIn = curlPost($postUrl, $postFields, $successString); //Executing curlPost login and storing results page in $loggedIn
?>