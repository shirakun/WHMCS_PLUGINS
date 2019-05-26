<?php
require "cleaned.php";
if(isset($_POST["nodes"]) && isset($_POST["licensekey"]) && isset($_POST["domain"]) && isset($_POST["ip"]) && isset($_POST["dir"])){
	$returnarray = array(
		"hash" => '',
		"hash2" => '',
		"status" => 'Active',
		"productid" => 20,
		"checkDate" => date("Y-M-D"),
		"companyname" => "Tech",
		"email" => "mail@mail.llc",
		"configoptions" => "Slaves=1000|Mini Slaves=1000|Micro Slaves=1000"
	);
	$data = $lgo->LicenseEncode($returnarray);
	echo($data);
}else{
	echo("No input");
}