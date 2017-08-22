<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

$currentDate=date("d")."/".date("m")."/".date("Y");
	//echo $date = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') + 4, date('Y')));
	//echo mktime(0, 0, 0, date('m'), date('d') + 4, date('Y'));
	//die;
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
	
if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['pg']) ){
		$start=	$_GET['start'];
		$end =$_GET['end'];
		$pg =$_GET['pg'];
		$getCancelledMemIds=searchMembersByValidity($pg,$start,$end);
		
		//print_r($getCancelledMemIds);
	}else{
		$getCancelledMemIds=allmembers()	;
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
    function seachByDate(start,end){
    window.location.href="membersvalidity.php?start="+start+"&end="+end;	
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
    
     <script>
		function seachByDate(start,end,program){
			//if(program==0){
				//window.location.href="cancelledmemberreport.php";
			//}else{
				if(start=='')start=0;
				if(end=='')end=0;
				window.location.href="memberexpiryreport.php?start="+start+"&end="+end+'&pg='+program;	
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
						<h3> Members Validity </h3>
					</div>
                    
                  <form action="" method="post">
                   <div class="col-md-10" style="float:right;margin-top:5px;text-align:right;">
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
                   <div class="col-md-1" style="padding-top:6px;">Expiry Between</div>
                   <div class="col-md-2"><input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control input-width-small datepicker" style="border-radius:5px;"></div>
                   <div class="col-md-1"  style="padding-top:6px;">And</div>
                   <div class="col-md-2"><input type="text" name="enddate" id="enddate" placeholder="End Date" class="form-control input-width-small datepicker"  style="border-radius:5px;"></div>
                    <div class="col-md-1"><button type="button"  name="submit" value=" Search "class="btn"  onClick="seachByDate(document.getElementById('startdate').value,document.getElementById('enddate').value,document.getElementById('program').value)">Search</button></div>
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
								<h4><i class="icon-reorder"></i> Members <a href="reports/membersexpiryreport.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=1&pg=<?php echo $pg ?>"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/membersexpiryreport.php?start=<?php echo $start; ?>&end=<?php echo $end; ?>&type=2&pg=<?php echo $pg ?>"><img src="images/word.png" width="26" height="26"></a></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
                                        <!--<div style="float:left;width:50px;" ><img src="images/pdficon.png" width="20" height="20"></div>-->
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
                                        <th width="15%">Membership No</th>
                                        <th width="20%"  data-hide="phone">Name</th>
                                        <th width="20%"  data-hide="phone">Program</th>
                                          <th width="10%"  data-hide="phone">City,State</th>
                                          <th width="10%"  data-hide="phone">Contacts</th>
                                        <th width="10%"  data-hide="phone">Member Date</th>
                                        <th width="10%"  data-hide="phone">Expiry date</th>
                                       
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Dys left</th>
                                    </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
if(!$getCancelledMemIds[0]==0){
		foreach($getCancelledMemIds as $mids){
        $memDataArr=getMembersDetailById($mids);
		$i++;
		$progId=$memDataArr[1];
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $mids;
		$complimentry=$memDataArr[45];
		
		
		$memNumber=$preffix."".$memId."".$suffix;
		$name=getTabledataById("name","titles",$memDataArr[2])." ".$memDataArr[3]." ".$memDataArr[4]." ".$memDataArr[5];
		$dateofsale=$memDataArr[29];
		$tenure=getTenureById($memDataArr[25]);
		$validdate=getValidUpto($dateofsale,$tenure);
		$contact=getMemberContact($mids);
		$state=getStateNameById($memDataArr[15]);
		$city=$memDataArr[17];
		$statecity=$city.", ".$state;
		
		
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
         <td align="center" class="smalltext"><a href="viewmember.php?aid=<?php echo base64_encode($mids); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
        <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
        <td align="left" class="smallfonttext"><?php echo $name; ?></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($statecity); ?></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($contact); ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($dateofsale); ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($validdate); ?></td>
     
       <td align="left" class="smallfonttext" style="text-align:center;" ><?php echo getDaysLeftToexpire($validdate); ?></td>
    
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
</form>
		</div>
	</div>
<!-- <script language="javascript" type="text/javascript" src="javascript/jquery1.4.js">   </script>
-->

</body>
</html>