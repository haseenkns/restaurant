<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

$monthArr=array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Data inserted Successfully !!';
		$class='successmsg';
	break;
	
	case 'inf':
		$msg='Data not inserted Successfully !!';
		$class='errormsg';
	break;
	case 'ups':
		$msg='Data updated Successfully !!';
		$class='successmsg';
	break;
	
	case 'upf':
		$msg='Data not updated Successfully !!';
		$class='errormsg';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='successmsg';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='errormsg';
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
        <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script>
  
    function errorMsg(msg){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			//setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
		
    </script>
	<script>
     function redirectToSalary(month,year){
		// alert(month)
		 //alert(year)
		 if(month==0){
			 errorMsg("Please select a month");
			 return false
		 }
		 if(year==0){
			 errorMsg("Please select a year");
			 return false;
			 
		 }
     window.location.href='employeesalary.php?month='+month+'&year='+year    
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
						<h3>Salary Management</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Choose Month</h4>
							</div>
							<div class="widget-content">
								<p>
                                <div class="row">
                                <div class="col-md-12">
                                 <select class="form-control" name="month" id="month"><option value="0">Salary Month</option>
									<?php
                                    foreach($monthArr as $month=>$value){
										$month=$month+1;
										?>
                                         
                                        <option style="padding:4px;color:#000;font-weight:bold;font-size:14px;" value="<?php echo $month; ?>"><?php echo $value; ?></option>
                                        
                                    <?php }?>
                                </select>
                                
                                </div>
                                
                                </div>
                                
                                </p>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
                    
                    <div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Choose Year</h4>
							</div>
							<div class="widget-content">
								<p><div class="row">
                                <div class="col-md-12">
                                <select class="form-control"  name="year" id="year"><option value="0">Salary Year</option>
									<?php
                                    for($year=date("Y");$year>=2012;$year--){?>
                                        
                                        <option style="padding:6px;color:#000;font-weight:bold;font-size:16px;" value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        
                                    <?php }?>
                                </select>
                              
                                </div>
                                
                                </div></p>
							</div>
						</div>
					</div>
					<!-- /Example Box -->
				</div>
                
              <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							
							<div class="widget-content">
								<p>
                                <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                 <input type="button" name="submit" onClick="redirectToSalary(document.getElementById('month').value,document.getElementById('year').value)" value=" Submit " class="btn btn-lg btn-success" style="width:250px;text-align:center">
                                
                                </div>
                                
                                </div>
                                
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