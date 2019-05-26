<h3>您的基本信息</h3>
<span><h5>您选择的插件: {$info.type}</h5></span>
<span><h5>授权到期时间: {$nextduedatee}</h5></span>
<span><h5>您的域名: {$info.domain}</h5></span>
<span><h5>您的IP: {$info.vaip}</h5></span>
<span><h5>您的插件路径: {$info.vadir}</h5></span>
</hr>
<h3>您的授权信息</h3>
<h4>请在license.php中写入如下内容：</h4>
&lt;?php<br>
use WHMCS\Database\Capsule;<br>
${$returnvalue.licensename} = '{$returnvalue.license}';<br>
$result = Capsule::table('tblconfiguration')->where('setting', '{$returnvalue.localkeyname}')->first();<br>
{literal}if(!$result){<br>{/literal}
    Capsule::table('tblconfiguration')->insert(['setting' => '{$returnvalue.localkeyname}', 'value' => ${$returnvalue.licensename}]);<br>
{literal} }else{ {/literal}<br>
    Capsule::table('tblconfiguration')->where('setting', '{$returnvalue.localkeyname}')->update(['value' => ${$returnvalue.licensename}]);<br>
{literal}
}
{/literal}
