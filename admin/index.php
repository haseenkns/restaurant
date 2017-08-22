<?php
ob_start();
session_start();
include("../configuration/connect.php");
include("../configuration/functions.php");
if(isset($_POST['submit']))
	{
		$email=mysql_real_escape_string($_POST['username']);
		$apwd=mysql_real_escape_string($_POST['password']);
		$admres=mysql_query("select * from `admin` where `username`='$email' and `password`='$apwd' ");
		if(mysql_num_rows($admres)>0)
		{
		    $adm=mysql_fetch_row($admres);
			$aid=$adm[0];
			$skey=$adm[7];
			//die;
			$_SESSION['aid']=$aid;
			$_SESSION['type']=$skey;
			setcookie('username',$_POST['username'],time()+3600*240);
			$logindate=date("d F, Y h:i A");
			$admres=mysql_query("update `admin` set `last_login`='$logindate' where `id` = '$aid'");
			if($skey==1){
				header("location:dashboard.php");
			}else{
				header("location:home.php");	
			}
		}
		else
		{
		    header("location:index.php?msg=inf");
			//$msg=" * Login Fail ! Please try again!";
		}
	}

if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
	<!--=== CSS ===-->
	<!-- Bootstrap -->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme -->
	<link href="../assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
	<!-- Login -->
	<link href="../assets/css/login.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="../assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Beautiful Checkboxes -->
	<script type="text/javascript" src="../plugins/uniform/jquery.uniform.min.js"></script>

	<!-- Form Validation -->
	<script type="text/javascript" src="../plugins/validation/jquery.validate.min.js"></script>

	<!-- Slim Progress Bars -->
	<script type="text/javascript" src="../plugins/nprogress/nprogress.js"></script>

	<!-- App -->
	<script type="text/javascript" src="../assets/js/login.js"></script>
	<script>
	$(document).ready(function(){
		"use strict";

		Login.init(); // Init login JavaScript
	});
	</script>
    
    
</head>

<body class="login"  style="background:#f9f9f9 center center no-repeat;">
	<!-- Logo -->
	<div class="logo" style="font-size:32px; color:#0174B1;">
	<!--	<img src="images/logomain.png" alt="logo" />-->
		<span><span style="color:#E85959;font-weight:normal;">Wild Pita Admin</span></span>&nbsp;
        <span style="font-size:12px;color:#999;">(beta)</span><br>
        <span style="font-size:13px;font-style:italic;">`manage all with ease`</span>
	</div>
	<!-- /Logo -->

	<!-- Login Box -->
	<div class="box" >
		<div class="content">
			<!-- Login Formular -->
			<form class="form-vertical login-form" action="" method="post" id="loginform">
				<!-- Title -->
				<h3 class="form-title">Sign In to your Account</h3>

				<!-- Error Message -->
				<div class="alert fade in alert-danger"  <?php if($msg=='inf'){ ?> style="display: block;"  <?php }  else{ ?> style="display: none;" <?php } ?>>
					<i class="icon-remove close" data-dismiss="alert"></i>
					Wrong username or password.
					</div>

				<!-- Input Fields -->
				<div class="form-group">
					<!--<label for="username">Username:</label>-->
					<div class="input-icon">
						<i class="icon-user"></i>
						<input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus="autofocus" data-rule-required="true" data-msg-required="Please enter your username." />
					</div>
				</div>
				<div class="form-group">
					<!--<label for="password">Password:</label>-->
					<div class="input-icon">
						<i class="icon-lock"></i>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" data-rule-required="true" data-msg-required="Please enter your password." />
					</div>
				</div>
				<!-- /Input Fields -->

				<!-- Form Actions -->
				<div class="form-actions">
					<label  style="margin-top:15px;font-size:11px;color:#666666;padding:0px;font-weight:normal;"> <?php echo date(" l, d M, Y "); ?></label>
					<button type="submit" name="submit" class="submit btn btn-primary pull-right">
						Sign In &nbsp;&nbsp;<i class="icon-angle-right"></i>
					</button>
				</div>
			</form>
			<!-- /Login Formular -->

		</div> <!-- /.content -->

		<!-- Forgot Password Form -->
		<div class="inner-box">
			<div class="content">
				<!-- Close Button -->
				<i class="icon-remove close hide-default"></i>

				<!-- Link as Toggle Button -->
				<a href="#" class="forgot-password-link">Forgot Password?</a>

				<!-- Forgot Password Formular -->
				<form class="form-vertical forgot-password-form hide-default" action="" method="post">
					<!-- Input Fields -->
					<div class="form-group">
						<!--<label for="email">Email:</label>-->
						<div class="input-icon">
							<i class="icon-envelope"></i>
							<input type="text" name="email" id="email" class="form-control" placeholder="Enter registered email address" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email." />
						</div>
					</div>
					<!-- /Input Fields -->

					<button type="submit" class="submit btn btn-default btn-block">
						Reset your Password
					</button>
				</form>
				<!-- /Forgot Password Formular -->

				<!-- Shows up if reset-button was clicked -->
				<div class="forgot-password-done hide-default">
					<i class="icon-ok success-icon"></i> <!-- Error-Alternative: <i class="icon-remove danger-icon"></i> -->
					<span>Great. We have sent you an email.</span>
				</div>
			</div> <!-- /.content -->
		</div>
		<!-- /Forgot Password Form -->
	</div>
	<!-- /Login Box -->

	<!-- Single-Sign-On (SSO) -->
	<!--<div class="single-sign-on">
		<span>or</span>

		<button class="btn btn-facebook btn-block">
			<i class="icon-facebook"></i> Sign in with Facebook
		</button>

		<button class="btn btn-twitter btn-block">
			<i class="icon-twitter"></i> Sign in with Twitter
		</button>

		<button class="btn btn-google-plus btn-block">
			<i class="icon-google-plus"></i> Sign in with Google
		</button>
	</div>-->
	<!-- /Single-Sign-On (SSO) -->

	<!-- Footer -->
	<!--<div class="footer">
		<a href="#" class="sign-up">Don't have an account yet? <strong>Sign Up</strong></a>
	</div>-->
	<!-- /Footer -->
</body>
</html>