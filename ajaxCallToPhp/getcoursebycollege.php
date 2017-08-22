<?php
 ob_start();
 session_start();
 sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $val=$_GET['val'];
  $id=$_GET['id'];
 $selQry=mysql_query("select * from `collegecourses` where `c_id`='$val'  and `status` = '1'");
 $numRows=mysql_num_rows($selQry);
 if($numRows>0){?>
	 
	<select  id="college<?php echo $id; ?>" name="college<?php echo $id; ?>" onchange="setHidCourseValue(this.value,'<?php echo $id; ?>')" class="form-control" style="padding:5px;height:35px;width:130px;"><option value="0">Select Course</option>
    
		<?php
        while($fetch=mysql_fetch_array($selQry)){?>
		<option value="<?php echo $fetch['id']; ?>"><?php echo $fetch['name']; ?></option> 
		<?php }
	?>
	
    
    
    
     </select>
 <?php }else{?>
 <select  class="form-control" style="padding:5px;height:35px;width:120px"><option value="0">No Course</option> </select>
 <?php }

 
 ?>
