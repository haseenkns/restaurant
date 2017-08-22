<?php
// sleep(1);
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 include("../configuration/thumbnail.php");
  $img=$_GET['img'];
echo showLightboxThumb("../photos/".$img,350,550);  
 ?>
