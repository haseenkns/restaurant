<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['aid'])&&$_GET['aid']!=''){	
	$memId=base64_decode($_GET['aid']);
	$userData=getMembersDetailById($memId);
	$memName=getTabledataById("name","titles",$userData[2])." ".$userData[3]." ".$userData[4]." ".$userData[5];

}

	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Member has been  added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Member not added Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Members data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Members data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
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
	
	
if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `familymembers` where `id`='$did'");
		if($delQry){
			
			header("location:familymembers.php?msg=dlsaid=".base64_encode($memId)."");
		}else{
			header("location:familymembers.php?msg=dlfaid=".base64_encode($memId)."");
		}
}

if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;

		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		
		
		
		
		
		$nwsimg=$_FILES['image']['name'];
		if(!$nwsimg==''){
			$newsimagename=basename($_FILES['image']['name']);
			$newsimagenamesrc=$_FILES['image']['tmp_name'];
			$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
			$imgName=$postednewsdate."_".$newsimagename;
			$moveimg=move_uploaded_file($newsimagenamesrc,'photos/'.$imgName);
			if(!$moveimg){
				$flag=0;	
			}
		}else{
	     	$imgName="nophoto.jpg";	
			
		}
		
		$pdate=date("d/m/Y");
		
		mysql_query("BEGIN");
		if($flag==1){
			$excQry=mysql_query("INSERT INTO `familymembers` (`id`, `mem_id`, `title`, `fname`, `mname`, `lname`, `gender`,  `dob`, `relation`, `imagepath`,  `createdon`, `status`) VALUES (NULL, '$hidMemId', '$title', '$fname', '$mname', '$lname', '$gender', '$dob',  '$relation', '$imgName','$pdate', '1');");
		
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}
}
	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:familymembers.php?msg=ins&aid=".base64_encode($hidMemId)."");					  
	}else{
		mysql_query("REVOKE");
		header("location:familymembers.php?msg=inf&aid=".base64_encode($hidMemId)."");	
	}
	
	
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidId'];
	$flag=1;
	
	$detailArr=mysql_fetch_row(mysql_query("select * from `familymembers` where `id`='$id' "));
	$imgName=$detailArr[9];
	
		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
	    	
		$nwsimg=$_FILES['image']['name'];
		if(!$nwsimg==''){
			$newsimagename=basename($_FILES['image']['name']);
			$newsimagenamesrc=$_FILES['image']['tmp_name'];
			$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
			$imgName=$postednewsdate."_".$newsimagename;
			$moveimg=move_uploaded_file($newsimagenamesrc,'photos/'.$imgName);
			if(!$moveimg){
				$flag=0;	
			}
		}
	
		mysql_query("BEGIN");
	
		 $sqlQry="UPDATE `familymembers` SET  `title` = '$title', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `gender` = '$gender',  `dob` = '$dob',  `relation` = '$relation', `imagepath` = '$imgName'  WHERE `familymembers`.`id` = '$id';";
		//die;
	$execQry=mysql_query($sqlQry);
	if(!$execQry){
		$flag=0;	
	}else{
		$flag=1;		
	}






if($flag==1 ){
		mysql_query("COMMIT");
		header("location:familymembers.php?msg=ups&aid=".base64_encode($hidMemId)."");					  
	}else{
		mysql_query("REVOKE");
		header("location:familymembers.php?msg=upf&aid=".base64_encode($hidMemId)."");	
	}


}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `familymembers` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	//$paymentStats=mysql_fetch_row(mysql_query("Select * from `paymentstats` where `mode`='$eid'"));
	//print_r($userData);
	//die;
	
}

	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script>
	
    function showHideDiv(id){
		var count=document.getElementById('hidTotal').value
		for(i=1;i<=count;i++){
		document.getElementById('podiv'+i).style.display='none'	
		}
		document.getElementById('podiv'+id).style.display='block'	
			
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			document.getElementById(id).focus();	
			alert(id)
		});
			//return false;
		}
		
    </script>
    
    <script type="text/javascript" language="JavaScript">

		
		
function ValidateMember()
	{
		
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	var numbers = /^[0-9]+$/;
	
	
	if(document.getElementById('program').value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Select a program name','program')
		return false;
		}

		
	
	if(document.getElementById('title').value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please select a title','title')
		return false;
		}

	if(document.getElementById('fname').value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please enter first name','fname')
		return false;
		}
	
	
	if(document.getElementById('amount').value=="")
		{
		errorMsg('Please enter a amount','amount')
		return false;
	}

	if(!document.getElementById('amount').value.match(numbers))
		{
			errorMsg('Only numerical digits (0-9) is allowed','amount');
			return false;
	    }
		
	
	

}
  function setFocus(val){
		document.getElementById(val).focus();	
		alert('dasd')
	}
</script>
    
    <style>
	#display{
	border:dotted 1px #F0F0F0;
	position:absolute;
	min-width:237px;
	z-index:9999;
	
	}
	#display ul
{
	list-style: none;
	margin: 0px;
	padding:0px;
	width: auto;
	max-height:150px;
	overflow:auto;
	z-index:9999;
}
#display li
{
display: block;
padding: 3px;
background-color: #4C9ED9;
z-index:9999;
color:#FFF;
}
	</style>
    <script type="text/javascript">
function fill(Value,id) 
{	
//alert(id)	
$('#city').val(Value); 
$('#hidCity').val(id);
$('#display').hide();
}

