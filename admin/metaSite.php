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
		$msg='Web Title Updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Web Title Not Updated Successfully !!';
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
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
	$numqry=mysql_query("select * from `generalsettings`");
$selqry=mysql_num_rows($numqry);
$fetchrow=mysql_fetch_row($numqry);
if(isset($_POST['submit']))
{
extract($_POST);
$sitename=mysql_real_escape_string($_POST['sitename']);
if($selqry > 0)
{

$qry=mysql_query("update generalsettings set site_name='$sitename',site_description='',pagging='$pagesize' where id='$fetchrow[0]'");
		if($qry)
		{
		header("location:metaSite.php?msg=ups");
		}
		else
		{
		header("location:metaSite.php?msg=upf");
		
		}
}
else
{
$qry=mysql_query("insert into generalsettings set site_name='$sitename',site_description='$sitedesc',pagging='$pagesize'");
if($qry)
{
header("location:metaSite.php?msg=ins");
}
else
{
header("location:metaSite.php?msg=inf");

}
}
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
	
	if(document.setting.sitename.value=="")
		{
		
		alert('Enter The site name');
		document.setting.sitename.focus();
		return false;
		}
		if(document.setting.sitedesc.value=="")
		{
		
		alert('Enter The site description');
		document.setting.sitedesc.focus();
		return false;
		}
		if(document.setting.pagesize.value==0)
		{
		
		alert('Please Select the Paging');
		document.setting.pagesize.focus();
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
						<h3>General Settings</h3>
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
								<h4><i class="icon-reorder"></i> Web Title Setting</h4>
							</div>
                            
							<div class="widget-content">
								<table width="100%" border="0" cellspacing="0" cellpadding="3">
				<form name="setting" action="" method="post" onsubmit="return validate()">
                    
              <?php if($msg!=''){ ?>
              <tr>
                <td  align="left" colspan="3"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php }?>
			
                
				  <tr>
					<td width="10%" class="blackbold"><label >Website Title:</label></td>
					<td width="73%" ><input type="text" name="sitename" class="form-control input-group"  size="45"  value="<?php echo $fetchrow[1];?>" /></td>
					<td width="16%">&nbsp;</td>
				  </tr>
				
				   
				  
				
				  
				 
				
				 
				   
				   
				   <tr>
					<td class="blackbold">&nbsp;</td>
					<?php if($selqry > 0)
                      {?>
					<td><input type="submit" class="btn" name="submit" value="  Submit  " /></td>
					<?php }
					else
					{
					?>
					<td><input type="submit" class="btn" name="submit" value="  Update  " /></td>
					<?php }?>
					<td width="1%" class="greenText">&nbsp;</td>
				  </tr>
				  </form>
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