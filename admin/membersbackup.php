<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");
	
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
	$delQry=mysql_query("delete from `members` where `id`='$did'");
		if($delQry){
			
			$delqry=mysql_query("delete from `paymentstats` where `mode`='$did'");
			$delqry=mysql_query("delete from `referencemembers` where `mem_id`='$did'");
			
			header("location:members.php?msg=dls");
		}else{
			header("location:members.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;
		

		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		
		$email=mysql_real_escape_string($_POST['email']);
		$pcontact=mysql_real_escape_string($_POST['pcontact']);
		$scontact=mysql_real_escape_string($_POST['scontact']);
		
		$address1=mysql_real_escape_string($_POST['address1']);
		$address2=mysql_real_escape_string($_POST['address2']);
		$pincode=mysql_real_escape_string($_POST['pincode']);
		$city=mysql_real_escape_string($_POST['city']);
		$amount=mysql_real_escape_string($_POST['amount']);
		
		
		$dateofsale=mysql_real_escape_string($_POST['dateofsale']);
		$phoneres=mysql_real_escape_string($_POST['phoneres']);
		$phoneoff=mysql_real_escape_string($_POST['phoneoff']);
		$spname=mysql_real_escape_string($_POST['spname']);
		$spmobile=mysql_real_escape_string($_POST['spmobile']);
		$spemail=mysql_real_escape_string($_POST['spemail']);
		$source=mysql_real_escape_string($_POST['source']);
		$remark=mysql_real_escape_string($_POST['remark']);
		
		$nameoncard=mysql_real_escape_string($_POST['nameoncard']);
		$designation=mysql_real_escape_string($_POST['designation']);
		$compname=mysql_real_escape_string($_POST['compname']);
		$voucherno=mysql_real_escape_string($_POST['voucherno']);
		
		
		
		
		
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
		$ptime=date("h:m a");
		
		mysql_query("BEGIN");
		if($complimentry==1){
			
			$modeofpayment=0;
			$pickup=0;
			$employee=0;
			$creditedon='';
		}else{
			$complimentry=0;
			$approvedby=0;
			$processedby=0;	
		}
		
		
		if($flag==1){
		$excQry=mysql_query("INSERT INTO `members` (`id`, `prog_id`, `title`, `fname`, `mname`, `lname`, `gender`, `email`, `pcontact`, `scontact`, `dob`, `marital`, `doa`, `address1`, `address2`, `state`, `city`, `cityother`, `pincode`, `source`, `imagepath`, `amount`, `modeofpayment`, `pickup`, `employee`, `tenure`, `createdon`, `status` ,`mlevel`,`dateofsale`,`a_id`,`phoneres`,`phoneoff`,`spname`,`spemail`,`spmobile`,`spdob`,`remark`,`nameoncard`,`designation`,`compname`,`spousecard`,`voucherno`,`addresstype`,`creditedon`,`complimentry`,`approvedby`,`processedby`,`createdtime`,`referredby`) VALUES (NULL, '$program', '$title', '$fname', '$mname', '$lname', '$gender', '$email', '$pcontact', '$scontact', '$dob', '$marital', '$doa', '$address1', '$address2', '$state', '$hidCity', '$city', '$pincode', '$source', '$imgName', '$amount', '$modeofpayment', '$pickup', '$employee', '$tenure', '$pdate', '1','$hidMlevel','$dateofsale','$consultants','$phoneres','$phoneoff','$spname','$spemail','$spmobile','$spdob','$remark','$nameoncard','$designation','$compname','$spcard','$voucherno','$addresstype','$creditedon','$complimentry','$approvedby','$processedby','$ptime','$hidRmemId');");
		
	if($excQry){
		$flag=1;
		if(!$complimentry==1){	 
		$insId=mysql_insert_id();
		$execQry=mysql_query("select * from `paymentfields` where `status` = '1' and `u_id`='$modeofpayment' order by `id`  ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$statid=$fetch['id'];
				 $optVal=$statid."options";
				 $svalues= $_POST[$optVal];
			
				$insqry=mysql_query("Insert into `paymentstats` set `mode`='$insId' ,`stats`='$statid',`svalues`='$svalues' ");
				if(!$insqry){$flag=0;}
			}
		}
		
	}
		
	}else{
		$flag=0;	
	}
}
	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:members.php?msg=ins");					  
	}else{
		mysql_query("REVOKE");
		header("location:members.php?msg=inf");	
	}
	
	
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidId'];
	$flag=1;
	$detailArr=mysql_fetch_row(mysql_query("select * from `members` where `id`='$id' "));
	$imgName=$detailArr[20];
	
		$fname=mysql_real_escape_string($_POST['fname']);
		$mname=mysql_real_escape_string($_POST['mname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		
		$email=mysql_real_escape_string($_POST['email']);
		$pcontact=mysql_real_escape_string($_POST['pcontact']);
		$scontact=mysql_real_escape_string($_POST['scontact']);
		
		$address1=mysql_real_escape_string($_POST['address1']);
		$address2=mysql_real_escape_string($_POST['address2']);
		$pincode=mysql_real_escape_string($_POST['pincode']);
		$city=mysql_real_escape_string($_POST['city']);
		$amount=mysql_real_escape_string($_POST['amount']);
		
		
		$dateofsale=mysql_real_escape_string($_POST['dateofsale']);
		$phoneres=mysql_real_escape_string($_POST['phoneres']);
		$phoneoff=mysql_real_escape_string($_POST['phoneoff']);
		$spname=mysql_real_escape_string($_POST['spname']);
		$spmobile=mysql_real_escape_string($_POST['spmobile']);
		$spemail=mysql_real_escape_string($_POST['spemail']);
		$source=mysql_real_escape_string($_POST['source']);
		$remark=mysql_real_escape_string($_POST['remark']);
		
		$nameoncard=mysql_real_escape_string($_POST['nameoncard']);
		$designation=mysql_real_escape_string($_POST['designation']);
		$compname=mysql_real_escape_string($_POST['compname']);
		
		$voucherno=mysql_real_escape_string($_POST['voucherno']);
		
		
	    	
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
	
	if($complimentry==1){
			
			$modeofpayment=0;
			$pickup=0;
			$employee=0;
			$creditedon='';
		}else{
			$complimentry=0;	
		}
	
	
		mysql_query("BEGIN");
		if($flag==1){
			
			
		 $sqlQry="UPDATE `members` SET `prog_id` = '$program', `title` = '$title', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `gender` = '$gender', `email` = '$email', `pcontact` = '$pcontact', `scontact` = '$scontact', `dob` = '$dob', `marital` = '$marital', `doa` = '$doa', `address1` = '$address1', `address2` = '$address2', `state` = '$state', `city` = '$hidCity', `cityother` = '$city', `pincode` = '$pincode', `source` = '$source', `imagepath` = '$imgName', `amount` = '$amount', `modeofpayment` = '$modeofpayment', `pickup` = '$pickup', `employee` = '$employee', `tenure` = '$tenure'
,`mlevel`='$hidMlevel',`dateofsale`='$dateofsale',`a_id`='$consultants',`phoneres`='$phoneres',`phoneoff`='$phoneoff',`spname`='$spname',`spemail`='$spname',`spmobile`='$spmobile',`spdob`='$spdob',`remark`='$remark',`nameoncard`='$nameoncard',`designation`='$designation',`compname`='$compname',`spousecard`='$spcard',`voucherno`='$voucherno' ,`addresstype`='$addresstype' ,`creditedon`='$creditedon' ,`complimentry`='$complimentry' ,`approvedby`='$approvedby' ,`processedby`='$processedby' ,`referredby`='$hidRmemId'  WHERE `members`.`id` = '$id';";
		 
		 
		 
		 
		 
		 
		//die;
	$execQry=mysql_query($sqlQry);
	if(!$execQry){
	$flag=0;	
	}else{
		$delQry=mysql_query("delete from `paymentstats` where  `mode`='$id' ");
	if(!$delQry){
		$flag=0;	
	}else{
	if(!$complimentry==1){
	$execQry=mysql_query("select * from `paymentfields` where `status` = '1' and `u_id`='$modeofpayment' order by `id`  ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$statid=$fetch['id'];
				 $optVal=$statid."options";
				 $svalues= $_POST[$optVal];
			
				$insqry=mysql_query("Insert into `paymentstats` set `mode`='$id' ,`stats`='$statid',`svalues`='$svalues' ");
				if(!$insqry){$flag=0;}
			}
		}
		
	}
	
	}
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:members.php?msg=ups");					  
	}else{
		mysql_query("REVOKE");
		header("location:members.php?msg=upf");	
	}
}
}

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `members` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$progId=$userData[1];
	$mlevel=$userData[28];
	$membershipNumber=getMemberShipNumber($progId,$eid);
	
	$refmemId=$userData[50];
	$referredBy=getRefferredByMem($refmemId);
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
	function showHideAmountDiv(id){
		if(document.getElementById(id).style.display=='none'){
			document.getElementById(id).style.display='block';
			document.getElementById('compdiv').style.display='none';
				
		}else{
			document.getElementById(id).style.display='none'	
			document.getElementById('compdiv').style.display='block';
		}
			
	}
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
			//alert(id)
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

	if(document.getElementById('hidMlevel').value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Select a membership level','program')
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
	if(document.getElementById('gender').value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please select a gender','gender')
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
		
	
	if(document.getElementById('complimentry').checked==true)
		{
		
				if(document.getElementById('approvedby').value=="0")
				{
					errorMsg('Please select Approved by name','approvedby')
					return false;
				}
				
				
				if(document.getElementById('processedby').value=="0")
				{
					errorMsg('Please select Processed by name','processedby')
					return false;
				}
				
		
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

#rdisplay{
	border:dotted 1px #F0F0F0;
	position:absolute;
	min-width:337px;
	z-index:9999;
	
	}
	#rdisplay ul
{
	list-style: none;
	margin: 0px;
	padding:0px;
	width: auto;
	max-height:150px;
	overflow:auto;
	z-index:9999;
}
#rdisplay li
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




/*$(document).ready(function(){ 

	$("#city").focusout(function(){
		//$('#display').hide();
	});

});
*/

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



$(document).ready(function(){ 
$("#referredby").keyup(function() {
	
	 var name = $('#referredby').val();
					$.ajax({  
							type: "POST",  
							url: "refermembers.php",  
							data: "name="+ name,  
							success: function(html){  
								$("#rdisplay").html(html).show();
							}  
						});
});
});


function fillVal(Value,id) 
{	
//alert(id)	
$('#referredby').val(Value); 
$('#hidRmemId').val(id);
$('#rdisplay').hide();
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
						<h3>Members</h3>
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
    if(isset($_GET['eid'])&&$_GET['eid']!=''){
		
		
		?>

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Update Programs Detail</h4>
							</div>
							<div class="widget-content">
							<div class="form-group" >
											<div class="row">
                                          
												<div class="col-md-6">
                                                   <label class="control-label">Select program *</label>
                                                   <input type="hidden" name="hidMlevel" id="hidMlevel" value="<?php echo $userData[28] ?>">
													<select name="program" id="program" class="form-control " onChange="updateMembershipLevel(this.value)" ><option value="0">Select Program</option>
				<?php
					$execQry=mysql_query("select * from `programs` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['pname']) ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
												</div>
                                                
                                                <div class="col-md-3">
                                                    <label class="control-label">Select Membership Level *</label>
                                                    <div id="mleveldiv"><select name="mlevel" id="mlevel" class="form-control"  onchange="setMlevel(this.value)" >
                                                    
                                                    
                                            <option value="0">Select Level</option>
                                           <?php
										   $progid=$userData[1];
												$execQry=mysql_query("select * from `program_price` where `status` = '1' and `prog_id`='$progid' order by `id` desc ");
												$numRows=mysql_num_rows($execQry);
												if($numRows>0){
												while($fetch=mysql_fetch_array($execQry)){?>
												<option value="<?php echo $fetch['id']; ?>" <?php if($userData[28]==$fetch['id']) {?> selected <?php } ?> ><?php echo $fetch['price']; ?></option>
												<?php }
												}else{?>
												<option value="0" >No Level</option>
												<?php }?>
 </select></div>
												</div>
                                                
                                                 <div class="col-md-2">
                                                    <label class="control-label">Date Of Sale</label>
													<input type="text" name="dateofsale" id="dateofsale" class="form-control" data-mask="99/99/9999" value="<?php echo $userData[29];  ?>">
												</div>
                                                
											</div>
									</div>
                            <div class="form-group" >
										
										
											<div class="row">
                                          
												<div class="col-md-6">
                                                   <label class="control-label">Consultant Name*</label>
                                                  
													<select name="consultants" id="consultants" class="form-control " onChange="getEmployeeHead(this.value)" ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" <?php if($userData[30]==$fetch['id']) {?> selected <?php } ?> ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
                  <span class="help-block" id="reportto">&nbsp;</span>
												</div>
                                                
                                                <div class="col-md-3">
                                                    <label class="control-label">Membership Number *</label>
                                                    <div id="mleveldiv"><input  type="text" name="membershipno" id="membershipno" readonly class="form-control " value="<?php echo $membershipNumber; ?>"></div>
												</div>
                                                
                                                 <div class="col-md-2">
                                                    <label class="control-label">Voucher No</label>
													<input type="text" name="voucherno" id="voucherno" class="form-control"  value="<?php echo htmlentities(stripslashes($userData[42])) ?>">
                                                   
												</div>
                                                
											</div>
										
									</div> 
                                    
                                    
                                    
                                    
                                     
                               
                                    
                                    
                                  
                                    
                                    
                                    
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
													<input type="text" name="fname" id="fname" class="form-control" value="<?php echo  htmlentities(stripslashes($userData[3])) ?>"  onKeyUp="fillPrintableName()" >
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Middle Name</label>
													<input type="text" name="mname" id="mname" class="form-control" value="<?php echo htmlentities(stripslashes($userData[4])) ?>" onKeyUp="fillPrintableName()">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Last Name</label>
													<input type="text" name="lname" id="lname" class="form-control" value="<?php echo htmlentities(stripslashes($userData[5])) ?>" onKeyUp="fillPrintableName()">
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
                                                <label class="control-label">Name (to be printed on card)</label>
                                                <input type="text" name="nameoncard" id="nameoncard" class="form-control" value="<?php echo htmlentities(stripslashes($userData[38])) ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Designation</label>
													<input type="text" name="designation" id="designation" class="form-control" value="<?php echo htmlentities(stripslashes($userData[39])) ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Company Name</label>
													<input type="text" name="compname" id="compname" class="form-control" value="<?php echo htmlentities(stripslashes($userData[40])) ?>">
												</div>
                                                
                                           
											</div>
										
									</div>
                                    
      
                                    
                                    
                                    
                                    
                                    <div class="form-group">
										
                                        
                                             
											
                                        
										
											<div class="row">
                                                <div class="col-md-2">
                                                
												</div>
                                               <div class="col-md-3">
<label class="control-label">Email</label>
<input type="text" name="email" id="email" class="form-control" value="<?php echo htmlentities(stripslashes($userData[7])) ?>">
</div>
<div class="col-md-3">
<label class="control-label"> Contact No.( Primary )</label>
<input type="text" name="pcontact" id="pcontact" class="form-control" value="<?php echo htmlentities(stripslashes($userData[8])) ?>">
</div>
<div class="col-md-3">
<label class="control-label"> Contact No.( Secondary )</label>
<input type="text" name="scontact" id="scontact" class="form-control" value="<?php echo htmlentities(stripslashes($userData[9])) ?>">
</div> 
                                                
                                           
											</div>
										
									</div>
                                    
                                    
                                    
                                    
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">Date Of Birth</label>
													<input type="text" name="dob" id="doa" class="form-control" data-mask="99/99/9999" value="<?php echo htmlentities(stripslashes($userData[10])) ?>">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
                                                
                                                	<div class="col-md-3">
                                                
                                                   <label class="control-label">Telephone No (Residence)</label>
													<input type="text" name="phoneres" id="phoneres" class="form-control" value="<?php echo htmlentities(stripslashes($userData[31])) ?>" >
                                                 
                                                </div>
												<div class="col-md-3">
                                                
                                                 <label class="control-label">Telephone No (Official)</label>
													<input type="text" name="phoneoff" id="phoneoff" class="form-control"  value="<?php echo htmlentities(stripslashes($userData[32])) ?>">
                                              
												</div>
                                                
												<!--<div class="col-md-3">
                                                <label class="control-label">Marital Status</label>
													<select name="marital" id="marital" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `maritals` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[11]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Marital</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Date Of Anniversary</label>
													<input type="text" name="doa" id="doa" class="form-control" data-mask="99/99/9999" value="<?php echo htmlentities(stripslashes($userData[12])) ?>">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>-->
                                                
                                                
											</div>
										
									</div>
                                    
                                    
                                    
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div><div class="col-md-3">
                                                	<label class="control-label">Address Type</label>
													<div class="col-md-10" style="padding-left:0px;">
											
											<label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="2" checked>
												Official
											</label>
                                            <label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="1">
												Residential
											</label>
											
										</div>
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Address Line 1</label>
													<input type="text" name="address1" id="address1" class="form-control" value="<?php echo htmlentities(stripslashes($userData[13])) ?>">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Address Line 2</label>
													<input type="text" name="address2" id="address2" class="form-control" value="<?php echo htmlentities(stripslashes($userData[14])) ?>">
												</div>
												
											</div>
										
									</div>
                                    
                                    
                                    
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">State</label>
													<select name="state" id="state" class="form-control "  onChange="clearPrevCity()"><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `state` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[15]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No State</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3"><input type="hidden" name="hidCity" id="hidCity" value="<?php echo htmlentities(stripslashes($userData[16])) ?>">
                                                <label class="control-label">City</label>
													<input type="text" name="city" id="city" class="form-control" autocomplete="off" value="<?php echo htmlentities(stripslashes($userData[17])) ?>">
                                                     <div id="display"></div>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Pin Code</label>
													<input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo htmlentities(stripslashes($userData[18])) ?>">
												</div>
											</div>
										
									</div>
                                    
                                    
                                        
                                    <div class="form-group">
										
										
											<div class="row">
                                            <hr/>
                                                
											</div>
												
												
										
									</div>
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												
												<div class="col-md-3">
                                                <label class="control-label">Marital Status</label>
													<select name="marital" id="marital" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `maritals` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[11]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Marital</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Date Of Anniversary</label>
													<input type="text" name="doa" id="doa" class="form-control" data-mask="99/99/9999" value="<?php echo htmlentities(stripslashes($userData[12])) ?>">
                                                   <!-- <span class="help-block">DD/MM/YYYY</span>-->
												</div>
                                                
                                                
                                                <div class="col-md-3">
                                                	<label class="control-label">Spouse Name</label>
													<input type="text" name="spname" id="spname" class="form-control"  value="<?php echo htmlentities(stripslashes($userData[33])) ?>">
                                                    
												</div>
											</div>
										
									</div>
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">Spouse Mobile</label>
													<input type="text" name="spmobile" id="spmobile" class="form-control" value="<?php echo htmlentities(stripslashes($userData[35])) ?>" >
                                                   
												</div>
												<div class="col-md-3">
                                                
                                                   <label class="control-label">Spouse Email</label>
													<input type="text" name="spemail" id="spemail" class="form-control" value="<?php echo htmlentities(stripslashes($userData[34])) ?>" >
                                                
												
                                                
                                                </div>
												<div class="col-md-2">
                                               
                                                <label class="control-label">Spouse Dob</label>
													<input type="text" name="spdob" id="spdob" class="form-control" data-mask="99/99/9999" value="<?php echo htmlentities(stripslashes($userData[36])) ?>">
                                                    
												</div>
                                                
                                                <div class="col-md-1">
                                               
                                                <label class="control-label">Spouse Card</label>
												<input type="checkbox" class="uniform" name="spcard" id="spcard" value="1" <?php if($userData[41]==1){ ?> checked <?php } ?>> 
                                               
											
												</div>
											</div>
										
									</div>
                                    
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-4">
                                                	<label class="control-label">Source Name</label> 
													<input type="text" name="source" id="source" class="form-control" value="<?php echo htmlentities(stripslashes($userData[19])) ?>" >
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Profile Picture</label>
													<input type="file" name="image" id="image" data-style="fileinput">
												</div>
                                                <div class="col-md-1" align="right" style="margin-left:50px;">
                                                <div ><img src="photos/<?php echo $userData[20]; ?>" style="border-radius:20px;"></div>
												</div>
												
											</div>
										
									</div>
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Remarks (If any)</label>
														<input type="text" name="remark" id="remark" class="form-control" value="<?php echo htmlentities(stripslashes($userData[37])) ?>" >
												</div>
												
												
											</div>
										
									</div>
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                <input type="hidden" name="hidRmemId" id="hidRmemId" value="<?php echo $userData[50] ?>">
                                                	<label class="control-label"><span style="color:#06C">Referred By </span></label>
									                 <input type="text" name="referredby" id="referredby" class="form-control" value="<?php echo $referredBy ?>" >
                                                         <div id="rdisplay"></div>
                                                      <span class="help-block">Type Few Character of Members Name*</span>
												</div>
												
												
											</div>
										
									</div>
                                    
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
								<h4><i class="icon-reorder"></i>Update Payment Details</h4>
                                 <span style="float:right;color:#06C;font-weight:700;"><input <?php if($userData[45]==1){ ?> checked <?php } ?> type="checkbox" name="complimentry" id="complimentry" value="1" id="complimentry" onClick="showHideAmountDiv('membertype')">&nbsp;&nbsp;Click if Membership is complimentry</span>
							</div>
							<div class="widget-content">
							
                             
                                 <div class="row">
										<label class="col-md-2 control-label">Amount (In Rs) *:</label>
										<div class="col-md-3"><input type="text" name="amount" id="amount" readonly value="<?php echo htmlentities(stripslashes($userData[21])) ?>" class="form-control"></div>
									</div>
                                    
                                    <DIV  id="membertype" style="display:<?php if($userData[45]==1) {?>none<?php }else{ ?>block<?php } ?>">   
                              
                                    <div class="row">
                            <hr/>
                            </div>
                        
                                    
                                    <div class="row" style="margin-top:20px;">
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Mode Of Payment *: </label>
                                    <div class="col-md-3">
                                    <?php
                                    $counts=0;
                                    $execQry=mysql_query("select * from `paymentmodes` where `status` = '1' ");
                                    $numRows=mysql_num_rows($execQry);
                                    if($numRows>0){
                                    while($fetch=mysql_fetch_array($execQry)){
                                    $counts++;	
                                    ?>
                                    <label class="radio"  style="padding-bottom:10px;"><input type="radio" class="uniform" name="modeofpayment" value="<?php echo $fetch['id']; ?>"  <?php if($userData[22]==$fetch['id']) {?> checked <?php } ?>  onClick="showHideDiv('<?php echo $counts ?>')">	<?php echo stripslashes($fetch['name']); ?></label>
                                    <?php }
                                    }else{?>
                                    <label class="radio">
                                    <input type="radio" class="uniform" name="modeofpayment" value="0" disabled>
                                    No Payment Mode Defined Yet
                                    </label>
                                    <?php }
                                    ?>
                                    
                                    
                                    
                                    
                                    </div>
                                    
                                    <div class="col-md-5" style="min-height:150px;">
                                    
                                    <?php
                                    $execQry=mysql_query("select * from `paymentmodes` where `status` = '1' ");
                                    $numRows=mysql_num_rows($execQry);
                                    if($numRows>0){
                                    $total=0;
                                    while($fetch=mysql_fetch_array($execQry)){
                                    $paymentModeId=$fetch['id'];
                                    
                                    $total++;
                                    
                                    ?>
                                    <div class="row" style=" <?php if($userData[22]==$paymentModeId){ ?>display:block;<?php }else{ ?>display:none;<?php } ?>"  id="podiv<?php echo $total ?>" >
                                    
                                    <div class="widget box">
                                    <div class="widget-header">
                                    <h4><i class="icon-reorder"></i> <?php echo stripslashes($fetch['name']); ?> Payment Details</h4>
                                    </div>
                                    
                                    
                                    <div class="widget-content">
                                    <?php    
                                    $execQrys=mysql_query("select * from `paymentfields` where `status` = '1' and `u_id`='$paymentModeId' order by `id` ");
                                    $numRowss=mysql_num_rows($execQrys);
                                    if($numRowss>0){
                                    while($fetchs=mysql_fetch_array($execQrys)){
                                    $ptId=$fetchs['id'];
                                    
                                    ?>
                                    <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo stripslashes($fetchs['name']); ?>: </label>
                                    <input type="text" value="<?php echo htmlentities(stripslashes(getPaymentStatsByModeNStats($eid,$ptId))) ?>" name="<?php echo $ptId ?>options" id="<?php echo $ptId ?>options" class="form-control input-width-large">
                                    
                                    </div>
                                    <?php }}else{?>
                                    <div class="form-group">No Details required</div>
                                    <?php } ?>                                                   
                                    
                                    
                                    </div>
                                    </div>
                                    
                                    </div>
                                    <?php }
                                    }else{?>
                                    <div class="row" >
                                    
                                    <div class="widget box">
                                    <div class="widget-header">
                                    <h4><i class="icon-reorder"></i>Payment Details</h4>
                                    </div>
                                    
                                    
                                    <div class="widget-content">
                                    <div class="form-group">
                                    <label class="col-md-4 control-label">No Details Yet </label>
                                    
                                    
                                    </div>  
                                    
                                    
                                    </div>
                                    </div>
                                    
                                    </div>
                                    <?php }
                                    ?>
                                    
                                    
                                    
                                    <input type="hidden" name="hidTotal" id="hidTotal" value="<?php echo $total; ?>">
                                    
                                    
                                    </div>
                                    
                                    </div>
                                    
                                    
                                    
                                    
                                    </div>
                                    <div class="row">
                                    <hr/>
                                    </div>
                                    <div class="row">
                                    <label class="col-md-2 control-label"> Payment Pickup *:</label>
                                    <div class="col-md-10">
                                    
                                    <div class="col-md-2"><label class="radio-inline">
                                    <input type="radio" class="uniform" name="pickup"  id="pickup" value="1" <?php if($userData[23]==1) {?> checked <?php } ?>>
                                    Manually By --
                                    
                                    
                                    </label></div>
                                    <div class="col-md-3" align="left">
                                    
                                    <select name="employee" id="employee" class="form-control"   >
                                    <option value="0"> Employee</option>
                                    <?php
                                    $selQry=mysql_query("select *  from `admin` where `status`='1' and `skey`!='1'  order by `id` Asc");
                                    $numrows=mysql_num_rows($selQry);
                                    if($numrows>0){
                                    while($fetch=mysql_fetch_array($selQry)){?>
                                    <option value="<?php echo $fetch['id'] ?>" <?php if($userData[24]==$fetch['id']) {?> selected <?php } ?> ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
                                    <?php }
                                    }else{?>
                                    <option value="0">No Employee</option>
                                    <?php }
                                    ?>
                                    </select>
                                    
                                    </div>
                                    <div class="col-md-4" align="right">
                                    <label class="radio-inline">
                                    <input type="radio"   class="uniform" name="pickup" id="pickup" value="2" <?php if($userData[24]==2) {?> checked <?php } ?>>
                                    Or Transferred
                                    </label>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <hr/>
                                    </div>      
                                    
                                    <div class="row">
                                    <hr/>
                                    </div>
                                    <div class="row">
                                    <label class="col-md-2 control-label"> Amount Credited On*:</label>
                                    <div class="col-md-10">
                                    
                                    
                                    <input type="text" name="creditedon" id="creditedon" value="<?php echo $userData[44]; ?>" class="form-control input-width-large" data-mask="99/99/9999">
                                    <span class="help-block">DD/MM/YYYY</span>
                                    
                                    </div>
                                    </div>
                                    
                                    
                                    </DIV>
                                     <div class="row">
                            <hr/>
                            </div> 
                                    
                                    <div class="row">
                                    <label class="col-md-2 control-label">Membership Tenure *:</label>
                                    <div class="col-md-8">
                                    <?php
                                    $execQry=mysql_query("select * from `tenures` where `status` = '1' ");
                                    $numRows=mysql_num_rows($execQry);
                                    $count=0;
                                    if($numRows>0){
                                    while($fetch=mysql_fetch_array($execQry)){
                                    $count++;
                                    ?>
                                    <label class="radio-inline">
                                    <input type="radio" <?php if($userData[25]==$fetch['id']) {?> checked <?php } ?>  class="uniform" name="tenure" id="tenure" value="<?php echo $fetch['id'] ?>">
                                    <?php echo $fetch['name'] ?> Months
                                    </label>
                                    <?php }
                                    }else{?>
                                    <label class="radio-inline">
                                    <input type="radio" class="uniform" name="tenure" id="tenure" value="0">
                                    No Option
                                    </label>
                                    <?php }
                                    ?>
                                    
                                    
                                    
                                    </div>
                                    </div>
                               
                                 <div class="row">
                            <hr/>
                            </div> 
                                    
                                    <div id="compdiv" style="display:<?php if($userData[45]==1){ ?>block<?php }else{ ?>none<?php } ?> ;">  
                                    
                                    <div class="row">
                                    <hr/>
                                    </div>      
                                    <div class="row">
                                    <label class="col-md-2 control-label">Approved By</label>
                                    <div class="col-md-8">
                                   <select name="approvedby" id="approvedby" class="form-control " onChange="getEmployeeHead(this.value)" ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" <?php if($userData[46]==$fetch['id']){ ?> selected <?php } ?>><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
                                    
                                    
                                    
                                    </div>
                                    </div>
                                    
                                    <div class="row">
                                    <hr/>
                                    </div>      
                                    <div class="row">
                                    <label class="col-md-2 control-label">Processed By</label>
                                    <div class="col-md-8">
                                    <select name="processedby" id="processedby" class="form-control " onChange="getEmployeeHead(this.value)" ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" <?php if($userData[47]==$fetch['id']){ ?> selected <?php } ?> ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
                                    
                                    
                                    
                                    </div>
                                    </div>
                                    
                                  </div>
                                    
                                    
                                    
                                    <div class="row" style="padding-top:30px;">
										
										<div class="col-md-12">
                                        
                                            <div class="col-md-2">	</div>
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidId" value="<?php echo $eid; ?>"><input type="submit" name="update" class="btn btn-primary btn-block" value=" Update Member"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="reset" name="reset" class="btn  btn-block" value=" Reset "> 
                                           
 
 </div>
										</div>
									</div>
                                    
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
			</div>
            
     <?php }else{ ?>
     
     
   				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Programs Detail</h4>
							</div>
							<div class="widget-content">
							<div class="form-group" >
											<div class="row">
                                          
												<div class="col-md-6">
                                                   <label class="control-label">Select program *</label>
                                                   <input type="hidden" name="hidMlevel" id="hidMlevel" value="0">
													<select name="program" id="program" class="form-control " onChange="getMembershipLevel(this.value)" ><option value="0">Select Program</option>
				<?php
					$execQry=mysql_query("select * from `programs` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['pname']) ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
												</div>
                                                
                                                <div class="col-md-3">
                                                    <label class="control-label">Select Membership Level *</label>
                                                    <div id="mleveldiv"><select name="mlevel" id="mlevel" class="form-control" ><option value="0">Select Level</option></select></div>
												</div>
                                                
                                                 <div class="col-md-2">
                                                    <label class="control-label">Date Of Sale</label>
													<input type="text" name="dateofsale" id="dateofsale" class="form-control" data-mask="99/99/9999" value="<?php echo $currentDate;  ?>">
												</div>
                                                
											</div>
									</div>
                            <div class="form-group" >
										
										
											<div class="row">
                                          
												<div class="col-md-6">
                                                   <label class="control-label">Consultant Name*</label>
                                                  
													<select name="consultants" id="consultants" class="form-control " onChange="getEmployeeHead(this.value)" ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
                  <span class="help-block" id="reportto">&nbsp;</span>
												</div>
                                                
                                                <div class="col-md-3">
                                                    <label class="control-label">Membership Number *</label>
                                                    <div id="mleveldiv"><input  type="text" name="membershipno" id="membershipno" readonly class="form-control " value=""></div>
												</div>
                                                
                                                 <div class="col-md-2">
                                                    <label class="control-label">Voucher No</label>
													<input type="text" name="voucherno" id="voucherno" class="form-control"  value="">
                                                   
												</div>
                                                
											</div>
										
									</div> 
                                    
                                    
                                    
                                    
                                     
                               
                                    
                                    
                                  
                                    
                                    
                                    
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
								<h4><i class="icon-reorder"></i>Members Detail</h4>
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
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Title</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                 <label class="control-label">First Name *</label>
													<input type="text" name="fname" id="fname" autocomplete="off" class="form-control" onKeyUp="fillPrintableName()">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Middle Name</label>
													<input type="text" name="mname" id="mname" autocomplete="off" class="form-control" onKeyUp="fillPrintableName()">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Last Name</label>
													<input type="text" name="lname" id="lname" autocomplete="off" class="form-control" onKeyUp="fillPrintableName()">
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
					<option value="<?php echo stripslashes($fetch['id']) ?>" ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Gender</option>
					<?php } ?>
                
                </select>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Name (to be printed on card)</label>
                                                <input type="text" name="nameoncard" id="nameoncard" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Designation</label>
													<input type="text" name="designation" id="designation" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Company Name</label>
													<input type="text" name="compname" id="compname" class="form-control">
												</div>
											</div>
										
									</div>
                                     
                              		  <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                          
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Email</label>
                                                <input type="text" name="email" id="email" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Mobile No.( Primary )</label>
													<input type="text" name="pcontact" id="pcontact" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label"> Mobile No.( Secondary )</label>
													<input type="text" name="scontact" id="scontact" class="form-control">
												</div>
											</div>
										
									</div>
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">Date Of Birth</label>
													<input type="text" name="dob" id="dob" class="form-control" data-mask="99/99/9999">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
												<div class="col-md-3">
                                                
                                                   <label class="control-label">Telephone No (Residence)</label>
													<input type="text" name="phoneres" id="phoneres" class="form-control" >
                                                 
												
                                                
                                                </div>
												<div class="col-md-3">
                                                
                                                 <label class="control-label">Telephone No (Official)</label>
													<input type="text" name="phoneoff" id="phoneoff" class="form-control" >
                                              
												</div>
											</div>
										
									</div>
                                    
                                    
                                    
                                    
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
                                            <div class="col-md-3">
                                                	<label class="control-label">Address Type</label>
													<div class="col-md-10" style="padding-left:0px;">
											
											<label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="2" checked>
												Official
											</label>
                                            <label class="radio-inline">
												<input type="radio" class="uniform" name="addresstype" value="1">
												Residential
											</label>
											
										</div>
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Address Line 1</label>
													<input type="text" name="address1" id="address1" class="form-control">
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Address Line 2</label>
													<input type="text" name="address2" id="address2" class="form-control">
												</div>
												
											</div>
										
									</div>
                                      <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">State</label>
													<select name="state" id="state" class="form-control "  onChange="clearPrevCity()"><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `state` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No State</option>

					<?php } ?>
                
                </select>
             
												</div>
												<div class="col-md-3"><input type="hidden" name="hidCity" id="hidCity" value="">
                                                <label class="control-label">City</label>
													<input type="text" name="city" id="city" class="form-control" autocomplete="off">
                                                     <div id="display"></div>
                                                      <span class="help-block">Type Few Char</span>
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Pin Code</label>
													<input type="text" name="pincode" id="pincode" class="form-control">
												</div>
											</div>
										
									</div>
                                    
                                    
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <hr/>
                                                
											</div>
												
												
										
									</div>
                                    
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												
												<div class="col-md-3">
                                                
                                                   
                                                    <label class="control-label">Marital Status</label>
													<select name="marital" id="marital" class="form-control " ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `maritals` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Marital</option>
					<?php } ?>
                
                </select>
												
                                                
                                                </div>
												<div class="col-md-3">
                                                
                                               
                                                <label class="control-label">Date Of Anniversary</label>
													<input type="text" name="doa" id="doa" class="form-control" data-mask="99/99/9999">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
                                                
                                                
                                                <div class="col-md-3">
                                                	<label class="control-label">Spouse Name</label>
													<input type="text" name="spname" id="spname" class="form-control" >
                                                    
												</div>
											</div>
										
									</div>
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-3">
                                                	<label class="control-label">Spouse Mobile</label>
													<input type="text" name="spmobile" id="spmobile" class="form-control" >
                                                   
												</div>
												<div class="col-md-3">
                                                
                                                   <label class="control-label">Spouse Email</label>
													<input type="text" name="spemail" id="spemail" class="form-control" >
                                                
												
                                                
                                                </div>
												<div class="col-md-2">
                                               
                                                <label class="control-label">Spouse Dob</label>
													<input type="text" name="spdob" id="spdob" class="form-control" data-mask="99/99/9999">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
                                                
                                                <div class="col-md-1">
                                               
                                                <label class="control-label">Spouse Card</label>
												<input type="checkbox" class="uniform" name="spcard" id="spcard" value="1"> (Check if required)
											
												</div>
											</div>
										
									</div>
                                    
                                    
                                <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-4">
                                                	<label class="control-label">Source</label>
														<input type="text" name="source" id="source" class="form-control" >
												</div>
												<div class="col-md-3">
                                                <label class="control-label">Profile Picture</label>
													<input type="file" name="image" id="image" data-style="fileinput">
												</div>
												
											</div>
										
									</div>
                                    
                                    
                                  <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                	<label class="control-label">Remarks (If any)</label>
														<input type="text" name="remark" id="remark" class="form-control" >
												</div>
												
												
											</div>
										
									</div>  
                                    
                                    <div class="form-group">
										
										
											<div class="row">
                                            <div class="col-md-2">
                                                
											</div>
												<div class="col-md-9">
                                                <input type="hidden" name="hidRmemId" id="hidRmemId" value="0">
                                                	<label class="control-label"><span style="color:#06C">Referred By </span></label>
														<input type="text" name="referredby" id="referredby" class="form-control" >
                                                         <div id="rdisplay"></div>
                                                      <span class="help-block">Type Few Character of Members Name*</span>
												</div>
												
												
											</div>
										
									</div>
                                    
                            
                            </div>
                            </div>
                            </div>
                            </div>
                <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Mode of Payment</h4>
                                <span style="float:right;color:#06C;font-weight:700;"><input type="checkbox" name="complimentry" value="1" id="complimentry" onClick="showHideAmountDiv('membertype')">&nbsp;&nbsp;Click if Membership is complimentry</span>
							</div>
							<div class="widget-content">
							
                             
                                 <div class="row">
										<label class="col-md-2 control-label">Amount (In Rs) *:</label>
										<div class="col-md-3"><input type="text" name="amount" id="amount" readonly class="form-control"></div>
									</div>
                                    
                                       
                           <div id="membertype" style="display:block;">   
                            <div class="row">
                            <hr/>
                            </div>
                                     
                            <div class="row" style="margin-top:20px;">
										<div class="form-group">
										<label class="col-md-2 control-label">Mode Of Payment *: </label>
										<div class="col-md-3">
											<?php
											    $counts=0;
												$execQry=mysql_query("select * from `paymentmodes` where `status` = '1' ");
												$numRows=mysql_num_rows($execQry);
												if($numRows>0){
												while($fetch=mysql_fetch_array($execQry)){
												$counts++;	
													?>
												<label class="radio"  style="padding-bottom:10px;"><input type="radio" class="uniform" name="modeofpayment" value="<?php echo $fetch['id']; ?>" <?php if($counts==1){ ?>checked<?php } ?>  onClick="showHideDiv('<?php echo $counts ?>')">	<?php echo stripslashes($fetch['name']); ?></label>
												<?php }
												}else{?>
												<label class="radio">
												<input type="radio" class="uniform" name="modeofpayment" value="0" disabled>
												No Payment Mode Defined Yet
											</label>
												<?php }
											?>
                                            
                                            
                                            
											
										</div>
                                        
                                        <div class="col-md-5" style="min-height:150px;">
											
                                          <?php
												$execQry=mysql_query("select * from `paymentmodes` where `status` = '1' ");
												$numRows=mysql_num_rows($execQry);
												if($numRows>0){
													$total=0;
												while($fetch=mysql_fetch_array($execQry)){
													$paymentModeId=$fetch['id'];
													$total++;
													
													?>
												<div class="row" style=" <?php if($total==1){ ?>display:block;<?php }else{ ?>display:none;<?php } ?>"  id="podiv<?php echo $total ?>" >
                                           
                                          			 <div class="widget box">
													 <div class="widget-header">
													<h4><i class="icon-reorder"></i> <?php echo stripslashes($fetch['name']); ?> Payment Details</h4>
												</div>
                                          
                                             
                                                <div class="widget-content">
													<?php    
                                                    $execQrys=mysql_query("select * from `paymentfields` where `status` = '1' and `u_id`='$paymentModeId' order by `id` ");
                                                    $numRowss=mysql_num_rows($execQrys);
                                                    if($numRowss>0){
                                                    while($fetchs=mysql_fetch_array($execQrys)){
														$ptId=$fetchs['id'];
														
														?>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><?php echo stripslashes($fetchs['name']); ?>: </label>
                                                        <input type="text" name="<?php echo $ptId ?>options" id="<?php echo $ptId ?>options" class="form-control input-width-large">
                                                        
                                                        </div>
                                                    <?php }}else{?>
                                                    <div class="form-group">No Details required</div>
                                                    <?php } ?>                                                   
                                                       
                                                
                                                </div>
										</div>
                                        
									            </div>
												<?php }
												}else{?>
												<div class="row" >
                                           
                                           <div class="widget box">
												<div class="widget-header">
													<h4><i class="icon-reorder"></i>Payment Details</h4>
												</div>
                                          
                                             
                                                <div class="widget-content">
                                                        <div class="form-group">
                                                        <label class="col-md-4 control-label">No Details Yet </label>
                                                      
                                                        
                                                        </div>  
                                                       
                                                
                                                </div>
										</div>
                                        
									</div>
												<?php }
											?>
                                          
                                          
                                           
                                    <input type="hidden" name="hidTotal" id="hidTotal" value="<?php echo $total; ?>">
                                    
                                   
										</div>
                                     
                                    </div>
                                  
                                    
                                    
                                    
							</div>
                            
                            <div class="row">
                            <hr/>
                            </div>
                            <div class="row">
										<label class="col-md-2 control-label"> Payment Pickup *:</label>
										<div class="col-md-10">
                                        
                                            <div class="col-md-3"><label class="radio-inline">
												<input type="radio" class="uniform" name="pickup"  id="pickup"value="1">
												Manually By (For Cash)
                                                
                                                
											</label></div>
                                            <div class="col-md-2" align="left">
                                            
                                            <select name="employee" id="employee" class="form-control"   >
                                            <option value="0"> Employee</option>
                                            <?php
                                            $selQry=mysql_query("select *  from `admin` where `status`='1' and `skey`!='1'  order by `id` Asc");
                                            $numrows=mysql_num_rows($selQry);
                                            if($numrows>0){
                                            while($fetch=mysql_fetch_array($selQry)){?>
                                            <option value="<?php echo $fetch['id'] ?>" ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
                                            <?php }
                                            }else{?>
                                            <option value="0">No Employee</option>
                                            <?php }
                                            ?>
 </select>
 
 </div>
                                            <div class="col-md-4" align="right">
                                            <label class="radio-inline">
												<input type="radio"  checked class="uniform" name="pickup" id="pickup" value="2">
												Or Transferred
											</label>
                                            </div>
										</div>
									</div>
                                    
                            <div class="row">
                            <hr/>
                            </div>
                            <div class="row">
										<label class="col-md-2 control-label"> Amount Credited On*:</label>
										<div class="col-md-10">
                                        
                                            
                                            <input type="text" name="creditedon" id="creditedon" class="form-control input-width-large" data-mask="99/99/9999">
                                                    <span class="help-block">DD/MM/YYYY</span>
                                            
										</div>
									</div>
                                    
                            </div>     <!--// hidden-->     
                                    
                                    
                             
                                    <div class="row">
                            <hr/>
                            </div>      
                                    
                                    <div class="row">
										<label class="col-md-2 control-label">Membership Tenure *:</label>
										<div class="col-md-8">
                                        <?php
											$execQry=mysql_query("select * from `tenures` where `status` = '1' ");
											$numRows=mysql_num_rows($execQry);
											$count=0;
											if($numRows>0){
											while($fetch=mysql_fetch_array($execQry)){
												$count++;
												?>
													<label class="radio-inline">
												<input type="radio" <?php if($count==1){ ?> checked <?php } ?> class="uniform" name="tenure" id="tenure" value="<?php echo $fetch['id'] ?>">
												<?php echo $fetch['name'] ?> Months
											</label>
											<?php }
											}else{?>
													<label class="radio-inline">
												<input type="radio" class="uniform" name="tenure" id="tenure" value="0">
												No Option
											</label>
											<?php }
										?>
                                        
                                        	
											
											</div>
									</div>
                                    
                                  <div id="compdiv" style="display:none;">  
                                    
                                    <div class="row">
                                    <hr/>
                                    </div>      
                                    <div class="row">
                                    <label class="col-md-2 control-label">Approved By</label>
                                    <div class="col-md-8">
                                   <select name="approvedby" id="approvedby" class="form-control " onChange="getEmployeeHead(this.value)" ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
                                    
                                    
                                    
                                    </div>
                                    </div>
                                    
                                    <div class="row">
                                    <hr/>
                                    </div>      
                                    <div class="row">
                                    <label class="col-md-2 control-label">Processed By</label>
                                    <div class="col-md-8">
                                    <select name="processedby" id="processedby" class="form-control " onChange="getEmployeeHead(this.value)" ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
                                    
                                    
                                    
                                    </div>
                                    </div>
                                    
                                  </div>      
                                
                               
                                 <div class="row">
                            <hr/>
                            </div> 
                                    
                                    <div class="row" style="padding-top:30px;">
										
										<div class="col-md-12">
                                        
                                            <div class="col-md-2">	</div>
                                            <div class="col-md-3" align="left">
                                           <input type="submit" name="submit" class="btn btn-primary btn-block" value=" Add Member"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="reset" name="reset" class="btn  btn-block" value=" Reset "> 
                                           
 
 </div>
										</div>
									</div>
                                    
                                    
                                    
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                
                
                
			</div>

     
     
     <?php } ?>       
            
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Members</h4>
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
            <th >Sno</th>
             <th  data-hide="phone,tablet">Preview</th>
             <th>Membership Id</th>
             <th>Voucher Id</th>
             <th  data-hide="phone">Program</th>
            <th  data-hide="phone">Name</th>
            <th data-hide="phone,tablet">Amount</th>
           
            <th  data-hide="phone,tablet">Add Family</th>
           <!-- <th  data-hide="phone,tablet">Add Reference</th>-->
             <th  data-hide="phone,tablet"> Mail</th>
            <th style="text-align:center"  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `members` where `status`='1' order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$progId=$fetch['prog_id'];
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $fetch['id'];
		$memNumber=$preffix."".$memId."".$suffix;
		$name=getTabledataById("name","titles",$fetch['title'])." ".$fetch['fname']." ".$fetch['mname']." ".$fetch['lname'];
		
	
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewmember.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['voucherno']; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
	<td align="left" class="smallfonttext"><?php echo getProgramPriceById($fetch['mlevel']); ?></td>
	<td align="center"  ><a href="familymembers.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-user"></i></button></a></td>
    <!--<td align="center"  ><a href="referencemembers.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-sitemap"></i></button></a></td>-->
    <td align="center"  ><a href="sendwelcomemail.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  >
    <?php if(checkMailSent($fetch['id'])){ ?><img src="images/welcomes.png"><?php }else{ ?><img src="images/welcome.png"><?php } ?>
    </a></td>
    
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr>
		<td align="right" ><a href="members.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn" type="button"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="members.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn" type="button"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','members',27)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
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
<script>
function fillPrintableName(){
	
	var fname=document.getElementById('fname').value;	
	var mname=document.getElementById('mname').value;	
	var lname=document.getElementById('lname').value;	
	var nameoncard =document.getElementById('nameoncard');
	if(mname==''){
		nameoncard.value=fname+" "+lname;	
	}else{
		nameoncard.value=fname+" "+mname+" "+lname;
	}
}
</script>
</body>
</html>