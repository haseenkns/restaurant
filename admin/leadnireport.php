<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$team=displayteam($adminId);
array_push($team,$adminId);

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
//$total=getTotalLeadsByDateAndId($curMonth,$curYear,$adminId);

if(isset($_GET['syear'])){
	$syear=	$_GET['syear'];
}else{
	$syear=$curYear;	
}


$totalSalesReport=getGraphicalTotalSaleReport($team,$curYear);
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
						<h3>Sales report </h3>
						<span>For <?php echo date(" Y") ?></span>
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-8">
						<div class="widget box">
							<div class="widget-header">Sales Report</div>
							<div class="widget-content">
                            <table width="100%" border="0" cellspacing="5" cellpadding="6">
  <tr>
    <td>Month</td>
    <?php foreach($getMonthArr as $month){ ?><td align="center"><?php echo $month ?></td><?php } ?>
  </tr>
  <tr>
    <td>No of Sales</td>
    <?php foreach($getMonthArr as $month=>$value){ 
	$month=$month+1;
	if($month<9){
		$month="0".$month;
	}
	
	?><td align="center"><a href="fullsalesreport.php?month=<?php echo $month ?>&year=<?php echo $curYear ?>"><?php echo getNICountByDateAndId($month,$curYear,$team); ?></a></td><?php } ?>
  </tr>
 
</table>

                            
                            
                            </div>
						</div>
					</div> <!-- /.col-md-12 -->
                    
                    <div class="col-md-4">
						<div class="widget box">
							<div class="widget-header">
                            
                            <div class="row">
                            <div class="col-md-6"><h4><i class="icon-reorder"></i>Sales</h4></div>
                             <div class="col-md-6"  style="text-align:right;"><select class="form" style="border:0px" id="salesyear">
                                 <?php
								 for($year=2014;$year<=date("Y");$year++){
								 ?>
                                	 <option value="<?php echo $year; ?>" <?php if($curYear==$year) {?> selected <?php } ?>><?php echo $year; ?></option>
                                  <?php } ?>   
                                     
                            	 </select>&nbsp;&nbsp;
                                 <span class="label label-primary" style="cursor:pointer;" onClick="showsalesByDate(document.getElementById('salesyear').value)">Change</span></div>
                            </div>
                            
								
                                
                                
                                
							</div>
							<div class="widget-content">
								<p><div>
									<canvas id="canvasline" height="180" width="300"></canvas>
								</div></p>
							</div>
						</div>
					</div>
					<!-- /Example Box -->
				</div>
                
              
			</div>
			<!-- /.container -->

		</div>
	</div>
    
    <script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
			datasets : [
				{
					label: "Sales Report",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(72,138,227,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					//data : [52,25,25,63,56,70,30,68,45,90,25,45]
					data:[<?php echo $impReport; ?>]
				}
			]

		}

	


	</script>
<script>

	

				window.onload = function(){
				
				// move the first 'onload' function to here.
				var ctx2 = document.getElementById("canvasline").getContext("2d");
				window.myLine = new Chart(ctx2).Line(lineChartData);
				
				};



	</script>
    
    
</body>
</html>