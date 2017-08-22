<?php
include_once("global.php");
$baseurl=$Global['baseurl'];
include_once('class.phpmailer.php');
function getSiteTitle(){
	$sqlQry=mysql_query("select `site_name` from `generalsettings` where `id`='1'");
	$fetchQry=mysql_fetch_row($sqlQry);
	echo stripslashes($fetchQry[0]);
}
function getFoodCategoryName($id){
    $sqlQry=mysql_query("select `titles` from `ppac_category` where `id`=$id");
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


function getStateNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `state` where `id`='$id'"));
	return $resultSet[1];
}

function getServiceNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `services` where `id`='$id'"));
	return $resultSet[3];
}

function getSubServiceDetailById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `subservices` where `id`='$id'"));
	return $resultSet;
}

function getAssignmentsNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `assignment` where `id`='$id'"));
	return $resultSet[1];
}

function getSubAssignmentsNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `subassignments` where `id`='$id'"));
	return $resultSet[1];
}

function getSubSubAssignmentsNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `subsubassignments` where `id`='$id'"));
	return $resultSet[1];
}

function getLocationNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `locations` where `id`='$id'"));
	return $resultSet[1];
}


function getDurationNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `duration` where `id`='$id'"));
	return $resultSet[1];
}
function getCityNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `cities` where `city_id`='$id'"));
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

