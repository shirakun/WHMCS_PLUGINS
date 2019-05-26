<?php
define("SupportArray",['DirectAdminExtended',
						'SolusvmExtendedCloud',
						'CpanelExtended',
						'DirectAdminLicenses',
						'OpenStackVPS',
						'DNSManager2',
						'IPManager',
						'Office365',
						'UnbanCenter',
						'SolusvmExtendedVPS',
						'ProxmoxVPS',
						'ProductLinker',
						'PremiumSupportTickets',
						'PasswordManager',
						'OVHPublicCloud',
						'ProxmoxCloud',
						'ClientAreaDesigner',
						'PleskExtended',
						'RackspaceCloud',
						'VirtuozzoVps',
						'ResellersCenter',
						'SMSCenterForWhmcs',
						'AccountSynchronization',
						'WordpressManager',
						'DiscountCenter',
						'DomainReseller',
						'DigitalOceanDroplets',
						'MultiAutoscale',
						'SolusvmExtendedReseller',
						'Ipmanager2',
						'Advancedbilling',
						'DomainOrdersExtended',
						'ClientareaPopupModule',
						'PaymentGatewayCharges'
						]);

function GetLicense($items){
	if(in_array($items['type'], SupportArray)){
		switch($items['type']){
			case "DirectAdminExtended":
				$licensing_secret_key = "43ec294cd293ec560cc51e252fc92f0ab36";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("directadmin_extended_localkey","directadmin_extended_licensekey",$license);
			break;
			case "SolusvmExtendedCloud":
				$licensing_secret_key = "aa1a75fb52224e43b9fae5224764e4580939d";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("solusvm_extended_cloud_localkey","solusvm_extended_cloud_licensekey",$license);
			break;
			case "CpanelExtended":
				$licensing_secret_key = "659c08a59bbb484f3b40591";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("cpanel_extended_localkey","cpanel_extended_licensekey",$license);
			break;
			case "DirectAdminLicenses":
				$licensing_secret_key = "f18243aed77c5704816302e7018e8ef0";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("directadmin_licenses_localkey","directadmin_licenses_licensekey",$license);
			break;
			case "OpenStackVPS":
				$licensing_secret_key = "33901de2a3089b11091e9dd5d511c03f";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("openstack_vps_localkey","openstack_vps_licensekey",$license);
			break;
			case "DNSManager2":
				$licensing_secret_key = "b810de3950edc5486cbb8fcf449c410a";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("dns_manager_localkey","dns_manager_licensekey",$license);
			break;
			case "IPManager":
				$licensing_secret_key = "40ta5a2fe65322zu520g0192e0ea147x69322c";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("ip_manager_localkey","ip_manager_licensekey",$license);
			break;
			case "Office365":
				$licensing_secret_key = "3fe794eacbb3f68aaba2867964759314";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("office_365_for_whmcs_localkey","office_365_for_whmcs_licensekey",$license);
			break;
			case "UnbanCenter":
				$licensing_secret_key = "500d9a86d58d9f21e30e75821ce4f00c";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("unban_center_localkey","unban_center_licensekey",$license);
			break;
			case "SolusvmExtendedVPS":
				$licensing_secret_key = "7b9012a73df99fb2c6ae8e523df99fb2c6ae8";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("solusvm_extended_vps_localkey","solusvm_extended_vps_licensekey",$license);
			break;
			case "ProxmoxVPS":
				$licensing_secret_key = "7b9012a73df99fb2c6ae8e523df99fb2c6ae8";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("proxmox_vps_localkey","proxmox_vps_licensekey",$license);
			break;
			case "ProductLinker":
				$licensing_secret_key = "5a22d3928108bd47045a921661b5ac21";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("product_linker_localkey","product_linker_licensekey",$license);
			break;
			case "PremiumSupportTickets":
				$licensing_secret_key = "7399c3bc726436a293c8ceed60141ed6";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("premium_support_tickets_localkey","premium_support_tickets_licensekey",$license);
			break;
			case "PasswordManager":
				$licensing_secret_key = "4bd19ebd1fa972c482663951f824b5b4";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("password_manager_localkey","password_manager_licensekey",$license);
			break;
			case "OVHPublicCloud":
				$licensing_secret_key = "f2725c8ec04faa707904c4143f28f2cc";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("ovh_public_cloud_localkey","ovh_public_cloud_licensekey",$license);
			break;
			case "ProxmoxCloud":
				$licensing_secret_key = "76919cd89191726ef64df842ba7466fc65d";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("proxmox_cloud_localkey","proxmox_cloud_licensekey",$license);
			break;
			case "ClientAreaDesigner":
				$licensing_secret_key = "7b74d33d4a2ee6e16f62ba618416123f";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("client_area_designer_localkey","client_area_designer_licensekey",$license);
			break;
			case "PleskExtended":
				$licensing_secret_key = "f573acd1cd199b6677f0306896fb85b47c6";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("plesk_extended_localkey","plesk_extended_licensekey",$license);
			break;
			case "RackspaceCloud":
				$licensing_secret_key = "701a053b1444bda444bc30089da701a053bc306a";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("rackspace_public_cloud_localkey","rackspace_public_cloud_licensekey",$license);
			break;
			case "VirtuozzoVps":
				$licensing_secret_key = "bPf6b2ce83a6eaee9d6c3cs79x6fC447Y9W4ec5b";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("virtuozzo_vps_localkey","virtuozzo_vps_licensekey",$license);
			break;
			case "ResellersCenter":
				$licensing_secret_key = "Z9c7a2f5260bXb2954113b01aed82655410b12";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("resellers_center_localkey","resellers_center_licensekey",$license);
			break;
			case "SMSCenterForWhmcs":
				$licensing_secret_key = "7b9012a73df99fb2c6ae8e523df99fb2c6ae8";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("sms_center_for_whmcs_localkey","sms_center_for_whmcs_licensekey",$license);
			break;	
			case "AccountSynchronization":
				$licensing_secret_key = "f0cd28f645facc8a12e335589fd8ace5";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("account_synchronization_localkey","account_synchronization_licensekey",$license);
			break;
			case "WordpressManager":
				$licensing_secret_key = "44ecb85776d7983c85f498a325ea6aec";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("wordpress_manager_localkey","wordpress_manager_licensekey",$license);
			break;
			case "DiscountCenter":
				$licensing_secret_key = "c6380847f2b24c53866cde427328b383";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("discount_center_localkey","discount_center_licensekey",$license);
			break;
			case "DomainReseller":
				$licensing_secret_key = "12f3aYeS6E466ceGTcd2f1d9bCced5ceGTbGTbbdU8855";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("domain_reseller_localkey","domain_reseller_licensekey",$license);
			break;
			case "DigitalOceanDroplets":
				$licensing_secret_key = "3709da6e417fae0b6002fe5e03ed1548";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("digitalocean_droplets_localkey","digitalocean_droplets_licensekey",$license);
			break;
			case "MultiAutoscale":
				$licensing_secret_key = "f83f16ce12b67d3da2657da4a6c12878";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("multi_autoscale_localkey","multi_autoscale_licensekey",$license);
			break;
			case "SolusvmExtendedReseller":
				$licensing_secret_key = "499bb8dbfa53a324b0109c817fac88bb013a3";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("solusvm_extended_reseller_localkey","solusvm_extended_reseller_licensekey",$license);
			break;
			case "Ipmanager2":
				$licensing_secret_key = "40ta5a2fe65322zu520g0192e0ea147x69322c";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("ipmanager2_localkey","ipmanager2_licensekey",$license);
			case "Advancedbilling":
				$licensing_secret_key = "65bbb959484fbbb3b40591c08a";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("advanced_billing_localkey","advanced_billing_licensekey",$license);
			break;
			case "DomainOrdersExtended":
				$licensing_secret_key = "ecc41f36d9827fb628b53aa33360f0e3";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("domain_orders_extended_localkey","domain_orders_extended_licensekey",$license);
			break;
			case "ClientareaPopupModule":
				$licensing_secret_key = "7c14c7e8d0c41917bd9999f4324c1d93";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("client_area_popup_localkey","client_area_popup_licensekey",$license);
			break;
			case "PaymentGatewayCharges":
				$licensing_secret_key = "a664vade6E75obdee6379ffda514xd53809f";
				$license = CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
				GetPHP("payment_gateway_charges_localkey","payment_gateway_charges_licensekey",$license);
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

function GetPHP($localkeyname,$licensename,$license){
	echo('<p>请在license.php中写入如下内容：</p>');
	echo('php前缀<br>');
	echo('use WHMCS\Database\Capsule;<br>');
	echo('$'.$licensename.' = "'.$license.'";<br>');
	echo("\$result = Capsule::table('tblconfiguration')->where('setting', '".$localkeyname."')->first();<br>");
	echo('if(!$result){<br>');
	echo("Capsule::table('tblconfiguration')->insert(['setting' => '".$localkeyname."', 'value' => $".$licensename."]);<br>");
	echo('}else{<br>');
	echo("Capsule::table('tblconfiguration')->where('setting', '".$localkeyname."')->update(['value' => $".$licensename."]);<br>");
	echo('}');
}

function CalcLicense($secret,$domain,$ip,$dir){
	$licensing_secret_key = $secret;
	$check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensing_secret_key);
	$results["status"] = "Active";
	$results["description"] = "Nulled By Suzume";
	$results["checkdate"] = "20991231";
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