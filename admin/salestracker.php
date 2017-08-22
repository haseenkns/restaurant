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
    function changeMonthYear(year,month){
		window.location.href='salestracker.php?year='+year+'&month='+month	
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
						<h3>Sales Tracker</h3>
						<span style="color:#06C;font-weight:bold;">For Year <?php echo $curYear; ?></span>
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Sales Report of <?php echo getMonth($curMonth-1)." , ".$curYear; ?> <a href="reports/salestracker.php?month=<?php echo $curMonth; ?>&year=<?php echo $curYear; ?>&type=1"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/salestracker.php?month=<?php echo $curMonth; ?>&year=<?php echo $curYear; ?>&type=2"><img src="images/word.png" width="26" height="26"></a></h4>
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
                						 <div class="col-md-1"><span class="btn" onClick="changeMonthYear(document.getElementById('year').value,document.getElementById('month').value)">Go</span></div>
                						
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
               
                <th width="6%">Program</th>
                <th width="10%">
                <table width="100%" border="0"  cellpadding="0" cellspacing="0">
                    <tr>
                   			 <td width="10%">Level </td>
                    <td>
                            <table width="100%" border="0">
                            <tr>
                            <?php
                            for($i=1;$i<=$noofDays;$i++){
                            ?>
                            <th  style="font-size:9px;font-weight:bold" data-class="expand"><?php echo $i; ?></th>
                            <?php } ?>
                             <th>T</th>
                             <th>C</th>
                             <th>F</th>
                            </tr>
                           
                        </table>

    
    
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
  	$sqlQrys=mysql_query("select * from `program_price` where `status`='1' and `prog_id`='$pid'");
	$i=0;
	$numrowss=mysql_num_rows($sqlQrys);
	if($numrowss>0){
	while($fetchs=mysql_fetch_array($sqlQrys)){
		$level=$fetchs['id'];
		$total=0;
		$cancel=0;
		?>
            
            <table width="100%" border="0">
                    <tr>
                   			 <th width="10%"><?php echo $fetchs['pricename']; ?><br/>(<?php echo $fetchs['price']; ?>) </th>
                    <td>
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <tr>
                            <?php
                            for($i=1;$i<=$noofDays;$i++){
								$sales=getSalesByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear);
								$total=$total+$sales;
								$cancel=$cancel+getSalesCancelByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear);
                            ?>
                         		   <td  style="font-size:9px;border:#666 1px dashed;background:<?php if($sales>0) {?>#06F <?php } ?>;color:#000;" data-class="expand" >
								   <?php echo $sales; ?>
                                   
                                   </td>
                            <?php } ?>
                            
                            <td style="background:#093;color:#FFF;"><b><?php echo $total; ?></b></td>
                             <td style="background:#F00;color:#FFF;"><b><?php echo $cancel; ?></b></td>
                              <td style="background:#06C;color:#FFF;"><b><?php echo $total-$cancel; ?></b></td>
                            </tr>
                        </table>

    
    
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