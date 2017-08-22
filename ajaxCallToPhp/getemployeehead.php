<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $val=$_GET['val'];
 
 $selQry=mysql_query("select *  from `admin` where `status`='1' and `id`='$val' ");
                                            $numrows=mysql_num_rows($selQry);
                                           	 if($numrows>0){
												 $fetchRes=mysql_fetch_row($selQry);
												 if($fetchRes[19]==1){
													echo "Team Head - None"; 
												 }else{
													echo "Team Head ".getReportToNameWithDesignation($fetchRes[16]); 
												 }
											}else{
												echo "";	
											}
?>