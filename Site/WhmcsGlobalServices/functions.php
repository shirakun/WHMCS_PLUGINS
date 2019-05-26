<?php
define("SupportArray",[
						'VmWare'
						]);

function GetLicense($items){
	if(in_array($items['type'], SupportArray)){
		switch($items['type']){
			case "VmWare":
				$licensing_secret_key = "VMware@har201622!@~";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir'],'VmWare');
				GetPHP("vmware_localkey",$license,$items['domain'],$items['vaip'],$items['vadir']);
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

function GetPHP($tablename,$license,$domain,$ip,$dir){
	echo('<p>授权域名: ' . $domain . '</p>');
	echo('<p>授权IP: ' . $ip . '</p>');
	echo('<p>授权文件夹: ' . $dir . '</p>');
	echo('<p>请在includes/hooks/' . $tablename . '.php中下方写入如下内容：</p>');
	echo('&lt;?php<br>');
	echo('use WHMCS\Database\Capsule;<br>');
	echo("add_hook('AdminAreaHeadOutput', 1, function(\$vars) {<br>");
	echo('$' . $tablename . ' = "' . $license . '";<br>');
	echo("\$result = Capsule::table('tblconfiguration')->where('setting', '" . $tablename . "')->first();<br>");
	echo('if(!$result){<br>');
	echo("Capsule::table('tblconfiguration')->insert(['setting' => '" . $tablename . "', 'value' => $" . $tablename . "]);<br>");
	echo('}else{<br>');
	echo("Capsule::table('tblconfiguration')->where('setting', '" . $tablename . "')->update(['value' => $" . $tablename . "]);<br>");
	echo('}<br>');
	echo('});<br>');

	echo("add_hook('ClientAreaHeadOutput', 1, function(\$vars) {<br>");
	echo('$' . $tablename . ' = "' . $license . '";<br>');
	echo("\$result = Capsule::table('tblconfiguration')->where('setting', '" . $tablename . "')->first();<br>");
	echo('if(!$result){<br>');
	echo("Capsule::table('tblconfiguration')->insert(['setting' => '" . $tablename . "', 'value' => $" . $tablename . "]);<br>");
	echo('}else{<br>');
	echo("Capsule::table('tblconfiguration')->where('setting', '" . $tablename . "')->update(['value' => $" . $tablename . "]);<br>");
	echo('}<br>');
	echo('});<br>');
}

function CalcLicense($secret,$domain,$ip,$dir,$pname){
	$licensing_secret_key = $secret;
	$check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensing_secret_key);
	$results["status"] = "Active";
	$results["description"] = "Nulled";
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
	$results['email'] = 'mail@mail.com';
	$results['productname'] = $pname;
	$data_encoded = serialize($results);
	$data_encoded = base64_encode($data_encoded);
	$data_encoded = md5("20991231" . $licensing_secret_key) . $data_encoded;
	$data_encoded = strrev($data_encoded);
	$data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
	//$data_encoded = wordwrap($data_encoded, 80, "\n", true);
	return $data_encoded;
}