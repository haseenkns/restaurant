<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
date_default_timezone_set('Asia/Kolkata');
	
if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Data has been added Successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Data not inserted Successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='Administrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='Administrator rights not added successfully !!!!';
		$class='danger';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
	
if(isset($_GET['did'])&&$_GET['did']!=''){
	$did=base64_decode($_GET['did']);
	$delQry=mysql_query("delete from `welcome` where `id`='$did'");
		if($delQry){
			header("location:welcome.php?msg=dls");
		}else{
			header("location:welcome.php?msg=dlf");
		}
}

if(isset($_POST['submit'])){
		extract($_POST);
		$flag=1;
		
		$from=mysql_real_escape_string($_POST['pemail']);
		$to=mysql_real_escape_string($_POST['cemail']);
		$subject=mysql_real_escape_string($_POST['subject']);
		$msg=mysql_real_escape_string($_POST['contents']);
		$fromname=$progname;
		
		$pdate=date("d/m/Y");
		$ptime=date("h:i a");
		mysql_query("BEGIN");
		
		//$mail=sendBasicMail($to,$from,$fromname,$subject,$msg);
		
		if(1){
		$excQry=mysql_query("INSERT INTO `welcomemail` (`id`, `mem_id`, `pdate`, `ptime`, `status`, `postedby`, `subject`, `content`,`pemail`,`cemail`) VALUES (NULL, '$memId', '$pdate', '$ptime', '1', '$adminId', '$subject', '$msg','$from','$to');");
	if($excQry){
		$flag=1;	 
	}else{
		$flag=0;	
	}
		}else{
		$flag=0;	
	}
	
	
	if($flag==1 ){
		mysql_query("COMMIT");
		header("location:thanksmail.php?msg=ins");					  
	}else{
		mysql_query("REVOKE");
		header("location:thanksmail.php?msg=inf");	
	}
	
	
}





