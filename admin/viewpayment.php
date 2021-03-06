<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['lid'])&&$_GET['lid']!=''){	
	$lid=base64_decode($_GET['lid']);
	
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
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `target` where `id`='$did'");
	if($delQry){
		header("location:addtarget.php?msg=dls&aid=".base64_encode($aid)."");
	}else{
		header("location:addtarget.php?msg=dlf&aid=".base64_encode($aid)."");
	}
}


if(isset($_POST['submit'])){
	extract($_POST);
    $name=mysql_real_escape_string($_POST['name']);
    $edate=changeDate($edate);
	$edateend=changeDate($edateend);
	$encid=base64_encode($hidAid);

$sqlQry="insert into `target` set `name`='$name',`status`='1' ,`edate`='$edate' ,`edateend`='$edateend',`emp_id`='$hidAid'";
$execQry=mysql_query($sqlQry);
if($execQry){
	header("location:addtarget.php?msg=ins&aid=$encid");
}else{
	header("location:addtarget.php?msg=inf&aid=$encid");
}

}

if(isset($_POST['update'])){
	extract($_POST);
	$name=mysql_real_escape_string($_POST['name']);
	$edate=changeDate($edate);
	$edateend=changeDate($edateend);
	$encid=base64_encode($hidAid);
	$id=$_POST['hidval'];
	$sqlQry="Update `target` set `name`='$name' ,`edate`='$edate' ,`edateend`='$edateend' where `id`='$id' ";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:addtarget.php?msg=ups&aid=$encid");
	}else{
		header("location:addtarget.php?msg=upf&aid=$encid");
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
<script type="text/javascript" language="JavaScript">
	function validate()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var namePtrn=/^[/.a-zA-Z0-9 ]+$/;
	if(document.program.name.value=="")
		{
		alert('target cannot be left blank !!');
		document.program.name.focus();
		return false;
		}

	if(!document.program.name.value.match(namePtrn))
	{
		alert('Only alphabets A - Z ,dot ,forward slash and spaces are allowed !! ');
		document.program.name.focus();
		return false;
	}
	
	if(document.program.edate.value=="")
		{
		alert('Date cannot be left blank !!');
		document.program.edate.focus();
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
						<h3> View Payment Plan - <?php echo getLeadId($lid) ?></h3>
					  <span><a href="leadpayments.php">Go Back To Payments</a></span>
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> View Payment Plan</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
             	<thead>
										
  <tr >
    <th align="left" width="3%" class="verysmalltextblack">Sno</th>
    <th align="left"  width="9%"class="verysmalltextblack">Amount</th>
    <th align="left" style="text-align:center;"  width="8%"class="verysmalltextblack">Mode</th>
    <th align="center"  style="text-align:center" width="10%"class="verysmalltextblack">Paid On</th>
    <th align="center"  style="text-align:center" width="18%"class="verysmalltextblack">Bank</th>
    <th align="center"  style="text-align:center" width="9%"class="verysmalltextblack">S Tax %</th>
    <th align="center"  style="text-align:center" width="9%"class="verysmalltextblack">S Tax</th>
    <th align="center"  style="text-align:center" width="9%"class="verysmalltextblack">Tds</th>
    <th align="center"  style="text-align:center" width="16%"class="verysmalltextblack">Net Amt</th>
  </tr>
  </thead>
    <tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `creditpaid` where `lid` ='$lid' order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	$paidon=$fetch['paidon'];
		
		
		$chequeno=$fetch['chequeno'];
		$bank=$fetch['bank'];
		$branch=$fetch['branch'];
			$mode=$fetch['mode'];
	
		if($mode==1){
				$addInfo="Cash Payment done on : ".changeToStdDate(changeDate($paidon))." ";
		}
		if($mode==2){
				$addInfo="Checque Payment -  Cheq No - $chequeno ,Bank - $bank, Branch - $branch  ";
		}
		if($mode==3){
				$addInfo="Online Transfer done on : ".changeToStdDate(changeDate($paidon))."";
		}
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['amount']; ?></td>
    <td align="center" class="smallfonttext"><span style="cursor:pointer;color:#06F;" class="bs-popover"  data-trigger="hover" data-placement="top" data-content="<?php echo stripslashes($addInfo) ;?>" data-original-title="Additional Info"><?php echo getPaymentMode($fetch['mode']); ?></span></td>
    <td align="center" class="smallfonttext"><?php echo $fetch['pdate']. " ".$fetch['ptime']; ?></td>
    <td align="center" class="smallfonttext"><?php echo getBankNameById($fetch['bankid']); ?></td>
    <td align="center" class="smallfonttext"><?php echo $fetch['staxpercent']; ?></td>
    <td align="center" class="smallfonttext"><?php echo $fetch['staxamount']; ?></td>
    <td align="center" class="smallfonttext"><?php echo $fetch['tdsamount']; ?></td>
    <td align="center" class="smallfonttext"><?php echo $fetch['netamount']; ?></td>

    
  </tr>
  <?php }}else{?>
    <tr><td>&nbsp;</td>
    <td>No Records Found</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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