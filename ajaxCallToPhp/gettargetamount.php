<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
	
	$bankid=$_GET['bank'];
	$amount=$_GET['amount'];
	$tax=$_GET['tax'];
	
	//$effServiceTax=getEffectiveServiceTax();
	
//	$effServiceTax=getEffectiveServiceTaxByLeadId($lid);
	
	$selQry=mysql_fetch_row(mysql_query("select `servicetax` from `banks` where  `id`='$bankid' "));
	$taxr=$selQry[0];
	if($taxr==1){
		$tamount=$amount-$tax;
		
	}else{
		
		$tamount=$amount;
		
	}
	
	echo ceil($tamount);
 ?>

