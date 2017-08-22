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
 $sval=mysql_real_escape_string($_GET['sval']);
?>
<select  multiple="multiple" name="subservice[]" id="subservice[]" placeholder="Select SubServices" class="form-control SlectBox">
             <?php
					$execQry=mysql_query("select * from `subservices` where `status` = '1' and `s_id`='$sval' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" ><?php echo stripslashes($fetch['title']) ?></option>
					<?php }	}else{?>
					<option value="0">No Subservices</option>

					<?php } ?>
  
   </select>