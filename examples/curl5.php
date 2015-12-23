<?php

	include '../autoloader.php';

	use scrapper\lib\Webscrape as Webscrape;


	$userEmail = 'name@email.com'; // Setting your email address for site login
	$userPass = 'password123'; // Setting your password for site login
	$postUrl = 'https://www.packtpub.com/account';

	$packtPage = new Webscrape;

	$packtPage->seturl("http://www.amazon.in/gp/product/B00RHJOJKY/ref=s9_simh_gw_p107_d0_i1?pf_rd_m=A1VBAL9TL5WCBF&pf_rd_s=desktop-1&pf_rd_r=02XG7HR3YZHXYSTA5ZS5&pf_rd_t=36701&pf_rd_p=749389187&pf_rd_i=desktop");

	
	// Setting URL to
	// Setting form input fields as 'name' => 'value'
	$postFields = array('email' => $userEmail,
	'password' => $userPass,
	'destination' => 'account',
	'form_id' => 'packt_login_form'
	);

	$successString = 'You are logged in as';

	$loggedIn = $packtPage->curlPost($postUrl, $postFields, $successString); //Executing curlPost login and storing results page in $loggedIn
?>