<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
	
/*if(isset($_POST['submit'])){



	
}
	*/
	
	
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
	/*if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){
		$startDate=$_GET['start'];
		$endDate=$_GET['end'];
		
		$byMonth=date("m");	
		$bydate=date("d");	
	}else{
		$byMonth=date("m");	
		$bydate=date("d");	
		
	}*/
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>
	<script>
    function seachByDate(start,end){
    window.location.href="bdays.php?start="+start+"&end="+end;	
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
				<?php
				
				    if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
						$startdate=$_GET['start'];
						$enddate=$_GET['end'];
						$bdayArr=getBdayByRange($startdate,$enddate);
						$annvArr=getAnnvByRange($startdate,$enddate);
						$search=1;
					}else{
						$bdayArr=getBday(date("m"),date("d"));
						$annvArr=getAnnv(date("m"),date("d"));
						$search=0;
					}
                ?>
				<!--=== Page Header ===-->
				<div class="page-header">
					
                    
                    <div class="page-title">
						<h3>Birthday & Anniversary  </h3>
						<span style="color:#930;letter-spacing:1px;"><?php if($search==1){ echo "From ( ".$startdate." -- ".$enddate." )"; } ?></span>
					</div>
                    <form action="" method="post">
                   <div class="col-md-5" style="float:right;margin-top:35px;text-align:right;">
                   <div class="row">
                   <div class="col-md-1" style="padding-top:6px;">Start</div>
                   <div class="col-md-3"><input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control datepicker" style="border-radius:5px;"></div>
                   <div class="col-md-1"  style="padding-top:6px;">Upto&nbsp;&nbsp;</div>
                   <div class="col-md-3"><input type="text" name="enddate" id="enddate" placeholder="End Date" class="form-control datepicker"  style="border-radius:5px;"></div>
                    <div class="col-md-2"><button type="button"  name="submit" value=" Search "class="btn"  onClick="seachByDate(document.getElementById('startdate').value,document.getElementById('enddate').value)">Search</button></div>
                   </div>
                   
                   
                   </div>
                   </form>
					<!-- Page Stats -->
					
					<!-- /Page Stats -->
                    
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-user"></i> Birthdays</h4>
                                
							</div>
							<div class="widget-content">
								<p>
          
           <?php
			if(!$bdayArr[0]==0){
			?>
            
				<div class="col-md-12">
					<?php
					$bdaycount=0;
					foreach($bdayArr as $bdayId){
					$bdaycount++;	
					$memArr=getMembersDetailById($bdayId);	
					$memName=getTabledataById("name","titles",$memArr[2])." ".$memArr[3]." ".$memArr[4]." ".$memArr[5];
					$contacts=$memArr[8];
					if(!$memArr[9]==''){
						$contacts=	$memArr[8]." , ".$memArr[9];
					}
					$email=$memArr[7];
					if($email==''){
					$email="Not Mentioned";	
					}
					
					
					$encId=base64_encode($bdayId);
					
					 ?>
                        <div class="row">
                        <div class="col-md-3"><img src="photos/<?php echo $memArr[20]; ?>" alt="" style="border-radius:10px;" /></div>
                        <div class="col-md-9">
                        
                        <div class="row">
                        <div class="col-md-12" style="color:#016296;"><?php echo $memName; ?></div>
                        
                        </div>
                        <div class="row"><hr/></div>
                        <div class="row">
                        
                        <div class="col-md-12"><i class="icon-phone"></i><span class="text" style="font-size:12px;color:#818181;">&nbsp; <?php echo $contacts; ?></span>&nbsp;&nbsp;
                        <i class="icon-twitter"></i><span class="text" style="font-size:12px;color:#818181;">&nbsp; <?php echo $email; ?></span>
                        </div>
                        </div>
                        
                        </div>
                        
                        </div>
                        <div class="row"><hr/></div>
                        
                    <?php } ?>    
						
                        
                       
					
				</div>
                
             <?php }else{ ?>
             <div class="col-md-12">No Birthday </div>
             <?php } ?> 
                                
                                
                                </p>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
                    
                    <div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-bell"></i> Wedding Anniversaries</h4>
							</div>
							<div class="widget-content">
								<p>
                                 <?php
			if(!$annvArr[0]==0){
			?>
            
				<div class="col-md-12">
					<?php
					$bdaycount=0;
					foreach($annvArr as $annvId){
					$bdaycount++;	
					$memArr=getMembersDetailById($annvId);	
					$memName=getTabledataById("name","titles",$memArr[2])." ".$memArr[3]." ".$memArr[4]." ".$memArr[5];
					$contacts=$memArr[8];
					if(!$memArr[9]==''){
						$contacts=	$memArr[8]." , ".$memArr[9];
					}
					$email=$memArr[7];
					if($email==''){
					$email="Not Mentioned";	
					}
					
					
					$encId=base64_encode($annvId);
					
					 ?>
                        <div class="row">
                        <div class="col-md-3"><img src="photos/<?php echo $memArr[20]; ?>" alt="" style="border-radius:10px;" /></div>
                        <div class="col-md-9">
                        
                        <div class="row">
                        <div class="col-md-12" style="color:#016296;"><?php echo $memName; ?></div>
                        
                        </div>
                        <div class="row"><hr/></div>
                        <div class="row">
                        
                        <div class="col-md-12"><i class="icon-phone"></i><span class="text" style="font-size:12px;color:#818181;">&nbsp; <?php echo $contacts; ?></span>&nbsp;&nbsp;
                        <i class="icon-twitter"></i><span class="text" style="font-size:12px;color:#818181;">&nbsp; <?php echo $email; ?></span>
                        </div>
                        </div>
                        
                        </div>
                        
                        </div>
                        <div class="row"><hr/></div>
                        
                    <?php } ?>    
						
                        
                       
					
				</div>
                
             <?php }else{ ?>
               <div class="col-md-12">No Wedding Anniversary</div>
             <?php } ?> 
                               
                                
                                
                                </p>
							</div>
						</div>
					</div>
					<!-- /Example Box -->
				</div>
			</div>
			<!-- /.container -->

		</div>
	</div>
   

</body>
</html>