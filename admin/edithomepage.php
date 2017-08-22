<?php
ob_start();
session_start();
$ppac_cmsId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($ppac_cmsId);

if(isset($_GET['banner'])&&$_GET['banner']!=''){
	$did=base64_decode($_GET['banner']);
	$delQry=mysql_query("delete from `ppac_banner` where `id`='$did'");
		if($delQry){
			header("location:edithomepage.php?msg=bannerdls");
		}else{
			header("location:edithomepage.php?msg=dlf");
		}
}

if(isset($_GET['category'])&&$_GET['category']!=''){
	$did=base64_decode($_GET['category']);
	$delQry=mysql_query("delete from `ppac_cmscategoryimg` where `id`='$did'");
		if($delQry){
			header("location:edithomepage.php?msg=categorydls");
		}else{
			header("location:edithomepage.php?msg=dlf");
		}
}

if(isset($_GET['category'])&&$_GET['category']!=''){
	$did=base64_decode($_GET['category']);
	$delQry=mysql_query("delete from `ppac_cmscategoryimg` where `id`='$did'");
		if($delQry){
			header("location:edithomepage.php?msg=categorydls");
		}else{
			header("location:edithomepage.php?msg=dlf");
		}
}
if(isset($_POST['banner'])){

    $successflag=0;
	extract($_POST);
	
	$nwsimg=$_FILES['image']['name'];
	$newsimagename=basename($_FILES['image']['name']);
	$newsimagenamesrc=$_FILES['image']['tmp_name'];
	$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
	$imgName=$postednewsdate."_".$newsimagename;
	$moveimg=move_uploaded_file($newsimagenamesrc,'../photos/'.$imgName);
	$date=date("Y-m-d h:i:s");
	
	if($moveimg){
	$sqlQry="insert into `ppac_banner` set `banner_url`='$imgName', `banner_page`='home'  ";
	$execQry=mysql_query($sqlQry);
	if($execQry){$successflag=1;}else{$successflag=0;}
	}else{
	$successflag=0;
	}
	if($successflag==1){
		header("Location:edithomepage.php?msg=ins");
	}
	if($successflag==0){
		header("Location:edithomepage.php?msg=inf");
	}
	
}else if(isset($_POST['category'])){

    $successflag=0;
	extract($_POST);
	$cat_name = $_POST['cat_name'];
	$nwsimg=$_FILES['catimage']['name'];
	$newsimagename=basename($_FILES['catimage']['name']);
	$newsimagenamesrc=$_FILES['catimage']['tmp_name'];
	$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
	$imgName=$postednewsdate."_".$newsimagename;
	$moveimg=move_uploaded_file($newsimagenamesrc,'../photos/'.$imgName);
	$date=date("Y-m-d h:i:s");
	
	if($moveimg){
	$sqlQry="insert into `ppac_cmscategoryimg` set `cat_url`='$imgName', `cat_page`='home', `cat_name`='$cat_name'  ";
	$execQry=mysql_query($sqlQry);
	if($execQry){$successflag=1;}else{$successflag=0;}
	}else{
	$successflag=0;
	}
	if($successflag==1){
		header("Location:edithomepage.php?msg=ins");
	}
	if($successflag==0){
		header("Location:edithomepage.php?msg=inf");
	}
	
}else if(isset($_POST['video'])){

    $successflag=0;
	extract($_POST);
	$video_url = $_POST['video_url'];
	$date=date("Y-m-d h:i:s");
	
	$sqlQry="update `ppac_vedios` set `vedios_url`='$video_url' where `vedios_page`='home' ";
	$execQry=mysql_query($sqlQry);
	if($execQry){$successflag=1;}else{$successflag=0;}
	
	if($successflag==1){
		header("Location:edithomepage.php?msg=ins");
	}
	if($successflag==0){
		header("Location:edithomepage.php?msg=inf");
	}
	
}
if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidid'];
	
	
	$fname=mysql_real_escape_string($_POST['fname']);
	$lname=mysql_real_escape_string($_POST['lname']);
	$email=mysql_real_escape_string($_POST['email']);
	$contact=mysql_real_escape_string($_POST['contact']);
	$dateofbirth=mysql_real_escape_string($_POST['dateofbirth']);
	$officialcontact=mysql_real_escape_string($_POST['officialcontact']);
	$dateofjoining=mysql_real_escape_string($_POST['dateofjoining']);
	$salary=mysql_real_escape_string($_POST['salary']);
	$target=mysql_real_escape_string($_POST['target']);
	$uname=mysql_real_escape_string($_POST['uname']);
	$pwd=mysql_real_escape_string($_POST['pwd']);
	
	
	$address=mysql_real_escape_string($_POST['address']);
	$empacountnumber=mysql_real_escape_string($_POST['empacountnumber']);
	$empbank=mysql_real_escape_string($_POST['empbank']);
	$emppancard=mysql_real_escape_string($_POST['emppancard']);
	$empifsc=mysql_real_escape_string($_POST['empifsc']);
	$hra=mysql_real_escape_string($_POST['hra']);
	$medical=mysql_real_escape_string($_POST['medical']);
	$conveyance=mysql_real_escape_string($_POST['conveyance']);
	
	
	if($_POST['norole']==''){
		$norole=0;	
	}else{
		$norole=1;	
	}
	
	$chkUsrQry = mysql_fetch_row(mysql_query("select count(*) from `ppac_cms` where  `username`='$uname' and `id`!='$id' "));
	if($chkUsrQry[0]>0){
		header("location:addjudges.php?msg=ule");
		
	}else{
	
	
	$sqlQry="UPDATE `ppac_cms` SET   `email` = '$email', `contact` = '$contact', `firstname` = '$fname', `lastname` = '$lname', `dateofbirth` = '$dateofbirth', `designation` = '$designation', `officialcontact` = '$officialcontact', `dateofjoining` = '$dateofjoining', `salary` = '$salary', `target` = '$target', `reportto` = '$hidEmp', `role_id` = '$role', `imagepath` = '$imagepath', `norole` = '$norole' ,`address`='$address',`empacountnumber`='$empacountnumber',`empbank`='$empbank',`emppancard`='$emppancard',`salarytype`='$hidsalarytype',`hra`='$hra',`medical`='$medical',`conveyance`='$conveyance',`taxable`='$hidtaxable' ,`empifsc`='$empifsc' WHERE `id` = '$id';";
	$execQry=mysql_query($sqlQry);
	if($execQry){
		header("location:addjudges.php?msg=ups");
	}else{
		header("location:addjudges.php?msg=upf");
	}
	
	}

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `ppac_cms` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$reportToDesignation=getEmployeeDesignationbyReportToId($userData[16]);
	
}

	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Banner has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Banner not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Banner data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='ppac_cmsistrator data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'bannerdls':
		$msg='Banner has been deleted successfully !!';
		$class='success';
	break;
	
	case 'categorydls':
		$msg='Category has been deleted successfully !!';
		$class='success';
	break;
	
	case 'videodls':
		$msg='Category has been deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Judge data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='ppac_cmsistrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='ppac_cmsistrator rights not added successfully !!!!';
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
    
    
    <script type="text/javascript" language="JavaScript">

		
		
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
						<h3>Website CMS</h3>
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
                            
                            
								<h4><i class="icon-reorder"></i> Add Banner  </h4>
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
                 <?php                
        $sqlQry=mysql_query("select * from `ppac_banner` where `banner_page`='home'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	while($key=mysql_fetch_array($sqlQry)){ 
	$ban_url=$key['id'];
	?>
                <div style="width:300px;height:250px;float:left;margin:5px;">
                <div style="width:100%;height:200px;border:1px solid black;float:left;margin-bottom:5px"><img src="../photos/<?php echo $key['banner_url'] ?>" alt="image" width="100%" height="100%"/></div>
                  <center> <input type="button" name="cancel" class="btn danger" value=" Delete " onClick="javascript:window.location.href='edithomepage.php?banner=<?php echo base64_encode($ban_url); ?>'" class="btn">
                  </center>
                </div>
                <?php } ?>
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validate()" enctype="multipart/form-data">
		
				
            <tr >
              <td>Add Icon</td>
              <td align="left"><input  class="filetype" type="file" name="image" id="image"></td>
              <td align="left" style="font-size:12px;">icon ration should be 1:1 eg 100*100 or 200*200</td>
            </tr>
                 
            
            <tr >
            <td>&nbsp;</td>
            <td colspan="2" align="left"><input type="hidden" name="hidCid" value="<?php echo $cid; ?>"><input type="submit" name="banner" class="btn" value=" Add  Banner  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='edithomepage.php'" class="btn"></td>
            </tr>
  				</form>
