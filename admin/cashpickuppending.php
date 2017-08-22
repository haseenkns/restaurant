<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");




if(isset($_GET['pg'])&&$_GET['pg']!=''){	
		$pg=$_GET['pg'];
		$creditArr=getNotCreditedInBankByProg($pg);

	}else{
		$pg=0;	
		$creditArr=getNotCreditedInBank();

		
}

	

if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
	$startdate=$_GET['start'];
	$enddate=$_GET['end'];
	$creditArr=getNotCreditedInBankByProgAndDate($startdate,$enddate,$pg);
	//print_r($cmids);
	$dateText="From ( ".$startdate." -- ".$enddate." )";
}else{
	$dateText="";
}
//die;
$pgText=getProgramNameById($pg);

if(count($creditArr)==0){
	$creditIds="0";

}else{
$creditIds=implode(",",$creditArr);
	
}






if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Member has been  added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Member not added Successfully !!';
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
	  function seachByDate(start,end,pg){
		window.location.href="cashpickuppending.php?start="+start+"&end="+end+'&pg='+pg;	
    }
	
	
	function sortByProg(val){
		if(val==0){
			window.location.href="cashpickuppending.php";
	    }else{
			window.location.href="cashpickuppending.php?pg="+val;	
		}
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
						<h3>Members - Credit Not Received  <b style="color:#06C;font-size:16px;"><?php echo $pgText; ?></b> </h3>
                        <span style="color:#930;letter-spacing:1px;"><?php echo $dateText; ?></span>
                       
					</div>
                    
                    
					<form action="" method="post">
                   <div class="col-md-7" style="float:right;margin-top:35px;text-align:right;">
                   <div class="row">
                   <div class="col-md-3" style="padding-top:6px;">Between</div>
                   <div class="col-md-3"><input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control datepicker" style="border-radius:5px;"></div>
                   <div class="col-md-1"  style="padding-top:6px;">And&nbsp;&nbsp;</div>
                   <div class="col-md-3"><input type="hidden" name="hidPg" id="hidPg" value="<?php echo $pg; ?>"><input type="text" name="enddate" id="enddate" placeholder="End Date" class="form-control datepicker"  style="border-radius:5px;"></div>
                    <div class="col-md-2"><button type="button"  name="submit" value=" Search "class="btn"  onClick="seachByDate(document.getElementById('startdate').value,document.getElementById('enddate').value,document.getElementById('hidPg').value)">Search</button></div>
                   </div>
                   
                   
                   </div>
                   </form>

					<!-- Page Stats -->
					
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
								<h4><i class="icon-reorder"></i> Credits Pending <a href="reports/cashpickuppending.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=1&pg=<?php echo $pg ?>"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/cashpickuppending.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=2&pg=<?php echo $pg ?>"><img src="images/word.png" width="26" height="26"></a></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
                                    <div style="float:left;padding-top:5px;width:290px;" >
                                        <div class="row">
                                        <div class="col-md-2">Search</div>
                                        <div class="col-md-4"><select name="program" id="program" class="form-control input-width-large" onChange="sortByProg(this.value)" ><option value="0">Select Program</option>
                                        <option value="0">All Program</option>
				<?php
					$execQry=mysql_query("select * from `programs` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($pg==$fetch['id']){ ?> selected <?php } ?>><?php echo stripslashes($fetch['pname']) ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select></div>
                						
                						
                                        </div>
                                        
                                        
                                         </div>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th width="5%" >Sno</th>
             <th width="25%">Membership Id</th>
             <th width="20%"  data-hide="phone">Program</th>
            <th width="20%"  data-hide="phone">Name</th>
             <th width="15%"  data-hide="phone">Picked By</th>
             <th width="30%"  data-hide="phone" style="text-align:center;">Created On</th>
            <th width="10%" data-hide="phone,tablet" style="text-align:center;">Amount</th>
           
        
           
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
							<?php 
  	$sqlQry=mysql_query("select * from `members` where `id` IN($creditIds) order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$progId=$fetch['prog_id'];
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $fetch['id'];
		$memNumber=$preffix."".$memId."".$suffix;
		$name=getTabledataById("name","titles",$fetch['title'])." ".$fetch['fname']." ".$fetch['mname']." ".$fetch['lname'];
		$pickUpType=$fetch['pickup'];
		if($pickUpType==2){
			$pickuptext="Transferred";	
		}else if($pickUpType==1){
			$emp=$fetch['employee'];
			$pickuptext=getEmployeeNameById($emp);	
		}
	$total=$total+(int)getProgramPriceById($fetch['mlevel']);
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
     
	
    <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
    <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($fetch['createdon']); ?></td>
    	<td align="left" class="smallfonttext" style="text-align:center;"><?php echo getProgramPriceById($fetch['mlevel']); ?></td>

  </tr>
  <?php }?>
  <tr><td colspan="6" style="text-align:right"><b>Total Pending</b></td><td style="text-align:center"><b><?php echo $total; ?></b></td></tr>
  <?php }else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
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
<script>
function fillPrintableName(){
	
	var fname=document.getElementById('fname').value;	
	var mname=document.getElementById('mname').value;	
	var lname=document.getElementById('lname').value;	
	var nameoncard =document.getElementById('nameoncard');
	if(mname==''){
		nameoncard.value=fname+" "+lname;	
	}else{
		nameoncard.value=fname+" "+mname+" "+lname;
	}
}
</script>
</body>
</html>