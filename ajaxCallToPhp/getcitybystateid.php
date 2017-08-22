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
 
 $selQry=mysql_query("select * from `cities` where `city_state`='$val'  and `status` = '1'");
 $numRows=mysql_num_rows($selQry);
 if($numRows>0){?>
	 
	<select  id="city" name="city" onchange="getAreaByCityId(this.value)" class="form-control" style="width:100%;"><option value="0">Select City</option>
    
		<?php
        while($fetch=mysql_fetch_array($selQry)){?>
		<option value="<?php echo $fetch['city_id']; ?>"><?php echo $fetch['city_name']; ?></option> 
		<?php }
	?>
	
    
    
    
     </select>
 <?php }else{?>
 <select  class="form-control" id="city" name="city" style="padding:5px;height:35px;width:160px"><option value="0">No City</option> </select>
 <?php }

 
 ?>
