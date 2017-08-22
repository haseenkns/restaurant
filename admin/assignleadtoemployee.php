<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
$type=$_SESSION['type'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

$team=displayteam($adminId);
array_push($team,$adminId);



$marketinEx=getMarketingExecutivesByTeamLeadId($team);


	$impIds=implode(",",$marketinEx);
	
	if(isset($_POST['submit'])){
	extract($_POST);
	$pdate=date("d/m/Y");
		$ptime=date("h:m a");
	
	$insQry=mysql_query("INSERT INTO `assignleads` (`id`, `lid`, `emp_id`, `admin_id`, `pdate`, `ptime`, `status`) VALUES (NULL, '$hidLid', '$employee', '$adminId', '$pdate', '$ptime', '1');");
	
	
	if($insQry){
		$insId=mysql_insert_id();
		header("location:thanksassignment.php?msg=ins&id=".base64_encode($insId)."")	;
	}else{
		header("location:thanksassignment.php?msg=inf")	;
	}
	
		
	}
	
	
	
	
	if(isset($_POST['update'])){
	extract($_POST);
	$hidId=$hidId;
	
	$upQry=mysql_query("Update `assignleads` set `emp_id` = '$employee' where `id`='$hidId'");
	
	
	if($upQry){
	
		header("location:viewassignleads.php?msg=ups")	;
	}else{
		header("location:viewassignleads.php?msg=upf")	;
	}
	
		
	}
	
	
	
if(isset($_GET['lid'])&&$_GET['lid']!=''){
	$lid=base64_decode($_GET['lid']);
	$edtQry=mysql_query("Select * from `leads` where `id`='$lid'");
	$userData=mysql_fetch_row($edtQry);	
	$leadId=getLeadId($lid);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>

<script src="<?php echo $baseurl ?>/facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
<link href="<?php echo $baseurl ?>/facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo $baseurl ?>/facefiles/faceboxnew.js" type="text/javascript"></script>
 <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">

<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })




</script>

<script>
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
function checkExc(){

if(document.getElementById('employee').value=="0")
				{
				//alert('Enter valid Email-address');
				errorMsg('Pleas select a BDM','employee')
				return false;
				}
		
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
						<h3>Assign Lead</h3>
						<span style="float:left;color:#06C;cursor:pointer;" onClick="window.location.href='viewassignleads.php'">&laquo; &nbsp; Go Back To Assignments</span>
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
								<h4><i class="icon-reorder"></i> Lead detail ( <?php echo $leadId ; ?> )</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="8px" cellspacing="2">
             
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
    <form action="" method="post" onSubmit="return checkExc()">
  
    
    
        <table width="100%"  cellpadding="4" cellspacing="1" border="0">
         
                <tr >
                    <td align="left" class="blackbold">  Name </td>
                    <td><strong><?php echo htmlentities(getClientsNameById($lid)) ?></strong></td>
                    <td></td>
                </tr>
                
                <tr>
                    <td align="left" class="blackbold">Company Name</td>
                    <td><?php echo htmlentities(stripslashes($userData[19])) ?></td>
                    <td></td>
				</tr>
                
                
                
                
				<tr >
				<td align="left" class="blackbold">  Email </td>
				<td><?php echo htmlentities(stripslashes($userData[4])) ?></td>
				<td></td>
				</tr>
				<tr >
				<td align="left" class="blackbold">   Contact</td>
				<td><?php echo htmlentities(stripslashes($userData[5])) ?>, <?php echo htmlentities(stripslashes($userData[6])) ?></td>
				<td></td>
				</tr>
                
             
               
           
                <tr >
				<td align="left" class="blackbold"> Address </td>
				<td><?php echo htmlentities(stripslashes($userData[8])) ?>, <?php echo htmlentities(stripslashes($userData[9])) ?>, <?php echo htmlentities(getAreaNameById($userData[12])) ?>, <?php echo getCitiesNameById($userData[11]); ?>, <?php echo getTabledataById("name","state",$userData[10]); ?> </td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Meeting date </td>
				<td><strong><?php echo changeToStdDate(getLatestMeetingDatesByLid($lid)); ?></strong></td>
				</tr>
                
               
                
                
                
                  <?php if(  isset($_GET['eid']) && $_GET['eid']!='' ) {
				  $eid=base64_decode($_GET['eid']);
				  $addignLeadDetail=getAssignLeadDetailById($eid);
				  
				   ?>
                   
                   <tr >
				<td align="left" class="blackbold"> Assign Lead </td>
				<td>
               
                                            
				<select name="employee" id="employee" class="form-control input-width-xlarge " ) ><option value="0">Select Executive</option>
				<?php
			
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `id` IN ($impIds) ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" <?php if($addignLeadDetail[2]==$fetch['id']) {?> selected <?php } ?> ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Executives</option>
					<?php } ?>
                
                </select>
                
                </td>
				<td><div class="validateText"></div></td>
				</tr>
                   <tr >
				<td align="left" class="blackbold"></td>
				<td><input type="hidden" name="hidId" id="hidId" value="<?php echo $eid; ?>"><input type="submit" name="update" class="btn btn-large" value="Update Meeting"></td>
				<td></td>
				</tr>
                
                <?php }else{ ?>
          		      <tr >
				<td align="left" class="blackbold"> Assign Lead </td>
				<td>
               
                                            
				<select name="employee" id="employee" class="form-control input-width-xlarge " ) ><option value="0">Select Executive</option>
				<?php
			
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `id` IN ($impIds) ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" <?php if($userData[30]==$fetch['id']) {?> selected <?php } ?> ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Executives</option>
					<?php } ?>
                
                </select>
                
                </td>
				<td><div class="validateText"></div></td>
				</tr>
           		     <tr >
				<td align="left" class="blackbold"></td>
				<td><input type="hidden" name="hidLid" id="hidLid" value="<?php echo $lid; ?>"><input type="submit" name="submit" class="btn btn-large" value="Assign Meeting"></td>
				<td><a href="checkavailability.php?lid=<?php echo $lid; ?>" rel="facebox" style="text-decoration:none;" >Check Availability On <?php echo changeToStdDate($userData[26]); ?></a></td>
				</tr>
                <?php } ?>
                
         
        </table>
        
      
        
        </form>
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
                
                 
			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>