$(document).ready(function(){ 
$("#city").keyup(function() {
$('#hidCity').val(0);
        var state = $('#state').val();
		 var cname = $('#city').val();
		
		if(state=="" || state=="0")
		{
			alert("Please select a state ")
			$("#display").html("");
			$('#city').val(""); 
		}
		else
		{
		$.ajax({  
                type: "POST",  
                url: "cities.php",  
                data: "sid="+ state+"&cname="+cname ,  
                success: function(html){  
                    $("#display").html(html).show();
                }  
            });
		}
});
});
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
						<h3>Family - <?php echo $memName; ?>  </h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
<form action="" method="post" enctype="multipart/form-data" onSubmit="return ValidateMember()">
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
			 
			 
   <?php 
    if(isset($_GET['eid'])&&$_GET['eid']!=''){?>

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Update Members Detail</h4>
							</div>
							<div class="widget-content">
							
                                
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label">Title *</label>
													<select name="title" id="title" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `titles` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[2]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Title</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                 <label class="control-label">First Name *</label>
													<input type="text" name="fname" id="fname" class="form-control" value="<?php echo  htmlentities(stripslashes($userData[3])) ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Middle Name</label>
													<input type="text" name="mname" id="mname" class="form-control" value="<?php echo htmlentities(stripslashes($userData[4])) ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Last Name</label>
													<input type="text" name="lname" id="lname" class="form-control" value="<?php echo htmlentities(stripslashes($userData[5])) ?>">
												</div>
											</div>
										
									</div>
                                     
                              		  <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label">Gender</label>
*													
<select name="gender" id="gender" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `genders` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[6]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Gender</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Date Of Birth</label>
													<input type="text" name="dob" id="doa" class="form-control" data-mask="99/99/9999" value="<?php echo htmlentities(stripslashes($userData[7])) ?>">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
													<div class="col-md-2">
                                                	<label class="control-label">Relation</label>
													<select name="relation" id="relation" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `relations` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[8]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Source</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Profile Picture</label>
													<input type="file" name="image" id="image" data-style="fileinput">
												</div>
                                                <div class="col-md-1" align="right" style="margin-left:50px;">
                                                <div ><img src="photos/<?php echo $userData[9]; ?>" style="border-radius:20px;"></div>
												</div>
											</div>
										
									</div>
                                      
                                      
                                      
                                
                                    
                                    
                                  
                                    
                                    
                                    
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                
                <div class="row" style="padding-top:30px;">
										
										<div class="col-md-12">
                                        
                                            <div class="col-md-2">	</div>
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidMemId" value="<?php echo $memId; ?>"><input type="hidden" name="hidId" value="<?php echo $eid; ?>"><input type="submit" name="update" class="btn btn-primary btn-block" value=" Update Member"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="reset" name="reset" class="btn  btn-block" value=" Reset "> 
                                           
 
 </div>
										</div>
									</div>
            
     <?php }else{ ?>
     
   				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Members Detail</h4>
							</div>
							<div class="widget-content">
							<div class="form-group">
										
										
											
										
									</div>
                                
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label">Title *</label>
													<select name="title" id="title" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `titles` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Title</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                 <label class="control-label">First Name *</label>
													<input type="text" name="fname" id="fname" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Middle Name</label>
													<input type="text" name="mname" id="mname" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Last Name</label>
													<input type="text" name="lname" id="lname" class="form-control">
												</div>
											</div>
										
									</div>
                                     
                              		  <div class="form-group">
										
										
											<div class="row">
                                                <div class="col-md-2">
                                                <label class="control-label">Gender</label>
*													
<select name="gender" id="gender" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `genders` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Gender</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Date Of Birth</label>
													<input type="text" name="dob" id="doa" class="form-control" data-mask="99/99/9999">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Relation</label>
													<select name="relation" id="relation" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `relations` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Source</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Profile Picture</label>
													<input type="file" name="image" id="image" data-style="fileinput">
												</div>
												   <div class="row">
                            <hr/>
                            </div> 
                                    
                                    <div class="row" style="padding-top:30px;">
										
										<div class="col-md-12">
                                        
                                            <div class="col-md-2">	</div>
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidMemId" value="<?php echo $memId; ?>"><input type="submit" name="submit" class="btn btn-primary btn-block" value=" Add Member"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="reset" name="reset" class="btn  btn-block" value=" Reset "> 
                                           
 
 </div>
										</div>
									</div>
											</div>
										
									</div>
                                      
                                
                                    
                                    
                                  
                                    
                                    
                                    
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                
                

     
     
     <?php } ?>       
            
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Family Members</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th width="5%" >Sno</th>
             <th width="10%"  data-hide="phone,tablet">Preview</th>
         
            <th width="40%"  data-hide="phone">Name</th>
            <th width="25%" data-hide="phone,tablet">Relation</th>
           
            <th width="15%"  data-hide="phone,tablet">Date Of Birth</th>
            <th width="15%" style="text-align:center"  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `familymembers` where `mem_id`='$memId' order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
	
		$name=getTabledataById("name","titles",$fetch['title'])." ".$fetch['fname']." ".$fetch['mname']." ".$fetch['lname'];
		
	
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewfamilymember.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
	
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
	<td align="left" class="smallfonttext"><?php echo getTabledataById("name","relations",$fetch['relation']) ?></td>
 
	<td align="center"  ><?php echo trim($fetch['dob']); ?></td>
    
    
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr>
	<td align="right" ><a href="familymembers.php?did=<?php echo base64_encode($fetch['id']) ?>&aid=<?php echo base64_encode($memId); ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn" type="button"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="familymembers.php?eid=<?php echo base64_encode($fetch['id']) ?>&aid=<?php echo base64_encode($memId); ?>"><button class="btn" type="button"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','familymembers',11)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td width="69">No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>    
            
            
			<!-- /.container -->
</form>
		</div>
	</div>
<!-- <script language="javascript" type="text/javascript" src="javascript/jquery1.4.js">   </script>
-->

</body>
</html>