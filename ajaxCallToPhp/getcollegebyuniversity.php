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
 

 $selQry=mysql_query("select * from `collegegeneral` where `uv_id`='$val'  and `status` = '1'");
 $numRows=mysql_num_rows($selQry);
 if($numRows>0){?>
	 
	<select  id="college" name="college" onchange="setHidAreaValue(this.value)" class="form-control" style="padding:5px;height:35px;width:250px;"><option value="0">Select College </option>
    
		<?php
        while($fetch=mysql_fetch_array($selQry)){?>
		<option value="<?php echo $fetch['c_id']; ?>"><?php echo getInstituteNameById($fetch['c_id']); ?></option> 
		<?php }
	?>
	
    
    
    
     </select>
 <?php }else{?>
 <select  class="form-control" style="padding:5px;height:35px;"><option value="0">No College</option> </select>
 <?php }

 
 ?>
