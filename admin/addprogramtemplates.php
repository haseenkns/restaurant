<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);


if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$encprogid=$_GET['aid'];
	$aid=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `programs` where `id`='$aid'");
	$progData=mysql_fetch_row($edtQry);
	$excQry=mysql_query("Select * from `templates` where `prog_id`='$aid'");	
	$numRows=mysql_num_rows($excQry);
	if($numRows>0){
		$edit=1;	
	}else{
		$edit=0;	
	}
	
	
	
	
}

if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;
		$program=$hidPid;
		$aid=base64_encode($program);
		$welcome_subject=mysql_real_escape_string($_POST['welcome_subject']);
		$welcome_content=mysql_real_escape_string($_POST['welcome_content']);
		$welcome_remark=mysql_real_escape_string($_POST['welcome_remark']);
		
		$sms_subject=mysql_real_escape_string($_POST['sms_subject']);
		$sms_content=mysql_real_escape_string($_POST['sms_content']);
		
		$room_subject=mysql_real_escape_string($_POST['room_subject']);
		$room_content=mysql_real_escape_string($_POST['room_content']);
		$room_remark=mysql_real_escape_string($_POST['room_remark']);
		
		$room_ack=mysql_real_escape_string($_POST['room_ack']);

		$table_subject=mysql_real_escape_string($_POST['table_subject']);
		$table_content=mysql_real_escape_string($_POST['table_content']);
		$table_remark=mysql_real_escape_string($_POST['table_remark']);
		$table_ack=mysql_real_escape_string($_POST['table_ack']);
		
		
		$pdate=date("d F, Y");
		mysql_query("BEGIN");
		
		$excQry=mysql_query("INSERT INTO `templates` (`id`, `prog_id`, `status`, `pdate`, `welcome_subject`, `welcome_content`, `welcome_remark`, `sms_subject`, `sms_content`, `room_subject`, `room_content`, `room_remark`, `table_subject`, `table_content`, `table_remark`,`room_ack`,`table_ack`) VALUES (NULL, '$program', '1', '$pdate', '$welcome_subject', '$welcome_content', '$welcome_remark', '$sms_subject', '$sms_content', '$room_subject', '$room_content', '$room_remark', '$table_subject', '$table_content', '$table_remark','$room_ack','$table_ack');");
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}
	
	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:addprogramtemplates.php?msg=ins&aid=$aid");					  
	}else{
		mysql_query("REVOKE");
		header("location:addprogramtemplates.php?msg=inf&aid=$aid");	
	}
	
	
}	

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `templates` where `id`='$did'");
		if($delQry){
			header("location:welcome.php?msg=dls&aid=$encprogid");
		}else{
			header("location:welcome.php?msg=dlf&aid=$encprogid");
		}
}


