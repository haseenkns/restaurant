<?php
include("../configuration/connect.php");
include("../configuration/functions.php");
$table=$_POST['type'];
$action 				= mysql_real_escape_string($_POST['action']); 
$updateRecordsArray 	= $_POST['recordsArray'];
//print_r($updateRecordsArray );
if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		$query = "UPDATE `$table` SET `position` = " . $listingCounter . " WHERE `id` = " . $recordIDValue;
		mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}
	
	
}
?>