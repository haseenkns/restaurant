<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);


if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$aid=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `admin` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	$reportToDesignation=getEmployeeDesignationbyReportToId($userData[16]);
	
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

	
	<script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>


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
						<h3>Employee</h3>
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='addusers.php'">&laquo; &nbsp; Go Back To Employees</span>
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
								<h4><i class="icon-reorder"></i> View Employee detail ( <?php echo getCode($aid); ?> )</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
             
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top"><table width="98%" border="0" cellpadding="6" cellspacing="0" class="grayfour">
			
                  <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Personal Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold"> First Name <span class="required">*</span></td>
				<td><strong><?php echo htmlentities(stripslashes($userData[8])) ?></strong></td>
				<td></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Last Name *</td>
				<td><b><?php echo htmlentities(stripslashes($userData[9])) ?></b></td>
				<td></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">  Email *</td>
				<td><?php echo htmlentities(stripslashes($userData[3])) ?></td>
				<td></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">  Contact</td>
				<td><?php echo htmlentities(stripslashes($userData[5])) ?></td>
				<td></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Date Of Birth</td>
				<td><?php echo htmlentities(stripslashes($userData[10])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold">Address</td>
				<td><?php echo htmlentities(stripslashes($userData[20])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-briefcase "></i>&nbsp;Official Info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold">Designation *</td>
				<td><?php echo getDesignationNameById($userData[11]); ?></td>
				<td></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Off.  Contact No</td>
				<td><?php echo htmlentities(stripslashes($userData[8])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                 <tr >
				<td align="left" class="blackbold"> Bank Acount Number</td>
				<td><?php echo htmlentities(stripslashes($userData[21])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold">Bank Name</td>
				<td><?php echo htmlentities(stripslashes($userData[22])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold"> Pan Card</td>
				<td><?php echo htmlentities(stripslashes($userData[23])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
               
                <tr >
				<td align="left" class="blackbold"> Joining Date</td>
				<td><?php echo htmlentities(stripslashes($userData[13])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                 
                
                
                
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-signin"></i>&nbsp;Financial info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                 <tr >
				<td align="left" class="blackbold"> Salary Type</td>
				<td><?php if($userData[24]==1){echo "Monthly";} if($userData[24]==2){echo "Hourly";} ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Salary</td>
				<td><?php echo htmlentities(stripslashes($userData[14])) ?>/<?php if($userData[24]==1){echo "Month";} if($userData[24]==2){echo "Hour";} ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold">HRA</td>
				<td><?php echo htmlentities(stripslashes($userData[25])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Medical</td>
				<td><?php echo htmlentities(stripslashes($userData[26])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold">  Conveyance (Rs)</td>
				<td><?php echo htmlentities(stripslashes($userData[27])) ?></td>
				<td></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Taxable Salary</td>
				<td><?php if($userData[28]==1){echo "Yes";} if($userData[28]==2){echo "No";} ?></td>
				<td></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold"> Target (Rs)</td>
				<td><?php echo htmlentities(stripslashes($userData[15])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                
                
                
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-signin"></i>&nbsp;Login</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
				<tr >
				<td align="left" class="blackbold"> Username *</td>
				<td width="42%"><?php echo htmlentities(stripslashes($userData[1])) ?></td>
				<td width="33%"> </td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Password *</td>
				<td><?php echo htmlentities(stripslashes($userData[2])) ?></td>
				<td></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">Confirm Password*</td>
				<td><?php echo htmlentities(stripslashes($userData[2])) ?></td>
				<td></td>
				</tr>
                
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-copy"></i>&nbsp;Reporting</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
			
                
				
                
                
                
                <tr >
				<td align="left" class="blackbold">Report To *</td>
				<td><div class="col-md-3" style="padding-left:0px;"><?php echo getDesignationNameById($reportToDesignation); ?></div><div class="col-md-3" id="empDiv"><?php echo getAdminNameById($userData[16]); ?></div><div class="col-md-6" >Reporting :  <?php if($userData[19]==0){ echo "Yes";}else{ echo "No";} ?> </div></td>
				<td><div class="validateText"></div></td>
				</tr>
				
                
                <tr>
				<td align="left" class="blackbold">Assign Privileges *</td>
				<td><?php echo getRolesNameById($userData[17]); ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr>
				<td  class="blackbold" colspan="3" align="center"><input style="width:200px;" type="button" name="cancel" value="  Go Back  " onClick="javascript:window.location.href='addusers.php'" class="btn"> </td>
				
				</tr>
                
                
				
				
				
</table></td>
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
