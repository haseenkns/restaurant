<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
if(isset($_GET['year'])){
$curYear=$_GET['year'];	
}else{
	$curYear=date("Y");	
}
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
    function changeYear(val){
		window.location.href='employeeperformancereport.php?year='+val	
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
						<h3>Employees</h3>
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
								<h4><i class="icon-reorder"></i>Performance Report of <?php echo $curYear; ?>  <a href="reports/employeeperformancereport.php?year=<?php echo $curYear; ?>&type=1"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/employeeperformancereport.php?year=<?php echo $curYear; ?>&type=2"><img src="images/word.png" width="26" height="26"></a></h4>
								<div class="toolbar no-padding">
                                <div style="float:left;padding-top:5px;width:290px;" >
                                        <div class="row">
                                        <div class="col-md-2">Change </div>
                                        <div class="col-md-4"><select name="program" id="program" class="form-control input-width-large" onChange="changeYear(this.value)" ><option value="0">Year</option>
                                        
					<?php for($year=date("Y");$year>=2012;$year--) {?> 
					<option value="<?php echo $year; ?>" <?php if($year==$curYear){ ?> selected <?php } ?>>Year- <?php echo $year ?></option>
					<?php } ?>
                
                </select></div>
                						
                						
                                        </div>
                                        
                                        
                                         </div>
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
                                         <tr >
            <th >Sno</th>
             <th>Code</th>
            <th>Username</th>
            <th  data-class="expand">Name</th>
            <th  data-hide="phone">Jan</th>
            <th  data-hide="phone">Feb</th>
            <th  data-hide="phone">Mar</th>
            <th  data-hide="phone">Apr</th>
            <th  data-hide="phone">May</th>
            <th  data-hide="phone">Jun</th>
            <th  data-hide="phone">Jul</th>
            <th  data-hide="phone">Aug</th>
            <th  data-hide="phone">Sep</th>
            <th  data-hide="phone">Oct</th>
            <th  data-hide="phone">Nov</th>
            <th  data-hide="phone">Dec</th>
             <th  data-hide="phone">Total</th>
            <th  data-hide="phone">Avg</th>
           
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `admin` where `id`!='1'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	$empId=$fetch['id'];
	$total=0;
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo getCode($fetch['id']); ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['username']; ?></td>
	<td  align="left" class="smallfonttext"><b><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></b></td>
	       <?php
		  	 foreach (getSrtMonth() as $month){
				 $report=getPerformanceReport($month,$curYear,$empId);
				 $total=$total+$report;
				 
		   ?>
           <td  data-hide="phone"><?php  echo $report; ?></td>
           <?php } ?>
            
             <td  data-hide="phone" style="text-align:center;"><b style="color:#03C;"><?php  echo $total; ?></b></td>
            <td  data-hide="phone"><?php  echo ceil($total/12); ?></td>
    
    
  </tr>
  <?php }?>
  
  <?php }else{?>
  <tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>
  
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