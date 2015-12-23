<?php

namespace scrapper\lib;

class Webscrape{

 protected $_url;

    function seturl($url){

    	$this->_url = $url;
    }
	function curlget($addoptions = array()){


		$ch = curl_init();	// Initialising cURL session

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_URL, $this->_url);

		if(!empty($addoptions)){

			foreach ($addoptions as $key) {
				
				curl_setopt($ch, $key['property'], $key['type']);

			}
		}

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

			
		$addoptions = array(
			array('property'=>, CURLOPT_SSL_VERIFYPEER, 'type'=>, FALSE), 
			array('property'=>, CURLOPT_FAILONERROR, 'type'=>, TRUE), 
			array('property'=>, CURLOPT_COOKIESESSION, 'type'=>, TRUE),
			array('property'=>, CURLOPT_FOLLOWLOCATION, 'type'=>, TRUE)),
			array('property'=>, CURLOPT_COOKIEFILE, 'type'=>, $cookie)),
			array('property'=>, CURLOPT_COOKIEJAR, 'type'=>, $cookie)),
			array('property'=>, CURLOPT_USERAGENT, 'type'=>, $useragent)),
			array('property'=>, CURLOPT_POST, 'type'=>, TRUE)),
			array('property'=>, CURLOPT_POSTFIELDS, 'type'=>, http_build_query($postFields)))
		)
	
		$page = $this->curlget($addoptions);


		
		// Checking if login was successful by checking existence of string
		if (strpos($results, $successString)) {
			
			return $results;
		
		} else {
			
			return FALSE;
	}

}

}


?>