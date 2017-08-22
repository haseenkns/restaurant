<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `programs` where `id`='$did'");
	//$delQry=
	
		if($delQry){
			mysql_query("delete from `program_price` where `prog_id`='$did'");
			header("location:addprograms.php?msg=dls");
		}else{
			header("location:addprograms.php?msg=dlf");
		}
}


if(isset($_GET['pdid'])&&$_GET['pdid']!=''){
	$pdid=base64_decode($_GET['pdid']);
	$peid=$_GET['eid'];
	
	$delQry=mysql_query("delete from `program_price` where `id`='$pdid'");
	//$delQry=
	
		if($delQry){
			
			header("location:addprograms.php?msg=pds&eid=$peid#finfo");
		}else{
			header("location:addprograms.php?msg=pdf&eid=$peid#finfo");
		}
}


if(isset($_POST['submit'])){
	extract($_POST);
	$flag=1;
	$pname=mysql_real_escape_string($_POST['pname']);
	$oemail=mysql_real_escape_string($_POST['oemail']);
	$aemail=mysql_real_escape_string($_POST['aemail']);
	$addressline1=mysql_real_escape_string($_POST['addressline1']);
	$addressline2=mysql_real_escape_string($_POST['addressline2']);
	$ocontact=mysql_real_escape_string($_POST['ocontact']);
	$acontact=mysql_real_escape_string($_POST['acontact']);
	$memberstartno=mysql_real_escape_string($_POST['memberstartno']);
	$voucher=mysql_real_escape_string($_POST['voucher']);
	$preffix=mysql_real_escape_string($_POST['preffix']);
	$suffix=mysql_real_escape_string($_POST['suffix']);
	
	
	/*$price1=mysql_real_escape_string($_POST['price1']);
	$price2=mysql_real_escape_string($_POST['price2']);
	$price3=mysql_real_escape_string($_POST['price3']);*/
	
	
	$remails=mysql_real_escape_string($_POST['remails']);
	$temails=mysql_real_escape_string($_POST['temails']);
	
	$pdate=date("d F, Y");
	mysql_query("BEGIN");
	$excQry=mysql_query("INSERT INTO `programs` (`id`, `pname`, `oemail`, `aemail`, `addressline1`, `addressline2`, `ocontact`, `acontact`, `memberstartno`, `voucherstartno`, `preffix`, `suffix`, `status`, `pdate`,`price1`,`price2`,`price3`,`remails`,`temails`) VALUES (NULL, '$pname', '$oemail', '$aemail', '$addressline1', '$addressline2', '$ocontact', '$acontact', '$memberstartno', '$voucher', '$preffix', '$suffix', '1', '$pdate','$price1','$price2','$price3','$remails','$temails');");
	if($excQry){
		
		$insId=mysql_insert_id();
		
		for($i=1;$i<=3;$i++){
			$priceTag="price".$i;
			$priceNameTag="pricename".$i;
			$price=trim($$priceTag);
			$pricename=trim($$priceNameTag);
			if(!$price==''){
				$insQry=mysql_query("Insert into `program_price` set `prog_id`='$insId' ,`price`='$price',`status`='1',`pricename`='$pricename'");	
				if($insQry){
				 	$flag=1;	
				}else{
					$flag=0;	
				}
			}
			
		
		}
		
			 
	}else{
		$flag=0;	
	}
	
	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:addprograms.php?msg=ins");					  
	}else{
		mysql_query("REVOKE");
		header("location:addprograms.php?msg=inf");	
	}
	
	
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidid'];
	
	
	$pname=mysql_real_escape_string($_POST['pname']);
	$oemail=mysql_real_escape_string($_POST['oemail']);
	$aemail=mysql_real_escape_string($_POST['aemail']);
	$addressline1=mysql_real_escape_string($_POST['addressline1']);
	$addressline2=mysql_real_escape_string($_POST['addressline2']);
	$ocontact=mysql_real_escape_string($_POST['ocontact']);
	$acontact=mysql_real_escape_string($_POST['acontact']);
	$memberstartno=mysql_real_escape_string($_POST['memberstartno']);
	$voucher=mysql_real_escape_string($_POST['voucher']);
	$preffix=mysql_real_escape_string($_POST['preffix']);
	$suffix=mysql_real_escape_string($_POST['suffix']);
	$price1=mysql_real_escape_string($_POST['price1']);
	$price2=mysql_real_escape_string($_POST['price2']);
	$price3=mysql_real_escape_string($_POST['price3']);
	
	 $remails=mysql_real_escape_string($_POST['remails']);
	$temails=mysql_real_escape_string($_POST['temails']);
	

	
	$sqlQry="UPDATE `programs` SET `pname` = '$pname', `oemail` = '$oemail', `aemail` = '$aemail', `addressline1` = '$addressline1', `addressline2` = '$addressline2', `ocontact` = '$ocontact', `acontact` = '$acontact', `memberstartno` = '$memberstartno', `voucherstartno` = '$voucher', `preffix` = '$preffix', `suffix` = '$suffix', `price1` = '$price1', `price2` = '$price2', `price3` = '$price3',`remails`='$remails',`temails`='$temails' WHERE `programs`.`id` = '$id';";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:modifyprograms.php?msg=ups");
	}else{
		header("location:modifyprograms.php?msg=upf");
	}
	
	
}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `programs` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	//$reportToDesignation=getEmployeeDesignationbyReportToId($userData[16]);
	
}

	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Administrator has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Administrator not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Administrator data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Administrator data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Administrator data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Administrator data not deleted successfully !!!!';
		$class='danger';
	break;
	
	case 'pds':
		$msg='Price level has been data deleted successfully !!';
		$class='success';
	break;
	
	case 'pdf':
		$msg='Price level has not been data deleted successfully !!!!';
		$class='danger';
	break;
	
	case 'pas':
		$msg='Price level has been added successfully !!';
		$class='success';
	break;
	
	case 'paf':
		$msg='Price level  not added successfully !!!!';
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
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script>
    function setFocus(val){
		document.getElementById(val).focus();	
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			//setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
		
    </script>
    
    
    <script type="text/javascript" language="JavaScript">

		
		
	function validateUser()
	{
		
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	var numbers = /^[0-9]+$/;
	
	
	if(document.user.pname.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter Program Name','pname')
		return false;
		}

		if(!document.user.pname.value.match(letters))
		{
			errorMsg('Only Alphabets , space and dot dign is allowed','pname');
			
			return false;
		}
	
	
	if(document.user.oemail.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter valid Email-address','oemail')
		
		return false;
		}

	if(!document.user.oemail.value.match(eptrn))
	{
		errorMsg('Enter valid Email-address','oemail');
		
		return false;
	}
	
	
	if(document.user.memberstartno.value=="")
		{
		errorMsg('Enter Membership Start Number','memberstartno')
		return false;
	}

	if(!document.user.memberstartno.value.match(numbers))
		{
			errorMsg('Only numerical digits (0-9) is allowed','memberstartno');
			return false;
	    }
		
	
	if(document.user.preffix.value=="")
		{
		errorMsg('Enter Membership Preffix','preffix')
		return false;
	}
	
	
	/*if(document.user.suffix.value=="")
		{
		errorMsg('Enter Membership Suffix','suffix')
		return false;
	}
		*/
		
		
	if(document.user.price1.value=="" && document.user.price2.value=='' && document.user.price3.value=='')
		{
			
			
			errorMsg('Add atleat one price level','price1');
			return false;
	    }	
			
		
	

}
</script>
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
						<!--<span>Good morning, John!</span>-->
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
								<h4><i class="icon-reorder"></i> Manage Programs</h4>
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
             <?php } else{?>
			 <tr>
                <td class="rgt1" colspan="2">&nbsp;</td>
               
              </tr>
			 <?php }?>
             
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top"><table width="98%" border="0" cellpadding="6" cellspacing="0" class="grayfour">
				<form action="" name="user" method="POST" onSubmit="return validateUser()"  class="form-horizontal row-border" > 
				<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ ?>
				
              
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Personal Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Program Name *</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Program Name" name="pname" id="pname" value="<?php echo htmlentities(stripslashes($userData[1])) ?>"></td>
				<td><div class="validateText">Enter Program Name</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Official Email *</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Official Email" name="oemail" id="oemail" value="<?php echo htmlentities(stripslashes($userData[2])) ?>"></td>
				<td><div class="validateText">Enter valid official email address</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Alternate Email</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Alternate Email." name="aemail" id="aemail" value="<?php echo htmlentities(stripslashes($userData[3])) ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Address Line 1</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Address Line 1." name="addressline1" id="addressline1" value="<?php echo htmlentities(stripslashes($userData[4])) ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Address Line 2</td>
				<td><input type="text" class="form-control  input-width-xxlarge" placeholder="Address Line 2." name="addressline2" id="addressline2" value="<?php echo htmlentities(stripslashes($userData[5])) ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Official Contact No </td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Official Contact No" name="ocontact" id="ocontact" value="<?php echo htmlentities(stripslashes($userData[6])) ?>"></td>
				<td><div class="validateText">Enter valid official contact no</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Alternate Contact No</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Alternate Contact No." name="acontact" id="acontact" value="<?php echo htmlentities(stripslashes($userData[7])) ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                 
                <tr >
				<td align="left" class="blackbold"> Room Reservation Emails </td>
				<td><input   class="form-control input-width-xxlarge tags" placeholder="Official Contact No" name="remails" id="remails" value="<?php echo htmlentities(stripslashes($userData[17])) ?>"></td>
				<td><div class="validateText">Seperate multiple ids by comma</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Table Reservation Emails</td>
				<td><input type="text" class="form-control input-width-xxlarge tags" placeholder="Alternate Contact No." name="temails" id="temails" value="<?php echo htmlentities(stripslashes($userData[18])) ?>"></td>
				<td><div class="validateText">Seperate multiple ids by comma</div></td>
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
				<td align="left" class="blackbold">Membership Start No*</td>
				<td><input type="text" class="form-control input-width-xxlarge" onkeypress="return isNumber(event)" placeholder="Membership Start no." name="memberstartno" id="memberstartno" value="<?php echo htmlentities(stripslashes($userData[8])) ?>"></td>
				<td><div class="validateText">Enter membership start no (only numbers 0-9)</div></td>
				</tr>
                
               
               
                <tr >
				<td align="left" class="blackbold"> Voucher Start No</td>
				<td><input type="text" class="form-control input-width-xxlarge " onkeypress="return isNumber(event)" placeholder="Voucher Start No." name="voucher" id="voucher" value="<?php echo htmlentities(stripslashes($userData[9])) ?>"></td>
				<td><div class="validateText">Enter membership start no (only numbers 0-9)</div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Membership Preffix *</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Membership Preffix" name="preffix" id="preffix" value="<?php echo htmlentities(stripslashes($userData[10])) ?>"></td>
				<td><div class="validateText">Enter Membership Preffix</div></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> Membership Suffix *</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Membership Suffix" name="suffix" id="suffix" value="<?php echo htmlentities(stripslashes($userData[11])) ?>"></td>
				<td><div class="validateText">Enter Membership Suffix<a id="finfo"></a></div></td>
				</tr>
                
                 <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-inr "></i>&nbsp;Financial Info</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="float:right;font-family:Arial, Helvetica, sans-serif;"><i class="icon-plus-sign">&nbsp;<b><a href="addprogrampricelevel.php?pid=<?php echo  base64_encode($eid) ?>">Add A New Price Level</a></b></span></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
               
               <?php
				$execQry=mysql_query("select * from `program_price` where `prog_id`='$eid'  order by `id` desc ");
				$numRows=mysql_num_rows($execQry);
				$levelcount=0;
				if($numRows>0){
					
				while($fetchp=mysql_fetch_array($execQry)){
				$levelcount++;
				?>
                <tr >
                    <td align="left" class="blackbold">Level - <b><?php echo $fetchp['pricename']; ?></b></td>
                    <td>
					
                    <div class="row">
                    <div class="col-md-7"><b><?php echo $fetchp[2] ?></b></div>
                    
                    <div class="col-md-1"><input class='uniform' type="checkbox" id="checkprice<?php echo $fetchp['id']  ?>" value="<?php echo $fetchp['status']  ?>" onClick="updatePriceStatus('<?php echo $fetchp['id'];  ?>','program_price',3)" <?php if($fetchp['status']==1){echo 'checked';} ?>></div>
                    
                    <div  class="col-md-2" id="statusprice<?php echo $fetchp['id'] ?>" ><?php echo getPriceStatus($fetchp['status']);  ?></div>
                    <?php
					if(!checkMlevelReferenceExists($fetchp['id'])){
					?>
                    <div class="col-md-2"><img src="images/delete.png">&nbsp;<a href="addprograms.php?eid=<?php echo base64_encode($eid); ?>&pdid=<?php echo base64_encode($fetchp['id']); ?>">Delete</a> </div>
                    <?php }else{ ?>
                   <!--  <div class="col-md-2"><img src="images/deleten.png"> No Delete </div>-->
                    <?php } ?>
                    
                    
                    </div>
                    
                    </td>
                    <td><div class="validateText" style="padding-left:20px;"><img src="images/b_edit.png"> &nbsp; <a href="addprogrampricelevel.php?eid=<?php  echo base64_encode($fetchp['id'])?>&pid=<?php echo base64_encode($userData[0]); ?>">Edit Price Name</a></div></td>
                </tr>
                <tr><td height="5px">&nbsp;</td></tr>
				<?php }}else{?>
						<tr >
				<td align="left" class="blackbold">Price Level </td>
				<td>No Price Level Added </td>
				<td><div class="validateText">Click( here ) to add a price level</div></td>
				</tr>
				<?php }
			   ?>
               
                
                
                
              
            
            
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" value="<?php echo $userData[0]; ?>" name="hidid"><input type="submit" name="update" class="btn" value="  Update   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addprograms.php'" class="btn"></td>
				</tr>
				
				<?php }else{?>
                 <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-user"></i>&nbsp;Personal Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Program Name *</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Program Name" name="pname" id="pname"></td>
				<td><div class="validateText">Enter Program Name</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Official Email *</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Official Email" name="oemail" id="oemail"></td>
				<td><div class="validateText">Enter valid official email address</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Alternate Email</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Alternate Email." name="aemail" id="aemail"></td>
				<td><div class="validateText"></div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Address Line 1</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Address Line 1." name="addressline1" id="addressline1"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Address Line 2</td>
				<td><input type="text" class="form-control  input-width-xxlarge" placeholder="Address Line 2." name="addressline2" id="addressline2"></td>
				<td><div class="validateText"></div></td>
				</tr>
                <tr >
				<td align="left" class="blackbold"> Official Contact No </td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Official Contact No" name="ocontact" id="ocontact"></td>
				<td><div class="validateText">Enter valid official contact no</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Alternate Contact No</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Alternate Contact No." name="acontact" id="acontact"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
                
                <tr >
				<td align="left" class="blackbold"> Room Reservation Emails </td>
				<td><input   class="form-control input-width-xxlarge tags" placeholder="Official Contact No" name="remails" id="remails"></td>
				<td><div class="validateText">Seperate Multiple ids by comma</div></td>
				</tr>
				<tr >
				<td align="left" class="blackbold"> Table Reservation Emails</td>
				<td><input type="text" class="form-control input-width-xxlarge tags" placeholder="Alternate Contact No." name="temails" id="temails"></td>
				<td><div class="validateText">Seperate Multiple ids by comma</div></td>
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
				<td align="left" class="blackbold">Membership Start No*</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Membership Start no." onkeypress="return isNumber(event)" name="memberstartno" id="memberstartno"></td>
				<td><div class="validateText">Enter membership start no (only numbers 0-9)</div></td>
				</tr>
                
               
               
                <tr >
				<td align="left" class="blackbold"> Voucher Start No</td>
				<td><input type="text" class="form-control input-width-xxlarge " placeholder="Voucher Start No." onkeypress="return isNumber(event)" name="voucher" id="voucher"></td>
				<td><div class="validateText">Enter membership start no (only numbers 0-9)</div></td>
				</tr>
                 <tr >
				<td align="left" class="blackbold"> Membership Preffix *</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Membership Preffix" name="preffix" id="preffix"></td>
				<td><div class="validateText">Enter Membership Preffix</div></td>
				</tr>
                  <tr >
				<td align="left" class="blackbold"> Membership Suffix *</td>
				<td><input type="text" class="form-control input-width-xxlarge" placeholder="Membership Suffix" name="suffix" id="suffix"></td>
				<td><div class="validateText">Enter Membership Suffix</div></td>
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
                
                <tr >
				<td align="left" class="blackbold">Price Level (Rs)</td>
				<td>
               <table width="100%" border="0">
  <tr>
    <td><input type="text" class="form-control input-width-large" placeholder="Add Price Level" onkeypress="return isNumber(event)" name="price1" id="price1"></td>
    <td>Price Name</td>
    <td><input type="text" class="form-control input-width-large" placeholder="Add Price Level"  name="pricename1" id="pricename1"></td>
  </tr>
</table>
 
                
                
                </td>
				<td><div class="validateText">Enter valid price and name</div></td>
				</tr>
               
                <tr >
				<td align="left" class="blackbold"> Price Level (Rs)</td>
				<td>
                
                
                <table width="100%" border="0">
  <tr>
    <td><input type="text" class="form-control input-width-large" placeholder="Add Price Level" onkeypress="return isNumber(event)" name="price2" id="price2"></td>
    <td>Price Name</td>
    <td><input type="text" class="form-control input-width-large" placeholder="Add Price Level" onkeypress="return isNumber(event)" name="pricename2" id="pricename2"></td>
  </tr>
</table></td>
				<td><div class="validateText">Enter valid price and name</div></td>
				</tr>
                
                 <tr >
				<td align="left" class="blackbold"> Price Level (Rs) </td>
				<td>
                <table width="100%" border="0">
  <tr>
    <td><input type="text" class="form-control input-width-large" placeholder="Add Price Level" onkeypress="return isNumber(event)" name="price3" id="price3"></td>
    <td>Price Name</td>
    <td><input type="text" class="form-control input-width-large" placeholder="Add Price Level" onkeypress="return isNumber(event)" name="pricename3" id="pricename3"></td>
  </tr>
</table>
                </td>
				<td><div class="validateText">Enter valid price and name</div></td>
				</tr>
            
                 
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input class="btn btn-primary pull-left" type="submit" name="submit"  value="  Submit   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addprograms.php'" class="btn"></td>
				</tr>
				<?php } ?>
  				</form>
