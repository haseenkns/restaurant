<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $val=$_GET['val'];
 if($val==0){
	 $memNumber="Select Program";
 }else{
 	$memNumber=getMemberShipNumberByProgId($val); 
 }
 ?>
<select name="mlevel" id="mlevel" class="form-control"  onchange="setMlevel(this.value)" >
                                            <option value="0">Select Level</option>
                                            <?php
												$execQry=mysql_query("select * from `program_price` where `status` = '1' and `prog_id`='$val' order by `id` desc ");
												$numRows=mysql_num_rows($execQry);
												if($numRows>0){
												while($fetch=mysql_fetch_array($execQry)){?>
												<option value="<?php echo $fetch['id']; ?>" ><?php echo $fetch['price']; ?> (<?php echo stripslashes($fetch['pricename']); ?>)</option>
												<?php }
												}else{?>
												<option value="0" >No Price</option>
												<?php }?></select><?php echo "####".$memNumber; ?>
