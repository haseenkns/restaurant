<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['month'])&&$_GET['month']!='0'){
	$month=$_GET['month'];
	$monthName = getMonth($month-1);
	$year=$_GET['year'];
}


if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `creditpaid` where `id`='$did'");
		if($delQry){
			$res=mysql_fetch_row(mysql_query("select count(*) from `chequepurchase` where `order_key`='$id'"));
			if($res[0]>0){
				$delQry=mysql_query("delete  from `chequepurchase` where `order_key`='$id'");
			if(!$delQry){
				$flag=0;	
			}
			}
			
			header("location:creditpaid.php?msg=dls");
		}else{
			header("location:creditpaid.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
	extract($_POST);
	
	$type=mysql_real_escape_string($_POST['type']);
	$amount=mysql_real_escape_string($_POST['amount']);
	$remark=mysql_real_escape_string($_POST['remark']);
	$paidon=mysql_real_escape_string($_POST['paidon']);
	$pdate=date("Y-m-d");
	$ptime=date("h:i a");
	$excQry=mysql_query("INSERT INTO `creditpaid` (`id`, `emp_id`, `amount`, `remark`, `month`, `year`, `status`, `pdate`, `ptime`,`mode`,`chequebook`,`chequeno`,`paidon`) VALUES (NULL, '$type', '$amount', '$remark', '$hidMonth', '$hidYear', '1', '$pdate', '$ptime','$mode','$hidChequeBook','$hidCheque','$paidon');");
	
	
	if($excQry ){
			if($mode==2){
			$insId=mysql_insert_id();
			
			$pexcQry=mysql_query("INSERT INTO `chequepurchase` (`id`, `order_key`, `chequebook`, `chequeno`, `status`,`exptype`) VALUES (NULL, '$insId', '$hidChequeBook', '$hidCheque', '1','2');");
			if(!$pexcQry){
			$flag=0;	
			}
			
			}
		
		header("location:creditpaid.php?msg=ins");					  
	}else{
		header("location:creditpaid.php?msg=inf");	
	}
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidid'];
	$type=mysql_real_escape_string($_POST['type']);
	$amount=mysql_real_escape_string($_POST['amount']);
	$remark=mysql_real_escape_string($_POST['remark']);
	$paidon=mysql_real_escape_string($_POST['paidon']);
	$sqlQry="UPDATE `creditpaid` SET `emp_id` = '$type', `amount` = '$amount', `remark` = '$remark' ,`mode`='$mode' ,`chequebook`='$hidChequeBook' ,`chequeno`='$hidCheque' ,`paidon`='$paidon'  WHERE `creditpaid`.`id` = '$id';";
	$execQry=mysql_query($sqlQry);
	
	
	if($mode==2){
				$delQry=mysql_query("delete  from `chequepurchase` where `order_key`='$id'");
				if(!$delQry){
						$flag=0;	
					}
				$pexcQry=mysql_query("INSERT INTO `chequepurchase` (`id`, `order_key`, `chequebook`, `chequeno`, `status`,`exptype`) VALUES (NULL, '$id', '$hidChequeBook', '$hidCheque', '1','2');");
				if(!$pexcQry){
						$flag=0;	
					}
				
			}elseif($mode==1){
			$res=mysql_fetch_row(mysql_query("select count(*) from `chequepurchase` where `order_key`='$id'"));
				if($res[0]>0){
					$delQry=mysql_query("delete  from `chequepurchase` where `order_key`='$id'");
					if(!$delQry){
						$flag=0;	
					}
				}
			}
	
	if($execQry){
		
		
		
		
		header("location:creditpaid.php?msg=ups&month=$hidMonth&year=$hidYear");
	}else{
		header("location:creditpaid.php?msg=upf&month=$hidMonth&year=$hidYear");
	}
}





	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Expense has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Expense not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Expense data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Expense data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Expense data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Expense data not deleted successfully !!!!';
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
	
	case 'sas':
		$msg='Salary has been  added successfully !!';
		$class='success';
	break;
	
	case 'saf':
		$msg='Salary  not added successfully !!!!';
		$class='danger';
	break;
	
	case 'sus':
		$msg='Salary has been  updated successfully !!';
		$class='success';
	break;
	
	case 'suf':
		$msg='Salary  not updated successfully !!!!';
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
    <script>
	function addemployeesalary(id,month,year){
		window.location.href='addemployeesalary.php?id='+id+'&month='+month+'&year='+year;
	}
	</script>

<style>
.validateText{
font-size:11px;
color:#999;
font-style:italic;	
}
</style>

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
			setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
		
    </script>
    
    <script>
	function showHideDiv(val){
		if(val==1){
			document.getElementById("paymentmodediv").style.display="none"
		}
		
		if(val==2){
			document.getElementById("paymentmodediv").style.display="block"
		}
		
	}
	</script>
    <!--<script type="text/javascript" language="JavaScript">

		
		
	function validateUser()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	
	
	if(document.user.fname.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter First Name','fname')
		
		return false;
		}

	if(!document.user.fname.value.match(letters))
	{
		errorMsg('Only Alphabets , space and dot dign is allowed','fname');
		
		return false;
	}
	
	if(document.user.lname.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter Last Name','lname')
		
		return false;
		}

	if(!document.user.lname.value.match(letters))
	{
		errorMsg('Only Alphabets , space and dot dign is allowed','lname');
		
		return false;
	}
	
	
	if(document.user.email.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter valid Email-address','email')
		
		return false;
		}

	if(!document.user.email.value.match(eptrn))
	{
		errorMsg('Enter valid Email-address','email');
		
		return false;
	}
	
	
	if(document.user.designation.value=="0")
		{
		errorMsg("Designation cannot be left blank","designation");
		return false;
		}
	
	
	if(document.user.uname.value=="")
		{
		errorMsg("Username should not blank",'username');
		document.user.uname.focus();
		return false;
		}
	if(document.user.uname.value!="")
		{
		  
		  if(!document.user.uname.value.match(uname)){
				errorMsg("Username - Please enter Alphabets a - z ,numbers 0-9 ,(! @ # & - _ ) symbols only",'username');
				return false;
			}
		}
		
	
	if(document.user.pwd.value=="")
		{
		errorMsg("Password should not be blank",'pwd');
		
		return false;
		}
		
	if(document.user.pwd.value!="")
		{
		  if(document.user.pwd.value.length < 6 || document.user.pwd.value.length > 36)
		   {
				errorMsg("Password should be atleast 6 characters and maximum 20 characters long !","pwd");
				
				return false;
		   }
	}	
	if(document.user.cpwd.value=="")
		{
		errorMsg("Confirm password cannot be left blank","cpwd");
		
		return false;
		}
	if(document.user.cpwd.value!=document.user.pwd.value)
		{
		errorMsg("Password and Confirm Password should match !","cpwd");
		
		return false;
		}
		
	if(document.user.role.value=="0")
		{
		errorMsg("Privileges cannot be left blank","role");
		return false;
		}	
		
	return true;
}
</script>-->
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
						<h3>Credit Paid </h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

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
                
                <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Add Credit paid</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
         
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top" align="left">
				<!--------------------code starts here---------------->
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validate()">
			<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
                $eid=base64_decode($_GET['eid']);
                $execQry=mysql_fetch_row(mysql_query("select * from `creditpaid` where `id`='$eid'"));
                $type=$execQry[1];
				$amount= htmlentities(stripslashes($execQry[2]));
				$remark=htmlentities(stripslashes($execQry[3]));
				
				$chkBookId=htmlentities(stripslashes($execQry[10]));
				$cheque=htmlentities(stripslashes($execQry[11]));
				$bank=getBankdetailByChqId($chkBookId);
				$mode=$execQry[9];
				$paidon=$execQry[12];
            ?>
                <tr>
				<td width="17%" align="left" class="blackbold">Creditor</td>
				<td width="44%"><input type="hidden" name="hidid" id="hidid" value="<?php echo $eid; ?>"><select name="type" id="type" class="form-control "  onChange="clearPrevCity()"><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `creditors` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($type==$fetch['id']) {?> selected <?php } ?> ><?php echo stripslashes($fetch['firstname'])."".stripslashes($fetch['lastname']) ?></option>
					<?php }	}else{?>
					<option value="0">No Creditors</option>

					<?php } ?>
                
                </select><input type="hidden" name="hidval" value="<?php echo $eid;  ?>"></td>
				<td width="39%" class="notice">Select Creditors</td>
				</tr>
                
                <tr>
				<td align="left" class="blackbold"> Amount</td>
				<td width="44%"><input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="amount" id="amount" value="<?php echo $amount; ?>" onKeyPress="return isNumber(event)"></td>
				<td width="39%"  class="notice">Only Numeric Values (0-9)</td>
				</tr>
                      <tr >
				<td align="left" class="blackbold">Payment Mode</td>
				<td width="44%" colspan="2">
                <table width="50%" border="0">
  <tr>
    <td> <input type="radio" name="mode" <?php if($mode==1){ ?> checked<?php } ?> value="1" onClick="showHideDiv(1)"> Cash Payment</td>
    <td align="left">
    
    <table width="100%" border="0">
  <tr>
    <td> <input type="radio" name="mode" value="2" <?php if($mode==2){ ?> checked<?php } ?> onClick="showHideDiv(2)"> Paid By Cheque</td>
    
  </tr>
