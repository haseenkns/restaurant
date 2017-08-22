<?php
ob_start();
session_start();
$food_menuId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($food_menuId);

if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `food_menu` where `id`='$did'");
		if($delQry){
			header("location:addmenu.php?msg=dls");
		}else{
			header("location:addmenu.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
	extract($_POST);
	$category=mysql_real_escape_string($_POST['category']);
	$name=mysql_real_escape_string($_POST['name']);
    $description=mysql_real_escape_string($_POST['description']);
	$price=mysql_real_escape_string($_POST['price']);
	
	$date=date("Y-m-d h:i:s");
/*
	    $nwsimg=$_FILES['image']['name'];
		if(!$nwsimg==''){
			$newsimagename=basename($_FILES['image']['name']);
			$newsimagenamesrc=$_FILES['image']['tmp_name'];
			$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
			$imgName=$postednewsdate."_".$newsimagename;
			$moveimg=move_uploaded_file($newsimagenamesrc,'../photos/'.$imgName);
			if(!$moveimg){
				$flag=0;	
			}
		}else{
	     	$imgName="nophoto.jpg";				
		}
	*/

		
	$excQry=mysql_query("INSERT INTO `food_menu` (`id`, `cid`, `name`, `description`, `price`, `status`)
                         VALUES (NULL, '$category', '$name', '$description', '$price', '1');");
	
	if($excQry ){
		header("location:addmenu.php?msg=ins");					  
	}else{
		header("location:addmenu.php?msg=inf");	
	}

}

if(isset($_POST['update'])){
	extract($_POST);
	$id=$_POST['hidid'];

    $category=mysql_real_escape_string($_POST['category']);
    $name=mysql_real_escape_string($_POST['name']);
    $description=mysql_real_escape_string($_POST['description']);
    $price=mysql_real_escape_string($_POST['price']);

			  $sqlImgQry=mysql_query("Update `food_menu` set `cid`='$category',`name`='$name',`description`='$description' ,`price`='$price' where `id`='$id'");
			  if($sqlImgQry){
			   $successflag=1;
			  }else{
			   $successflag=0;
			  }  

	if($successflag==1){
		header("location:addmenu.php?msg=ups");
	}else{
		header("location:addmenu.php?msg=upf");
	}
	
   

}



if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `food_menu` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);

    $category_id = $userData[1];
    $name = $userData[2];
    $description = $userData[3];
    $price = $userData[5];
    $hidId = $userData[0];
	
}

	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Menu has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Menu not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Menu data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Menu not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Menu data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Menu data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='food_menuistrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='food_menuistrator rights not added successfully !!!!';
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
    <script src="../javascript/javascript.js" language="javascript" type="text/javascript"> </script>
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
    <script src="../javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
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
	
	
	if(document.user.category.value<1)
		{
		alert('Please enter category');
		//errorMsg('Enter Category','category');
		return false;
		}

	if(document.user.name.value=="")
		{
		alert('Please enter item name');
		//errorMsg('Enter Last Name','lname')
		return false;
		}

	if(document.user.price.value=="")
		{
		alert('Please enter price');
		//errorMsg('Enter valid Email-address','email')
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
						<h3>Menu</h3>
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
								<h4><i class="icon-reorder"></i>Add Menu</h4>
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
				<form action="" name="user" method="post" onSubmit="return validateUser()" class="form-horizontal row-border" id="validate-1"  enctype="multipart/form-data"> 
				<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ ?>

                <tr >
				<td align="left"  colspan="3">
                    <div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-item"></i>&nbsp;Item Info</b> </div></td>
				
				</tr>
               
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                    <tr >
                        <td align="left" class="blackbold">Category</td>
                        <td><select name="category" id="category" class="form-control input-width-xxlarge required"
                            ><option value="0">Select Category</option>
                                <?php
                                $execQry=mysql_query("select * from `ppac_category` order by `id` ");
                                $numRows=mysql_num_rows($execQry);
                                if($numRows>0){
                                    while($fetch=mysql_fetch_array($execQry)){?>
                                        <option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($fetch['id']==$category_id){echo 'selected';} ?>><?php echo stripslashes($fetch['titles']) ?></option>
                                    <?php }	}else{?>
                                    <option value="0">No Category</option>
                                <?php } ?>

                            </select>
                        </td>
                    </tr>
                    <tr >
                        <td align="left" class="blackbold">Item Name <span class="required"></span></td>
                        <td><input class="form-control input-width-xxlarge required" placeholder="Name" name="name"  id="name" value="<?php echo $name ?>">                </td>
                        <td><div class="validateText">Enter name</div></td>
                    </tr>
                    <tr >
                        <td align="left" class="blackbold">Short Description <span class="required"></span></td>
                        <td><input class="form-control input-width-xxlarge required" placeholder="Description" name="description"  id="description" value="<?php echo $description ?>">                </td>
                        <td><div class="validateText">Enter description</div></td>
                    </tr>
                    <tr >
                        <td align="left" class="blackbold">Price</td>
                        <td><input   class="form-control input-width-xxlarge" placeholder="Price" name="price" id="price" value="<?php echo $price ?>"></td>
                        <td><div class="validateText">Enter Price</div></td>
                    </tr>

                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				</tr>

				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left">
                                <input type="hidden" value="<?php echo $userData[0]; ?>" name="hidid">
                                <input type="submit" name="update" class="btn" value="  Update   ">&nbsp;&nbsp;&nbsp;
                                <input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addmenu.php'" class="btn">
                                </td>
				</tr>
				
				<?php }else{?>
                 <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-edit"></i>&nbsp;Item Info</b> </div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>

                    <tr >
                        <td align="left" class="blackbold">Category</td>
                        <td><select name="category" id="category" class="form-control input-width-xxlarge required"
                            ><option value="0">Select Category</option>
				<?php
                        $execQry=mysql_query("select * from `ppac_category` order by `id` ");
                        $numRows=mysql_num_rows($execQry);
                        if($numRows>0){
                            while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>"><?php echo stripslashes($fetch['titles']) ?></option>
					<?php }	}else{?>
					<option value="0">No Category</option>
					<?php } ?>

                </select>
                </td>
                    </tr>

                <tr >
				<td align="left" class="blackbold">Item Name <span class="required"></span></td>
				<td><input class="form-control input-width-xxlarge required" placeholder="Name" name="name"  id="name">                </td>
				<td><div class="validateText">Enter name</div></td>
				</tr>
                    <tr >
                        <td align="left" class="blackbold">Short Description <span class="required"></span></td>
                        <td><input class="form-control input-width-xxlarge required" placeholder="Description" name="description"  id="description">                </td>
                        <td><div class="validateText">Enter description</div></td>
                    </tr>
                <tr >
				<td align="left" class="blackbold">Price</td>
				<td><input   class="form-control input-width-xxlarge" placeholder="Price" name="price" id="price"></td>
				<td><div class="validateText">Enter Price</div></td>
				</tr>
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" value="0" name="userStatus" id="userStatus"><input class="btn btn-primary pull-left" type="submit" name="submit"  value="  Submit   ">&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='addmenu.php'" class="btn"></td>
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
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View Menu</h4>
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
<!--            <th  data-hide="phone,tablet">Preview</th>-->
            <!-- <th>Name</th> -->
            <th>Category</th>
            <th  data-class="expand">Item Name</th>
            <th  data-hide="phone">Description</th>
            <th data-hide="phone,tablet">Price</th>
            <th  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
	</thead>

	<tbody>
	<?php 
  	$sqlQry=mysql_query("select * from `food_menu` order by `id` desc ");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <!-- <td align="center"  ><a href="#" rel="facebox"> <button class="btn"><i class="icon-desktop"></i></button></a></span></td>-->
    <!-- <td align="left" class="smallfonttext"><?php echo getCode($fetch['id']); ?></td>-->
	<td align="left" class="smallfonttext"><?php echo getFoodCategoryName($fetch['cid']) ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['name'] ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['description']; ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['price']; ?></td>
    <td align="center" bgcolor="#F9F9F9"><table border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="addmenu.php?did=<?php echo base64_encode($fetch['id']) ?>" class="confirm-dialog" onClick="return confirm('Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
	<td align="center" ><a href="addmenu.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button></a></td>        
        
	<!--	<td align="left" ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','food_menu',6)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id'] ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
         -->
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td colspan="1" align="center" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
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
