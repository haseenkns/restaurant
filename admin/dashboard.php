<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);


$getMonthArr=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
$impMonth=implode(",",$getMonthArr);

if(isset($_GET['month'])&& isset($_GET['year'])){
	
	$curMonth=$_GET['month'];
	$curYear=$_GET['year'];
	if($curMonth<=9){
	$curMonth="0".$curMonth;	
	}
	
}else{
	$curMonth=date("m");
	$curYear=date("Y");	
}


$total=getTotalLeadsByDate($curMonth,$curYear);

if(isset($_GET['syear'])){
	$syear=	$_GET['syear'];
}else{
	$syear=$curYear;	
}


$totalSalesReport=getTotalSaleReportByDate($syear);
 $impReport=implode(",",$totalSalesReport);

//echo count($total);	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Data inserted Successfully !!';
		$class='successmsg';
	break;
	
	case 'inf':
		$msg='Data not inserted Successfully !!';
		$class='errormsg';
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
    <script src="charts/javascript/chart.js" type="text/javascript"></script>
    <script>
		function showLeadsByDate(month,year){
				window.location.href='home.php?month='+month+'&year='+year;	
		}
		
		function showsalesByDate(year){
				window.location.href='home.php?syear='+year;	
		}
	</script>
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
						<h3>Dashboard</h3>
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
								<h4><i class="icon-reorder"></i> Title will come here</h4>
							</div>
							<div class="widget-content">
								<p>Description here</p>
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