<?php
include_once("global.php");
$baseurl=$Global['baseurl'];

function getSiteTitle(){
	$sqlQry=mysql_query("select `site_name` from `generalsettings` where `id`='1'");
	$fetchQry=mysql_fetch_row($sqlQry);
	echo stripslashes($fetchQry[0]);
}
function getSitePaging(){
	$sqlQry=mysql_query("select `pagging` from `generalsettings` where `id`='1'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getPhotoCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `photo` where `id`='$id'"));
	return $resultSet[1];
}

function getTopThreeNews(){
	$execQry=mysql_query("select * from `news` where `status` = '1' order by `id` desc limit 0,5");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$newsIds[]=$fetch['id'];
		}
	}else{
			$newsIds[]=0;
	}
	return $newsIds;
}


function getNewsTitleById($id){
	$execQry=mysql_fetch_row(mysql_query("select `title` from `news` where `id`='$id' "));
	return $execQry[0];
}
function getDetailById($table,$id){
	$resultSet=mysql_fetch_row(mysql_query("select * from $table where `id`='$id'"));
	return $resultSet;

}


function getNumberOfContent($table,$limit){
  if($limit==0){
   $limittext="";
  }else{
    $limittext="limit 0, $limit";
  }
	$execQry=mysql_query("select * from $table where `status` = '1' order by `id` desc $limittext ");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$contentId[]=$fetch['id'];
		}
	}else{
			$contentId[]=0;
	}
	return $contentId;
}

function limitContent($title,$value){
if(strlen($title)>$value){
	$content=substr($title,0,$value);
}else{
     $content=$title;

}
return $content;
}


function getAdminEmail(){
	$sqlQry=mysql_query("select `email` from `admin` where `id`='1'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getAdminPhoneNumber(){
	$sqlQry=mysql_query("select `contact` from `admin` where `id`='1'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getReviewsNumber(){
	$sqlQry=mysql_query("select count(*) from `reviews` ");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getProgramName($id){
	$sqlQry=mysql_query("select `name` from `programs` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getCenterName($id){
	$sqlQry=mysql_query("select `name` from `centers` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function validateUser($id){
if($id==''){
	header("location:index.php");
}else{
 return true;
}
}

function getEventsStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function geGalleryStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}

function getClientsStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}



function getCategoryStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getTestCategoryStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getSubPhotoStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getColorsStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getSubCategoryStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getTestSubCategoryStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getUserStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}

function sendHtmalMail($subject,$description,$baseurl){
	  $adminMail=getAdminMail();                     						// $from 
 	  $mailList= getMailList();                     // $to -getMailList(); 
	
	 
	 $headers = 'MIME-Version: 1.0' . "\r\n";
	 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headers .= 'From:Synapse Parenting<'.$adminMail.'>' . "\r\n";
     
	 if($mailList[0]!='0'){
		 foreach($mailList as $recipient){
		    $msgBody=getMsgBody($subject,$description,$recipient,$baseurl);
			$mail=@mail($recipient,$subject,$msgBody,$headers);
		    if($mail){
				$receiver[]=$recipient;
				$successFlag=1;
			}else{
			    $successFlag=0;
			}
		 }
	 }
	 
	if($successFlag==1){
		return "Mail successfully send to - "." ".implode(", ",$receiver);
	}else{
		return "Mail not sent successfully !";
	}

 

}
//          ----------------------                 attachment mail  ---------------------------------              ////


/*
			$fileatt_type = $_FILES['docfile']['type']; // File Type
			$fileatt_name = $file1= $_FILES['docfile']['name']; // Filename that will be used for the file as the 
			
			attachment
			$fileatt = "".$Global['BASEPATH']."/testupd/".$fileatt_name; // Path to the file
	
//////////////////////////////////////////////////////////

$file = fopen($fileatt,'rb');
                            $data = fread($file,filesize($fileatt));
                             fclose($file);

							$semi_rand = md5(time());
							$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
							
							$headers .= "\nMIME-Version: 1.0\n" .
							"Content-Type: multipart/mixed;\n" .
							" boundary=\"{$mime_boundary}\"";
							
							$email_message .= "This is a multi-part message in MIME 

format.\n" .
							"--{$mime_boundary}\r\n" .
							"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
							"Content-Transfer-Encoding: 7bit\n\n" .
							$email_message .= "\n\n";
							
							$data = chunk_split(base64_encode($data));
							
							$email_message .= "--{$mime_boundary}\n" .
							"Content-Type: {$fileatt_type};\n" .
							" name=\"{$fileatt_name}\"\n" .
							//"Content-Disposition: attachment;\n" .
							//" filename=\"{$fileatt_name}\"\n" .
							"Content-Transfer-Encoding: base64\n" .
							$data .= "\n\n" .
							"--{$mime_boundary}--\n";
							
							$x=mail($email_to, $email_subject, $email_message, $headers);	*/

///////////////////////////////////////////////////////////////////////////////////////////////

























function getAdminMail(){
	$execQry=mysql_fetch_row(mysql_query("select `email` from `admin` where `id`=1 "));
	return $execQry[0];
}

function getMailList(){
	$selQry=mysql_query("select `email`  from `newsletter` where `status`='1'");
	$numrows=mysql_num_rows($selQry);
	if($numrows>0){
		while($fetch=mysql_fetch_array($selQry)){
		 $mailers[]=$fetch['email'];
		}
	}else{
		$mailers[]=0;
	}
	return $mailers;
}


function getTopFiveNews(){
	$execQry=mysql_query("select * from `news` where `status` = '1' order by `id` desc limit 0,5");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$newsIds[]=$fetch['id'];
		}
	}else{
			$newsIds[]=0;
	}
	return $newsIds;
}


