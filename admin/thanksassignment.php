<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
	
	if(isset($_GET['id'])&&$_GET['id']!=''){	
	$id=base64_decode($_GET['id']);
	
	$assignArr=getAssignedLeadDetailsById($id);
	
	$lid=$assignArr[1];
	
	$empId=$assignArr[2];
	
	$empName=getEmployeeNameById($empId);
	
	$laedCode=getLeadId($lid);
	}
	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$title='Success !!';
		$class='successmsg';
		$content="Lead  <strong>$laedCode</strong> has been successfully assigned to <span style='color:#E85858;paddin-bottom:5px;border-bottom:dotted 1px #ccc'>$empName</span>  ";
	break;
	
	case 'inf':
		$title='UnSuccess !!';
		$class='errormsg';
		$content="Due to some technical issues,lead cannot be assigned successfully.Please try again later";
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
						<h3>Lead Status</h3>
						<span>&laquo;&nbsp;<a href="addleads.php">Go Back To Add Leads</a></span>
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
								<h4><i class="icon-reorder"></i> <?php echo $title; ?></h4>
							</div>
							<div class="widget-content">
								<p style="font-size:18px;line-height:32px;font-weight:normal;text-align:center;"><?php echo $content; ?></p>
                                <p style="font-size:13px;line-height:32px;font-weight:normal;text-align:center;"><a href="viewassignleads.php" style="color:#0099CC;paddin-bottom:5px;border-bottom:dotted 1px #ccc;text-decoration:none;">View Lead Assignments </a>&nbsp;&nbsp;&nbsp;&nbsp;  <a href="assignleads.php" style="color:#0099CC;paddin-bottom:5px;border-bottom:dotted 1px #ccc;text-decoration:none">Assign More Leads</a></p>
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