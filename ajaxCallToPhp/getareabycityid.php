<?php
 ob_start();
 session_start();

 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $val=$_GET['val'];
 
 $selQry=mysql_query("select * from `locations` where `a_id`='$val'  and `status` = '1'");
 $numRows=mysql_num_rows($selQry);
 if($numRows>0){?>
	 
	<select  id="area" name="area" onchange="setHiddenArea(this.value)" class="form-control" style="width:100%;"><option value="0">Select Area</option>
    
		<?php
        while($fetch=mysql_fetch_array($selQry)){?>
		<option value="<?php echo $fetch['id']; ?>"><?php echo $fetch['name']; ?></option> 
		<?php }
	?>
     </select>
 <?php }else{?>
 <select   id="area" name="area" class="form-control" style="width:100%;"><option value="0">No Area</option> </select>
 <?php }

 
 ?>
