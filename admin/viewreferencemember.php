<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$aid=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `referencemembers` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	$memId =$userData[1];
	$name=getTabledataById("name","titles",$userData[2])." ".$userData[3];
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
						<h3>Family Member</h3>
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
								<h4><i class="icon-reorder"></i> View Reference Member detail </h4>
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
				<td align="left" class="blackbold">Name</td>
				<td><strong><?php echo htmlentities(stripslashes($name)) ?></strong></td>
				<td></td>
				</tr>
               
                  
                <tr >
				<td align="left" class="blackbold">Email</td>
				<td><?php echo htmlentities(stripslashes($userData[4])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
				
                
                 <tr >
				<td align="left" class="blackbold">Contact</td>
				<td><?php echo htmlentities(stripslashes($userData[5])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
              
                
               
             
			
                
				
                
                
                
                
                
                <tr>
				<td  class="blackbold" colspan="3" align="center"><input style="width:200px;" type="button" name="cancel" value="  Go Back  " onClick="javascript:window.location.href='referencemembers.php?aid=<?php echo base64_encode($memId); ?>'" class="btn"> </td>
				
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