<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");



if(isset($_GET['pg'])&&$_GET['pg']!=''){	
		$pg=$_GET['pg'];
		$pendingMembersIds=getPendingEmbossingIdsByPid($pg);	

	}else{
		$pg=0;	
		$pendingMembersIds=getPendingEmbossingIds();	
}

	


$pgText=getProgramNameById($pg);

if(count($pendingMembersIds)==0){
	$memids='0';	
}else{

$memids=implode(",",$pendingMembersIds);	
}



if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Embossing List Data Created Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Embossing List Data Not Created Successfully !!';
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
	
	
	
	
	
	





if(isset($_GET['id'])&&$_GET['id']!=''){
	$id=$_GET['id'];
	$pdate=date("d/m/Y");
	$ptime=date("h:i a");
	
	$excQry=mysql_query("INSERT INTO `embossinglist` (`id`, `mem_id`, `pdate`, `ptime`, `status`, `postedby`) VALUES (NULL, '$id', '$pdate', '$ptime', '1', '$adminId');");
	if($excQry){
		header("location:embossinglistreport.php?msg=ins");	
	}else{
		header("location:embossinglistreport.php?msg=inf");		
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
    <script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    
    <script>
    function seachEmbByDate(start,end){
    window.location.href="generatedembossinglistreport.php?start="+start+"&end="+end;	
    }
	
	function sortByProg(val){
		if(val==0){
			window.location.href="embossinglistreport.php";
	    }else{
			window.location.href="embossinglistreport.php?pg="+val;	
		}
	}
	
    </script>
    <script>
    function cardmsg(id){
		//alert(id)
		swal({
		title: "Embossing Card",
		text: "Generated",
		type: "warning",
		confirmButtonText: "Yes",
			showCancelButton: true,
 		confirmButtonColor: "#DD6B55"
		},function(){
			window.location.href='embossinglistreport.php?id='+id
		});
			//return false;
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
						<h3>Embossing list</h3>
						
					</div>
<!--<form action="" method="post">
                   <div class="col-md-8" style="float:right;margin-top:35px;text-align:right;">
                   <div class="row">
                   <div class="col-md-4" style="padding-top:6px;">Search Generated List</div>
                   <div class="col-md-2"><input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control datepicker" style="border-radius:5px;"></div>
                   <div class="col-md-1"  style="padding-top:6px;">Upto&nbsp;&nbsp;</div>
                   <div class="col-md-2"><input type="text" name="enddate" id="enddate" placeholder="End Date" class="form-control datepicker"  style="border-radius:5px;"></div>
                    <div class="col-md-2"><button type="button"  name="submit" value=" Search "class="btn"  onClick="seachEmbByDate(document.getElementById('startdate').value,document.getElementById('enddate').value)">Search</button></div>
                   </div>
                   
                   
                   </div>
                   </form>-->
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
								<h4><i class="icon-reorder"></i> Embossing Pending</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
                                    <div style="float:left;padding-top:5px;width:290px;" >
                                        <div class="row">
                                        <div class="col-md-2">Search</div>
                                        <div class="col-md-4"><select name="program" id="program" class="form-control input-width-large" onChange="sortByProg(this.value)" ><option value="0">Select Program</option>
                                        <option value="0">All Program</option>
				<?php
					$execQry=mysql_query("select * from `programs` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($pg==$fetch['id']){ ?> selected <?php } ?>><?php echo stripslashes($fetch['pname']) ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select></div>
                						
                						
                                        </div>
                                        
                                        
                                         </div>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
                                            <th width="3%" >Sno</th>
                                            <th width="8%"  data-hide="phone">Date</th>
                                            <th width="8%" data-hide="phone,tablet" style="text-align:left;">Card no</th>
                                            <th width="12%">Card Type</th>
                                            <th width="34%"  data-hide="phone">Member Name (Spouse name,if required)</th>
                                            <th width="8%"  data-hide="phone,tablet" > Expiry</th>
                                            <th width="10%">Spouse Card</th>
                                            <th width="5%"  data-hide="phone">Status</th>
 										 </tr>
									</thead>
									<tbody>
										<?php 
									//echo "select * from `members` where `id` IN ($memids) order by `id` Desc";
										
  	$sqlQry=mysql_query("select * from `members` where `id` IN ($memids) order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$id=$fetch['id'];
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
            <td align="left" class="smallfonttext" ><?php echo getMemberMonthYear($fetch['createdon']); ?></td>
            <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
            <td align="left" class="smallfonttext" ><?php echo getMemberCardType($id); ?></td>
            <td align="left" class="smallfonttext"><?php echo getMemberNameByCardType($id); ?></td>
            <td align="center"  ><?php echo getMemberExpiry($id); ?></td>
            <td align="center"  ><?php echo getMemberSpouseCheck($id); ?></td>
       
            <td align="left" class="smallfonttext"><span class="label label-success" style="cursor:pointer;" onClick="cardmsg('<?php echo $id ?>')">To Be Embossed</span></td>
        
            
  </tr>
  <?php }}else{?>
  <tr style="background:#FFF;"><td></td><td></td><td></td><td></td><td>No Pending Record</td><td></td><td></td><td></td></tr>
  
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


</body>
</html>