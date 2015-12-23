<?php

include '../autoloader.php';

use scrapper\lib\Webscrape as Webscrape;


$packtPage = new Webscrape;

$packtPage->seturl("http://www.amazon.in/gp/product/B00RHJOJKY/ref=s9_simh_gw_p107_d0_i1?pf_rd_m=A1VBAL9TL5WCBF&pf_rd_s=desktop-1&pf_rd_r=02XG7HR3YZHXYSTA5ZS5&pf_rd_t=36701&pf_rd_p=749389187&pf_rd_i=desktop");

$page = $packtPage->curlget();

$bw = $packtPage->scrapeBetween($page, '<body id="dp"', 'x_60000-c">');

if(!empty($bw)){

	echo $bw;

}else{

	echo "Not Found between";
}
?>