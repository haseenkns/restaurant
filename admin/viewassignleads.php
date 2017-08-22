<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$team=displayteam($adminId);
array_push($team,$adminId);
$currentDate=date("Y")."-".date("m")."-".date("d");
$assignedMeetings=getAssignedMeetings();
//print_r($assignedMeetings);
$totalLeads=getTotalMeetingLeadsByTeam($team);
//$unassignedLeads=array_diff($totalLeads,$assignedMeetings);

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
		$msg='Lead assignment updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Lead assignment not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Lead assignment has been deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Lead assignment not deleted successfully !!!!';
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
	
	

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `assignleads`   where `id`='$did' ");
		if($delQry){
		
			
			header("location:viewassignleads.php?msg=dls");
		}else{
			header("location:viewassignleads.php?msg=dlf");
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
					<div class="page-title">
						<h3>View All Assigned Leads</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
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
                                            <th>  Id</th>
                                            <th  data-hide="phone">Client Name</th>
                                              <th  data-hide="phone">Conc. Person</th>
                                            <th  data-hide="phone">Contact</th>
                                          
                                            <th data-hide="phone,tablet">Location</th>
                                            <th  data-hide="phone">Meeting Date </th>
                                            <th data-hide="phone,tablet" style="text-align:center;">Assigned To</th>
                                             <th data-hide="phone,tablet" style="text-align:center;">Action</th>
										  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
										$impLeads=implode(",",$totalLeads);
  	$sqlQry=mysql_query("select * from `assignleads` where `status`!='2' and  `admin_id`  = '$adminId'  order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$id=$fetch['id'];
		$lid=$fetch['lid'];
		$leadId=getLeadId($lid);
	    $clientName=getClientsNameById($lid);
		$meetingDate=changeToStdDate(getLatestMeetingDatesByLid($lid));
		$assigtext=getAssignedEmployeeNameByLid($lid);	
		$class="success";
		
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewleaddetails.php?aid=<?php echo base64_encode($lid); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $leadId; ?></td>
      <td align="left" class="smallfonttext"><?php echo getClientsCompNameById($lid); ?></td>
     <td align="left" class="smallfonttext"><?php echo $clientName; ?></td>
   
     <td align="left" class="smallfonttext"><?php echo getClientContact($lid); ?></td>
   
	<td align="left" class="smallfonttext" style="text-align:center;"><?php echo getClientLocation($lid); ?></td>
     <td align="left" style="text-align:center;" class="smallfonttext"><?php echo $meetingDate; ?></td>
    <td align="center"  ><span class="label label-<?php echo $class; ?>"><?php echo $assigtext; ?></span></td>
      <td align="center"  ><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="viewassignleads.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="assignleadtoemployee.php?eid=<?php echo base64_encode($id); ?>&lid=<?php echo base64_encode($lid); ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        
        
	
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
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
</body>
</html>