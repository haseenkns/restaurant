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
		$cmids=getComplimentryMemIdsByProg($pg);
		$qrysText="pg=$pg";
	}else{
		$pg=0;	
		$cmids=getComplimentryMemIdsBy();
		$qrysText="1";
}

	

if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
	$startdate=$_GET['start'];
	$enddate=$_GET['end'];
	$cmids=getComplimentryMemIdsByProgAndDate($startdate,$enddate,$pg);
	$dateText="From ( ".$startdate." -- ".$enddate." )";
	$qrysText="start=$startDate&end=$endDate&pg=$pg";
	
}else{
	$dateText="";
	$qrysText="1&pg=$pg";
}
//die;

//echo $qryText;
$pgText=getProgramNameById($pg);

if(count($cmids)==0){
	$impIds="0";

}else{
$impIds=implode(",",$cmids);
	
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
	
	
	case 'scs':
		$msg='Room Reservation status changed successfully !!';
		$class='success';
	break;
	
	case 'scf':
		$msg='Room Reservation status not changed successfully !!!!';
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
	
 /*if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
						$startdate=$_GET['start'];
						$enddate=$_GET['end'];
					    $validMembers=getValidMembersBetweenDates($startdate,$enddate);
						
						$search=1;
					}else{
					
						$search=0;
	}
	*/
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
		window.location.href="complimentrymembershipreport.php?start="+start+"&end="+end+'&pg='+pg;	
    }
	
	function sortByProg(val){
		if(val==0){
			window.location.href="complimentrymembershipreport.php";
	    }else{
			window.location.href="complimentrymembershipreport.php?pg="+val;	
		}
	}
    </script>
    <script>
	
    function showHideDiv(id){
		var count=document.getElementById('hidTotal').value
		for(i=1;i<=count;i++){
		document.getElementById('podiv'+i).style.display='none'	
		}
		document.getElementById('podiv'+id).style.display='block'	
			
	}
   
    function cardmsg(id){
		//alert(id)
		swal({
		title: "Reservation Status",
		text: "Want to change ?",
		type: "warning",
		confirmButtonText: "Yes",
			showCancelButton: true,
 		confirmButtonColor: "#DD6B55"
		},function(){
			window.location.href='changeroomreservationstatus.php?id='+id
		});
			//return false;
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
						<h3>Report - Complimentry Membership<b style="color:#06C;font-size:16px;"><?php echo $pgText; ?></b> </h3>
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
								<h4><i class="icon-reorder"></i> Members <a href="reports/complimentrymembershipreport.php?<?php echo $qrysText?>&type=1"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/complimentrymembershipreport.php?<?php echo $qrysText?>&type=2"><img src="images/word.png" width="26" height="26"></a> </h4>
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
                                        <th width="5%" >View</th>
                                        <th width="15%">Prog. Name</th>
                                         <th width="10%"  data-hide="phone">Mem.date</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Member</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Mem No</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Processed</th>
                                        <th width="20%"  data-hide="phone">Approved By</th>
                                        <th width="20%"  data-hide="phone">Consultant Name</th>
                                        <th width="10%"  data-hide="phone">Time</th>
                                       
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Valid upto</th>
                                    </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
	//echo "select * from `members` where `id` IN ($impIds)  order by `id` Desc";
  	$sqlQry=mysql_query("select * from `members` where `id` IN ($impIds)  order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$memid=$fetch['id'];
		$progId=$fetch['prog_id'];
		$approvedby=$fetch['approvedby'];
		$reportto=getReportToEmp($approvedby);
		
		$processedby=$fetch['processedby'];
		$ptime=$fetch['createdtime'];
		$memNumber=getMemberShipNumber($progId,$memid);
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$name=getMemberNameById($memid);
		$dateofsale=$fetch['dateofsale'];
		$tenure=getTenureById($fetch['tenure']);
		$validdate=getValidUpto($dateofsale,$tenure);
		
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
         <td align="center" class="smalltext"><a href="viewmember.php?aid=<?php echo base64_encode($fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
            <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($fetch['dateofsale']); ?></td>
       
        <td align="left" class="smallfonttext" style="text-align:center;" ><?php echo $name; ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo $memNumber; ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo getAdminNameById($processedby); ?></td>
        <td align="left" class="smallfonttext"><?php echo getAdminNameById($approvedby); ?></td>
        <td align="left" class="smallfonttext"><?php echo $reportto; ?></td>
        <td align="left" class="smallfonttext"><?php echo $ptime; ?></td>
    
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($validdate); ?></td>
    
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td></td><td></td><td></td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
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

</body>
</html>