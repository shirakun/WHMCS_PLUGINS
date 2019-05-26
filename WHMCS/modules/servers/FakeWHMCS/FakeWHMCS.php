<?php
/**
 * FakeWHMCS whmcs module
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function FakeWHMCS_MetaData()
{
    return array(
        'DisplayName' => 'FakeWHMCS',
        'APIVersion' => '1.0',
        'RequiresServer' => false
    );
}

function FakeWHMCS_ConfigOptions()
{
    return array();
}


function FakeWHMCS_CreateAccount(array $params)
{
    $serverip = '216.172.164.64';
    $license = FakeWHMCS_validate($params['customfields']['输入指向域名'],$serverip,$params['customfields']['输入授权'],$params['customfields']['输入真实域名']);
    if($license){
        $license = FakeWHMCS_validate($params['customfields']['输入指向域名'],$serverip,$params['customfields']['输入授权'],$params['customfields']['输入真实域名'],true);
        if($license){
            $localkey = FakeWHMCS_encodeLocalKey($license);
            \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->update(['password' => $localkey]);
            return 'success';
        }
    }
    return '注册失败，请重试！';
}

function FakeWHMCS_SuspendAccount(array $params)
{

    return 'success';
}

function FakeWHMCS_UnsuspendAccount(array $params)
{

    return 'success';
}
function FakeWHMCS_TerminateAccount(array $params)
{


    return 'success';
}


function FakeWHMCS_ClientArea($params) {
    if($params['status'] == 'Active'){
        $serverip = '216.172.164.64';
        $service = \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->first();
        $license = FakeWHMCS_DecodeLocal($service->password);
        if($license){
            if($license['status'] !== 'Active'){
                $license = FakeWHMCS_validate($params['customfields']['输入指向域名'],$serverip,$params['customfields']['输入授权'],$params['customfields']['输入真实域名'],true);
                if($license){
                    $localkey = FakeWHMCS_encodeLocalKey($license);
                    \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->update(['password' => $localkey]);
                }
            }
        }else{
            $license = FakeWHMCS_validate($params['customfields']['输入指向域名'],$serverip,$params['customfields']['输入授权'],$params['customfields']['输入真实域名']);
            if($license){
                $localkey = FakeWHMCS_encodeLocalKey($license);
                \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->update(['password' => $localkey]);
            }
        }
        if($license){
            return array(
                'tabOverviewReplacementTemplate' => 'details.tpl',
                'templateVariables' =>  array(
                                            'license'=> $license
                                        )
                );
        }else{
            return array(
                'tabOverviewReplacementTemplate' => 'error.tpl',
                'templateVariables'              => array('usefulErrorHelper' => '授权出现错误，请重试或提交工单！')
                );
        }
    }else{
        return array(
            'tabOverviewReplacementTemplate' => 'error.tpl',
            'templateVariables'              => array('usefulErrorHelper' => '当前产品状态未开通，请稍后再试！')
            );
    }
}

function FakeWHMCS_validate($licensedomain,$ip,$license,$realdomain,$checklicense = false)
{
    if($checklicense){
        $postfields = FakeWHMCS_buildCheckPostData($ip,$license,$licensedomain);
    }else{
        $postfields = FakeWHMCS_buildPostData($licensedomain,$ip,$license,$realdomain);
    }
    $response = FakeWHMCS_callHome($postfields);
    if( $response === false && !is_null($GLOBAL['FakeWHMCS_lastCurlError']) ) 
    {
        return false;
        //throw new Exception("CURL Error: " . $GLOBAL['FakeWHMCS_lastCurlError']);
    }

    if( $response ) 
    {
        try
        {
            $results = FakeWHMCS_processResponse($response);
            if( $results["hash"] != sha1("WHMCSV5.2SYH" . $postfields["check_token"]) ) 
            {
                return false;
                //throw new Exception("Invalid hash check token");
            }
            return $results;
        }
        catch( Exception $e ) 
        {
            return false;
            //throw new Exception("Remote license response parsing failed: " . $e->getMessage());
        }
    }
}

function FakeWHMCS_encodeLocalKey($data)
{
    $data_encoded = json_encode($data);
    $data_encoded = base64_encode($data_encoded);
    $data_encoded = sha1(date("Y-m-d") . FakeWHMCS_getSalt()) . $data_encoded;
    $data_encoded = strrev($data_encoded);
    $splpt = strlen($data_encoded) / 2;
    $data_encoded = substr($data_encoded, $splpt) . substr($data_encoded, 0, $splpt);
    $data_encoded = sha1($data_encoded . FakeWHMCS_getSalt()) . $data_encoded . sha1($data_encoded . FakeWHMCS_getSalt() . time());
    $data_encoded = base64_encode($data_encoded);
    $data_encoded = wordwrap($data_encoded, 80, "\n", true);
    return $data_encoded;
}

function FakeWHMCS_processResponse($data)
{
    $publicServerKey = "-----BEGIN PUBLIC KEY-----\nMIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAy62WXeIR+PG/50quF7HD\nHXxrRkBIjazP19mXmcqRnyB/sXl3v5WDqxkS/bttqEseNgs2+WmuXPdHzwFF2IhY\nqoijl6zvVOXiT44rVQvCvfQrMncWbrl6PmTUmP8Ux2Dmttnz+dGJlTz3uaysfPqC\n9pAn19b8zgNwGPNl0cGqiMxruGU4Vzbbjs0zOamvrzUkpKRkD3t8voW78KqQ80A/\nfyP9jfCa4Tax6OfjiZ2EVMQgwNbu4nZeu5hggg/9KWX62O+iDWRw10A4OIzw2mJ+\nL0IDgeSMdrSUYgHlf+AUeW2qZV7cN7OOdt+FMQ3i5lX9LBBNeykqIiypF+voVFgN\nLhKw04EOrj6R511yOvVIrW5d2FO/wA5mydXJ1T31w+fjG3IitRm9F6tSRoPfeSi9\n+hWMpBUa9rg/BuoSOGoHMKbKFAN2hYu0e2ftkZ7KATNfoSf3D5HEVnTPqx+KfQFT\nRdjsYUIIqVX+GsQzzBulf5YhoTmew+N5n9dZGGbhNHZTr7cMa1DT73BjxOyMr2Fq\nW92QUyodlfZmPMfF+JD+MBMY0r74u8/ow1rCrnqu+3Rr/JE/Hjl6c9VsQS/sucP6\nJQfLTfeBjXNWdrXCvhUb+QaV4pMYxhpno5/7jPEkMOR9o7QTCFzbszEzlotwS/yT\ncgD/Aq302svJj2VbSAtyBi0CAwEAAQ==\n-----END PUBLIC KEY-----";
    $results = FakeWHMCS_parseSignedResponse($data, $publicServerKey);
    $results["checkdate"] = date("Y-m-d");

    return $results;
}

function FakeWHMCS_parseSignedResponse($response, $publicKey)
{

    $data = explode(":", $response, 2);
    if( empty($data[1]) ) 
    {
        throw new Exception("No license signature found");
    }

    $rsa = new \phpseclib\Crypt\RSA();
    $rsa->setSignatureMode(\phpseclib\Crypt\RSA::SIGNATURE_PKCS1);
    $rsa->loadKey(str_replace(array( "\n", " " ), array( "", "" ), $publicKey));
    try
    {
        if( !$rsa->verify($data[0], base64_decode($data[1])) ) 
        {
            return false;
            //throw new Exception("Invalid license signature");
        }

    }
    catch( \Exception $e ) 
    {
        return false;
        //throw new Exception("Invalid license signature");
    }
    $data = strrev($data[0]);
    $data = base64_decode($data);
    $data = json_decode($data, true);
    if( empty($data) ) 
    {
        return false;
        //throw new Exception("Invalid license data structure");
    }

    return $data;
}

function FakeWHMCS_buildPostData($licensedomain,$ip,$license,$realdomain)
{
    $whmcs = \DI::make("app");
    $stats = json_decode(FakeWHMCS_get_config("SystemStatsCache"), true);
    if( !is_array($stats) ) 
    {
        $stats = array(  );
    }

    $stats = array_merge($stats, \WHMCS\Environment\Environment::toArray());
    $domains = $licensedomain . "," . $realdomain;
    return array( "licensekey" => $license, "domain" => $domains, "ip" => $ip, "dir" => '/www/wwwroot/whmcs', "version" => '"7.5.0-release.1"', "phpversion" => PHP_VERSION, "anondata" => FakeWHMCS_encryptMemberData($stats), "member" => FakeWHMCS_encryptMemberData(FakeWHMCS_buildMemberData($license)), "check_token" => sha1(time() . $license . mt_rand(1000000000, 9999999999)) );
}

function FakeWHMCS_buildCheckPostData($ip,$license,$realdomain)
{
    $whmcs = \DI::make("app");
    $stats = json_decode(FakeWHMCS_get_config("SystemStatsCache"), true);
    if( !is_array($stats) ) 
    {
        $stats = array(  );
    }

    $stats = array_merge($stats, \WHMCS\Environment\Environment::toArray());
    return array( "licensekey" => $license, "domain" => $realdomain, "ip" => $ip, "dir" => '/www/wwwroot/whmcs', "version" => '"7.5.0-release.1"', "phpversion" => PHP_VERSION, "anondata" => FakeWHMCS_encryptMemberData($stats), "member" => FakeWHMCS_encryptMemberData(FakeWHMCS_buildMemberData($license)), "check_token" => sha1(time() . $license . mt_rand(1000000000, 9999999999)) );
}

function FakeWHMCS_buildMemberData($license)
{
    return array( "licenseKey" => $license, "activeClientCount" => 1 );
}

function FakeWHMCS_encryptMemberData(array $data = array(  ))
{
    $publicKey = FakeWHMCS_getMemberPublicKey();
    if( !$publicKey ) 
    {
        return "";
    }

    $publicKey = str_replace(array( "\n", "\r", " " ), array( "", "", "" ), $publicKey);
    $cipherText = "";
    if( is_array($data) ) 
    {
        try
        {
            $rsa = new \phpseclib\Crypt\RSA();
            $rsa->loadKey($publicKey);
            $rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_OAEP);
            $cipherText = $rsa->encrypt(json_encode($data));
            if( !$cipherText ) 
            {
                return false;
                //throw new Exception("Could not perform RSA encryption");
            }

            $cipherText = base64_encode($cipherText);
        }
        catch( \Exception $e ) 
        {
            return false;
            //throw new Exception("Failed to encrypt member data: " . $e->getMessage());
        }
    }

    return $cipherText;
}

function FakeWHMCS_getMemberPublicKey()
{
    /*
    $publicKey = \WHMCS\Config\Setting::getValue("MemberPubKey");
    if( $publicKey ) 
    {
        $publicKey = decrypt($publicKey);
    }
    */  
    $publicKey = '-----BEGIN PUBLIC KEY-----MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAudy2R6NF5GVoaeOh5KQrO5BsKFl9zN+l4soV4xFy4X4UBLXrd9q9v/i+4/vZzh2jGmwTlFjH1F+Q3/c17zdpGTfNw8wEHlC2sObky3y/T8xuqVLZdzvzSMsAZCCtPauiM84tNAiA86X/bWq16f8CuQR1HESxdT95hfPS6Od9omI73n88Vt5UGzpJiXGclhcHFzcEYMlYALbeWa65Q8t6AqwUZ0mVl/EIPQhu+0M1h2q3ixc0VpMVTowgaEzgiDdiGeWGsCLn9/wt9X6Q1FM7biVZlX6Clvbduzw9V43BLMaDfHHID+8hq3D8eNR/0Dlxpo/fE//HRylONBT7cE4QwrldCYDzf3Jz6MDxo7+gJTFja+MwKZgpf78thjkSAyBVaNiUGMwDhZ6pOPXxf+G7RtIQDNePWZahfs+8ReHVzqU/EDIHLRN8sD+RDk+Cur52NsqX9J326fHM+gAxNqu/VljS/AUAbIx9m+K/K5W5HP6yjorovJ5SsTqVi3ps7hlnqJl7OTNKSYEUY6JvT7fPNhmUXa4+McLrdPhgVnNfes6DstcIyGfCGed4x8bayrWvLKNrHPSHz2cTJeZpRta/a+lObjppYQHbboh/1pnrY/cS+JzYqfFLv7VpFAU6MLg7sONFCeqNuk0Wo2ijmnLNOfqElYD4kvVJVloLeVpZrwkCAwEAAQ==-----END PUBLIC KEY-----';
    
    return $publicKey;
}

