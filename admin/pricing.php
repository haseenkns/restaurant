<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
if($_SESSION['aid']=='')
	{
		header("location:index.php");
	}else{
		$aid=$_SESSION['aid'];
	}

if(isset($_GET['id'])&&$_GET['id']!=''){	
	$sid=$_GET['id'];
	$subSerDet=getSubServiceDetailById($sid);
	$subServiceName=$subSerDet[3];
	$serviceId=$subSerDet[8];
}

if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Data inserted Successfully !!';
		$class='success';
	break;
	case 'inf':
		$msg='Data not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Data not updated Successfully !!';
		$class='success';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='success';
	break;
	
	case 'default' :
		$msg='';
		break;
	}
}
	
if(isset($_GET['did'])&&$_GET['did']!=''){
	$delid=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `pricing` where id='$delid'");
		if($delQry){
			$successflag=1;
		}else{
			$successflag=0;
		}
if($successflag=1){
		header("location:pricing.php?msg=dls&id=$sid");
	}else{
		header("location:pricing.php?msg=dlf&id=$sid");
	} 
 }


if(isset($_POST['submit'])|| isset($_POST['submit_x'])){

    $successflag=0;
	extract($_POST);
	$title=mysql_real_escape_string($title);
	$mincharge=mysql_real_escape_string($mincharge);
	$maxcharge=mysql_real_escape_string($maxcharge);
	$sid=$hidSid;
	
	$sqlQry="insert into `pricing` set `status`='1',`title`='$title',`pdate`='$pdate',`s_id`='$sid' ,`mincharge`='$mincharge',`position`='$position' ,`maxcharge`='$maxcharge'";
	$execQry=mysql_query($sqlQry);
	if($execQry){$successflag=1;}else{$successflag=0;}
	
	if($successflag==1){
		header("Location:pricing.php?msg=ins&id=$sid");
	}
	if($successflag==0){
		header("Location:pricing.php?msg=inf&id=$sid");
	}
	
	
}

if(isset($_POST['update'])){
    $successflag=1;
	extract($_POST);
	$id=$hidId;
	$title=mysql_real_escape_string($title);
	$mincharge = mysql_real_escape_string($mincharge);
	$maxcharge = mysql_real_escape_string($maxcharge);
	$sid=$hidSid;

	$sqlImgQry=mysql_query("Update `pricing` set `title`='$title' ,`position`='$position',`mincharge`='$mincharge' ,`maxcharge`='$maxcharge'   where `id`='$id'");
		if($sqlImgQry){
			   $successflag=1;
			  }else{
			   $successflag=0;
			  }
			
	if($successflag==1){
	    header("Location:pricing.php?msg=ups&id=$sid");
	}else{
        header("Location:pricing.php?msg=upf&id=$sid");
	}
	

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Admin Panel </title>
    <script src="../javascript/javascript.js" type="text/javascript"></script>
    <script type="text/javascript" language="JavaScript">
	function validate()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var namePtrn=/^[.a-zA-Z0-9 ]+$/;
	if(document.getElementById('title').value=="")
		{
		alert('Name cannot be left blank !!');
		document.program.name.focus();
		return false;
		}

	if(!document.program.name.value.match(namePtrn))
	{
		alert('Only alphabets A - Z ,dot  and spaces are allowed !! ');
		document.program.name.focus();
		return false;
	}
	
	
	return true;
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
						<h3><b style="color:#069;font-weight:normal;"><?php echo $subServiceName; ?></b> Pricing Management</h3>
						<span><a href="subservices.php?id=<?php echo $serviceId; ?>">Go Back To Sub Services</a></span>
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
								<h4><i class="icon-reorder"></i> Add Pricing</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
              <?php if($msg!=''){ ?>
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td  align="left"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php } ?>
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top" align="left">
				<!--------------------code starts here---------------->
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validate()" enctype="multipart/form-data">
				<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
					$eid=base64_decode($_GET['eid']);
					$execQry=mysql_fetch_row(mysql_query("select * from `pricing` where `id`='$eid'"));
					$title=$execQry[2];
					$mincharge=$execQry[5];
					$maxcharge=$execQry[6];
					
							
				?>
                
				<tr >
				<td width="14%" align="left" class="blackbold">Update Plan  </td>
				<td colspan="2" ><input type="text"  class="form-control " style="letter-spacing:1px;"  title=""  size="45" name="title" id="title" value="<?php echo htmlentities(stripslashes($title)); ?>">         </td>
				</tr>
                
               <tr >
                    <td align="left" class="blackbold">Update Content  </td>
                    <td colspan="2"><input class="form-control"   title="" type="text" name="mincharge" id="mincharge" value="<?php echo htmlentities(stripslashes($mincharge)); ?>"></td>
              </tr>
                
                <tr >
              <td>Visiting Charges (Rs)</td>
              <td colspan="2" width="70%" align="left"><input class="form-control"   title="" type="text" name="maxcharge" id="maxcharge" value="<?php echo htmlentities(stripslashes($maxcharge)); ?>"></td>
            
            </tr>
			
			
                 
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" name="hidId" value="<?php echo $eid; ?>"><input type="hidden" name="hidSid" value="<?php echo $sid; ?>"><input type="submit" name="update" class="btn" value=" Update Gallery">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='subservices.php?id=<?php echo $serviceId; ?>'"  class="btn"></td>
				</tr>
				
				<?php }else{?>
            <tr >
            <td align="left" class="blackbold">Add Plan  </td>
            <td colspan="2"><input class="form-control "   title="" type="text" name="title" id="title"></td>
            </tr>
                
            <tr >
            <td align="left" class="blackbold">Add Min Price (Rs)  </td>
            <td colspan="2"><input class="form-control "   title="" type="text" name="mincharge" id="mincharge"></td>
            </tr>
              <tr >
              <td>Add Max Price (Rs)</td>
              <td align="left" colspan="2"><input class="form-control"   title="" type="text" name="maxcharge" id="maxcharge"></td>
              
            </tr>
                 
            <tr >
            <td>&nbsp;</td>
            <td colspan="2" align="left"><input type="hidden" name="hidSid" value="<?php echo $sid; ?>"><input type="submit" name="submit" class="btn" value=" Add  Pricing  ">&nbsp;<input type="button" name="cancel" value=" Go Back " onClick="javascript:window.location.href='subservices.php?id=<?php echo $serviceId; ?>'" class="btn"></td>
            </tr>
				<?php } ?>
  				</form>