</table>

							
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  <tr><td colspan="2">
						 
			  
			  </td></tr>
			  
          </table>
          
                              
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
                            
								<h4><i class="icon-reorder"></i> Add Category </h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
              
            
			  
              <?php /* if($msg!=''){ ?>
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td  align="left"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php } */ ?>
			
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top" align="left">
				<!--------------------code starts here---------------->
                 <?php                
        $sqlQry=mysql_query("select * from `ppac_cmscategoryimg` where `cat_page`='home'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	while($key=mysql_fetch_array($sqlQry)){ 
	$cat_id=$key['id'];
	?>
                <div style="width:200px;height:250px;float:left;margin:10px;">
                <div style="width:100%;height:200px;border:1px solid #aaa;float:left;margin-bottom:5px"><img src="../photos/<?php echo $key['cat_url'] ?>" alt="image" width="100%" height="100%"/></div>
                  <center> <input type="button" name="cancel" class="btn danger" value=" Delete " onClick="javascript:window.location.href='edithomepage.php?category=<?php echo base64_encode($cat_id); ?>'" class="btn">
                  </center>
                </div>
                <?php } ?>
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validate()" enctype="multipart/form-data">
				
            <tr >
            <td align="left" class="blackbold">Add Category  </td>
            <td colspan="2">
            <select id="stateAndCity" name="cat_name" class="form-control col-md-12">
            <option value="" >
                            Select Category
                          </option>
           <?php                
        $sqlQry=mysql_query("select * from `ppac_category`");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	while($key=mysql_fetch_array($sqlQry)){ 

	?>
                          <option value="<?php echo $key['titles'] ?> ">
                            <?php echo $key['titles'] ?>
                          </option>
<?php } ?>
                          
                        </select>
            </td>
            </tr>
            
				
            <tr >
              <td>Add Icon</td>
              <td align="left"><input  class="filetype" type="file" name="catimage" id="image"></td>
              <td align="left" style="font-size:12px;">icon ration should be 1:1 eg 100*100 or 200*200</td>
            </tr>
                 
            
            <tr >
            <td>&nbsp;</td>
            <td colspan="2" align="left"><input type="hidden" name="hidCid" value="<?php echo $cid; ?>"><input type="submit" name="category" class="btn" value=" Add  Category  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='edithomepage.php'" class="btn"></td>
            </tr>
  				</form>
