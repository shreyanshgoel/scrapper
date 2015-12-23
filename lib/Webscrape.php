<?php

namespace scrapper\lib;

class Webscrape{

 protected $_url;

    function seturl($url){

    	$this->_url = $url;
    }
	function curlget(){


		$ch = curl_init();	// Initialising cURL session

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_URL, $this->_url);

		$results = curl_exec($ch); // Executing cURL session

		curl_close($ch); // Closing cURL session

		return $results; // Return the results


	}

	function xpath($item){

		$xmlPageDom = new \DomDocument(); // Instantiating a new DomDocument object
			
		@$xmlPageDom->loadHTML($item);	 // Loading the HTML from downloaded page
		
		$xmlPageXPath = new \DOMXPath($xmlPageDom); // Instantiating new XPath DOM object
			
		return $xmlPageXPath;	// Returning XPath object
	}

	function scrapeBetween($item, $start, $end) {
		
		if (($startPos = stripos($item, $start)) === false) { 

		return false;

		} else if (($endPos = stripos($item, $end)) === false) {

		return false;
		
		} else {

		$substrStart = $startPos + strlen($start);

		return substr($item, $substrStart, $endPos - $substrStart);	

			}
	}

	function curlPost($postUrl, $postFields, $successString) {
	
		$useragent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5;en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3'; // Setting user agent of a popular browser
		
		$cookie = 'cookie.txt';

		$ch = curl_init();

		// Setting a cookie file to store
		// Initialising cURL session
		// Setting cURL options

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // Prevent cURL from verifying SSL certificate
		curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); // Script should fail silently on error
		curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE); // Use cookies
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // Follow Location: headers
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Returningtransfer as a string
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); // Setting cookiefile
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie); // Setting cookiejar
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent); // Setting useragent
		curl_setopt($ch, CURLOPT_URL, $postUrl); // Setting URL to POST to
		curl_setopt($ch, CURLOPT_POST, TRUE); // Setting method as POST
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields)); // Setting POST fields as array
		
		$results = curl_exec($ch); // Executing cURL session
		
		curl_close($ch); // Closing cURL session
		
		// Checking if login was successful by checking existence of string
		if (strpos($results, $successString)) {
			
			return $results;
		
		} else {
			
			return FALSE;
	}

}

}


?>