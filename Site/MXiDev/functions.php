<?php
/*define("SupportArray",['emailVerify',
						'Renewal',
						]);*/
define("SupportArray",['Renewal',
						]);

function GetLicense($items){
	if(in_array($items['type'], SupportArray)){
		switch($items['type']){
			case "emailVerify":
				$licensing_secret_key = "HzbtjcJUemWlBENN";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				return GetPHP("/emailVerify_License.php","licensekey",$license);
				break;
			case "Renewal":
				$licensing_secret_key = "pZPYEndPVtAuzSBK";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				return GetPHP("/renewal_License.php","licensekey",$license);
				break;
			default:
				return array();
			break;
		}
	}else{
		return array();
	}
	return array();
}

function GetSelect(){
	$select = "";
	foreach(SupportArray as $item){
		$select .= "<option value=".$item.">".$item."</option>\n";
	}
	return $select;
}

function GetPHP($localkeyname,$licensename,$license){
	return array(
		"status" => "success",
		"key" => $localkeyname,
		"license" => $license
	);
}

function CalcLicense($secret,$domain,$ip,$dir){
	$licensing_secret_key = $secret;
	$check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensing_secret_key);
	$results["status"] = "Active";
	$results["description"] = "Nulled";
	$results["registeredname"] = "Tech";
	$results["checkdate"] = "20991231";
	$results["regdate"] = time();
	$results["nextduedate"] = "0000-00-00";
	$results["checktoken"] = $check_token;
	$results["md5hash"] = md5($licensing_secret_key . $check_token);
	$results["validdomain"] = $domain;
	$results["validip"] = $ip;
	$results["validdirectory"] = $dir;
	$data_encoded = serialize($results);
	$data_encoded = base64_encode($data_encoded);
	$data_encoded = md5("20991231" . $licensing_secret_key) . $data_encoded;
	$data_encoded = strrev($data_encoded);
	$data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
	//$data_encoded = wordwrap($data_encoded, 80, "\n", true);
	return $data_encoded;
}