 <?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$encId=$_GET['aid'];
	$aid=base64_decode($_GET['aid']);
	$aids=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `leads` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	$leadId=getLeadId($aid);
	$leadType=$userData[25];
	$bde=getEmployeeNameById($userData[17]);
	
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
						<h3>Leads</h3>
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='viewleads.php'">&laquo; &nbsp; Go Back To View Leads</span>
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
								<h4><i class="icon-reorder"></i> View Lead detail ( <?php echo $leadId ; ?> )</h4>
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
                    <td><strong><?php echo htmlentities(getClientsNameById($aid)) ?></strong></td>
                    <td></td>
                </tr>
                
                <tr>
                    <td align="left" class="blackbold">Company Name</td>
                    <td><b><?php echo htmlentities(stripslashes($userData[19])) ?></b></td>
                    <td></td>
				</tr>
                
                
                
                
				<tr >
				<td align="left" class="blackbold">  Email </td>
				<td><?php echo htmlentities(stripslashes($userData[4])) ?></td>
				<td></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">  Primary Contact</td>
				<td><?php echo htmlentities(stripslashes($userData[5])) ?></td>
				<td></td>
				</tr>
                
                	<tr >
				<td align="left" class="blackbold">  Secondary Contact</td>
				<td><?php echo htmlentities(stripslashes($userData[6])) ?></td>
				<td></td>
				</tr>
               
                <tr >
				<td align="left" class="blackbold"> Address Type</td>
				<td><?php if($userData[20]==1){ echo "Residential";}else{echo"Official";} ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Address Line 1</td>
				<td><?php echo htmlentities(stripslashes($userData[8])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Address Line 2</td>
				<td><?php echo htmlentities(stripslashes($userData[9])) ?></td>
				<td></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> State</td>
				<td><?php echo getTabledataById("name","state",$userData[10]); ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> City</td>
				<td><?php echo getCitiesNameById($userData[11]); ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Area</td>
				<td><?php echo htmlentities(getAreaNameById($userData[12])) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Assignment</td>
				<td><?php echo getAssignmentsNameById($userData[21]) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                  <tr >
				<td align="left" class="blackbold"> Subassignment</td>
				<td><?php echo getSubAssignmentsNameById($userData[23]) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                  <tr >
				<td align="left" class="blackbold"> Sub Sub Assignment</td>
				<td><?php echo getSubSubAssignmentsNameById($userData[31]) ?></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold"> <b style="color:#333">BDE</b></td>
				<td><span style="color:#069;"><?php echo $bde; ?></span></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold"></td>
				<td><input type="button" class="btn" value="Go Back" onClick="history.back(-1)">&nbsp;&nbsp; <?php if($leadType==1) { ?><input type="button" class="btn" value="Add Followup" onClick="window.location.href='addfollowups.php?id=<?php echo $encId; ?>'"> <?php } ?></td>
				<td><div class="validateText"></div></td>
				</tr>
         
        </table>
    </td>
  
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
                
                 <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View Past Conversation</h4>
							</div>
							
                                    
                                    
                            <div class="widget-content">        
                              
                                    
                                    
                                  <div class="form-group">
										
                                        <div class="row">
                                           
												<div class="col-md-12">
                                                	
                                                   <?php /*?><table width="100%" border="0" class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable" >
  <tr>
    <td width="12%">Posted date</td>
    <td width="60%">Conversation</td>
    <td>Followup Date</td>
    <td>Followup Time</td>
  <!--  <td>Status</td>-->
    
  </tr>
  <?php
     //echo " (select `pdate`,`conversation`,`meetingdate`,`meetingtime` from `followups` where `status` = '1' and `lid`='$aid') union (select `createdon`,`conversation`,`meetingdate`,`meetingtime`  from `leads` where `status` = '1' and `id`='$aid' ) union (select `pdate`,`conversation`,`meetingdate`,`meetingtime`  from `meetings` where `status` = '1' and `lid`='$aid' )  ";
  
  
  $execQry=mysql_query(" (select `pdate`,`conversation`,`meetingdate`,`meetingtime`,`ptime` from `followups` where `status` = '1' and `lid`='$aid') union (select `createdon`,`conversation`,`meetingdate`,`meetingtime`,`createdtime`  from `leads` where `status` = '1' and `id`='$aid' ) union (select `pdate`,`conversation`,`meetingdate`,`meetingtime` ,`ptime`  from `meetings` where `status` = '1' and `lid`='$aid' )  order by `pdate`,`ptime` asc ");
    $numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){?>
        <tr>
                <td><?php echo stripslashes($fetch['pdate']); ?></td>
                <td><i><?php echo stripslashes($fetch['conversation']); ?></i></td>
                <td><?php echo changeToStdDate($fetch['meetingdate']); ?></td>
                <td><?php echo stripslashes($fetch['meetingtime']); ?></td>
             <!--   <td>&nbsp;</td>-->
                
        </tr>
		<?php }}else{?>
			<tr>
                <td>---</td>
                <td>No Conversations yet</td>
                <td>---</td>
                <td>---</td>
              <!--  <td>---</td>-->
		  </tr>
	<?php }
  ?>
  
  
</table><?php */?>
 
                                                    <?php echo showPastConversation($aids); ?>
                                                    
                                                    
                                                    
												</div>
												
												
											</div>
										
										
                                             
										
                                        
                                        	
                                            
                                            
                                         
										
									</div>  
                                    
                                   
                            </div>        
                            
                            </div>
                            </div>
                            </div>
			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>