<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

if(isset($_GET['id'])&&$_GET['id']!=''){	
	$cid=$_GET['id'];
}
if(isset($_GET['pid'])&&$_GET['pid']!=''){	
	$pid=base64_decode($_GET['pid']);
	$resQry=mysql_fetch_row(mysql_query("select * from `collegephotos` where `id`='$pid'"));
	$image=$resQry[1];
	$url=$resQry[3];
	$position=$resQry[4];
	$type=$resQry[5];
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
	$delid=base64_decode($_GET['did']);
	$selimgQry=mysql_fetch_row(mysql_query("select * from  `collegephotos` where `id`='$delid'"));
	$oldimg=$selimgQry[1];
   $type=$selimgQry[5];
	$unlinkimg=unlink("../photos/".$oldimg);
	if($unlinkimg)
	{
		$delQry=mysql_query("delete from `collegephotos` where id='$delid'");
		if($delQry){
			$successflag=1;
		}else{
			$successflag=0;
		}
	}else{
		$successflag=0;
	}
	if($successflag=1){
		header("location:addcollegephotos.php?msg=dls&id=$cid");
	}else{
		header("location:addcollegephotos.php?msg=dlf&id=$cid");
	} 
 }


 //code for addind news in the datbase starts here
if(isset($_POST['submit'])|| isset($_POST['submit_x'])){

    $successflag=0;
	extract($_POST);
	$url=mysql_real_escape_string($url);
	$nwsimg=$_FILES['image']['name'];
	$newsimagename=basename($_FILES['image']['name']);
	$newsimagenamesrc=$_FILES['image']['tmp_name'];
	$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
	$imgName=$postednewsdate."_".$newsimagename;
	$moveimg=move_uploaded_file($newsimagenamesrc,'../photos/'.$imgName);
	
	
	
	if($moveimg){
	$sqlQry="insert into `collegephotos` set `imagepath`='$imgName' , `status`='1',`url`='$url',`position`='$position'";
	$execQry=mysql_query($sqlQry);
	if($execQry){$successflag=1;}else{$successflag=0;}
	}else{
	$successflag=0;
	}
	if($successflag==1){
		header("Location:addcollegephotos.php?msg=ins&id=$url");
	}
	if($successflag==0){
		header("Location:addcollegephotos.php?msg=inf&id=$url");
	}
	
	
}

