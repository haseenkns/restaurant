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
 $val=$_GET['val'];?>
 
	<select  id="subsubassignment" name="subsubassignment" onchange="setHidSubAssignmentValue(this.value)" class="form-control" style="padding:5px;height:35px;">
    <option value="0">Select Subassignments</option>
<?php 
 $selQry=mysql_query("select * from `subsubassignments` where `a_id`='$val'  and `status` = '1'");
 $numRows=mysql_num_rows($selQry);
 if($numRows>0){?>
	 
    
		<?php
        while($fetch=mysql_fetch_array($selQry)){?>
		<option value="<?php echo $fetch['id']; ?>"><?php echo $fetch['name']; ?></option> 
		<?php }
	?>
	
    
    
    
     
 <?php }else{?>
  <option value="0">No SubSub assignments</option>
  <?php }?>
</select>