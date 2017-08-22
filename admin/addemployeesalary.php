<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");

checkIntrusion($adminId);

if(isset($_GET['id'])&&$_GET['id']!=''){	
	$memId=$_GET['id'];
	$empData=getEmployeeDetailsById($memId);
	$empName=$empData[8]." ".$empData[9];
	$month=$_GET['month'];
	$monthName = getMonth($month-1);
	$year=$_GET['year'];
	$checkSalaryExists=checkEmpSalaryExistsById($memId,$month,$year);
	$taxrate=getTDS();
	
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
		$ifeedback=mysql_real_escape_string($_POST['ifeedback']);
		$afeedback=mysql_real_escape_string($_POST['afeedback']);
		$bfeedback=mysql_real_escape_string($_POST['bfeedback']);
		$mfeedback=mysql_real_escape_string($_POST['mfeedback']);
		
		$pdate=date("d/m/Y");
		mysql_query("BEGIN");
		
		$excQry=mysql_query("INSERT INTO `empsalary` (`id`, `empId`, `fullday`, `halfday`, `incentive`, `bonus`, `advance`, `mode`, `ifeedback`, `bfeedback`, `afeedback`, `mfeedback`, `status`, `pdate`, `postedby`,`month`,`year`,`salary`,`salarytype`,`hra`,`medical`,`conveyance`,`taxable`,`noofhours`,`taxrate`) VALUES (NULL, '$hidMemId', '$fullabsent', '$halfabsent', '$incentive', '$bonus', '$advance', '$mode', '$ifeedback', '$bfeedback', '$afeedback', '$mfeedback', '1', '$pdate', '$adminId','$hidMonth','$hidYear','$hidSalary','$hidSalaryType','$hidHra','$hidMedical','$hidConveyance','$hidTaxable','$hours','$taxrate');");
		
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}

	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:employeesalary.php?msg=sas&month=$hidMonth&year=$hidYear");					  
	}else{
		mysql_query("REVOKE");
		header("location:employeesalary.php?msg=saf&month=$hidMonth&year=$hidYear");	
	}
	
	
}


