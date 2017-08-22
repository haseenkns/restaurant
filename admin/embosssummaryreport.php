<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");

 if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['pg']) ){
	$start=$_GET['start'];
	$end=$_GET['end'];
	$pg=$_GET['pg'];
	$dateText= "Between $start And $end ";
	$progText=getProgramtext($pg);
	
 }else{
	 $progText="All Program";
	 $dateText=date("d F, Y");
 }

if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'cns':
		$msg='Members detail has been  updated Successfully !!';
		$class='success';
	break;
	
	case 'cnf':
		$msg='Members detail not updated Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Members data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Members data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='Administrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='Administrator rights not added successfully !!!!';
		$class='danger';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	

	
	//print_r($progId);
	//die;
	
	
	
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script>
	function showHideAmountDiv(id){
		if(document.getElementById(id).style.display=='none'){
			document.getElementById(id).style.display='block'	
		}else{
			document.getElementById(id).style.display='none'	
		}
			
	}
    function showHideDiv(id){
		var count=document.getElementById('hidTotal').value
		for(i=1;i<=count;i++){
		document.getElementById('podiv'+i).style.display='none'	
		}
		document.getElementById('podiv'+id).style.display='block'	
			
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			document.getElementById(id).focus();	
			alert(id)
		});
			//return false;
		}
		
    </script>
    
    <script>
		function seachByDate(start,end,program){
			//if(program==0){
				//window.location.href="cancelledmemberreport.php";
			//}else{
				if(start=='')start=0;
				if(end=='')end=0;
				window.location.href="embosssummaryreport.php?start="+start+"&end="+end+'&pg='+program;	
			//}
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
						<h3>Embossing - <?php echo $progText; ?></h3>
						<span><?php echo $dateText; ?></span>
					</div>

          			<form action="" method="post">
                   <div class="col-md-9" style="float:right;margin-top:5px;text-align:right;">
                   <div class="row">
                    <div class="col-md-2" style="padding-top:6px;">Search by </div>
                     <div class="col-md-3" style="padding-top:6px;"><select name="program" id="program" class="form-control " onChange="updateMembershipLevel(this.value)" ><option value="0">Select Program</option>
                     <option value="0">View All Programs</option>
				<?php
					$execQry=mysql_query("select * from `programs` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['pname']) ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select></div>
                   <div class="col-md-1" style="padding-top:6px;">from</div>
                   <div class="col-md-2"><input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control input-width-small datepicker" style="border-radius:5px;"></div>
                   <div class="col-md-1"  style="padding-top:6px;">To</div>
                   <div class="col-md-2"><input type="text" name="enddate" id="enddate" placeholder="End Date" class="form-control input-width-small datepicker"  style="border-radius:5px;"></div>
                    <div class="col-md-1"><button type="button"  name="submit" value=" Search "class="btn"  onClick="seachByDate(document.getElementById('startdate').value,document.getElementById('enddate').value,document.getElementById('program').value)">Search</button></div>
                   </div>
                   
                   
                   </div>
                   </form>
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
<form action="" method="post" enctype="multipart/form-data" onSubmit="return ValidateMember()">
 <?php if($msg!=''){ ?>
             <div class="row">
             <div class="col-md-12">
             <div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div>
                                </div>
             </div>
             <?php } ?>
			 
			 
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Programs <a href="reports/embosssummaryreport.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=1&pg=<?php echo $pg ?>"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/embosssummaryreport.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=2&pg=<?php echo $pg ?>"><img src="images/word.png" width="26" height="26"></a></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
       <?php                      
        if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['pg']) ){
			$start=	changeToStdDate($_GET['start']);
			$end =changeToStdDate($_GET['end']);
			$pg =$_GET['pg'];
			?>
			
			<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th width="30%">Program</th>
           
            <th  data-hide="phone" style="text-align:center">Total Primary Embossing</th>
            <th data-hide="phone,tablet" style="text-align:center">Total Spouse Embossing</th>
              <th  data-hide="phone" style="text-align:center">Total Embossing</th>
           
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
	if($pg==0){
 		$sqlQry=mysql_query("select * from `programs`   order by `id` Desc");
	}else{
		$sqlQry=mysql_query("select * from `programs`  where `id` ='$pg' order by `id` Desc");
	}
	$i=0;
	$pdate=date("m-d-Y");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$pid=$fetch['id'];
		$totalPrimaryEmbossing=getTotalPrimaryEmbossingByProgId($pid,$start,$end);
		$totalSpouseEmbossing=getTotalSpouseEmbossingByProgId($pid,$start,$end);
		$totalEmbossing=(int)$totalPrimaryEmbossing+(int)$totalSpouseEmbossing;
	
  ?>
  <tr bgcolor="#FFFFFF">
            <td align="center" class="smalltext"><?php echo $i; ?></td>
            <td align="left"  ><?php echo $fetch['pname'] ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalPrimaryEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalSpouseEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalEmbossing; ?></td>
  </tr>
  <?php }}else{?>
	  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  <?php } ?>
										
									</tbody>
								</table>
            
            
            
		<?php }else{?>
				<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th width="30%">Program</th>
           
            <th  data-hide="phone" style="text-align:center">Total Primary Embossing</th>
            <th data-hide="phone,tablet" style="text-align:center">Total Spouse Embossing</th>
              <th  data-hide="phone" style="text-align:center">Total Embossing</th>
           
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
 	$sqlQry=mysql_query("select * from `programs`  order by `id` Desc");
	$i=0;
	$pdate=date("m-d-Y");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$pid=$fetch['id'];
	
		$totalPrimaryEmbossing=getCurrentTotalSpouseEmbossingByProgId($pid,$pdate);
		$totalSpouseEmbossing=getCurrentTotalSpouseEmbossingByProgId($pid,$pdate);
		$totalEmbossing=(int)$totalPrimaryEmbossing+(int)$totalSpouseEmbossing;
	
  ?>
  <tr bgcolor="#FFFFFF">
            <td align="center" class="smalltext"><?php echo $i; ?></td>
            <td align="left"  ><?php echo $fetch['pname'] ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalPrimaryEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalSpouseEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalEmbossing; ?></td>
  </tr>
  <?php }}else{?>
	  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  <?php } ?>
										
									</tbody>
								</table>
		<?php } ?>
	
								
                                
                                
                                
							</div>
						</div>
					</div>
				</div>    
            
            
			<!-- /.container -->
</form>
		</div>
	</div>
<!-- <script language="javascript" type="text/javascript" src="javascript/jquery1.4.js">   </script>
-->

</body>
</html>