if(isset($_POST['update'])){
    $successflag=1;
	extract($_POST);
	$id=$updateId;
 	 $url=mysql_real_escape_string($url);
			$resImgQry=mysql_fetch_row(mysql_query("select `imagepath` from `collegephotos` where `id` = '$id'"));
			$oldimg=$resImgQry[0];
			$img=$_FILES['image']['name'];
			if($img!=''){
			 $imagename=basename($_FILES['image']['name']);
			 $imagenamesrc=$_FILES['image']['tmp_name'];
			 $postednewsdate=base64_encode(date('Y-m-d h:i:s'));
			 $imgName=$postednewsdate."_".$imagename;
			 $moveimg=move_uploaded_file($imagenamesrc,'../photos/'.$imgName);
					if($moveimg){
						$unlinkimg=unlink("../photos/".$oldimg);
						$sqlImgQry=mysql_query("Update `collegephotos` set `imagepath`='$imgName'  where `id`='$id'");
					}else{
						$successflag=0;
					}
			}else{
			  $sqlImgQry=mysql_query("Update `collegephotos` set `url`='$url' ,`position`='$position'  where `id`='$id'");
			  if($sqlImgQry){
			   $successflag=1;
			  }else{
			   $successflag=0;
			  }
			}
	
	
	
	if($successflag==1){
	    header("Location:addcollegephotos.php?msg=ups&id=$url");
	}else{
        header("Location:addcollegephotos.php?msg=upf&id=$url");
	}
	
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Admin Panel </title>
    <script src="../javascript/javascript.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript">


	function validate()
	{
	
	var imageformat = new Array("JPEG","JPG","GIF","PNG");
	

			
			
		if(document.getElementById('image').value!="")
			{  
			var  path =document.getElementById('image').value;
			var imageext = path.split(".");
			var imgLen=imageext.length;
			var extention=imageext[imgLen - 1].toUpperCase();
			var result =imageformat.indexOf(extention);
			if(result==-1){
				alert('Image  can only be jpeg , png  or gif  !! ');
				document.getElementById('image').focus();
				return false;
			}
			}
			else{
			    if(!document.getElementById('updateId'))
				{
					alert('Image  cannot be left blank !! ');
					document.getElementById('image').focus();
					return false;
				}
			}
	if(document.getElementById('url').value==''){
		alert('Please enter banners url');
		document.getElementById('url').focus();
		return false;
	}		
		
	return true	
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
						<h3>College Photos </h3><h2><?php echo getCollegeNameById($cid); ?></h2>
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
								<h4><i class="icon-reorder"></i>Add Photos </h4><span style="float:right;cursor:pointer;" onClick="window.location.href='addcollegedetails.php?id=<?php echo $cid; ?>'">Go Back</span>
							</div>
							<div class="widget-content">
								<p><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    	  
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
                      <td>&nbsp;</td>
                      <td valign="top"><!--               start your coding here                 -->
					  <?php if(isset($_GET['pid'])&&$_GET['pid']!=''){	 ?>
                        <form action="" method="post" enctype="multipart/form-data" name="photos" id="photos" onSubmit="return  validate();">
                          <table width="100%" border="0" cellpadding="4" cellspacing="1" >
                            
                            
							
							
							<tr>
                              <td width="20%" align="left" valign="top" class="blackbold">Update image</td>
                              <td  align="left" >
							 <table width="77%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="39%" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="4">
						<tr>
							<td align="left"><input type="hidden" name="updateId" id="updateId" value="<?php echo $pid; ?>"><div class="col-md-10">
											<input type="file"  name="image" id="file">
						</div></td>
						</tr>
						
						</table></td>
    <td width="61%" rowspan="2" align="left" valign="top"><img src="../photos/<?php echo $image ?>" class="imgborder" width="60px" height="60px"></td>
    </tr>
  <tr>
    <td align="left">&nbsp;</td>
    </tr>
</table>							  </td>
                            </tr>
                       
                            <tr>
                              <td align="left">&nbsp;</td>
                              <td align="left">
							 							 <input type="hidden" name="url" value="<?php echo $cid; ?>">

							  <input type="submit" class="sub_btn"  name="update" value="   Update   " />&nbsp;<input type="button" class="sub_btn"  name="cancel" onClick="window.location.href='collegephotos.php?type=<?php echo $type; ?>'" value="   Cancel   " />	<input type="hidden" name="type" value="<?php echo $type; ?>">						 </td>
                            </tr>
                          </table>
                        </form>
						<?php }else{ ?>
						<form action="" method="post" enctype="multipart/form-data" name="photos" id="photos" onSubmit="return  validate();">
                          <table width="100%" border="0" cellpadding="4" cellspacing="1" >
                            
                           
							
							
							<tr>
                              <td width="20%" align="left" valign="top" class="blackbold">Upload image</td>
                              <td colspan="2"  align="left" >
							 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="57%" align="left"><table width="73%" border="0" cellspacing="0" cellpadding="4">
						<tr>
							<td align="left">
											<input type="file"  name="image" id="file">
					</td>
						</tr>
						
						</table></td>
    <td width="43%" align="left" valign="middle"  class="smallfonttext">[  Jpeg,Gif and Png images only ]</td>
  </tr>
</table>							  </td>
                            </tr>
							
                        
                        
                            <tr>
                              <td align="left">&nbsp;</td>
                              <td width="45%" align="left">
							 <input type="hidden" name="url" value="<?php echo $cid; ?>">
							  <input type="submit"   name="submit" class="btn" value="Submit" style="width:200px"  />&nbsp;<input type="button" class="btn"  value="Cancel" onClick="window.location.href='addcollegedetails.php?cid=<?php echo $cid; ?>'" />						 </td>
                              <td width="35%" align="left"></td>
                            </tr>
                          </table>
                        </form>
						<?php } ?>
                        <!--                 end  your coding here                  -->
                      </td>
                    </tr>
					  
					 <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top">
					<!--------------------code starts here---------------->
			
         

	<div class="widget-content">

           
            
            
            	<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover datatable  " >
                	<thead>
  <tr >
    <td align="left" width="6%" class="verysmalltextblack">Sno</td>
    <td width="70%" align="left"   class="verysmalltextblack">Image</td>
    <td width="24%" align="center" class="verysmalltextblack">Action</td>
  </tr>
  </thead>
  	<tbody>
 
  
  <?php 
  	$sqlQry=mysql_query("select * from `collegephotos`  order by `position` , `id` desc ");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
 
  <tr  bgcolor="#FFFFFF">
        <td align="center" width="6%" class="smalltext"><?php echo $i; ?></td>
        <td align="left" width="70%" class="smallfonttext"><img src="../photos/<?php echo $fetch['imagepath']; ?>" width="60" height="40" class="imgborder"></td>
       
        <td align="center" width="24%" bgcolor="#F9F9F9"><table width="100%"   border="0" cellpadding="3" cellspacing="0">
        <tr >
        <td align="right" width="20%"><a href="addcollegephotos.php?did=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $cid; ?>" onClick="return confirm(' Are you sure you want to delete.')"><img border="0" src="../images/b_drop.png"></a></td>
        <td align="center" width="25%"><a href="addcollegephotos.php?pid=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $cid; ?>"><img src="../images/b_edit.png" border="0"></a></td>
        <td align="left"><table width="80px" cellpadding="0" cellspacing="0"><tr><td align="left"><input type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id']  ?>','collegephotos',2)" <?php if($fetch['status']==1){echo 'checked';} ?>></td><td align="left" class="smalltext"><span id="status<?php echo $fetch['id']  ?>"><?php  echo getStatus($fetch['status']);  ?></span></td></tr></table></td>
        </tr>
        </table></td>
        
    
    </tr>
    
    
    
    
  
  <?php }}else{ ?>
  <tr><td colspan="3" class="verysmalltextblack" align="center" bgcolor="#FFFFFF">No Records Found</td></tr>
  <?php } ?>
   

		  
</table>
					
		</div>		<!--------------------code ends here---------------->
				
				</td>
              </tr>
              </tbody>	
          </table></p>
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