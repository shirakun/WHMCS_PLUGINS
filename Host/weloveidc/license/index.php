<?php
$ucKey = "\$u3+umAg_wrU4em_wretrawa3\$fruz";
$licKey = 'pRu2wub6+W6Y?t3texAZ8taspeFa_u';
$input = json_decode(ucAuthcode(file_get_contents("php://input"), "DECODE", $ucKey),true);
if(is_array($input) && !empty($input)){
	if(isset($input['license_key']) && isset($input['domain']) && isset($input['ip']) && isset($input['productId']) && isset($input['version']) && isset($input['time']) && isset($input['callback_path'])){
		$key =  array(
					'id' => 1,
					'client_id' => 1,
					'license_key' => $input['license_key'],
					'product_id' => $input['productId'],
					'name' => 'Suzume',
					'type' => 0,
					'expiry' => strtotime("29991231 23:59:59"),
					'ip' => $input['ip'],
					'domain' => $input['domain'],
					'callback_path' => $input['callback_path'],
					'version' => $input['version'],
					'create_time' => time(),
					'update_time' => $input['time']
				);
		$key = json_encode($key);
		echo(LicenseEncodePart(ucAuthcode($key, 'ENCODE', $ucKey), $licKey));
	}else{
		echo "404";
	}
}else{
	echo "404";
}

function ucAuthcode($str, $operation = "DECODE", $key = "", $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = ($ckey_length ? ($operation == "DECODE" ? substr($str, 0, $ckey_length) : substr(md5(microtime()), 0 - $ckey_length)) : "");
    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);
    $str = ($operation == "DECODE" ? base64_decode(substr($str, $ckey_length)) : sprintf("%010d", ($expiry ? $expiry + time() : 0)) . substr(md5($str . $keyb), 0, 16) . $str);
    $str_length = strlen($str);
    $result = "";
    $box = range(0, 255);
    $rndkey = array(  );
    for( $i = 0; $i <= 255; $i++ ) 
    {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for( $j = $i = 0; $i < 256; $i++ ) 
    {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for( $a = $j = $i = 0; $i < $str_length; $i++ ) 
    {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($str[$i]) ^ $box[($box[$a] + $box[$j]) % 256]);
    }
    if( $operation == "DECODE" ) 
    {
        if( (substr($result, 0, 10) == 0 || 0 < substr($result, 0, 10) - time()) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16) ) 
        {
            return substr($result, 26);
        }

        return "";
    }

    return $keyc . str_replace("=", "", base64_encode($result));
}

function licenseDecodePart($string, $key)
{
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $i = 0;
    while( $i < $strLen ) 
    {
        $ordStr = hexdec(base_convert(strrev(substr($string, $i, 2)), 36, 16));
        if( $j == $keyLen ) 
        {
            $j = 0;
        }

        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
        $i += 2;
    }
    return $hash;
}

function LicenseEncodePart($string, $key)
{
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $i = 0;
    $j = 0;
    $hash = '';
    while( $i < $strLen ) 
    {
    	$ordStr = ord(substr($string, $i, 1));

		if( $j == $keyLen ) 
        {
            $j = 0;
        }

		$ordKey = ord(substr($key, $j, 1));
        $j++;

        $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));

        $i += 1;
    }
    return $hash;
}