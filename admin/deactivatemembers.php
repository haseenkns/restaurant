<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['aid'])&&$_GET['aid']!=''){	
	$memId=base64_decode($_GET['aid']);
	$userData=getMembersDetailById($memId);
	$memNames=getTabledataById("name","titles",$userData[2])." ".$userData[3]." ".$userData[4]." ".$userData[5];
	$memNumber=getMemberShipNumber($userData[1],$memId);
	$checkMember=checkCancelMember($memId);
	$complimentry=$userData[45];
	
	
}




	
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
	
	


if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;

		$doc=mysql_real_escape_string($_POST['doc']);
		$reason=mysql_real_escape_string($_POST['reason']);
		$amount=mysql_real_escape_string($_POST['amount']);
		$bname=mysql_real_escape_string($_POST['bname']);
		$bnumber=mysql_real_escape_string($_POST['bnumber']);
		$bdate=mysql_real_escape_string($_POST['bdate']);
		
		
		$pdate=date("d/m/Y");
		$ptime=date("h:i a");
		mysql_query("BEGIN");
		$updQry=mysql_query("Update `members` set `status`='2' where `id` ='$hidMemId'");
		
		
		if($updQry){
			$excQry=mysql_query("INSERT INTO `cancelmember` (`id`, `mem_id`, `doc`, `reason`, `amount`, `mode`, `bname`, `bdate`, `bnumber`, `pdate`, `ptime`, `postedby`,`approvedby`) VALUES (NULL, '$hidMemId', '$doc', '$reason', '$amount', '$mode', '$bname', '$bdate', '$bnumber', '$pdate', '$ptime', '$adminId','$consultants');");
		
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}
}
	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:cancelmember.php?msg=cns");					  
	}else{
		mysql_query("REVOKE");
		header("location:cancelmember.php?msg=cnf");	
	}
	
	
}






