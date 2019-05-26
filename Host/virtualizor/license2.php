<?php


if(isset($_GET['license'])){
	$mainarray = array(
		"license" => $_GET['license'],
		"lictype" => '-1',
		"lictype_txt" => 'Tech',
		"active" => 1,
		"active_txt" => '<font color="green">Active By Nulled</font>',
		"licnumvs" => 0,
		"primary_ip" => $_SERVER['REMOTE_ADDR'],
		"licexpires" => '20991231',
		"licexpires_txt" => '31/12/2099 GMT',
		"last_edit" => 0,
		"fast_mirrors" => array('https://s1.softaculous.com/a/virtualizor',
								'https://s2.softaculous.com/a/virtualizor',
								'https://s3.softaculous.com/a/virtualizor',
								'https://s4.softaculous.com/a/virtualizor',
								'https://s7.softaculous.com/a/virtualizor')
	);
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