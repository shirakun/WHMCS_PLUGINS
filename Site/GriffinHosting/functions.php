<?php
define("SupportArray",[
						'SecurityPlus',
						'EmailPlus'
						]);

function GetLicense($items){
	if(in_array($items['type'], SupportArray)){
		switch($items['type']){
			case "SecurityPlus":
				$licensing_secret_key = "S3cur1tyPlu5";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("mod_security_plus_data",$license);
			break;
			case "EmailPlus":
				$licensing_secret_key = "eMa1lPlu5";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("mod_email_plus_data",$license);
			break;
			default:
				echo('<p>类型不存在</p>');
			break;
		}
	}else{
		echo('<p>类型不存在</p>');
	}
}

function GetSelect(){
	$select = "";
	foreach(SupportArray as $item){
		$select .= "<option value=".$item.">".$item."</option>\n";
	}
	return $select;
}

function GetPHP($tablename,$license){
	echo('<p>请在config.php中下方写入如下内容：</p>');
	echo('use WHMCS\Database\Capsule;<br>');
	echo('$license = "'.$license.'";<br>');
	echo("\$result = Capsule::table('" . $tablename . "')->where('setting', 'license_localkey')->first();<br>");
	echo('if(!$result){<br>');
	echo("Capsule::table('" . $tablename . "')->insert(['setting' => 'license_localkey', 'value' => \$license]);<br>");
	echo('}else{<br>');
	echo("Capsule::table('" . $tablename . "')->where('setting', 'license_localkey')->update(['value' => \$license]);<br>");
	echo('}');
}

function CalcLicense($secret,$domain,$ip,$dir){
	$licensing_secret_key = $secret;
	$check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensing_secret_key);
	$results["status"] = "Active";
	$results["description"] = "Nulled With Love~";
	$results["checkdate"] = "20991231";
	$results["nextduedate"] = "20991231";
	$results["checktoken"] = $check_token;
	$results["md5hash"] = md5($licensing_secret_key . $check_token);
	$results["validdomain"] = $domain;
	$results["validip"] = $ip;
	$results["validdirectory"] = $dir;
	$results["current_version"] = "6.66";
	$results["registeredname"] = "Nulled With Love~";
	$results["companyname"] = "Tech";
	$data_encoded = serialize($results);
	$data_encoded = base64_encode($data_encoded);
	$data_encoded = md5("20991231" . $licensing_secret_key) . $data_encoded;
	$data_encoded = strrev($data_encoded);
	$data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
	//$data_encoded = wordwrap($data_encoded, 80, "\n", true);
	return $data_encoded;
}