function getAdminKey($aid){
	$sqlQry=mysql_query("select `skey` from `admin` where `id`='$aid'");
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

function getUniversityNameById($id){
	$sqlQry=mysql_query("select `name` from `university` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getCollegeNameById($id){
	$sqlQry=mysql_query("select `name` from `login` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getFacultyEmailById($id){
	$sqlQry=mysql_query("select `username` from `login` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getCourseNameById($id){
	$sqlQry=mysql_query("select `name` from `collegecourses` where `id`='$id'");
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
		return '<span class="label label-sucess">Approved</span>';
	}
	if($value==0){
		return '<span class="label label-danger">Blocked</span>';
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

function getMenuNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `category` from `menucategory` where `id`='$id' "));
	return $execQry[0];
}

function getColorNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `colors` where `id`='$id' "));
	return $execQry[0];
}

function getNewsDetailById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `mainnews` where `id`='$id' and `status`='1' "));
	return $execQry;
}

function getSectionNewsDetailById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `stories` where `id`='$id' "));
	return $execQry;
}

function getNewsTitleDetailById($id,$table){
   if($table==0){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `mainnews` where `id`='$id' and `status`='1' "));
	}
	else{
	$execQry=mysql_fetch_row(mysql_query("select `name` from `stories` where `id`='$id' "));
	}
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

function getCategoryNameByChildIds($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `additionaltable` where `id`='$id'"));
	return $resultSet[1];
}

function getCategoryNameByKey($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `additionaltable` where `key`='$id'"));
	return $resultSet[1];
}


function getCategoryContentByChildIds($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `additionaltable` where `key`='$id'"));
	return $resultSet[6];
}

function getSectionNameByChildIds($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `colors` where `id`='$id'"));
	return $resultSet[1];
}
function getSectionContentByChildIds($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `colors` where `id`='$id'"));
	return $resultSet[3];
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

function getSectionNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select `name` from `colors` where `id`='$id'"));
	return $resultSet[0];
}
function getbottomCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `bottomcategory` where `id`='$id'"));
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
$expDate=explode("/",$date);
$newDate=$expDate[2]."-".$expDate[1]."-".$expDate[0];
return $newDate;
}
function revertDate($date){
	$expDate=explode("-",$date);
	$newDate=$expDate[2]."/".$expDate[1]."/".$expDate[0];
	return $newDate;
}

function changeToStdDate($date){
$expDate=explode("-",$date);
$monthText=getShortMonth($expDate[1]-1);
$newDate=$expDate[2]." ".$monthText.", ".$expDate[0];
return $newDate;
}


function getMonth($val){
$monthArr=array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
return $monthArr[$val];
}
function getShortMonth($val){
$monthArr=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
return $monthArr[$val];
}

function getSrtMonth(){
$monthArr=array("01","02","03","04","05","06","07","08","09","10","11","12");
return $monthArr;
}

function displayMonth($val){
$monthRange=range("January","December");
echo $monthRange[2];
//echo $val;
$month=array();
$month[0]="";
$month[01]="January";
$month[02]="Febuary";
$month[03]="March";
$month[04]="April";
$month[05]="May";
$month[06]="June";
$month[07]="July";
$month[08]="August";
$month[09]="September";
$month[10]="October";
$month[11]="November";
$month[12]="Decembar";
//echo $month[06];
 $monthv=$month[$val];
return $monthv;


}


function getDates($date){
$expDate=explode("-",$date);
$dates= getMonth($expDate[1]-1)." ".$expDate[2];
return $dates;
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

function getLatestPhotogalleryImageByid($cid){
	$sqlQry=mysql_query("select `imagepath` from `subphotogallery` where `c_id`='$cid' and `status`='1' order by `id` Desc limit 0,1");
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

function getUserNameById($id){
	$sqlQry=mysql_query("select `name` from `user` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}


function sendFeedBackMail($name,$email,$contact,$message,$baseurl){
$to="sagarallahabad@gmail.com"; 
$date=date("Y-m-d");
$cemail="thefootballlink.com";
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
    <td align="left" colspan="2"  valign="middle"><img src="'.$baseurl.'/images/logo.png" alt="TFL " > </td>
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
		return '<span class="label label-success">Approved</span>';
	}
	if($value==0){
		return '<span class="label label-danger">Blocked</span>';
	}
}

function getPriceStatus($value){
	if($value==1){
		return '<span class="label label-success">Active Level</span>';
	}
	if($value==0){
		return '<span class="label label-danger">Inactive Level</span>';
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



function getTopCategoryNewsByCatId($category,$table){
	$execQry=mysql_query("select * from `mainnewstable` where  `status`='1' and `parentid`='$table' and `childid`='$category' order by `position` , `id` Desc limit 0,1 ");
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

function getTopBottomNewsByCatId($parentid,$childid){
	$execQry=mysql_query("select * from `mainnewstable` where `status`='1' and `parentid`='$parentid' and `childid`='$childid' ORDER BY `position` ,`id` Desc LIMIT 0,1 ");
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

function resize_both($oldname,$width,$height,$padding='0')

{

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
	if($padding==1)
	{
		return "<img src='thumb/$imgpath' style='padding:0px 10px 5px 0px ;'  align='left'  >";
	}else{
		return "<img src='thumb/$imgpath'  align='left'   >";
	}
	}else{
		if($padding==1)
		{
			return "<img src='$newname'  style='padding:0px 10px 5px 0px;' align='left'   >";
		}else{
			return "<img src='$newname'   align='left'   >";
	
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

function getAdditionalNewsHtml(){?>
<table width="100%" border="0" cellspacing="4" cellpadding="8">
  
<tr><td>
<div id="mainTableDiv" style="float:left;padding:5px;">
<?php
$selQry=mysql_query("select * from `additionaltable` where `father`='0'  and `status`='1' ");
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
			<td align="left"><input type="checkbox" onclick="setValue(''.$count; ?>','<?php echo $tableId; ?>','0')" name="check<?php echo $count; ?>" id="check<?php echo $count; ?>" value="0"></td>
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
			<td align="left"><input type="checkbox" name="check<?php echo $count; ?>"  id="check<?php echo $count; ?>" value="0"></td>
			<td align="left">
            <select name="cat<?php echo $tableId;  ?>"  id="cat<?php echo $tableId;  ?>" class="ac-dropdown " onchange="setChildValue('<?php echo $count; ?>','<?php echo $tableId; ?>',document.getElementById('cat<?php echo $tableId;  ?>').value)" style="color:#0066CC;font-weight:bold;font-size:11px;width:180px" >
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

function insertDatatotables($post,$insId){
	$hidCount= $post['hidCount'];  // 9#2 
	for($i=0;$i<= $hidCount;$i++){
		if(isset($post['check'.$i])){
			$tableValue=explode("##",$post['check'.$i]);
			$parentId=$tableValue[0];
			$childId=$tableValue[1];
			$insQry=mysql_query("insert into `mainnewstable` set `newsid`='$insId',`parentid`='$parentId',`childid`='$childId',`position`='1',`status`='1'");
				if($insQry){
					//$addchildtable=adddataintochildtable($insId,$parentId,$childId);	
				}
		}
	}

}
function updateData($post,$insId){
			$insQry=mysql_query("delete from `mainnewstable` where `newsid`='$insId'");

	$hidCount= $post['hidCount'];  // 9#2 
	for($i=0;$i<= $hidCount;$i++){
		if(isset($post['check'.$i])){
			$tableValue=explode("##",$post['check'.$i]);
			$parentId=$tableValue[0];
			$childId=$tableValue[1];
			$insQry=mysql_query("insert into `mainnewstable` set `newsid`='$insId',`parentid`='$parentId',`childid`='$childId',`position`='1'");
				if($insQry){
					//$addchildtable=adddataintochildtable($insId,$parentId,$childId);	
				}
		}
	}

}
function adddataintochildtable($insId,$parentId,$childId){
if($childId==0){
	$childId=$parentId;
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

function updateMainNews($eid){
$mainCatArr =   array();
$subMainCatArr =  array();
$getQry=mysql_query("select * from `mainnewstable` where `newsid`='$eid'");
$numQry=mysql_num_rows($getQry);
if($numQry>0){
		while($fetch=mysql_fetch_array($getQry)){
		$parentId=$fetch['parentid'];
		$childId=$fetch['childid'];
		if($parentId==0){
			$mainCatArr[]=$childId;
		}else{
			$subMainCatArr[]=$parentId;
		}
		
		 	//$nids=$fetch['id'];
		 	
		}}else{
		$nids[0]=0;
}


?>
<table width="100%" border="0" cellspacing="4" cellpadding="8">
  
<tr><td>
<div id="mainTableDiv" style="float:left;padding:5px;">
<?php
$selQry=mysql_query("select * from `additionaltable` where `father`='0'  and `status`='1' ");
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
			<td align="left"><input <?php if(in_array($tableId,$mainCatArr)){ ?> checked="checked" <?php }?> type="checkbox" onclick="updateValue('<?php echo $count; ?>','<?php echo $tableId; ?>','0')" name="check<?php echo $count; ?>" id="check<?php echo $count; ?>" value="0##<?php echo $tableId; ?>"></td>
			<td align="left" class="blueText" style="font-weight:bold;"><?php echo $fetch['tablename'] ?></td>
		</tr>
       </table>
      </div>  
	  <?php }else{
	  $childTable=$fetch['tablename'];
	  $orgName=$fetch['orgtablename'];
	  $haschild=1;
	  $selsQry=mysql_fetch_row(mysql_query("select `childid` from `mainnewstable` where `newsid`='$eid' and `parentid`='$tableId'"));
      $subCatId=$selsQry[0];
	  
	  ?>
          <div style="float:left;width:250px;padding:5px;">
      <table  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td align="left"><input type="checkbox"  <?php if(in_array($tableId,$subMainCatArr)){ ?> checked="checked" <?php }?> name="check<?php echo $count; ?>"  id="check<?php echo $count; ?>" value="<?php echo $tableId;  ?>##<?php echo $subCatId; ?>"></td>
			<td align="left">
            <select name="cat<?php echo $tableId;  ?>"  id="cat<?php echo $tableId;  ?>" class="ac-dropdown " onchange="setChildValue('<?php echo $count; ?>','<?php echo $tableId; ?>',document.getElementById('cat<?php echo $tableId;  ?>').value)" style="color:#0066CC;font-weight:bold;font-size:11px;width:180px" >
   			 <option value=""  selected="selected"><?php echo $fetch['tablename']; ?> </option>
             <?php
			 $getOption=mysql_query("select *  from $orgName where `status`='1'");
			 $numChild=mysql_num_rows($getOption);
			 if($numChild>0){
			 while($fetchChild=mysql_fetch_array($getOption)){?>
			 <option value="<?php echo $fetchChild['id']; ?>" <?php if($subCatId==$fetchChild['id']) { ?> selected="selected" <?php }?>  ><?php echo $fetchChild['name']; ?> </option>
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

function selectTopNewsByChildId($cid){
 $selQry=mysql_query("select * from `mainnewstable` where `status` = '1' and `parentid`='0' and `childid`='$cid' order by `position` ,`id` desc limit 0,1");
  $numrows=mysql_num_rows($selQry);
	if($numrows>0){
	$result=mysql_fetch_row($selQry);
		return $result[1];
	}else{
		return false;
	}

}


function selectTop4NewsByChildId($cid,$num=4){
 $selQry=mysql_query("select * from `mainnewstable` where `status` = '1' and `parentid`='0' and `childid`='$cid' order by `position` ,`id` desc limit 1,$num");
  $numrows=mysql_num_rows($selQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($selQry)){
	$nids[]=$fetch[1];
	}}else{
	$nids[0]=0;	
		
	}
return $nids;
}

function getSocialImage($uid,$type){
if($type==1){return  "../images/ball.png";}
if($type==2){ return  getGoogleImage($uid);}
if($type==''){return  "../images/ball.png";}
if($type==3){ return  getFbImage($uid);}

}

function  getGoogleImage($id){
//echo "select `google_picture_link` from `google_users` where `google_id`='$id'";
$sqlQry=mysql_query("select `google_picture_link` from `google_users` where `google_id`= $id ");
	$fetchQry=mysql_fetch_row($sqlQry);
	echo $fetchQry[0];

}
function  getFbImage($id){
//echo "select `google_picture_link` from `google_users` where `google_id`='$id'";
$sqlQry=mysql_query("select `photo` from `fb_users` where `uid`=$id");
	$fetchQry=mysql_fetch_row($sqlQry);
	echo $fetchQry[0];

}

function getPhotoGalleryCategoryName($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `photogallery` where `id`='$id'"));
	return $resultSet[1];
}

function getGoogleName($uid){
$sqlQry=mysql_query("select `google_name` from `google_users` where `google_id`=$uid");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function sendBasicMail($to,$from,$fromname,$subject,$msg){

	$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer();
		$mail->IsSMTP();                                      // Set mailer to use SMTP
		
		$mail->IsHTML(true);
		$mail->From = $from;
		$mail->FromName =$fromname;
		$mail->SMTPAuth = false;
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}


function sendSmtpMail($to,$from,$fromname,$subject,$msg,$smtphost,$smtpusername,$smtppassword){

	$headers = 'MIME-Version: 1.0 \r\n'.
		'Content-type: text/html \r\n'.
		'X-Mailer: PHP/' . phpversion();
		$mail = new PHPMailer();
		$mail->IsSMTP();                                      // Set mailer to use SMTP
		
		$mail->IsHTML(true);
		$mail->From = $from;
		$mail->FromName =$fromname;
		
		$mail->SMTPAuth = true;
		$mail->Host = $smtphost;  // specify main and backup server
		$mail->Username = $smtpusername;  // SMTP username
		$mail->Password = $smtppassword; // SMTP password
		
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail=$mail->Send();
		if($mail){
		return true;
		}else{
		return false;
		}
}


function getCurentUrlFromScriptName($file){
$break = explode('/', $file);
$pfile = $break[count($break) - 1]; 
$sqlQry=mysql_query("select `c_id` from `menusubcategory` where `link`='$pfile'");
$numRows=mysql_num_rows($sqlQry);
if($numRows==0){
	return '0';
}else{
	$resultSet=mysql_fetch_row(mysql_query("select `c_id` from `menusubcategory` where `link`='$pfile'"));
	return $resultSet[0];
}
//return $pfile;
}

function getAdminNameById($id){

	$execQry=mysql_query("select `username` from `admin` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
}

function getAdminLastLoginById($id){

	$execQry=mysql_query("select `last_login` from `admin` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
}
function getRoleNameById($id){

	$execQry=mysql_query("select `name` from `roles` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
}
function getRightsById($aid){
$execQry=mysql_query("select * from `rights` where `role_id` = '$aid'");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$rightsid[]=$fetch['menu_id'];
		}
	}else{
			$rightsid[]=0;
	}
	return $rightsid;

}


function getadminRightsById($aid){
$execQry=mysql_query("select * from `adminrights` where `a_id` = '$aid'");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$rightsid[]=$fetch['menu_id'];
		}
	}else{
			$rightsid[]=0;
	}
	return $rightsid;

}
function getMainMenus(){
$execQry=mysql_query("select * from `menucategory`");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$workshopIds[]=$fetch['id'];
		}
	}else{
			$workshopIds[]=0;
	}
	return $workshopIds;

}





function getTotalCollegePhotos($id){
	$execQry=mysql_query("select count(*) from `collegephotos` where `c_id` = '$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	if($fetchRes[0]==0){
	return '(0)';
	}else{
	return  "(".$fetchRes[0].")";
	}


}
function getTotalCollegeVIdeos($id){
	$execQry=mysql_query("select count(*) from `collegevideos` where `u_id` ='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
if($fetchRes[0]==0){
return '(0)';
	}else{
return  "(".$fetchRes[0].")";
	}
}

function verifySchoolDataExists($id){
	$sqlQry=mysql_query("select count(*) from `schools` where `c_id`='$id' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	if($fetchQry[0]=='0'){
	return false; 
	}else{
	return true;
	}
}

function  activationText($email,$id,$baseurl){
	
$unText=" <a href ='".$baseurl."/activate.php?id=".base64_encode($id)."'>Activate My Verisumed Account</a> ";
$msg='<head>
	<title>New mail</title>
	</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#0193de">
  <tr>
    <td   style="color:#FFFFFF;font-size:28px;font-weight:bold;" height="50px" align="center" valign="middle"><b>V</b>erisumed</td>
  </tr>
  <tr style="background-color:#FFFFFF">
    <td align="left"  style="color:#000;font-size:14px;font-style:italic;background:#FFF">Hi, ' .$email. '! Thanks a lot for registering at Verisumed.Plaese click the below link to activate your account</td>
  </tr>
   <tr>
    <td align="left"  style="color:#000;font-size:14px;font-style:italic;background:#FFF">'.$unText.'</td>
  </tr>
</table><body><html>';
return $msg;
}

function getCandidateProfileInfo($uid){
	$execQry=mysql_query("select * from `candidate` where `u_id`='$uid' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;

}
function getCandidateWorkInfo($uid){
	$execQry=mysql_query("select * from `candidatework` where `u_id`='$uid' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;
}

function getCandidateCourseInfo($uid){
	$execQry=mysql_query("select * from `candidatecourse` where `u_id` = '$uid'");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$workshopIds[]=$fetch['id'];
		}
	}else{
			$workshopIds[0]=0;
	}
return $workshopIds;
}



function getCandidateId($id){
	$execQry=mysql_query("select `name` from `identity` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];

}

function getCandidateIndustry($id){
	$execQry=mysql_query("select `name` from `industry` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];

}
function getCollegeIdByFacultyEmail($id){
	$execQry=mysql_query("select `c_id` from `collegefaculty` where `email`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];

}
function getGender($value){
if($value==1)return"Male";
if($value==2)return"Female";

}

function getCollgCourInfo($uid){
	$execQry=mysql_query("select * from `candidatecourse` where `id`='$uid' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;
}
function getCandidatePersonalDetail($uid){
	$execQry=mysql_query("select * from `candidate` where `u_id`='$uid' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;
}

function getCandidateWorkDetail($uid){
	$execQry=mysql_query("select * from `candidatework` where `u_id`='$uid' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes;
}

function getUserImageById($id){
	$sqlQry=mysql_query("select `imagepath` from `candidatephoto` where `u_id`='$id'");
	$numRows=mysql_num_rows($sqlQry);
	if($numRows>0){
		$fetchQry=mysql_fetch_row($sqlQry);
		return $fetchQry[0];
	}else{
		return "user-img.png";
	}
	//return $fetchQry[0];
}
function getFacultyImageById($email){
//echo "select `imagepath` from `collegefaculty` where `email`='$email'";
	$sqlQry=mysql_query("select `imagepath` from `collegefaculty` where `email`='$email'");
	$numRows=mysql_num_rows($sqlQry);
	if($numRows>0){
		$fetchQry=mysql_fetch_row($sqlQry);
		return $fetchQry[0];
	}else{
		return "user-img.png";
	}
	//return $fetchQry[0];
}
function getInstituteImageById($id){
	$sqlQry=mysql_query("select `imagepath` from `collegelogos` where `c_id`='$id'");
	$numRows=mysql_num_rows($sqlQry);
	if($numRows>0){
		$fetchQry=mysql_fetch_row($sqlQry);
		return $fetchQry[0];
	}else{
		return "noins.png";
	}
	//return $fetchQry[0];
}

function checkCandidatePersonelRecord($id){
	$execQry=mysql_query("select count(*) from `candidate` where `u_id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	if( $fetchRes[0]=='0'){
		return false;
	}else{
		return true;
	}

}

function checkCandidateWorkRecord($id){
	$execQry=mysql_query("select count(*) from `candidatework` where `u_id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	if( $fetchRes[0]=='0'){
		return false;
	}else{
		return true;
	}

}

function checkCandidateCourseRecord($id){
	$execQry=mysql_query("select count(*) from `candidatecourse` where `u_id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	if( $fetchRes[0]=='0'){
		return false;
	}else{
		return true;
	}

}



function byte_convert($size) {
  
  if ($size < 1024) return $size . ' Byte';
  
  if ($size < 1048576) return sprintf("%4.2f KB", $size/1024);
  
  if ($size < 1073741824) return sprintf("%4.2f MB", $size/1048576);

  if ($size < 1099511627776) return sprintf("%4.2f GB", $size/1073741824);
 
  else return sprintf("%4.2f TB", $size/1073741824);
}

function getCandidateHtml($uid){
$personalDetail=getCandidatePersonalDetail($uid);

$personalWorkDetail=getCandidateWorkDetail($uid);

$html='<div style="width:100%;padding:2px" id="personalviewdiv">
              <table width="95%" border="0" cellspacing="1" cellpadding="2" >
			  <tr><td colspan="3" align="left" style="color:#3aa4dc"><b>Personal Details</b></td></tr>
			       <tr><td colspan="3" height="5px">............................................................................................................................</td></tr>

  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Gender</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Contact Number</span></td>
    <td align="left">&nbsp;</td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'.getGender($personalDetail[1]).'</td>
    <td align="left"  class="profilt-content">'.stripslashes($personalDetail[2]).'</td>
    <td align="left">&nbsp;</td>
  </tr>
    <tr><td colspan="3" height="5px"></td></tr>

  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Identity</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Id Number</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Date of Birth</span></td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'.getCandidateId($personalDetail[4]).'</td>
    <td align="left"  class="profilt-content">'.stripslashes($personalDetail[5]).'</td>
    <td align="left" class="profilt-content">'. stripslashes($personalDetail[3]).'</td>
  </tr>
  <tr><td colspan="3" height="5px"></td></tr>

  <tr>
    <td align="left" colspan="3" class="profile-title"><span class="bdrBtm">Address Current</span></td>
  
  </tr>
   <tr>
 
    <td colspan="3" align="left" class="profilt-content">'. stripslashes($personalDetail[6]).'</td>
  </tr>
  <tr><td colspan="3" height="5px"></td></tr>

  <tr>
    <td align="left" colspan="3" class="profile-title"><span class="bdrBtm">Address Permanent</span></td>
  
  </tr>
  <tr><td colspan="3" height="5px"></td></tr>
   <tr>
 
    <td colspan="3" align="left" class="profilt-content">'. stripslashes($personalDetail[7]).'</td>
  </tr>
  

</table>';
			  
$html.='<table width="95%" border="0" cellspacing="1" cellpadding="2"  >
    <tr><td colspan="3" align="left" style="color:#3aa4dc"><b>Work Details</b></td></tr>
			       <tr><td colspan="3" height="5px">............................................................................................................................</td></tr>
  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Industry</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Work Experience</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Function</span></td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'. getCandidateIndustry($personalWorkDetail[1]).'</td>
    <td align="left"  class="profilt-content">'.$personalWorkDetail[2].'</td>
    <td align="left" class="profilt-content">'. $personalWorkDetail[3].'</td>
  </tr>

    <tr><td colspan="3" height="5px"></td></tr>
  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Key Skills</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Salary</span></td>
    <td align="left">&nbsp;</td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'.$personalWorkDetail[5].'</td>
    <td align="left"  class="profilt-content">'. $personalWorkDetail[4].'</td>
    <td align="left">&nbsp;</td>
  </tr>
  
  <tr><td colspan="3" height="5px"></td></tr>

  <tr>
    <td align="left" colspan="3" class="profile-title"><span class="bdrBtm">Video Resume (Url)</span></td>
  
  </tr>
   <tr>
 
    <td colspan="3" align="left" class="profilt-content">'. $personalWorkDetail[7].'</td>
  </tr>
</table></div>';

			  
	$html.='<table width="98%" border="0" cellspacing="1" cellpadding="1"   >
  
    <tr><td colspan="6" height="25px"></td></tr>

    <tr><td colspan="6" align="left" style="color:#3aa4dc"><b>Education Details</b></td></tr>
    <tr><td colspan="6" height="5px"></td></tr>

  <tr style="background-color:#3aa4dc;color:#FFFFFF;height:40px;">
    <td align="left" style="width:30px;"><div class="alertmessage" style="color:#FFFFFF;">S.no</div></td>
    <td align="left"  style="width:150px;"><div class="alertmessage" style="color:#FFFFFF;">University</div></td>
    <td align="left"><div class="alertmessage" style="color:#FFFFFF;">College</div></td>
    <td align="center" style="width:100px;"><div class="alertmessage" style="color:#FFFFFF;">Course</div></td>
    <td align="center" style="width:120px;"><div class="alertmessage" style="color:#FFFFFF;">Passing Year</div></td>
    <td align="center" style="width:150px;"><div class="alertmessage" style="color:#FFFFFF;">Percent %</div></td>    
  </tr>';
 
 $count=0;
 	$execQry=mysql_query("select * from `candidatecourse` where `u_id` = '$uid'");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
		$count++;
$html.='<tr style="background-color:#FFFFFF;height:60px">
<td align="center">'.$count.'</td>
<td >'.getUniversityNameById($fetch['university']).'</td>
<td align="left">'.getCollegeNameById($fetch['college']).'</td>
<td align="center">'.getCourseNameById($fetch['course']).'</td>
<td align="center">'.$fetch['year'].'</td>
<td align="center">'.$fetch['marks'].'</td>
  </tr>';
    
        
        	
	 }
	}
 
 
  
  
  $html.='</table></div>';			  
			  
return $html;
}
function getCandidateViewHtml($uid){
$personalDetail=getCandidatePersonalDetail($uid);

$personalWorkDetail=getCandidateWorkDetail($uid);

$html='<div style="width:100%;padding:2px" id="personalviewdiv">
              <table width="95%" border="0" cellspacing="1" cellpadding="2" >
			  <tr><td colspan="3" align="left" style="color:#3aa4dc"><b>Personal Details</b></td></tr>
			       

  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Gender</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Contact Number</span></td>
    <td align="left">&nbsp;</td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'.getGender($personalDetail[1]).'</td>
    <td align="left"  class="profilt-content">'.stripslashes($personalDetail[2]).'</td>
    <td align="left">&nbsp;</td>
  </tr>
    <tr><td colspan="3" height="15px"></td></tr>

  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Identity</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Id Number</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Date of Birth</span></td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'.getCandidateId($personalDetail[4]).'</td>
    <td align="left"  class="profilt-content">'.stripslashes($personalDetail[5]).'</td>
    <td align="left" class="profilt-content">'. stripslashes($personalDetail[3]).'</td>
  </tr>
  <tr><td colspan="3" height="15px"></td></tr>

  <tr>
    <td align="left" colspan="3" class="profile-title"><span class="bdrBtm">Address Current</span></td>
  
  </tr>
   <tr>
 
    <td colspan="3" align="left" class="profilt-content">'. stripslashes($personalDetail[6]).'</td>
  </tr>
  <tr><td colspan="3" height="15px"></td></tr>

  <tr>
    <td align="left" colspan="3" class="profile-title"><span class="bdrBtm">Address Permanent</span></td>
  
  </tr>
  <tr><td colspan="3" height="15px"></td></tr>
   <tr>
 
    <td colspan="3" align="left" class="profilt-content">'. stripslashes($personalDetail[7]).'</td>
  </tr>
    <tr><td colspan="3" height="25px"></td></tr>


</table>';
			  
$html.='<table width="95%" border="0" cellspacing="1" cellpadding="2"  >
    <tr><td colspan="3" align="left" style="color:#3aa4dc"><b>Work Details</b></td></tr>
			      
  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Industry</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Work Experience</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Function</span></td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'. getCandidateIndustry($personalWorkDetail[1]).'</td>
    <td align="left"  class="profilt-content">'.$personalWorkDetail[2].'</td>
    <td align="left" class="profilt-content">'. $personalWorkDetail[3].'</td>
  </tr>

    <tr><td colspan="3" height="15px"></td></tr>
  <tr>
    <td align="left" class="profile-title"><span class="bdrBtm">Key Skills</span></td>
    <td align="left" class="profile-title"><span class="bdrBtm">Salary</span></td>
    <td align="left">&nbsp;</td>
  </tr>
   <tr>
    <td align="left"  class="profilt-content">'.$personalWorkDetail[5].'</td>
    <td align="left"  class="profilt-content">'. $personalWorkDetail[4].'</td>
    <td align="left">&nbsp;</td>
  </tr>
  
  <tr><td colspan="3" height="15px"></td></tr>

  <tr>
    <td align="left" colspan="3" class="profile-title"><span class="bdrBtm">Video Resume (Url)</span></td>
  
  </tr>
   <tr>
 
    <td colspan="3" align="left" class="profilt-content">'. $personalWorkDetail[7].'</td>
  </tr>
</table>';			  
			  
$html.='<table width="98%" border="0" cellspacing="1" cellpadding="1"   >
  
    <tr><td colspan="6" height="25px"></td></tr>

    <tr><td colspan="6" align="left" style="color:#3aa4dc"><b>Education Details</b></td></tr>
    <tr><td colspan="6" height="5px"></td></tr>

  <tr style="background-color:#3aa4dc;color:#FFFFFF;height:40px;">
    <td align="left" style="width:30px;"><div class="alertmessage" style="color:#FFFFFF;">S.no</div></td>
    <td align="left"  style="width:150px;"><div class="alertmessage" style="color:#FFFFFF;">University</div></td>
    <td align="left"><div class="alertmessage" style="color:#FFFFFF;">College</div></td>
    <td align="center" style="width:100px;"><div class="alertmessage" style="color:#FFFFFF;">Course</div></td>
    <td align="center" style="width:120px;"><div class="alertmessage" style="color:#FFFFFF;">Passing Year</div></td>
    <td align="center" style="width:150px;"><div class="alertmessage" style="color:#FFFFFF;">Percent %</div></td>    
  </tr>';
 
 $count=0;
 	$execQry=mysql_query("select * from `candidatecourse` where `u_id` = '$uid'");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
		$count++;
$html.='<tr style="background-color:#FFFFFF;height:60px">
<td align="center">'.$count.'</td>
<td >'.getUniversityNameById($fetch['university']).'</td>
<td align="left">'.getCollegeNameById($fetch['college']).'</td>
<td align="center">'.getCourseNameById($fetch['course']).'</td>
<td align="center">'.$fetch['year'].'</td>
<td align="center">'.$fetch['marks'].'</td>
  </tr>';
    
        
        	
	 }
	}
 
 
  
  
  $html.='</div></table>';			  
return $html;
}

function getProfilePercent($uid,$table){
$count=0;
	$execQry=mysql_query("select * from $table where `u_id`='$uid' ");
	$result=mysql_num_fields($execQry);
	 $numrow=mysql_num_rows($execQry);
	$fetchRes=mysql_fetch_row($execQry);
	
	if($numrow>0){
		for($i=0;$i<$result;$i++){
		    if($fetchRes[$i]==''){
			   $count++;
			}
		}
	$total=$result-$count;	
	$totalpercent=floor(($total/$result)*100);	
		
	}else{
		$totalpercent=0;
	}
	return $totalpercent;
}



function getEducationPercent($uid){
$count=0;
	$execQry=mysql_query("select * from `candidatecourse` where `u_id`='$uid'  ");
	 $numrow=mysql_num_rows($execQry);
	$fetchRes=mysql_fetch_row($execQry);
	
	if($numrow>0){
		$totalpercent=100;
	}else{
		$totalpercent=0;
	}
	return $totalpercent;
}

function getTotalPercent($profile,$work,$course){
$total=floor(($profile+$work+$course)/3);
return $total;

}
function checklogin($uid,$type,$itype){
	if($uid==''|| $type==''){
		unset($_SESSION['uid']);
		unset($_SESSION['type']);
		header("location:index.php#sign");
	}elseif($type!=$itype){
		unset($_SESSION['uid']);
		unset($_SESSION['type']);
	   header("location:index.php#sign");
	  }	
	else{
		$execQry=mysql_query("select * from `login` where `id`='$uid' and `type`='$type'  ");
		$numrow=mysql_num_rows($execQry);
		if($numrow>0){
			return true;
		}else{
		unset($_SESSION['uid']);
		unset($_SESSION['type']);
		header("location:index.php#sign");
		}
	}

}

function changeInstitutePassword($old,$new,$uid){
		 $oldpwd=md5(mysql_real_escape_string($old));
		$newpwd=md5(mysql_real_escape_string($new));
		$execQry=mysql_query("select * from `login` where `id`='$uid' and `password` = '$oldpwd'");
		$numrow=mysql_num_rows($execQry);
		if($numrow>0){
        	$upsQry=mysql_query("Update `login` set `password` = '$newpwd' where `id`='$uid'");
		if($upsQry){
			return true;
		}else{
			return false;
		}		
		}else{
			return false;
		}

}

function changeFacultyPassword($old,$new,$uid){
		 $oldpwd=md5(mysql_real_escape_string($old));
		$newpwd=md5(mysql_real_escape_string($new));
		$execQry=mysql_query("select * from `login` where `id`='$uid' and `password` = '$oldpwd'");
		$numrow=mysql_num_rows($execQry);
		if($numrow>0){
        	$upsQry=mysql_query("Update `login` set `password` = '$newpwd' where `id`='$uid'");
			//$upsQry=mysql_query("Update `collegefaculty` set `password` = '$newpwd' where `id`='$uid'");
		if($upsQry){
			return true;
		}else{
			return false;
		}		
		}else{
			return false;
		}

}



function getInstituteNameById($id){
	$sqlQry=mysql_query("select `name` from `login` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getCandidateNameByLoginId($id){
	$sqlQry=mysql_query("select `name` from `login` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function checkCollegeExist($id){
	$sqlQry=mysql_query("select count(*) from `collegegeneral` where `c_id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	if( $fetchQry[0]==0){
	return true;
	}else{
	
	return false;
	}
}
function checkAluminusRecord($univ,$cllg,$candidate){

$sqlQry=mysql_query("select count(*) from `aluminus` where `uv_id`='$univ' and `ins_id`='$cllg' and `c_id`='$candidate' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	if( $fetchQry[0]==0){
		return true;
	}else{
		return false;
	}
}


function getAluminiPendingRequest($cid){
	$sqlQry=mysql_query("select count(*) from `aluminus` where `ins_id`='$cid' and `status`='1' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getAluminiActiveRequest($cid){
	$sqlQry=mysql_query("select count(*) from `aluminus` where `ins_id`='$cid' and `status`='2' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getAluminiTotalRequest($cid){
	$total=getAluminiPendingRequest($cid)+getAluminiActiveRequest($cid);
	return $total;
}
function getCandidateTotalAluminus($uid){

$execQry=mysql_query("select * from `aluminus` where `c_id` = '$uid'");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$workshopIds[]=$fetch['ins_id'];
		}
	}else{
			$workshopIds[0]=0;
	}
return $workshopIds;
}

function getCollegeJobDetailByClgId($cid){
	$sqlQry=mysql_query("select * from `collegejobs` where `c_id`='$cid'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}
function getJobDetailById($cid){
	$sqlQry=mysql_query("select * from `collegejobs` where `id`='$cid'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}

function getProfessorDetailById($cid){
	$sqlQry=mysql_query("select * from `collegefaculty` where `id`='$cid'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}


function getCollegeNewsById($cid){
	$sqlQry=mysql_query("select * from `collegenews` where `id`='$cid'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}

function getUniversityByCollegeId($cid){
	$sqlQry=mysql_query("select `uv_id` from `collegegeneral` where `c_id`='$cid' and `status`='1' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getCandidateRecommendationStatus($uid,$cid,$pid){
	$sqlQry=mysql_query("select * from `recommendation` where `u_id`='$uid' and`p_id`='$pid' and `c_id`='$cid'");
	$numrow=mysql_num_rows($sqlQry);
	if($numrow==0){
	  $status=0;
	}else{
	$fetchRes=mysql_fetch_row($sqlQry);
	  $status=$fetchRes[5];
  }
return $status;
}
function strreplace($string){
$str=preg_replace('/[^0-9a-zA-Z]/',"-",$string);
return $str;
}

function  getFacultyMsg($email,$password){
	
$msg='<head>
	<title>New mail</title>
	</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#0193de">
  <tr>
    <td   style="color:#FFFFFF;font-size:28px;font-weight:bold;" height="50px" align="center" valign="middle"><b>V</b>erisumed</td>
  </tr>
  <tr style="background-color:#FFFFFF">
    <td align="left"  style="color:#000;font-size:14px;font-style:italic;background:#FFF">Hi, ' .$email. '! You have been successfully registered with verisumed.Your login crdentials are as follows..</td>
  </tr>
   <tr>
    <td align="left"  style="color:#000;font-size:14px;font-style:italic;background:#FFF">Usename : '.$unText.'</td>
  </tr>
   <tr>
    <td align="left"  style="color:#000;font-size:14px;font-style:italic;background:#FFF">Password :'.$unText.'</td>
  </tr>
</table><body><html>';
return $msg;
}
function getFacultyDetailByEmailId($email){
	$sqlQry=mysql_query("select * from `collegefaculty` where `email`='$email'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry;
}

function getRatingForeColor($step){
	$colorsArr= array("#cb202d","#de1d0f","#ff7800","#ffba00","#edd614","#9acd32","#5ba829","#3f7e00","#305d02");
	$indx=$step-1;
    return $colorsArr[$indx];
}
function getRatingBackColor($step){
	$colorsArr= array("#ededed","#eaeaea","#e8e8e8","#e5e5e5","#e2e2e2","#dedede","#dbdbdb","#d8d8d8","#cecece");
	$indx=$step-1;
    return $colorsArr[$indx];
}
function getRatingText($step){
	$colorsArr= array("Avoid","Ordinary","Average","Just Ok","Satisfactory","Good","Very Good","Excellent","Outstanding");
	$indx=$step-1;
    return $colorsArr[$indx];
}

function checkIntrusion($aid){
	if($aid=='' || $aid==0){
		header("location:index.php");
	}

}
function checkUsername($uname,$aid){
	$sqlQry=mysql_query("select count(*) from `admin` where `username`='$uname' and `id`!='$aid' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	if($fetchQry[0]>0){
		return true	;
	}else{
		return false;	
	}

}

function getEmployeeDesignationbyReportToId($id){
	$sqlQry=mysql_query("select `designation` from `admin` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}

function getDesignationNameById($id){

	$execQry=mysql_query("select `name` from `designations` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	
	if($fetchRes[0]==''){
	return 	"None";
	}else{
		return $fetchRes[0];
	}
	
}
function getRolesNameById($id){

	$execQry=mysql_query("select `name` from `roles` where `id`='$id' ");
	$fetchRes=mysql_fetch_row($execQry);
	return $fetchRes[0];
}

function getCode($id){
	$val=946+$id;
	return "IDI".$val;
}

function getProgramCode($id){
	$val=1000+$id;
	return "PRG".$val;
}

function getAdminRoleById($id){
	$sqlQry=mysql_query("select `role_id` from `admin` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];
}
function getRoleBasedRights($rid){
		$execQry=mysql_query("select `menu_id` from `rights` where `role_id`='$rid'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$menuids[]=$fetch['menu_id'];
		}
		}else{
			$menuids[]=0;
		}
	return $menuids;
}

function getMainMenusByRights($ridArr){
	    $impIds=implode(",",$ridArr);
		$execQry=mysql_query("select `c_id` from `menusubcategory` where `id` IN ( $impIds )");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$menuids[]=$fetch['c_id'];
		}
		}else{
			$menuids[]=0;
		}
	return $menuids;
}
function getProgramNameById($id){
	$sqlQry=mysql_query("select `pname` from `programs` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];	
	
}

function getProgramEmailById($id){
	$sqlQry=mysql_query("select `oemail` from `programs` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];	
	
}
function getProgramContactById($id){
	$sqlQry=mysql_query("select `ocontact` from `programs` where `id`='$id'");
	$fetchQry=mysql_fetch_row($sqlQry);
	return $fetchQry[0];	
	
}

function getModeOfPaymentById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `paymentmodes` where `id`='$id' "));
	return $execQry[0];
}

function getProgramDescriptionById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `programs` where `id`='$id' "));
	return $execQry;
}
function getTabledataById($col,$table,$id){
	//echo "select `$col` from `$table` where `id`='$id' ";
$execQry=mysql_fetch_row(mysql_query("select `$col` from `$table` where `id`='$id' "));
return 	$execQry[0];
}

function getPaymentStatsByModeNStats($mode,$stat){
//	echo "Select `svalues` from `paymentstats` where `mode`='$mode' and `stats`='$stat'";
	$paymentStats=mysql_fetch_row(mysql_query("Select `svalues` from `paymentstats` where `mode`='$mode' and `stats`='$stat'"));
	return $paymentStats[0];
}

function getCitiesNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `city_name` from `cities` where `city_id`='$id' "));
	return $execQry[0];
}

function getPaymentFieldNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `paymentfields` where `id`='$id' "));
	return $execQry[0];
}

function comparedates($dob,$month,$date){
	$expDob=explode("/",$dob);
	$expMonth=$expDob[1];	
	$expDate=$expDob[0];
	if(  ($expMonth==$month) &&($expDate==$date) ){
		return true;	
	}else{
		return false;	
	}
	
		
}

function getBday($month,$day){
	$execQry=mysql_query("select * from `members` where `status` ='1'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			$dob=$fetch['dob'];
			if(comparedates($dob,$month,$day)){
				$bdays[]=$fetch['id'];
			}
		}
		}else{
			$bdays[0]=0;
		}
	return 	$bdays;
}


function getNotCreditedInBank(){

	$execQry=mysql_query("select * from `members` where `status` ='1' and `creditedon`='' and `complimentry`='0'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$credits[]=$fetch['id'];
			}
		
		}else{
			$credits[0]=0;
		}
	return 	$credits;
}


function getBdayInNext4days(){
	$execQry=mysql_query("select * from `members` where `status` ='1'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			$dob=$fetch['dob'];
			if(checkBdayIn4Days($dob)){
				$bdays[]=$fetch['id'];
			}
		}
		}else{
			$bdays[0]=0;
		}
	return 	$bdays;
}




function checkBdayIn4Days($dob){
	 $bdays=array();
	 $after4days=mktime(0, 0, 0, date('m'), date('d') + 4, date('Y'));
	 $makedob=makeDateTime($dob);
	 $today=mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	 if( ($makedob>$today) && ($makedob<=$after4days) ){
		 
		return true ;
	 }else{
		return false ;
	 }
	 
     //if()	
}


function getBdayByRange($start,$end){
	$bdays=array();
	$execQry=mysql_query("select * from `members` where `status` ='1'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			$dob=$fetch['dob'];
				 $makedob=makeDateTime($dob);
				//echo "<br/>";
				 $startdob=makeDateTime($start);
				//echo "<br/>";
				 $enddob=makeDateTime($end);
				//die;
				if( ($makedob >=$startdob) && ($makedob <=$enddob) ){
					$bdays[]=$fetch['id'];	
				}
			
		}
		}else{
			$bdays[0]=0;
		}
	return 	$bdays;
}


function getAnnv($month,$day){
	$execQry=mysql_query("select * from `members` where `status` ='1'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			$doa=$fetch['doa'];
			if(comparedates($doa,$month,$day)){
				$annvs[]=$fetch['id'];
			}
		}
		}else{
			$annvs[0]=0;
		}
	return 	$annvs;
}

function getAnnvByRange($start,$end){
	$bdays=array();
	$execQry=mysql_query("select * from `members` where `status` ='1'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			$doa=$fetch['doa'];
				$makedoa=makeDateTime($doa);
				$startdoa=makeDateTime($start);
				$enddoa=makeDateTime($end);
				if( ($makedoa >=$startdoa) && ($makedoa <=$enddoa) ){
					$annvs[]=$fetch['id'];	
				}
			
		}
		}else{
			$annvs[0]=0;
		}
	return 	$annvs;
}


function getMembersDetailById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `members` where `id`='$id' "));
	return $execQry;
}

function getAnnvYear($year,$annvId){
	$memArr=getMembersDetailById($annvId);
	$doa=$memArr[12];
	$expDoa=explode("/",$doa);
	$expYear=$expDoa[2];
	$annvYear=(int)$year - (int)$expYear;
	return 	$annvYear;
	
	
}

function makeDateTime($date){
    $expDob=explode("/",$date);
	$expMonth=$expDob[1];	
	$expDate=$expDob[0];
	$expYear=$expDob[2];
	$makedate=@mktime(0,0,0,$expMonth,$expDate,date("Y"));
	return 	$makedate;
	
}

function changeDateTomkTime($date){
    $expDob=explode("/",$date);
	$expMonth=$expDob[1];	
	$expDate=$expDob[0];
	$expYear=$expDob[2];
	$makedate=@mktime(0,0,0,$expMonth,$expDate,$expYear);
	return 	$makedate;
	
}


function getLatestMemberId(){
	$execQry=mysql_fetch_row(mysql_query("select * from `members` order by `id` desc limit 0,1 "));
	return $execQry[0];
}

function getMemberShipNumberByProgId($progId){
$progDetail=getProgramDescriptionById($progId);
$latestId=getLatestMemberId()+1;
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $latestId;
		$memNumber=$preffix."".$memId."".$suffix;	
		return $memNumber;
	
}


function getMemberShipNumber($progId,$id){
		$progDetail=getProgramDescriptionById($progId);
		$latestId=$id;
		$progName=$progDetail[1];
		$memberstart=$progDetail[8];
		$preffix=$progDetail[10];
		$suffix=$progDetail[11];
		$memId=(int)$memberstart + $latestId;
		$memNumber=$preffix."".$memId."".$suffix;	
		return $memNumber;
	
}





function getReportToNameWithDesignation($id){
$res=mysql_fetch_row(mysql_query("select *  from `admin` where `status`='1' and `id`='$id' "));
$designation=	getTabledataById("name","designations",$res[11]);
$name=$res[8]." ".$res[9];
return "( ".$name." )"." ".$designation;
}

function getReportToEmp($id){
$res=mysql_fetch_row(mysql_query("select *  from `admin` where `status`='1' and `id`='$id' "));
//$designation=	getTabledataById("name","designations",$res[11]);
$reportTo= $res[16];
	if($reportTo==0){
		return "none";	
	}else{
		return getEmployeeNameById($reportTo);
		
	}
}


function getProgramTemplatesById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `templates` where `prog_id`='$id' "));
	return $execQry;
}

function getTenureById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `tenures` where `id`='$id' "));
	return $execQry[0];
}
function checkMailSent($id){
	$sqlQry=mysql_query("select count(*) from `welcomemail` where `mem_id`='$id' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	if($fetchQry[0]>0){
		return true; 
	}else{
	return false;
	}
}

function checkRoomMailSent($id){
	$sqlQry=mysql_query("select count(*) from `roommail` where `mem_id`='$id' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	if($fetchQry[0]>0){
		return true; 
	}else{
	return false;
	}
}


function getMemberFullAddress($aid){
	$edtQry=mysql_query("Select * from `members` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	$addressLine1=stripslashes($userData[13]);
	$addressLine2=stripslashes($userData[14]);
	$state=getTabledataById("name","state",$userData[15]);
	$city=stripslashes($userData[17]);
	$pincode=stripslashes($userData[18]);
	$mobile=stripslashes($userData[8]);
	$landline=stripslashes($userData[31]);
	if(!$mobile==''){
		$contact=$mobile;	
	}elseif(!$landline==''){
		$contact=$landline;	
	}else{
	$contact="Not Mentioned";	
	}
	
	$email=stripslashes($userData[7]);
	if($email==''){
	$emailText=	"Not Mentioned";
	}else{
		$emailText=$email;
	}
	
	
	
	$address=$addressLine1."<br/>".$addressLine2."<br/>".$city.", ".$state."<br/>".$pincode."<br/> M: ".$contact."<br/>E: ".$emailText;
	return $address;
		
}




function getMemberContact($aid){
	$edtQry=mysql_query("Select * from `members` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	
	$mobile=stripslashes($userData[8]);
	$mobilealt=stripslashes($userData[9]);
	$landline=stripslashes($userData[31]);
	$landlinealt=stripslashes($userData[32]);
	
	if( ($mobile=='') && ($mobilealt=='') && ($landline=='') & ($landlinealt=='')){
		return "Not Mentioned";	
	}else{
	
	$contact=array($mobile,$mobilealt,$landline,$landlinealt);
	foreach($contact as $tel){
	if(!$tel==''){
		$contactNew[]=$tel;	
	}
		
	}
	
	
	$impCont=implode(", ",$contactNew);
	return $impCont;	
	}
	
		
}






function getMemberAddress($aid){
	$edtQry=mysql_query("Select * from `members` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	$addressLine1=stripslashes($userData[13]);
	$addressLine2=stripslashes($userData[14]);
	$state=getTabledataById("name","state",$userData[15]);
	$city=stripslashes($userData[17]);
	$pincode=stripslashes($userData[18]);
	$address=$addressLine1.", ".$addressLine2.", ".$city.", ".$state.", ".$pincode;
	return $address;
		
}


function getConsultantsNameByMemId($aid){
	$edtQry=mysql_query("Select * from `members` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	$consultant=getEmployeeNameById($userData[30]);
	return $consultant;
	
		
}



function getPendingMembersId(){
	$execQry=mysql_query("select * from `members` where `status` = '1' order by `id` desc");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$members[]=$fetch['id'];
		}
	}else{
			$members[0]=0;
	}
	$execQrys=mysql_query("select * from `welcomemail` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	$pendings=array_diff($members,$mails);
	return $pendings;
}


function getPendingEmbossingIds(){
	$execQry=mysql_query("select * from `members` where `status` = '1' order by `id` desc");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$members[]=$fetch['id'];
		}
	}else{
			$members[0]=0;
	}
	
	$execQrys=mysql_query("select * from `embossinglist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	$pendings=array_diff($members,$mails);
	return $pendings;
}

function getPendingEmbossingIdsByPid($pg){
	$execQry=mysql_query("select * from `members` where `status` = '1' and `prog_id`='$pg' order by `id` desc");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$members[]=$fetch['id'];
		}
	}else{
			$members[0]=0;
	}
	
	$execQrys=mysql_query("select * from `embossinglist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	$pendings=array_diff($members,$mails);
	return $pendings;
 }


function getGeneratedEmbossingIds(){
	$execQrys=mysql_query("select * from `embossinglist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	
	return $mails;
}



function getGeneratedEmbossingIdsByPid($pg){
	$execQrys=mysql_query("select * from `embossinglist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$memId=$fetchs['mem_id'];
			$pgid=getProgramIdByMemberId($memId);
			if($pgid == $pg){
			$mails[]=$fetchs['id'];
			}
			
		}
	}else{
			$mails[0]=0;
	}
	
	
	
	return $mails;
}



function getMemberMonthYear($date){
	$expDob=explode("/",$date);
	$expMonth=$expDob[1];	
	$expYear=$expDob[2];
	return 	$expMonth."/".$expYear;
}

function getMemberCardType($memid){
	  	$fetchRes=mysql_fetch_row(mysql_query("select * from `members` where `id` ='$memid' "));
		$spouseCard=$fetchRes[41];
		if($spouseCard==1){
			return "Primary + Spouse";	
		}else{
			return "Primary";	
		}
}

function getMemberNameByCardType($id){
	$fetchRes=mysql_fetch_row(mysql_query("select * from `members` where `id` ='$id' "));
	$name=getTabledataById("name","titles",$fetchRes[2])." ".$fetchRes[3]." ".$fetchRes[4]." ".$fetchRes[5];
	if($fetchRes[41]==1){
	$spname=stripslashes($fetchRes[33]);
		return $name." ( ".$spname." )";
	}else{
		return $name;	
	}
}

function getMemberExpiry($id){
		$fetchRes=mysql_fetch_row(mysql_query("select * from `members` where `id` ='$id' "));
		$tenure=getTenureById($fetchRes[25]);
		$months=(int)($tenure);
		$dates=$fetchRes[29];
		$expDob=explode("/",$dates);
		
		$expDate=$expDob[0];
		$expMonth=$expDob[1];	
		$expYear=$expDob[2];
		$expDate=date("m/Y", mktime(0,0,0,$expMonth+$months,$expDate,$expYear)); 
		return $expDate;
}



function getMemberSpouseCheck($memid){
	$fetchRes=mysql_fetch_row(mysql_query("select * from `members` where `id` ='$memid' "));
		$spouseCard=$fetchRes[41];
		if($spouseCard==1){
			return "Required";	
		}else{
			return "No";
		}
}


function getPendingDispatchIds(){
	$execQry=mysql_query("select * from `members` where `status` = '1' order by `id` desc");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$members[]=$fetch['id'];
		}
	}else{
			$members[0]=0;
	}
	
	
	
	$execQrys=mysql_query("select * from `dispatchlist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	$pendings=array_diff($members,$mails);
	return $pendings;
	
	
	
}

function getPendingDispatchIdsByPid($pg){
	//echo "select * from `members` where `prog_id`='$pg' and `status` = '1' order by `id` desc";
	$execQry=mysql_query("select * from `members` where `prog_id`='$pg' and `status` = '1' order by `id` desc");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$members[]=$fetch['id'];
		}
	}else{
			$members[0]=0;
	}
	
	
	
	$execQrys=mysql_query("select * from `dispatchlist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	$pendings=array_diff($members,$mails);
	return $pendings;
	
	
	
}



function getGeneratedEmbossingList(){
	$execQrys=mysql_query("select * from `embossinglist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;
	
}



function getGeneratedWelcomeList(){
	$execQrys=mysql_query("select * from `welcomemail` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;
	
}

function getInTransitDispatchIds($status){
		$execQrys=mysql_query("select * from `dispatchlist` where `status` = '$status' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;
}

function getInTransitDispatchIdsANdPid($status,$pg){
		$execQrys=mysql_query("select * from `dispatchlist` where `status` = '$status' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$memId=$fetchs['mem_id'];
			$progid=getProgramIdByMemberId($memId);
			if($pg==$progid){
				$mails[]=$fetchs['mem_id'];
			}
		}
	}else{
			$mails[0]=0;
	}
	return $mails;
}


function getDispatchDetailByMemId($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `dispatchlist` where `mem_id`='$id' "));
	return $execQry;
}
function getMemIdByDispId($id){
	$execQry=mysql_fetch_row(mysql_query("select `mem_id` from `dispatchlist` where `id`='$id' "));
	return $execQry[0];
}
function getDispatchDetailById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `dispatchlist` where `id`='$id' "));
	return $execQry;
}
function getMemberNameById($id){
	$fetchRes=mysql_fetch_row(mysql_query("select * from `members` where `id` ='$id' "));
	
	$name=getTabledataById("name","titles",$fetchRes[2])." ".$fetchRes[3]." ".$fetchRes[4]." ".$fetchRes[5];
	
	return $name;	
	
}

function getProgramIdByMemberId($id){
	$execQry=mysql_fetch_row(mysql_query("select `prog_id` from `members` where `id`='$id' and `status`='1' "));
	return $execQry[0];
}


function getStateIdByMemberId($id){
	$execQry=mysql_fetch_row(mysql_query("select `state` from `members` where `id`='$id' and `status`='1' "));
	return $execQry[0];
}
function getStateIdByCityId($id){
	$execQry=mysql_fetch_row(mysql_query("select `city_state` from `cities` where `city_id`='$id' and `status`='1' "));
	return $execQry[0];
}
function getCityByMemberId($id){
	$execQry=mysql_fetch_row(mysql_query("select `cityother` from `members` where `id`='$id' and `status`='1' "));
	return $execQry[0];
}


function getProgramIdByAllMemberId($id){
	$execQry=mysql_fetch_row(mysql_query("select `prog_id` from `members` where `id`='$id' "));
	return $execQry[0];
}


function getRoomMailStatus($val){
	if($val==0){
		return "<span class='label label-warning'>Pending</span>";	
	}
	if($val==1){
		return "<span class='label label-success'>Confirmed</span>";	
	}
	if($val==2){
		return "<span class='label label-danger'>Cancelled</span>";	
	}
	
}

function getTableMailStatus($val){
	if($val==0){
		return "<span class='label label-warning'>Pending</span>";	
	}
	if($val==1){
		return "<span class='label label-success'>Confirmed</span>";	
	}
	if($val==2){
		return "<span class='label label-danger'>Cancelled</span>";	
	}
	
}



function getPendingRoomReservations(){
$execQrys=mysql_query("select * from `roommail` where `status` = '0' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}


function getPendingTableReservations(){
$execQrys=mysql_query("select * from `tablemail` where `status` = '0' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}


function getRoomMailDetailsById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `roommail` where `id`='$id'  "));
	return $execQry;
}

function getTableMailDetailsById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `tablemail` where `id`='$id'  "));
	return $execQry;
}

function getValidUpto($dob,$tenure){
	$expDob=explode("/",$dob);
	$expMonth=$expDob[1];	
	$expDate=(int)$expDob[0];
	$expYear=$expDob[2];
	$monthsByTenure=$tenure;
	$validDate=date("d/m/Y",mktime(0,0,0,$expMonth+$monthsByTenure,$expDate,$expYear));
	return $validDate;
		
}

function getDaysLeftToexpire($validdate){
	    $expDob=explode("/",$validdate);
		$month=$expDob[1];	
		$day=$expDob[0];
		$year=$expDob[2];
	    $curDate=date("Y-m-d");
		$date1=date_create($year."-".$month."-".$day);
		$date2=date_create($curDate);
		$diff=date_diff($date2,$date1);
		$result=$diff->format("%R%a");
		if($result>0){
		return $diff->format("%R %a days");
		}else{
		return "Expired";	
		}

}


function getMembersExpiringIn15Days(){
	$execQrys=mysql_query("select * from `members` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
	while($fetchs=mysql_fetch_array($execQrys)){
			$dateofsale=$fetchs['dateofsale'];
			$tenure=getTenureById($fetchs['tenure']);
			$validdate=getValidUpto($dateofsale,$tenure);
			$changedValidDate=changeDate($validdate);
			$now = time(); // or your date as well
			$your_date = strtotime("$changedValidDate");
			$datediff =  $your_date-$now;
		
		    $diffdays= floor($datediff/(60*60*24));
		//echo "<br/>";
			if( $diffdays<= 15 ){
				//echo $fetchs['id'];
				$mails[]=$fetchs['id'];	
			}
		}
	}else{
		$mails[0]=0;
	}
	//die;
	return $mails;	
}


function updateExpiredMembers(){
	$execQrys=mysql_query("select * from `members` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
	while($fetchs=mysql_fetch_array($execQrys)){
		    $memId=$fetchs['id'];
			$dateofsale=$fetchs['dateofsale'];
			$tenure=getTenureById($fetchs['tenure']);
			$validdate=getValidUpto($dateofsale,$tenure);
			$changedValidDate=changeDate($validdate);
			$now = time(); // or your date as well
			$your_date = strtotime("$changedValidDate");
			$datediff =  $your_date-$now;
		    $diffdays= floor($datediff/(60*60*24));
			if( $diffdays<= 0 ){
				mysql_query("UPDATE `members` set `status` = '0' where `id`='$memId' ");
			}
		}
	}else{
		//$mails[0]=0;
	}
	//die;
	//return $mails;	
}




function checkMlevelReferenceExists($id){
	$sqlQry=mysql_query("select count(*) from `members` where  `mlevel`='$id' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	if($fetchQry[0]>0){
	return true	;
	}else{
	return false;	
	}
}


function getProgramPriceById($id){
	$execQry=mysql_fetch_row(mysql_query("select `price` from `program_price` where `id`='$id'  "));
	return $execQry[0];
}

function checkProgramReferenceExists($id){
	$sqlQry=mysql_query("select count(*) from `members` where  `prog_id`='$id' ");
	$fetchQry=mysql_fetch_row($sqlQry);
	if($fetchQry[0]>0){
		return true	;
	}else{
	return false;	
	}
}


function getMenuSubCategoryDetailById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `menusubcategory` where `id`='$id'  "));
	return $execQry;
}

function getMenuCatNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `category` from `menucategory` where `id`='$id'  "));
	return $execQry[0];
}
function getMenuSubCategoryDetailByUrl($link){
	$qry=mysql_query("select * from `menusubcategory` where `link`='$link'");
	$numRows=mysql_num_rows($qry);
	if($numRows>0){
	$execQry=mysql_fetch_row(mysql_query("select * from `menusubcategory` where `link`='$link'"));
		return $execQry;
	}else{
		return false;	
	}
}

function getBreadCrumb($url){
	if(getMenuSubCategoryDetailByUrl($url)){
	
	$menuArr=getMenuSubCategoryDetailByUrl($url);
	$subCategoryName=$menuArr[2];
	$categoryId=$menuArr[1];
	$categoryName=getMenuCatNameById($categoryId);
	$crumb="<span style='color:#976646;'>Home / ".$categoryName."</span> / <span style='color:#976646;'>".$subCategoryName."</span>";
	}else{
	$crumb=	"<span style='color:#976646;'>Home</span>";
	}
	return $crumb;
	
}

function getMenuIdByUrl($url){
	$menuArr=getMenuSubCategoryDetailByUrl($url);
	$subCategoryName=$menuArr[2];
	$categoryId=$menuArr[1];
	return $categoryId;
}

function getEmployeeDetailsById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `admin` where `id`='$id'  "));
	return $execQry;
	
}

function getEmployeeNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `admin` where `id`='$id'  "));
	return $execQry[8]." ".$execQry[9];
	
}


function checkEmpSalaryExistsById($id,$month,$year){
	$execQry=mysql_fetch_row(mysql_query("select count(*) from `empsalary` where `empId`='$id' and `month`='$month' and `year`='$year'   "));
	if($execQry[0]>0){
	return true	;
	}else{
	return false;	
	}
	
}
function getEmpSalaryById($id,$month,$year){
	//echo "select * from `empsalary` where `empId`='$id' and `month`='$month' and `year`='$year'  ";
	
	$execQry=mysql_fetch_row(mysql_query("select * from `empsalary` where `empId`='$id' and `month`='$month' and `year`='$year'  "));
	return $execQry;
	
}


function getTotalAbsentDays($full,$half){
	$halfdays=$half/2;
	$total=$full+$halfdays;
	return $total;
}

function getTotalPresentDays($full,$half,$days){
	$halfdays=$half/2;
	$total=$full+$halfdays;
	return $days-$total;
}

function getGrossSalary($days,$salary,$incentive,$bonus,$absent,$saltype){
	if($saltype==1){
		$totaldayspresent=$days-$absent;	
		$salaryTotal=((int)$salary/(int)$days)*(int)$absent;
	}elseif($saltype==2){
		$totaldayspresent=$absent;	
		$salaryTotal=(int)$salary*(int)$totaldayspresent;
	}
	
	
	
	$salaryall=$salaryTotal+$incentive+$bonus;
	
	return floor($salaryall);
}
function getTDS(){
		$execQry=mysql_fetch_row(mysql_query("select `name` from `tds` where `id`='1' "));
		return $execQry[0];
}

function getEffectiveTDS(){
	    $currentDate=date("Y-m-d");
		//echo "select `name` from `tds` where  `edateend` <=  '$currentDate' and `edate`>='$currentDate' order by `id` desc ";
		$execQry=mysql_fetch_row(mysql_query("select `name` from `tds` where  `edateend` >=  '$currentDate' and `edate`<='$currentDate' order by `id` desc "));
		return $execQry[0];
}
function getEffectiveTargetById($eid){
	    $currentDate=date("Y-m-d");
		//echo "select `name` from `tds` where  `edateend` <=  '$currentDate' and `edate`>='$currentDate' order by `id` desc ";
		$execQry=mysql_fetch_row(mysql_query("select `name` from `target` where  `edateend` >=  '$currentDate' and `edate`<='$currentDate' and `emp_id`='$eid' order by `id` desc "));
		return $execQry[0];
}
function getServiceTax(){
		$execQry=mysql_fetch_row(mysql_query("select `name` from `servicetax` where `id`='1' "));
		return $execQry[0];
}

function getEffectiveServiceTax(){
	
		  $currentDate=date("Y-m-d");
		$execQry=mysql_fetch_row(mysql_query("select `name` from `servicetax` where  `edateend` >=  '$currentDate' and `edate`<='$currentDate' order by `id` desc "));
		return $execQry[0];
}


function getLeadSaleDateById($id){
		$execQry=mysql_fetch_row(mysql_query("select `doa` from `leads` where `id`='$id' "));
		return $execQry[0];
}

function getEffectiveServiceTaxByLeadId($lid){
	   	 	$enquiryDate=getLeadDateofSale($lid);
			$currentDate = $enquiryDate;
			$execQry=mysql_fetch_row(mysql_query("select `name` from `servicetax` where  `edateend` >=  '$currentDate' and `edate`<='$currentDate' order by `id` desc "));
		return $execQry[0];
 }


function getGeneratedEmbossingIdsByDate($startdate,$enddate){
	
	$execQrys=mysql_query("select * from `embossinglist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$pdate=$fetchs['pdate'];
			$checkList=checkEmbosslistIsBetweenDate($pdate,$startdate,$enddate);
			if($checkList){
				$mails[]=$fetchs['id'];
			}
		}}else{
			$mails[0]=0;
	}
	return $mails;	
}


function getGeneratedEmbossingIdsByDateAndPid($startdate,$enddate,$pg){
	
	$execQrys=mysql_query("select * from `embossinglist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$pdate=$fetchs['pdate'];
			$checkList=checkEmbosslistIsBetweenDate($pdate,$startdate,$enddate);
			if($checkList){
				$eid=$fetchs['id'];
				$memId=$fetchs['mem_id'];
				$pid=getProgramIdByMemberId($memId);
				if($pid=$pg){
					$mails[]=$eid;	
				}
				
				
			}
		}}else{
			$mails[0]=0;
	}
	return $mails;	
}


function getDispatchIdsByDateAndPid($startdate,$enddate,$pg){

	
	$execQrys=mysql_query("select * from `dispatchlist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$pdate=$fetchs['pdate'];
			$checkList=checkDispatchlistIsBetweenDate($pdate,$startdate,$enddate);
			if($checkList){
				
				$memId=$fetchs['mem_id'];
				$pid=getProgramIdByMemberId($memId);
				if($pid==$pg){
					$mails[]=$memId;	
				}else{
					$mails[0]=0;	
				}
				
				
			}else{
			$mails[0]=0;	
			}
		}}else{
			$mails[0]=0;
	}
	return $mails;
	//print_r( $mails);	
}



function getTotalDispatchByStaeAndDate($state,$startdate,$enddate,$pg){
//echo $enddate;
	$mails=array();
	$execQrys=mysql_query("select * from `dispatchlist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$pdate=$fetchs['cdate'];
			$checkList=checkDispatchlistIsBetweenDate($pdate,$startdate,$enddate);
			if($checkList){
				//echo "dsada";
					$memId=$fetchs['mem_id'];
					$pid=getProgramIdByMemberId($memId);
				$sid=getStateIdByMemberId($memId);
				if(!$pg==0){
				if($pid==$pg){
					if($sid==$state){
						$mails[]=$memId;
					}
						
				}else{
					//$mails[0]=0;	
				}
				
				}else{
					if($sid==$state){
						
						$mails[]=$memId;
					}	
				}
				
				
				
			}else{
			//echo "dasd";	
			//$mails[0]=0;	
			}
		}}else{
			//$mails[0]=0;
	}
	
	
	return count($mails);
}


function getTotalDispatchCityWise($state,$startdate,$enddate,$pg){
//echo $enddate;
	$mails=array();
	$execQrys=mysql_query("select * from `dispatchlist` where `status` = '1' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$pdate=$fetchs['cdate'];
			$checkList=checkDispatchlistIsBetweenDate($pdate,$startdate,$enddate);
			if($checkList){
				//echo "dsada";
					$memId=$fetchs['mem_id'];
					$pid=getProgramIdByMemberId($memId);
				$sid=getStateIdByMemberId($memId);
				if(!$pg==0){
				if($pid==$pg){
					if($sid==$state){
						$mails[]=$memId;
					}
						
				}else{
					//$mails[0]=0;	
				}
				
				}else{
					if($sid==$state){
						
						$mails[]=$memId;
					}	
				}
				
				
				
			}else{
			//echo "dasd";	
			//$mails[0]=0;	
			}
		}}else{
			//$mails[0]=0;
	}
	
	
	return $mails;
}



function checkEmbosslistIsBetweenDate($pdate,$start,$end){
	$pdate=changeDateTomkTime($pdate);
	$start=changeDateTomkTime($start);
	$end=changeDateTomkTime($end);
	if( ($pdate>=$start) && ($pdate<=$end)){
		return true	;
	}else{
		return false;	
	}
	
	
}

function checkDispatchlistIsBetweenDate($pdate,$start,$end){
	$pdate=changeDateTomkTime($pdate);
	$start=changeDateTomkTime($start);
	$end=changeDateTomkTime($end);
	if( ($pdate>=$start) && ($pdate<=$end)){
		return true	;
	}else{
		return false;	
	}
	
	
}

function getEmbossingListDetailsById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `embossinglist` where `id`='$id'  "));
	return $execQry;
	
}

function getCancellationDetailByMemId($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `cancelmember` where `mem_id`='$id'"));
	return $resultSet;
}

function checkCancelMember($id){
	$execQry=mysql_fetch_row(mysql_query("select count(*) from `cancelmember` where `mem_id`='$id'    "));
	if($execQry[0]>0){
		return true	;
	}else{
		return false;	
	}
}

function searchCancelledMemberIds(){
	
	$execQrys=mysql_query("select * from `members` where `status`='2' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}

function allMembers(){
	
	$execQrys=mysql_query("select * from `members` where `status`='1' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}
function allMembersByCashPickup(){
	
	$execQrys=mysql_query("select * from `members` where `status`='1' and `pickup`='1' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}


function allMembersByCCOnline(){
	
	$execQrys=mysql_query("select * from `members` where `status`='1' and `pickup`='2' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}


function searchCancelledMemberIdsByProgramAndDate($pg,$start,$end){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where `status`='2' and `prog_id`='$pg' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members` where `status`='2' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$memDetail=getCancellationDetailByMemId($fetchs['id']);
			$cancelDate=$memDetail[2];
			$mkcanceldate=changeDateTomkTime($cancelDate);
			
			if( ($startDate==0) && ($endDate==0)){
				$mails[]=$fetchs['id'];
			}else{
			
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mkcanceldate>=$startDate) && ($mkcanceldate<=$endDate) ){
						$mails[]=$fetchs['id'];
					}
				
			}
			
		    
			
			
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}



function searchDispatchMemberIdsByProgramAndDate($pg,$startDate,$endDate){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where `status`='1' and `prog_id`='$pg' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members` where `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		
			$mksaledate=changeDateTomkTime($fetchs['dateofsale']);
			
			if( ($startDate==0) && ($endDate==0)){
				$mails[]=$fetchs['id'];
			}else{
			
					 $startsDate=changeDateTomkTime($startDate);
					 $endsDate=changeDateTomkTime($endDate);	
					if( ($mksaledate>=$startsDate) && ($mksaledate<=$endsDate) ){
						$mails[]=$fetchs['id'];
					}
				
			}
			
		    
			
			
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}





function getComplimentryMemIdsBy(){
	$sqlQry=mysql_query("select * from `members` where `status`='1' and `complimentry`='1'  order by `id` Desc");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$memid[]=$fetch['id'];
	}}else{
		$memid[0]=0;
	}
	return $memid;
 }

function getComplimentryMemIdsByProg($pg){
	
	$sqlQry=mysql_query("select * from `members` where `status`='1' and `complimentry`='1' and `prog_id`='$pg'  order by `id` Desc");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$memid[]=$fetch['id'];
	}}else{
		$memid[0]=0;
	}
	return $memid;
	
}

function getComplimentryMemIdsByProgAndDate($start,$end,$pg){
	$memid=array();
	if($pg==0){
		$qry="select * from `members` where `status`='1' and `complimentry`='1'   order by `id` Desc";
	}else{
		$qry="select * from `members` where `status`='1' and `complimentry`='1' and `prog_id`='$pg'  order by `id` Desc";
	}
	$sqlQry=mysql_query($qry);
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$createDate=$fetch[29];
		$mkcrtdate=changeDateTomkTime($createDate);
		$startDate=changeDateTomkTime($start);
		$endDate=changeDateTomkTime($end);	
		
		if( ($mkcrtdate>=$startDate) && ($mkcrtdate<=$endDate) ){
						$memid[]=$fetch['id'];
			}
		
	}}else{
		$memid[0]=0;
	}
	
return 	$memid;
}


function getNotCreditedInBankByProg($pg){

	$execQry=mysql_query("select * from `members` where `status` ='1' and `creditedon`='' and `complimentry`='0' and `prog_id`='$pg'");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$credits[]=$fetch['id'];
			}
		
		}else{
			$credits[0]=0;
		}
	return 	$credits;
}

function getNotCreditedInBankByProgAndDate($startdate,$enddate,$pg){

	$memid=array();
	if($pg==0){
		$qry="select * from `members` where `status` ='1' and `creditedon`='' and `complimentry`='0'   order by `id` Desc";
	}else{
		$qry="select * from `members` where `status` ='1' and `creditedon`='' and `complimentry`='0' and `prog_id`='$pg'  order by `id` Desc";
	}
	//echo $qry;
	//die;
	$sqlQry=mysql_query($qry);
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$createDate=$fetch[29];
		$mkcrtdate=changeDateTomkTime($createDate);
		$startDate=changeDateTomkTime($start);
		$endDate=changeDateTomkTime($end);	
		
		if( ($mkcrtdate>=$startDate) && ($mkcrtdate<=$endDate) ){
						$memid[]=$fetch['id'];
			}
		
	}}else{
		$memid[0]=0;
	}
	
return 	$memid;
}

function getMemberStatus($value){
	if($value==1){
	 return "<span style='color:#0174B1'>Active</span>";	
	}
	if($value==0){
		 return "<span style='color:#7C7C7C'>Expired</span>";	
	}
	if($value==2){
		return "<span style='color:#B13D00'>Cancelled</span>";
	}
	
}

function getAllCityData(){
	

	$execQry=mysql_query("select `cityother` from `members` where `status` ='1' ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$fetchRes=$fetch['cityother'];
				$credits[$fetchRes]=$fetchRes;
			}
		
		}else{
			$credits[0]=0;
		}
	$unqArr=array_unique($credits);	
		
	return $unqArr;		
}

function getAllPincodeData(){
	

	$execQry=mysql_query("select `pincode` from `members` where `status` ='1' ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$fetchRes=$fetch['pincode'];
				$credits[$fetchRes]=$fetchRes;
			}
		
		}else{
			$credits[0]=0;
		}
	$unqArr=array_unique($credits);	
		
	return $unqArr;		
}


function getAllDesignationData(){
	

	$execQry=mysql_query("select `designation` from `members` where `status` ='1' ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
				$fetchRes=$fetch['designation'];
				$credits[$fetchRes]=$fetchRes;
			}
		
		}else{
			$credits[0]=0;
		}
	$unqArr=array_unique($credits);	
		
	return $unqArr;		
}

function searchMembersByCityPinDesg($pg,$type,$val){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where `status`='1' and `prog_id`='$pg' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members` where `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
				$getMembers[]=$fetchs['id'];  // all members by program
			}
				
			
	}else{
			$getMembers[0]=0;
	}
	//print_r($getMembers);
	$getMembers=filterMembersByType($type,$val,$getMembers);
	return $getMembers;	
}

function  filterMembersByType($type,$val,$memIds){
	
	//die($type);
	if($type==0){
		return $memIds;	
	}else{
		if($type==1){
			$members=getMembersByCityName($val,$memIds);
		}
		if($type==2){
			$members=getMembersByPinCode($val,$memIds);
		}
		
		if($type==3){
			$members=getMembersByDesignations($val,$memIds);
		}
	return $members;
		
	}
	
	
}

function getMembersByCityName($val,$memIds){
	
	$impIds=implode(",",$memIds);
//	echo "select * from `members` where  `cityother`='$val' and `id` IN ($impIds) ";
	//die;
	$execQry=mysql_query("select * from `members` where  `cityother`='$val' and `id` IN ($impIds) ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			
				$credits[]=$fetch['id'];
			}
		
		}else{
			$credits[0]=0;
		}
		
		return $credits;
	
}


function getMembersByPinCode($val,$memIds){
	
	$impIds=implode(",",$memIds);
	$execQry=mysql_query("select * from `members` where  `pincode`='$val' and `id` IN ($impIds) ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			
				$credits[]=$fetch['id'];
			}
		
		}else{
			$credits[0]=0;
		}
		
		return $credits;
	
}

function getMembersByDesignations($val,$memIds){
	
	$impIds=implode(",",$memIds);
	$execQry=mysql_query("select * from `members` where  `designation`='$val' and `id` IN ($impIds) ");
		$numRows=mysql_num_rows($execQry);
		if($numRows>0){
			while($fetch=mysql_fetch_array($execQry)){
			
				$credits[]=$fetch['id'];
			}
		
		}else{
			$credits[0]=0;
		}
		
		return $credits;
	
}
function getBrdCrumbforFiltermembers($pg,$type,$val){
	if($pg==0){
		$text= " <span style='color:#8E2E19'>All Members</span> ";	
	}else{
		$pgName=getProgramNameById($pg);
		$text= " <span style='color:#8E2E19'>$pgName</span> ";
	}
	
	if($type==1){
	 $text.=" / <span style='color:#0174B1'>City - </span>".$val;
	}
	if($type==2){
	 $text.=" / <span style='color:#0174B1'>Pincode</span> - ".$val;
	}
	if($type==3){
	 $text.=" / <span style='color:#0174B1'>Designation</span> - ".$val;
	}
	
	
	
	return $text;
}



function getBrdCrumbforReservationrmembers($pg,$type,$start,$end){
	if($pg==0){
		$text= " <span style='color:#8E2E19'>All Members</span> ";	
	}else{
		$pgName=getProgramNameById($pg);
		$text= " <span style='color:#8E2E19'>$pgName</span> ";
	}
	if($start==0 && $end==0){
	$val="";
	}else{
		$val="Between-".$start." and ".$end;
	}
	
	if($type==1){
	 $text.=" / <span style='color:#0174B1'>Complimentry / </span>".$val;
	}
	if($type==2){
	 $text.=" / <span style='color:#0174B1'>Other</span> / ".$val;
	}
	if($type==0){
	 $text.=" / <span style='color:#0174B1'>Any Benefits</span> / ".$val;
	}
	
	
	return $text;
}




function getFilterLabelByType($type){
	if($type==1){
	 $text="City";
	}
	if($type==2){
	 $text="Pincode";
	}
	if($type==3){
	 $text="Designation";
	}
	return $text;
}





function searchMembersByTableReservations($pg,$start,$end,$type){
	$mails=array();
	if($pg>0){
		$query="select * from `tablemail` where   `prog_id`='$pg' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `tablemail`   order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  $checkInDate=$fetchs['checkin'];
		  $benefits=$fetchs['benefits'];
		  $mk_checkInDate=changeDateTomkTime($checkInDate);
		 
			if($type==0){
				//$mails[]=$fetchs['id'];
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_checkInDate>=$startDate) && ($mk_checkInDate<=$endDate) ){
						$mails[]=$fetchs['id'];
					}
			}else{
			
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_checkInDate>=$startDate) && ($mk_checkInDate<=$endDate) && ($type=$benefits) ){
						$mails[]=$fetchs['id'];
					}
				
			}
			
		    
			
			
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}


function searchMembersByRoomReservations($pg,$start,$end,$type){
	$mails=array();
	if($pg>0){
		$query="select * from `roommail` where   `prog_id`='$pg' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `roommail`   order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  $checkInDate=$fetchs['checkin'];
		  $benefits=$fetchs['benefits'];
		  $mk_checkInDate=changeDateTomkTime($checkInDate);
		 
			if($type==0){
				//$mails[]=$fetchs['id'];
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_checkInDate>=$startDate) && ($mk_checkInDate<=$endDate) ){
						$mails[]=$fetchs['id'];
					}
			}else{
			
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_checkInDate>=$startDate) && ($mk_checkInDate<=$endDate) && ($type=$benefits) ){
						$mails[]=$fetchs['id'];
					}
				
			}
			
		    
			
			
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}


function getmemberIdByTableId($id){
	$execQry=mysql_fetch_row(mysql_query("select `mem_id` from `tablemail` where `id`='$id'  "));
	return $execQry[0];
	
}

function getTableReservationDetailsId($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `tablemail` where `id`='$id'  "));
	return $execQry;
	
}
function getRoomReservationDetailsId($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `roommail` where `id`='$id'  "));
	return $execQry;
	
}


function getBankNameById($id){
	$execQry=mysql_fetch_row(mysql_query("select `name` from `banks` where `id`='$id'  "));
	return $execQry[0];
	
}


function allTableMembers(){
	
	$execQrys=mysql_query("select * from `tablemail`  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}
function allRoomMembers(){
	
	$execQrys=mysql_query("select * from `roommail`  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}

function getBankTransactionDetailsByMemId($mid){
	
	$execQrys=mysql_query("select * from `paymentstats` where `mode`='$mid'  order by `id` ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$values=$fetchs['svalues'];
			$stats=getTabledataById("name","paymentfields",$fetchs['stats']);
			$details[]=$stats."-".$values;
		}
	}else{
			$details[0]="No Data Available";
	}
	return implode(",   ",$details);
	
}

function searchMembersByTransactions($pg,$start,$end,$type){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where   `prog_id`='$pg' and `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members`  where `status`='1'  order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  $dateofsale=$fetchs['dateofsale'];
		  $benefits=$fetchs['modeofpayment'];
		  $mk_dateofsale=changeDateTomkTime($dateofsale);
		 
			if($type==0){
				//$mails[]=$fetchs['id'];
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate) ){
						$mails[]=$fetchs['id'];
					}
			}else{
			
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate) && ($type=$benefits) ){
						$mails[]=$fetchs['id'];
					}
				
			}
			
		    
			
			
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}








function searchMembersByValidity($pg,$start,$end){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where   `prog_id`='$pg' and `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members`  where `status`='1'  order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  
		$memid=$fetchs['id'];
		$dateofsale=$fetchs['dateofsale'];
		$tenure=getTenureById($fetchs['tenure']);
		$expDate=getValidUpto($dateofsale,$tenure);
		
		   $mk_dateofsale=(int)changeDateTomkTime($expDate);
		
		if( ($start==0) && ($end==0 )){
		
			$mails[]=$fetchs['id'];
		}else{
			//echo "<br/>";
			 $startDate=(int)changeDateTomkTime($start);
			//echo "<br/>";
			 $endDate=(int)changeDateTomkTime($end);	
			//die;
			if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate)  ){
				//echo "dsad";
					$mails[]=$fetchs['id'];
			}
		}
		    
	
		}
	}else{
			$mails[0]=0;
	}
		//die;	
			
	return $mails;	
}


function searchMembersByDateOfsale($pg,$start,$end){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where   `prog_id`='$pg' and `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members`  where `status`='1'  order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  
		$memid=$fetchs['id'];
		$dateofsale=$fetchs['dateofsale'];
		
		
		   $mk_dateofsale=(int)changeDateTomkTime($dateofsale);
		
		if( ($start==0) && ($end==0 )){
		
			$mails[]=$fetchs['id'];
		}else{
			//echo "<br/>";
			 $startDate=(int)changeDateTomkTime($start);
			//echo "<br/>";
			 $endDate=(int)changeDateTomkTime($end);	
			//die;
			if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate)  ){
				//echo "dsad";
					$mails[]=$fetchs['id'];
			}
		}
		    
	
		}
	}else{
			$mails[0]=0;
	}
		//die;	
			
	return $mails;	
}



function searchMembersByDateOfsaleAndCashPickup($pg,$start,$end){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where   `prog_id`='$pg' and `pickup`='1' and  `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members`  where `status`='1'  and `pickup`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  
		$memid=$fetchs['id'];
		$dateofsale=$fetchs['dateofsale'];
		
		
		   $mk_dateofsale=(int)changeDateTomkTime($dateofsale);
		
		if( ($start==0) && ($end==0 )){
		
			$mails[]=$fetchs['id'];
		}else{
			//echo "<br/>";
			 $startDate=(int)changeDateTomkTime($start);
			//echo "<br/>";
			 $endDate=(int)changeDateTomkTime($end);	
			//die;
			if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate)  ){
				//echo "dsad";
					$mails[]=$fetchs['id'];
			}
		}
		    
	
		}
	}else{
			$mails[0]=0;
	}
		//die;	
			
	return $mails;	
}






function searchMembersByDateOfsaleAndCConline($pg,$start,$end){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where   `prog_id`='$pg' and `pickup`='2' and  `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members`  where `status`='1'  and `pickup`='2' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  
		$memid=$fetchs['id'];
		$dateofsale=$fetchs['dateofsale'];
		
		
		   $mk_dateofsale=(int)changeDateTomkTime($dateofsale);
		
		if( ($start==0) && ($end==0 )){
		
			$mails[]=$fetchs['id'];
		}else{
			//echo "<br/>";
			 $startDate=(int)changeDateTomkTime($start);
			//echo "<br/>";
			 $endDate=(int)changeDateTomkTime($end);	
			//die;
			if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate)  ){
				//echo "dsad";
					$mails[]=$fetchs['id'];
			}
		}
		    
	
		}
	}else{
			$mails[0]=0;
	}
		//die;	
			
	return $mails;	
}

function getRefferredByMem($memId){
	if($memId==0){
		return "";	
	}else{
	
	$name=getMemberNameById($memId);
	$progId=getProgramIdByMemberId($memId);
	$memShipNo=getMemberShipNumber($progId,$memId);
	$memname=$name." - ".$memShipNo;
	return  $memname;
	
	}
}
function getReferredMembers(){
	
	$execQrys=mysql_query("select `referredby` from `members` where `status`='1' and `referredby`!='0' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['referredby'];
		}
	}else{
			$mails[0]=0;
	}
	$unqMembers=array_unique($mails);
	
	return $unqMembers;	
}

function getReferredMembersByProg($pg){
	
	$execQrys=mysql_query("select `referredby` from `members` where `status`='1' and `referredby`!='0'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['referredby'];
		}
	}else{
			$mails[0]=0;
	}
	
	$unqMembers=array_unique($mails);
	
	
	$impIds=implode(",",$unqMembers);
	
	$execQrys=mysql_query("select `id` from `members` where `prog_id`='$pg' and `id` IN ($impIds)  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$members[]=$fetchs['id'];
		}
		
	}else{
		$members[0]=0;
	}
	
	
	
	return $members;	
}




function getMembersWhoReferredByProg($pg){
	
	$execQrys=mysql_query("select * from `members` where `status`='1' and `referredby`!='0'  and `prog_id`='$pg'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$members[]=$fetchs['referredby'];
		}
	}else{
			$members[0]=0;
	}
	
	$unqMembers=array_unique($members);
	return $members;	
}



function getMembersWhoReferred(){
	
	$execQrys=mysql_query("select * from `members` where `status`='1' and `referredby`!='0'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$members[]=$fetchs['referredby'];
		}
	}else{
			$members[0]=0;
	}
	
	$unqMembers=array_unique($members);
	
	return $members;	
	
	
}


function getAllProgram(){
	
	$execQrys=mysql_query("select * from `programs` where `status`='1' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}



function getAllProgramByIdAnddate($pg,$start,$end,$type){
	$mails=array();
	if($pg>0){
		$query="select * from `members` where   `prog_id`='$pg' and `status`='1' order by `id` Desc";
		$execQrys=mysql_query($query);	
	}else{
		$query="select * from `members`  where `status`='1'  order by `id` Desc";
		$execQrys=mysql_query($query);	
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		  $dateofsale=$fetchs['dateofsale'];
		  $benefits=$fetchs['modeofpayment'];
		  $mk_dateofsale=changeDateTomkTime($dateofsale);
		 
			if($type==0){
				//$mails[]=$fetchs['id'];
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate) ){
						$mails[]=$fetchs['id'];
					}
			}else{
			
					$startDate=changeDateTomkTime($start);
					$endDate=changeDateTomkTime($end);	
					if( ($mk_dateofsale>=$startDate) && ($mk_dateofsale<=$endDate) && ($type=$benefits) ){
						$mails[]=$fetchs['id'];
					}
				
			}
			
		    
			
			
		}
	}else{
			$mails[0]=0;
	}
	return $mails;	
}

function getTotalEmbossingByProgId($pid){
	$total =(int)getTotalPrimaryEmbossingByProgId($pid)+(int)getTotalSpouseEmbossingByProgId($pid);
	return $total;
	
}

function getTotalEmbossingListMembers($pid){
	//$total =(int)getTotalPrimaryEmbossingByProgId($pid)+(int)getTotalSpouseEmbossingByProgId($pid);
	//return $total;
}






function getCurrentTotalPrimaryEmbossingByProgId($pid,$pdate){
	//echo $pid;
	$execQrys=mysql_query("select * from `embossinglist` where `status`='1' and  `pdate`='$pdate'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	
	//print_r($mails);
	//die;
	
	foreach($mails as $memId){
		 $progId=getProgramIdByAllMemberId($memId);
		if($pid==$progId){
			$members[]=$memId;	
		}
	}
	//die;
	return count($members);
	
	
	
	
}




function getTotalPrimaryEmbossingByProgId($pid,$start,$end){
	//echo $pid;
	//echo "select * from `embossinglist` where `status`='1' and `pdate` BETWEEN '$start' AND '$end'  order by `id` Desc";
	//die;
	$execQrys=mysql_query("select * from `embossinglist` where `status`='1' and `pdate` BETWEEN '$start' AND '$end'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['mem_id'];
		}
	}else{
			$mails[0]=0;
	}
	
	//print_r($mails);
	//die;
	
	foreach($mails as $memId){
		 $progId=getProgramIdByAllMemberId($memId);
		if($pid==$progId){
			$members[]=$memId;	
		}
	}
	//die;
	return count($members);
	
	
	
	
}


function checkMemberHasSpouseCard($mid){
	$execQry=mysql_fetch_row(mysql_query("select count(*) from `members` where `id`='$mid' and `spousecard`='1'  "));
	if($execQry[0]>0){
		return true	;
	}else{
		return false;	
	}
}


function getTotalSpouseEmbossingByProgId($pid,$start,$end){
	


$execQrys=mysql_query("select * from `embossinglist` where `status`='1'  and `pdate` BETWEEN '$start' AND '$end' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$memId=$fetchs['mem_id'];
			$checkSpCard=checkMemberHasSpouseCard($memId);
			if($checkSpCard){
				$mails[]=$memId;
			}
		}
	}else{
			$mails[0]=0;
	}
	
	foreach($mails as $memId){
		$progId=getProgramIdByAllMemberId($memId);
		if($pid==$progId){
			$members[]=$memId;	
		}
	}
	
	return count($members);

	
	
}

function getCurrentTotalSpouseEmbossingByProgId($pid,$pdate){
//echo $pdate;
$execQrys=mysql_query("select * from `embossinglist` where `status`='1'  and  `pdate`='$pdate' order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$memId=$fetchs['mem_id'];
			$checkSpCard=checkMemberHasSpouseCard($memId);
			if($checkSpCard){
				$mails[]=$memId;
			}
		}
	}else{
			$mails[0]=0;
	}
	
	foreach($mails as $memId){
		$progId=getProgramIdByAllMemberId($memId);
		if($pid==$progId){
			$members[]=$memId;	
		}
	}
	
	return count($members);

	
	
}


function getProgramtext($pg){
	if($pg==0){
		return "All Program";	
	}else{
		return getProgramNameById($pg);
	}
}

function getPerformanceReport($month,$year,$id){
$mails=array();	
	$execQrys=mysql_query("select * from `members` where `a_id`='$id'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			
			$dateofsale=$fetchs['dateofsale'];
			$expDate=explode("/",$dateofsale);
			$monthOfSale=$expDate[1];
			$yearOfSale=$expDate[2];
			
			if( ($month==$monthOfSale) && ($year==$yearOfSale) ){
				$mails[]=$memId;
			}
		}
	}else{
			//$mails[0]='';
	}
	return count($mails);
	
}


function getSalesByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear){
	$mails=array();
	if($i<=9){
	$day="0".$i;	
	}else{
	$day=$i;	
	}
$dateofsale=$day."/".$curMonth."/".$curYear;

//echo "select * from `members` where `prog_id`='$pid' and `mlevel`='$level' and `dateofsale`='$dateofsale'  order by `id` Desc";

$execQrys=mysql_query("select * from `members` where `prog_id`='$pid' and `mlevel`='$level' and `dateofsale`='$dateofsale'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			
			$mails[]=$fetch['id'];
		}
	}else{
			//$mails[0]=0;
	}
	$count=count($mails);
	return $count;
	 
 }
 
 
 function getSalesCancelByPidLidDayMonthYear($pid,$level,$i,$curMonth,$curYear){
	$mails=array();
	if($i<=9){
	$day="0".$i;	
	}else{
	$day=$i;	
	}
$dateofsale=$day."/".$curMonth."/".$curYear;

//echo "select * from `members` where `prog_id`='$pid' and `mlevel`='$level' and `dateofsale`='$dateofsale'  order by `id` Desc";

$execQrys=mysql_query("select * from `members` where `prog_id`='$pid' and `mlevel`='$level' and `dateofsale`='$dateofsale' and `status`='2'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			
			$mails[]=$fetch['id'];
		}
	}else{
			//$mails[0]=0;
	}
	$count=count($mails);
	return $count;
	 
 }
 
 
 function getSalesByPidLidStartDayEndDay($pid,$level,$start,$end){
	$mails=array();


$execQrys=mysql_query("select * from `members` where `prog_id`='$pid' and `mlevel`='$level'  and `status`='1'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$dateofsale=changeDateTomkTime($fetchs['dateofsale']);
			$start=changeDateTomkTime($start);
			$end=changeDateTomkTime($end);
			if( ($dateofsale>=$start) && ($dateofsale<=$end) ){
			$mails[]=$fetch['id'];
			}
		}
	}else{
			//$mails[0]=0;
	}
	return count($mails);
	 
	 
 }
 
 function getSalesCancelByPidLidStartDayEndDay($pid,$level,$start,$end){
	$mails=array();


$execQrys=mysql_query("select * from `members` where `prog_id`='$pid' and `mlevel`='$level'   and `status`='2'  order by `id` Desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			
			$dateofsale=changeDateTomkTime($fetchs['dateofsale']);
			$start=changeDateTomkTime($start);
			$end=changeDateTomkTime($end);
			if( ($dateofsale>=$start) && ($dateofsale<=$end) ){
			$mails[]=$fetch['id'];
			}
		}
	}else{
			//$mails[0]=0;
	}
	return count($mails);
	 
	 
 }
 
$mailemp=array();
function getReportToemployee($id){
	global $mailemp;
	$execQrys=mysql_query("select `id` from `admin` where `reportto`='$id' ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$empids= $fetchs['id']; //37,38
			$mailemp[]= $empids;
			 getReportToemployee($empids);
		  }
		
		
	}else{
	//$mailemp[]=  $empids;	
	}
	return   $mailemp;
}


function getNumberofCostPerSalesByStartDayEndDay($pid,$month,$year,$emp){
	$mails=array();

if($pid==0){
	$execQrys=mysql_query("select * from `members` where  `status`='1' and `a_id` ='$emp'  order by `id` Desc");
}else{
	$execQrys=mysql_query("select * from `members` where `prog_id`='$pid'   and `status`='1'  and `a_id` ='$emp'  order by `id` Desc");
}
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$dateofsale=$fetchs['dateofsale'];
			$dateofsalemonth=getDateofSaleMonth($dateofsale);
			$dateofsaleyear=getDateofSaleYear($dateofsale);
			if( ($dateofsalemonth==$month) && ($dateofsaleyear==$year) ){
			$mails[]=$fetch['id'];
			}
		}
	}else{
			//$mails[0]=0;
	}
	return count($mails);
	 
	 
 }

function getDateofSaleMonth($date){
	$expDate=explode("/",$date);
	$newDate=$expDate[1];
	return $newDate;
}
function getDateofSaleYear($date){
	$expDate=explode("/",$date);
	$newDate=$expDate[2];
	return $newDate;
}
function getEmployeeAmtPaidAsSalaryAndIncentive($empid,$month,$year){
	$execQry=mysql_fetch_row(mysql_query("select * from `empsalary` where `empid`='$empid' and `month`='$month' and `year`='$year'  "));
	$salary=$execQry[17];
	$incentive=$execQry[4];
	$bonus=$execQry[5];
	return (int)$salary+(int)$incentive+(int)$bonus;
	
}
 function getMembersByProgId($pid){
	$execQrys=mysql_query("select * from `members` where `status` = '1' and `prog_id`='$pid' order by `id` desc");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$mails[]=$fetchs['id'];
		}
	}else{
			$mails[0]=0;
	}
	return $mails;
	
}
function getLeadId($id){
$value=1000+$id	;
return "LD".$value;
}

function getClientsNameById($id){
	$fetchRes=mysql_fetch_row(mysql_query("select * from `leads` where `id` ='$id' "));
	
	$name=$fetchRes[1]." ".$fetchRes[2]." ".$fetchRes[3];
	
	return $name;	
	
}
function getClientsCompNameById($id){
	$fetchRes=mysql_fetch_row(mysql_query("select * from `leads` where `id` ='$id' "));
	
	$name=$fetchRes[19];
	
	return $name;	
	
}
function getClientContact($aid){
	$edtQry=mysql_query("Select * from `leads` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	
	$mobile=stripslashes($userData[5]);
	$mobilealt=stripslashes($userData[6]);
	
	
	if( ($mobile=='') && ($mobilealt=='') ){
		return "Not Mentioned";	
	}else{
	
	$contact=array($mobile,$mobilealt);
	foreach($contact as $tel){
	if(!$tel==''){
		$contactNew[]=$tel;	
	}
		
	}
	
	
	$impCont=implode(", ",$contactNew);
	return $impCont;	
	}
	
		
}

function getClientLocation($aid){
	$locationNew=array();
	$edtQry=mysql_query("Select * from `leads` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	
	 $state=getStateNameById($userData[10]);
	 $city=getCityNameById($userData[11]);
	$area=getAreaNameById($userData[12]);
	
	
	
	
	$location=array($area,$city,$state);
	foreach($location as $tel){
			if(!$tel==''){
				$locationNew[]=$tel;	
			}
		
	}
	
	
	$impCont=implode(", ",$locationNew);
	return $impCont;	
	
	
		
}

function getAreaNameById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `locations` where `id`='$id'"));
	return $resultSet[1];
}
function getLeadsDetailById($id){
	$resultSet=mysql_fetch_row(mysql_query("select * from `leads` where `id`='$id'"));
	return $resultSet;
}

function getLeadStatus($value){
	//echo $value;
	if($value==1){
	 return "<span class='label label-warning'>Follow Up</span>";	
	}
	if($value==2){
		 return "<span class='label label-primary'>Meeting</span>";	
	}
	if($value==3){
		return "<span class='label label-success'>Sales</span>";
	}
		if($value==4){
		return "<span class='label label-danger'>Not Interested</span>";
	}
	
}


function getLeadName($value){
	//echo $value;
	if($value==1){
	 return "Follow Up";	
	}
	if($value==2){
		 return "Meeting";	
	}
	if($value==3){
		return "Sales";
	}
		if($value==4){
		return "Not Interested";
	}
	
}

function countLeadTypesByDate($id){
	$currentDate=date("Y-m-d");
	if($id==1){  // followups
		$count=count(getTotalFollowUpsByCurrentdate());	
	}
	if($id==2){  // Meetings
		$count=count(getTotalMeetingsByCurrentdate());	
	}
	return $count;
}


function getTotalFollowOrMeetingByDateAndType($type){
	if($type==1){
		return getTotalFollowUpsByCurrentdate();
	}
	if($type==2){
		return getTotalMeetingsByCurrentdate();	
	}
}



function checkLeadRefInFollowUpTableByCurDate($lid){
		    $currentDate=date("Y-m-d");
			$resultSet=mysql_fetch_row(mysql_query("select count(*) from `followups` where `lid`='$lid' and `status`='1' and `meetingdate`='$currentDate'"));
			if($resultSet[0]>0){
				return true	;
			}else{
				return false;	
			}
}


function checkLeadRefInMeeingTableByCurDate($lid){
		    $currentDate=date("Y-m-d");
		
			$resultSet=mysql_fetch_row(mysql_query("select count(*) from `meetings` where `lid`='$lid' and `status`='1' and `meetingdate`='$currentDate'"));
			if($resultSet[0]>0){
				return true	;
			}else{
				return false;	
			}
}



function checkLatestMeeingFollowup($lid){
		
			$resultSet=mysql_fetch_row(mysql_query("select count(*) from `meetings` where `lid`='$lid' and `status`='1' "));
			if($resultSet[0]>0){
				return true	;
			}else{
				return false;	
			}
}


function checkLatestLeadFollowup($lid){
		
			$resultSet=mysql_fetch_row(mysql_query("select count(*) from `followups` where `lid`='$lid' and `status`='1' "));
			if($resultSet[0]>0){
				return true	;
			}else{
				return false;	
			}
}




function checkLeadRefInMeeingTableByDate($lid,$date){
		    $currentDate=$date;
		
			$resultSet=mysql_fetch_row(mysql_query("select count(*) from `meetings` where `lid`='$lid' and `status`='1' and `meetingdate`='$currentDate'"));
			if($resultSet[0]>0){
				return true	;
			}else{
				return false;	
			}
}

function getTotalFollowUpsByCurrentdate(){
	$leads=array();
			$currentDate=date("Y-m-d");
			
			$execQrys=mysql_query("select * from `leads` where `leadtype`='1'  and `status`='1'  ");
			$numRowss=mysql_num_rows($execQrys);
			if($numRowss>0){
			while($fetchs=mysql_fetch_array($execQrys)){
				$lid=$fetchs['id'];
				 $meetingDate=$fetchs['meetingdate'];
				if($currentDate==$meetingDate){
					$leads[]=$lid;	
				}else{
					if(checkLeadRefInFollowUpTableByCurDate($lid)){
						$leads[]=$lid;	
					}else{
						
					}
				}
			}}else{
					
			}
			
		return $leads;	
			
			
}



function getTotalMeetingsByCurrentdate(){
			$leads=array();
			$currentDate=date("Y-m-d");
			$execQrys=mysql_query("select * from `leads` where `leadtype`='2'  and `status`='1'  ");
			$numRowss=mysql_num_rows($execQrys);
			if($numRowss>0){
			while($fetchs=mysql_fetch_array($execQrys)){
				$lid=$fetchs['id'];
				 $meetingDate=$fetchs['meetingdate'];
				if($currentDate==$meetingDate){
					$leads[]=$lid;	
				}else{
					if(checkLeadRefInMeeingTableByCurDate($lid)){
						$leads[]=$lid;	
					}else{
						
					}
				}
			
			
			}}else{
				
				
				
					
			}
			
		return $leads;	
			
			
}




function getTotalMeetingsByDate($date){
			$leads=array();
			$execQrys=mysql_query("select * from `leads` where `leadtype`='2'  and `status`='1'  ");
			$numRowss=mysql_num_rows($execQrys);
			if($numRowss>0){
			while($fetchs=mysql_fetch_array($execQrys)){
				$lid=$fetchs['id'];
				 $meetingDate=$fetchs['meetingdate'];
				if($date==$meetingDate){
					$leads[]=$lid;	
				}else{
					if(checkLeadRefInMeeingTableByDate($lid,$date)){
						$leads[]=$lid;	
					}else{
						
					}
				}
			}}else{
		}
			
		return $leads;	
			
			
}




function checkLeadsNotification(){
	$flag=0;
	$currentDate=date("Y-m-d");
	$execQrys=mysql_query("select * from `leadtypes` where `status` = '1' ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id=$fetchs['id'];
			
			$resultSet=mysql_fetch_row(mysql_query("select count(*) from `leads` where `leadtype`='$id' and `meetingdate`='$currentDate'"));
			$resultSetFollowup=mysql_fetch_row(mysql_query("select count(*) from `followups` where  `meetingdate`='$currentDate'"));
			
			if(  ($resultSet[0]>0 ) || ($resultSetFollowup[0]>0 ) ){
			$flag=1;	
			}
		}
	}
	
return $flag;
	
}

function getLeadIdsByType($type){
	
	$currentDate=date("Y-m-d");
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and `leadtype`='$type' ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id=$fetchs['id'];
			$resultSet=mysql_fetch_row(mysql_query("select `id` from `leads` where `leadtype`='$id' and `meetingdate`='$currentDate'"));
			if($resultSet[0]>0){
			$flag=1;	
			}
		}
	}
	
}

function getAssignedMeetings(){
	$id=array();
	$currentDate=date("Y-m-d");
	$execQrys=mysql_query("select * from `assignleads` where `status` = '1'  ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['lid'];
		}
	}
	return $id;
}


function getTotalMeetingLeads(){
	$id=array();
	$currentDate=date("Y-m-d");
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and `leadtype`='2'  ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['id'];
		}
	}
	return $id;
	
}

function getTotalMeetingLeadsByTeam($team){
	$id=array();
	$impTeam=implode(",",$team);
	$currentDate=date("Y-m-d");
	
	$execQrys=mysql_query("select * from `leads` where `status` != '2' and `leadtype`='2'  and `a_id` IN ($impTeam) ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['id'];
		}
	}
	return $id;
	
}
function getTotalAssignedMeetingLeads(){
	$id=array();
	$currentDate=date("Y-m-d");
	$execQrys=mysql_query("select * from `assignleads` where `status` = '1'   and `display`='1'  ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid=$fetchs['lid'];
			 $meetDate=getLatestMeetingDatesByLid($lid);
			//echo "<br/>";
			if($meetDate>=$currentDate){
				$id[]=$fetchs['id'];
			}else{
				$id[0]=0;	
			}
			
			
			
		}
	}else{
		$id[0]=0;		
	}
	
	return $id;
	
}

function getTotalAssignedMeetingLeadsById($aid){
	$id=array();
	$currentDate=date("Y-m-d");
	//echo "select * from `assignleads` where `status` = '1'  and `emp_id`='$aid' and `display`='1' ";die;
	$execQrys=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`='$aid' ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid=$fetchs['lid'];
			$meetDate=getLatestMeetingDatesByLid($lid);
			if($meetDate>=$currentDate){
				  $leadStatus=getLeadStatusByLid($lid);
				/// echo "dsa";
				 if($leadStatus==2){
					$id[]=$fetchs['id'];
				 }
			}else{
			//$id[0]=0;		
			}
		}
	}else{
		$id[0]=0;	
	}
	//print_r($id);
	//die;
	return $id;
}









function designationsForFieldJobs(){
	$id=array();
	
	$execQrys=mysql_query("select * from `designations` where `status` = '1' and `field`='1'  ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['id'];
		}
	}
	return $id;
}

function getMarketingExecutivesByTeamLeadId($team){
	$impTeam=implode(",",$team);
	$designations=designationsForFieldJobs();
	$impDesignations=implode(",",$designations);
	$id=array();
	
	$execQrys=mysql_query("select * from `admin` where `status` = '1' and  `id` IN($impTeam) and `designation` IN ($impDesignations) ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['id'];
		}
	}
	return $id;
}


function getMarketingExecutivesByAdmin(){
	$designations=designationsForFieldJobs();
	$impDesignations=implode(",",$designations);
	$id=array();
	$execQrys=mysql_query("select * from `admin` where `status` = '1' and `skey`!='1'  and `designation` IN ($impDesignations) ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['id'];
		}
	}
	return $id;
}

function countEmpMeetingOnDateByLids($eid,$lidArr){
	$id=array();
	$impLids=implode(",",$lidArr);
	$execQrys=mysql_query("select * from `assignleads` where `emp_id` = '$eid' and `status`='1'  and `lid` IN ($impLids) ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$id[]=$fetchs['id'];
		}
	}
	$total=count($id);
	return $total;
}

function getAssignedLeadDetailsById($id){
	$execQry=mysql_fetch_row(mysql_query("select * from `assignleads` where `id`='$id'  "));
	return $execQry;
	
}

function getLeadStatusByLid($id){
	$execQry=mysql_fetch_row(mysql_query("select `leadtype` from `leads` where `id`='$id'  "));
	return $execQry[0];
	
}


function getAssignedEmployeeNameByLid($lid){
	$execQry=mysql_fetch_row(mysql_query("select `emp_id` from `assignleads` where `lid`='$lid'  "));
	return getEmployeeNameById($execQry[0]);
}

function getLeadIdByAssignLid($id){
	$execQry=mysql_fetch_row(mysql_query("select `lid` from `assignleads` where `id`='$id'  "));
	return $execQry[0];
}

function getLatestMeetingDatesByLid($lid){
	//echo "select * from `leads` where `id`='$lid'   ";
			$execQrys=mysql_query("select * from `leads` where `id`='$lid'   ");
			$numRowss=mysql_num_rows($execQrys);
			if($numRowss>0){
			$fetchRes=mysql_fetch_row($execQrys);	
			if(checkLatestMeeingFollowup($lid)){
						$meetinDate=getLatestMeetingDateByLeadId($lid);	
					}else{
						
						$meetinDate=$fetchRes[26];
					}}else{
						$meetinDate='';
			}
		return $meetinDate;	
			
			
 }
 
 
 function getLatestFollowUpDatesByLid($lid){
	//echo "select * from `leads` where `id`='$lid'   ";
			$execQrys=mysql_query("select * from `leads` where `id`='$lid'   ");
			$numRowss=mysql_num_rows($execQrys);
			if($numRowss>0){
			$fetchRes=mysql_fetch_row($execQrys);	
			if(checkLatestLeadFollowup($lid)){
						$meetinDate=getLatestFollowDateByLeadId($lid);	
					}else{
						
						$meetinDate=$fetchRes[26];
					}}else{
						$meetinDate='';
			}
		return $meetinDate;	
			
			
 }
 
 

function getLatestMeetingDateByLeadId($lid){
	$execQry=mysql_fetch_row(mysql_query("select `meetingdate` from `meetings` where `lid`='$lid' order by `id` desc limit 0,1  "));
	return $execQry[0];
}

function getLatestFollowDateByLeadId($lid){
	$execQry=mysql_fetch_row(mysql_query("select `meetingdate` from `followups` where `lid`='$lid' order by `id` desc limit 0,1  "));
	return $execQry[0];
}


function searchTotalAssignedMeetingLeadsBydate($sdate,$edate,$aid,$type){
	$id=array();
	$currentDate=date("Y-m-d");
	$startDate=changeDateTomkTime($sdate);
	$endDate=changeDateTomkTime($edate);
	
	if($type==1){
		$execQrys=mysql_query("select * from `assignleads` where `status` = '1'   and `display`='1' ");
	
	}else{
		$execQrys=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`='$aid' and `display`='1' ");
		
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid=$fetchs['lid'];
			 $meetDate=getLatestMeetingDatesByLid($lid);
			//echo "<br/>";
			
			$strmeetDate=strtotime($meetDate);
			
			if( ($strmeetDate>=$startDate) && ($strmeetDate<=$endDate) ){
				$id[]=$fetchs['id'];
				}else{
				//$id[0]=0;		
			}
		}
	}else{
		$id[0]=0;	
	}
	return $id;
}




function searchTotalAssignedMeetingLeadsByPlace($state,$city,$area,$aid,$type){
	$id=array();
	
	$currentDate=date("Y-m-d");
	$startDate=changeDateTomkTime($sdate);
	$endDate=changeDateTomkTime($edate);
	
	if($type==1){
		$execQrys=mysql_query("select * from `assignleads` where `status` = '1'   and `display`='1' ");
	
	}else{
		$execQrys=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`='$aid' and `display`='1' ");
		
	}
	
	
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid=$fetchs['lid'];
			$leadDetArr=getLeadsDetailById($lid);
			
			$leadState=$leadDetArr[10];
			
			$leadCity=$leadDetArr[11];
			//echo "<br/>";
			$leadArea=$leadDetArr[12];
			
			
			if( ($city==0) && ($area==0)){
				if($state==$leadState){
					$id[]=$fetchs['id'];
				}
			}
			if( (!$city==0) && ($area==0)){
			
				if( ($state==$leadState) && ($city==$leadCity)){
					$id[]=$fetchs['id'];
				}	
			}
			if( (!$city==0) && (!$area==0)){
				if( ($state==$leadState) && ($city==$leadCity) && ($area==$leadArea)){
					$id[]=$fetchs['id'];
				}	
			}
		
			
			
			
			
		}
	}else{
		$id[0]=0;	
	}
	
	
	return $id;
}




function searchTotalAssignedMeetingLeadsBydateAndPlace($sdate,$edate,$state,$city,$area,$aid,$type){
	$id=array();
	$date=searchTotalAssignedMeetingLeadsBydate($sdate,$edate,$aid,$type);
	//print_r($date);
	
	$place=searchTotalAssignedMeetingLeadsByPlace($state,$city,$area,$aid,$type);
	
	//print_r($place);
	$id=array_intersect($date,$place);
	//print_r($id);
	//die;
	return $id;
	
}
function getLocationText($state,$city,$area){
	$location=array();
	$meetingAdd=array();
	
	$location[] = getAreaNameById($area);
	$location[] = getCityNameById($city);
	$location[] = getStateNameById($state);
	
	foreach($location as $ltext){
		if(!$ltext==''){
			$meetingAdd[]=$ltext;
		}
	}
	
	$impAdd=implode(",",$meetingAdd);
	return $impAdd;
	
}

function getLatLongFromAddress($address){
	$prepAddr = str_replace(' ','+',$address);
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	$output= json_decode($geocode);
	$lat = $output->results[0]->geometry->location->lat;
	$long = $output->results[0]->geometry->location->lng;
	return $lat.','.$long;
}

function getMarkersofLeads($leads){
	foreach($leads as $lid){
		$leadid=getLeadIdByAssignLid($lid);
		$address[] = getClientLocation($leadid);
	}
	foreach( $address as $location ){
		$marker[]= "['".$location."',".getLatLongFromAddress($location)."]";
	}
	$markersAll=implode(",",$marker);
	return $markersAll;
}

function getMarkerAddress($leads){
	foreach($leads as $lid){
		$leadid=getLeadIdByAssignLid($lid);
		$leadDetailArr=getLeadsDetailById($leadid);
		$clientName=getClientsNameById($leadid);
		$clientLocation = getClientLocation($leadid);
		$address=$leadDetailArr[8].",".$leadDetailArr[9].",".$clientLocation;
		$marker[]='['."'".'<div class="info_content"><h3>Meeting on date at time </h3><p>'.$clientName.'</p><p>'.$clientLocation.'</p> </div>'."'".']';
	}
	$markersAll=implode(",",$marker);
	return $markersAll;
	
 }



function getTotalLeadsByDate($month,$year){
	$dateFormat=$year."-".$month;
	$lid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat'   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return $lid;
	
}
function getTotalLeadsByDateAndId($month,$year,$id){
	$dateFormat=$year."-".$month;
	$lid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat'   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return $lid;
	
}


function getLeadTypeCountByDate($type,$month,$year){
	
	$dateFormat=$year."-".$month;
	$lid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='$type'   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return count($lid);
	
}
function getLeadTypeCountByDateAndId($type,$month,$year,$team){
	$teamIds=implode(",",$team);	
	$dateFormat=$year."-".$month;
	$lid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='$type' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return count($lid);
}

function getFollowCountByDateAndId($month,$year,$team){
	$teamIds=implode(",",$team);	
	$dateFormat=$year."-".$month;
	$lid=array();
//	echo "select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='1' and `a_id`in ($teamIds)   ";
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='1' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return count($lid);
}

function getFollowCountByDateAndEmpId($month,$year,$aid){
	$teamIds=implode(",",$team);	
	$dateFormat=$year."-".$month;
	$lid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='1' and `a_id` ='$aid'   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return count($lid);
}

function getMeetingCountByDateAndId($month,$year,$team){
	$teamIds=implode(",",$team);	
	
	$dateFormat=$year."-".$month;
	$lid=array();
	$mlid=array();
	//echo "select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='2' and `a_id`in ($teamIds)   ";
	
	$execQrys=mysql_query("select * from `leads` where `status` = '1'  and `leadtype`='2' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		
			$leadId=$fetchs['id'];
		    $meetDate=getLatestMeetingDatesByLid($leadId);
			$expDate=explode("-",$meetDate);
			$expFormat=$expDate[0]."-".$expDate[1];
			if($dateFormat==$expFormat){
			
					$lid[]=$fetchs['id'];
			
			}
			
			
		}
	}
	//print_r($lid);
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds)   ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
			 $meetLid=$fetchsm['lid'];
		     $meetDatem=getLatestMeetingDatesByLid($meetLid);
			 $expDatem=explode("-",$meetDatem);
			 $expFormatm=$expDatem[0]."-".$expDatem[1];
			 if($dateFormat==$expFormatm){

			$mlid[]=$fetchsm['lid'];
			
			}
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	
	return count($uleads);
	
}





function getMeetingByTeam($team){
	$teamIds=implode(",",$team);	
	$dateFormat=$year."-".$month;
	$lid=array();
	$mlid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1'  and `leadtype`='2' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
//	print_r($lid);
	//$meetingLeads=
	
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds)   ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
		    $meetLid=$fetchsm['lid'];
		    $leadStatus=getLeadStatusByLid($meetLid);
			if($leadStatus==2){
			$mlid[]=$fetchsm['lid'];
			}
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	return $uleads;
}





function getMeetingByTeamBYMonthAndYear($month,$year,$team){
	$teamIds=implode(",",$team);	
	$dateFormat=$year."-".$month;
	$lid=array();
	$mlid=array();
	//echo "select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat  and `leadtype`='2' and `a_id`in ($teamIds)   ";die;
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat'  and `leadtype`='2' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
//	print_r($lid);
	//$meetingLeads=
	
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds)   ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
		    $meetLid=$fetchsm['lid'];
			$meetingDatea=getLatestMeetingDatesByLid($meetLid);
			$explodeMeeting=explode("-",$meetingDatea);
			$format=$explodeMeeting[0]."-".$explodeMeeting[1];
		    $leadStatus=getLeadStatusByLid($meetLid);
			if($leadStatus==2){
			  if($format==$dateFormat){
				$mlid[]=$fetchsm['lid'];
				
				}
			
			}
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	return $uleads;
}


function getTodaysMeetingByTeam($team){
	$teamIds=implode(",",$team);	
	$currentDate=date("Y")."-".date("m")."-".date("d");
	$lid=array();
	$mlid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1'  and `leadtype`='2' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		$leadid=$fetchs['id'];
			$meetingDate=getLatestMeetingDatesByLid($leadid);
			if($meetingDate==$currentDate){
				$lid[]=$fetchs['id'];
			
			}
		}
	}
	
	//echo "select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds)   ";
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds)   ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
				$meetLid=$fetchsm['lid'];
				$leadStatus=getLeadStatusByLid($meetLid);
				if($leadStatus==2){
			    $meetingDatea=getLatestMeetingDatesByLid($meetLid);
			if($meetingDatea==$currentDate){
				
					$mlid[]=$fetchsm['lid'];
				
				}
			
			}
		}
	}
	
//print_r($lid);
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	//print_r($uleads);
	return $uleads;
}



function getTodaysMeetingByTeamBetweenDates($stdate,$endate,$team){
	$teamIds=implode(",",$team);	
	$currentDate=date("Y")."-".date("m")."-".date("d");
	$lid=array();
	$mlid=array();
	$execQrys=mysql_query("select * from `leads` where `status` = '1'  and `leadtype`='2' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
		$leadId=$fetchs['id'];
			$meetingDate=getLatestMeetingDatesByLid($leadId);
			if( ($meetingDate>=$stdate) && ($meetingDate<=$endate) ){
				$lid[]=$fetchs['id'];
			
			}
		}
	}
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds)   ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
		
			$meetLid=$fetchsm['lid'];
				$meetingDatea=	getLatestMeetingDatesByLid($meetLid);
		
				$leadStatus=getLeadStatusByLid($meetLid);
			
				if( ($meetingDatea>=$stdate) && ($meetingDatea<=$endate) ){
					if($leadStatus==2){
							$mlid[]=$fetchsm['lid'];
			
					}
			
			}
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	return $uleads;
}




