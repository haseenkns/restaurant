<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

	
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
	
if(isset($_POST['submit']))
		{
$content=$_POST["content"];
$select1=mysql_num_rows(mysql_query("select * from cms where  `key`='2'"));
			//$select=mysql_num_rows(mysql_query("select * from cms where  `key`='2'"));
		   if($select1<1)
		   {   
		  	    $insert=mysql_query("insert into cms set `id`='',`content`='$content',`title`='".mysql_real_escape_string($_POST["heading"])."' ,`key`='2' ");
		   		if($insert){
					header("location:aboutus.php?msg=ins");
				}else{
					header("location:aboutus.php?msg=inf");
				}
		   }
		   else
		   {
			   $update=mysql_query("update cms  set content='$content',`title`='".mysql_real_escape_string($_POST["heading"])."'  where `key`='2'");
			   if($update){
			   		header("location:aboutus.php?msg=ups");
			   }else{
			   		header("location:aboutus.php?msg=upf");
			   }
			}
		}

	$myselect=mysql_query("select * from cms where  `key`='2'");
	$mypageget=mysql_fetch_row($myselect);
	if($mypageget)
	{   
	    $pageheading=$mypageget['1'];
		$pagecontent=$mypageget['2'];
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title><?php echo getSiteTitle(); ?></title>

    <script src="../javascript/javascript.js" type="text/javascript"></script>
  
<script type="text/javascript" language="JavaScript">
	function validate()
	{
	
	if(document.addfrm.heading.value=="")
		{
		
		alert('Enter The Heading');
		document.addfrm.heading.focus();
		return false;
		}
		
		
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
						<h3>Conference</h3>
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
								<h4><i class="icon-reorder"></i> Conference Content</h4>
							</div>
							<div class="widget-content">
								<table width="100%" border="0" cellpadding="2" cellspacing="2">
              
              <?php if($msg!=''){ ?>
              <tr>
                <td  align="left" colspan="3"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php }?>
             
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td valign="top"><!--               start your coding here                 -->
                        <form action="" method="post" name="addfrm" id="addfrm" onSubmit="return validate();">
                          <table width="100%" border="0" cellpadding="4" cellspacing="1" >
                            <tr>
                              <td align="left" class="blackbold">Heading</td>
                              <td width="88%" align="left">
                              <input  class="form-control input-width-xxlarge" type="text" id="heading"  name="heading" value="<?php echo $pageheading ;?>" /></td>
                            </tr>
                            <tr>
                              <td width="12%" align="left" valign="top" class="blackbold">Content </td>
                              <td  align="left" >
		                 	<textarea type="text" name="content" class="form-control wysiwyg"  rows="15" cols="72"><?php echo $pagecontent ;?></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td align="left">&nbsp;</td>
                              <td align="left">
							  <?php 
							  if($select1<1)
		                        {  
							  ?>
							  <input type="submit" class="btn"  name="submit" value="  Submit  " />
							  <?php }else {?>
							   <input type="submit" class="btn"  name="submit" value="  Update Content   " />
							  <?php }?></td>
                            </tr>
                          </table>
                        </form>
                        <!--                 end  your coding here                  -->
                      </td>
                    </tr>
                  </table>
				
				</td>
              </tr>
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
