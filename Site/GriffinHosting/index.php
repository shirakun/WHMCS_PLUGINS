<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
	<title>GriffinHosting授权生成器</title>
	
	<link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">

	<link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="../libs/bower/fullcalendar/dist/fullcalendar.min.css">
	<link rel="stylesheet" href="../libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/css/core.css">
	<link rel="stylesheet" href="../assets/css/app.css">

	<script src="../libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
	<script>
		Breakpoints();
	</script>
</head>
	
<body class="menubar-left menubar-unfold menubar-light theme-primary">

<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">
  
  <div class="navbar-header">

    <a href="https://tools.loli.ren" class="navbar-brand">
      <span class="brand-icon"><i class="fa fa-gg"></i></span>
      <span class="brand-name">授权生成器</span>
    </a>
  </div>
  
  <div class="navbar-container container-fluid">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
        <li class="hidden-float hidden-menubar-top">
          <a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
          </a>
        </li>
        <li>
          <h5 class="page-title hidden-menubar-top hidden-float">Dashboard</h5>
        </li>
      </ul>

    </div>
  </div>
</nav>

<aside id="menubar" class="menubar light">

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
        
        <li>
          <a href="/">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">暂无</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</aside>

<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-12">
				<div class="widget row no-gutter p-lg">						
					<div class="col-md-12 col-sm-12">
						<div>
							<h3 class="widget-title fz-lg text-primary m-b-lg">GriffinHosting授权生成器</h3>
							<p class="m-b-lg">我就是买不起正版QAQ！</p>
						</div>
					</div>
				</div><!-- .widget -->	
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-md-12">
				<div class="widget widget-pie-chart">
					<header class="widget-header">
						<h4 class="widget-title">授权生成</h4>
					</header>
					<hr class="widget-separator"/>
					<div class="widget-body clearfix">
						<?php
						require ("functions.php");
						if(isset($_POST['domain']) && isset($_POST['vaip']) && isset($_POST['vadir']) && isset($_POST['type'])){
							if($_POST['domain'] != "" && $_POST['vaip'] != "" && $_POST['vadir'] != "" && $_POST['type'] != ""){
								GetLicense($_POST);
							}else{
								echo('<p>数据异常！</p>');
							}
							echo('<hr><br><a href="index.php"><button class="btn btn-primary btn-md">返回主页</button></a></br>');
						}else{
							echo('
							<p>注意！这三项必须填写正确！</p>
							<p>路径为类似<strong>/www/wwwroot/whmcs/modules/servers/directadminExtended</strong>的绝对路径！</p>
							<p>或者为类似<strong>/www/wwwroot/whmcs/modules/addons/PasswordManager</strong>的绝对路径！</p>
							<P>如果不清楚的话，可以直接将如下保存进license.php然后查看输出</p>
							<P>php前缀</p>
							<P>var_dump($_SERVER["SERVER_NAME"]);</p>
							<P>var_dump((isset($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_ADDR"] : $_SERVER["LOCAL_ADDR"]));</p>
							<P>var_dump(dirname(__FILE__));</p>
							<hr>
							<form method="post" action="index.php" role="form">

								<div class="form-group">
									<select name="type" id="type" class="form-control">
									'.GetSelect().'
									</select>
								</div>

								<div class="form-group">
									<input type="text" name="domain" id="domain" value="" class="form-control" placeholder="请输入授权域名(多个用,分隔)">
								</div>

								<div class="form-group">
									<input type="text" name="vaip" id="vaip" value="" class="form-control" placeholder="请输入授权IP(多个用,分隔)">
								</div>


								<div class="form-group">
									<input type="text" name="vadir" id="vadir" value="" class="form-control" placeholder="请输入授权路径(多个用,分隔)">
								</div>

								<div class="form-group text-center">
									<input class="btn btn-block btn-primary" type="submit" value="生成！" tabindex="15"/>
								</div>
							</form>');
						}
						?>
					</div>
				</div>
			</div>
		</div>

	</section>
</div>
  <div class="wrap p-t-0">
    <footer class="app-footer">
      <div class="clearfix">
        <div class="copyright pull-left">Copyright 2018 &copy;</div>
      </div>
    </footer>
  </div>
</main>
	

	<script src="../libs/bower/jquery/dist/jquery.js"></script>
	<script src="../libs/bower/jquery-ui/jquery-ui.min.js"></script>
	<script src="../libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
	<script src="../libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
	<script src="../libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="../libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="../libs/bower/PACE/pace.min.js"></script>

	<script src="../assets/js/library.js"></script>
	<script src="../assets/js/plugins.js"></script>
	<script src="../assets/js/app.js"></script>

	<script src="../libs/bower/moment/moment.js"></script>
	<script src="../libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="../assets/js/fullcalendar.js"></script>
</body>
</html>