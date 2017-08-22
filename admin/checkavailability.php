<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
$type=$_SESSION['type'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$team=displayteam($adminId);
array_push($team,$adminId);
if(isset($_GET['lid'])&&$_GET['lid']!=''){
	$lid=$_GET['lid'];
	$edtQry=mysql_query("Select * from `leads` where `id`='$lid'");
	$userData=mysql_fetch_row($edtQry);	
	$leadId=getLeadId($lid);
	$meetingDate=changeToStdDate($userData[26]);
}

$marketinEx=getMarketingExecutivesByTeamLeadId($team);

$lidsOnDate=getTotalMeetingsByDate($userData[26]);
	

?>


<table width="600px" border="0" cellpadding="5px"  cellspacing="5px">
  <tr>
    <td colspan="3"  align="center"><strong>Availability for - <?php echo $meetingDate; ?></strong> </td>

  </tr>
<?php 
$i=0;
foreach($marketinEx as $empIds){
	$i++;
	$countMeetings=countEmpMeetingOnDateByLids($empIds,$lidsOnDate);
	if($countMeetings==0){
		$countText="Available";
	}else{
		$countText=$countMeetings." Meetings";
	}
	
?>
  <tr>
    <td width="20px"><?php echo $i ?></td>
    <td><?php echo getEmployeeNameById($empIds); ?></td>
    <td><?php echo $countText; ?></td>
  </tr>
  <?php } ?>

</table>
