<?php
ob_start();
session_start();
//echo md5('superadmin');
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

if(isset($_GET['uv'])&&$_GET['cl']!=''){	
	$univ=$_GET['uv'];
	$clg=$_GET['cl'];
	$university=getUniversityNameById($univ);
    $college=getCollegeNameById($clg);
}
if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `schools` where `id`='$did'");
		if($delQry){
			header("location:schools.php?msg=dls&uv=$univ&cl=$clg");
		}else{
			header("location:schools.php?msg=dlf&uv=$univ&cl=$clg");
		}
}	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='College Data Has Been  Parsed  Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='College Data Not Parsed Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Student Data has been updated Successfully !!';
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
	
	 if(isset($_POST['submit'])){
	 $cid=$_POST['cid'];
	  $uv=$_POST['unv'];
  if ( $_FILES['sheet']['tmp_name'] )
		  {
		  $pdate=date("Y-m-d");
		  $dom = DOMDocument::load( $_FILES['sheet']['tmp_name'] );
		  $rows = $dom->getElementsByTagName( 'Row' );
		  $first_row = true;
		  foreach ($rows as $row)
		  {
		  if ( !$first_row ){ $first = "";$middle = "";$last = "";$gender = "";$fathername = "";$dob = "";$email = "";$mobile = "";
			$amobile = "";$landline = "";$country = "";$state = "";$city = "";$address1 = "";$address2 = "";$address3 = "";$pincode = "";$course = "";$yaddmission = "";$ypassing = "";$university = "";$college = "";$pover = "";$pfirst = "";$psecond = "";$pthird = "";$pfourth = "";$phonors = "";
		  
		  $index = 1;
		  $cells = $row->getElementsByTagName( 'Cell' );
		  foreach( $cells as $cell )
		  { 
		  $ind = $cell->getAttribute( 'Index' );
		  if ( $ind != null ) $index = $ind;
		  
		  $cells=$cell->nodeValue;
		  if($cells==''){
		 	 $cells='NA';
		  } 
				if ( $index == 1 ) $first = mysql_real_escape_string($cells);
				if ( $index == 2 ) $middle =mysql_real_escape_string($cells);
				if ( $index == 3 ) $last = mysql_real_escape_string($cells);
				if ( $index == 4 ) $gender =mysql_real_escape_string($cells);
				if ( $index == 5 ) $fathername =mysql_real_escape_string($cells);
				if ( $index == 6 ) $dob =mysql_real_escape_string($cells);
				if ( $index == 7 ) $email =mysql_real_escape_string($cells);
				if ( $index == 8 ) $mobile =mysql_real_escape_string($cells);
				if ( $index == 9 ) $amobile =mysql_real_escape_string($cells);
				if ( $index == 10 ) $landline =mysql_real_escape_string($cells);
				if ( $index == 11 ) $country =mysql_real_escape_string($cells);
				if ( $index == 12 ) $state =mysql_real_escape_string($cells);
				if ( $index == 13 ) $city =mysql_real_escape_string($cells);
				if ( $index == 14 ) $address1 =mysql_real_escape_string($cells);
				if ( $index == 15 ) $address2 =mysql_real_escape_string($cells);
				if ( $index == 16 ) $address3 =mysql_real_escape_string($cells);
				if ( $index == 17 ) $pincode =mysql_real_escape_string($cells);
				if ( $index == 18 ) $course =mysql_real_escape_string($cells);
				if ( $index == 19 ) $yaddmission =mysql_real_escape_string($cells);
				if ( $index == 20 ) $ypassing =mysql_real_escape_string($cells);
				if ( $index == 21 ) $university =mysql_real_escape_string($cells);
				if ( $index == 22 ) $college =mysql_real_escape_string($cells);
				if ( $index == 23 ) $pover =mysql_real_escape_string($cells);
				if ( $index == 24 ) $pfirst =mysql_real_escape_string($cells);
				if ( $index == 25 ) $psecond =mysql_real_escape_string($cells);
				if ( $index == 26 ) $pthird =mysql_real_escape_string($cells);
				if ( $index == 27 ) $pfourth =mysql_real_escape_string($cells);
				if ( $index == 28 ) $phonors =mysql_real_escape_string($cells);
		  $index += 1;
		  }
	  
$mysqlQry="INSERT INTO `schools` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `fathername`, `dob`, `email`,`phone`, `mobile`, `landline`, `country`, `state`, `city`, `address1`, `address2`, `address3`, `pincode`, `course`, `yearofadmission`, `yearofpassing`, `university`, `college`, `totalpercent`, `firstyearpercent`, `secondyearpercent`, `thirdyearpercent`, `fourthyearpercent`, `honors`, `c_id`, `status`, `pdate`) VALUES (NULL, '$first', '$middle', '$last','$gender', '$fathername', '$dob', '$email', '$mobile', '$amobile',	'$landline',	'$country','$state','$city','$address1','$address2','$address3','$pincode','$course','$yaddmission','$ypassing','$university','$college','$pover','$pfirst','$psecond','$pthird','$pfourth','$phonors','$cid','1','$pdate');";
mysql_query($mysqlQry);
		  

          }
		  $first_row = false;
		  }
		  }
header("location:schools.php?uv=$uv&cl=$cid&msg=ins")	;	  
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
								<h4><i class="icon-reorder"></i>Add College Data </h4><span style="float:right;cursor:pointer;" onClick="window.location.href='dataparsing.php?id=<?php echo $cid; ?>'">Go Back</span>
							</div>
							<div class="widget-content">
								<p>
                             <?php 
							 if(!verifySchoolDataExists($clg)){
							 
							 ?>   
                                
                                
                                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                <form enctype="multipart/form-data"   action="" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
 
		  <?php if($msg!=''){ ?>
              <tr>
               
                <td  colspan="2" align="left"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php } ?>	
			
  <tr>
    <td  colspan="2" align="left"><h6><?php echo $university ?> : <h3><?php echo $college ?></h3></h6></td>
  </tr>
  <tr><td colspan="2">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
  
  <tr>
    <td width="13%" align="left">Upload College Data</td>
    <td width="22%" align="left"><div class="col-md-10">
											<input type="file"  name="sheet" id="file"><input type="hidden" name="cid" value="<?php echo $clg; ?>"><input type="hidden" name="unv" value="<?php echo $univ; ?>">
						</div></td>
    <td width="65%" align="left"><input type="submit" name="submit" class="btn" style="width:200px" value="Start Parsing &nbsp;&nbsp;&nbsp;  &raquo;"></td>
  </tr>
</table>

  
  </td></tr>
  </form>
  
</table>

                                <?php }else{ ?>
                                  <?php if($msg!=''){ ?>
             <div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div>
             <?php } ?>	
                                <?php 
								echo "(<b>".$college."</b>) Data is as below &darr; ";
								}
								?>
                                
                                </p>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> College Data</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table width="100%" class="table table-striped table-bordered table-hover  datatable">
									<thead>
										
                                        
                                         <tr >
    <th align="left" width="8%" class="verysmalltextblack">Sno</th>
    <th align="left"  width="19%"class="verysmalltextblack">Name</th>
	 <th align="left"  width="14%"class="verysmalltextblack">Father Name</th>
    <th align="center"  width="7%" class="verysmalltextblack">Course</th>

	 <th width="14%" align="left"  class="verysmalltextblack">Email</th>
	  <th align="left"  width="9%"class="verysmalltextblack">Contact</th>
      	  <th align="left"  width="10%"class="verysmalltextblack">% Overall</th>

      <th width="19%"  align="center" class="verysmalltextblack">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `schools` where `c_id`='$clg'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><div><?php echo stripslashes($fetch['firstname'])." ".stripslashes($fetch['middlename'])." ".stripslashes($fetch['lastname']); ?></div></td>
    <td  align="left" class="smallfonttext"><?php echo stripslashes($fetch['fathername']); ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['course']); ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($fetch['email']); ?></td>
    <td align="center"  ><?php echo stripslashes($fetch['phone']); ?></td>
    <td align="center"  ><?php echo stripslashes($fetch['totalpercent']); ?></td>
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="schools.php?did=<?php echo base64_encode($fetch['id']) ?>&id=<?php echo $cid; ?>&uv=<?php echo $univ; ?>&cl=<?php echo $clg; ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="editschooldata.php?id=<?php echo base64_encode($fetch['id']) ?>&uv=<?php echo $univ; ?>&cl=<?php echo $clg; ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','schools',30)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Records</td><td>No Records</td><td>No Records</td><td>No Records</td><td>No Records</td><td>No Records</td><td>No Records</td><td colspan="1" align="center" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td></tr>
  
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