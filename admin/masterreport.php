<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
$admtype=$_SESSION['type'];

include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("Y")."-".date("m")."-".date("d");


if(isset($_GET['teamid'])&&$_GET['teamid']!=''){	
	$mainId=$_GET['teamid'];

}else{
	$mainId=$adminId;
}

$memberArr = array();


$memberArr=displayMembers($mainId);
$hasChild=checkMemberHasChild($mainId);
if(!$hasChild){
	array_push($memberArr,$mainId);
}

//var_dump($memberArr);
$teamArr=array_unique($memberArr);
//print_r($team);
//$todaysFollowups=getTodaysFollowupsByTeam($qry);
if(isset($_GET['month'])&&$_GET['month']!=''){	
		$curMonth=$_GET['month'];
		$curYear=$_GET['year'];
	
	}else{
		$curMonth=date("m");
		$disMonth=(int)(date("m")-1);
		$curYear=date("Y");
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
						<h3>Master Report</h3>
						<span style="color:#F00;"> <?php  echo getMonth($disMonth)." , ".$curYear; ?><br/> <a href="masterreport.php">Go Back To Master Report</a>  </span>
					</div></div>
                <div class="col-md-8" ><?php /*?><div class="page-titles" style="text-align:right;padding-top:20px;">
						<h6>
                        
                        <div class="form-group">
                       <div class="row">
                   <div class="col-md-2" style="padding-top:10px;" ><a href="followupreports.php?todayfollowups">Today<span> ( <?php echo $todaysFollowups; ?> )</span></a></div>
                   <div class="col-md-2" style="padding-top:10px;" ><a href="followupreports.php">View All</a></div>
                   <div class="col-md-2" style="padding-top:10px;" >Follow ups between :</div>
                   <div class="col-md-2" ><input type="text"  id="sdate"   placeholder="Start Date" class="form-control input-width datepicker"  ></div>
                   <div class="col-md-2"><input type="text"  id="edate"   placeholder="End Date" class="form-control input-width datepicker" ></div>
                           
                            
                            <div class="col-md-1"><input onClick="searchFollowups(document.getElementById('sdate').value,document.getElementById('edate').value)" type="button" class="btn" value="Search"></div>
                        </div>
                        
                        
                        </div>
                        

</h6>
						<!--<span>Good morning, John!</span>-->
					</div><?php */?></div>
                </div>
					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Report </h4>
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
                                            <th width="69"  style="text-align:center">Sno</th>
                                           <th width="159"  data-hide="phone">Name</th>
                                           <th width="99"> No of Leads</th>
                                           <th width="119"  data-hide="phone">No of Meetings</th>
                                           <th width="87"  data-hide="phone">No of Sales</th>
                                           <th width="69"  data-hide="phone">No of NI</th>
                                           <th width="112" data-hide="phone,tablet">Target Assigned</th>
                                           <th width="85"  data-hide="phone"> Target Acheived </th>
                                           <th width="96" style="text-align:center;" data-hide="phone,tablet">Status</th>
									  </tr>
                                        
                                        
									</thead>
									<tbody>
									<?php 
									$myteam=array();
                                	//print_r($teamArr);
									    foreach($teamArr as $teamId){
										$i++;
										//echo $teamId;
										$myteam=displayTeam($teamId);
										//print_r($myteam);
										
										if(count($myteam)==0){
										$myteam[]=$teamId;
										}else{
										array_push($myteam,$teamId);
										
										}
										
										$target=getEffectiveTargetById($teamId);
											$targetAmt=$target;
										if($target==''){
										$target="Not Assigned";
											$targetAmt=0;
										}
										$sales=getSalesByDateAndId($curMonth,$curYear,$myteam);
										
										$acheived=calculateTargetAcheived($curMonth,$curYear,$sales);
										
										$result=$acheived-$targetAmt;
										if($result>0){
											$label="Acheived";	
											$labelClass="success";
										}else{
											$label="Not Acheived";	
											$labelClass="danger";
										}
										//echo $labelclass;
										
										//print_r($sales);
										
									//	die;
										?>
        <tr bgcolor="#FFFFFF">
                                    <td align="center" class="smalltext"><?php echo $i; ?></td>
                                    <td align="left"  ><a href="masterreport.php?teamid=<?php echo $teamId; ?>"  > <?php  echo getEmployeeNameById($teamId) ?></a></td>
                                    <td align="center" class="smallfonttext"><?php  echo getFollowCountByDateAndId($curMonth,$curYear,$myteam); ?></td>
                                    <td align="center" class="smallfonttext"><?php  echo getMeetingCountByDateAndId($curMonth,$curYear,$myteam); ?></td>
                                    <td align="center" class="smallfonttext"><?php  echo getSalesCountByDateAndId($curMonth,$curYear,$myteam); ?></td>
                                    <td align="center" class="smallfonttext"><?php  echo getNICountByDateAndId($curMonth,$curYear,$myteam); ?></td>
                                    <td align="center" class="smallfonttext" style="text-align:center;"><?php echo $target; ?></td>
                                    <td align="center" style="text-align:center;" class="smallfonttext"><?php echo $acheived; ?></td>
                                    <td align="center"  ><span  class="label label-<?php echo $labelClass; ?>"><?php echo $label; ?></span></td>
    </tr>
                                   
                                    <?php unset($teamm);
									print_r($teamm);
									}   ?>
                                    

										
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