<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");

$startdate=$_GET['start'];
$enddate=$_GET['end'];
$search=1;

$embids=getGeneratedEmbossingIdsByDate($startdate,$enddate);	

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
	$pdate=date("m-d-Y");
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
						<span style="color:#930;letter-spacing:1px;"><?php if($search==1){ echo "From ( ".$startdate." -- ".$enddate." )"; } ?></span>
					</div>
<form action="" method="post">
                   <div class="col-md-8" style="float:right;margin-top:35px;text-align:right;">
                   <div class="row">
                   <div class="col-md-4" style="padding-top:6px;">Search Generated List</div>
                   <div class="col-md-2"><input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control datepicker" style="border-radius:5px;" value="<?php echo $startdate; ?>"></div>
                   <div class="col-md-1"  style="padding-top:6px;">Upto&nbsp;&nbsp;</div>
                   <div class="col-md-2"><input type="text" name="enddate" id="enddate" placeholder="End Date" class="form-control datepicker"  style="border-radius:5px;" value="<?php echo $enddate; ?>"> </div>
                    <div class="col-md-2"><button type="button"  name="submit" value=" Search "class="btn"  onClick="seachEmbByDate(document.getElementById('startdate').value,document.getElementById('enddate').value)">Search</button></div>
                   </div>
                   
                   
                   </div>
                   </form>
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
								<h4><i class="icon-reorder"></i> Embossing List Generated</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
                                            <th width="7%" >Sno</th>
                                           
                                            <th width="15%" data-hide="phone,tablet" style="text-align:left;">Member No</th>
                                               <th width="24%" data-hide="phone,tablet" style="text-align:left;">Member Name</th>
                                            <th width="22%">Program</th>
                                            <th width="18%"  data-hide="phone">Created Date</th>
                                            <th width="14%"  data-hide="phone,tablet" > Created Time</th>
                                            
                                           
                                        
 										 </tr>
									</thead>
									<tbody>
										<?php 
									//echo "select * from `members` where `id` IN ($memids) order by `id` Desc";
    if(count($embids)>0){
	foreach($embids as $eid ){
		$embDetail=getEmbossingListDetailsById($eid);
		$i++;
		$mem_id=$embDetail[1];
		$memDetail=getMembersDetailById($mem_id);
		$progId=$memDetail[1];
		$progDetail=getProgramDescriptionById($progId);
			$progName=$progDetail[1];
			$memberstart=$progDetail[8];
			$preffix=$progDetail[10];
			$suffix=$progDetail[11];
			$memId=(int)$memberstart + $fetch['id'];
			$memNumber=$preffix."".$memId."".$suffix;
		    $name=getTabledataById("name","titles",$memDetail[2])." ".$memDetail[3]." ".$memDetail[4]." ".$memDetail[5];
  ?>
  <tr bgcolor="#FFFFFF">
            <td align="center" class="smalltext"><?php echo $i; ?></td>
           
            <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
            <td align="left" class="smallfonttext"><?php echo $name; ?></td>
            <td align="left" class="smallfonttext" ><?php echo $progName; ?></td>
            <td align="left" class="smallfonttext"><?php echo $embDetail[2]; ?></td>
            <td align="center"  ><?php echo $embDetail[3]; ?></td>
          
        
            
  </tr>
  <?php }}else{?>
  <tr style="background:#FFF;"><td></td><td></td><td>No  Record</td><td></td><td></td><td></td></tr>
  
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