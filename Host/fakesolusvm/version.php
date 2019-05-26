<?php
$urldown = "";
if(isset($_GET)){
	foreach( $_GET as $k => $v ) 
	{
		$urldown .= $k . "=" . $v . "&";
	}
}
$url = rtrim("http://licensing1.soluslabs.net/version.php?" . $urldown, '&');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
$output = curl_exec($ch);
curl_close($ch);
echo($output);