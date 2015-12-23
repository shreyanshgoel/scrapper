<?php

include '../autoloader.php';

use scrapper\lib\Webscrape as Webscrape;


$packtPage = new Webscrape;

$packtPage->seturl("http://www.amazon.in/gp/product/B00RHJOJKY/ref=s9_simh_gw_p107_d0_i1?pf_rd_m=A1VBAL9TL5WCBF&pf_rd_s=desktop-1&pf_rd_r=02XG7HR3YZHXYSTA5ZS5&pf_rd_t=36701&pf_rd_p=749389187&pf_rd_i=desktop");

$page = $packtPage->curlget();

$packtPageXpath = $packtPage->xpath($page);

$coverImage = $packtPageXpath->query('//span/img/@src');


if ($coverImage->length > 0) {

   	$imageUrl = "http:" . $coverImage->item(0)->nodeValue;

	$imageName = end(explode('/', $imageUrl));

if (getimagesize($imageUrl)) {

	$imageFile = curlGet($imageUrl); // Download image using cURL

	$file = fopen($imageName, 'w'); // Opening file handle
	
	fwrite($file, $imageFile); // Writing image file
	
	fclose($file); // Closing file handle
}else{

	echo "Not an Image";
}

}else{

	echo "Image not found";
}
?>