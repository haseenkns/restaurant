<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

$team=displayteam($adminId);
array_push($team,$adminId);
$impteam=implode(",",$team);
	$qry= " and `a_id` IN ($impteam) ";

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


$totalSalesReport=getTotalSaleReportByDateAndTeam($syear,$team);
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
	
	$todaysfollowups=getTodaysFollowupsByTeam($qry);
	$todaysMeetings=getTodaysMeetingByTeam($team);
	$unassignedLeads=getUnassignedLeadsByTeamHead($team);
	
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
                
                <div class="row" style="padding-bottom:30px;">
                <div class="col-md-4"><div class="page-title">
						<h3>Dashboard</h3>
						<span><?php echo date("M, Y") ?></span>
					</div></div>
                   <div class="col-md-8"> 
                   
                   
                    <div class="row">
                      <div class="col-md-4"><table width="100%" border="0">
  <tr>
    <td><img src="images/followups.png"></td>
  </tr>
  <tr>
    <td><a href="followupreports.php?todayfollowups" style="text-decoration:none;">(<b><?php echo $todaysfollowups; ?></b>)&nbsp;Followups Today</a></td>
  </tr>
</table>
</div>
                      <div class="col-md-4"><table width="100%" border="0">
  <tr>
    <td><img src="images/meetings.png"></td>
  </tr>
  <tr>
    <td><a href="meetingreports.php?todaysmeeting" style="text-decoration:none;">(<b><?php echo count($todaysMeetings); ?></b>)&nbsp; Meetings Today</a></td>
  </tr>
</table></div>
                    
                    <?php
					if(hasChild($adminId)){
					?>
                      <div class="col-md-4"> 
                       <table width="100%" border="0">
  <tr>
    <td><img src="images/unassigned.png"></td>
  </tr>
  <tr>
    <td><a href="assignleads.php" style="text-decoration:none;color:#F00;">(<b><?php echo count($unassignedLeads); ?></b>)&nbsp;Unassigned Leads</a></td>
  </tr>
</table> 
					  </div>
                      
                      <?php } ?>
                    
                    </div>
                   
                   
                   
                   </div>
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
                            <div class="row">
                            <div class="col-md-6">
                           	 <h4><i class="icon-reorder"></i> Sales Report</h4>
                            </div>
                            
                            <!--<div class="col-md-6"  style="text-align:right;">
                           	 <i class="icon-reorder"></i> 
                           		  <select class="form" style="border:0px" id="monthlead">
                                  <?php
								  foreach($getMonthArr as $index=>$month){
								  ?>
                               		  <option value="<?php echo $index+1; ?>" <?php if($curMonth==($index+1)) {?> selected <?php } ?> ><?php echo $month ?></option>
                                      
                                  <?php } ?>    
                                 </select>&nbsp;&nbsp;
                                 
                                 <select class="form" style="border:0px" id="yearlead">
                                 <?php
								 for($year=2014;$year<=date("Y");$year++){
								 ?>
                                	 <option value="<?php echo $year; ?>" <?php if($curYear==$year) {?> selected <?php } ?>><?php echo $year; ?></option>
                                  <?php } ?>   
                                     
                            	 </select>&nbsp;&nbsp;
                                 <span class="label label-primary" style="cursor:pointer;" onClick="showLeadsByDate(document.getElementById('monthlead').value,document.getElementById('yearlead').value)">Check</span>
                                 
                            </div>-->
                            </div>
                            </div>
							<div class="widget-content">
                            <div class="row">
                                <div class="col-md-12">
                                
                                <table width="100%" border="0" class="table datatable" cellspacing="0" cellpadding="2">
  <tr>
    <td>Month</td>
    <?php foreach($getMonthArr as $month){ ?><td align="center" style="font-weight:bold;"><?php echo $month ?></td><?php } ?>
  </tr>
  
     <tr><td colspan="13" style="border-bottom:dotted 1px #CCCCCC" height="2px"></td></tr>
  <tr>
    <td>No of Sales</td>
    <?php foreach($getMonthArr as $month=>$value){ 
	$month=$month+1;
	if($month<9){
		$month="0".$month;
	}
	
	?><td align="center"><a href="fullsalesreport.php?month=<?php echo $month ?>&year=<?php echo $curYear ?>"><?php echo getSalesCountByDateAndId($month,$curYear,$team); ?></a></td><?php } ?>
  </tr>
  
   <tr><td colspan="13" style="border-bottom:dotted 1px #CCCCCC" height="2px"></td></tr>
 	 <tr>
    <td>Sales (Rs)</td>
    <?php foreach($getMonthArr as $month=>$value){
		$month=$month+1;
		if($month<9){
			$month="0".$month;
		}
		
		 $salesids=getSalesByDateAndId($month,$curYear,$team);
		// print_r($salesids);
		 $totalSale=getTotalProposedAmtBYSalesLid($salesids);
		 
		 ?><td align="center"><a href="fullsalesreport.php?month=<?php echo $month ?>&year=<?php echo $curYear ?>"><?php echo $totalSale; ?></a></td><?php } ?>
  </tr>
   <tr><td colspan="13" style="border-bottom:dotted 1px #CCCCCC" height="2px"></td></tr>

  <tr>
    <td>Receivings</td>
    <?php foreach($getMonthArr as $month=>$value){
		$month=$month+1;
		if($month<9){
			$month="0".$month;
		}
		
		 $leadsids=getLeadsByTeamByDate($team);
		 $totalReceipt=getPaymentRecvByDateAndId($month,$curYear,$leadsids);
		 
		 ?><td align="center"><a href="fullreceivingreport.php?month=<?php echo $month ?>&year=<?php echo $curYear ?>"><?php echo $totalReceipt; ?></a></td><?php } ?>
  </tr>
