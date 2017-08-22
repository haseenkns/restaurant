<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");
	//echo $date = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') + 4, date('Y')));
	//echo mktime(0, 0, 0, date('m'), date('d') + 4, date('Y'));
	//die;
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
		
		mysql_query("BEGIN");
		if($flag==1){
		$excQry=mysql_query("INSERT INTO `members` (`id`, `prog_id`, `title`, `fname`, `mname`, `lname`, `gender`, `email`, `pcontact`, `scontact`, `dob`, `marital`, `doa`, `address1`, `address2`, `state`, `city`, `cityother`, `pincode`, `source`, `imagepath`, `amount`, `modeofpayment`, `pickup`, `employee`, `tenure`, `createdon`, `status` ,`mlevel`,`dateofsale`,`a_id`,`phoneres`,`phoneoff`,`spname`,`spemail`,`spmobile`,`spdob`,`remark`,`nameoncard`,`designation`,`compname`,`spousecard`,`voucherno`,`addresstype`) VALUES (NULL, '$program', '$title', '$fname', '$mname', '$lname', '$gender', '$email', '$pcontact', '$scontact', '$dob', '$marital', '$doa', '$address1', '$address2', '$state', '$hidCity', '$city', '$pincode', '$source', '$imgName', '$amount', '$modeofpayment', '$pickup', '$employee', '$tenure', '$pdate', '1','$hidMlevel','$dateofsale','$consultants','$phoneres','$phoneoff','$spname','$spemail','$spmobile','$spdob','$remark','$nameoncard','$designation','$compname','$spcard','$voucherno','$addresstype');");
		
	if($excQry){
		$flag=1;	 
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
	
		mysql_query("BEGIN");
		if($flag==1){
			
			
		 $sqlQry="UPDATE `members` SET `prog_id` = '$program', `title` = '$title', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `gender` = '$gender', `email` = '$email', `pcontact` = '$pcontact', `scontact` = '$scontact', `dob` = '$dob', `marital` = '$marital', `doa` = '$doa', `address1` = '$address1', `address2` = '$address2', `state` = '$state', `city` = '$hidCity', `cityother` = '$city', `pincode` = '$pincode', `source` = '$source', `imagepath` = '$imgName', `amount` = '$amount', `modeofpayment` = '$modeofpayment', `pickup` = '$pickup', `employee` = '$employee', `tenure` = '$tenure'
,`mlevel`='$hidMlevel',`dateofsale`='$dateofsale',`a_id`='$consultants',`phoneres`='$phoneres',`phoneoff`='$phoneoff',`spname`='$spname',`spemail`='$spname',`spmobile`='$spmobile',`spdob`='$spdob',`remark`='$remark',`nameoncard`='$nameoncard',`designation`='$designation',`compname`='$compname',`spousecard`='$spcard',`voucherno`='$voucherno' ,`addresstype`='$addresstype'  WHERE `members`.`id` = '$id';";
		 
		 
		 
		 
		 
		 
		//die;
	$execQry=mysql_query($sqlQry);
	if(!$execQry){
	$flag=0;	
	}else{
		$delQry=mysql_query("delete from `paymentstats` where  `mode`='$id' ");
	if(!$delQry){
		$flag=0;	
	}else{
	
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
						<h3>Members - Welcome Letter</h3>
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
            <th width="5%" >Sno</th>
             <th width="25%">Membership Id</th>
             <th width="20%"  data-hide="phone">Program</th>
            <th width="30%"  data-hide="phone">Name</th>
            <th width="10%" data-hide="phone,tablet" style="text-align:center;">Amount</th>
           
        
             <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Print Letter</th>
          
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
     
	
    <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
	<td align="left" class="smallfonttext" style="text-align:center;"><?php echo getProgramPriceById($fetch['mlevel']); ?></td>
 
	
    <td align="center"  ><a href="printwelcomeletter.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  ><img src="images/print.png"></a></td>
    
    
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
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