</table>
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  			  
          </table>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Pricing</h4>
						  <div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
                            
                          <script type="text/javascript" src="../javascript/jquery-1.3.2.min.js"></script>
  <script>
		var $j = jQuery.noConflict();
</script>

  <script type="text/javascript" src="../javascript/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$j(document).ready(function(){ 
						   
	$j(function() {
		$("tbody").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings&type=subservices'; 
			$.post("updateposition.php", order, function(theResponse){
				
			}); 															 
		}								  
		});
	});

});	
</script> 
					  <div class="widget-content">
				<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
                 <thead>
                    <tr >
                        <th align="left" width="3%" class="verysmalltextblack">Sno</th>
                       
                        <th align="left"  width="41%"class="verysmalltextblack">Plan</th>
                        <th align="center"  width="13%"class="verysmalltextblack" style="text-align:center;">Min Charge</th>
                            <th align="center"  width="19%"class="verysmalltextblack" style="text-align:center;">Max Charge</th>
                        <th width="24%" align="center" class="verysmalltextblack">Action</th>
                    </tr>
                </thead>
    <tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `pricing` where `s_id`='$sid'  order by `position` Asc,  `id` desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	$imagepath=$fetch['imagepath'];
	
  ?>
  <tr bgcolor="#FFFFFF" id="recordsArray_<?php echo $fetch['id']; ?>" onmouseover="this.style.cursor='move'">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['title']; ?></td>
    <td align="center" class="smallfonttext">Rs <?php echo $fetch['mincharge']; ?></td>
    <td align="center" class="smallfonttext">Rs <?php echo $fetch['maxcharge']; ?></td>
    <td align="center" >
      <table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
        <tr>
          <td align="right" ><a href="pricing.php?did=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $sid; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
          <td align="center" ><a href="pricing.php?eid=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $sid; ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
          <td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','pricing',2)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
          
          <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
          </tr>
      </table></td>
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td>No Records Found</td>
   <td>No Records Found</td>
    <td colspan="1"  align="left" bgcolor="#FFFFFF" class="blackbold">No Records Found !</td>  <td colspan="1">No Records Founds</td></tr>
  
  <?php } ?>
  </tbody>
</table>
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