</table>

   
    
     </td>
  </tr>
</table>

                </td>
				
				</tr> 
                
                <tr><td></td><td colspan="2"><div class="form-group" id="paymentmodediv" style="display:<?php if($mode==2){ ?>block<?php }else{ ?>none<?php } ?>;">
										
										
											<div class="row">
                                            
												<div class="col-md-5">
                                                <input type="hidden"  name="hidChequeBook" id="hidChequeBook" value="<?php echo $chkBookId  ?>"><input type="hidden" id="hidCheque"  name="hidCheque" value="<?php echo $cheque  ?>">
                                                <label class="control-label">Bank</label>
                                               
                                               <select name="bank" id="bank" class="form-control "  onChange="populateChequeBook(this.value)" ><option value="0">Select Bank</option>
				<?php
					$execQry=mysql_query("select * from `banks` where `status` = '1' order by `id` desc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($bank==$fetch['id']){ ?> selected <?php } ?> ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Bank</option>
					<?php } ?>
                
                </select>
                                               
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Cheque Book</label>
                                               <div id="chequebookdiv">
                                               <select name="chequebook" id="chequebook" class="form-control "  onchange="setChequeBook(this.value)"><option value="0">Cheque Book</option>
                                              <?php
					$execQry=mysql_query("select * from `cheques` where `status` = '1' and `bank` ='$bank' order by `id` desc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($chkBookId==$fetch['id']){ ?> selected <?php } ?> ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Chq Book</option>
					<?php } ?>
                                                
                
               								 </select>
                                               </div>
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Cheque</label>
                                                <div id="chequediv">
                                               <select name="cheque" id="cheque" class="form-control " onchange="setChequeValue(this.value)"  ><option value="0">Cheque </option>
                                               <?php
                                            $selQry=mysql_query("select *  from `cheques` where  `id`='$chkBookId' order by `id` Desc");
                                            $numrows=mysql_num_rows($selQry);
                                            if($numrows>0){
                                            while($fetch=mysql_fetch_array($selQry)){
											$start=$fetch['startno'];
											$end=$fetch['endno'];
											for($i=$start;$i<=$end;$i++){
											?>
                                            <option value="<?php echo $i ?>" <?php if($cheque==$i){ ?> selected <?php } ?> ><?php echo $i; ?></option>
                                            <?php }}
                                            }else{?>
                                            <option value="0">No Cheques</option>
                                            <?php }
                                            ?>

                                                
                
               								 </select>
                                               </div>
												</div>
												
											</div>
										
									</div></td>
                                 
                                    
             
                 <tr >
                   <td align="left" class="blackbold">Paid On Date</td>
                   <td><input class="form-control datepicker" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="paidon" id="paidon" value="<?php echo $paidon; ?>" ></td>
                   <td class="notice">&nbsp;</td>
                 </tr>
                 <tr >
				<td align="left" class="blackbold"> Remarks</td>
				<td width="44%"><input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="remark" id="remark" value="<?php echo $remark; ?>" ></td>
				<td width="39%" class="notice">&nbsp;</td>
				</tr>
                
				<tr>
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" name="hidMonth" value="<?php echo $month; ?>"><input type="hidden" name="hidYear" value="<?php echo $year; ?>"><input type="submit" name="update" class="btn" value=" Update  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='creditpaid.php?id=<?php echo $uid; ?>'" class="btn"></td>
				</tr>
				<?php }else{?>
				
                <tr >
				<td align="left" class="blackbold">Creditor</td>
				<td width="44%"><select name="type" id="type" class="form-control "  ><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `creditors` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" ><?php echo stripslashes($fetch['firstname'])." ".$fetch['lastname'] ?></option>
					<?php }	}else{?>
					<option value="0">No Creditor</option>

					<?php } ?>
                
                </select></td>
				<td width="39%" class="notice" >Select Creditor</td>
				</tr>
                 <tr >
				<td align="left" class="blackbold">Amount</td>
				<td width="44%"><input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="amount" id="amount" onKeyPress="return isNumber(event)"></td>
				<td width="39%" class="notice">Only Numeric Values (0-9)</td>
				</tr>
                
                                    
                   <tr >
				<td align="left" class="blackbold">Payment Mode</td>
				<td width="44%" colspan="2">
                <table width="50%" border="0">
  <tr>
    <td> <input type="radio" name="mode" checked value="1" onClick="showHideDiv(1)"> Cash Payment</td>
    <td align="left">
    
    <table width="100%" border="0">
  <tr>
    <td> <input type="radio" name="mode" value="2" onClick="showHideDiv(2)"> Paid By Cheque</td>
    
  </tr>
