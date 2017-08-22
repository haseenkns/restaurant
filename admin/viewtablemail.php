<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);


if(isset($_GET['id'])&&$_GET['id']!=''){
	$rid=$_GET['id'];
	$edtQry=mysql_query("Select * from `tablemail` where `id`='$rid'");
	$userData=mysql_fetch_row($edtQry);	
	$memId=$userData[1];
	$progId=$userData[10];
	$memNumber=getMemberShipNumber($progId,$memid);
	$progDetail=getProgramDescriptionById($progId);
	$progName=$progDetail[1];
	$name=getMemberNameById($memId);
}

if(isset($_POST['submit'])){
	extract($_POST);
	
	$pdate=date("d/m/Y");
	$ptime=date("h:i a");
    $remarks=mysql_real_escape_string($remarks);

	$excQry=mysql_query("UPDATE `roommail` SET `status`='$status'  where  `id` ='$hidId'");
	if($excQry){
		header("location:roomconfirmations.php?msg=scs");	
	}else{
		header("location:roomconfirmations.php?msg=scf");		
	}
	
}

if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	
	case 'ups':
		$msg='Dispatch Status has been updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Dispatch Status not updated Successfully !!';
		$class='danger';
	break;
	
	case 'dns':
		$msg='Dispatch executed Successfully';
		$class='danger';
	break;
	case 'dnf':
		$msg='Dispatch not executed Successfully';
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
						<h3>Room Reservation details</h3>
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='roomconfirmations.php'">&laquo; &nbsp;Go Back </span>
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Add details </h4>
							</div>
							<div class="widget-content">
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
								<form action=""  method="post" >
                          		      <table width="100%" border="0"  cellpadding="10" cellspacing="1"  id="table1"  style="background-color:#FDFBB9">
             
             
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-briefcase "></i>&nbsp; Info</b></div></td>
				
				</tr>
               
               
               
                 <tr >
				<td width="17%" align="left" class="blackbold"> Member Name </td>
				<td width="55%"><div style="font-weight:bold"><?php echo $name; ?></div></td>
				<td width="28%"><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Membership Number</td>
				<td><?php echo $memNumber; ?></td>
				<td><div class="validateText">&nbsp;</div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Program Name</td>
				<td><?php echo $progName; ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">From </td>
				<td><?php echo stripslashes($userData[8]); ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">To</td>
				<td><?php echo stripslashes($userData[9]); ?></td>
				<td><div class="validateText"> </div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold">Posted On</td>
				<td><?php echo $userData[2]." ".$userData[3]; ?></td>
				<td><div class="validateText"> </div></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold">Subject</td>
				<td><?php echo stripslashes($userData[6]); ?></td>
				<td><div class="validateText"> </div></td>
				</tr>
                 <tr >
				<td align="left"  colspan="3"><hr style="border-color:#FEFEE9;"></td>
				
				</tr>
                  <tr >
				<td align="left" class="blackbold">Content</td>
				<td><?php echo stripslashes($userData[7]); ?></td>
				<td><div class="validateText"> </div></td>
				</tr>
                
                
                
                    
                   
                    <tr>
                <td></td>
				<td  class="blackbold" colspan="2" align="left"><input style="width:120px;" type="button" name="cancel" value="  Go Back" onClick="history.go(-1)" class="btn"> </td>
				
				</tr>
                
                
				
				
				
</table>
                                </form>
          

							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                
			</div>
			<!-- /.container -->

		</div>
	</div>
   
</body>
</html>