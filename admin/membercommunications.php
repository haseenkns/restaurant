<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$title='Success !!';
		$class='successmsg';
		$content="Welcome mail has been send successfully.";
	break;
	
	case 'inf':
		$title='UnSuccess !!';
		$class='errormsg';
		$content="Due to some technical issues,mail not send successfully.Please try again later";
	break;
	case 'ups':
		$msg='Data updated Successfully !!';
		$class='successmsg';
	break;
	
	case 'upf':
		$msg='Data not updated Successfully !!';
		$class='errormsg';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='successmsg';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='errormsg';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>

	</head>

<body class="theme-dark">

	<!-- Header -->
	<?php include_once("header.php"); ?> <!-- /.header -->

	<div id="container">
		<?php include_once("leftmenu.php"); ?>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<?php include_once("crumb.php"); ?>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Member Communications</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Members</h4>
							</div>
							<div class="widget-content">
								<p>
                                
					                <div class="col-md-3">
								<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Welcome Email</h4>
							</div>
							<div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="welcomemaillist.php">Click To Send Welcome Email</a>
                        	
                        
                        
                        
                        </div>
							</div>
						</div>
                                </div>
                                
                                
                                <div class="col-md-3">
								<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Welcome Letter</h4>
							</div>
							<div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="welcomeletterlist.php">Click To Print Welcome Letter</a>
                        	
                        
                        
                        
                        </div>
							</div>
						</div>
                                </div>
                                   <div class="col-md-3">
								<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Courier details</h4>
							</div>
							<div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="javascript:void(0)" onClick="alert('coming soon')">Send Courier Details To Members</a>
                        	
                        
                        
                        
                        </div>
							</div>
						</div>
                                </div>
                                   <div class="col-md-3">
								<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Birthdays & Anniversary</h4>
							</div>
							<div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="bdays.php">View Birthday And Anniversaries </a>
                        	
                        
                        
                        
                        </div>
							</div>
						</div>
                                </div>
                                   
                                <div class="col-md-3">
								<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Post Pack</h4>
							</div>
							<div class="widget-content">
								<div style="min-height:30px;" >
      			                  <a href="postpackreport.php">View Post pack calling list</a>
                        
                        </div>
							</div>
						</div>
                                </div>
                                <div style="clear:both"></div>
                                
                                </p>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>