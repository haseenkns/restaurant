<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 $val=$_GET['val']; // 1 -city,2-pincode,3 designation

  if($val==1){
	$dataArr=getAllCityData();  
  }
   if($val==2){
	$dataArr=getAllPincodeData();  
  }
   if($val==3){
	$dataArr=getAllDesignationData();  
  }

 ?>

 
<select name="data" id="data" class="form-control"  onchange="setDataValues(this.value)" >
        <option value="0">Select Data</option>
        <?php 
		if(count($dataArr)>0){
		foreach($dataArr as $id=>$val) {   ?>
        	<option value="<?php echo $id ?>" ><?php echo $val; ?></option>
        <?php }
        }else{?>
     	   <option value="0">No Data</option>
        <?php }
        ?>
        
 </select>
