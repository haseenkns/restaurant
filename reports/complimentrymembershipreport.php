<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");

checkIntrusion($adminId);



$type=$_GET['type'];
	

$currentDate=date("d")."/".date("m")."/".date("Y");

if(isset($_GET['pg'])&&$_GET['pg']!=''){	
		$pg=$_GET['pg'];
		$cmids=getComplimentryMemIdsByProg($pg);
	}else{
		$pg=0;	
		$cmids=getComplimentryMemIdsBy();
		
}

	

if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
	$startdate=$_GET['start'];
	$enddate=$_GET['end'];
	$cmids=getComplimentryMemIdsByProgAndDate($startdate,$enddate,$pg);
	//print_r($cmids);
	$dateText="From ( ".$startdate." -- ".$enddate." )";
}else{
	$dateText="";
}
//die;
$pgText=getProgramNameById($pg);

if(count($cmids)==0){
	$impIds="0";

}else{
$impIds=implode(",",$cmids);
	
}


if($type==1){
	$filename ="complimentrymembershipreport.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="complimentrymembershipreport.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                    <tr >
                                        <th width="5%" >Sno</th>
                                        <th width="5%" >View</th>
                                        <th width="15%">Prog. Name</th>
                                        <th width="20%"  data-hide="phone">Approved By</th>
                                        <th width="20%"  data-hide="phone">Report To</th>
                                        <th width="10%"  data-hide="phone">Time</th>
                                        <th width="10%"  data-hide="phone">Mem.date</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Member</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Mem No</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Processed</th>
                                        <th width="10%"  data-hide="phone,tablet" style="text-align:center;"> Valid upto</th>
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
		$validdate=getValidUpto($dateofsale,$tenure);
		
  ?>
<tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
         <td align="center" class="smalltext"><a href="viewmember.php?aid=<?php echo base64_encode($fetch['id']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
        <td align="left" class="smallfonttext"><?php echo getAdminNameById($approvedby); ?></td>
        <td align="left" class="smallfonttext"><?php echo $reportto; ?></td>
        <td align="left" class="smallfonttext"><?php echo $ptime; ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($fetch['dateofsale']); ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;" ><?php echo $name; ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo $memNumber; ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo getAdminNameById($processedby); ?></td>
        <td align="left" class="smallfonttext" style="text-align:center;"><?php echo trim($validdate); ?></td>
    
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td></td><td></td><td></td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