</table>

   
    
     </td>
  </tr>
</table>

                </td>
				
				</tr> 
                
                <tr><td></td><td colspan="2"><div class="form-group" id="paymentmodediv" style="display:none;" >
										
										
											<div class="row">
                                            
												<div class="col-md-5">
                                                <input type="hidden"  name="hidChequeBook" id="hidChequeBook" value="<?php echo $chkBookId  ?>"><input type="hidden" id="hidCheque"  name="hidCheque" value="<?php echo $cheque  ?>">
                                                <label class="control-label">Bank</label>
                                               <select name="bank" id="bank" class="form-control "  onChange="populateChequeBook(this.value)" ><option value="0">Select Bank</option>
				<?php
					$execQry=mysql_query("select * from `banks` where `status` = '1' order by `id` desc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($bank==$fetch['id']){ ?> selected <?php } ?> ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Bank</option>
					<?php } ?>
                
                </select>
                                               
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Cheque Book</label>
                                               <div id="chequebookdiv">
                                               <select name="chequebook" id="chequebook" class="form-control "  onchange="setChequeBook(this.value)"><option value="0">Cheque Book</option>
                                              <?php
					$execQry=mysql_query("select * from `cheques` where `status` = '1' and `bank` ='$bank' order by `id` desc ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($chkBookId==$fetch['id']){ ?> selected <?php } ?> ><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No Chq Book</option>
					<?php } ?>
                                                
                
               								 </select>
                                               </div>
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Cheque</label>
                                                <div id="chequediv">
                                               <select name="cheque" id="cheque" class="form-control " onchange="setChequeValue(this.value)"  ><option value="0">Cheque </option>
                                               <?php
                                            $selQry=mysql_query("select *  from `cheques` where  `id`='$chkBookId' order by `id` Desc");
                                            $numrows=mysql_num_rows($selQry);
                                            if($numrows>0){
                                            while($fetch=mysql_fetch_array($selQry)){
											$start=$fetch['startno'];
											$end=$fetch['endno'];
											for($i=$start;$i<=$end;$i++){
											?>
                                            <option value="<?php echo $i ?>" <?php if($cheque==$i){ ?> selected <?php } ?> ><?php echo $i; ?></option>
                                            <?php }}
                                            }else{?>
                                            <option value="0">No Cheques</option>
                                            <?php }
                                            ?>

                                                
                
               								 </select>
                                               </div>
												</div>
												
											</div>
										
									</div></td>
                                 
                                    
                 <tr >
                   <td align="left" class="blackbold">Paid On Date</td>
                   <td><input class="form-control datepicker" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="paidon" id="paidon" ></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 <tr >
				<td align="left" class="blackbold">Remarks</td>
				<td width="44%"><input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="remark" id="remark" ></td>
				<td width="39%" class="notice" >&nbsp;</td>
				</tr>
                
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" name="hidMonth" value="<?php echo $month; ?>"><input type="hidden" name="hidYear" value="<?php echo $year; ?>"><input type="submit" name="submit" class="btn" value=" Add Salary ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='creditpaid.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>'" class="btn"></td>
				</tr>
				<?php } ?>
  				</form>
