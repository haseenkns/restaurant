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
		$title='Success !!';
		$class='successmsg';
		$content="Welcome mail has been send successfully.";
	break;
	
	case 'inf':
		$title='UnSuccess !!';
		$class='errormsg';
		$content="Due to some technical issues,mail not send successfully.Please try again later";
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
						<h3>Reservations</h3>
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
								<h4><i class="icon-reorder"></i> Make Reservations</h4>
							</div>
                            
                            <div class="row">
					<!--=== Example Box ===-->
					
							<div class="widget-content">
								<p>
                                
					                <div class="col-md-5">
								<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Table Reservations</h4>
							</div>
							<div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="tablereservationformembers.php">Click To Send Table Reservation</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            
                            <div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="viewtableconfirmations.php">View Table Reservation Status</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            <div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="#tablereservationformembers.php">Click To Send Table Confirmation</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            <div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="tableconfirmations.php">Cancel Table Reservations</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            
                            
                            
						</div>
                        
                                </div>
                                
                                
                             
                              
                                
					                <div class="col-md-5">
								<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Room Reservations</h4>
							</div>
							<div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="roomreservationformembers.php">Click To Send Room Reservation</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            
                            <div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="viewroomconfirmations.php">View Room Reservation Status</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            <div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="javascript:void(0)" onClick="alert('coming soon')">Click To Send Room Confirmation</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            <div class="widget-content">
								<div style="min-height:30px;" >
							
                        <a href="roomconfirmations.php">Cancel Room Reservations</a>
                        	
                        
                        
                        
                        </div>
							</div>
                            
                            
                            
                            
						</div>
                        
                                </div>
                                
                                
                             
                                
                             
                            
                            </p>
                              <div style="clear:both"></div>  
                                
							</div>
                            
                    
                       
							
                            
                       </div>
                       
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