</table>

							
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  <tr><td colspan="2">
			  
              
              
              
              
			 
			  
			  </td></tr>
			  
          </table>
          
                              
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
                            
                            
								<h4><i class="icon-reorder"></i> Add Videos  </h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
              
            
			  
              <?php /* if($msg!=''){ ?>
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td  align="left"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php } */?>
			
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top" align="left">
				<!--------------------code starts here---------------->
                 <?php                
        $sqlQry=mysql_query("select * from `ppac_vedios` where `vedios_page`='home'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	while($key=mysql_fetch_array($sqlQry)){ 
	?>
                <div style="width:100%;height:250px;float:left;margin:5px;">
                               <iframe src="<?php echo $key['vedios_url'];?>" width="100%" height="250" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                
                </div>
                <?php } ?>
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validate()" enctype="multipart/form-data">
				
            <tr >
            <td align="left" class="blackbold">Add url  </td>
            <td colspan="2"><input class="form-control "   title="" type="text" name="video_url" id="title"></td>
            </tr>
                          
            
            <tr >
            <td>&nbsp;</td>
            <td colspan="2" align="left">
            <input type="submit" name="video" class="btn" value="Upload">&nbsp;</td>
            </tr>
  				</form>
</table>

							
				<!--------------------code ends here---------------->
				</td>
              </tr>
			  <tr><td colspan="2">
			  
              
              
              
              
			 
			  
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