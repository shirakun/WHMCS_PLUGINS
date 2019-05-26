<?php
if(isset($_POST["nodes"]) && isset($_POST["licensekey"]) && isset($_POST["domain"]) && isset($_POST["ip"]) && isset($_POST["dir"])){
$license = $_POST["licensekey"];
$url="https://site/SolusVM/check.php?license=".$license."&ip=".$_POST["ip"];
$html = file_get_contents($url); 
echo $html;
}else{
	header("status: 404 Not Found");
}