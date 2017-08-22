<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");
$pendingMembersIds=getPendingMembersId();	

//print_r($pendingMembersIds);
$memids=implode(",",$pendingMembersIds);	
	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Member has been  added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Member not added Successfully !!';
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
	
	





if(isset($_GET['eid'])&&$_GET['eid']!=''){
	$eid=base64_decode($_GET['eid']);
	$edtQry=mysql_query("Select * from `members` where `id`='$eid'");
	$userData=mysql_fetch_row($edtQry);	
	$progId=$userData[1];
	$mlevel=$userData[28];
	$membershipNumber=getMemberShipNumber($progId,$eid);
	
	
	//$paymentStats=mysql_fetch_row(mysql_query("Select * from `paymentstats` where `mode`='$eid'"));
	//print_r($userData);
	//die;
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
	
    function showHideDiv(id){
		var count=document.getElementById('hidTotal').value
		for(i=1;i<=count;i++){
		document.getElementById('podiv'+i).style.display='none'	
		}
		document.getElementById('podiv'+id).style.display='block'	
			
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			document.getElementById(id).focus();	
			alert(id)
		});
			//return false;
		}
		
    </script>
    
    <script type="text/javascript" language="JavaScript">

		
		
function ValidateMember()
	{
		
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	var numbers = /^[0-9]+$/;
	
	
	if(document.getElementById('program').value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Select a program name','program')
		return false;
		}

		
	
	if(document.getElementById('title').value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please select a title','title')
		return false;
		}

	if(document.getElementById('fname').value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please enter first name','fname')
		return false;
		}
	
	
	if(document.getElementById('amount').value=="")
		{
		errorMsg('Please enter a amount','amount')
		return false;
	}

	if(!document.getElementById('amount').value.match(numbers))
		{
			errorMsg('Only numerical digits (0-9) is allowed','amount');
			return false;
	    }
		
	
	

}
  function setFocus(val){
		document.getElementById(val).focus();	
		alert('dasd')
	}
</script>
    
    <style>
	#display{
	border:dotted 1px #F0F0F0;
	position:absolute;
	min-width:237px;
	z-index:9999;
	
	}
	#display ul
{
	list-style: none;
	margin: 0px;
	padding:0px;
	width: auto;
	max-height:150px;
	overflow:auto;
	z-index:9999;
}
#display li
{
display: block;
padding: 3px;
background-color: #4C9ED9;
z-index:9999;
color:#FFF;
}
	</style>
    <script type="text/javascript">
function fill(Value,id) 
{	
//alert(id)	
$('#city').val(Value); 
$('#hidCity').val(id);
$('#display').hide();
}

$(document).ready(function(){ 
$("#city").keyup(function() {
$('#hidCity').val(0);
        var state = $('#state').val();
		 var cname = $('#city').val();
		
		if(state=="" || state=="0")
		{
			alert("Please select a state ")
			$("#display").html("");
			$('#city').val(""); 
		}
		else
		{
		$.ajax({  
                type: "POST",  
                url: "cities.php",  
                data: "sid="+ state+"&cname="+cname ,  
                success: function(html){  
                    $("#display").html(html).show();
                }  
            });
		}
});
});
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
						<h3>Welcome Mail</h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
<form action="" method="post" enctype="multipart/form-data" onSubmit="return ValidateMember()">

			 
			 
  
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Welcome Mail Pending</h4>
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
            <th width="5%" >Sno</th>
             <th width="20%"  data-hide="phone">Program</th>
              <th width="15%" data-hide="phone,tablet" style="text-align:left;">Membership Date</th>
             <th width="15%">Membership Id</th>
            
            <th width="30%"  data-hide="phone">Member Name</th>
           
              <th width="5%"  data-hide="phone">Status</th>
        
             <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Send Mail</th>
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
	//echo "select * from `members` where `id` IN ('$memids') order by `id` Desc";									
  	$sqlQry=mysql_query("select * from `members` where `id` IN ($memids) order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
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
     
	 <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
     <td align="left" class="smallfonttext" ><?php echo trim($fetch['createdon']); ?></td>
     <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
   
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
	<td align="left" class="smallfonttext">Pending</td>
 
	
    <td align="center"  ><a href="sendwelcomemail.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  >
    <?php if(checkMailSent($fetch['id'])){ ?><img src="images/welcomes.png"><?php }else{ ?><img src="images/welcome.png"><?php } ?>
    </a></td>
    
    
  </tr>
  <?php }}else{?>
  <tr style="background:#FFF;"><td></td><td></td><td></td><td>No Pending Record</td><td></td><td></td><td></td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>    
            
           <!--<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Welcome Mail Sent</h4>
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
            <th width="5%" >Sno</th>
             <th width="25%">Membership Id</th>
             <th width="20%"  data-hide="phone">Program</th>
            <th width="30%"  data-hide="phone">Name</th>
            <th width="10%" data-hide="phone,tablet" style="text-align:center;">Amount</th>
           
        
             <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Mail</th>
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `members` order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
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
     
	
    <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
	<td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($fetch['amount']); ?></td>
 
	
    <td align="center"  ><a href="sendwelcomemail.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  >
    <?php if(checkMailSent($fetch['id'])){ ?><img src="images/welcomes.png"><?php }else{ ?><img src="images/welcome.png"><?php } ?>
    </a></td>
    
    
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>--> 
			<!-- /.container -->
</form>
		</div>
	</div>


</body>
</html>