<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
if(isset($_GET['month'])){
$curMonth=$_GET['month'];	
$curYear=$_GET['year'];	

}else{
	$curMonth=date("m");
	$curYear=date("Y");
		
}
	$pid=$_GET['pid'];
 $noofDays=cal_days_in_month(1,$curMonth,$curYear);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>

<style>
.validateText{
font-size:11px;
color:#999;
font-style:italic;	
}
</style>

	</head>

<body class="theme-dark">

	
	<script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script>
    function changeMonthYear(year,month,pid){
		window.location.href='netsalestracker.php?year='+year+'&month='+month+'&pid='+pid	
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
		
    </script>
    
    
    
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
						<h3>Sales Tracker - <?php echo getProgramNameById($pid); ?></h3>
						<span style="color:#06C;font-weight:bold;">for <?php echo getMonth($curMonth-1)." , ".$curYear; ?></span>
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Sales Report of <?php echo getMonth($curMonth-1)." , ".$curYear; ?></h4>
								<div class="toolbar">
                                <div style="float:left;padding-top:5px;width:500px;" >
                                        <div class="row">
                                        <div class="col-md-2">Change </div>
                                         <div class="col-md-5"><select name="month" id="month" class="form-control input-width-large"  >
                                        
					<?php foreach(getSrtMonth() as $month) {?> 
					<option value="<?php echo $month; ?>" <?php if($curMonth==$month){ ?> selected <?php } ?>>Month- <?php echo getMonth($month-1); ?></option>
					<?php } ?>
                
                </select></div>
                                         <div class="col-md-3"><select name="year" id="year" class="form-control input-width-small" >
                                        
					<?php for($year=date("Y");$year>=2012;$year--) {?> 
					<option value="<?php echo $year; ?>" <?php if($year==$curYear){ ?> selected <?php } ?>><?php echo $year ?></option>
					<?php } ?>
                
                </select></div>
                						 <div class="col-md-1"><span class="btn" onClick="changeMonthYear(document.getElementById('year').value,document.getElementById('month').value,'<?php echo $pid ?>')">Go</span></div>
                						
                                        </div>
                                        
                                        
                                         </div>
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive  ">
									<thead>
                                         <tr >
               
                <th width="6%">Date</th>
                
               <?php
			   
  	$sqlQrys=mysql_query("select * from `program_price` where `status`='1' and `prog_id`='$pid'");
	$i=0;
	$numrowss=mysql_num_rows($sqlQrys);
	if($numrowss>0){
	while($fetchs=mysql_fetch_array($sqlQrys)){
		
		
			   ?> 
                <th width="10%"><?php echo $fetchs['pricename']." ".$fetchs['price'];  ?></th>
                
              <?php }} ?>
                 <th width="10%">Total</th>
                 <th width="10%">Cancellation</th>
                 <th width="10%">Final</th>
          
           
           
  </tr>
                                        
                                        
									</thead>
									<tbody>
									 <?php
                            for($i=1;$i<=$noofDays;$i++){
								$total=0;
								$cancel=0;
								?>
                                
                                  <tr width="6%">
                               
                                  <td><?php echo $i; ?></td>
									<?php
                                    
                                    $sqlQryss=mysql_query("select * from `program_price` where `status`='1' and `prog_id`='$pid'");
                                 
                                    $numrowsss=mysql_num_rows($sqlQryss);
                                    if($numrowsss>0){
                                    while($fetchss=mysql_fetch_array($sqlQryss)){
										$level=$fetchss['id'];
										$sales=getSalesByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear);
										$total=$total+$sales;
										$cancel=$cancel+getSalesCancelByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear);
                                    ?> 
                                    <td width="10%"><?php echo $sales; ?></td>
                                    <?php }} ?>
                                  
                                  
                    <th width="10%"><?php echo $total; ?></th>
                 <th width="10%"><?php echo $cancel; ?></th>
                 <th width="10%"><b><?php echo $total-$cancel; ?></b></th>               
                                  </tr>

            				<?php } ?>
          
  
 
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container -->

		</div>
	</div>

   
    
   
</body>
</html>