function getSalesLeadsByMonthYear($month,$year){
	$lid=array();
		$dateFormat=$year."-".$month;
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`dateofsale`,'%Y-%m')='$dateFormat' and `leadtype`='3'   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return $lid;
}

function getNILeadsByMonthYear($month,$year){
	$lid=array();
		$dateFormat=$year."-".$month;
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='4'   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	return $lid;
}

function getSalesCountByDateAndId($month,$year,$team){
	$teamIds=implode(",",$team);	
	
	$dateFormat=$year."-".$month;
	$lid=array();
	$mlid=array();
	
	
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`dateofsale`,'%Y-%m')='$dateFormat' and `leadtype`='3' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
		$salesLead=getSalesLeadsByMonthYear($month,$year);
	if(count($salesLead)>0){
		$impSalesLead=implode(",",$salesLead);
	}else{
		$impSalesLead=0;
	}
	
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds) and `lid` IN ($impSalesLead)  ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
		
			$mlid[]=$fetchsm['lid'];
			
			
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	//print_r($mlid);
	return count($uleads);
	
}




function getSalesByDateAndId($month,$year,$team){
	$teamIds=implode(",",$team);	
	
	$dateFormat=$year."-".$month;
	$lid=array();
	$mlid=array();
	
	
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`dateofsale`,'%Y-%m')='$dateFormat' and `leadtype`='3' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	$salesLead=getSalesLeadsByMonthYear($month,$year);
	if(count($salesLead)>0){
	$impSalesLead=implode(",",$salesLead);
	}else{
	$impSalesLead=0;
	}
	//echo "select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds) and `lid` IN ($impSalesLead)  ";
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds) and `lid` IN ($impSalesLead)  ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
			$mlid[]=$fetchsm['lid'];
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	//print_r($mlid);
	return $uleads;
	
}





