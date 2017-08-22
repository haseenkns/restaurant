<?php
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
$teamm=array();
function displayteams($id){
	global $teamm;
	$query = mysql_query("SELECT * FROM `tree` where `pid`='$id'  ");
	
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	while($fetchRes=mysql_fetch_array($query)){
		$id=$fetchRes[0];
		if(hasChild($id)){
			$teamm[]=$id;
			displayteams($id);
			
		}else{
			$teamm[]=$id;
			displayteams($id);
		}
	
	}	
		
		
			
}
return $teamm;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php echo "<pre>";
foreach( displayteams(0) as $id){ 
$execQry=mysql_fetch_row(mysql_query("select `name` from `tree` where `id`='$id'  "));
echo $execQry[0];
echo "<br/>";

}
?>
</body>
</html>