if(isset($_POST['update'])){
		extract($_POST);
		$flag=1;

		$doc=mysql_real_escape_string($_POST['doc']);
		$reason=mysql_real_escape_string($_POST['reason']);
		$amount=mysql_real_escape_string($_POST['amount']);
		$bname=mysql_real_escape_string($_POST['bname']);
		$bnumber=mysql_real_escape_string($_POST['bnumber']);
		$bdate=mysql_real_escape_string($_POST['bdate']);
		if($mode!=2){
			$bname="";
			$bnumber="";
			$bdate="";	
		}
		
		$pdate=date("d/m/Y");
		$ptime=date("h:i a");
		mysql_query("BEGIN");
		
		
		
		$excQry=mysql_query("UPDATE `cancelmember` SET `doc` = '$doc', `reason` = '$reason', `amount` = '$amount', `mode` = '$mode', `bname` = '$bname', `bdate` = '$bdate', `bnumber` = '$bnumber', `pdate` = '$pdate', `ptime` = '$ptime', `postedby` = '$adminId', `approvedby` = '$consultants' WHERE `cancelmember`.`id` = '$hidId';");
		
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}

	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:viewcancelledmembers.php?msg=cns");					  
	}else{
		mysql_query("REVOKE");
		header("location:viewcancelledmembers.php?msg=cnf");	
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
	
	
	 function showHideBankDiv(val){
		 //alert(val)
		//var mode=document.getElementById('mode').value
		if(val==2){
		document.getElementById('bankdetails').style.display='block'	
		}else{
		document.getElementById('bankdetails').style.display='none'	
		}
			
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
						<h3>Member - <?php echo $memNames; ?> ( <?php echo $memNumber; ?> ) <?php if($complimentry==1){ ?> - Complimentry Member <?php } ?>  </h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
<form action="" method="post" >
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
			 
			 
      <?php
	  if(!$checkMember){
	  ?>
   		<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Members Detail</h4>
							</div>
							<div class="widget-content">
							<div class="form-group">
										
										
											
										
									</div>
                                
                                <div class="form-group">
										
										
											<div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Request Recv. On</label>
													<input type="text" name="doc" id="doc" class="form-control datepicker" data-mask="99/99/9999">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Reason For Cancelation</label>
													<input type="text" name="reason" id="reason" class="form-control">
												</div>
												
											</div>
										
									</div>
                                     
                              		  <div class="form-group">
									<?php if($complimentry==0){ ?>	
										
											<div class="row">
                                                
												<div class="col-md-3">
                                                	<label class="control-label">Amount Refunded</label>
													<input type="text" name="amount" id="amount" class="form-control" >
                                                   
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Refund Mode</label>
													<select name="mode" id="mode" class="form-control" onChange="showHideBankDiv(this.value)" ><option value="0">Select Mode</option>
				<option value="1">Cash</option>
                <option value="2">Cheque</option>
               
                
                </select>
												</div>
												<div class="col-md-5">
                                                <div class="row" style="display:none;" id="bankdetails">
                                                
                                                
                                                
                                                
                                                 <div class="col-md-6">
                                                    <label class="control-label">Bank Name</label>
													<input  name="bname" id="bname" class="form-control input-width-large" >
												</div>
                                                 <div class="col-md-3">
                                                    <label class="control-label">Cheque Date</label>
													<input  name="bdate" id="bdate" class="form-control input-width-small datepicker" data-mask="99/99/9999" >
												</div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Cheque No.</label>
													<input  name="bnumber" id="bnumber"  class="form-control input-width-small">
												</div>
                                               </div> 
                                                </div>
												 
                            </div> 
                            <?php } ?>
                            
                            <div class="row" style="padding-top:30px;">
                                                
												<div class="col-md-3">
                                                	<label class="control-label">Approved By </label>
													<select name="consultants" id="consultants" class="form-control "  ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" <?php if($userData[30]==$fetch['id']) {?> selected <?php } ?> ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Programs</option>
					<?php } ?>
                
                </select>
                                                   
												</div>
												
												<div class="col-md-9">
                                                 
                                                </div>
												 
                            </div>
                                    
                                    <div class="row" style="padding-top:30px;">
										
										
                                        
                                           
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidMemId" value="<?php echo $memId; ?>"><input type="submit" name="submit" class="btn btn-primary btn-block" value=" Cancel Member"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="button" name="reset" class="btn  btn-block" value=" Go Back " onClick="window.location.href='cancelmember.php'"> 
                                           
 
 </div>
										
									</div>
											</div>
										
									</div>
                                      
                                
                                    
                                    
                                  
                                    
                                    
                                    
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
	 <?php }else{ 
	 $canMemArr=getCancellationDetailByMemId($memId); 
	  //print_r($canMemArr) ;
	 ?>
     
     <div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Members Detail</h4>
							</div>
							<div class="widget-content">
							<div class="form-group">
										
										
											
										
									</div>
                                
                                <div class="form-group">
										
										
											<div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Request Recv. On</label>
													<input type="text" name="doc" id="doc" class="form-control datepicker" value="<?php echo htmlentities(stripslashes($canMemArr[2])); ?>" data-mask="99/99/9999">
                                                    <span class="help-block">DD/MM/YYYY</span>
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Reason For Cancelation</label>
													<input type="text" name="reason" id="reason" class="form-control" value="<?php echo htmlentities(stripslashes($canMemArr[3])); ?>">
												</div>
												
											</div>
										
									</div>
                                     
                              		  <div class="form-group">
										
									<?php if($complimentry==0){ ?>		
											<div class="row">
                                                
												<div class="col-md-3">
                                                	<label class="control-label">Amount Refunded</label>
													<input type="text" name="amount" id="amount" class="form-control"  value="<?php echo htmlentities(stripslashes($canMemArr[4])); ?>">
                                                   
												</div>
												<div class="col-md-3">
                                                	<label class="control-label">Refund Mode</label>
													<select name="mode" id="mode" class="form-control" onChange="showHideBankDiv(this.value)" ><option value="0">Select Mode</option>
				<option value="1" <?php if($canMemArr[5]==1){ ?> selected <?php } ?>>Cash</option>
                <option value="2" <?php if($canMemArr[5]==2){ ?> selected <?php } ?>>Cheque</option>
             
                
                </select>
												</div>
												<div class="col-md-5">
                                                <div class="row" style="display:<?php if($canMemArr[5]==1){ ?>none<?php } ?>;" id="bankdetails">
                                                
                                                
                                                
                                                
                                                 <div class="col-md-6">
                                                    <label class="control-label">Bank Name</label>
													<input  name="bname" id="bname" class="form-control input-width-large" value="<?php echo htmlentities(stripslashes($canMemArr[6])); ?>" >
												</div>
                                                 <div class="col-md-3">
                                                    <label class="control-label">Cheque Date</label>
													<input  name="bdate" id="bdate" class="form-control input-width-small datepicker" data-mask="99/99/9999" value="<?php echo htmlentities(stripslashes($canMemArr[7])); ?>" >
												</div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Cheque No.</label>
													<input  name="bnumber" id="bnumber"  class="form-control input-width-small" value="<?php echo htmlentities(stripslashes($canMemArr[8])); ?>">
												</div>
                                               </div> 
                                                </div>
												 
                            </div> 
                            <?php } ?>
                            
                            <div class="row" style="padding-top:30px;">
                                                
												<div class="col-md-3">
                                                	<label class="control-label">Approved By </label>
													<select name="consultants" id="consultants" class="form-control "  ><option value="0">Select Consultant</option>
				<?php
					$execQry=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1' ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					 <option value="<?php echo $fetch['id'] ?>" <?php if($canMemArr[12]==$fetch['id']){ ?> selected <?php } ?>><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
					<?php }	}else{?>
					<option value="0">No Employee</option>
					<?php } ?>
                
                </select>
                                                   
												</div>
												
												<div class="col-md-9">
                                                 
                                                </div>
												 
                            </div>
                                    
                                    <div class="row" style="padding-top:30px;">
										
										
                                        
                                           
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidId" value="<?php echo $canMemArr[0]; ?>"><input type="submit" name="update" class="btn btn-primary btn-block" value=" Update Cancel Member"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="button" name="reset" class="btn  btn-block" value=" Go Back " onClick="window.location.href='viewcancelledmembers.php'"> 
                                           
 
 </div>
										
									</div>
											</div>
										
									</div>
                                      
                                
                                    
                                    
                                  
                                    
                                    
                                    
							</div>
						</div>
					</div>
     <?php } ?>			
                
                
                

     
     
  
            
            
        <!--<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Family Members</h4>
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
             <th width="10%"  data-hide="phone,tablet">Preview</th>
         
            <th width="40%"  data-hide="phone">Name</th>
            <th width="25%" data-hide="phone,tablet">Relation</th>
           
            <th width="15%"  data-hide="phone,tablet">Date Of Birth</th>
            <th width="15%" style="text-align:center"  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `familymembers` where `mem_id`='$memId' order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
	
		$name=getTabledataById("name","titles",$fetch['title'])." ".$fetch['fname']." ".$fetch['mname']." ".$fetch['lname'];
		
	
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewfamilymember.php?aid=<?php echo base64_encode( $fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
	
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
	<td align="left" class="smallfonttext"><?php echo getTabledataById("name","relations",$fetch['relation']) ?></td>
 
	<td align="center"  ><?php echo trim($fetch['dob']); ?></td>
    
    
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr>
	<td align="right" ><a href="familymembers.php?did=<?php echo base64_encode($fetch['id']) ?>&aid=<?php echo base64_encode($memId); ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn" type="button"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="familymembers.php?eid=<?php echo base64_encode($fetch['id']) ?>&aid=<?php echo base64_encode($memId); ?>"><button class="btn" type="button"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','familymembers',11)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td width="69">No Record</td></tr>
  
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
<!-- <script language="javascript" type="text/javascript" src="javascript/jquery1.4.js">   </script>
-->

</body>
</html>