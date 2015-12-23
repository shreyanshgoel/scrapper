<?php
// Function to make GET request using cURL

class scrapper{

	function curlget($url){


		$ch = curl_init();	// Initialising cURL session

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_URL, $url);

		$results = curl_exec($ch); // Executing cURL session

		curl_close($ch); // Closing cURL session

		return $results; // Return the results


	}

	function xpath(){

		$xmlPageDom = new DomDocument(); // Instantiating a new DomDocument object
			
		@$xmlPageDom->loadHTML($item);	 // Loading the HTML from downloaded page
		
		$xmlPageXPath = new DOMXPath($xmlPageDom); // Instantiating new XPath DOM object
			
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

}


?>