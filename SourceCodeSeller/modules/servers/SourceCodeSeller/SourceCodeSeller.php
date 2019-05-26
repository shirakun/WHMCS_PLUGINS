<?php
/**
 * SourceCodeSeller whmcs module
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function SourceCodeSeller_MetaData()
{
    return array(
        'DisplayName' => 'SourceCodeSeller',
        'APIVersion' => '1.0',
        'RequiresServer' => false
    );
}

function SourceCodeSeller_ConfigOptions()
{
    return array();
}


function SourceCodeSeller_CreateAccount(array $params)
{

    return 'success';
}

function SourceCodeSeller_SuspendAccount(array $params)
{

    return 'success';
}

function SourceCodeSeller_UnsuspendAccount(array $params)
{

    return 'success';
}
function SourceCodeSeller_TerminateAccount(array $params)
{


    return 'success';
}


function SourceCodeSeller_ClientArea($params) {
    if($params['status'] == 'Active'){
        return array(
            'tabOverviewReplacementTemplate' => 'details.tpl',
            'templateVariables' =>  array(
                                        'params' => $params
                                    )
            );
    }else{
        return array(
            'tabOverviewReplacementTemplate' => 'error.tpl',
            'templateVariables'              => array('usefulErrorHelper' => '当前产品状态未开通，请稍后再试！')
            );
    }

}