function FakeWHMCS_get_config($key)
{
    $setting = \WHMCS\Config\Setting::getValue($key);
    return (is_null($setting) ? "" : $setting);
}

function FakeWHMCS_decodeLocal($localkey = "")
{
    if( !$localkey ) 
    {
        return false;
    }

    $localkey = str_replace("\n", "", $localkey);
    $localkey = base64_decode($localkey);
    $localdata = substr($localkey, 40, -40);
    $md5hash = substr($localkey, 0, 40);
    if( $md5hash != sha1($localdata . FakeWHMCS_getSalt()) ) 
    {
        return false;
    }

    $splpt = strlen($localdata) / 2;
    $localdata = substr($localdata, $splpt) . substr($localdata, 0, $splpt);
    $localdata = strrev($localdata);
    $md5hash = substr($localdata, 0, 40);
    $localdata = substr($localdata, 40);
    $localdata = base64_decode($localdata);
    $localKeyData = json_decode($localdata, true);
    $originalcheckdate = $localKeyData["checkdate"];
    if( $md5hash != sha1($originalcheckdate . FakeWHMCS_getSalt()) ) 
    {
        return false;
    }
    return $localKeyData;
}

function FakeWHMCS_getSalt()
{
    //return sha1(sprintf("WHMCS%s%s%s", "7.5.0-release.1", "|-|", $GLOBALS["cc_encryption_hash"]));
    return sha1(sprintf("WHMCS%s%s%s", "7.5.0-release.1", "|-|", "LSwl5vVWOOzxl3oNwwDcXDCXJ0t3CQ7eytpuPbgtQGR1z5EWs7YgBq3bhn4K31Os"));
}

