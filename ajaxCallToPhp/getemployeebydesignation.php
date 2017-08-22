<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $val=$_GET['val'];

 ?>

 
<select name="reportto" id="reportto" class="form-control"  onchange="setEmployeeReportTo(this.value)" >
                                            <option value="0">Select Employee</option>
                                            <?php
                                            $selQry=mysql_query("select *  from `admin` where `status`='1' and `designation`='$val' order by `id` Asc");
                                            $numrows=mysql_num_rows($selQry);
                                            if($numrows>0){
                                            while($fetch=mysql_fetch_array($selQry)){?>
                                            <option value="<?php echo $fetch['id'] ?>" ><?php echo $fetch['firstname']." ".$fetch['lastname']; ?></option>
                                            <?php }
                                            }else{?>
                                            <option value="0">No Employee</option>
                                            <?php }
                                            ?>
 </select>