</table>
                                
                                </div>
                            
                            
                            </div>
                            
								


	
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
                    
                    
					<!-- /Example Box -->
				</div>

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
                            <div class="row">
                            <div class="col-md-6">
                           	 <h4><i class="icon-reorder"></i> Lead Status</h4>
                            </div>
                            
                            <div class="col-md-6"  style="text-align:right;">
                           	 <i class="icon-reorder"></i> 
                           		  <select class="form" style="border:0px" id="monthlead">
                                  <?php
								  foreach($getMonthArr as $index=>$month){
								  ?>
                               		  <option value="<?php echo $index+1; ?>" <?php if($curMonth==($index+1)) {?> selected <?php } ?> ><?php echo $month ?></option>
                                      
                                  <?php } ?>    
                                 </select>&nbsp;&nbsp;
                                 
                                 <select class="form" style="border:0px" id="yearlead">
                                 <?php
								 for($year=2014;$year<=date("Y");$year++){
								 ?>
                                	 <option value="<?php echo $year; ?>" <?php if($curYear==$year) {?> selected <?php } ?>><?php echo $year; ?></option>
                                  <?php } ?>   
                                     
                            	 </select>&nbsp;&nbsp;
                                 <span class="label label-primary" style="cursor:pointer;" onClick="showLeadsByDate(document.getElementById('monthlead').value,document.getElementById('yearlead').value)">Check</span>
                                 
                            </div>
                            </div>
								
							
                            
                            </div>
							<div class="widget-content">
                            <div class="row">
                            <div class="col-md-8"><div id="canvas-holder">
									<canvas id="chart-area" width="300" height="300"/>
								</div>
                            </div>
                            
                            <div class="col-md-4">
                          <?php
						 	 $totalFollowups=getFollowCountByDateAndId($curMonth,$curYear,$team);
							 $totalMeetings=getMeetingCountByDateAndId($curMonth,$curYear,$team);
							 $totalSales=getSalesCountByDateAndId($curMonth,$curYear,$team);
							 $totalNi=getNICountByDateAndId($curMonth,$curYear,$team);
							 $grandTotal= $totalFollowups+$totalMeetings+$totalSales+$totalNi;
						  ?>  
                            
                          			  <table width="100%" border="0" cellpadding="4px" cellspacing="2px;">
  <tr>
    <td><div style="width:15px;height:15px;background-color:#D9D900;border-radius:5px;"></div></td>
    <td><a href="followupreports.php" style="font-weight:bold;">Followups</a></td>
     <td><?php echo $totalFollowups; ?></td>
  </tr>
  <tr>
    <td><div style="width:15px;height:15px;background-color:#46BFBD;border-radius:5px;"></div></td>
    <td><a href="meetingreports.php" style="font-weight:bold;">Meetings</a></td>
     <td><?php echo  $totalMeetings; ?></td>
  </tr>
  <tr>
    <td><div style="width:15px;height:15px;background-color:#00A400;border-radius:5px;"></div></td>
    <td><a href="leadsalesreport.php" style="font-weight:bold;">Sales</a></td>
     <td><?php echo $totalSales; ?></td>
  </tr>
  <tr>
    <td><div style="width:15px;height:15px;background-color:#FF5A5E;border-radius:5px;"></div></td>
    <td><a href="notinterestedreport.php" style="font-weight:bold;">Not Interested</a></td>
    <td><?php echo $totalNi; ?></td>
  </tr>
  <tr>
    <td><div style="width:15px;height:15px;background-color:#AF4614;border-radius:5px;"></div></td>
    <td>Total leads</td>
    <td><?php echo $grandTotal; ?></td>
  </tr>
</table>
                            
                            </div>
                            </div>
                            
								


	
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
                    
                    <div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
                            
                            <div class="row">
                            <div class="col-md-6"><h4><i class="icon-reorder"></i>Sales</h4></div>
                             <div class="col-md-6"  style="text-align:right;"><select class="form" style="border:0px" id="salesyear">
                                 <?php
								 for($year=2014;$year<=date("Y");$year++){
								 ?>
                                	 <option value="<?php echo $year; ?>" <?php if($curYear==$syear) {?> selected <?php } ?>><?php echo $year; ?></option>
                                  <?php } ?>   
                                     
                            	 </select>&nbsp;&nbsp;
                                 <span class="label label-primary" style="cursor:pointer;" onClick="showsalesByDate(document.getElementById('salesyear').value)">Change</span></div>
                            </div>
                            
								
                                
                                
                                
							</div>
							<div class="widget-content">
								<p><div>
									<canvas id="canvasline" height="280" width="500"></canvas>
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

		var pieData = [
				{
					value: '<?php echo $totalFollowups; ?>',	color:"#D9D900",highlight: "#C6C600",label: "Followups"
				},
				{
					value: '<?php echo $totalMeetings; ?>',color: "#46BFBD",highlight: "#5AD3D1",label: "Meetings"
				},
				{
					value: '<?php echo $totalSales; ?>',	color: "#00A400",highlight: "#007D00",label: "Sales"
				},
				{
					value: '<?php echo $totalNi; ?>',color: "#FF5A5E",highlight: "#FF3E43",label: "Not Interested"
				}
				

			];

				window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myPie = new Chart(ctx).Pie(pieData,{segmentShowStroke : true,scaleShowLabels: true});
				
				// move the first 'onload' function to here.
				var ctx2 = document.getElementById("canvasline").getContext("2d");
				window.myLine = new Chart(ctx2).Line(lineChartData);
				
				};



	</script>
    
    
</body>
</html>