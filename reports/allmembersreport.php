<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");
checkIntrusion($adminId);

if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['pg']) ){
		$start=	$_GET['start'];
		$end =$_GET['end'];
		$pg =$_GET['pg'];
		$getCancelledMemIds=searchMembersByDateOfsale($pg,$start,$end);
		
	}else{
		$pg =$_GET['pg'];
		$getCancelledMemIds=allmembers();
		
	}
$type=$_GET['type'];
if($type==1){
	$filename ="allmemberreport.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="allmemberreport.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                    <tr >
                                        <th width="5%" >Sno</th>
                                     
                                        <th width="15%">Membership No</th>
                                        <th width="20%"  data-hide="phone">Name</th>
                                        <th width="20%"  data-hide="phone">Program</th>
                                          <th width="10%"  data-hide="phone">Voucher no</th>
                                        <th width="10%"  data-hide="phone">Member Date</th>
                                        <th width="10%"  data-hide="phone">Comp name</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Contact</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Email</th>
                                    </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
if(!$getCancelledMemIds[0]==0){
		foreach($getCancelledMemIds as $mids){
        $memDataArr=getMembersDetailById($mids);
		$i++;
		$progId=$memDataArr[1];
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $mids;
		$complimentry=$memDataArr[45];
		
		
		$memNumber=$preffix."".$memId."".$suffix;
		$name=getTabledataById("name","titles",$memDataArr[2])." ".$memDataArr[3]." ".$memDataArr[4]." ".$memDataArr[5];
		$dateofsale=$memDataArr[29];
		$tenure=getTenureById($memDataArr[25]);
		$validdate=getValidUpto($dateofsale,$tenure);
		
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
      
       <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
       <td align="left" class="smallfonttext"><?php echo $name; ?></td>
       <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
         <td align="left" class="smallfonttext"><?php echo stripslashes($memDataArr[42]); ?></td>
       <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($dateofsale); ?></td>
       <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim( $memDataArr[40]); ?></td>
     
       <td align="left" class="smallfonttext" style="text-align:center;" ><?php echo getMemberContact($mids); ?></td>
         <td align="left" class="smallfonttext" style="text-align:center;" ><?php echo $memDataArr[7]; ?></td>
    
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
