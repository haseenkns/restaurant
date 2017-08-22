<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");
checkIntrusion($adminId);
$currentDate=date("d")."/".date("m")."/".date("Y");

if(isset($_GET['pg'])&&$_GET['pg']!=''){	
		$pg=$_GET['pg'];
		$cmids=getReferredMembersByProg($pg);
		
	}else{
		$pg=0;	
		$cmids=getReferredMembers();
		
}


//die;
$pgText=getProgramNameById($pg);

if(count($cmids)==0){
	$impIds="0";

}else{
$impIds=implode(",",$cmids);
	
}

$type=$_GET['type'];
	





if($type==1){
	$filename ="completenominationreport.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="completenominationreport.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
						
     <table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                    <tr >
                                        <th width="3%" >Sno</th>
                                      
                                        <th width="12%">Prog. Name</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Member</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Mem No</th>
                                        <th width="10%"  data-hide="phone">Mem.date</th>
                                        <th width="10%"  data-hide="phone">Contact</th>
                                        <th width="10%"  data-hide="phone">Processed By </th>
                                    </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
	//echo "select * from `members` where `id` IN ($impIds)  order by `id` Desc";
  	$sqlQry=mysql_query("select * from `members` where `id` IN ($impIds)  order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$memid=$fetch['id'];
		$progId=$fetch['prog_id'];
		$approvedby=$fetch['approvedby'];
		$reportto=getReportToEmp($approvedby);
		$processedby=$fetch['processedby'];
		$ptime=$fetch['createdtime'];
		$memNumber=getMemberShipNumber($progId,$memid);
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$name=getMemberNameById($memid);
		$dateofsale=$fetch['dateofsale'];
		$tenure=getTenureById($fetch['tenure']);
		
		$refMemId=$memid;
		
  ?>
  <tr bgcolor="#0099CC">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
        
        <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;" ><?php echo $name; ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo $memNumber; ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($fetch['dateofsale']); ?></td>
       
         <td align="center"  ><?php echo getMemberContact($fetch['id']); ?></td>
    <td align="center"  ><?php echo getConsultantsNameByMemId($fetch['id']) ?></td>
    
      
    
  </tr>
  
  <tr><td colspan="8">
  
  <table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									
									<tbody>
										<?php 
  	$sqlQrys=mysql_query("select * from `members` where `referredby`='$refMemId' order by `id` Desc");
	$i=0;
	$numrowss=mysql_num_rows($sqlQrys);
	if($numrowss>0){
	while($fetchs=mysql_fetch_array($sqlQrys)){
		$i++;
		$progIds=$fetchs['prog_id'];
		$progDetails=getProgramDescriptionById($progIds);
		$progNames=$progDetails[1];
		$memberstarts=$progDetails[8];
		$preffixs=$progDetails[10];
		$suffixs=$progDetails[11];
		$memIds=(int)$memberstarts + $fetchs['id'];
		$memNumbers=$preffixs."".$memIds."".$suffixs;
		$names=getTabledataById("name","titles",$fetchs['title'])." ".$fetchs['fname']." ".$fetchs['mname']." ".$fetchs['lname'];
		
	
  ?>
  <tr><td colspan="8"><table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr bgcolor="#FFF">
      
    
    <td align="left" class="smallfonttext"><?php echo $memNumbers; ?></td>
    <td align="left" class="smallfonttext"><?php echo stripslashes($progNames); ?></td>
    <td align="left" class="smallfonttext"><?php echo $names; ?></td>
	<td align="left" class="smallfonttext"><?php echo getProgramPriceById($fetchs['mlevel']); ?></td>
    <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($fetchs['dateofsale']); ?></td>
     <td align="center"  ><?php echo getMemberContact($fetchs['id']); ?></td>
     
	<td align="center"  ><?php echo getConsultantsNameByMemId($fetchs['id']) ?></td>
  </tr>
</table>
</td></tr>
  
  
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
  
  </td></tr>
  
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td></td><td></td><td></td><td></td><td></td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>