function limitNewsTitle($title){
if(strlen($title)>70){
	$newstitle=substr($title,0,70)."(. . . .)";
}else{
     $newstitle=$title;

}
return $newstitle;
}
function limitNewsContent($Content){
if(strlen($Content)>70){
	$newsContent=substr($Content,0,70)." (...)";
}else{
     $newsContent=$Content;

}
return $newsContent;
}

function getSizeNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `sizes` where `id`='$id' "));
	return $execQry[0];
}
function getColorNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `colors` where `id`='$id' "));
	return $execQry[0];
}

function getNewsDetailById($id){
	$execQry=mysql_fetch_row(mysql_query("select `content` from `news` where `id`='$id' "));
	return $execQry[0];
}
function getNewsDateById($id){
	$execQry=mysql_fetch_row(mysql_query("select `newsdate` from `news` where `id`='$id' "));
	return $execQry[0];
}

function getMainCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `maincategory` where `id`='$id'"));
	return $resultSet[1];
}
function getMainPhotoName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `photo` where `id`='$id'"));
	return $resultSet[1];
}
function getColoumnName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `firstnews` where `id`='$id'"));
	return $resultSet[1];
}
function getbottomMainCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `bottommaincategory` where `id`='$id'"));
	return $resultSet[1];
}

function getCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `category` where `id`='$id'"));
	return $resultSet[1];
}

function getTestCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `testcategory` where `id`='$id'"));
	return $resultSet[1];
}

function getSubCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `subcategory` where `id`='$id'"));
	return $resultSet[2];
}



function getSizesStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getmaincategoryStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getCentersStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}
function getPhotoStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}


function startSession($type,$userid,$password){
 	
	if($type==1){
		$checkqry=mysql_query("select * from `parent` where `email`='$userid' and `password`='$password'");
	}else{
		$checkqry=mysql_query("select * from `student` where `batch_id`='$userid' and `password`='$password'");
	}
	
	if(mysql_num_rows($checkqry)>0)
	{
		 $fetchRes=mysql_fetch_row($checkqry);
		 $uid=$fetchRes[0];
		 $_SESSION['uid']=$uid;
		 $_SESSION['type']=$type;
		 return true;
	}else{
	 	return false;
	}

}

function getNameByIdAndType($id,$type){
if($type==1){
		$checkqry=mysql_query("select `fname` from `parent` where `id`='$id' ");
	}else{
		$checkqry=mysql_query("select `fname` from `student` where `id`='$id'");
	}
	$fetchRes=mysql_fetch_row($checkqry);
	$userName=$fetchRes[0];
	return $userName;
}