</table>
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  <tr><td colspan="2">
<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
    	<thead>
              <tr>
                <th align="left" width="3%" class="verysmalltextblack">Sno</th>
                <th align="left"  width="20%"class="verysmalltextblack">Creditor name</th>
                <th align="left"  width="17%"class="verysmalltextblack">Amount</th>
                  <th align="left"  width="17%"class="verysmalltextblack">Paid On</th>
                <th align="left"  width="19%"class="verysmalltextblack">Remarks if any</th>
                <th align="left"  width="20%"class="verysmalltextblack">Mode</th>
                <th width="21%" align="center" class="verysmalltextblack">Action</th>
              </tr>
 		 </thead>
<tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `creditpaid` where `month`='$month' and `year`='$year'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo getCreditorNameById($fetch['emp_id']); ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['amount']; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['paidon']; ?></td>
    <td align="left" class="smallfonttext"><?php if( $fetch['remark']==''){ echo "No Remark";}else{ echo $fetch['remark'];} ?></td>
    <td align="left" class="smallfonttext"><?php  if($fetch['mode']=='1'){ echo  "Cash"; }else{ echo "Cheque"; } ?></td>
    <td align="center" >
      <table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
        <tr>
          <td align="right" ><a href="creditpaid.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
          <td align="center" ><a href="creditpaid.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
          <td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','creditpaid',6)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
          <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
          </tr>
      </table></td>
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td>No Records Found</td>
    <td>&nbsp;</td>
  
    <td>&nbsp;</td><td>&nbsp;</td>
    <td  align="left" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td> <td>&nbsp;</td></tr>
  
  <?php } ?>
  </tbody>
</table>
			  
			  </td></tr>
			  
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