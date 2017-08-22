<?php
ob_start();
session_start();
//echo md5('superadmin');
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");


	
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Admin Panel </title>
    <script src="../javascript/javascript.js" type="text/javascript"></script>

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
						<h3>Data Parsing</h3>
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
								<h4><i class="icon-reorder"></i> Upload College Data</h4>
							</div>
							<div class="widget-content">
								<p>
                                
                              <table width="100%" border="0" cellspacing="2" cellpadding="2"  class="table    table-hover  datatable">
  <tr>
    <td width="24%" align="left"><h5 class="list-group-item list-group-header">Select University</h5></td>
    <td width="43%" align="left"><div class="col-md-8" style="margin-top:8px;"><select  class="form-control" id="university" style="padding:5px;height:35px" onChange="getAreaByLocationBack(this.value)"><option value="0">Select University Name</option> 
    <?php
	$selQry=mysql_query("select *  from `university` where `status`='1'");
	$numrows=mysql_num_rows($selQry);
	if($numrows>0){
		while($fetch=mysql_fetch_array($selQry)){?>
		<option value="<?php echo $fetch['id']; ?>"><?php echo $fetch['name']; ?></option> 
		<?php }
	}else{?>
		<option value="">No University</option> 
	<?php }

	
	?>
    
    </select></div></td>
    <td width="33%" rowspan="2" align="left"><div id="msgload" style="display:none;">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="11%" align="left"> <img src="../images/loader.gif"></td>
    <td width="89%" align="left" class="blackbold">  Fetching Colleges ,Please wait.......</td>
  </tr>
</table>

 </div></td>
  </tr>
  <tr>
    <td align="left"><h5 class="list-group-item list-group-header">Select College Name</h5></td>
    <td align="left"><div id="areadiv" class="col-md-8"  style="margin-top:8px;"><select id="college" onChange="setHidAreaValue(this.value)" class="form-control" style="padding:5px;height:35px"><option value="0">Select College Name</option> </select></div></td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    <td colspan="1" align="left"><div style="margin-left:14px"><input type="hidden" name="hidarea" id="hidcollege" value="0"><input type="button" onClick="gotoschool(document.getElementById('university'),document.getElementById('hidcollege'))" class="btn" name="submit" value="Save n Continue" style="width:260px"></div></td>
  </tr>
</table>

                                
                                
                                
                                </p>
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