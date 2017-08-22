<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");

checkIntrusion($adminId);



$type=$_GET['type'];
	

if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['pg']) ){
		$start=	$_GET['start'];
		$end =$_GET['end'];
		$pg =$_GET['pg'];
		$getCancelledMemIds=searchCancelledMemberIdsByProgramAndDate($pg,$start,$end);
	}else{
		$getCancelledMemIds=searchCancelledMemberIds()	;
}


if($type==1){
	$filename ="cancelledmemberreport.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="cancelledmemberreport.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th  data-hide="phone,tablet">Preview</th>
             <th>Program</th>
             <th  data-hide="phone">Member Name</th>
            <th  data-hide="phone">Mem No</th>
            <th data-hide="phone,tablet">Mem Fees</th>
            <th data-hide="phone,tablet" style="text-align:center;color:#06C;">Pay Recv</th>
            <th  data-hide="phone,tablet" style="text-align:center;">Cancel On</th>
            <th  data-hide="phone,tablet" style="text-align:center;color:#06C;">Reason</th>
            <th  data-hide="phone,tablet" style="text-align:center;">Approved By</th>
            <th  data-hide="phone,tablet" style="text-align:center;color:#06C;">Out Pay</th>
            <th  data-hide="phone,tablet" style="text-align:center;">Amount</th>
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
 	// print_r($getCancelledMemIds);
	if(!$getCancelledMemIds[0]==0){
		foreach($getCancelledMemIds as $mids){
        $memDataArr=getMembersDetailById($mids);
		$i++;
		$progId=$memDataArr[1];
		$progDetail=getProgramDescriptionById($progId);
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $mids;
		$complimentry=$memDataArr[45];
		
		
		$memNumber=$preffix."".$memId."".$suffix;
		$name=getTabledataById("name","titles",$memDataArr[2])." ".$memDataArr[3]." ".$memDataArr[4]." ".$memDataArr[5];
		
		$cancelArr=getCancellationDetailByMemId($mids);
		$cancelon=$cancelArr[9];
		$approvedby=getAdminNameById($cancelArr[12]);
		$reason=$cancelArr[3];
		$inmode=$memDataArr[29];
		
		
		if($complimentry==1){
			
			$outmode="Comp.";
			$refundamount="--";	
			$outgoingText="Complimentry Member,payment none";
			$inmodetext="Complimentry";
		}else{
			
			$outtext=$cancelArr[5];
			$inmodetext=getTabledataById("name","paymentmodes",$memDataArr[22]);
			if($outtext==1){
				$outmode="<img src='images/cashicon.png'>";	
				$outgoingText="Cash Returned";
			}elseif($outtext==2){
				$bankname=$cancelArr[6];
				$chqno=$cancelArr[8];
				$chqdate=$cancelArr[7];
				
				$outmode="<img src='images/chequeicon.png'>";
				$outgoingText="By Cheque : Bank - $bankname ,Chq No.- $chqno, Chq Date - $chqdate";
				
			}
			$refundamount=$cancelArr[4];	

		}
		
		
		
		
		
	
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewmember.php?aid=<?php echo base64_encode( $mids); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
        <td align="left" class="smallfonttext"><?php echo stripslashes($progName); ?></td>
        <td align="left" class="smallfonttext"><?php echo $name; ?></td>
        <td align="left" class="smallfonttext"><?php echo $memNumber; ?></td>
        <td align="left" class="smallfonttext"><?php echo getProgramPriceById($memDataArr[28]); ?></td>
        <td align="left" class="smallfonttext"><span style="cursor:pointer" class="bs-popover"  data-trigger="hover" data-placement="top" data-content="<?php echo $inmodetext ;?>" data-original-title="Payment recv. details"><?php echo $inmode; ?></span></td>
        <td align="center"  class="smallfonttext" ><?php echo $cancelon; ?></td>
        <td align="left" class="smallfonttext"><span style="cursor:pointer;" class="bs-popover"  data-trigger="hover" data-placement="top" data-content="<?php echo $reason ;?>" data-original-title="Reason for Cancellation"><?php echo limitContent($reason,20); ?></span></td>
        <td align="left" class="smallfonttext"><?php echo $approvedby; ?></td>
        <td align="left" class="smallfonttext"><span style="cursor:pointer" class="bs-popover"  data-trigger="hover" data-placement="top" data-content="<?php echo $outgoingText ;?>" data-original-title="Outgoing Payment details"><?php echo $outgoingText ;?></span></td>
        <td align="left" class="smallfonttext"><?php echo $refundamount; ?></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
