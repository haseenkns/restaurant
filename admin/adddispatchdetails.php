<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);


if(isset($_GET['id'])&&$_GET['id']!=''){
	$id=$_GET['id'];
	$edtQry=mysql_query("Select * from `members` where `id`='$id'");
	$userData=mysql_fetch_row($edtQry);	
}

if(isset($_POST['submit'])){
	extract($_POST);
	
	$pdate=date("d/m/Y");
	$ptime=date("h:i a");
    $cname=mysql_real_escape_string($cname);
	$cdate=mysql_real_escape_string($cdate);
	$cnumber=mysql_real_escape_string($cnumber);

	$excQry=mysql_query("INSERT INTO `dispatchlist` (`id`, `mem_id`, `pdate`, `ptime`, `status`, `postedby`,`cname`,`cnumber`,`cdate`) VALUES (NULL, '$id', '$pdate', '$ptime', '1', '$adminId','$cname','$cnumber','$cdate');");
	if($excQry){
		header("location:thanksdispatch.php?msg=dns");	
	}else{
		header("location:thanksdispatch.php?msg=dnf");		
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
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='dispatchreport.php'">&laquo; &nbsp;Go Back To Dispatch List</span>
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
				<td align="left" class="blackbold"> Card Type </td>
				<td><?php echo getMemberCardType($id) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
             
                
                 <tr >
				<td align="left" class="blackbold"> Voucher Number</td>
				<td><?php echo htmlentities(stripslashes($userData[42])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold"> Add Courier Name</td>
				<td>
                <select name="cname" id="cname" class="form-control input-width-xlarge"  ><option value="0">Select Courier</option>
                                       
				<?php
					$execQry=mysql_query("select * from `courier` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($courier==$fetch['id']){ ?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Courier</option>
					<?php } ?>
                
                </select>
             
                
                
                </td>
				<td><div class="validateText">Enter Name of Courier</div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Add Courier No(AWB No)</td>
				<td><input type="text" name="cnumber" class="form-control input-width-xlarge"></td>
				<td><div class="validateText">Enter unique Doc/Awb No</div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Courier Date</td>
				<td><input type="text" name="cdate" class="form-control input-width-xlarge datepicker"></td>
				<td><div class="validateText">Enter Date of Dispatch </div></td>
				</tr>
                
                
                <tr>
                <td></td>
				<td  class="blackbold" colspan="2" align="left"><input type="hidden" name="hidMid" value="<?php echo $id ?>"><input style="width:200px;" type="submit" name="submit" value="  Submit Details  " onClick="javascript:window.location.href='dispatchreport.php'" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:120px;" type="button" name="cancel" value="  Go Back" onClick="javascript:window.location.href='dispatchreport.php'" class="btn"> </td>
				
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