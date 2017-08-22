<?php
ob_start();
session_start();
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 include("../configuration/connect.php");
 include("../configuration/functions.php");
 include("../configuration/googleauth.php");

 $type=$_GET['type'];
 
 include_once("../src/fbaccess.php");

 ?>
 <script language="javascript" src="../javascript/javascript.js"></script>
<form name="registertype" id="registertype"  method="post"  >
<table width="100%"  cellspacing="0" cellpadding="0" >
  <tr>
    <tr><td ><table width="100%" border="1" cellspacing="0" cellpadding="8" >
  <tr>
    <td width="100%" colspan="1"><div  align="center" style="padding-top:8px;"><img src="images/logo.png" border="0"></div></td>
    <td  align="right" valign="top"><div style="margin-top:0px;margin-left:45px;"><img style="cursor:pointer;vertical-align:top" src="images/cancel.png" onclick="popup('popUpDiv')"></div></td>
  </tr>
</table>	</td></tr>
  
  
  <tr><td height='5px'></td></tr>

   <?php if($type=='1'){ ?>
 	 <tr><td align="left" ><div style="margin-left:10px"> 
     <table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td align="center" class="logintext" style="color:#000000">Sign In/Create an account using social log in - Fast, easy, quick, one click sign in</td>
  </tr>
    <tr><td height='10px'></td></tr>

  <tr>
    <td align="center"><a href="<?php echo $loginUrl; ?>"><img src="images/facebook.jpg"></a>&nbsp;&nbsp;&nbsp;<a class="login" href="<?php echo $authUrl; ?>"><img border="0" src="images/google.jpg"></a></td>
  </tr>
  <tr>
    <td align="left">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" style="border-right:solid 1px #CCCCCC;"><table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td colspan="2" align="left" class="reviewtext" style="color:#333333;font-weight:bold;font:calibri;font-size:14px;">Already Registered on TFL.com</td>
  </tr>
    <tr><td height='6px' colspan="2"></td></tr>

  <tr>
    <td colspan="2" align="left">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="logintext" style="font-size:11px;">Email</td>
  </tr>
  <tr>
    <td align="left"><input type="text" id="email" class="ac-textbox-small"></td>
  </tr>
  <tr>
    <td align="left" class="logintext" style="font-size:11px;">Password</td>
  </tr>
  <tr>
    <td align="left"><input type="text" id="password" class="ac-textbox-small"></td>
  </tr>
</table>    </td>
  </tr>
  <tr>
    <td  align="left"><img src="images/sign.jpg" onclick="loginUser(document.getElementById('email').value,document.getElementById('password').value)"></td>
    <td width="76%" align="left"><div id="loadingmsgs" style="display:none;vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="left" ><img src="images/progress_bar.gif"></td>
    <td align="left" class="logintext"><span style="color:#CCCCCC">Please Wait . Checking Credentials. . .</span></td>
  </tr>
</table></div></td>
  </tr>
</table>
</td>
    <td align="left" style="width:50%"><table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td align="left" class="reviewtext" style="color:#333333;font-weight:bold;font:calibri;font-size:14px;">Don't have an Account?</td>
  </tr>
  <tr><td height='10px'></td></tr>
  <tr>
    <td align="left" class="logintext" style="color:#000000"><p>If you are not currently a registered user of thefootballlink.com, you will need to create a free account.<p><br/>
You can subscribe to thefootballlink.com's newsletter, participate in contests, and enjoy other features and offers with your free account.Click on Link Me Now to Register</td>
  </tr>
  <tr><td  align="center" colspan="2" ><div id="loadingmsgs" style="display:none;margin-left:140px;"><table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="left" width="10%"><img src="images/progress_bar.gif"></td>
    <td align="left">&nbsp;&nbsp;<span style="color:#CCCCCC">Redirecting Please wait...</span></td>
  </tr>
</table></div>
  
  
  
</td></tr>
  <tr>
    <td align="left"><a href="javascript:void(0)" onclick="getRegisterWindow()"><img border="0" src="images/caccount.jpg" ></a></td>
  </tr>
</table></td>
  </tr>
</table>

    
    
    </td>
  </tr>
</table>

     
     
     
       </div> </td></tr>
  <?php } else if($type=='2'){?>
  
   <tr><td align="left" ><div style="margin-left:10px" > 
     <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" class="smallProddesc" style="font-size:14px;"><div style="margin-left:5px;">Enter your email address below to create a password and  account.All fields are mandatory.</div></td>
  </tr>
              
              <?php if($msg!=''){ ?>
              <tr>
                
                <td  align="left"><div id="result" class="<?php echo $class; ?>"><?php echo $msg; ?><span onclick="closeResultMsg()" style="float:right;cursor:pointer;"><img src="images/cross_grey_small.png"></span></div></td>
              </tr>
             <?php } else{?>
			 <tr>
                <td  height="15px">&nbsp;</td>
               
              </tr>
			 <?php }?>
   <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="29%" class="smallProddesc" style="font-size:13px;">Full Name </td>
    <td width="71%"><input type="text" class="ac-textbox-small" style="width:280px;" name="newusername" id="newusername"></td>
  </tr>
 
  <tr>
    <td class="smallProddesc" style="font-size:13px;">Email </td>
    <td><input type="text"  class="ac-textbox-small" style="width:280px;color:#000;" onclick="clearText('newuseremail')" title="This will be your username"  name="email" id="newuseremail" value="This will be your username"></td>
  </tr>
   <tr>
    <td class="smallProddesc" style="font-size:13px;">Password </td>
    <td><input  class="ac-textbox-small" style="width:280px;" name="pwd" id="newuserpwd" type="password"></td>
  </tr>
   <tr>
    <td class="smallProddesc" style="font-size:13px;">Confirm Password </td>
    <td><input  class="ac-textbox-small" style="width:280px;" name="cpwd" id="newusercpwd" type="password"></td>
  </tr>
   
    <tr>
    <td class="smallProddesc" style="font-size:13px;">Phone </td>
    <td><input  class="ac-textbox-small" style="width:280px;" name="phone" id="phone" type="text"></td>
  </tr>
  
  
  
    <tr>
    <td class="smallProddesc" style="font-size:13px;">Country </td>
    <td><input  class="ac-textbox-small" style="width:280px;" name="country" id="country" type="text"></td>
  </tr>
   
   <tr><td colspan="2" class="greenText">
   Link me to the Ecosystem for:
   
   </td></tr>
    <tr><td colspan="2" class="smallProddesc" style="font-size:13px;">
   <table width="100%" cellpadding="0" cellspacing="0"> <tr><td align="left" width="51">
   
   <input type="checkbox" name="check1" id="check1" value="Sponsor a child"></td><td width="1211" align="left"  class="smallProddesc">Sponsor a child</td>
   </tr>
   <tr><td align="left" width="51"><input type="checkbox" name="check2" id="check2"  value="Sponsor an event"></td><td align="left"  class="smallProddesc">Sponsor an event</td></tr>
   
   <tr><td align="left" width="51"><input type="checkbox" name="check3" id="check3"  value="Organize an initiative"></td><td align="left"  class="smallProddesc">Organize an initiative</td></tr>
   
   <tr><td align="left" width="51"><input type="checkbox" name="check4" id="check4"  value="Volunteer Work"></td><td align="left"  class="smallProddesc">Volunteer Work</td></tr>
   
   
   <tr><td align="left" width="51"><input type="checkbox" name="check5" id="check5"  value="TFL Coaching Acedemy"></td><td align="left"  class="smallProddesc">TFL Coaching Acedemy</td></tr>
    <tr><td align="left" width="51"><input type="checkbox" name="check6" id="check6"  value="TFL Jounior League"></td><td align="left"  class="smallProddesc">TFL Jounior League</td></tr>
    <tr><td align="left" width="51"><input type="checkbox" name="check7" id="check7"  value="College Tournaments"></td><td align="left"  class="smallProddesc">College Tournaments</td></tr>
     <tr><td align="left" width="51"><input type="checkbox" name="check8" id="check8"  value="School Tournaments"></td><td align="left"  class="smallProddesc">School Tournaments</td></tr>
      <tr><td align="left" width="51"><input type="checkbox" name="check9" id="check9"  value="Corporate Tournaments"></td><td align="left"  class="smallProddesc">Corporate Tournaments</td></tr>
       <tr><td align="left" width="51"><input type="checkbox" name="check10" id="check10"  value="International Festival"></td><td align="left"  class="smallProddesc">International Festival</td></tr>
        <tr><td align="left" width="51"><input type="checkbox" name="check11" id="check11"  value="Football Tournism"></td><td align="left"  class="smallProddesc">Football Tournism</td></tr>
    <tr><td align="left" width="51"><input type="checkbox" name="check12" id="check12"  value="Blog/Write For Football"></td><td align="left"  class="smallProddesc">Blog/Write For Football</td></tr>
    <tr><td align="left" width="51"><input type="checkbox" name="check13" id="check13"  value="Support The Football Link"></td><td align="left"  class="smallProddesc">Support The Football Link</td></tr>
   </table>
   </td></tr>
   
   
  
   
   
<tr><td colspan="2"><table width="100%" cellpadding="0" cellspacing="0"><tr>
    <td  align="left"><div style="margin-right:20px;"><img src="images/create-account.jpg" onclick="newUserAccount(document.getElementById('newuseremail'),document.getElementById('newuserpwd'),document.getElementById('newusercpwd'),document.getElementById('newusername'),document.getElementById('phone'),document.getElementById('country'))"></div></td>
	
	
    <td align="left" valign="top"><div id="loadingmsgs" style="display:none;vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td align="left" ><img src="images/progress_bar.gif"></td>
    <td align="left" class="logintext"><span style="color:#CCCCCC">Please Wait . Checking Availability. . .</span></td>
  </tr>
</table></div></td>
</tr></table></td></tr>
  
</table></td>
  </tr>
  
  
  

</table>

     
     
     
       </div> </td></tr>
  
  
<?php } ?>
</table>
 </form>