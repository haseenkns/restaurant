<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
include_once("../designfiles.php");

checkIntrusion($adminId);



 if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['pg']) ){
	$start=$_GET['start'];
	$end=$_GET['end'];
	$pg=$_GET['pg'];
	$dateText= "Between $start And $end ";
	$progText=getProgramtext($pg);
	
 }else{
	 $progText="All Program";
	 $dateText=date("d F, Y");
 }
$type=$_GET['type'];
	





if($type==1){
	$filename ="embosssummaryreport.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="embosssummaryreport.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
						<div class="widget-content no-padding">
       <?php                      
        if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['pg']) ){
			$start=	changeToStdDate($_GET['start']);
			$end =changeToStdDate($_GET['end']);
			$pg =$_GET['pg'];
			?>
			
			<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th width="30%">Program</th>
           
            <th  data-hide="phone" style="text-align:center">Total Primary Embossing</th>
            <th data-hide="phone,tablet" style="text-align:center">Total Spouse Embossing</th>
              <th  data-hide="phone" style="text-align:center">Total Embossing</th>
           
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
	if($pg==0){
 		$sqlQry=mysql_query("select * from `programs`   order by `id` Desc");
	}else{
		$sqlQry=mysql_query("select * from `programs`  where `id` ='$pg' order by `id` Desc");
	}
	$i=0;
	$pdate=date("m-d-Y");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$pid=$fetch['id'];
		$totalPrimaryEmbossing=getTotalPrimaryEmbossingByProgId($pid,$start,$end);
		$totalSpouseEmbossing=getTotalSpouseEmbossingByProgId($pid,$start,$end);
		$totalEmbossing=(int)$totalPrimaryEmbossing+(int)$totalSpouseEmbossing;
	
  ?>
  <tr bgcolor="#FFFFFF">
            <td align="center" class="smalltext"><?php echo $i; ?></td>
            <td align="left"  ><?php echo $fetch['pname'] ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalPrimaryEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalSpouseEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalEmbossing; ?></td>
  </tr>
  <?php }}else{?>
	  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  <?php } ?>
										
									</tbody>
								</table>
            
            
            
		<?php }else{?>
				<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th width="30%">Program</th>
           
            <th  data-hide="phone" style="text-align:center">Total Primary Embossing</th>
            <th data-hide="phone,tablet" style="text-align:center">Total Spouse Embossing</th>
              <th  data-hide="phone" style="text-align:center">Total Embossing</th>
           
          
  </tr>
                                        
                                        
									</thead>
									<tbody>
	<?php 
 	$sqlQry=mysql_query("select * from `programs`  order by `id` Desc");
	$i=0;
	$pdate=date("m-d-Y");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$pid=$fetch['id'];
	
		$totalPrimaryEmbossing=getCurrentTotalSpouseEmbossingByProgId($pid,$pdate);
		$totalSpouseEmbossing=getCurrentTotalSpouseEmbossingByProgId($pid,$pdate);
		$totalEmbossing=(int)$totalPrimaryEmbossing+(int)$totalSpouseEmbossing;
	
  ?>
  <tr bgcolor="#FFFFFF">
            <td align="center" class="smalltext"><?php echo $i; ?></td>
            <td align="left"  ><?php echo $fetch['pname'] ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalPrimaryEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalSpouseEmbossing; ?></td>
            <td align="center" class="smallfonttext"><?php echo $totalEmbossing; ?></td>
  </tr>
  <?php }}else{?>
	  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  <?php } ?>
										
									</tbody>
								</table>
		<?php } ?>
