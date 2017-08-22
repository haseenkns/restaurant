<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
if(isset($_GET['start'])){
	$start=$_GET['start'];	
	$end=$_GET['end'];	
}else{
	$start=date("d/m/Y", strtotime(date('m').'/01/'.date('Y').' 00:00:00'));;
	$end=date("d/m/Y", strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
}
$sstart=changeDate($start);
$send=changeDate($end);
 //$noofDays=cal_days_in_month(1,$curMonth,$curYear);
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
    function changeMonthYear(start,end){
		window.location.href='revenuereport.php?start='+start+'&end='+end	
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
						<h3>Revenue Tracker <b style="font-size:12px;color:#F00;font-weight:normal;font-style:italic;">( * check reports for dates falling witnin financial year)</b></h3>
						<span style="color:#06C;font-weight:bold;"><?php  echo $start." - ".$end; ?></span>
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Revenue Report from <?php  echo $start." - ".$end; ?> <a href="reports/revenuereport.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=1"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/revenuereport.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=2"><img src="images/word.png" width="26" height="26"></a></h4>
								<div class="toolbar">
                                <div style="float:left;padding-top:5px;width:500px;" >
                                        <div class="row">
                                        <div class="col-md-2">Change </div>
                                         <div class="col-md-5"><input class="form-control input-width-small datepicker"  style="letter-spacing:1px;"   title="" type="text" name="start" id="start"></div>
                                         <div class="col-md-3"><input class="form-control input-width-small datepicker"  style="letter-spacing:1px;"   title="" type="text" name="end" id="end"></div>
                						 <div class="col-md-1"><span class="btn" onClick="changeMonthYear(document.getElementById('start').value,document.getElementById('end').value)">Go</span></div>
                						
                                        </div>
                                        
                                        
                                         </div>
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
                            <?php
							 $tds=getEffectiveServiceTax($sstart,$send);
												
							?>
							<div class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive  ">
									<thead>
                                         <tr >
               
                <th width="10%">Program</th>
                <th width="10%">
                <table width="100%" border="0"  cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="8%">Level </td>
                        <td width="8%">No of Sales </td>
                        <td width="8%">Price </td>
                        <td width="8%">Total </td>
                        <td width="8%">Tax (<?php echo $tds; ?>)</td>
                        <td width="8%">Gross </td>
                        <td width="8%">No Of Cancel </td>
                        <td width="8%">Price </td>
                        <td width="8%">Total </td>
                        <td width="8%">Tax </td>
                        <td width="8%">Gross </td>
                        <td width="8%">Net </td>
                    <td>
                            

    
    
    				</td>
  				</tr>
</table>

                
                </th>
          
           
           
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `programs` where `status`='1'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	$pid=$fetch['id'];
	$total=0;
  ?>
<tr >
          
             <td><a href="netsalestracker.php?pid=<?php echo $pid; ?>"><?php echo $fetch['pname'] ?></a></td>
            <td>
            									<?php 
												
												$divTds=100+$tds;
  	$sqlQrys=mysql_query("select * from `program_price` where `status`='1' and `prog_id`='$pid'");
	$i=0;
	$numrowss=mysql_num_rows($sqlQrys);
	if($numrowss>0){
	while($fetchs=mysql_fetch_array($sqlQrys)){
		$level=$fetchs['id'];
		$price=$fetchs['price'];
		$total=0;
		$cancel=0;
		
		$totalSales=getSalesByPidLidStartDayEndDay($pid,$level,$start,$end);
		$totalCancel=getSalesCancelByPidLidStartDayEndDay($pid,$level,$start,$end);
		$grossTotalsalaes=(int)$totalSales * (int)$price;
		$taxSales=floor(($grossTotalsalaes*$tds)/$divTds);
		$grossSales=$grossTotalsalaes-$taxSales;
		
		$grossTotalCancel=(int)$totalCancel * (int)$price;
		$taxCancel=floor(($grossTotalCancel*$tds)/$divTds);
		$grossCancel=$grossTotalCancel-$taxCancel;
         $net=$grossSales-$grossCancel;
		?>
            
            <table width="100%" border="0">
                    <tr>
                   			 <th width="10%"><?php echo $fetchs['pricename']; ?><br/>(<?php echo $fetchs['price']; ?>) </th>
                             <th width="10%"><?php echo $totalSales; ?> </th>
                             <th width="10%"><?php echo $price; ?> </th>
                             <th width="10%"><?php echo $grossTotalsalaes; ?></th>
                             <th width="10%"><?php echo $taxSales ?> </th>
                             <th width="10%"><?php echo $grossSales; ?> </th>
                             <th width="10%"><?php echo $totalCancel; ?> </th>
                             <th width="10%"><?php echo $price; ?> </th>
                             <th width="10%"><?php echo $grossTotalCancel; ?> </th>
                             <th width="10%"><?php echo $taxCancel; ?>  </th>
                             
                             <th width="10%"><?php echo $grossCancel; ?> </th>
                             <th width="10%"><?php echo $net; ?> </th>
                    <td>
                            

    
    
    				</td>
  				</tr>
</table>
            
         <?php } }?>   
            </th>
            
          
  
  <?php }}else{?>
  <tr><td>No record</td><td>No record</td></tr>
  
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