function getSalesByTeam($team){
	$teamIds=implode(",",$team);	
	
	$lid=array();
	$mlid=array();
	
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and `leadtype`='3' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	
	
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds)  ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
		      $leadid=$fetchsm['lid'];
			  $leadStatus=getLeadStatusByLid($leadid);
			  if($leadStatus==3){
					$mlid[]=$fetchsm['lid'];
			}
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	//print_r($mlid);
	return $uleads;
	
}



function getLeadsByTeamByDate($team){
	$teamIds=implode(",",$team);	
	
	$lid=array();
	$mlid=array();
	
	$execQrys=mysql_query("select * from `leads` where `status` = '1'  and `leadtype`='3' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	$salesLead=getSalesLeadsByMonthYear($month,$year);
	if(count($salesLead)>0){
		$impSalesLead=implode(",",$salesLead);
	}else{
		$impSalesLead=0;
	}
	//echo "select * from `assignleads` where `status` = '1'  and `emp_id`in ($teamIds) and `lid` IN ($impSalesLead)  ";
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id` in ($teamIds) and `lid` IN ($impSalesLead)  ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
			$mlid[]=$fetchsm['lid'];
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	//print_r($mlid);
	return $uleads;
	
}








function getPaymentRecvByDateAndId($month,$year,$lids){
	$amount=array();
	$dateFormat=$year."-".$month;
		if(count($lids)>0){
			$impLids=implode(",",$lids);
		}else{
			$impLids=0;
		}
	//echo "select * from `creditpaid` where `status` = '1' and  `lid` IN ($impLids)";
	$execQrys=mysql_query("select * from `creditpaid` where `status` = '1' and  `lid` IN ($impLids)");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$paidOnArr=explode("/",$fetchs[12]);
			$paidFormat=$paidOnArr[2]."-".$paidOnArr[1];
			if($paidFormat==$dateFormat){
			$amount[]=$fetchs['netamount'];
			
			}
		}
	}
	
return array_sum($amount);	
}


function getNICountByDateAndId($month,$year,$team){
	$teamIds=implode(",",$team);	
	
	$dateFormat=$year."-".$month;
	$lid=array();
	$mlid=array();
	
	
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='4' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	$niLead=getNILeadsByMonthYear($month,$year);
	if(count($niLead)>0){
	$impNILead=implode(",",$niLead);
	}else{
	$impNILead=0;
	}
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id` in ($teamIds) and `lid` IN ($impNILead)  ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
			$mlid[]=$fetchsm['lid'];
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	//print_r($mlid);
	return count($uleads);
	
}



function calculateTargetAcheived($month,$year,$salesids){
	if(count($salesids)==0){
		$acheived=0;
	}else{
	
	$salesleads=implode(",",$salesids);	
	$dateFormat=$year."-".$month;
	$amount=array();
	//echo "select * from `creditpaid` where `status` = '1' and date_format(`pdate`,'%Y-%m')='$dateFormat' and `lid` IN ($salesleads)   ";
	$execQrys=mysql_query("select * from `creditpaid` where `status` = '1' and date_format(`pdate`,'%Y-%m')='$dateFormat' and `lid` IN ($salesleads)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$amount[]=$fetchs['netamount'];
		}
	}
	
	$acheived=array_sum($amount);
	
	}
	
	return $acheived;
	
}





