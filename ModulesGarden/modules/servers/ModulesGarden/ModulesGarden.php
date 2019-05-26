<?php
/**
 * ModulesGarden whmcs module
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function ModulesGarden_MetaData()
{
    return array(
        'DisplayName' => 'ModulesGarden',
        'APIVersion' => '1.0',
        'RequiresServer' => false
    );
}

function ModulesGarden_ConfigOptions()
{
    return array();
}


function ModulesGarden_CreateAccount(array $params)
{

    return 'success';
}

function ModulesGarden_SuspendAccount(array $params)
{

    return 'success';
}

function ModulesGarden_UnsuspendAccount(array $params)
{

    return 'success';
}
function ModulesGarden_TerminateAccount(array $params)
{


    return 'success';
}


function ModulesGarden_ClientArea($params) {
    $info = array(
                'type' => $params['customfields']['选择插件'],
                'domain' => $params['customfields']['输入域名'],
                'vaip' => $params['customfields']['输入IP'],
                'vadir' => $params['customfields']['输入插件路径'],
            );
    $license = ModulesGarden_GetLicense($info);
    if(is_array($license)){
        return array(
            'tabOverviewReplacementTemplate' => 'details.tpl',
            'templateVariables' =>  array(
                                        'params' => $params,
                                        'info' => $info,
                                        'returnvalue' => $license
                                    )
            );
    }else{
        return array(
            'tabOverviewReplacementTemplate' => 'error.tpl',
            'templateVariables'              => array('usefulErrorHelper' => $license)
            );
    }

}


function ModulesGarden_GetLicense($items){
    switch(preg_replace('# #','',trim($items['type']))){
        case "DirectAdminExtended":
            $licensing_secret_key = "43ec294cd293ec560cc51e252fc92f0ab36";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("directadmin_extended_localkey","directadmin_extended_licensekey",$license);
            break;
        case "SolusvmExtendedCloud":
            $licensing_secret_key = "aa1a75fb52224e43b9fae5224764e4580939d";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("solusvm_extended_cloud_localkey","solusvm_extended_cloud_licensekey",$license);
            break;
        case "CpanelExtended":
            $licensing_secret_key = "659c08a59bbb484f3b40591";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("cpanel_extended_localkey","cpanel_extended_licensekey",$license);
            break;
        case "DirectAdminLicenses":
            $licensing_secret_key = "f18243aed77c5704816302e7018e8ef0";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("directadmin_licenses_localkey","directadmin_licenses_licensekey",$license);
            break;
        case "OpenStackVPS":
            $licensing_secret_key = "33901de2a3089b11091e9dd5d511c03f";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("openstack_vps_localkey","openstack_vps_licensekey",$license);
            break;
        case "DNSManager2":
            $licensing_secret_key = "b810de3950edc5486cbb8fcf449c410a";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("dns_manager_localkey","dns_manager_licensekey",$license);
            break;
        case "IPManager":
            $licensing_secret_key = "40ta5a2fe65322zu520g0192e0ea147x69322c";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("ip_manager_localkey","ip_manager_licensekey",$license);
            break;
        case "Office365":
            $licensing_secret_key = "3fe794eacbb3f68aaba2867964759314";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("office_365_for_whmcs_localkey","office_365_for_whmcs_licensekey",$license);
            break;
        case "UnbanCenter":
            $licensing_secret_key = "500d9a86d58d9f21e30e75821ce4f00c";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("unban_center_localkey","unban_center_licensekey",$license);
            break;
        case "SolusvmExtendedVPS":
            $licensing_secret_key = "7b9012a73df99fb2c6ae8e523df99fb2c6ae8";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("solusvm_extended_vps_localkey","solusvm_extended_vps_licensekey",$license);
            break;
        case "ProxmoxVPS":
            $licensing_secret_key = "7b9012a73df99fb2c6ae8e523df99fb2c6ae8";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("proxmox_vps_localkey","proxmox_vps_licensekey",$license);
            break;
        case "ProductLinker":
            $licensing_secret_key = "5a22d3928108bd47045a921661b5ac21";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("product_linker_localkey","product_linker_licensekey",$license);
            break;
        case "PremiumSupportTickets":
            $licensing_secret_key = "7399c3bc726436a293c8ceed60141ed6";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("premium_support_tickets_localkey","premium_support_tickets_licensekey",$license);
            break;
        case "PasswordManager":
            $licensing_secret_key = "4bd19ebd1fa972c482663951f824b5b4";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("password_manager_localkey","password_manager_licensekey",$license);
            break;
        case "OVHPublicCloud":
            $licensing_secret_key = "f2725c8ec04faa707904c4143f28f2cc";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("ovh_public_cloud_localkey","ovh_public_cloud_licensekey",$license);
            break;
        case "ProxmoxCloud":
            $licensing_secret_key = "76919cd89191726ef64df842ba7466fc65d";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("proxmox_cloud_localkey","proxmox_cloud_licensekey",$license);
            break;
        case "ClientAreaDesigner":
            $licensing_secret_key = "7b74d33d4a2ee6e16f62ba618416123f";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("client_area_designer_localkey","client_area_designer_licensekey",$license);
            break;
        case "PleskExtended":
            $licensing_secret_key = "f573acd1cd199b6677f0306896fb85b47c6";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("plesk_extended_localkey","plesk_extended_licensekey",$license);
            break;
        case "RackspaceCloud":
            $licensing_secret_key = "701a053b1444bda444bc30089da701a053bc306a";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("rackspace_public_cloud_localkey","rackspace_public_cloud_licensekey",$license);
            break;
        case "VirtuozzoVps":
            $licensing_secret_key = "bPf6b2ce83a6eaee9d6c3cs79x6fC447Y9W4ec5b";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("virtuozzo_vps_localkey","virtuozzo_vps_licensekey",$license);
            break;
        case "ResellersCenter":
            $licensing_secret_key = "Z9c7a2f5260bXb2954113b01aed82655410b12";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("resellers_center_localkey","resellers_center_licensekey",$license);
            break;
        case "SMSCenterForWhmcs":
            $licensing_secret_key = "7b9012a73df99fb2c6ae8e523df99fb2c6ae8";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("sms_center_for_whmcs_localkey","sms_center_for_whmcs_licensekey",$license);
            break;  
        case "AccountSynchronization":
            $licensing_secret_key = "f0cd28f645facc8a12e335589fd8ace5";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("account_synchronization_localkey","account_synchronization_licensekey",$license);
            break;
        case "WordpressManager":
            $licensing_secret_key = "44ecb85776d7983c85f498a325ea6aec";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("wordpress_manager_localkey","wordpress_manager_licensekey",$license);
            break;
        case "DiscountCenter":
            $licensing_secret_key = "c6380847f2b24c53866cde427328b383";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("discount_center_localkey","discount_center_licensekey",$license);
            break;
        case "DomainReseller":
            $licensing_secret_key = "12f3aYeS6E466ceGTcd2f1d9bCced5ceGTbGTbbdU8855";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("domain_reseller_localkey","domain_reseller_licensekey",$license);
            break;
        case "DigitalOceanDroplets":
            $licensing_secret_key = "3709da6e417fae0b6002fe5e03ed1548";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("digitalocean_droplets_localkey","digitalocean_droplets_licensekey",$license);
            break;
        case "MultiAutoscale":
            $licensing_secret_key = "f83f16ce12b67d3da2657da4a6c12878";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("multi_autoscale_localkey","multi_autoscale_licensekey",$license);
            break;
        case "SolusvmExtendedReseller":
            $licensing_secret_key = "499bb8dbfa53a324b0109c817fac88bb013a3";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("solusvm_extended_reseller_localkey","solusvm_extended_reseller_licensekey",$license);
            break;
        case "Ipmanager2":
            $licensing_secret_key = "40ta5a2fe65322zu520g0192e0ea147x69322c";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("ipmanager2_localkey","ipmanager2_licensekey",$license);
            break;
        case "Advancedbilling":
            $licensing_secret_key = "65bbb959484fbbb3b40591c08a";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("advanced_billing_localkey","advanced_billing_licensekey",$license);
            break;
        case "DomainOrdersExtended":
            $licensing_secret_key = "ecc41f36d9827fb628b53aa33360f0e3";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("domain_orders_extended_localkey","domain_orders_extended_licensekey",$license);
            break;
        case "ClientareaPopupModule":
            $licensing_secret_key = "7c14c7e8d0c41917bd9999f4324c1d93";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("client_area_popup_localkey","client_area_popup_licensekey",$license);
            break;
        case "PaymentGatewayCharges":
            $licensing_secret_key = "a664vade6E75obdee6379ffda514xd53809f";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("payment_gateway_charges_localkey","payment_gateway_charges_licensekey",$license);
            break;
        case "HostingRenewals":
            $licensing_secret_key = "634a49X9c311e8c99EaZdW1b010b94783db5d";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("hosting_renewals_localkey","hosting_renewals_licensekey",$license);
            break;
        case "EmojiPicker":
            $licensing_secret_key = "e2203c5680ba1005434909b813487c62";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("emoji_picker_localkey","emoji_picker_licensekey",$license);
            break;
        case "Multibrand":
            $licensing_secret_key = "90fbba684f07387371a2c3d40980b76e";
            $license = ModulesGarden_CalcLicense($licensing_secret_key,$items['domain'],$items['vaip'],$items['vadir']);
            return ModulesGarden_GetPHP("multibrand_localkey","multibrand_licensekey",$license);
            break;
        default:
            return($items['type'].' 类型不存在!');
        break;
    }
}

function ModulesGarden_GetPHP($localkeyname,$licensename,$license){
    $returnvalue =  array(
                        'localkeyname' => $localkeyname,
                        'licensename'  => $licensename,
                        'license'      => $license
                    );
    return $returnvalue;
}

function ModulesGarden_CalcLicense($secret,$domain,$ip,$dir){
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