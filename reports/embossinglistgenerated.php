<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);


if(isset($_GET['pg'])&&$_GET['pg']!=''){	
		$pg=$_GET['pg'];
		$generatedArr=getGeneratedEmbossingIdsByPid($pg);

	}else{
		$pg=0;	
		$generatedArr=getGeneratedEmbossingIds();

		
}
$pgText=getProgramNameById($pg);

	

if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
	$generatedArr=array();
	$startdate=$_GET['start'];
	$enddate=$_GET['end'];
	$generatedArr=getGeneratedEmbossingIdsByDateAndPid($startdate,$enddate,$pg);
	//print_r($generatedArr);
	$dateText="From ( ".$startdate." -- ".$enddate." )";
}else{
	$dateText="";
}


$type=$_GET['type'];


if(count($generatedArr)==0){
	$eids="0";

}else{
	$eids=implode(",",$generatedArr);
	
}


if($type==1){
	$filename ="generatedembossinglist.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="generatedembossinglist.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
                                            <th width="3%" >Sno</th>
                                            <th width="8%"  data-hide="phone">Date</th>
                                            <th width="8%" data-hide="phone,tablet" style="text-align:left;">Card no</th>
                                            <th width="12%">Card Type</th>
                                            <th width="34%"  data-hide="phone">Member Name (Spouse name,if required)</th>
                                         	<th width="10%">Expiry</th>
                                            <th width="10%">Spouse Card</th>
                                             <th width="10%">Generated On</th>
                                           
 										 </tr>
									</thead>
									<tbody>
										<?php 
									//echo "select * from `members` where `id` IN ($memids) order by `id` Desc";
							
  	$sqlQry=mysql_query("select * from `embossinglist` where `status`='1' and `id` in ($eids) order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$id=$fetch['id'];
		$membId=$fetch['mem_id'];
		$memArr=getMembersDetailById($membId);
		$progId=getProgramIdByMemberId($membId);
		
		    $progDetail=getProgramDescriptionById($progId);
			$progName=$progDetail[1];
			$memberstart=$progDetail[8];
			$preffix=$progDetail[10];
			$suffix=$progDetail[11];
			$memId=(int)$memberstart + $membId;
			$memNumber=$preffix."".$memId."".$suffix;
		    $name=getTabledataById("name","titles",$memArr[2])." ".$memArr[3]." ".$memArr[4]." ".$memArr[5];
  ?>
  <tr bgcolor="#FFFFFF">
            <td align="center" class="smalltext"><?php echo $i; ?></td>
            <td align="left" class="smallfonttext" ><?php echo getMemberMonthYear($memArr[26]); ?></td>
            <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
            <td align="left" class="smallfonttext" ><?php echo getMemberCardType($membId); ?></td>
            <td align="left" class="smallfonttext"><?php echo getMemberNameByCardType($membId); ?></td>
             <td align="center"  ><?php echo getMemberExpiry($membId); ?></td>
           <td align="center"  ><?php echo getMemberSpouseCheck($membId); ?></td>
           
       
            <td align="center"  ><?php echo $fetch['pdate']; ?></td>
        
            
  </tr>
  <?php }}else{?>
  <tr style="background:#FFF;"><td></td><td></td><td></td><td></td><td>No Pending Record</td><td></td><td></td><td></td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
