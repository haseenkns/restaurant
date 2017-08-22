<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['lid'])&&isset($_GET['lid'])){
	$lid=$_GET['lid'];
	$pid=$_GET['planid'];
}


if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `creditpaid` where `id`='$did'");
		if($delQry){
			header("location:addreceipt.php?msg=dls&lid=$lid");
		}else{
			header("location:addreceipt.php?msg=dlf&lid=$lid");
		}
}

if(isset($_POST['submit'])){
	extract($_POST);
	
	$type=mysql_real_escape_string($_POST['type']);
	$amount=mysql_real_escape_string($_POST['amount']);
	$remark=mysql_real_escape_string($_POST['remark']);
	$paidon=mysql_real_escape_string($_POST['paidon']);
	
	$bankname=mysql_real_escape_string($_POST['bankname']);
	$branchname=mysql_real_escape_string($_POST['branchname']);
	$chequeno=mysql_real_escape_string($_POST['chequeno']);
	
	$pdate=date("Y-m-d");
	$ptime=date("h:i a");
	$excQry=mysql_query("INSERT INTO `creditpaid` (`id`, `lid`, `amount`, `remark`, `bank`, `branch`, `status`, `pdate`, `ptime`,`mode`,`pid`,`chequeno`,`paidon`,`bankid`,`staxpercent`,`staxamount`,`tdspercent`,`tdsamount`,`netamount`) VALUES (NULL, '$hidLid', '$amount', '$remark', '$bankname', '$branchname', '1', '$pdate', '$ptime','$mode','$hidPid','$chequeno','$paidon','$bank','$hidStax','$hidStaxamount','$tdspercent','$tdspaid','$netamount');");
	
	
	if($excQry ){
			
		
		header("location:addreceipt.php?msg=ins&lid=$hidLid");					  
	}else{
		header("location:addreceipt.php?msg=inf&lid=$hidLid");	
	}
}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidid'];
	$type=mysql_real_escape_string($_POST['type']);
	$amount=mysql_real_escape_string($_POST['amount']);
	$remark=mysql_real_escape_string($_POST['remark']);
	$paidon=mysql_real_escape_string($_POST['paidon']);
	
	$bankname=mysql_real_escape_string($_POST['bankname']);
	$branchname=mysql_real_escape_string($_POST['branchname']);
	$chequeno=mysql_real_escape_string($_POST['chequeno']);
	
	 $sqlQry="UPDATE `creditpaid` SET  `amount` = '$amount', `remark` = '$remark' ,`mode`='$mode' ,`chequeno`='$chequeno' ,`bank`='$bankname' ,`paidon`='$paidon' ,`branch`='$branchname' ,`bankid`='$bank',`staxpercent`='$hidStax',`staxamount`='$hidStaxamount',`tdsamount`='$tdspaid',`netamount`='$netamount'  WHERE `creditpaid`.`id` = '$id';";
	//die;
	$execQry=mysql_query($sqlQry);
	
	
	
	if($execQry){
		
		
		header("location:addreceipt.php?msg=ups&lid=$hidLid");
	}else{
		header("location:addreceipt.php?msg=upf&lid=$hidLid");
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
		//alert(val)
		if(val==1){
			document.getElementById("paymentmodediv").style.display="none"
		}
		
		if(val==2){
			document.getElementById("paymentmodediv").style.display="block"
		}
		
	}
	</script>
    <script type="text/javascript" language="JavaScript">

		
		
	function validateReceipt()
	{
	
	
	if(document.getElementById('amount').value=="")
		{
		errorMsg('Please enter amount','amount')
		return false;
		}

	if(document.getElementById('tdspaid').value=="")
		{
		errorMsg('Please enter tds','tdspaid')
		return false;
		}
		
	if(document.getElementById('bank').value=="0")
		{
		errorMsg('Please select bank name','bank')
		return false;
		}
		
	if(document.getElementById('netamount').value=="")
		{
		errorMsg('Please enter netamount','netamount')
		return false;
		}
		
	if(document.getElementById('paidon').value=="")
		{
		errorMsg('Please enter paid on date','paidon')
		return false;
		}
		
	return true;
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
						<h3>Amount Paid - <?php echo getLeadId($lid); ?> </h3>
						<span><a href="leadpayments.php">Go Back To add Receipt</a></span>
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
								<h4><i class="icon-reorder"></i> Add Payment</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
         
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top" align="left">
				<!--------------------code starts here---------------->
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validateReceipt()">
			<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
                $eid=base64_decode($_GET['eid']);
                $execQry=mysql_fetch_row(mysql_query("select * from `creditpaid` where `id`='$eid'"));
                $type=$execQry[1];
				$amount= htmlentities(stripslashes($execQry[2]));
				$remark=htmlentities(stripslashes($execQry[3]));
				
			
				$cheque=htmlentities(stripslashes($execQry[11]));
				$branch=htmlentities(stripslashes($execQry[10]));
				$bank=htmlentities(stripslashes($execQry[5]));
				
				
				
				$mode=$execQry[9];
				$paidon=$execQry[12];
				
				
				$bankId=$execQry[13];
				$staxpercent=$execQry[14];
				$staxamount=$execQry[15];
				
				$tdsamount=$execQry[17];
				$netAmount=$execQry[18];
				
				$targetamt=$amount+$tdsamount;
            ?>
                
                
                <tr>
				<td align="left" class="blackbold"> Amount</td>
				<td width="44%"><input type="hidden" name="hidid" value="<?php echo $eid ?>"><input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="amount" id="amount" value="<?php echo $amount; ?>" onKeyUp="calculateTax()" onKeyPress="return isNumber(event)"></td>
				<td width="39%"  class="notice">Only Numeric Values (0-9)</td>
				</tr>
                
                
                   <tr >
                   <td align="left" class="blackbold">Tds</td>
                   <td><input class="form-control" value="<?php echo $tdsamount; ?>" onKeyUp="calculateTax()" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="tdspaid" id="tdspaid" ></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                   <tr >
                   <td align="left" class="blackbold"><input type="hidden" name="hidTamount" id="hidTamount" value="<?php echo $targetamt; ?>">Target Amount</td>
                   <td id="calculatedamount"><?php echo $targetamt; ?></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                 
                  <tr >
                   <td align="left" class="blackbold">Service Tax (%)</td>
                   <td  ><input type="text" class="form-control" data-mask="99.99" onKeyUp="calculateTax()" name="hidStax" id="hidStax" value="<?php echo $staxpercent; ?>"></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                 
                  <tr >
                   <td align="left" class="blackbold"><input type="hidden" name="hidStaxamount" id="hidStaxamount" value="<?php echo $staxamount; ?>">Service Tax</td>
                   <td id="calculatedtax" > <?php echo $staxamount; ?></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                 
                <tr >
                    <td align="left" class="blackbold">Payment Mode</td>
                    <td width="44%" colspan="2">
                    <table width="50%" border="0">
                    <tr>
                    <td> <input type="radio" name="mode" <?php if($mode==1){ ?> checked<?php } ?> value="1" onClick="showHideDiv(1)"> Cash Payment</td>
                    
                    
                    <td> <input type="radio" name="mode" value="2" <?php if($mode==2){ ?> checked<?php } ?> onClick="showHideDiv(2)"> Paid By Cheque</td>
                    <td> <input type="radio" name="mode" value="3" <?php if($mode==3){ ?> checked<?php } ?> onClick="showHideDiv(1)"> Online</td>
                    
                    </tr>
                    </table>
                    </td>
                </tr>


                
                <tr><td></td><td colspan="2"><div class="form-group" id="paymentmodediv" style="display:<?php if($mode==2){ ?>block<?php }else{ ?>none<?php } ?>;">
										
										
											<div class="row">
                                            
												<div class="col-md-5">
                                                <input type="hidden"  name="hidLid" id="hidLid" value="<?php echo $execQry[1]  ?>"><input type="hidden" id="hidPid"  name="hidPid" value="<?php echo $execQry[4]  ?>">
                                                <label class="control-label">Bank</label>
                                               
                                                <input  value="<?php echo $bank; ?>" class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="bankname" id="bankname" >
                                               
                                               
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Branch</label>
                                               <div id="chequebookdiv">
                                                <input  value="<?php echo $branch; ?>" class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="branchname" id="branchname" >
                                               
                                               </div>
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Cheque</label>
                                                <div id="chequediv">
                                                <input  value="<?php echo $cheque; ?>" class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="chequeno" id="chequeno" >
                                               
                                               </div>
												</div>
												
											</div>
										
									</div></td>
                                 
                                    
                    <tr >
                        <td align="left" class="blackbold">Deposited In Bank</td>
                        <td><select name="bank" id="bank" class="form-control"  onChange="getTargetAmount(this.value,document.getElementById('hidTamount').value,document.getElementById('hidStaxamount').value)">
                        <option value="0">Select Bank </option>
                        
                        <?php
						$execQrysl=mysql_query("select * from `banks` where `status` = '1'   ");
						$numRowssl=mysql_num_rows($execQrysl);
						if($numRowssl>0){
							while($fetchsl=mysql_fetch_array($execQrysl)){?>
								 <option value="<?php echo $fetchsl['id']; ?>" <?php if($bankId==$fetchsl['id']){ ?> selected <?php } ?> ><?php echo $fetchsl['name']; ?></option>
							<?php }	}else{?>
							 <option value="0">No Bank </option>
						<?php }	?>
                        
                        </select></td>
                        <td class="notice" >&nbsp;</td>
                      </tr>
                     
                
                 
               
                 
                  <tr >
                   <td align="left" class="blackbold">Net Amount</td>
                   <td><input class="form-control" value="<?php echo $netAmount; ?>" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="netamount" id="netamount" ></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
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
				<td colspan="2" align="left"><input type="hidden" name="hidMonth" value="<?php echo $month; ?>"><input type="hidden" name="hidYear" value="<?php echo $year; ?>"><input type="submit" name="update" class="btn" value=" Update  ">&nbsp;</td>
				</tr>
				<?php }else{?>
				
                
                    <tr >
                    <td align="left" class="blackbold">Amount *</td>
                    <td width="44%"><input autocomplete="off" class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="amount" id="amount"  onKeyUp="calculateTax()"></td>
                    <td width="39%" class="notice">Only Numeric Values (0-9)</td>
                    </tr>
                 <tr >
                   <td align="left" class="blackbold">Tds *</td>
                   <td><input class="form-control" onKeyUp="calculateTax()" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="tdspaid" id="tdspaid"  value="0"></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                    <tr >
                   <td align="left" class="blackbold"><input type="hidden" name="hidTamount" id="hidTamount" value="">Target Amount</td>
                   <td id="calculatedamount">- - -</td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                 
                   <tr >
                   <td align="left" class="blackbold">Service Tax (%)</td>
                   <td  ><input type="text" onKeyUp="calculateTax()" autocomplete="off" class="form-control" data-mask="99.99" name="hidStax" id="hidStax" value="<?php echo getEffectiveServiceTax(); ?>"> </td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                 
                   <tr >
                   <td align="left" class="blackbold"><input type="hidden" name="hidStaxamount" id="hidStaxamount" value="">Service Tax Amount</td>
                   <td id="calculatedtax" > - - - </td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                 
                                    
                   <tr>
				<td align="left" class="blackbold">Payment Mode</td>
				<td width="44%" colspan="2" >
                <table width="50%" border="0">
  <tr>
    <td> <input type="radio" name="mode" checked value="1" onClick="showHideDiv(1)"> Cash Payment</td>
    <td align="left">
    
      <td> <input type="radio" name="mode" value="2" onClick="showHideDiv(2)"> Paid By Cheque</td>

     <td> <input type="radio" name="mode" value="3" onClick="showHideDiv(1)" > Online</td>
    
     
  </tr>
</table>

                </td>
				
				</tr> 
                
                <tr><td></td><td colspan="2"><div class="form-group" id="paymentmodediv" style="display:none;" >
										
										
											<div class="row">
                                            
												<div class="col-md-5">
                                                <input type="hidden"  name="hidChequeBook" id="hidChequeBook" value="<?php echo $chkBookId  ?>"><input type="hidden" id="hidCheque"  name="hidCheque" value="<?php echo $cheque  ?>">
                                                <label class="control-label">Bank</label>
                                               <input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="bankname" id="bankname" >
                                               
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Branch</label>
                                               <div id="chequebookdiv">
                                               <input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="branchname" id="branchname" >
                                               </div>
												</div>
                                                
                                                <div class="col-md-3">
                                                <label class="control-label">Cheque No</label>
                                                <div id="chequediv">
                                               <input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="chequeno" id="chequeno" >
                                               </div>
												</div>
												
											</div>
										
									</div></td>
                                 
                     
                      <tr >
                        <td align="left" class="blackbold">Deposited In Bank *</td>
                        <td><select name="bank" id="bank" class="form-control"  onChange="getTargetAmount(this.value,document.getElementById('hidTamount').value,document.getElementById('hidStaxamount').value)">
                        <option value="0">Select Bank </option>
                        
                        <?php
						$execQrysl=mysql_query("select * from `banks` where `status` = '1'   ");
						$numRowssl=mysql_num_rows($execQrysl);
						if($numRowssl>0){
							while($fetchsl=mysql_fetch_array($execQrysl)){?>
								 <option value="<?php echo $fetchsl['id']; ?>"><?php echo $fetchsl['name']; ?></option>
							<?php }	}else{?>
							 <option value="0">No Bank </option>
						<?php }	?>
                        
                        </select></td>
                        <td class="notice" >&nbsp;</td>
                      </tr>
                 
                 
                 
                 
                  <tr >
                   <td align="left" class="blackbold"><b>Net Amount *</b></td>
                   <td><input class="form-control" style="letter-spacing:1px;"  title="Alphabets (A-Z),space and period(.) sign only" type="text" name="netamount" id="netamount" ></td>
                   <td class="notice" >&nbsp;</td>
                 </tr>
                     
                                    
                 <tr >
                   <td align="left" class="blackbold">Paid On Date *</td>
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
				<td colspan="2" align="left"><input type="hidden" name="staxpercent" id="staxpercent" value="<?php echo getEffectiveServiceTax();  ?>"><input type="hidden" name="tdspercent" id="tdspercent" value="<?php echo getEffectiveTds();  ?>"><input type="hidden" name="hidLid" value="<?php echo $lid; ?>"><input type="hidden" name="hidPid" value="<?php echo $pid; ?>"><input type="submit" name="submit" class="btn" value=" Add Amount ">&nbsp;</td>
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
                <th align="left"  width="20%"class="verysmalltextblack">Lead Id</th>
                <th align="left"  width="17%"class="verysmalltextblack">Amount</th>
                  <th align="left"  width="17%"class="verysmalltextblack">Paid On</th>
                <th align="left"  width="19%"class="verysmalltextblack">Remarks if any</th>
                <th align="left"  width="20%"class="verysmalltextblack">Mode</th>
                <th width="21%" align="center" class="verysmalltextblack">Action</th>
              </tr>
 		 </thead>
<tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `creditpaid` where `lid`='$lid'  order by `id` desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo getLeadId($lid); ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['amount']; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['paidon']; ?></td>
    <td align="left" class="smallfonttext"><?php if( $fetch['remark']==''){ echo "No Remark";}else{ echo $fetch['remark'];} ?></td>
    <td align="left" class="smallfonttext"><?php  if($fetch['mode']=='1'){ echo  "Cash"; }elseif($fetch['mode']=='2'){ echo "Cheque"; }else{ echo "Online"; } ?></td>
    <td align="center" >
      <table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
        <tr>
          <td align="right" ><a href="addreceipt.php?did=<?php echo base64_encode($fetch['id']) ?>&lid=<?php echo $lid ?>&planid=<?php echo $pid; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
          <td align="center" ><a href="addreceipt.php?eid=<?php echo base64_encode($fetch['id']) ?>&lid=<?php echo $lid ?>&planid=<?php echo $pid; ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
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

   
    <script>
		function getNetAmount(netamount,tax){
			
			var total=parseFloat(netamount)+parseFloat(tax);
			
			document.getElementById('netamount').value=total
			
		}
	</script>
    
    
     <script>
		function calculateTax(){
			
			var amount=parseFloat(document.getElementById('amount').value);
			var tds=parseFloat(document.getElementById('tdspaid').value);
			var tax=parseFloat(document.getElementById('hidStax').value);
			var targetAmt=amount+tds;
		//alert(targetAmt)
			var servicetaxamt=Math.ceil((tax*targetAmt)/100);
			document.getElementById('calculatedamount').innerHTML=targetAmt
			document.getElementById('calculatedtax').innerHTML=servicetaxamt
			
			document.getElementById('hidTamount').value=targetAmt
			document.getElementById('hidStaxamount').value=servicetaxamt
			
			document.getElementById('bank').selectedIndex=0
				document.getElementById('netamount').value=0
			
		}
	</script>
    
   
</body>
</html>