<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");

checkIntrusion($adminId);




$type=$_GET['type'];
	

if(isset($_GET['month']) && $_GET['month']!='' && $_GET['year'] && $_GET['year']!=''){ 
	$curMonth=$_GET['month'];
	$curYear=$_GET['year'];
}
 $noofDays=cal_days_in_month(1,$curMonth,$curYear);



if($type==1){
	$filename ="salestracker.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="salestracker.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table class="table table-striped table-bordered table-hover table-checkable table-responsive  ">
									<thead>
                                         <tr >
               
                <th width="6%">Program</th>
                <th width="10%">
                <table width="100%" border="0"  cellpadding="0" cellspacing="0">
                    <tr>
                   			 <td width="10%">Level </td>
                    <td>
                            <table width="100%" border="0">
                            <tr>
                            <?php
                            for($i=1;$i<=$noofDays;$i++){
                            ?>
                            <th  style="font-size:9px;font-weight:bold" data-class="expand"><?php echo $i; ?></th>
                            <?php } ?>
                             <th>T</th>
                             <th>C</th>
                             <th>F</th>
                            </tr>
                           
                        </table>

    
    
    				</td>
  				</tr>
</table>

                
                </th>
          
           
           
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `programs` where `status`='1'");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	$pid=$fetch['id'];
	$total=0;
  ?>
<tr >
          
             <td><a href="netsalestracker.php?pid=<?php echo $pid; ?>"><?php echo $fetch['pname'] ?></a></td>
            <td>
            									<?php 
  	$sqlQrys=mysql_query("select * from `program_price` where `status`='1' and `prog_id`='$pid'");
	$i=0;
	$numrowss=mysql_num_rows($sqlQrys);
	if($numrowss>0){
	while($fetchs=mysql_fetch_array($sqlQrys)){
		$level=$fetchs['id'];
		$total=0;
		$cancel=0;
		?>
            
            <table width="100%" border="0">
                    <tr>
                   			 <th width="10%"><?php echo $fetchs['pricename']; ?><br/>(<?php echo $fetchs['price']; ?>) </th>
                    <td>
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <tr>
                            <?php
                            for($i=1;$i<=$noofDays;$i++){
								$sales=getSalesByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear);
								$total=$total+$sales;
								$cancel=$cancel+getSalesCancelByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear);
                            ?>
                         		   <td  style="font-size:9px;border:#666 1px dashed;background:<?php if($sales>0) {?>#06F <?php } ?>;color:#FFF;" data-class="expand" >
								   <?php echo $sales; ?>
                                   
                                   </td>
                            <?php } ?>
                            
                            <td style="background:#093;color:#FFF;"><b><?php echo $total; ?></b></td>
                             <td style="background:#F00;color:#FFF;"><b><?php echo $cancel; ?></b></td>
                              <td style="background:#06C;color:#FFF;"><b><?php echo $total-$cancel; ?></b></td>
                            </tr>
                        </table>

    
    
    				</td>
  				</tr>
</table>
            
         <?php } }?>   
            </th>
            
          
  
  <?php }}else{?>
  <tr><td>No record</td><td>No record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
