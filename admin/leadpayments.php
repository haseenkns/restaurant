<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
$admtype=$_SESSION['type'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");
$team=displayteam($adminId);

array_push($team,$adminId);

$impteam=implode(",",$team);
$assignMeetings=array();
$assignMeetings=myassignedMeetingsByAid($adminId);


$impLid=implode(",",$assignMeetings);


$qry= " and `a_id` IN ($impteam)   ";	
		
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
	
	
	$id=array();

	$execQrys=mysql_query("select * from `leads` where `status`!='2' and `leadtype`='3' $qry order by `id` Desc  ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['id'];
		}
	}
	//print_r($id);
	
$lids=array_merge($id,$assignMeetings);
if(count($lids)>0){
	$impids=implode(",",$lids);	
}else{
	$impids=0;
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
                
                  <div class="row">
					<div class="col-md-8">
                    <div class="page-title">
						<h3>Add Payments</h3>
						<!--<span>Good morning, John!</span>-->
					</div>
                    </div>
                    
                    <div class="col-md-4">
                     <!--<div class="page-title" style="float:right;">
                     <ul class="project-list" style="list-style:none;text-align:right;">
                    
						 <?php
									$execQry=mysql_query("select * from `leadtypes` where `status` = '1' order by `id` ");
									$numRows=mysql_num_rows($execQry);
									if($numRows>0){
									while($fetch=mysql_fetch_array($execQry)){
										
										
										?>
                                    <li class="current" style="float:left;margin:0px 8px;">
						<a href="viewleads.php?type=<?php echo $fetch['id']; ?>">
							<div ><i style="font-size:18px;" title="<?php echo $fetch['name']; ?>" class="icon-<?php echo $fetch['class']; ?>"></i></div>
							
                            
                            </span>
						</a>
					</li>
                                    
                                    <?php  }}?> 
                                     <li class="current" style="float:left;margin:0px 8px;"><a href="viewleads.php" >View All</a></li>
                                    </ul>
						
					</div>-->
                    </div>
                    
                    </div>
                
                
					

				
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
                                            <th  data-hide="phone">Contact</th>
                                            <th  data-hide="phone">Email</th>
                                            <th data-hide="phone,tablet" style="text-align:center;">Payment received</th>
                                         
                                            <th data-hide="phone,tablet" style="text-align:center;">Status</th>
										  </tr>
                                        
                                        
									</thead>
									<tbody>
<?php 

//echo "select * from `leads` where `status`!='2' and `leadtype`='3' $qry order by `id` Desc";
	//echo "select * from `leads` where `id` IN (".implode(',',$lids).") order by `id` Desc";
//	echo "select * from `leads` where `id` IN ($impids) order by `id` Desc";
	  	$sqlQry=mysql_query("select * from `leads` where `id` IN ($impids) order by `id` Desc");
		
	
	
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$id=$fetch['id'];
		$leadId=getLeadId($id);
	    $clientName=getClientsNameById($id);
			$meetingDate=getLatestMeetingDatesByLid($id);
		if($meetingDate==''){
			$meetingDate="- - - -";	
		}else{
			$meetingDate=changeToStdDate($meetingDate);	
		}
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewleaddetails.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $leadId; ?></td>
    <td align="left" class="smallfonttext"><?php echo $clientName; ?></td>
   
     <td align="left" class="smallfonttext"><?php echo getClientContact($id); ?></td>
     <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['email']); ?></td>
	<td align="left" class="smallfonttext" style="text-align:center;"> <a href="viewpayment.php?lid=<?php echo base64_encode($fetch['id']); ?>"><?php echo getTotalPaymentRecvBYLid($id); ?></a>&nbsp;Rs.</td>
  
    <td align="center"  ><span class="label label-success"><a href="addreceipt.php?lid=<?php echo $fetch['id']; ?>" style="color:#FFFFFF;">Add Payment</a></span></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
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