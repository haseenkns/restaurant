<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
$admtype=$_SESSION['type'];

include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("Y")."-".date("m")."-".date("d");
$team=displayteam($adminId);
array_push($team,$adminId);

$month=$_GET['month'];
$year=$_GET['year'];
$salesids=getSalesByTeam($team);

if(count($salesids)>0){
$implids=implode(",",$salesids);
}else{
$implids=0;
}

$dateformat=$year."-".$month;

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
						<h3>View All Receiving   </h3>
						<span style="color:#F00;"> For  <?php  echo $month . "/" .$year; ?>  </span>
					</div></div>
                <div class="col-md-8" ><div class="page-titles" style="text-align:right;padding-top:20px;">
						<h6>
                        
                        <!--<div class="form-group">
                       <div class="row">
                   <div class="col-md-2" style="padding-top:10px;" ><a href="followupreports.php?todayfollowups">Today<span> ( <?php echo $todaysFollowups; ?> )</span></a></div>
                   <div class="col-md-2" style="padding-top:10px;" ><a href="followupreports.php">View All</a></div>
                   <div class="col-md-2" style="padding-top:10px;" >Follow ups between :</div>
                   <div class="col-md-2" ><input type="text"  id="sdate"   placeholder="Start Date" class="form-control input-width datepicker"  ></div>
                   <div class="col-md-2"><input type="text"  id="edate"   placeholder="End Date" class="form-control input-width datepicker" ></div>
                           
                            
                            <div class="col-md-1"><input onClick="searchFollowups(document.getElementById('sdate').value,document.getElementById('edate').value)" type="button" class="btn" value="Search"></div>
                        </div>
                        
                        
                        </div>-->
                        

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
                                            <th  data-hide="phone">Comp. Name</th>
                                            <th style="text-align:center" data-hide="phone">BDM</th>
                                            <th style="text-align:center"  data-hide="phone">BDE</th>
                                            <th style="text-align:center"  data-hide="phone">Recv Date</th>
                                            <th data-hide="phone,tablet">Amount</th>
                                            <th data-hide="phone,tablet">Ser Tax</th>
                                       
                                              <th data-hide="phone,tablet">Net Amt</th>
										  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
										
										//echo "select * from `creditpaid` where `status`!='2' and `lid` IN ($implids)  order by `id` Desc";
  	$sqlQry=mysql_query("select * from `creditpaid` where `status`!='2' and `lid` IN ($implids)  order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$totalAmt=0;
		$id=$fetch['lid'];
		$paidon=$fetch['paidon'];
		$amount=$fetch['amount'];
		$expPaidOn=explode("/",$paidon);
		$paidonformat=$expPaidOn[2]."-".$expPaidOn[1];
		$stax=$fetch['staxamount'];
		$net=$fetch['netamount'];
		$rdate=$fetch['paidon'];
	/*	$amount=$fetch['ecost'];
		$stax=$fetch['servicetax'];
		$taxinc=$fetch['taxinclusion']; //1- included , 2 - not included
		
		if($taxinc==1){
			$totalAmt=($amount*100)/($stax+100);
		}else if($taxinc==2){
			$totalAmt=($amount+ ($amount*$stax)/100);	
		}
				*/
			
	//echo $totalAmt;	
		
		if($paidonformat==$dateformat){
		$leadId=getLeadId($id);
	    $clientName=getClientsNameById($id);
		$compsName=getClientsCompNameById($id);
		//$meetingDate=getLatestMeetingDatesByLid($id);
		?>
		<tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewleaddetails.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $leadId; ?></td>
 <td align="left" class="smallfonttext"><?php echo $compsName; ?></td>
   
      <td align="center" class="smallfonttext"><?php echo getMarketingExecNameBYLid($id); ?></td>
     <td align="center" class="smallfonttext"><?php echo getExecNameBYLid($id); ?></td>
     <td align="center" class="smallfonttext"><?php echo $rdate; ?></td>
	<td align="center" class="smallfonttext"><?php echo $amount; ?></td>
  <td align="center" class="smallfonttext"><?php echo $stax; ?></td>
   
     <td align="center" class="smallfonttext"><?php echo ceil($net); ?></td>
   
   
  </tr>
  
  <?php }}}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
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