<?php
ob_start();
session_start();
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
 $id =$_GET['id']; 
 $assignmentName=getSubAssignmentsNameById($id);
 
 if($id==0){
	echo "Please Select an Assignment first. ";
	die; 
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>

<style>
.ac-textbox-small {
	width:323px;
	height:30px;
	background-color:#FDFDFD;
	border:solid 1px #E8E8E8;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	padding-left:5px;
	padding-top:8px;
	font-weight:bold;
}
.smalllogintext{
font-family:Calibri;
font-size:14px;
float:left;
color:#666666;

margin-top:3px;
}
.btn.btn-orange {

}
.btn, .btn.btn-small {
padding: 6px 12px 4px;
font-size: 11px;
}
.btn {
background-color: #E85858;
border: 1px solid #ccc;
display: inline-block;
zoom: 1;
line-height: 1.3;
color: #f9f9f9;
text-transform: uppercase;
cursor: pointer;
text-align: center;
-moz-border-radius: 2px;
border-radius: 2px;
}
</style>
</head>

<body>
<form>
<div style="" id="mainassignment">
<table width="100%" border="0">
  <tr>
  <td></td>
    <td colspan="1"  class="smalllogintext"><?php echo $assignmentName; ?></td>
  </tr>
  <tr>
    <td class="smalllogintext">Add Sub Sub Assignment</td>
    <td><input type="text" class="ac-textbox-small" id="othersa" style="width:250px;"></td>
  </tr>
  
  <tr>
    <td></td>
    <td><input type="hidden" name="hidAid" id="hidAid" value="<?php echo $id; ?>"><input type="button" class="btn btn-orange" onclick="populatesubsubassignment(document.getElementById('hidAid').value,document.getElementById('othersa').value)" value="Submit"></td>
  </tr>
</table>
</div>

<div  style="display:none;" id="assignmentloader">
	<img src="images/loading141.gif">  &nbsp; Adding sub sub assignment please wait ...
</div>

</form>

</body>
</html>