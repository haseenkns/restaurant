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
	

if(isset($_GET['start']) && $_GET['start']!='' && $_GET['end'] && $_GET['end']!=''){ 
	$start=$_GET['start'];
	$end=$_GET['end'];
}


$tds=getEffectiveServiceTax($sstart,$send);
												
					



if($type==1){
	$filename ="revenuereport.xls";
	header('Content-type: application/ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}elseif($type==2){
	$filename ="revenuereport.doc";
	header('Content-type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename='.$filename);
}

 ?>
<table class="table table-striped table-bordered table-hover table-checkable table-responsive  ">
									<thead>
                                         <tr >
               
                <th width="10%">Program</th>
                <th width="10%">
                <table width="100%" border="0"  cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="8%">Level </td>
                        <td width="8%">No of Sales </td>
                        <td width="8%">Price </td>
                        <td width="8%">Total </td>
                        <td width="8%">Tax (<?php echo $tds; ?>)</td>
                        <td width="8%">Gross </td>
                        <td width="8%">No Of Cancel </td>
                        <td width="8%">Price </td>
                        <td width="8%">Total </td>
                        <td width="8%">Tax </td>
                        <td width="8%">Gross </td>
                        <td width="8%">Net </td>
                    <td>
                            

    
    
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
          
             <td><?php echo $fetch['pname'] ?></td>
            <td>
            									<?php 
												
												$divTds=100+$tds;
  	$sqlQrys=mysql_query("select * from `program_price` where `status`='1' and `prog_id`='$pid'");
	$i=0;
	$numrowss=mysql_num_rows($sqlQrys);
	if($numrowss>0){
	while($fetchs=mysql_fetch_array($sqlQrys)){
		$level=$fetchs['id'];
		$price=$fetchs['price'];
		$total=0;
		$cancel=0;
		
		$totalSales=getSalesByPidLidStartDayEndDay($pid,$level,$start,$end);
		$totalCancel=getSalesCancelByPidLidStartDayEndDay($pid,$level,$start,$end);
		$grossTotalsalaes=(int)$totalSales * (int)$price;
		$taxSales=floor(($grossTotalsalaes*$tds)/$divTds);
		$grossSales=$grossTotalsalaes-$taxSales;
		
		$grossTotalCancel=(int)$totalCancel * (int)$price;
		$taxCancel=floor(($grossTotalCancel*$tds)/$divTds);
		$grossCancel=$grossTotalCancel-$taxCancel;
         $net=$grossSales-$grossCancel;
		?>
            
            <table width="100%" border="0">
                    <tr>
                   			 <th width="10%"><?php echo $fetchs['pricename']; ?><br/>(<?php echo $fetchs['price']; ?>) </th>
                             <th width="10%"><?php echo $totalSales; ?> </th>
                             <th width="10%"><?php echo $price; ?> </th>
                             <th width="10%"><?php echo $grossTotalsalaes; ?></th>
                             <th width="10%"><?php echo $taxSales ?> </th>
                             <th width="10%"><?php echo $grossSales; ?> </th>
                             <th width="10%"><?php echo $totalCancel; ?> </th>
                             <th width="10%"><?php echo $price; ?> </th>
                             <th width="10%"><?php echo $grossTotalCancel; ?> </th>
                             <th width="10%"><?php echo $taxCancel; ?>  </th>
                             
                             <th width="10%"><?php echo $grossCancel; ?> </th>
                             <th width="10%"><?php echo $net; ?> </th>
                    <td>
                            

    
    
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
