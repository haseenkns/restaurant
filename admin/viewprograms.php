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
		header("location:addprograms.php?msg=ups");
	}else{
		header("location:addprograms.php?msg=upf");
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
          <!--   <th  data-hide="phone,tablet">Add Templates</th>
            <th  data-hide="phone,tablet">Action</th>-->
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
	  <td align="center"  ><a href="viewprogram.php?aid=<?php echo base64_encode( $fetch['id']); ?>" rel="facebox"> <button class="btn"><i class="icon-desktop"></i></button></a></span></td>
      
      <!--  <td align="center"  ><a href="addprogramtemplates.php?aid=<?php echo base64_encode( $fetch['id']); ?>" rel="facebox"> <img src="images/welcome.png"></span></a></td>
    
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
	</table></td>-->
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
			</div>
			<!-- /.container -->

		</div>
	</div>

   
    
   
</body>
</html>