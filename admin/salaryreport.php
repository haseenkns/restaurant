<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);

if(isset($_GET['month'])&&$_GET['month']!='0'){
	$getmonth=$_GET['month'];
	$monthName = getMonth($getmonth-1);
	$getyear=$_GET['year'];
	
	$numDays = cal_days_in_month(CAL_GREGORIAN,$getmonth,$getyear);
	
	
	
}
$monthArr=array("January","Febuary","March","April","May","June","July","August","September","October","November","December");


//die;


	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Administrator has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Administrator not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Administrator data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Administrator data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Administrator data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Administrator data not deleted successfully !!!!';
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
	
	case 'sas':
		$msg='Salary has been  added successfully !!';
		$class='success';
	break;
	
	case 'saf':
		$msg='Salary  not added successfully !!!!';
		$class='danger';
	break;
	
	case 'sus':
		$msg='Salary has been  updated successfully !!';
		$class='success';
	break;
	
	case 'suf':
		$msg='Salary  not updated successfully !!!!';
		$class='danger';
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
    <script>
	function changeDate(month,year){
		window.location.href='salaryreport.php?month='+month+'&year='+year;
	}
	</script>



<style>
.validateText{
font-size:11px;
color:#999;
font-style:italic;	
}
</style>

	</head>

<body class="theme-dark">

	
	<script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script>
    function setFocus(val){
		document.getElementById(val).focus();	
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
		
    </script>
    
    
    <script type="text/javascript" language="JavaScript">

		
		
	function validateUser()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	
	
	if(document.user.fname.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter First Name','fname')
		
		return false;
		}

	if(!document.user.fname.value.match(letters))
	{
		errorMsg('Only Alphabets , space and dot dign is allowed','fname');
		
		return false;
	}
	
	if(document.user.lname.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter Last Name','lname')
		
		return false;
		}

	if(!document.user.lname.value.match(letters))
	{
		errorMsg('Only Alphabets , space and dot dign is allowed','lname');
		
		return false;
	}
	
	
	if(document.user.email.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter valid Email-address','email')
		
		return false;
		}

	if(!document.user.email.value.match(eptrn))
	{
		errorMsg('Enter valid Email-address','email');
		
		return false;
	}
	
	
	if(document.user.designation.value=="0")
		{
		errorMsg("Designation cannot be left blank","designation");
		return false;
		}
	
	
	if(document.user.uname.value=="")
		{
		errorMsg("Username should not blank",'username');
		document.user.uname.focus();
		return false;
		}
	if(document.user.uname.value!="")
		{
		  
		  if(!document.user.uname.value.match(uname)){
				errorMsg("Username - Please enter Alphabets a - z ,numbers 0-9 ,(! @ # & - _ ) symbols only",'username');
				return false;
			}
		}
		
	
	if(document.user.pwd.value=="")
		{
		errorMsg("Password should not be blank",'pwd');
		
		return false;
		}
		
	if(document.user.pwd.value!="")
		{
		  if(document.user.pwd.value.length < 6 || document.user.pwd.value.length > 36)
		   {
				errorMsg("Password should be atleast 6 characters and maximum 20 characters long !","pwd");
				
				return false;
		   }
	}	
	if(document.user.cpwd.value=="")
		{
		errorMsg("Confirm password cannot be left blank","cpwd");
		
		return false;
		}
	if(document.user.cpwd.value!=document.user.pwd.value)
		{
		errorMsg("Password and Confirm Password should match !","cpwd");
		
		return false;
		}
		
	if(document.user.role.value=="0")
		{
		errorMsg("Privileges cannot be left blank","role");
		return false;
		}	
		
	return true;
}
</script>
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
                <div class="row">
                <div class="col-md-5" >
					<div class="page-title">
						<h3>Employees Salary ( <strong style="color:#51A351;font-weight:normal;"><?php echo $monthName; ?> , <?php echo $getyear; ?> </strong> )</h3>
						<!--<span>Good morning, John!</span>-->
					</div>
                   </div>
                     <div class="col-md-7" style="padding-top:25px;text-align:right;">
                     <div class="row">
                         <div class="col-md-3"  style="padding-top:5px;">
                         Modify Search
                         </div>
                          <div class="col-md-4" >
                         <select class="form-control" name="month" id="month"><option value="0">Salary Month</option>
									<?php
                                    foreach($monthArr as $month=>$value){
										$month=$month+1;
										?>
                                         
                                        <option <?php if($getmonth==$month){ ?> selected<?php } ?> style="padding:4px;color:#000;font-weight:bold;font-size:14px;" value="<?php echo $month; ?>"><?php echo $value; ?></option>
                                        
                                    <?php }?>
                                </select>
                         </div>
                          <div class="col-md-3" >
                         <select class="form-control"  name="year" id="year"><option value="0">Salary Year</option>
									<?php
                                    for($year=date("Y");$year>=2012;$year--){?>
                                        
                                        <option <?php if($getyear==$year){ ?> selected<?php } ?> style="padding:6px;color:#000;font-weight:bold;font-size:16px;" value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        
                                    <?php }?>
                                </select>
                         </div>
                      <div class="col-md-1" >
                         <input type="button" class="btn " value="Search" onClick="changeDate(document.getElementById('month').value,document.getElementById('year').value)">
                         </div>
                     </div>
                     
                     
                     </div>
                    
                </div>
					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

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
								<h4><i class="icon-reorder"></i> Employees <a href="reports/salarytracker.php?month=<?php echo $getmonth; ?>&year=<?php echo $getyear; ?>&type=1"><img src="images/excel.png" width="24" height="24"></a>&nbsp;&nbsp;<a href="reports/salarytracker.php?month=<?php echo $getmonth; ?>&year=<?php echo $getyear; ?>&type=2"><img src="images/word.png" width="26" height="26"></a></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
                            <?php
							//$tds=(float)getTDS();
							?>
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive  ">
									<thead>
										
                                        
                                         <tr >
            <th width="69" >Sno</th>
             <th width="69">Code</th>
                <th width="69"  data-class="expand">Name</th>
                
                <th width="69" data-hide="phone,tablet">Days/Hrs</th>
                <th width="97"  data-hide="phone,tablet" style="background-color:#99CCFF">Salary</th>
                <th width="99" style="text-align:center;background-color:#99CCFF"   data-hide="phone,tablet">Incent.</th>
                <th width="103" style="text-align:center;background-color:#99CCFF"   data-hide="phone,tablet">Bonus</th>
                <th width="96" style="text-align:center;background-color:#99CCFF"   data-hide="phone,tablet">Gross payable</th>
                <th width="31" style="text-align:center;background-color:#CC99FF;"  data-hide="phone,tablet">TDS<br><?php echo $tds; ?></th>
                <th width="31" style="text-align:center;background-color:#CC99FF;"  data-hide="phone,tablet">Taxable</th>
                <th width="58" style="text-align:center;background-color:#CC99FF;"  data-hide="phone,tablet">Advance</th>
                <th width="37" style="text-align:center;background-color:#CC99FF;"  data-hide="phone,tablet">Basic</th>
                <th width="35" style="text-align:center;background-color:#CC99FF;"  data-hide="phone,tablet">HRA</th>
                <th width="55" style="text-align:center;background-color:#CC99FF;"  data-hide="phone,tablet">Medical</th>
                <th width="82" style="text-align:center;background-color:#CC99FF;"  data-hide="phone,tablet">Convy.</th>
                <th width="25" style="text-align:center;background-color:#CCFFCC;"  data-hide="phone,tablet">Net</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `admin` where `id`!='1'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	$id=$fetch['id'];
	$salType=$fetch['salarytype'];
	
	$taxable=$fetch['taxable'];
    $checkEmpSalary=checkEmpSalaryExistsById($id,$getmonth,$getyear);
	
	

	
	
	if($checkEmpSalary){
			$empData=getEmpSalaryById($id,$getmonth,$getyear);
			if($salType==1){
				$totalDays=getTotalPresentDays($empData[2],$empData[3],$numDays);
				$salText="days";
			}elseif($salType==2){
				$totalDays=$empData[23];	
				$salText="hrs";
			}
				$salary=stripslashes($empData[17]);
				$hra=stripslashes($empData[20]);
				$medical=stripslashes($empData[19]);
				$conveyance=stripslashes($empData[21]);
				$incentive=stripslashes($empData[4]);
				$bonus=stripslashes($empData[5]);
				$gross=getGrossSalary($numDays,$salary,$incentive,$bonus,$totalDays,$salType);
			
			$tds=$empData[24];
			$basic=$gross-$hra-$medical-$conveyance;
			$advance=stripslashes($empData[6]);
			$tdsAmt=floor(($tds*$basic)/100);
			if($taxable==1){
			$net=$basic+$hra+$medical+$conveyance-$advance-$tdsAmt;
			}else{
			$net=$basic+$hra+$medical+$conveyance-$advance;
			}	
		if($empData[22]=='1'){ $taxable= 'Yes';}else{ $taxable= "No" ;}	
		
		$totsalary=$totsalary+$salary;
		$totincentive=$totincentive+$incentive;
		$totbonus=$totbonus+$bonus;
		$totgross=$totgross+$gross;
		$tottds=$tottds+$tdsAmt;
		$totadvance=$totadvance+$advance;
		$totbasic=$totbasic+$basic;
		
		$tothra=$tothra+$hra;
		$totmedical=$totmedical+$medical;
		$totconveyance=$totconveyance+$conveyance;
		$totnet=$totnet+$net;
		
		
			
    }else{
		$salary="--";
		$hra="--";
		$medical="--";
		$conveyance="--";
		$totalDays="--";
		$incentive="--";
		$bonus="--";
		$gross="--";
		$basic="--";
		$advance="--";
		$tdsAmt="--";
		$net="--";
		$taxable="--";	
	}
	
	
	
	
	
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo getCode($fetch['id']); ?></td>
	
	<td  align="left" class="smallfonttext"><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></td>
	
    <td align="left" class="smallfonttext"><?php echo $totalDays; ?> <?php echo $salText; ?> </td>
    <td align="left" class="smallfonttext" style="background-color:#99CCFF;"><?php echo $salary; ?></td> 
    <td align="left" class="smallfonttext" style="background-color:#99CCFF;"><?php echo $incentive; ?></td>
    <td align="left" class="smallfonttext" style="background-color:#99CCFF;"><?php echo $bonus; ?></td>
    
    <td align="left" class="smallfonttext" style="background-color:#99CCFF;"><?php echo $gross; ?></td>
    <td align="left" class="smallfonttext" style="background-color:#CC99FF;" ><?php echo $tdsAmt; ?><br/><span style="font-size:9px;"><?php echo $tds."%"; ?></span></td>
     <td align="left" class="smallfonttext" style="background-color:#CC99FF;"><?php echo $taxable; ?></td>
    <td align="left" class="smallfonttext" style="background-color:#CC99FF;"><?php echo $advance; ?></td>
    <td align="left" class="smallfonttext" style="background-color:#CC99FF;"><?php echo $basic; ?></td>
    <td align="left" class="smallfonttext" style="background-color:#CC99FF;"><?php echo $hra; ?></td>
	<td align="left" class="smallfonttext" style="background-color:#CC99FF;"><?php echo $medical; ?></td>
	<td align="left" class="smallfonttext" style="background-color:#CC99FF;"><?php echo $conveyance; ?></td>
    <td align="left" class="smallfonttext" style="background-color:#CCFFCC;"><b style="color:#000;"><?php echo $net; ?></b></td>
    
    
  </tr>
  
  <?php }?>
   <tr style="font-weight:bold;background-color:#D4D4D4"><td colspan="4" align="center">Total</td><td colspan="1" align="center" class="blackbold" bgcolor="#FFFFFF"><?php echo $totsalary; ?></td><td><?php echo $totincentive; ?></td><td><?php echo $totbonus; ?></td><td><?php echo $totgross; ?></td><td><?php echo $tottds; ?></td><td></td><td><?php echo $totadvance; ?></td><td><?php echo $totbasic; ?></td><td><?php echo $tothra; ?></td><td><?php echo $totmedical; ?></td><td><?php echo $totconveyance; ?></td><td ><?php echo $net; ?></td></tr>
  <?php }else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td colspan="1" align="center" class="blackbold" bgcolor="#FFFFFF">No Records Found !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
  
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