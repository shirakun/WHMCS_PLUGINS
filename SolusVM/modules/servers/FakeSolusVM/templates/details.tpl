<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-body">
    <i class="fa fa-4x fa-check-circle" aria-hidden="true" style="display: inline-block;float: left;margin-right: 10px;margin-top: 8px;"></i>
    <div >
    <h4 style="font-weight: 500;">感谢支持!</h4>
    <p>您的产品授权有效期到 {$nextduedate} , 您的授权已激活！授权信息如下</p>
     </div>
</div>
</div>
</div>

<div class="col-xs-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>授权密钥</label>
                    <input class="form-control" readonly value="{$license.license}">
                </div>
                <div class="form-group">
                    <label>授权IP</label>
                    <input class="form-control" readonly value="{$license.ip}">
                </div>
                <div class="alert alert-warning" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> 请把以下规则添加到 /etc/hosts </div>
                 <div class="form-group">
                    <textarea class="form-control needcount" readonly rows="{$licenseRows}">{$license.hosts}</textarea>
                </div>
            </div>
        </div>
</div>
</div>