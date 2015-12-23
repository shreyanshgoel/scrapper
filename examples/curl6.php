<?php

include ',,/autoload.php';

curl_setopt($ch, CURLOPT_FOLLOWLOCATION,

use scrapper\lib\Webscrape as Webscrape;


$packtPage = new Webscrape;

// Declaring arrays

$resultsPages = array();

$bookPages = array();

$initialResultsPageUrl = 'http://www.packtpub.com/books?keys=php';

$packtPage->seturl($initialResultsPageUrl);
// Assigning initial results page URL to work from

$resultsPages[] = $initialResultsPageUrl; // Adding initial results page URL to $resultsPages array

$initialResultsPageSrc = $packtPage->curlget(); //Requesting initial results page

$resultsPageXPath = $packtPage->xpath($initialResultsPageSrc);

$resultsPageUrls = $resultsPageXPath->query('//ul[@class="pager"]/li/a/@href'); // Querying for href attributes of pagination

// If results exist

if ($resultsPageUrls->length > 0) {

	// For each results page URL

	for ($i = 0; $i < $resultsPageUrls->length; $i++) {

		$resultsPages[] = 'http://www.packtpub.com' . $resultsPageUrls->item($i)->nodeValue;	 // Build results page URL and add to $resultsPages array

	}

}

$uniqueResultsPages = array_values(array_unique($resultsPages));

// Removing duplicates from array and reindexing

// For each unique results page URL

foreach ($uniqueResultsPages as $resultsPage) {

	$resultsPageSrc = curlGet($resultsPage);

	// Requesting results page
	$booksPageXPath = returnXPathObject($resultsPageSrc);

	$bookPageUrls = $booksPageXPath->query('//div[@class="view-content"]/table/tbody/tr/td/div/div[@class="field-content"]/a/@href'); // Querying for href attributes of books

// If book page URLs exist
if ($bookPageUrls->length > 0) {

	// For each book page URL

	for ($i = 0; $i < $bookPageUrls->length; $i++) {

		$bookPages[] = 'http://www.packtpub.com' . $bookPageUrls->item($i)->nodeValue; // Add URL to $bookPages array
	}

}