function FakeWHMCS_callHomeLoop($query_string, $timeout = 5)
{
    foreach( FakeWHMCS_getHosts() as $host ) 
    {
        try
        {
            return FakeWHMCS_makeCall(FakeWHMCS_getVerifyUrl($host), $query_string, $timeout);
        }
        catch( Exception $e ) 
        {
            return false;
            //throw new Exception("Remote call failed: " . $e->getMessage());
        }
    }
    return false;
}

function FakeWHMCS_getVerifyUrl($host)
{
    return "https://" . $host . "/1.1/verify";
}

function FakeWHMCS_callHome($postfields)
{
    FakeWHMCS_validateCurlIsAvailable();
    $query_string = build_query_string($postfields);
    $response = FakeWHMCS_callHomeLoop($query_string, 5);
    if( $response ) 
    {
        return $response;
    }

    return FakeWHMCS_callHomeLoop($query_string, 30);
}

function FakeWHMCS_validateCurlIsAvailable()
{
    $curlFunctions = array( "curl_init", "curl_setopt", "curl_exec", "curl_getinfo", "curl_error", "curl_close" );
    foreach( $curlFunctions as $function ) 
    {
        if( !\WHMCS\Environment\Php::isFunctionAvailable($function) ) 
        {
            return false;
            //throw new Exception("Required function " . $function . " is not available");
        }

    }
}

function FakeWHMCS_makeCall($url, $query_string, $timeout = 5)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, (false ? 0 : 2));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, (false ? 0 : 1));
    $response = curl_exec($ch);
    $responsecode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if( curl_error($ch) ) 
    {
        $GLOBAL['FakeWHMCS_lastCurlError'] = curl_error($ch) . " - Code " . curl_errno($ch);
        //throw new Exception("Curl Error: " . curl_error($ch) . " - Code " . curl_errno($ch));
    }

    curl_close($ch);
    if( $responsecode != 200 ) 
    {
        return false;
        //throw new Exception("Received Non 200 Response Code");
    }

    return $response;
}

function FakeWHMCS_getHosts()
{
    return array( "a.licensing.whmcs.com", "b.licensing.whmcs.com", "c.licensing.whmcs.com", "d.licensing.whmcs.com", "e.licensing.whmcs.com", "f.licensing.whmcs.com" );
}