function getNIReportByDateAndId($month,$year,$team){
	$teamIds=implode(",",$team);	
	
	$dateFormat=$year."-".$month;
	$lid=array();
	$mlid=array();
	
	
	$execQrys=mysql_query("select * from `leads` where `status` = '1' and date_format(`meetingdate`,'%Y-%m')='$dateFormat' and `leadtype`='4' and `a_id`in ($teamIds)   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid[]=$fetchs['id'];
		}
	}
	$niLead=getNILeadsByMonthYear($month,$year);
	if(count($niLead)>0){
	$impNILead=implode(",",$niLead);
	}else{
	$impNILead=0;
	}
	$execQrysm=mysql_query("select * from `assignleads` where `status` = '1'  and `emp_id` in ($teamIds) and `lid` IN ($impNILead)  ");
	$numRowssm=mysql_num_rows($execQrysm);
	if($numRowssm>0){
		while($fetchsm=mysql_fetch_array($execQrysm)){
			$mlid[]=$fetchsm['lid'];
		}
	}
	$leads=array_merge($lid,$mlid);
	$uleads=array_unique($leads);
	//print_r($mlid);
	return $uleads;
	
}


function getTotalSaleReportByDate($year){
	$monthRange=range(1,12);
	foreach($monthRange as $month){
		if($month<=9){
			$month="0".$month;	
		}
		$sales[]=getLeadTypeCountByDate(3,$month,$year);
		
	}
	return $sales;
}