if(isset($_POST['update'])){
		extract($_POST);
		$flag=1;
		$ifeedback=mysql_real_escape_string($_POST['ifeedback']);
		$afeedback=mysql_real_escape_string($_POST['afeedback']);
		$bfeedback=mysql_real_escape_string($_POST['bfeedback']);
		$mfeedback=mysql_real_escape_string($_POST['mfeedback']);
		
		$pdate=date("d/m/Y");
		mysql_query("BEGIN");
		
		$excQry=mysql_query("UPDATE `empsalary` SET `fullday` = '$fullabsent', `halfday` = '$halfabsent', `incentive` = '$incentive', `bonus` = '$bonus', `advance` = '$advance', `mode` = '$mode', `ifeedback` = '$ifeedback', `bfeedback` = '$bfeedback', `afeedback` = '$afeedback', `mfeedback` = '$mfeedback' ,`noofhours`='$hours' WHERE `empsalary`.`id` = '$hidId';");
		
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}

	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:employeesalary.php?msg=sus&month=$hidMonth&year=$hidYear");					  
	}else{
		mysql_query("REVOKE");
		header("location:employeesalary.php?msg=suf&month=$hidMonth&year=$hidYear");	
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
						<h3>Salary Details - <?php echo $empName; ?>  ( <strong style="color:#51A351;font-weight:normal;"><?php echo $monthName; ?> , <?php echo $year; ?> </strong> )  </h3>
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
			 
			 
  
     
   				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Members Detail</h4>
							</div>
							<div class="widget-content">
							<div class="form-group">
										
									<div class="row">
                                           
												<div class="col-md-1">
                                                	<label class="control-label">Emp-Id</label>
													<b><?php echo getCode($memId); ?></b>
                                                   
												</div>
												<div class="col-md-2">
                                                <label class="control-label">Designation</label><br/>
													<?php echo getTabledataById("name",'designations',$empData[11]); ?>
												</div>
                                                 <div class="col-md-2">
                                                <label class="control-label">Bank Name</label><br/>
													<div><?php echo stripslashes($empData[22]); ?></div>
												</div>
                                                  <div class="col-md-2">
                                                <label class="control-label">Account No.</label><br/>
													<div><?php echo stripslashes($empData[21]); ?></div>
												</div>
                                                <div class="col-md-1">
                                                <label class="control-label">Pan No.</label><br/>
													<div><?php echo stripslashes($empData[23]); ?></div>
												</div>
                                                
                                                
                                                
                                                <div class="col-md-1">
                                                <label class="control-label">Salary</label><br/>
													<?php echo stripslashes($empData[14]); ?>
												</div>
                                                <div class="col-md-1">
                                                <label class="control-label">Medical</label><br/>
													<?php echo stripslashes($empData[26]); ?>
												</div>
                                                <div class="col-md-1">
                                                <label class="control-label">HRA</label><br/>
													<?php echo stripslashes($empData[25]); ?>
												</div>
                                                <div class="col-md-1">
                                                <label class="control-label">Conyance</label><br/>
													<?php echo stripslashes($empData[27]); ?>
												</div>
                                               
                                                
												
											</div>	
											
										
									</div>
                                <div class="row"><hr/></div>
                                <?php
								if(!$checkSalaryExists){
								?>
                                
                                      <div class="form-group">
										
										
											
                                          <?php
										  if($empData[24]==1){
										  ?>  
                                            <div class="row">
                                           
												<div class="col-md-1">
                                                	<label class="control-label">Full Day Absent</label>
													<input type="text" name="fullabsent" id="fullabsent" onkeyup="return isNumberAndFillDays(event)" class="form-control" value="0">
                                                    
												</div>
                                                <div class="col-md-1">
                                                	<label class="control-label">Half Day Absent</label>
													<input type="text" name="halfabsent" id="halfabsent" onkeyup="return isNumberAndFillDays(event)" class="form-control" value="0">
                                                    
												</div>
                                                
												<div class="col-md-6">
                                                <label class="control-label">Total Days Absent(Full) </label><br/><br/>
                                                <span id="totalabs">0</span> Days
												</div>
												
											</div>
                                            <?php }elseif($empData[24]==2){ ?>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Total Hours Spent</label>
													<input type="text" name="hours" id="hours" onkeyup="return isNumberevent)" class="form-control" value="0">
                                                    
												</div>
                                                
												
											</div>
                                           <?php } ?>
                                            
                                            
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Incentive Received</label>
													<input type="text" name="incentive" id="incentive" onkeypress="return isNumber(event)" class="form-control" >
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedbacks</label>
													<input type="text" name="ifeedback" id="ifeedback" class="form-control">
												</div>
												
											</div>
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Monthly Bonus Received</label>
													<input type="text" name="bonus" id="bonus" onkeypress="return isNumber(event)" class="form-control" >
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedbacks</label>
													<input type="text" name="bfeedback" id="bfeedback" class="form-control">
												</div>
												
											</div>
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Advance Paid(if any)</label>
													<input type="text" name="advance" id="advance" onkeypress="return isNumber(event)" class="form-control" >
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedback</label>
													<input type="text" name="afeedback" id="afeedback" class="form-control">
												</div>
												
											</div>
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Payment Mode</label>
													<select  class="form-control" name="mode">
                                                    <option value="0">Select payment Mode</option>
                                                    <?php
														$execQry=mysql_query("select * from `paymentmodes` where `status` = '1' order by `id` ");
														$numRows=mysql_num_rows($execQry);
														if($numRows>0){
														while($fetch=mysql_fetch_array($execQry)){?>
														  <option value="<?php echo $fetch['id']; ?>"><?php echo $fetch['name'] ?></option>
														<?php }}else{?>
														  <option value="0">No Mode Defined</option>
														<?php }?>
                                                  
                                                    
                                                    </select>
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedback</label>
													<input type="text" name="mfeedback" id="mfeedback" class="form-control">
												</div>
												
											</div>
										
									</div>
                                	  <div class="form-group">
										
										
											 
                                    
                                    <div class="row" style="padding-top:30px;">
										
										
                                        
                                           
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidMemId" value="<?php echo $memId; ?>">
                                           <input type="hidden" name="hidMonth" value="<?php echo $month; ?>">
                                           <input type="hidden" name="hidYear" value="<?php echo $year; ?>">
                                            <input type="hidden" name="hidSalary" value="<?php echo $empData[14]; ?>">
                                             <input type="hidden" name="hidSalaryType" value="<?php echo $empData[24]; ?>">
                                             
                                             <input type="hidden" name="hidMedical" value="<?php echo $empData[26]; ?>">
                                             <input type="hidden" name="hidHra" value="<?php echo $empData[25]; ?>">
                                             
                                             <input type="hidden" name="hidConveyance" value="<?php echo $empData[27]; ?>">
                                             
                                              <input type="hidden" name="hidTaxable" value="<?php echo $empData[28]; ?>">
                                              
                                              <input type="hidden" name="hidTaxrate" value="<?php echo $taxrate; ?>">
                                             
                                           
                                           <input type="submit" name="submit" class="btn btn-primary btn-block" value=" Add Salary"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="button" name="reset" class="btn  btn-block" value=" Go Back " onClick="window.location.href='employeesalary.php?month=<?php echo $month  ?>&year=<?php echo $year;  ?>'"> 
                                           
 
 </div>
										
									</div>
											</div>
								<?php }else{ 
								$empSalary=getEmpSalaryById($memId,$month,$year);
								$salaryId=$empSalary[0];
								?>
                                      <div class="form-group">
                                          <?php
										  	if($empData[24]==1){
										  ?> 
										
											<div class="row">
                                           
												<div class="col-md-1">
                                                	<label class="control-label">Full Day Absent</label>
													<input type="text" name="fullabsent" id="fullabsent" onkeyup="return isNumberAndFillDays(event)" class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[2]))  ?>">
                                                    
												</div>
                                                <div class="col-md-1">
                                                	<label class="control-label">Half Day Absent</label>
													<input type="text" name="halfabsent" id="halfabsent" onkeyup="return isNumberAndFillDays(event)" class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[3]))  ?>">
                                                    
												</div>
                                                
												<div class="col-md-6">
                                                <label class="control-label">Total Days Absent </label>
                                                (Full)<br/><br/>
                                                <span id="totalabs"><b style="color:#069;"><?php echo getTotalAbsentDays($empSalary[2],$empSalary[3]) ?></b></span> Days
												</div>
												
											</div>
                                            <?php }elseif($empData[24]==2){ ?>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Total Hours Spent</label>
													<input type="text" name="hours" id="hours" value="<?php echo htmlentities(stripslashes($empSalary[23]))  ?>" id="hours" onkeyup="return isNumber(event)" class="form-control" >
                                                    
												</div>
                                                <div class="col-md-6">
                                                	<label class="control-labels" style="padding-top:20px;">Update Number of hours worked </label>
													
                                                    
												</div>
                                                
												
											</div>
                                            <?php } ?>
                                            
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Incentive Received</label>
													<input type="text" name="incentive" id="incentive"  onkeypress="return isNumber(event)" class="form-control"  value="<?php echo htmlentities(stripslashes($empSalary[4]))  ?>">
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedbacks</label>
													<input type="text" name="ifeedback" id="ifeedback"  class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[8]))  ?>">
												</div>
												
											</div>
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Monthly Bonus Received</label>
													<input type="text" name="bonus" id="bonus" onkeypress="return isNumber(event)" class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[5]))  ?>">
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedbacks</label>
													<input type="text" name="bfeedback" id="bfeedback" class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[11]))  ?>">
												</div>
												
											</div>
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Advance Paid(if any)</label>
													<input type="text" name="advance" onkeypress="return isNumber(event)" id="advance" class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[6]))  ?>"> 
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedback</label>
													<input type="text" name="afeedback" id="afeedback" class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[10]))  ?>">
												</div>
												
											</div>
                                            <div class="row"><hr/></div>
                                            <div class="row">
                                           
												<div class="col-md-3">
                                                	<label class="control-label">Payment Mode</label>
													<select  class="form-control" name="mode">
                                                    <option value="0">Select payment Mode</option>
                                                    <?php
														$execQry=mysql_query("select * from `paymentmodes` where `status` = '1' order by `id` ");
														$numRows=mysql_num_rows($execQry);
														if($numRows>0){
														while($fetch=mysql_fetch_array($execQry)){?>
														  <option value="<?php echo $fetch['id']; ?>" <?php if($empSalary[7]==$fetch['id']) {?> selected <?php } ?>><?php echo $fetch['name'] ?></option>
														<?php }}else{?>
														  <option value="0">No Mode Defined</option>
														<?php }?>
                                                  
                                                    
                                                    </select>
                                                    
												</div>
												<div class="col-md-8">
                                                <label class="control-label">Feedback</label>
													<input type="text" name="mfeedback" id="mfeedback" class="form-control" value="<?php echo htmlentities(stripslashes($empSalary[11]))  ?>">
												</div>
												
											</div>
										
									</div>
                                	  <div class="form-group">
										
										
											 
                                    
                                    <div class="row" style="padding-top:30px;">
										
										
                                        
                                           
                                            <div class="col-md-3" align="left">
                                           <input type="hidden" name="hidMemId" value="<?php echo $memId; ?>">
                                           <input type="hidden" name="hidMonth" value="<?php echo $month; ?>">
                                           <input type="hidden" name="hidYear" value="<?php echo $year; ?>">
                                           <input type="hidden" name="hidId" value="<?php echo $salaryId; ?>">
                                           
                                           <input type="submit" name="update" class="btn btn-primary btn-block" value=" Update Salary"> 
                                           
 
 </div>
                                            <div class="col-md-3" align="left">
                                           <input type="button" name="reset" class="btn  btn-block" value=" Go Back " onClick="window.location.href='employeesalary.php?month=<?php echo $month  ?>&year=<?php echo $year;  ?>'"> 
                                           
 
 </div>
										
									</div>
											</div>
                                
                                <?php } ?>		
                                        
									</div>
                                      
                                
                                    
                                    
                                  
                                    
                                    
                                    
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				
                
                
                

     
     
  
            
            
     
            
            
			<!-- /.container -->
</form>
		</div>
	</div>
<!-- <script language="javascript" type="text/javascript" src="javascript/jquery1.4.js">   </script>
-->

</body>
</html>