function getProgramDetailById($id){

	$execQry=mysql_query("select `name` from `programs` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
}
function getCenterDetailById($id){

	$execQry=mysql_query("select `name` from `centers` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
}
function getTotalParentregistered(){
	$execQry=mysql_query("select count(*) from `parent` ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];


}
function getTotalStudentregistered(){
	$execQry=mysql_query("select count(*) from `student` ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
}
function getTotalUsers(){
$total= getTotalStudentregistered();
return $total;

}


function getDateFormat($date){
	$expdate=explode("-",$date);
	$newdate=$expdate[2]."-".$expdate[1]."-".$expdate[0];
	return $newdate; 

}
function getNewsImg($val){
global $baseurl;
if($val=='1'){
	return "<img src='".$baseurl."/images/new.gif'>";
}

}

function changeDate($date){
$expDate=explode("-",$date);
$newDate=$expDate[2]."-".$expDate[1]."-".$expDate[0];
return $newDate;

}
function getFacultyName($fid){
	$execQry=mysql_query("select `name` from `faculty` where `id`='$fid' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];

}	
function getFirstImage(){
	$execQry=mysql_query("select `imagepath` from `student_gallery` where `status`='1' order by `id` desc limit 0,1 ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];

}
function getStudentName($fid){
	$execQry=mysql_query("select `name` from `student` where `id`='$fid' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];

}
function getBannerById($id){
	$sqlQry=mysql_query("select `imagepath` from `category` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getSubcategoryById($cid){
	$selQry=mysql_query("select `id`  from `subcategory` where `status`='1' and `c_id` = '$cid'");
	$numrows=mysql_num_rows($selQry);
	if($numrows>0){
		while($fetch=mysql_fetch_array($selQry)){
		 $sids[]=$fetch['id'];
		}
	}else{
		$sids[]=0;
	}
	return $sids;
}

function getSubcategoriesforIndex(){
	$selQry=mysql_query("select `id`  from `subcategory` where `status`='1' order by `id` desc limit 0,8 ");
	$numrows=mysql_num_rows($selQry);
	if($numrows>0){
		while($fetch=mysql_fetch_array($selQry)){
		 $sids[]=$fetch['id'];
		}
	}else{
		$sids[]=0;
	}
	return $sids;
}

function getLatestImageByCid($cid){
	$sqlQry=mysql_query("select `imagepath` from `gallery` where `g_id`='$cid' and `status`='1' order by `id` Asc");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
		$fetchQry = mysql_fetch_row($sqlQry);
		$image = $fetchQry[0];
	}else{
		$image=0;
	}
return $image;	
}


function getLatestMainCatImageByid($cid){
	$sqlQry=mysql_query("select `imagepath` from `category` where `m_id`='$cid' and `status`='1' order by `id` Desc limit 0,1");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
		$fetchQry = mysql_fetch_row($sqlQry);
		$image = $fetchQry[0];
	}else{
		$image="noimage.jpg";
	}
return $image;	
}


function getSubcategoryImagesById($cid){
	$selQry=mysql_query("select `imagepath` from `gallery` where `g_id`='$cid' and `status`='1' order by `id` Asc");
	$numrows=mysql_num_rows($selQry);
	if($numrows>0){
		while($fetch=mysql_fetch_array($selQry)){
		 $sids[]=$fetch['imagepath'];
		}
	}else{
		$sids[]=0;
	}
	return $sids;
}
function getProductDetailById($id){
	$sqlQry=mysql_query("select * from `subcategory` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}

function getProductNameById($id){
	$sqlQry=mysql_query("select `name` from `subcategory` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getProductPriceById($id){
	$sqlQry=mysql_query("select `price` from `subcategory` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}


function getSizesByArr($sizeArr){
$expSize=explode(",",$sizeArr);
	foreach($expSize as $size){
		$mainSize[]=getSizeNameById($size);
	}
  return implode(",",$mainSize);	
}
function getColorsByArr($colorArr){
$expColor=explode(",",$colorArr);
	foreach($expColor as $color){
		$mainColor[$color]=getColorNameById($color);
	}
  return $mainColor;	
}

function getSizesArr($sizeArr){
$expSize=explode(",",$sizeArr);
	foreach($expSize as $size){
		$mainSize[]=$size;
	}
  return $mainSize;	
}

function populateData($bag,$userDetail,$uid){
	$date=date("Y-m-d h:i:s");
	$fname=mysql_real_escape_string($userDetail['fname']);
	$lname=mysql_real_escape_string($userDetail['lname']);
	$address=mysql_real_escape_string($userDetail['address']);
	$pin=mysql_real_escape_string($userDetail['pin']);
	$mobile=mysql_real_escape_string($userDetail['mobile']);
	$cartDetail=mysql_real_escape_string($bag);
	$insQry=mysql_query("insert into `user_shop_address` set `u_id`='$uid',`fname`='$fname',`lname`='$lname',`address`='$address',`pin`='$pin' ,`mobile`='$mobile' ,`purchasedate`='$date'");
	if($insQry){
		$ins_id=mysql_insert_id();
		$shopQry=mysql_query("insert into `shoppingcart` set `a_id`='$ins_id',`item`='$cartDetail'");
		if($shopQry){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function getUserDetailById($id){
	$sqlQry=mysql_query("select * from `user` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}

function sendFeedBackMail($name,$email,$contact,$message,$baseurl){
$to =getAdminEmail(); 
$date=date("Y-m-d");
$cemail="excellent.com";
$sub="A New Enquiry  has been received !";
$msg='<head>
	<title>New mail</title>
	<style>
	.mailcontent{
		font-family:Arial, Helvetica, sans-serif;
		font-size:12px;
		padding:5px;
		text-align:justify;
	}
	.verysmalltextblack{
		color:#2C2C2C;
		text-decoration:none;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:10px;
		font-weight:bold;
	}
	</style>
	</head>

<body>
<table width="100%" style="border:solid 1px #666666" cellpadding="10" cellspacing="0" bgcolor="#F0F0F0" >
  <tr  valign="top" bgcolor="#FFFFFF" >
    <td align="left" colspan="2"  valign="middle"><img src="'.$baseurl.'/images/logo.png" alt="MLnews " > </td>
  </tr>
    <tr>
			<td class="mailcontent"><strong>Name  :</strong></td>
			<td class="verysmalltextblack">'.$name.'</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="mailcontent"><strong>Mail :</strong></td>
				<td class="verysmalltextblack">'.$email.'</td>
			 </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="mailcontent"><strong>Contact No :</strong></td>
               <td class="verysmalltextblack">'.$contact.'</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="mailcontent"><strong>Message :</strong></td>
              <td class="verysmalltextblack">'.$message.'</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              
              </tr>
              <tr>
                <td class="mailcontent"><strong>Posted On:</strong></td>
              <td class="verysmalltextblack">'.$date.'</font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
             
			  
</table><body><html>';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: News<'.$cemail.'>' . "\r\n";

	$mail=@mail($to,$sub,$msg,$headers);
	if($mail){
		return true;
	}else{
		return false;
	}


}
function getBannerImage($table){
	$execQry=mysql_query("select * from $table where `status`='1' ORDER BY RAND() LIMIT 0,1 ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;

}
function getStatus($value){
	if($value==1){
		return "Active";
	}
	if($value==0){
		return "Deactive";
	}
}

function getBannerPosition($value){
	if($value==1){
		return "Top Left";
	}
	if($value==2){
		return "Top Right";
	}
	if($value==3){
		return "Left Bottom";
	}
}

function getRandomBannerImage($table,$pos){
	$execQry=mysql_query("select * from $table where `status`='1' and `position`='$pos' ORDER BY RAND() LIMIT 0,1 ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;

}

function getNewsTypeImage($value){
	if($value==2){
		return "<img src='../images/videos.png'>";
	}
	if($value==1){
		return "<img src='../images/camera.jpeg'>";
	}
	if($value==0){
		return "None";
	}
}
function changeHeightWidth($string,$width,$height){
	$patternHeight = "/height=\"[0-9]*\"/";

	$string = preg_replace($patternHeight, "wmode = 'opaque' height='".$height."'", $string);

	$patternWidth = "/width=\"[0-9]*\"/";

	$string = preg_replace($patternWidth, "width='".$width."'", $string);
return $string;

}
function getMainNewsTypeImage($value,$image){
	if($value==2){
	$data=changeHeightWidth(stripslashes($image),80,50);
		return $data;
	}
	if($value==1){
		return "<img src='../photos/$image' width='80px' height='50px' class='imgborder'>";
	}
	if($value==0){
		return "<img src='../images/noimage.jpg' width='80px' height='50px' class='imgborder'>";
	}
}
function getNumberOfRecords($table){
	$execQry=mysql_query("select count(*) from $table where `status`='1'  ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];

}
function getTopNewsByCatId($category){
	$execQry=mysql_query("select * from `category` where `status`='1' and `m_id`='$category' ORDER BY `id` Desc LIMIT 0,1 ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;
}

function getBottomNewsByCatId($category){
	$execQry=mysql_query("select * from `bottomcategory` where `status`='1' and `m_id`='$category' ORDER BY `id` Desc LIMIT 0,1 ");
	$numrow=mysql_num_rows($execQry);
	if($numrow>0){
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;
	}else{
	return false;
	}
}

function getTopNewsByTableId($table){
	$execQry=mysql_query("select * from `$table` where `status`='1'  ORDER BY `position` , `id` Desc LIMIT 0,1 ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;
}



function getNewsDetailByTableNameAndId($table,$id){
	$sqlQry=mysql_query("select * from `$table` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}

function getMainNewsTypeById($id){
	$sqlQry=mysql_query("select `spcl` from `category` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getBottomMainNewsTypeById($id){
	$sqlQry=mysql_query("select `spcl` from `bottomcategory` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getTypeBytableId($table,$id){
	$sqlQry=mysql_query("select `spcl` from $table where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function checkandaddvideoicon($string,$type){
if($type==2){

return stripslashes($string)."  <img src='images/videos.png' border='0'>";
}else{
return stripslashes($string);
}
}

function resize_both($oldname,$width,$height,$border='')

{
if($border==''){
		$border='0';
}
  $imgName=$width."_".$height."_".$oldname;
  $newname = "thumb/". $imgName;
  if(!file_exists($newname)){
  $imgpath=$width."_".$height."_".$oldname;
  $thumbh = $height;
  $thumbw = $width;
  $nh = $thumbh;
  $nw = $thumbw;
  $size = getImageSize("photos/".$oldname);
  $w = $size[0];
  $h = $size[1];
  $img_type  = $size[2];
  // Applying calculations to dimensions of the image
 
  $ratio = $h / $w;
  $nratio = $nh / $nw; 

  if($ratio > $nratio)
  {
    $x = intval($w * $nh / $h);
    if ($x < $nw)
    {
      $nh = intval($h * $nw / $w);
    } 
    else
    {
      $nw = $x;
    }
  }
  else
  {
    $x = intval($h * $nw / $w);
    if ($x < $nh)
    {
      $nw = intval($w * $nh / $h);
    } 
    else
    {
      $nh = $x;
    }
  }  
 switch($img_type) {
          case '1':
          $resimage = imagecreatefromgif("photos/".$oldname);
          break;
          case '2':
          $resimage = imagecreatefromjpeg("photos/".$oldname);
          break;
          case '3':
          $resimage = imagecreatefrompng("photos/".$oldname);
          break;
      }
//  $resimage = imagecreatefromjpeg($oldname); 
	$newimage = imagecreatetruecolor($nw, $nh);  // use alternate function if not installed
	$white = imagecolorallocate($newimage, 255, 255, 255);
	imagefill($newimage,0,0,$white); 
	imagecopyresampled($newimage, $resimage,0,0,0,0,$nw, $nh, $w, $h);
	$viewimage = imagecreatetruecolor($thumbw, $thumbh);
	imagecopy($viewimage, $newimage, 0, 0, 0, 0, $nw, $nh);
	imagejpeg($viewimage, $newname, 85);
	if($border==1)
	{
		return "<img src='thumb/$imgpath' style='padding:6px;'  align='left'   >";
	}else{
		return "<img src='thumb/$imgpath'  hspace='5px'   >";
	}
	}else{
		if($border==1)
		{
			return "<img src='$newname'  style='padding:6px;' align='left'  >";
		}else{
			return "<img src='$newname'  hspace='5px'    >";
	
		}
	}
	
}  

function getTopNewsTypeById($id){
	$sqlQry=mysql_query("select `spcl` from `topstories` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getColoumnistName($id){
	$sqlQry=mysql_query("select `name` from `firstnews` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function html2text($html)
{
    $tags = array (
    0 => '~<h[123][^>]+>~si',
    1 => '~<h[456][^>]+>~si',
    2 => '~<table[^>]+>~si',
    3 => '~<tr[^>]+>~si',
    4 => '~<li[^>]+>~si',
    5 => '~<br[^>]+>~si',
    6 => '~<p[^>]+>~si',
    7 => '~<div[^>]+>~si',
    );
    $html = preg_replace($tags,"\n",$html);
    $html = preg_replace('~</t(d|h)>\s*<t(d|h)[^>]+>~si',' - ',$html);
    $html = preg_replace('~<[^>]+>~s','',$html);
    // reducing spaces
    $html = preg_replace('~ +~s',' ',$html);
    $html = preg_replace('~^\s+~m','',$html);
    $html = preg_replace('~\s+$~m','',$html);
    // reducing newlines
    $html = preg_replace('~\n+~s',"\n",$html);
    return $html;
}
function checkTableHasChild($id){
 $selQry=mysql_query("select `id` from `additionaltable` where `father`='$id' ");
  $numrows=mysql_num_rows($selQry);
	if($numrows>0){
	$fetchRow=mysql_fetch_row($selQry);
		return $fetchRow[0];
	}else{
		return '0';
	}

}
function getChildFromParent($parent){
 $selQry=mysql_query("select `id` from `additionaltable` where `father`='$parent' ");
  $numrows=mysql_num_rows($selQry);
	if($numrows>0){
	$fetchRow = mysql_fetch_row($selQry);
	$childId  = $fetchRow[0];
	$childTable=getChildTableNameBYId($childId);
	}
return  $childTable;
}

function getAdditionalNewsHtml($key){?>
<table width="100%" border="0" cellspacing="4" cellpadding="8">
  
<tr><td>
<div id="mainTableDiv" style="float:left;padding:5px;">
<?php
$selQry=mysql_query("select * from `additionaltable` where `father`='0' and `key`!='$key' and `status`='1' ");
$numrows=mysql_num_rows($selQry);
	if($numrows>0){
	$count=0;
	  while($fetch=mysql_fetch_array($selQry)){
	  $count++;
      $tableId=	$fetch['id'];

	  $checkForChild=checkTableHasChild($tableId);
	  if($checkForChild==0){
	  $haschild=0;
	  ?>
      <div style="float:left;width:250px;padding:5px;">
      <table  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td align="left"><input type="checkbox" name="check<?php echo $count; ?>" id="check<?php echo $count; ?>" value="<?php echo $tableId."##".$haschild; ?>"></td>
			<td align="left" class="blueText" style="font-weight:bold;"><?php echo $fetch['tablename'] ?></td>
		</tr>
       </table>
      </div>  
	  <?php }else{
	  $childTable=$fetch['tablename'];
	  $orgName=$fetch['orgtablename'];
	  $haschild=1;
	  ?>
          <div style="float:left;width:250px;padding:5px;">
      <table  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td align="left"><input type="checkbox" name="check<?php echo $count; ?>" id="check<?php echo $count; ?>" value="<?php echo $tableId."##".$haschild; ?>"></td>
			<td align="left">
            <select name="cat<?php echo $tableId;  ?>"  class="ac-dropdown " style="color:#0066CC;font-weight:bold;font-size:11px;width:180px" >
   			 <option value=""  selected="selected"><?php echo $fetch['tablename']; ?> </option>
             <?php
			 $getOption=mysql_query("select *  from $orgName where `status`='1'");
			 $numChild=mysql_num_rows($getOption);
			 if($numChild>0){
			 while($fetchChild=mysql_fetch_array($getOption)){?>
			 <option value="<?php echo $fetchChild['id']; ?>"  ><?php echo $fetchChild['name']; ?> </option>
			<?php }}else{?>
			<option value="0"  >No Categories  </option>

			 <?php }
			 
			 ?>
             
           </select>
            
            </td>
		</tr>
        </table>
        </div>
	  <?php }
	  
	  }}else{?>
          <div style="float:left;width:200px;">
      <table  border="0" cellspacing="0" cellpadding="2">
	<tr>
			<td colspan="2">No News Section Added Yet</td>
			
		</tr>
        </table>
        </div>
	<?php }?>
   <input type="hidden" name="hidCount" value="<?php echo $count; ?>">
   </div>
    </td></tr>
   
</table>
<?php }

function  getChildTableNameBYId($id){
$sqlQry=mysql_query("select `orgtablename` from `additionaltable` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];

}

function addDatatotables($post,$name,$imagepath,$mid,$description,$spl,$slide,$insid,$tableid,$sdesc){
$hidCount= $post['hidCount'];  // 9#2 
$dataId=$insid."#".$tableid;
$tid=$tableid;
$newtableid=$tableid."#".$mid;
$insQry=mysql_query("insert into `additionalnewstable` set `newsid`='$dataId',`tablesid`='$newtableid',`recdid`='$insid',`tid`='$tid;'");
for($i=0;$i<= $hidCount;$i++){
	if(isset($post['check'.$i])){
		$tables[]=$post['check'.$i];
	}
}


foreach($tables as $tableId){
    $expIds=explode("##",$tableId);
	$pdate=date("F j, Y h:i A ");
	$tableName=getOrgTableNameById($expIds[0]);
	if($expIds[1]==0){
	$tid=$expIds[0];
	    $mid=0;// no parent has 0;
	//echo "insert into `$tableName` set `name`='$name',`status`='1',`imagepath`='$imagepath',`m_id`='$mid',`description`='$description',`spcl`='$spl' ";
		$sqlQry=mysql_query("insert into $tableName set `name`='$name',`status`='1',`imagepath`='$imagepath',`m_id`='$mid',`description`='$description',`spcl`='$spl' ,`pdate`='$pdate' ,`slide`='$slide' ,`sdesc`='$sdesc' ");
		$insrId=mysql_insert_id();
		$insQry=mysql_query("insert into `additionalnewstable` set `newsid`='$dataId',`tablesid`='$tableId',`recdid`='$insrId',`tid`='$tid'");

	
	}else{
	$mid=$post['cat'.$expIds[0]];
	$tableName=getChildFromParent($expIds[0]);
	$newtableId=$expIds[0]."#".$mid;
	$tid=$expIds[0];
	$newTab=$expIds[0]."#".$mid;
	//echo "insert into `$tableName` set `name`='$name',`status`='1',`imagepath`='$imagepath',`m_id`='$mid',`description`='$description',`spcl`='$spl' ";
	$sqlQry=mysql_query("insert into $tableName set `name`='$name',`status`='1',`imagepath`='$imagepath',`m_id`='$mid',`description`='$description',`spcl`='$spl' ,`pdate`='$pdate' ,`slide`='$slide' ,`sdesc`='$sdesc' ");
	$insrecId=mysql_insert_id();
			$insQry=mysql_query("insert into `additionalnewstable` set `newsid`='$dataId',`tablesid`='$newTab',`recdid`='$insrecId',`tid`='$tid'");

	}
	
}

 }

function  getOrgTableNameById($id){
$sqlQry=mysql_query("select `orgtablename` from `additionaltable` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];

}

function  getTableNameById($id){
$sqlQry=mysql_query("select `tablename` from `additionaltable` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];

}

function getColouministTypeById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `sizes` where `id`='$id' "));
	return $execQry[0];
}
function getColouministImageById($id){
	$execQry=mysql_fetch_row(mysql_query("select `imagepath` from `firstnews` where `id`='$id' "));
	return $execQry[0];
}

function fetchColoumnistBanner($gid){

 $selQry=mysql_query("select `imagepath` from `coloumnistbanner` where `g_id`='$gid' order by `id` Desc limit 0,1 ");
  $numrows=mysql_num_rows($selQry);
	if($numrows>0){
	$result=mysql_fetch_row($selQry);
	$fetchRow="<img src='../photos/$result[0]' width='88' height='37'>";
		return $fetchRow;
	}else{
		return "<img src='../photos/addbanner.jpg'>";
	}

}


function CheckColoumnistBanner($gid){

 $selQry=mysql_query("select `imagepath` from `coloumnistbanner` where `g_id`='$gid' order by `id` Desc limit 0,1 ");
  $numrows=mysql_num_rows($selQry);
	if($numrows>0){
	$result=mysql_fetch_row($selQry);
	$fetchRow="<img src='photos/$result[0]' width='659' height='214'>";
		return $fetchRow;
	}else{
		return "";
	}

}


function  getStoryByName($id){
$sqlQry=mysql_query("select `storyby` from `topstories` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];

}

function getSlideName($category){
if($category==0){
return "None";
}else{
	$execQry=mysql_query("select `name` from `photo` where `id`='$category'  ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
	}
	
}



function updateAdditionalNewsHtml($key,$eid){
	$newsId=$eid."#".$key;
	$selQry=mysql_query("select * from `additionalnewstable` where `newsid`='$newsId'");
	$numRows=mysql_num_rows($selQry);
if($numRows>0){
while($fetchRes=mysql_fetch_array($selQry)){
   //$expTabId=explode("#",$fetchRes['tablesid']);
	$tablesIdArr[]=$fetchRes['tablesid'];
}

}else{
	$tablesIdArr[0]='0#0';  // pattern x#y
}

?>
<table width="100%" border="0" cellspacing="4" cellpadding="8">
  
<tr><td>
<div id="mainTableDiv" style="float:left;padding:5px;">
<?php
$selQry=mysql_query("select * from `additionaltable` where `father`='0' and `key`!='$key' and `status`='1' ");
$numrows=mysql_num_rows($selQry);
	if($numrows>0){
	$count=0;
	  while($fetch=mysql_fetch_array($selQry)){
	  $count++;
      $tableId=	$fetch['id'];
       $checkTabId=checktableidinarray($tableId,$tablesIdArr);
	  $checkForChild=checkTableHasChild($tableId);
	  if($checkForChild==0){
	  $haschild=0;
	  ?>
      <div style="float:left;width:250px;padding:5px;">
      <table  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td align="left"><input type="checkbox" <?php if($checkTabId>=0){ ?> checked="checked" <?php } ?> name="check<?php echo $count; ?>" id="check<?php echo $count; ?>" value="<?php echo $tableId."##".$haschild; ?>"></td>
			<td align="left" class="blueText" style="font-weight:bold;"><?php echo $fetch['tablename']; ?></td>
		</tr>
       </table>
      </div>  
	  <?php }else{
	  $childTable=$fetch['tablename'];
	  $orgName=$fetch['orgtablename'];
 	  $checkTabId=checktableidinarray($tableId,$tablesIdArr);
	  $haschild=1;
	  ?>
          <div style="float:left;width:250px;padding:5px;">
      <table  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td align="left"><input type="checkbox"  <?php if($checkTabId>=0){ ?> checked="checked" <?php } ?> name="check<?php echo $count; ?>" id="check<?php echo $count; ?>" value="<?php echo $tableId."##".$haschild; ?>"></td>
			<td align="left">
            <select name="cat<?php echo $tableId;  ?>"  class="ac-dropdown " style="color:#0066CC;font-weight:bold;font-size:11px;width:180px" >
   			 <option value="" ><?php echo $fetch['tablename']; ?> </option>
             <?php
			 $getOption=mysql_query("select *  from $orgName where `status`='1'");
			 $numChild=mysql_num_rows($getOption);
			 if($numChild>0){
			 while($fetchChild=mysql_fetch_array($getOption)){?>
			 <option value="<?php echo $fetchChild['id']; ?>" <?php if($fetchChild['id']==$checkTabId){ ?> selected="selected" <?php } ?> ><?php echo $fetchChild['name']; ?> </option>
			<?php }}else{?>
			<option value="0"  >No Categories  </option>
	 <?php }
			 
			 ?>
             
           </select>
            
            </td>
		</tr>
        </table>
        </div>
	  <?php }
	  
	  }}else{?>
          <div style="float:left;width:200px;">
      <table  border="0" cellspacing="0" cellpadding="2">
	<tr>
			<td colspan="2">No News Section Added Yet</td>
			
		</tr>
        </table>
        </div>
	<?php }?>
   <input type="hidden" name="hidCount" value="<?php echo $count; ?>">
   </div>
    </td></tr>
   
</table>
<?php }
function checktableidinarray($tabid,$tabArr){
$val=-1;
	foreach($tabArr as $table){
	
		$expTable=explode("#",$table);
		$tableidAr=$expTable[0];
	      
		  if($tabid==$tableidAr){
	      	$val= $expTable[1];
			//$sucessFlag
		}
	//exit;	  	
}
		
		return $val;
		
		
}


function updateDatatotables($post,$name,$imagepath,$mid,$description,$spl,$slide,$upid,$tableid){
$hidCount= $post['hidCount'];  // 9#2 
$dataId=$upid."#".$tableid;
$orgTableData=fetchpopulateddata($dataId);  // old table data

for($i=0;$i<= $hidCount;$i++){
	if(isset($post['check'.$i])){
		$tables=explode("#",$post['check'.$i]);
		$newTableData[]=$tables[0];
	}
}

$idsToUpdate=array_intersect($orgTableData,$newTableData);
$idsToDelete=array_diff($orgTableData,$newTableData);
$idsToAdd=array_diff($newTableData,$orgTableData);

	foreach($idsToDelete as $delid){
			if($delid!=$tableid){
			$recID=getRecordId($delid,$dataId);
			$tablename=getOrgTabNameByParentChild($delid);
			//echo "delete from $tablename where `id` ='$recID'";
			$delQry=mysql_query("delete from $tablename where `id` ='$recID'");
			$delQry=mysql_query("delete from `additionalnewstable` where `tid` ='$delid' and `newsid`='$dataId'");
			
			}	
	}
 
 //die;	

foreach($idsToAdd as $addid){
	 $checkForChild=checkTableHasChild($addid);
	  if($checkForChild==0){
	  //no child
	  $mid=0;
	  $tableName=getOrgTableNameById($addid);
	  $adddata=addNewInsertedDatatotables($post,$name,$imagepath,$mid,$description,$spl,$slide,$upid,$addid,$tableName);
	  }else{
	  $mid=$post['cat'.$addid];
	  $tablename=getOrgTabNameByParentChild($addid);
	    $adddata=addNewInsertedDatatotables($post,$name,$imagepath,$mid,$description,$spl,$slide,$upid,$addid,$tableName);
	  }
}





 }

function fetchpopulateddata($newsid){

$selQry=mysql_query("select * from `additionalnewstable` where `newsid`='$newsid' ");
  $numrows=mysql_num_rows($selQry);
	if($numrows>0){
		while($fetch=mysql_fetch_array($selQry)){
		 	$sids=explode("#",$fetch['tablesid']);
		 	$tableIds[]=$sids[0];
		}}else{
		$tableIds[0]=0;
	}
return	$tableIds;
}

function getRecordId($delid,$dataId){
$selQry=mysql_fetch_row(mysql_query("select `recdid` from `additionalnewstable` where `newsid`='$dataId' and `tid`='$delid' "));
return $selQry[0];


}

function getOrgTabNameByParentChild($id){

$chkChild=checkTableHasChild($id);
if($chkChild){
	$tablename=getChildFromParent($id);
	return $tablename;
}else{
	$selQry=mysql_query("select `orgtablename` ,`father` from `additionaltable` where `id`='$id'  ");
	$fetchRow=mysql_fetch_row($selQry);
	return $fetchRow[0];
}



}

function addNewInsertedDatatotables($post,$name,$imagepath,$mid,$description,$spl,$slide,$insid,$tableid,$tablename){
//$hidCount= $post['hidCount'];  // 9#2 
$dataId=$insid."#".$tableid;
$tid=$tableid;
//$newtableid=$tableid."#".$mid;
$pdate=date("F j, Y h:i A ");

//$insQry=mysql_query("insert into `additionalnewstable` set `newsid`='$dataId',`tablesid`='$newtableid',`recdid`='$insid',`tid`='$tid;'");
$sqlQry=mysql_query("insert into $tableName set `name`='$name',`status`='1',`imagepath`='$imagepath',`m_id`='$mid',`description`='$description',`spcl`='$spl' ,`pdate`='$pdate' ,`slide`='$slide' ");
$indIdd=mysql_insert_id();
$insQry=mysql_query("insert into `additionalnewstable` set `newsid`='$dataId',`tablesid`='$newtableid',`recdid`='$indIdd',`tid`='$tableid;'");
}
?>