if(isset($_GET['aid'])&&$_GET['aid']!=''){
	$aid=base64_decode($_GET['aid']);
	$edtQry=mysql_query("Select * from `members` where `id`='$aid'");
	$userData=mysql_fetch_row($edtQry);	
	$mem_name=getTabledataById("name","titles",$userData[2])." ".$userData[3]." ".$userData[4]." ".$userData[5];
	$prog_id=$userData[1];
	$date=$userData[26];
	$progArr=getProgramDescriptionById($prog_id);
	
	$progEmail=htmlentities(stripslashes($progArr[2]));
	$progName=htmlentities(stripslashes($progArr[1]));
	$progTemplatesArr=getProgramTemplatesById($prog_id);
	$subject=htmlentities(stripslashes($progTemplatesArr[4]));
	$progContent=htmlentities(stripslashes($progTemplatesArr[5]));
	$remark=htmlentities(stripslashes($progTemplatesArr[6]));
	$content=$date."<br/><br/>"."Dear ".$mem_name."<br/><br/>".$progContent;
	
	$mailsent=checkMailSent($aid);
	
	
	
}

	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
    <script>
    function setFocus(val){
		document.getElementById(val).focus();	
	}
    function errorMsg(msg,id){
		//alert(msg)
		swal({
		title: "Error!",
		text: msg,
		type: "error",
		confirmButtonText: "OK"
		},function(){
			//setFocus(id)
			//alert('dsa')
		});
			//return false;
		}
	
	
	function previewMsg(){
		var email=document.getElementById('cemail').value;
		var subject=document.getElementById('subject').value;
		var content=document.getElementById('contents').value;
		var remark=document.getElementById('remark').value;
		msg="<b>To : </b>"+email+" \n<b>Subject :</b> \n"+subject+'\n'+"<b>Content :</b> \n\n" +content+"\n"+remark;
		
		
		swal("Welcome Mail",unescape(msg))
	}
    </script>
    
    <script>
	function validateTemplate()
	{
	var eptrn=/^[a-z0-9]+[a-z0-9\._]*@[a-z0-9\.]+\.[a-z]{2,3}$/;    ///////////mail pattern///////
	var uptrn=/^[!@#&-_a-zA-Z0-9]{6,36}$/;
	var uname=/^[!@#&-_a-zA-Z0-9]+$/;
	var letters = /^[.A-Za-z ]+$/;  
	
	
	if(document.user.program.value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Please select a program','program')
		return false;
		}
		if(document.user.subject.value=="")
		{
		//alert('Enter valid Email-address');
		errorMsg('Enter a mail subject','subject')
		return false;
		}
		if(document.user.content.value=="0")
		{
		//alert('Enter valid Email-address');
		errorMsg('Entet mail content','contents')
		return false;
		}

		

	}
	</script>
	</head>

<body class="theme-dark">

	<!-- Header -->
	<?php include_once("header.php"); ?> <!-- /.header -->

	<div id="container">
		<?php include_once("leftmenu.php"); ?>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<?php include_once("crumb.php"); ?>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Welcome Email To - <?php echo $mem_name; ?> </h3>
						<!--<span>Good morning, John!</span>-->
					</div>

					<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Welcome Mail </h4>
							</div>
							<div class="widget-content">
								<p>
                                
                                <table width="100%" border="0" cellpadding="2" cellspacing="2">
              
              
              
              <?php if($msg!=''){ ?>
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td  align="left"><div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div></td>
              </tr>
             <?php } else{?>
			 <tr>
                <td class="rgt1" colspan="2">&nbsp;</td>
               
              </tr>
			 <?php }?>
             
              <tr>
                <td class="rgt1">&nbsp;</td>
                <td valign="top"><table width="100%" border="0" cellpadding="6" cellspacing="0" class="grayfour">
				<form action="" name="user" method="post"  class="form-horizontal row-border" id="validate-1"> 
				
				
            
                <tr >
				<td align="left"  colspan="3"><div style="width:100%;border-bottom:dashed 1px #C7C7C7;color:#06F;text-align:left;"><b><i class="icon-briefcase "></i>&nbsp;Info</b></div></td>
				
				</tr>
                <tr >
				<td align="left"  colspan="3" height="10px;"></td>
				
				</tr>
                <tr >
				<td align="left" class="blackbold">Programs Email *</td>
				<td><input type="text" class="form-control " placeholder="Add Email " name="pemail" id="pemail" value="<?php echo $progEmail; ?>"></td>
				<td></td>
				</tr>
                <tr >
				<td align="left" class="blackbold">Clients Email</td>
				<td><input type="text" class="form-control tags" placeholder="Add Email " name="cemail" id="cemail" value="<?php echo htmlentities(stripslashes($userData[7])) ?>"></td>
				<td></td>
				</tr>
                
                <tr >
				<td align="left" class="blackbold"> Subject</td>
				<td><input type="text" class="form-control " placeholder="Add Email Subject" name="subject" id="subject" value="<?php echo $subject ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
               
                  <tr >
				<td align="left" class="blackbold">  Content</td>
				<td><textarea rows="9"  name="contents" id="contents" class="form-control wysiwyg" placeholder="Add Email Content" style="width:100%" ><?php echo $content; ?></textarea></td>
				<td><div class="validateText"></div></td>
				</tr>
                
                
               <tr >
				<td align="left" class="blackbold"> Additional Remark (If any)</td>
				<td><input type="text" class="form-control " placeholder="Remarks" name="remark" id="remark" value="<?php echo $remark; ?>"></td>
				<td><div class="validateText"></div></td>
				</tr>
                
             
                
				<tr >
				<td>&nbsp;</td>
				<td colspan="2" align="left"><input type="hidden" value="<?php echo $aid; ?>" name="memId">
                <input type="hidden" value="<?php echo $adminId; ?>" name="adminId">
                <input type="hidden" value="<?php echo $progName; ?>" name="progname">
                <input type="submit" name="submit" class="btn" value="  Send Welcome Mail  ">&nbsp;&nbsp;&nbsp;
                <input type="button" name="preview" value=" Preview " onClick="previewMsg()" class="btn">&nbsp;&nbsp;&nbsp;
                <!--<input type="button" name="cancel" value=" Cancel " onClick="javascript:window.location.href='welcome.php'" class="btn">--></td>
				</tr>
				
			
  				</form>
</table></td>
              </tr>
			 
          </table>
                                
                                </p>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div>
                
                
                <!--<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Welcome mail</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
            <th >Sno</th>
             <th>Program</th>
            <th  data-hide="phone">Off. Email</th>
            <th data-hide="phone,tablet">Subject</th>
            <th  data-hide="phone,tablet">Preview</th>
            <th style="text-align:center"  data-hide="phone,tablet">Action</th>
  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
  	$sqlQry=mysql_query("select * from `welcome` order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
	$i++;
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center" class="smalltext"><?php echo $i; ?></td>
	<td align="left" class="smallfonttext"><?php echo getProgramNameById($fetch['prog_id']); ?></td>
    <td align="left" class="smallfonttext"><?php echo getProgramEmailById($fetch['prog_id']); ?></td>
	<td align="left" class="smallfonttext"><?php echo limitContent($fetch['subject'],50); ?></td>
	  <td align="center"  ><a href="viewwelcome.php?aid=<?php echo base64_encode( $fetch['id']); ?>" rel="facebox"> <button class="btn"><i class="icon-desktop"></i></button></span></td>
    
    <td align="center" bgcolor="#F9F9F9"><table    border="0" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr >
		<td align="right" ><a href="welcome.php?did=<?php echo base64_encode($fetch['id']) ?>"  class="confirm-dialog" onClick="return confirm(' Are you sure you want to delete !!')"><button class="btn"><i class="icon-trash"></i></button></a></td>
		<td align="center" ><a href="welcome.php?eid=<?php echo base64_encode($fetch['id']) ?>"><button class="btn"><i class="icon-edit"></i></button>	</a></td>
        
        
		<td align="left"  ><input class='uniform' type="checkbox" id="check<?php echo $fetch['id']  ?>" value="<?php echo $fetch['status']  ?>" onClick="updateStatus('<?php echo $fetch['id'];  ?>','welcome',5)" <?php if($fetch['status']==1){echo 'checked';} ?>></td>
        
        <td align="left"  class="smalltext" width="50px"><div  style="width:50px" id="status<?php echo $fetch['id']  ?>" ><?php echo getStatus($fetch['status']);  ?></div></td>
	</tr>
	</table></td>
  </tr>
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>-->
			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>