function getTotalSaleReportByDateAndTeam($year,$team){
	$monthRange=range(1,12);
	foreach($monthRange as $month){
		if($month<=9){
			$month="0".$month;	
		}
		$sales[]=getSalesCountByDateAndId($month,$year,$team);
		
	}
	return $sales;
}

function getGraphicalTotalSaleReport($team,$year){
	$monthRange=range(1,12);
	foreach($monthRange as $month){
		if($month<=9){
			$month="0".$month;	
		}
		$sales[]=getSalesCountByDateAndId($month,$year,$team);
		
	}
	return $sales;
}

function getGraphicalTotalNIReport($team,$year){
	$monthRange=range(1,12);
	foreach($monthRange as $month){
		if($month<=9){
			$month="0".$month;	
		}
		$sales[]=getNICountByDateAndId($month,$year,$team);
		
	}
	return $sales;
}


$teamm=array();
function displayteam($id){
	global $teamm;
	$query = mysql_query("SELECT * FROM `admin` where `reportto`='$id' and `status`='1' ");
	
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	while($fetchRes=mysql_fetch_array($query)){
		$id=$fetchRes[0];
		if(hasChild($id)){
			$teamm[]=$id;
			displayteam($id);
			
		}else{
			$teamm[]=$id;
			displayteam($id);
		}
	
	}	
		
		
			
}
return $teamm;
}

