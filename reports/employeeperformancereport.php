<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");

checkIntrusion($adminId);
/*if(isset($_GET['pg'])&&$_GET['pg']!=''&&$_GET['pg']!='0'){	
		$pg=$_GET['pg'];
		$creditArr=getNotCreditedInBankByProg($pg);

	}else{
		$pg=0;	
		$creditArr=getNotCreditedInBank();

		
}*/
$type=$_GET['type'];
	

if(isset($_GET['year']) && $_GET['year']!='' ){ 
	$curYear=$_GET['year'];
}

if($type==1){
	$filename ="employeeperformance.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="employeeperformance.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
                                         <tr >
            <th >Sno</th>
             <th>Code</th>
            <th>Username</th>
            <th  data-class="expand">Name</th>
            <th  data-hide="phone">Jan</th>
            <th  data-hide="phone">Feb</th>
            <th  data-hide="phone">Mar</th>
            <th  data-hide="phone">Apr</th>
            <th  data-hide="phone">May</th>
            <th  data-hide="phone">Jun</th>
            <th  data-hide="phone">Jul</th>
            <th  data-hide="phone">Aug</th>
            <th  data-hide="phone">Sep</th>
            <th  data-hide="phone">Oct</th>
            <th  data-hide="phone">Nov</th>
            <th  data-hide="phone">Dec</th>
             <th  data-hide="phone">Total</th>
            <th  data-hide="phone">Avg</th>
           
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
	$empId=$fetch['id'];
	$total=0;
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
    <td align="left" class="smallfonttext"><?php echo getCode($fetch['id']); ?></td>
	<td align="left" class="smallfonttext"><?php echo $fetch['username']; ?></td>
	<td  align="left" class="smallfonttext"><b><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></b></td>
	       <?php
		  	 foreach (getSrtMonth() as $month){
				 $report=getPerformanceReport($month,$curYear,$empId);
				 $total=$total+$report;
				 
		   ?>
           <td  data-hide="phone"><?php  echo $report; ?></td>
           <?php } ?>
            
             <td  data-hide="phone" style="text-align:center;"><b style="color:#03C;"><?php  echo $total; ?></b></td>
            <td  data-hide="phone"><?php  echo ceil($total/12); ?></td>
    
    
  </tr>
  <?php }?>
  
  <?php }else{?>
  <tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
