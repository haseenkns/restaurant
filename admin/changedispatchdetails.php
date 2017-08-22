<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);


if(isset($_GET['id'])&&$_GET['id']!=''){
	$dipatchid=$_GET['id'];
	$id=getMemIdByDispId($dipatchid);
	$edtQry=mysql_query("Select * from `members` where `id`='$id'");
	$userData=mysql_fetch_row($edtQry);	
	$dispatchDetail=getDispatchDetailById($dipatchid);
	
}

if(isset($_POST['submit'])){
	extract($_POST);
	
	$pdate=date("d/m/Y");
	$ptime=date("h:i a");
     $remarks=mysql_real_escape_string($remarks);

	$excQry=mysql_query("UPDATE `dispatchlist` SET `status`='$status' ,`ptime`='$ptime',`pdate`='$pdate' ,`postedby`='$adminId' ,`remarks`='$remarks'  where  `id` ='$hidId'");
	if($excQry){
		header("location:changedispatchdetails.php?msg=ups&id=$hidId");	
	}else{
		header("location:changedispatchdetails.php?msg=upf&id=$hidId");		
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
						<h3>Dispatch details</h3>
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='postpackreport.php'">&laquo; &nbsp;Go Back To Post Pack List</span>
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
				<td width="30%" align="left" class="blackbold">Membership Date</td>
				<td width="45%"><b style="color:#09C;"><?php echo trim($userData[26]) ?></b></td>
				<td width="25%"><div class="validateText"></div></td>
				</tr>
                
               
                 <tr >
				<td align="left" class="blackbold"> Member Name </td>
				<td><div style="font-weight:bold"><?php echo getMemberNameByCardType($id); ?></div></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Membership Number</td>
				<td><?php echo getMemberShipNumber($userData[1],$id) ?></td>
				<td><div class="validateText">&nbsp;</div></td>
				</tr>
                
               
               
                
                
                <tr >
				<td align="left" class="blackbold">  Courier Name</td>
				<td><?php echo getTableDataById("name","courier",$dispatchDetail[6]); ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">  Courier No(AWB No)</td>
				<td><?php echo stripslashes($dispatchDetail[7]); ?></td>
				<td><div class="validateText">Unique Doc/Awb No</div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Courier Date</td>
				<td><?php echo stripslashes($dispatchDetail[8]); ?></td>
				<td><div class="validateText"> Date of Dispatch </div></td>
				</tr>
                
                    <tr >
                    <td align="left" class="blackbold">Change Status</td>
                    <td><select  name="status"  class="form-control input-width-large">
                    <option value="1" <?php if($dispatchDetail[4]==1){ ?> selected <?php } ?>>In Transit</option>
                    <option value="2" <?php if($dispatchDetail[4]==2){ ?> selected <?php } ?>>Received</option>
                    <option value="3" <?php if($dispatchDetail[4]==3){ ?> selected <?php } ?>>Returned</option>
                    </select></td>
                    <td><div class="validateText"> Change status of dispatch </div></td>
                    </tr>
                    <tr>
                      <td align="left" class="blackbold">Remarks ( If any )</td>
                      <td  class="blackbold" colspan="2" align="left"><input type="text" name="remarks" class="form-control input-width-xxlarge" value="<?php echo stripslashes($dispatchDetail[9]); ?>"></td>
                    </tr>
                    <tr>
                <td></td>
				<td  class="blackbold" colspan="2" align="left"><input type="hidden" name="hidId" value="<?php echo $dipatchid; ?>"><input style="width:200px;" type="submit" name="submit" value="  Submit Details  "  class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:120px;" type="button" name="cancel" value="  Go Back" onClick="javascript:window.location.href='postpackreport.php'" class="btn"> </td>
				
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