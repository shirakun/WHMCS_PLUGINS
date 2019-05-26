<?php
/**
 * FakeVirtualizor whmcs module
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function FakeVirtualizor_MetaData()
{
    return array(
        'DisplayName' => 'FakeVirtualizor',
        'APIVersion' => '1.0',
        'RequiresServer' => false
    );
}

function FakeVirtualizor_ConfigOptions()
{
    return array(
         "hosts规则" => array("Type" => "textarea",'Size'=>'256'), //1
    );
}


function FakeVirtualizor_CreateAccount(array $params)
{
    $localkey = FakeVirtualizor_GenerateRandomKey();
    \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->update(['password' => $localkey]);
    return 'success';
}

function FakeVirtualizor_SuspendAccount(array $params)
{

    return 'success';
}

function FakeVirtualizor_UnsuspendAccount(array $params)
{

    return 'success';
}
function FakeVirtualizor_TerminateAccount(array $params)
{

    return 'success';
}


function FakeVirtualizor_ClientArea($params) {
    if($params['status'] == 'Active'){
        $service = \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->first();
        $license = array(
                    "ip" => $params['customfields']['输入IP'],
                    "hosts" => $params["configoption1"],
                    "license" => $service->password
                );
        $hosts = explode("\n",$params["configoption1"]);
        $rows = count($hosts);
        $mainarray = array(
            "license" => $service->password,
            "lictype" => '-1',
            "lictype_txt" => 'NagakaTech',
            "active" => 1,
            "active_txt" => '<font color="green">Active By Suzume</font>',
            "licnumvs" => 0,
            "primary_ip" => $params['customfields']['输入IP'],
            "licexpires" => '20991231',
            "licexpires_txt" => '31/12/2099 GMT',
            "last_edit" => 0,
            "fast_mirrors" => array('https://s1.softaculous.com/a/virtualizor',
                                    'https://s2.softaculous.com/a/virtualizor',
                                    'https://s3.softaculous.com/a/virtualizor',
                                    'https://s4.softaculous.com/a/virtualizor',
                                    'https://s7.softaculous.com/a/virtualizor')
        );
        $hosts = explode("\n",$params["configoption1"]);
        $rows = count($hosts);
        return array(
            'tabOverviewReplacementTemplate' => 'details.tpl',
            'templateVariables' =>  array(
                                        'license' => $license,
                                        'licenseRows' => $rows,
                                        'maintxt' => FakeVirtualizor_sm_encode(json_encode($mainarray))
                                    )
            );
    }else{
        return array(
            'tabOverviewReplacementTemplate' => 'error.tpl',
            'templateVariables'              => array('usefulErrorHelper' => '当前产品状态未开通，请稍后再试！')
            );
    }
}

function FakeVirtualizor_GenerateRandomKey(){
    $key = rand(10000,99999) . "-" . rand(10000,99999) . "-" . rand(10000,99999) . "-" . rand(10000,99999) . "-" . rand(10000,99999);
    return $key;
}

function FakeVirtualizor_sm_encode($txt) 
{
    $from = array( "!", "@", "#", "\$", "%", "^", "&", "*", "(", ")" );
    $to = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j" );
    $txt = base64_encode($txt);
    $txt = str_replace($to, $from, $txt);
    $txt = gzcompress($txt);
    for( $i = 0; $i < strlen($txt);
    $i++ ) 
    {
        $txt[$i] = FakeVirtualizor_sm_reverse_bits($txt[$i]);
    }
    
    $txt = base64_encode($txt);
    return $txt;
}

function FakeVirtualizor_sm_reverse_bits($orig) 
{
    $v = decbin(ord($orig));
    $pad = str_pad($v, 8, "0", STR_PAD_LEFT);
    $rev = strrev($pad);
    $bin = bindec($rev);
    $chr = chr($bin);
    return $chr;
}