</table></td>
              </tr>
			 
          </table>
          
          

							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                <!--<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Programs</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th>Code</th>
            <th>Name</th>
            <th  data-hide="phone">Email</th>
            <th data-hide="phone,tablet">Contact</th>
            <th  data-hide="phone,tablet">Preview</th>
             <th  data-hide="phone,tablet">Add Templates</th>
            <th  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `programs` order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo getProgramCode($fetch['id']); ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['pname']; ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['oemail']; ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['ocontact']; ?></td>
	  <td align="center"  ><a href="viewprogram.php?aid=<?php echo base64_encode( $fetch['id']); ?>" rel="facebox"> <button class="btn"><i class="icon-desktop"></i></button></span></td>
      
        <td align="center"  ><a href="addprogramtemplates.php?aid=<?php echo base64_encode( $fetch['id']); ?>" rel="facebox"> <img src="images/welcome.png"></span></td>
    
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" >
        <?php
		if(checkProgramReferenceExists($fetch['id'])){
		?>
        <a href="javascript:void(0)"  class="confirm-dialog" onClick="errorMsg('Program references exists within members database,so it can be deleted','')"><button class="btn"><i class="icon-trash"></i></button></a>
        <?php }else{ ?>
           <a href="addprograms.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a>
        <?php } ?>
        
        </td>
		<td align="center" ><a href="addprograms.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','programs',12)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td colspan="1" align="center" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>-->
			</div>
			<!-- /.container -->

		</div>
	</div>

   
    
   
</body>
</html>