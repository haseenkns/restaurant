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
	
	$type=$_GET['type'];
	
}
$monthArr=array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
if($type==1){
	$filename ="salary-tracker-".$monthName."-".$getyear.".xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="salary-tracker-".$monthName."-".$getyear.".doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

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