if(isset($_POST['update'])){
	extract($_POST);
		$id=$_POST['hidId'];
		$program=$hidPid;
		$aid=base64_encode($program);
	    
		$welcome_subject=mysql_real_escape_string($_POST['welcome_subject']);
		$welcome_content=mysql_real_escape_string($_POST['welcome_content']);
		$welcome_remark=mysql_real_escape_string($_POST['welcome_remark']);
		
		$sms_subject=mysql_real_escape_string($_POST['sms_subject']);
		$sms_content=mysql_real_escape_string($_POST['sms_content']);
		
		$room_subject=mysql_real_escape_string($_POST['room_subject']);
		$room_content=mysql_real_escape_string($_POST['room_content']);
		$room_remark=mysql_real_escape_string($_POST['room_remark']);
		$room_ack=mysql_real_escape_string($_POST['room_ack']);
		
		$table_subject=mysql_real_escape_string($_POST['table_subject']);
		$table_content=mysql_real_escape_string($_POST['table_content']);
		$table_remark=mysql_real_escape_string($_POST['table_remark']);
		$table_ack=mysql_real_escape_string($_POST['table_ack']);
		
		
	$sqlQry="UPDATE `templates` SET  `welcome_subject` = '$welcome_subject', `welcome_content` = '$welcome_content', `welcome_remark` = '$welcome_remark', `sms_subject` = '$sms_subject', `sms_content` = '$sms_content', `room_subject` = '$room_subject', `room_content` = '$room_content', `room_remark` = '$room_remark', `table_subject` = '$table_subject', `table_content` = '$table_content', `table_remark` = '$table_remark' ,`room_ack`='$room_ack',`table_ack`='$table_ack'  WHERE `templates`.`id` = $id;";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:addprogramtemplates.php?msg=ins&aid=$aid");	
	}else{
		header("location:addprogramtemplates.php?msg=ins&aid=$aid");	
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
						<h3><b><?php echo stripslashes($progData[1]) ?></b> Templates</h3>
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
								<h4><i class="icon-reorder"></i> Add Program Templates ( <?php echo getProgramCode($aid); ?> )</h4>
							</div>
							<div class="widget-content">
                            <form action="" method="post">
                            <?php if($edit==1){
								//echo "Select * from `templates` where `prog_id`='$aid'";
								$edtQry=mysql_query("Select * from `templates` where `prog_id`='$aid'");
								$userData=mysql_fetch_row($edtQry);	
								
								?>
                            <table width="100%" border="0"  cellpadding="6" cellspacing="1"  id="table1"  style="background-color:#FDFBB9">
             
              <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;font-size:16px;font-family:Calibri;padding-bottom:5px;"><b><img src="images/welcome.png">&nbsp;Welcome Mail</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                <tr  >
				<td align="left" class="blackbold"> Program Name *</td>
				<td><?php echo stripslashes($progData[1]) ?><input type="hidden" name="hidPid" value="<?php echo $aid; ?>"><input type="hidden" name="hidId" value="<?php echo $userData[0]; ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
				   <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control " value="<?php echo htmlentities(stripslashes($userData[4])) ?>" placeholder="Add Welcome Mail Subject" name="welcome_subject" id="welcome_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content</td>
				<td><textarea rows="9"  name="welcome_content"  id="welcome_content" class="form-control wysiwyg" placeholder="Add Email Content" style="width:100%" ><?php echo stripslashes($userData[5]) ?></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
               <tr >
				<td align="left" class="blackbold"> Additional Remark (If any)</td>
				<td><input type="text" class="form-control "  value="<?php echo htmlentities(stripslashes($userData[6])) ?>"  placeholder="Remarks" name="welcome_remark" id="welcome_remark"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><img src="images/sms.png">&nbsp;SMS Templates</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control input-width-xxlarge" value="<?php echo htmlentities(stripslashes($userData[7])) ?>" placeholder="Add SMS Subject" name="sms_subject" id="sms_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content ( Max 160 Characters)</td>
				<td><textarea rows="3"  name="sms_content"  id="sms_content" class="limited form-control " data-limit="160" placeholder="Add SMS Content"  ><?php echo htmlentities(stripslashes($userData[8])) ?></textarea>
                <span class="help-block" id="limit-text"></span>
                </td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><img src="images/room.png">&nbsp;Room Reservation</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                
				   <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control " value="<?php echo htmlentities(stripslashes($userData[9])) ?>" placeholder="Add Room Reservation Subject" name="room_subject" id="room_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content</td>
				<td><textarea rows="9"  name="room_content"  id="room_content" class="form-control wysiwyg" placeholder="Add Room Reservation Content" style="width:100%" ><?php echo stripslashes($userData[10]) ?></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold"> Add Acknowledgement</td>
				<td><textarea rows="4"  name="room_ack"  id="room_ack" class="form-control " placeholder="Add Room Reservation Acknowledgement" style="width:100%" ><?php echo stripslashes($userData[15]) ?></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
               <tr >
				<td align="left" class="blackbold"> Additional Remark (If any)</td>
				<td><input type="text" class="form-control " value="<?php echo htmlentities(stripslashes($userData[11])) ?>" placeholder="Remarks" name="room_remark" id="room_remark"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                
                  <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><img src="images/table.png">&nbsp;Table Reservation</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                
				   <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control " value="<?php echo htmlentities(stripslashes($userData[12])) ?>" placeholder="Add Table Reservation Subject" name="table_subject" id="table_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content</td>
				<td><textarea rows="9"  name="table_content"  id="table_content" class="form-control wysiwyg" placeholder="Add Table Reservation Content" style="width:100%" ><?php echo stripslashes($userData[13]) ?></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                  <tr >
				<td align="left" class="blackbold"> Add Acknowledgement</td>
				<td><textarea rows="4"  name="table_ack"  id="table_ack" class="form-control " placeholder="Add Table Acknowledgement Content" style="width:100%" ><?php echo stripslashes($userData[16]) ?></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
               <tr >
				<td align="left" class="blackbold"> Additional Remark (If any)</td>
				<td><input type="text" class="form-control " value="<?php echo htmlentities(stripslashes($userData[14])) ?>" placeholder="Remarks" name="table_remark" id="table_remark"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                
                <tr>
                <td></td>
				<td  class="blackbold" colspan="2" align="left">
                <input style="width:200px;" type="submit" name="update" value=" Update  " class="btn success">&nbsp;&nbsp;
                
                <input style="width:200px;" type="button" name="cancel" value="  Go Back  " onClick="javascript:window.location.href='addprograms.php'" class="btn"> </td>
				
				</tr>
                
                
				
				
				
</table>
                            <?php }else{ ?>
                            <table width="100%" border="0"  cellpadding="6" cellspacing="1"  id="table1"  style="background-color:#FDFBB9">
             
              <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;font-size:16px;font-family:Calibri;padding-bottom:5px;"><b><img src="images/welcome.png">&nbsp;Welcome Mail</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                <tr  >
				<td align="left" class="blackbold"> Program Name *</td>
				<td><?php echo stripslashes($progData[1]) ?><input type="hidden" name="hidPid" value="<?php echo $aid; ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
				   <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control "  placeholder="Add Welcome Mail Subject" name="welcome_subject" id="welcome_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content</td>
				<td><textarea rows="9"  name="welcome_content"  id="welcome_content" class="form-control wysiwyg" placeholder="Add Email Content" style="width:100%" ></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
               <tr >
				<td align="left" class="blackbold"> Additional Remark (If any)</td>
				<td><input type="text" class="form-control "    placeholder="Remarks" name="welcome_remark" id="welcome_remark"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><img src="images/sms.png">&nbsp;SMS Templates</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control input-width-xxlarge"  placeholder="Add SMS Subject" name="sms_subject" id="sms_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content ( Max 160 Characters)</td>
				<td><textarea rows="3"  name="sms_content"   id="sms_content" class="limited form-control " data-limit="160" placeholder="Add SMS Content"  ></textarea>
                <span class="help-block" id="limit-text"></span>
                </td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><img src="images/room.png">&nbsp;Room Reservation</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                
				   <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control "  placeholder="Add Room Reservation Subject" name="room_subject" id="room_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content</td>
				<td><textarea rows="9"  name="room_content"  id="room_content" class="form-control wysiwyg" placeholder="Add Room Reservation Content" style="width:100%" ></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                 <tr >
				<td align="left" class="blackbold"> Add Acknowledgement</td>
				<td><textarea rows="4"  name="room_ack"  id="room_ack" class="form-control wysiwyg" placeholder="Add Room Acknowledgement Content" style="width:100%" ></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               <tr >
				<td align="left" class="blackbold"> Additional Remark (If any)</td>
				<td><input type="text" class="form-control "  placeholder="Remarks" name="room_remark" id="room_remark"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                
                  <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><img src="images/table.png">&nbsp;Table Reservation</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                
				   <tr >
				<td align="left" class="blackbold"> Add Subject</td>
				<td><input type="text" class="form-control "  placeholder="Add Table Reservation Subject" name="table_subject" id="table_subject"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold"> Add Content</td>
				<td><textarea rows="9"  name="table_content"  id="table_content" class="form-control wysiwyg" placeholder="Add Table Reservation Content" style="width:100%" ></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                <tr >
				<td align="left" class="blackbold"> Add Acknowledgement</td>
				<td><textarea rows="4"  name="table_ack"  id="table_ack" class="form-control " placeholder="Add Table Reservation Content" style="width:100%" ></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
               <tr >
				<td align="left" class="blackbold"> Additional Remark (If any)</td>
				<td><input type="text" class="form-control "  placeholder="Remarks" name="table_remark" id="table_remark"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                
                <tr>
                <td></td>
				<td  class="blackbold" colspan="2" align="left">
                <input style="width:200px;" type="submit" name="submit" value=" Submit  " class="btn success">&nbsp;&nbsp;
                
                <input style="width:200px;" type="button" name="cancel" value="  Go Back  " onClick="javascript:window.location.href='addprograms.php'" class="btn"> </td>
				
				</tr>
                
                
				
				
				
</table>
                            <?php }?>
                            
								
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