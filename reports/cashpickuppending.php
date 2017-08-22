<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");

checkIntrusion($adminId);



if(isset($_GET['pg'])&&$_GET['pg']!=''&&$_GET['pg']!='0'){	
		$pg=$_GET['pg'];
		$creditArr=getNotCreditedInBankByProg($pg);

	}else{
		$pg=0;	
		$creditArr=getNotCreditedInBank();

		
}
$type=$_GET['type'];
	

if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
	$startdate=$_GET['start'];
	$enddate=$_GET['end'];
	$creditArr=getNotCreditedInBankByProgAndDate($startdate,$enddate,$pg);
}else{
	
}
//die;
$pgText=getProgramNameById($pg);

if(count($creditArr)==0){
	$creditIds="0";

}else{
$creditIds=implode(",",$creditArr);
	
}





if($type==1){
	$filename ="cashpickup-pending.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="cashpickup-pending.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th width="5%" >Sno</th>
             <th width="25%">Membership Id</th>
             <th width="20%"  data-hide="phone">Program</th>
            <th width="20%"  data-hide="phone">Name</th>
             <th width="15%"  data-hide="phone">Picked By</th>
             <th width="30%"  data-hide="phone" style="text-align:center;">Created On</th>
            <th width="10%" data-hide="phone,tablet" style="text-align:center;">Amount</th>
           
        
           
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
							<?php 
  	$sqlQry=mysql_query("select * from `members` where `id` IN($creditIds) order by `id` Desc");
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
		$pickUpType=$fetch['pickup'];
		if($pickUpType==2){
			$pickuptext="Transferred";	
		}else if($pickUpType==1){
			$emp=$fetch['employee'];
			$pickuptext=getEmployeeNameById($emp);	
		}
	$total=$total+(int)getProgramPriceById($fetch['mlevel']);
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
     
	
    <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
    <td align="left" class="smallfonttext"><?php echo $name; ?></td>
    <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($fetch['createdon']); ?></td>
    	<td align="left" class="smallfonttext" style="text-align:center;"><?php echo getProgramPriceById($fetch['mlevel']); ?></td>

  </tr>
  <?php }?>
  <tr><td colspan="6" style="text-align:right"><b>Total Pending</b></td><td style="text-align:center"><b><?php echo $total; ?></b></td></tr>
  <?php }else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
