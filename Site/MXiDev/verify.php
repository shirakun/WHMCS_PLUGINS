<?php
require("functions.php");
$return = array(
	"status" => "failed",
	"key" => "none",
	"license" => "none"
);
if(isset($_POST['domain']) && isset($_POST['ip']) && isset($_POST['dir']) && isset($_POST['license'])){
	$license = base64_decode($_POST['license']);
	if(in_array($license, SupportArray)){
		$items = array(
			"domain" => $_POST['domain'],
			"vaip" => $_POST['ip'],
			"vadir" => $_POST['dir'],
			"type" => $license
		);
		$return = GetLicense($items);
	}
}
echo(json_encode($return));