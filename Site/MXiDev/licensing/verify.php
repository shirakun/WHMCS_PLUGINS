<?php
//var_dump($_POST);
if(isset($_POST['licensekey']) && isset($_POST['domain']) && isset($_POST['ip']) && isset($_POST['dir']) && isset($_POST['check_token'])){
	switch ($_POST['licensekey']) {
		case 'emailVerifyNulled':
			CalcLicense('HzbtjcJUemWlBENN', $_POST['domain'], $_POST['ip'], $_POST['dir'], $_POST['check_token']);
			break;
		default:
			break;
	}
}

function CalcLicense($secret,$domain,$ip,$dir,$checktoken){
	$licensing_secret_key = $secret;
	$results["status"] = "Active";
	$results["description"] = "Nulled";
	$results["checkdate"] = date("Ymd",time() + 1 * 60 * 60 * 24 * 999999999);
	$results["checktoken"] = $checktoken;
	$results["md5hash"] = md5($licensing_secret_key . $checktoken);
	$results["validdomain"] = $domain;
	$results["validip"] = $ip;
	$results["validdirectory"] = $dir;
	/*$data_encoded = serialize($results);
	$data_encoded = base64_encode($data_encoded);
	$data_encoded = md5(date("Ymd",time() + 1 * 60 * 60 * 24 * 999999999) . $licensing_secret_key) . $data_encoded;
	$data_encoded = strrev($data_encoded);
	$data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
	//$data_encoded = wordwrap($data_encoded, 80, "\n", true);
	 $data_encoded;
	 */
	echo(json_encode($results));
}