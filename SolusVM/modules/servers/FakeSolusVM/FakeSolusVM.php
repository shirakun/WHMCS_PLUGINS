<?php
/**
 * FakeSolusVM whmcs module
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function FakeSolusVM_MetaData()
{
    return array(
        'DisplayName' => 'FakeSolusVM',
        'APIVersion' => '1.0.2',
        'RequiresServer' => false
    );
}

function FakeSolusVM_ConfigOptions()
{
    $configarray = array(
		 "hosts规则"			=> array("Type" => "textarea",'Size'=>'256'),							//1
	);
	return $configarray;
}


function FakeSolusVM_CreateAccount(array $params)
{
    $localkey = FakeSolusVM_GenerateRandomKey();
    \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->update(['password' => $localkey]);
    return 'success';
}

function FakeSolusVM_SuspendAccount(array $params)
{
	\WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->update(['domainstatus' => 'Suspended']);
    return 'success';
}

function FakeSolusVM_UnsuspendAccount(array $params)
{
	\WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->update(['domainstatus' => 'Active']);
    return 'success';
}
function FakeSolusVM_TerminateAccount(array $params)
{
 	\WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->delete();
	\WHMCS\Database\Capsule::table('tblcustomfieldsvalues')->where('relid', $params['serviceid'])->where('fieldid','10')->delete();
    return 'success';
}


function FakeSolusVM_ClientArea($params) {
    if($params['status'] == 'Active'){
		$service = \WHMCS\Database\Capsule::table('tblhosting')->where('id', $params['serviceid'])->where('userid', $params['userid'])->first();
        $license = array(
                    "license" => $service->password,
					"ip" => $params['customfields']['服务器IP'],
					"hosts" => $params["configoption1"],
                );
        $hosts = explode("\n",$params["configoption1"]);
        $rows = count($hosts);
        return array(
            'tabOverviewReplacementTemplate' => 'details.tpl',
            'templateVariables' =>  array(
                                        'license' => $license,
                                        'licenseRows' => $rows
                                    )
            );
    }else{
        return array(
            'tabOverviewReplacementTemplate' => 'error.tpl',
            'templateVariables'              => array('usefulErrorHelper' => '当前产品状态未开通，请稍后再试！')
            );
    }
}

function FakeSolusVM_GenerateRandomKey(){
    $key = "Solus" . "-" . rand(10000,99999) . "-" . rand(10000,99999) . "-" . rand(10000,99999) . "-" . rand(10000,99999) . "-" . rand(10000,99999);
    return $key;
}