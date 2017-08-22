<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);





if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$aid=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `programs` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
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
						<h3>Programs</h3>
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='addprograms.php'">&laquo; &nbsp; Go Back To Programs</span>
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
								<h4><i class="icon-reorder"></i> View Program detail ( <?php echo getProgramCode($aid); ?> )</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0"  cellpadding="6" cellspacing="1"  id="table1"  style="background-color:#FDFBB9">
             
              <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Personal Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                <tr  >
				<td align="left" class="blackbold"> Program Name *</td>
				<td><?php echo htmlentities(stripslashes($userData[1])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Official Email *</td>
				<td><?php echo htmlentities(stripslashes($userData[2])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Alternate Email</td>
				<td><?php echo htmlentities(stripslashes($userData[3])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Address Line 1</td>
				<td><?php echo htmlentities(stripslashes($userData[4])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Address Line 2</td>
				<td><?php echo htmlentities(stripslashes($userData[5])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Official Contact No *</td>
				<td><?php echo htmlentities(stripslashes($userData[6])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Alternate Contact No</td>
				<td><?php echo htmlentities(stripslashes($userData[7])) ?></td>
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
				<td align="left" class="blackbold">Membership Start No</td>
				<td><?php echo htmlentities(stripslashes($userData[8])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
               
                <tr >
				<td align="left" class="blackbold"> Voucher Start No</td>
				<td><?php echo htmlentities(stripslashes($userData[9])) ?></td>
				<td><div class="validateText">&nbsp;</div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Membership Preffix </td>
				<td><?php echo htmlentities(stripslashes($userData[10])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> Membership Suffix </td>
				<td><?php echo htmlentities(stripslashes($userData[11])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-inr "></i>&nbsp;Financial Info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <?php
					$execQry=mysql_query("select * from `program_price` where `prog_id`='$aid'  order by `id` desc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
						$pricecount=0;
					while($fetch=mysql_fetch_array($execQry)){
						$pricecount++;
						?>
					<tr >
				<td align="left" class="blackbold">Price Level <?php echo $pricecount;  ?></td>
				<td><?php echo $fetch[2] ?></td>
				<td><div class="validateText"></div></td>
				</tr>
					<?php }
					}else{?>
						<tr >
				<td align="left" class="blackbold">Price Level </td>
				<td>Not Defined Yet</td>
				<td><div class="validateText"></div></td>
				</tr>
					<?php }
				?>
                
                
                
                
               
               
             
                
                <tr>
				<td  class="blackbold" colspan="3" align="center"><input style="width:200px;" type="button" name="cancel" value="  Go Back  " onClick="javascript:window.location.href='addprograms.php'" class="btn"> </td>
				
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