<?php
require "cleaned.php";
require(dirname(dirname(__FILE__)).'/init.php');
use WHMCS\Database\Capsule;
$service = \WHMCS\Database\Capsule::table('tblhosting')->where('password', $_GET['license'])->first();
$serviceip = \WHMCS\Database\Capsule::table('tblcustomfieldsvalues')->where('relid', $service->id)->where('value',$_GET['ip'])->first();
if (!empty($service) && !empty($serviceip)){
	//判断是否已经激活
  	if($service->domainstatus == 'Active'){
		$tblclients = WHMCS\Database\Capsule::table('tblclients')->where('id',$service->userid)->first();
	    $usermail = $tblclients->email;
		$username=$tblclients->lastname.$tblclients->firstname;
		$returnarray = array(
			"hash" => '',
			"hash2" => '',
			"status" => 'Active',
			"productid" => 20,
			"checkDate" => date("Y-M-D"),
			"companyname" => $username,
			"email" => $usermail,
			"configoptions" => "Slaves=999|Mini Slaves=999|Micro Slaves=999"
		);
		$data = $lgo->LicenseEncode($returnarray);
		echo($data);
    }else{
		header("status: 404 Not Found");
	}
}else{
	header("status: 404 Not Found");
}