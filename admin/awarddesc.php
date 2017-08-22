<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
if($_SESSION['aid']=='')
	{
		header("location:index.php");
	}else{
		$aid=$_SESSION['aid'];
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
	

if(isset($_GET['id'])&&$_GET['id']!=''){
$competition_id = base64_decode($_GET['id']);
}
	
if(isset($_GET['did'])&&$_GET['did']!=''){
	$delid=base64_decode($_GET['did']);
        $cid=base64_decode($_GET['cid']);
	
	$selimgQry=mysql_fetch_row(mysql_query("select * from  `ppac_awarddesc` where `id`='$delid'"));
	$oldimg=$selimgQry[1];

	$unlinkimg=unlink("../photos/".$oldimg);
	
		$delQry=mysql_query("delete from `ppac_awarddesc` where id='$delid'");
		if($delQry){
			$successflag=1;
		}else{
			$successflag=0;
		}
	$competition_id = base64_encode($competition_id);
	if($successflag=1){
		header("location:ppac_awarddesc.php?msg=dls");
	}else{
		header("location:ppac_awarddesc.php?msg=dlf");
	} 
 }


 //code for addind news in the datbase starts here
if(isset($_POST['submit'])|| isset($_POST['submit_x'])){

    $successflag=0;
	extract($_POST);
	$content=mysql_real_escape_string($description);
        $competition_id=mysql_real_escape_string($_POST['competition_id']);	
	
	$nwsimg=$_FILES['image']['name'];
	$newsimagename=basename($_FILES['image']['name']);
	$newsimagenamesrc=$_FILES['image']['tmp_name'];
	$postednewsdate=base64_encode(date('Y-m-d h:i:s'));
	$imgName=$postednewsdate."_".$newsimagename;
	$moveimg=move_uploaded_file($newsimagenamesrc,'../photos/'.$imgName);
	$date=date("Y-m-d h:i:s");
	
	if($moveimg){
	$sqlQry="insert into `ppac_awarddesc` set `image`='$imgName' ,`competition_id`='$competition_id' , `status`='1',`content`='$content',`date`='$date'  ";
	$execQry=mysql_query($sqlQry);
	if($execQry){$successflag=1;}else{$successflag=0;}
	}else{
	$successflag=0;
	}
$competition_id = base64_encode($competition_id);
	if($successflag==1){
		header("Location:awarddesc.php?msg=ins&id=$competition_id");
	}
	if($successflag==0){
		header("Location:awarddesc.php?msg=inf&id=$competition_id");
	}
	
}

if(isset($_POST['update'])){
    $successflag=1;
	extract($_POST);
	$id=$hidId;
	$content=mysql_real_escape_string($description);
	$cid=$hidCid;
$ppac_awarddesc = $_POST['operational'];
	if(count($ppac_awarddesc)>0){
		$operational=implode(",",$ppac_awarddesc);	
	}else{
		$operational=0;
	}
 	 $title=mysql_real_escape_string($title);
	
			$resImgQry=mysql_fetch_row(mysql_query("select `imagepath` from `ppac_awarddesc` where `id` = '$id'"));
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
						// "Update `facility` set `imagepath`='$imgName' ,`url`='$url'  where `id`='$id'";
						
						$sqlImgQry=mysql_query("Update `ppac_awarddesc` set `imagepath`='$imgName' ,`title`='$title',`position`='$position',`content`='$content'  ,`operational`='$operational' where `id`='$id'");
					}else{
						$successflag=0;
					}
			}else{
			  $sqlImgQry=mysql_query("Update `ppac_awarddesc` set `title`='$title' ,`position`='$position',`content`='$content' ,`operational`='$operational'   where `id`='$id'");
			  if($sqlImgQry){
			   $successflag=1;
			  }else{
			   $successflag=0;
			  }		  
			
			
			}
	
	
	
	if($successflag==1){
	    header("Location:ppac_awarddesc.php?msg=ups");
	}else{
        header("Location:ppac_awarddesc.php?msg=upf");
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
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var namePtrn=/^[-.',@&a-zA-Z0-9)( ]+$/;
	if(document.program.title.value=="")
		{
			alert('Title cannot be left blank !!');
			document.program.title.focus();
			return false;
		}

	if(!document.program.title.value.match(namePtrn))
	{
		alert('Only alphabets A - Z ,dot ,\',@,& ,() and spaces are allowed !! ');
		document.program.title.focus();
		return false;
	}
	
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
                 
                 <div class="row">
					<div class="col-md-9">
                    	<h3>Award Description</h3>
                    </div>
                    
                   
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
                            
                            
								<h4><i class="icon-reorder"></i> Add Description </h4>
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
				<table width="100%" border="0" cellpadding="10" cellspacing="0" class="grayfourcurve">
				<form action="" name="program" method="post" onSubmit="return validate()" enctype="multipart/form-data">
				<?php if(isset($_GET['eid'])&&$_GET['eid']!=''){ 
					$eid=base64_decode($_GET['eid']);
					$execQry=mysql_fetch_row(mysql_query("select * from `ppac_awarddesc` where `id`='$eid'"));
					
					$name=$execQry[3];
					$image=$execQry[1];
					$description=$execQry[5];
					$operational=explode(",",$execQry[8]);
					
							
				?>
                
				<tr >
				<td width="17%" align="left" class="blackbold">Update Name  </td>
				<td colspan="2" ><input type="text"  class="form-control " style="letter-spacing:1px;"  title=""  size="45" name="title" id="title" value="<?php echo htmlentities(stripslashes($name)); ?>">         </td>
				</tr>
                
               <tr >
                    <td align="left" class="blackbold">Update Content  </td>
                    <td colspan="2"><textarea class="form-control wysiwyg" style="height:200px;width:100%;"   title="" type="text" name="description" id="description"><?php echo stripslashes($description); ?></textarea></td>
              </tr>
                
                <tr >
              <td>ppac_awarddesc Available In</td>
              <td colspan="2" align="left">
                <div style="width:100%;float:left;">
				<?php
                    $execQry=mysql_query("select * from `cities` where `status` = '1' and `premium`='1' order by `city_id` ");
                    $numRows=mysql_num_rows($execQry);
                    if($numRows>0){
                    while($fetch=mysql_fetch_array($execQry)){?>
                           <div style="float:left;width:180px;padding:5px;border:dotted 1px #CCC;">
                           <input type="checkbox" name="operational[]" <?php if( in_array($fetch['city_id'],$operational)){ ?> checked <?php } ?>   value="<?php echo $fetch['city_id'] ?>"> &nbsp; <b><?php echo $fetch['city_name']; ?></b></div>
                    <?php }
                    }else{?>
                           <div style="float:left;width:200px;">No Operational Areas</div>
                    <?php }?>
              
              	</div>
              </td>
            </tr>
			
				<tr >
				  <td>Update Image</td>
				  <td width="37%" align="left"><input  class="filetype" type="file" name="image" id="image"></td>
				  <td width="46%" align="left"><img src="../photos/<?php echo $image; ?>"  width="100px" height="100px" ></td>
				</tr>
                 
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" name="hidId" value="<?php echo $eid; ?>"><input type="hidden" name="updateId" id="updateId"><input type="submit" name="update" class="btn" value=" Update Gallery">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='ppac_awarddesc.php'" class="btn"></td>
				</tr>
				
				<?php }else{?>         
                
            <tr >
            <td align="left" class="blackbold">Add Content  </td>
            <td colspan="2"><textarea class="form-control wysiwyg" style="height:200px;width:100%;" title="" type="text" name="description" id="description"></textarea></td>
            </tr>
				
            <tr >
              <td>Add Banner</td>
              <td align="left"><input  class="filetype" type="file" name="image" id="image"></td>
              <td align="left" style="font-size:12px;">Banner ration should be 2:7 eg 200*700 </td>
            </tr>
                         
            <tr >
            <td>&nbsp;</td>
            <td colspan="2" align="left"><input type="hidden" name="competition_id" value="<?php echo $competition_id ?>" ><input type="submit" name="submit" class="btn" value=" Add Description  ">&nbsp;<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='ppac_awarddesc.php'" class="btn"></td>
            </tr>
				<?php } ?>
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
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> View Description</h4>
						  <div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
                            
                          <script type="text/javascript" src="../javascript/jquery-1.3.2.min.js"></script>
  <script>
		var $j = jQuery.noConflict();
</script>

  <script type="text/javascript" src="../javascript/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$j(document).ready(function(){ 
						   
	$j(function() {
		$("tbody").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings&type=ppac_awarddesc'; 
			$.post("updateposition.php", order, function(theResponse){
				
			}); 															 
		}								  
		});
	});

});	
</script> 
					  <div class="widget-content">
				<table width="100%" border="0" cellpadding="4" cellspacing="1" class="table table-striped table-bordered table-hover  datatable">
                 <thead>
                    <tr >
                        <th align="left" width="4%" class="verysmalltextblack">Sno</th>
                        <th align="left"  width="11%"class="verysmalltextblack">Image</th>
                        <th align="left"  width="36%"class="verysmalltextblack">Description</th>
                       <!-- <th align="left"  width="16%"class="verysmalltextblack">Start date</th>
                        <th align="center"  width="11%"class="verysmalltextblack">End date</th>-->
                        <th width="22%" align="center" class="verysmalltextblack">Action</th>
                    </tr>
                </thead>
    <tbody>

  <?php 
  	$sqlQry=mysql_query("select * from `ppac_awarddesc`  where `competition_id`='$competition_id' order by `id` desc ");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	$imagepath=$fetch['image'];

  ?>
  <tr bgcolor="#FFFFFF" id="recordsArray_<?php echo $fetch['id']; ?>" onmouseover="this.style.cursor='move'">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><img src="../photos/<?php echo $imagepath; ?>" width="80" height="80px"></td>
    <td align="left" class="smallfonttext"><?php echo $fetch['content']; ?></td>
    <td align="center" >
      <table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
        <tr>
          <td align="right" ><a href="awarddesc.php?did=<?php echo base64_encode($fetch['id']) ?>&cid=<?php echo $competition_id; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
         <!-- <td align="center" ><a href="ppac_awarddesc.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
          <td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','ppac_awarddesc',2)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
          -->
        <!--  <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td> -->
          </tr>
      </table></td>
  </tr>
  <?php }}else{?>
  <tr><td>&nbsp;</td><td>No Records Found</td>
   
    <td  align="left" bgcolor="#FFFFFF" class="blackbold">No Records Found !</td>
    <td  align="left" bgcolor="#FFFFFF" class="blackbold">&nbsp;</td>
    <td  align="left" bgcolor="#FFFFFF" class="blackbold">&nbsp;</td>  
    <td colspan="1">No Records Founds</td></tr>
  
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
