<?php
require(dirname(dirname(__FILE__)).'/init.php');
use WHMCS\Database\Capsule;
if(isset($_GET['license']) && isset($_GET['rip'])){
	$mainarray = array(
		"license" => $_GET['license'],
		"lictype" => '-1',
		"lictype_txt" => 'NagakaTech',
		"active" => 0,
		"active_txt" => '<font color="red">Not Active: Error Info~</font>',
		"licnumvs" => 0,
		"primary_ip" => '127.0.0.1',
		"licexpires" => '19980101',
		"licexpires_txt" => '01/01/1998 GMT',
		"last_edit" => 0,
		"fast_mirrors" => array('https://s1.softaculous.com/a/virtualizor',
								'https://s2.softaculous.com/a/virtualizor',
								'https://s3.softaculous.com/a/virtualizor',
								'https://s4.softaculous.com/a/virtualizor',
								'https://s7.softaculous.com/a/virtualizor')
	);
	$serviceip = \WHMCS\Database\Capsule::table('tblcustomfieldsvalues')->where('fieldid', '13')->where('value', $_GET['rip'])->first();
	if (!empty($serviceip)){
		$service = \WHMCS\Database\Capsule::table('tblhosting')->where('id', $serviceip->relid)->first();
		if (!empty($service)){
			if($service->domainstatus == 'Active'){
				$mainarray['active'] = 1;
				$mainarray['active_txt'] = '<font color="green">Active By Suzume</font>';
				$mainarray['primary_ip'] = $_GET['ip'];
				$mainarray['licexpires'] = '20991231';
				$mainarray['license']    = $service->password;
				$mainarray['licexpires_txt'] = '31/12/2099 GMT';
				echo(sm_encode(json_encode($mainarray)));
				die();
			}else{
				$mainarray['active_txt'] = '<font color="red">IP Error: Not Found</font>';
				echo(sm_encode(json_encode($mainarray)));
				die();
			}
		}
	}
	echo(sm_encode(json_encode($mainarray)));
}else{
	header("status: 404 Not Found");
}


function sm_encode($txt) 
{
	$from = array( "!", "@", "#", "\$", "%", "^", "&", "*", "(", ")" );
	$to = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j" );
	$txt = base64_encode($txt);
	$txt = str_replace($to, $from, $txt);
	$txt = gzcompress($txt);
	for( $i = 0; $i < strlen($txt);
	$i++ ) 
	{
		$txt[$i] = sm_reverse_bits($txt[$i]);
	}
	
	$txt = base64_encode($txt);
	return $txt;
}

function sm_reverse_bits($orig) 
{
	$v = decbin(ord($orig));
	$pad = str_pad($v, 8, "0", STR_PAD_LEFT);
	$rev = strrev($pad);
	$bin = bindec($rev);
	$chr = chr($bin);
	return $chr;
}