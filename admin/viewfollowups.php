<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
$admtype=$_SESSION['type'];

include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("Y")."-".date("m")."-".date("d");



if($admtype==1){
	$qry= " and 1 ";
}else{
	$team=displayteam($adminId);
	array_push($team,$adminId);
	$impteam=implode(",",$team);
	$qry= " and `a_id` IN ($impteam) ";
}	

if(isset($_GET['sdate'])&&$_GET['sdate']!=''){	
	$sdate=$_GET['sdate'];
	$edate=$_GET['edate'];
	$leadidByMeting=getLeadidsBetweenMeetingDates($sdate,$edate,$qry);
	if(count($leadidByMeting)>0){
	$impLids=implode(",",$leadidByMeting);
	
	}else{
	$impLids=0;
	}
	$leadQry= " and `id` in ($impLids)"; 
	$dateText=" Between ".changeToStdDate(changeDate($sdate))." and   ".changeToStdDate(changeDate($edate));
}else{
$leadQry= " and 1 "; 
$dateText='';
}

if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'cns':
		$msg='Member has been  deactivated Successfully !!';
		$class='success';
	break;
	
	case 'cnf':
		$msg='Member not deactivated Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Lead data has been  updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Lead  data not updated Successfully !!';
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
	
$todaysFollowups=getTodaysFollowupsByTeam($qry);

	
	
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
    
    
    
	</head>

<body class="theme-dark">

	<!-- Header -->
	<?php include_once("header.php"); ?> <!-- /.header -->

	<div id="container" >
		<?php include_once("leftmenu.php"); ?>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<?php include_once("crumb.php"); ?>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
				   <div class="row">
                <div class="col-md-4"><div class="page-title">
						<h3>View All Followups  </h3>
						<span style="color:#F00;"> <?php  echo $dateText; ?>  </span>
					</div></div>
                <div class="col-md-8" ><div class="page-titles" style="text-align:right;padding-top:20px;">
						<h6>
                        
                        <div class="form-group">
                       <div class="row">
                       <div class="col-md-3" style="padding-top:10px;" ><a href="followupreports.php?todayfollowups">Today<span> ( <?php echo $todaysFollowups; ?> )</span></a></div>
                         <div class="col-md-3" style="padding-top:10px;" >Follow ups between :</div>
                           <div class="col-md-2" ><input type="text"  id="sdate"   placeholder="Start Date" class="form-control input-width datepicker"  ></div>
                            <div class="col-md-2"><input type="text"  id="edate"   placeholder="End Date" class="form-control input-width datepicker" ></div>
                           
                            
                            <div class="col-md-1"><input onClick="searchFollowups(document.getElementById('sdate').value,document.getElementById('edate').value)" type="button" class="btn" value="Search"></div>
                        </div>
                        
                        
                        </div>
                        

</h6>
						<!--<span>Good morning, John!</span>-->
					</div></div>
                </div>
					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Leads </h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
                                            <th >Sno</th>
                                            <th  data-hide="phone">View</th>
                                            <th> Lead Id</th>
                                            <th  data-hide="phone">Client Name</th>
                                             <th  data-hide="phone">Conc.Person</th>
                                            <th  data-hide="phone">Contact</th>
                                            <th  data-hide="phone">Email</th>
                                        
                                            <th  data-hide="phone"> Followup Date </th>
                                             <th data-hide="phone,tablet" style="text-align:center">BDE</th>
                                                <th data-hide="phone,tablet">BDM</th>
                                            <th data-hide="phone,tablet" style="text-align:center;">Status</th>
										  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
										
										//echo "select * from `leads` where `status`!='2' and `leadtype`='1' $qry $leadQry order by `id` Desc";
  	$sqlQry=mysql_query("select * from `leads` where `status`!='2' and `leadtype`='1' $qry $leadQry order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$id=$fetch['id'];
		$leadId=getLeadId($id);
	    $clientName=getClientsNameById($id);
		$meetingDate=getLatestFollowUpDatesByLid($id);
		
		if($meetingDate==''){
			$meetingDate="- - - -";	
		}else{
		$meetingDate=changeToStdDate($meetingDate);	
		}
		
		if(isset($_GET['todayfollowups'])){
		  if($meetingDate==$currentDate){
			 
 		
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewleaddetails.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $leadId; ?></td>
     <td align="left" class="smallfonttext"><?php echo getClientsCompNameById($id); ?></td>
    <td align="left" class="smallfonttext"><?php echo $clientName; ?></td>
   
     <td align="left" class="smallfonttext"><?php echo getClientContact($id); ?></td>
     <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['email']); ?></td>
	
     <td align="left" style="text-align:center;" class="smallfonttext"><?php echo $meetingDate; ?></td>
    <td align="left" style="text-align:center;" class="smallfonttext"><span  style="font-style:normal;font-weight:normal;color:#930;"><?php  echo getExecNameBYLid($id); ?></span></td>
     <td align="left" class="smallfonttext" style="text-align:center;"><span  style="font-style:normal;font-weight:700;color:#06C;"><?php  echo getMarketingExecNameBYLid($id); ?></span></td>
    <td align="center"  ><span class="label label-success"><a href="addfollowups.php?id=<?php echo base64_encode($fetch['id']) ?>" style="text-decoration:none;color:#FFF;">Add Follow Up</a></span></td>
  </tr>
   <?php } 
          }else{?>
 				 <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewleaddetails.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $leadId; ?></td>
     <td align="left" class="smallfonttext"><?php echo getClientsCompNameById($id); ?></td>
    <td align="left" class="smallfonttext"><?php echo $clientName; ?></td>
   
     <td align="left" class="smallfonttext"><?php echo getClientContact($id); ?></td>
     <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['email']); ?></td>
	
     <td align="left" style="text-align:center;" class="smallfonttext"><?php echo $meetingDate; ?></td>
     <td align="left" style="text-align:center;" class="smallfonttext"><span  style="font-style:normal;font-weight:normal;color:#930;"><?php  echo getExecNameBYLid($id); ?></span></td>
      <td align="left" class="smallfonttext" style="text-align:center;"><span  style="font-style:normal;font-weight:700;color:#06C;"><?php  echo getMarketingExecNameBYLid($id); ?></span></td>
    <td align="center"  ><span class="label label-success"><a href="addfollowups.php?id=<?php echo base64_encode($fetch['id']) ?>" style="text-decoration:none;color:#FFF;">Add Follow Up</a></span></td>
  </tr>
  
  <?php }?>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>    
            
			<!-- /.container -->

		</div>
	</div>

</div>
<script>
function searchFollowups(sdate,edate){
window.location.href='viewfollowups.php?sdate='+sdate+'&edate='+edate
}
</script>
</body>
</html>