function hasChild($id){
	$execQry=mysql_fetch_row(mysql_query("select count(*) from `admin` where `reportto`='$id'  "));
	$count= $execQry[0];
	if($count>0){
		return true;
	}else{
		return false;
	}
}

function getLeadidsBetweenMeetingDates($sdate,$edate,$qry){
	$id=array();
	$startDate=changeDateTomkTime($sdate);
	$endDate=changeDateTomkTime($edate);
	$execQrys=mysql_query("select * from `leads` where `leadtype`='1' and `status`!='2' $qry   ");
	$numRowss=mysql_num_rows($execQrys);
	if($numRowss>0){
		while($fetchs=mysql_fetch_array($execQrys)){
			$lid=$fetchs['id'];
			$meetDate=getLatestFollowUpDatesByLid($lid);	
			
			
			$strmeetDate=strtotime($meetDate);
			
			if( ($strmeetDate>=$startDate) && ($strmeetDate<=$endDate) ){
				$id[]=$lid;
				}else{
				//$id[0]=0;		
			}
		}
	}
	return $id;
			

}

function getUnassignedLeads($adminId,$type){
	$lidl=array();
	$id=array();
	if($type==1){ //admin
			$execQrys=mysql_query("select * from `leads` where `status` = '1' and `leadtype`='2'  ");
			$numRowss=mysql_num_rows($execQrys);
				if($numRowss>0){
					while($fetchs=mysql_fetch_array($execQrys)){
					$id[]=$fetchs['id'];
				}
			}
	}else{
		 $team=displayteam($adminId);
		 array_push($team,$adminId);
		 
		 $impTeamId=implode(",",$team);
		
		$execQrys=mysql_query("select * from `leads` where `status` = '1' and `leadtype`='2' and `a_id` IN ($impTeamId)  ");
			$numRowss=mysql_num_rows($execQrys);
				if($numRowss>0){
					while($fetchs=mysql_fetch_array($execQrys)){
					$id[]=$fetchs['id'];
				
				}
			}
		
	}
	
	
	
	
	$execQrysl=mysql_query("select * from `assignleads` where `status` = '1'   ");
			$numRowssl=mysql_num_rows($execQrys);
				if($numRowssl>0){
					while($fetchsl=mysql_fetch_array($execQrysl)){
					$lidl[]=$fetchsl['lid'];
				}
			}
			
		$unassigned=array_diff($id,$lidl);	
	
	
return $unassigned;	
	
}

