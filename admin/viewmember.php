<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$aid=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `members` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
		$progId=$userData[1];
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $aid;
		$memNumber=$preffix."".$memId."".$suffix;
		$name=getTabledataById("name","titles",$userData[2])." ".$userData[3]." ".$userData[4]." ".$userData[5];
	
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
						<h3>Members</h3>
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='members.php'">&laquo; &nbsp; Go Back To Members</span>
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
								<h4><i class="icon-reorder"></i> View Member detail ( <?php echo $memNumber ; ?> )</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
             
              <tr>
                <td class="rgt1" >&nbsp;</td>
                <td valign="top">
                <table width="100%" border="0">
                
                <tr >
				<td align="left"  colspan="2" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="2"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-signin"></i>&nbsp;Personal info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="2" height="10px;"></td>
				</tr>
  <tr>
    <td>
        <table width="100%"  cellpadding="4" cellspacing="1" border="0">
         
                <tr >
                    <td align="left" class="blackbold">  Name </td>
                    <td><strong><?php echo htmlentities(stripslashes($name)) ?></strong></td>
                    <td></td>
                </tr>
                
                <tr>
                    <td align="left" class="blackbold">Gender</td>
                    <td><?php echo getTabledataById("name","genders",$userData[6]); ?></td>
                    <td></td>
                </tr>
                
                
                 <tr>
                    <td align="left" class="blackbold">Name on card</td>
                    <td><?php echo htmlentities(stripslashes($userData[38])) ?></strong></td>
                    <td></td>
				</tr>
                
                
                <tr>
                    <td align="left" class="blackbold">Designation</td>
                    <td><?php echo htmlentities(stripslashes($userData[39])) ?></td>
                    <td></td>
				</tr>
                
                <tr>
                    <td align="left" class="blackbold">Company Name</td>
                    <td><?php echo htmlentities(stripslashes($userData[40])) ?></td>
                    <td></td>
				</tr>
                
                
                
                
				<tr >
				<td align="left" class="blackbold">  Email </td>
				<td><?php echo htmlentities(stripslashes($userData[7])) ?></td>
				<td></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">  Primary Contact</td>
				<td><?php echo htmlentities(stripslashes($userData[8])) ?></td>
				<td></td>
				</tr>
                
                	<tr >
				<td align="left" class="blackbold">  Secondary Contact</td>
				<td><?php echo htmlentities(stripslashes($userData[9])) ?></td>
				<td></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold"> Date Of Birth</td>
				<td><?php echo htmlentities(stripslashes($userData[10])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
              
              
               <tr >
				<td align="left" class="blackbold"> Telephone Res</td>
				<td><?php echo htmlentities(stripslashes($userData[31])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold"> Telephone Off</td>
				<td><?php echo htmlentities(stripslashes($userData[32])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold">Marital Status *</td>
				<td><?php echo getTabledataById("name","maritals",$userData[11]); ?></td>
				<td></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Date Of Annv.</td>
				<td><?php echo htmlentities(stripslashes($userData[12])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                <tr >
				<td align="left" class="blackbold"> Address Type</td>
				<td><?php if($userData[43]==1){ echo "Residential";}else{echo"Official";} ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Address Line 1</td>
				<td><?php echo htmlentities(stripslashes($userData[13])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Address Line 2</td>
				<td><?php echo htmlentities(stripslashes($userData[14])) ?></td>
				<td></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> State</td>
				<td><?php echo getTabledataById("name","state",$userData[15]); ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> City</td>
				<td><?php echo getCitiesNameById($userData[16]); ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Pincode</td>
				<td><?php echo htmlentities(stripslashes($userData[18])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
         
        </table>
    </td>
    <td valign="top">
    
    <table width="100%" border="0" cellpadding="4" cellspacing="1">
    
    <tr >
				<td align="left" class="blackbold"> Program Name </td>
				<td><strong><?php echo htmlentities(stripslashes($progName)) ?></strong></td>
				<td></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold">  Consultants name </td>
				<td><?php echo getAdminNameById($userData[30]); ?></td>
				<td></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold">  Voucher no </td>
				<td><?php echo htmlentities(stripslashes($userData[42])) ?></td>
				<td></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold">  Date of Sale </td>
				<td><?php echo htmlentities(stripslashes($userData[29])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold">  Spouse Name </td>
				<td><?php echo htmlentities(stripslashes($userData[33])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold">  Spouse Mobile </td>
				<td><?php echo htmlentities(stripslashes($userData[35])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold">  Spouse Email </td>
				<td><?php echo htmlentities(stripslashes($userData[34])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold">  Spouse Dob </td>
				<td><?php echo htmlentities(stripslashes($userData[36])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Spouse Card </td>
				<td><?php if($userData[41]==1){ echo "Yes";}else{echo"No";} ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Source Name</td>
				<td><?php echo htmlentities(stripslashes($userData[19])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Remarks</td>
				<td><?php echo htmlentities(stripslashes($userData[37])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Referred By</td>
				<td><?php if($userData[50]!=0){ ?> 
				<?php echo getMemberNameById($userData[50]) ?> <br/>(<?php $mid=getMembersDetailById($userData[50]); $prgid=$mid[1]; echo getMemberShipNumber($prgid,$userData[50]) ?>)<br/> <?php echo getMemberContact($userData[50]); ?>
                <?php } else{ ?>
                None
                <?php } ?>
                </td>
				<td><div class="validateText"></div></td>
				</tr>
    
    </table>
    </td>
  </tr>
</table>

                
                
                
                
                

<table width="100%" border="0" cellpadding="8" cellspacing="1">
      
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-signin"></i>&nbsp;Payment info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				</tr>
                <?php
				if($userData[45]==1){
				?>
                <tr >
				<td align="left" class="blackbold"> Membership</td>
				<td width="42%"><b>Complimentry</b></td>
				<td width="33%"> </td>
				</tr>
                <?php }else{ ?>
                
				<tr >
				<td align="left" class="blackbold"> Amount (Rs)</td>
				<td width="42%"><?php echo htmlentities(stripslashes($userData[21])) ?></td>
				<td width="33%"> </td>
				</tr>
				
                <tr>
				<td align="left" class="blackbold"> Mode of Payment </td>
				<td><?php echo getTabledataById("name","paymentmodes",$userData[22]); ?></td>
				<td></td>
				</tr>
                
                <tr>
				<td align="left" class="blackbold">Payment Details </td>
				<td><div>
                <table width="100%"  cellpadding="5" cellspacing="1" style="border:#CCC dotted 1px;background:#F4F4F4;">
                 
                 <?php
					$execQry=mysql_query("select * from `paymentstats` where `mode` = '$aid' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){
						
						?>
						<tr>
                    <td><?php echo getPaymentFieldNameById(stripslashes($fetch['stats'])); ?></td>
                    <td><?php echo stripslashes($fetch['svalues']); ?></td>
                  </tr>
					<?php }}else{?>
							<tr>
                    <td colspan="2">No Payment Details</td>
                   
                  </tr>
					<?php }	 ?>
                  
                 
                 
                 
                </table>
                
                </div></td>
				<td></td>
				</tr>
              
                
                <tr >
				<td align="left" class="blackbold">Pickup</td>
				<td><?php  if($userData[23]==1){ echo "Manually";}else{ echo "Transferred";} ?>&nbsp;&nbsp;
               <?php if($userData[23]==1){ echo "By -- ".getTabledataById("firstname","admin",$userData[24]); }else{'';} ?>
                </td>
				<td> </td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Credited on</td>
				<td width="42%"><?php echo htmlentities(stripslashes($userData[44])) ?></td>
				<td width="33%"> </td>
				</tr>
                <?php } ?>
                
                
                <tr >
				<td align="left" class="blackbold"> Tenure</td>
				<td width="42%"><?php echo getTabledataById("name","tenures",$userData[25]); ?> Months</td>
				<td width="33%"> </td>
				</tr>
                               
				
                
                
                
                <tr>
				<td  class="blackbold" colspan="3" align="center"><input style="width:200px;" type="button" name="cancel" value="  Go Back  " onClick="history.go(-1)" class="btn"> </td>
				
				</tr>
                
</table>



</td>
              </tr>
			 
          </table>
          
          

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