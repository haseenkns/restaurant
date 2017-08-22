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
	
	if( isset($_GET['pg']) ){
		$pg =$_GET['pg'];
		$getTableMemIds=searchMembersByDateOfsaleAndCashPickup($pg,$start,$end);
	}else{
		$getTableMemIds=allMembersByCashPickup()	;
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
			//alert(id)
		});
			//return false;
		}
		
    </script>
    
    <script>
		function seachByDate(start,end,program){
		
				if(start=='')start=0;
				if(end=='')end=0;
				if(start==0 || end==0){
					errorMsg("Please select start and end date","startdate")
					return false
				}
				
				window.location.href="cashpickupreport.php?start="+start+"&end="+end+'&pg='+program;	
			
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
						<h3>Members</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

          			<form action="" method="post">
                   <div class="col-md-10" style="float:right;margin-top:5px;text-align:right;">
                   <div class="row">
                    <div class="col-md-2" style="padding-top:6px;">Search by </div>
                     <div class="col-md-2" style="padding-top:6px;"><select name="program" id="program" class="form-control "  ><option value="0">Program</option>
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
                   <div class="col-md-1"><input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control input-width-small datepicker" style="border-radius:5px;"></div>
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
								<h4><i class="icon-reorder"></i> Cash Pickup Reports </h4>
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
             <th  data-hide="phone,tablet">Preview</th>
             <th>Program</th>
             <th  data-hide="phone">Member Name</th>
            <th  data-hide="phone">Mem No</th>
            <th data-hide="phone,tablet">Mem Fees</th>
            <th data-hide="phone,tablet" style="text-align:center;">Mem Date</th>
            <th  data-hide="phone,tablet" style="text-align:center;">Payment Mode</th>
            <th  data-hide="phone,tablet" style="text-align:">Credit Recv</th>
            <th  data-hide="phone,tablet" style="text-align:center;">Details</th>
            
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
 	//print_r($getTableMemIds);
	if(!$getTableMemIds[0]==0){
		foreach($getTableMemIds as $mids){
		//$tableDataArr=getTableReservationDetailsId($mids);
		//$membid=$tableDataArr[1];	
			
        $memDataArr=getMembersDetailById($mids);
		$i++;
		$progId=$memDataArr[1];
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $mids;
		$complimentry=$memDataArr[45];
		$memDate=$memDataArr[29];
		
		$memNumber=$preffix."".$memId."".$suffix;
		$name=getTabledataById("name","titles",$memDataArr[2])." ".$memDataArr[3]." ".$memDataArr[4]." ".$memDataArr[5];
		$pickupMember=getEmployeeNameById($memDataArr[24]);
		/*$reservationDate=$tableDataArr[16];
		$pax=$tableDataArr[15];
		$benefits=$tableDataArr[13];
		if($benefits==1){
		$benefitText="Complimentry";	
		}
		
		if($benefits==2){
		$benefitText="Paid";	
		}
		
		$addInfo=$tableDataArr[14];
		$status=$tableDataArr[4];
		$restaurent=$tableDataArr[11];
		
		if($status==0){
			$statusText="Pending";
		}
		if($status==1){
			$statusText="Confirmed";
		}
		if($status==2){
			$statusText="Cancelled";
		}
		*/
		
		
		$paymentMode=$memDataArr[22];
		if($paymentMode==0){
			$addInfo="Complimentry Membership";
			$paymentText="Complimentry";	
		}else{
			$paymentText=getTabledataById("name",'paymentmodes',$paymentMode);	
			
			$addInfo=getBankTransactionDetailsByMemId($mids)." / Picked By -".$pickupMember;
		}
		
		
		
		
	
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewmember.php?aid=<?php echo base64_encode( $mids); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
        <td align="left" class="smallfonttext"><?php echo $name; ?></td>
        <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
        <td align="left" class="smallfonttext"><?php echo getProgramPriceById($memDataArr[28]); ?></td>
        <td align="left" class="smallfonttext"><?php echo $memDate; ?></td>
        <td align="center"  class="smallfonttext" ><?php echo $paymentText; ?></td>
        <td align="left" class="smallfonttext"><?php echo $memDataArr[44]?></td>
        <td align="left" class="smallfonttext"><span style="cursor:pointer;" class="bs-popover"  data-trigger="hover" data-placement="top" data-content="<?php echo stripslashes($addInfo) ;?>" data-original-title="Additional Info">View Details</span></td>
    
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

</body>
</html>