function checkMemberHasChild($aid){
		$resultSet=mysql_fetch_row(mysql_query("select count(*) from `admin` where `reportto`='$aid' "));
		$count=	$resultSet[0];
		if($count>0){
			return true;
		}else{
			return false;
		}
}


function displayMembers($id){
	$members=array();
	$query = mysql_query("SELECT * FROM `admin` where `reportto`='$id' and `status`='1' ");
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	while($fetchRes=mysql_fetch_array($query)){
			$members[]=$fetchRes[0];
		}
	
	}else{
	//$members[0]=0;
	}	
		
		
			

return $members;
}


function getTotalPaymentRecvBYLid($lid){
	$payment=array();
	$query = mysql_query("SELECT * FROM `creditpaid` where `lid`='$lid' and `status`='1' ");
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	while($fetchRes=mysql_fetch_array($query)){
		$payment[]=$fetchRes['netamount'];
		
		}
	
	}else{
	//$members[0]=0;
	}	
    $totalPayment=array_sum($payment);
	return 	$totalPayment;
	
	
	
	
}



function getTotalPaymentRecvBYSalesLid($lids){
	if(count($lids)>0){
		$impIds=implode(",",$lids);	
	}else{
		$impIds=0;	
	}
	
	$payment=array();
	$query = mysql_query("SELECT * FROM `creditpaid` where `lid` IN ($impIds) and `status`='1' ");
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	while($fetchRes=mysql_fetch_array($query)){
		$payment[]=$fetchRes['amount'];
		
		}
	
	}else{
	//$members[0]=0;
	}	
    $totalPayment=array_sum($payment);
	return 	$totalPayment;
	
}

function getTotalProposedAmtBYSalesLid($lids){
	if(count($lids)>0){
		$impIds=implode(",",$lids);	
	}else{
		$impIds=0;	
	}
	
	$payment=array();
	$query = mysql_query("SELECT * FROM `leads` where `id` IN ($impIds) and `status`='1' ");
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	while($fetchRes=mysql_fetch_array($query)){
		$payment[]=$fetchRes['ecost'];
		
		}
	
	}else{
	//$members[0]=0;
	}	
    $totalPayment=array_sum($payment);
	return 	$totalPayment;
	
}




function getPaymentMode($mode){
	if($mode==1){
		return "Cash";
	}
	
	if($mode==2){
		return "Cheque";
	}
	if($mode==3){
		return "Online";
	}
	
}

function getExecNameBYLid($lid){
	$query = mysql_query("SELECT * FROM `leads` where `id`='$lid' and `status`='1' ");
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	$fetchRes=mysql_fetch_row($query);
		$name=getEmployeeNameById($fetchRes[17]);
	}else{
		$name="- - - ";	
	}
return $name;	
}
function calculateServiceTax($amount,$tax,$val){
	
	if($val==1){
				$totalAmt=($amount*100)/($tax+100);
				
			}else if($val==2){
				$totalAmt=($amount+ ($amount*$tax)/100);
			}else{
				$totalAmt=$amount;
			}
	
	return ceil($totalAmt);
	
}

function getAmountReceivedByLid($leadId){
	
	$payment=array();
	$query = mysql_query("SELECT * FROM `creditpaid` where `lid` ='$leadId' and `status`='1' ");
	$numRows=mysql_num_rows($query);
	if($numRows>0){
	while($fetchRes=mysql_fetch_array($query)){
		$payment[]=$fetchRes['amount'];
		
		}
	
	}else{
	//$members[0]=0;
	}	
    $totalPayment=array_sum($payment);
	return 	$totalPayment;
	
}
	
	
function getLeadDateofSale($lid){
	$checkMeetings=checkleadhasMeetings($lid);
	if($checkMeetings){
	 $querys = mysql_fetch_row(mysql_query("SELECT `meetingdate` FROM `meetings` where `lid` = '$lid' and `status`='1' order by `id` desc limit 0,1 "));	
	 $meetingDate=$querys[0];
		
	}elseif(checkleadhasfollowups($lid)){
		 $fquery = mysql_fetch_row(mysql_query("SELECT `meetingdate` FROM `followups` where `lid` = '$lid' and `status`='1' order by `id` desc limit 0,1 "));
		 $meetingDate=$fquery[0];
		 
	}else{
		 $fquery = mysql_fetch_row(mysql_query("SELECT `meetingdate` FROM `leads` where `id` = '$lid' and `status`='1' "));
		 $meetingDate=$fquery[0];
	}
return $meetingDate;
}

function getModeofPayment($mode){
	if($mode==1){
		return "Cash";	
	}
	if($mode==2){
		return "By Cheque";	
	}
	if($mode==3){
		return "Online";	
	}
}

/**************** Haseen ends ***************/

function getServiceIdByName($service){
		$resultSet=mysql_fetch_row(mysql_query("select `id` from `services` where `title`='$service' "));
		return $resultSet[0];
}

function getServiceDetailsById($id){
		$resultSet=mysql_fetch_row(mysql_query("select * from `services` where `id`='$id' "));
		return $resultSet;
}

function getServiceProfileImageByid($sid){
	$sqlQry=mysql_query("select `imagepath` from `subservices` where `s_id`='$sid' and `status`='1' order by `position` Asc, `id` Desc limit 0,1");
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
		$fetchQry = mysql_fetch_row($sqlQry);
		$image = $fetchQry[0];
	}else{
		$image="noimage.jpg";
	}
return $image;	
}

?>