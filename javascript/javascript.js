//javascript updateTechproStatus//
function updateStatus(id,table,status){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/preloader.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatestatus.php?id='+id+'&table='+table+'&status='+status, true);
	 xmlHttpReq.send(null); 	
}


function updatePriceStatus(id,table,status){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('checkprice'+id).checked= true;	 
			 }
			 document.getElementById('statusprice'+id).innerHTML= msg;
			}else{
			 document.getElementById('statusprice'+id).innerHTML="<img src='images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/updatespricetatus.php?id='+id+'&table='+table+'&status='+status, true);
	 xmlHttpReq.send(null); 	
}

function updateStatusfront(id,table,status){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/updatestatus.php?id='+id+'&table='+table+'&status='+status, true);
	 xmlHttpReq.send(null); 	
}

function updateStudentStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatestudentstatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function closeResultMsg(){
	$('#result').fadeOut('1500');	
}

function updateNewsStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updateNewsStatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function updatefacultyGalleryStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatefacultystatustatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}


function updateSubCategoryStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatesubcategorytatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function updateEventsStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updateEventsStatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function updateCategoryStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatecategorystatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function updatetestimonialStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatetestimonialStatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}


function updateStudentGalleryStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatestudentstatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}

/*function getLoginScreen(val){
	
 var xmlHttpReq = false;
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   		{ 
	   		response=xmlHttpReq.responseText;
			
		    document.getElementById('popUpDiv').innerHTML=response;
			popup('popUpDiv')
				 
			}else{
				
					//document.getElementById('loadli'+val).style.display='block';	
				
		    }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/getloginscreen.php?type='+val, true);
	 xmlHttpReq.send(null); 	
}*/


function sendMail(name,mail,msg,phone,address){
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(name==''){
		alert('Name cannot be left blank!');
		return false;
	}
	if(mail==''){
		alert('Email cannot be left blank!');
		return false;
	}
	/*if(mail!=''){
		if(!mail.match(emailPattern)){
			alert('Email pattern not correct!');
			return false;
		}
	}*/
	if(phone==''){
		alert('Contact cannot be left blank!');
		return false;
	}
	if(msg==''){
		alert('Message cannot be left blank!');
		return false;
	}
document.getElementById('sendmailmsg').style.display="none"
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			document.getElementById('loadingSendmail').style.display="none"  
			 var msg=response;
			  document.getElementById('sendmailmsg').style.display="block" 
			 document.getElementById('sendmailmsg').innerHTML= msg;
			}else{
			 document.getElementById('loadingSendmail').style.display="block"  
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/sendMail.php?name='+name+'&mail='+mail+'&msg='+msg+'&phone='+phone+'&address='+address, true);
	 xmlHttpReq.send(null); 	
}


function updatePhotoStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatephotostatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}

function updateSubPhotoStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatesubphotostatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function updateEventStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updateeventstatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function updateYoutubeStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updateyoutubestatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}

function updateStoriesStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatestoriesstatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}

function updatePackageStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updatepackagestatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}

function changeopacity(id){
img=document.getElementById(id);	
img.style.filter       = "alpha(opacity=90);";
img.style.MozOpacity   = "0.9;";
img.style.opacity      = "0.9;";
img.style.KhtmlOpacity = "0.9;";
	
}

function updateTeamStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updateteamstatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function changeImageSrc(img,id){
document.getElementById(id).src="images/"+img;	
	
}

function updateWorkshopStatus(id){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='../images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','../ajaxCallToPhp/updateworkshopstatus.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}
function subscribeNewsletter(email){
if(email==''){
	alert('Please fill your email-id');
	//document.getElementById('newsletter').focus();
	return false;
}
addusertonewsletter(email);
}


function addusertonewsletter(id){
 var xmlHttpReq = false;
   document.getElementById('subscription').style.display="none" ; 	 
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			// document.getElementById('subscription').style.display="block" ; 	
			 document.getElementById('subscription').innerHTML= response;
			}else{
			 document.getElementById('subscription').style.display="block" ; 	
			 document.getElementById('subscription').innerHTML="<img src='images/loading.gif'>" ; 
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/addusertonewsletter.php?id='+id, true);
	 xmlHttpReq.send(null); 	
}

function checkAvailability(uname){
	if(uname==''){
	alert("Please enter the username");
	document.getElementById('username').focus();
	return false;
	}
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			 document.getElementById('userMsg').innerHTML="";
			// alert(response)
			 if(response==1){
			document.getElementById('userMsg').innerHTML="<span style='color:green'>Available !</span>" 
				document.getElementById('userStatus').value= 0;
			 }else{
						document.getElementById('userMsg').innerHTML=" <span style='color:red'>Not Available !</span>" 

				document.getElementById('userStatus').value= 1;
			 }
	}else{
			 document.getElementById('userMsg').innerHTML="<img src='images/loading.gif'>"  
	 }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/checkusername.php?uname='+uname, true);
	 xmlHttpReq.send(null); 	
}
function getAreaByLocationFront(val){
	 
	
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			document.getElementById('msgload').style.display="none"
			 document.getElementById('areadiv').innerHTML= response;
			

			}else{

			 document.getElementById('msgload').style.display="block"  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getareabylocationfront.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 


function getAddedCollege(val,id){
	//alert(val) 
	
  var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			document.getElementById('msgload').style.display="none"
			 document.getElementById('areadiv'+id).innerHTML= response;
			

			}else{

			 document.getElementById('msgload').style.display="block"  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getaddedcollege.php?val='+val+'&id='+id, true);

	 xmlHttpReq.send(null); 	

} 


function getAreaByLocationBack(val){
	 
	
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			document.getElementById('msgload').style.display="none"
			 document.getElementById('areadiv').innerHTML= response;
			

			}else{

			 document.getElementById('msgload').style.display="block"  

		   }

		}

	 xmlHttpReq.open('GET','../ajaxCallToPhp/getareabylocationback.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 
function setHidAreaValue(val){
 document.getElementById('hidcollege').value=val  

}


function setHidCourseValue(val,id){
 document.getElementById('hidcourse'+id).value=val  

}

function setHidAreaValueById(val,id){
 document.getElementById('hidcollege'+id).value=val  
//alert(val);
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			document.getElementById('msgload').style.display="none"
			 document.getElementById('coursediv'+id).innerHTML= response;
			

			}else{

			 document.getElementById('msgload').style.display="block"  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getcoursebycollege.php?val='+val+'&id='+id, true);

	 xmlHttpReq.send(null); 	



}


function gotoschool(university,college){
 if( (university.value=='') || (university.value=='0' )){

		alert('Please select a University')

		university.focus();

		return false;	

	}

	

	if( (college.value=='') || (college.value=='0' )){

		alert('Please select a college')

		document.getElementById('college').focus();

		return false;	

	}
	
	window.location.href='schools.php?uv='+university.value+'&cl='+college.value
	

}


function register(type,name,mail,password){
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(name==''){
		alert('Name cannot be left blank!');
		return false;
	}
	if(password==''){
		alert('Password cannot be left blank!');
		return false;
	}
	
	
	
//document.getElementById('sendmailmsg').style.display="none"
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			document.getElementById('loadingSendmail').style.display="none"  
			 var msg=response;
			  document.getElementById('sendmailmsg').style.display="block" 
			 document.getElementById('sendmailmsg').innerHTML= msg;
			}else{
			 document.getElementById('loadingSendmail').style.display="block"  
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/register.php?name='+name+'&mail='+mail+'&password='+password+'&type='+type, true);
	 xmlHttpReq.send(null); 	
}


function checklogin(type,mail,password){
	if(type==0){
		alert("Please select a type - Candidate,Corporate, Institute or faculty");	
		return false;
	}
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(mail==''){
		alert('Email cannot be left blank!');
		return false;
	}
	if(password==''){
		alert('Password cannot be left blank!');
		return false;
	}
	
	
	document.getElementById('sendlogin').style.display="none"
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			var splitres=response.split("##");
						document.getElementById('loadinglogin').style.display="none"  
			  document.getElementById('sendlogin').style.display="block" 

			if(splitres[0]==1){
				msg="login successfull.Redirecting..."	
				document.getElementById('sendlogin').innerHTML= msg;
				if(type=='2'){
					window.location.href='candidateinner.php'	
				}
				if(type=='3')
				{
					window.location.href='institute-'+splitres[1]+'.html'
				}
				if(type=='4')
				{
					window.location.href='facultyinner.html'
				}

			}
			
			if(response==0){
			msg="login Failed.Try again later..."	
			 document.getElementById('sendlogin').innerHTML= msg;
return false;
			}
			}else{
			 document.getElementById('loadinglogin').style.display="block"  
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/checklogin.php?mail='+mail+'&password='+password+'&type='+type, true);
	 xmlHttpReq.send(null); 	
}




function getAreaByLocation(val,id){
	// alert(val)
	// alert(id)
	
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			document.getElementById('msgload').style.display="none"
			 document.getElementById('areadiv'+id).innerHTML= response;
			

			}else{

			 document.getElementById('msgload').style.display="block"  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getareabylocationbyid.php?val='+val+'&id='+id, true);

	 xmlHttpReq.send(null); 	

} 

function formSubmit(id){
	
document.getElementById(id).submit();

}

function openDiv(showdiv,hidediv){
	//alert('asdsa')
$(document).ready(function() { 
     $("#"+hidediv).hide();
	$("#"+showdiv).show('slow');
});
	
	
}

function getCollegeByUniversity(val){
	 
	
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			document.getElementById('msgload').style.display="none"
			 document.getElementById('areadiv').innerHTML= response;
			

			}else{

			 document.getElementById('msgload').style.display="block"  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getcollegebyuniversity.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 


function checkEmail(email){
	
	if(email==''){
		alert("Please enter email id");
		return false;
	}
	 var xmlHttpReq = false;
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			// alert(response)
				if(response==0){
					msgs="Not Available"+'&nbsp;&nbsp;&nbsp;<span id="msgload" style="cursor:pointer;color:#000;" onclick="checkEmail(document.getElementById(\'email\').value)">Check Availability</span>'	
				}else if(response==1){
					msgs=" Available";
				}
			 document.getElementById('msgload').innerHTML=""
			 document.getElementById('msgload').innerHTML= msgs;
			}else{
			 document.getElementById('msgload').innerHTML="<img src='images/loading141.gif'>&nbsp;&nbsp;Checking..."  
		   }
		}
	 xmlHttpReq.open('GET','ajaxCallToPhp/checkemail.php?email='+email, true);
	 xmlHttpReq.send(null); 	
}


function getTextAndNumber(val,id){
	
	var clickValue=document.getElementById('hidfacultyclick'+id).value;
	if(clickValue==0){
	textArr=new Array("Avoid","Ordinary","Average","Just Ok","Satisfactory","Good","Very Good","Excellent","Outstanding");	
	
	foreColorArr=new Array("#cb202d","#de1d0f","#ff7800","#ffba00","#edd614","#9acd32","#5ba829","#3f7e00","#305d02");
	
	backColorsArr= new Array("#ededed","#eaeaea","#e8e8e8","#e5e5e5","#e2e2e2","#dedede","#dbdbdb","#d8d8d8","#cecece");

    for(i=1;i<=val;i++){
		document.getElementById(id+i).style.backgroundColor= foreColorArr[i-1]  
    }
 for(t=9;t>val;t--){
		document.getElementById(id+t).style.backgroundColor= backColorsArr[t-1]  
    }
	//alert(val)
var ind= parseInt(val)-1;
var value= parseFloat(val/2) +.5;
document.getElementById('faculty-text'+id).innerHTML=	textArr[ind];
document.getElementById('faculty-number'+id).innerHTML=	value
	
	
		//if(val)
		
	}
	
}
function resetBgColor(id){
		backColorsArr= new Array("#ededed","#eaeaea","#e8e8e8","#e5e5e5","#e2e2e2","#dedede","#dbdbdb","#d8d8d8","#cecece");
		var clickValue=document.getElementById('hidfacultyclick'+id).value;
		if(clickValue==0){
			for(i=1;i<=9;i++){
				document.getElementById(id+i).style.backgroundColor= backColorsArr[i-1]  
			}
		document.getElementById('faculty-text'+id).innerHTML=	'';
		document.getElementById('faculty-number'+id).innerHTML='';
		
		}
	
}
function defineRating(val,id){
	document.getElementById('hidfacultyclick'+id).value='1'
	foreColorArr=new Array("#cb202d","#de1d0f","#ff7800","#ffba00","#edd614","#9acd32","#5ba829","#3f7e00","#305d02");
	backColorsArr= new Array("#ededed","#eaeaea","#e8e8e8","#e5e5e5","#e2e2e2","#dedede","#dbdbdb","#d8d8d8","#cecece");
	for(i=1;i<=val;i++){
		document.getElementById(id+i).style.backgroundColor= foreColorArr[i-1]  
    }
 	document.getElementById('hidfacultyrating'+id).value=val;
	document.getElementById('removerating'+id).style.display='block';
	
	
}

function clearRating(id){
		backColorsArr= new Array("#ededed","#eaeaea","#e8e8e8","#e5e5e5","#e2e2e2","#dedede","#dbdbdb","#d8d8d8","#cecece");

		document.getElementById('hidfacultyclick'+id).value='0'
		 	document.getElementById('hidfacultyrating'+id).value=0;

		for(i=1;i<=9;i++){
				document.getElementById(id+i).style.backgroundColor= backColorsArr[i-1]  
			}
	document.getElementById('removerating'+id).style.display='none';

}


function getCourseByCollegeAndValue(val,id){
 document.getElementById('hidcollege'+id).value=val  
//alert(val);
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			document.getElementById('msgload').style.display="none"
			 document.getElementById('coursediv'+id).innerHTML= response;
			

			}else{

			 document.getElementById('msgload').style.display="block"  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getcoursebycollege.php?val='+val+'&id='+id, true);

	 xmlHttpReq.send(null); 	



}


function sendEnquiryMessage(name,mail,subject,message){
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(name.value==''){
		alert('Name cannot be left blank!');
		return false;
	}
	if(mail.value==''){
		alert('Email cannot be left blank!');
		return false;
	}
	if(mail.value!=''){
		if(!mail.value.match(emailPattern)){
			alert('Email pattern not correct!');
			return false;
		}
	}
	if(message.value==''){
		alert('Message cannot be left blank!');
		return false;
	}
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			alert(response)
			if(response==1){
				var mgs="Mail sent sucessfully,will revert back shortly."	
			 
			}else{
			var mgs="Some problem occoured.Try again later"	
			}
			 document.getElementById('submit').value="Submit Message"    
			 document.getElementById('sendenqlmsg').innerHTML= msg;
			}else{
			 document.getElementById('submit').value="Sending Message..."  
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/sendenquirymessage.php?name='+name.value+'&mail='+mail.value+'&msg='+message.value+'&subject='+subject.value, true);
	 xmlHttpReq.send(null); 	
}

function setEmployeeReportTo(val){
		document.getElementById('hidEmp').value=val;
}


function getEmployeeByDesignation(val){
	
		document.getElementById('hidEmp').value=0;
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			// document.getElementById('msgload').style.display="none"
			 document.getElementById('empDiv').innerHTML= response;
			

			}else{

			  document.getElementById('reportto').length=1
			  document.getElementById('reportto').options[0].text="Loading Employees..." 

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getemployeebydesignation.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 

    
		
 function getMembershipLevel(val){
	
		document.getElementById('hidMlevel').value=0;
		document.getElementById('amount').value="";
		document.getElementById('membershipno').value="";
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)
		   splitRes=response.split("####");

			// document.getElementById('msgload').style.display="none"
			 document.getElementById('mleveldiv').innerHTML= splitRes[0];
			 document.getElementById('membershipno').value= splitRes[1];

			}else{

			  document.getElementById('mlevel').length=1
			  document.getElementById('mlevel').options[0].text="Loading Levels..." 

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getmembershiplevel.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 
 
    function setMlevel(val){
		//alert(val)
		document.getElementById('hidMlevel').value=val;
		
		
		setAmountField(val)
		//document.getElementById('amount').value=val;
		
		//document.getElementById('amount').value=val;
		
		
}


function getEmployeeHead(val){
	
		document.getElementById('reportto').innerHTML="Select Employee";
	 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

	
			
			document.getElementById('reportto').innerHTML=response

			}else{

			 
			  document.getElementById('reportto').innerHTML="Fetching ...";

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getemployeehead.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 



function setAmountField(id){
	//alert(val)
	//alert(id)
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//alert(response)
			 document.getElementById('amount').value= response;

			}else{

			 document.getElementById('amount').value="Fetching Amount...";

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/setamountfield.php?id='+id, true);

	 xmlHttpReq.send(null); 	

} 

 function setSubAssignmentLevel(val){
	
		document.getElementById('hidAssignmentVal').value=val;
	
		
 }

 function updateMembershipLevel(val){
	
		document.getElementById('hidMlevel').value=0;
		document.getElementById('amount').value="";
	
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)
		   splitRes=response.split("####");

			// document.getElementById('msgload').style.display="none"
			 document.getElementById('mleveldiv').innerHTML= splitRes[0];
			

			}else{

			  document.getElementById('mlevel').length=1
			  document.getElementById('mlevel').options[0].text="Loading Levels..." 

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getmembershiplevel.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 

function clearPrevCity(){
	 document.getElementById('hidCity').value=0
	  document.getElementById('city').value=''
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function isNumberAndFillDays(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }else{
		showTotalDays();
	}
   
}

function showTotalDays(){
	
	var Fulldays=parseFloat(document.getElementById('fullabsent').value);
	var HalfDay=parseFloat(document.getElementById('halfabsent').value/2);
	totaldays=Fulldays+HalfDay;
	//alert(totaldays);
	document.getElementById('totalabs').innerHTML=totaldays
	
}



function updateCityStatus(id,table,status){
 var xmlHttpReq = false;
   
    // Mozilla/Safari
    if (window.XMLHttpRequest)
	 {
        xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject)
	 {
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	xmlHttpReq.onreadystatechange = function()
      {
		 if (xmlHttpReq.readyState == 4)
	   {    
		     response=xmlHttpReq.responseText;
			//alert(response)
			 var splitText=response.split("###");
			 var result=splitText[0];
			 var msg=splitText[1];
			 if(result=='1'){
			 document.getElementById('check'+id).checked= true;	 
			 }
			 document.getElementById('status'+id).innerHTML= msg;
			}else{
			 document.getElementById('status'+id).innerHTML="<img src='images/loading.gif'>"  
		   }
			}
	 xmlHttpReq.open('GET','ajaxCallToPhp/updatecitystatus.php?id='+id+'&table='+table+'&status='+status, true);
	 xmlHttpReq.send(null); 	
}

function setSalaryTypeText(val){
		document.getElementById('hidsalarytype').value=val;
	if(val==1){
		document.getElementById('selTypeText').innerHTML= "Month";	
	}
	if(val==2){
		document.getElementById('selTypeText').innerHTML= "Hour";	
	}
}

function setTaxableSalary(val){
		document.getElementById('hidtaxable').value=val;
}

function populateValuesByFilters(val){
		document.getElementById('hidDataVal').value=0
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			// document.getElementById('msgload').style.display="none"
			 document.getElementById('filters').innerHTML= response;
			

			}else{

			  document.getElementById('data').length=1
			  document.getElementById('data').options[0].text="Loading Data..." 

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/populatevaluesbyfilters.php?val='+val, true);

	 xmlHttpReq.send(null); 	
	
}

function setDataValues(val){
	document.getElementById('hidDataVal').value=val
}



function getSubAssignments(val){
	   if(val==0){
			alert('pleaser select a assignment');
			return false;   
	   }
		document.getElementById('otherhref').href="addsubassignment.php?id="+val
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			// document.getElementById('msgload').style.display="none"
			 document.getElementById('assignmentdiv').innerHTML= response;
			

			}else{

			  document.getElementById('subassignment').length=1
			  document.getElementById('subassignment').options[0].text="Loading Data..." 
			    document.getElementById('subsubassignment').length=1
			  document.getElementById('subsubassignment').options[0].text="Select Sub Sub Assignment" 
			  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getsubassignments.php?val='+val, true);

	 xmlHttpReq.send(null); 	
	
}

function setHidSubAssignmentValue(val){
	document.getElementById('hidSubAssignmentVal').value=val;
	
	
}



function setHidAssignmentValue(val){
	document.getElementById('hidAssignmentVal').value=val;
	
	
	  if(val==0){
			alert('pleaser select a subassignment');
			return false;   
	   }
		document.getElementById('subotherhref').href="addsubsubassignment.php?id="+val
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			// document.getElementById('msgload').style.display="none"
			 document.getElementById('subassignmentdiv').innerHTML= response;
			

			}else{
//alert('asda')
			  document.getElementById('subsubassignment').length=1
			  document.getElementById('subsubassignment').options[0].text="Loading Data..." 

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getsubsubassignments.php?val='+val, true);

	 xmlHttpReq.send(null); 	
	
	
	
	
	
	
}


function  populatesubassignment(aid,sval){
	   if(sval==''){
			alert('pleaser add some text');
			return false;   
	   }
		//document.getElementById('otherhref').href="addsubassignment.php?id="+val
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			// document.getElementById('msgload').style.display="none"
			if(response==1){
					 msgText= "Thanks ! Subassignment has been successfully added. Click Close and choose again ";
					
			}else{
					 msgText= "Problem ! Subassignment was not successfully added. Click Close and try again ";
				     
			}
					document.getElementById('assignments').selectedIndex = 0;
					document.getElementById('subassignment').selectedIndex = 0;
					document.getElementById('assignmentloader').innerHTML= msgText;

			}else{

				  document.getElementById('mainassignment').style.display='none'
				  document.getElementById('assignmentloader').style.display='block'

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/populatesubassignment.php?sval='+sval+'&aid='+aid, true);

	 xmlHttpReq.send(null); 	
}


function  populatesubsubassignment(aid,sval){
	   if(sval==''){
			alert('please add some text');
			return false;   
	   }
		//document.getElementById('otherhref').href="addsubassignment.php?id="+val
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			// document.getElementById('msgload').style.display="none"
			if(response==1){
					 msgText= "Thanks ! Subassignment has been successfully added. Click Close and choose again ";
					
			}else{
					 msgText= "Problem ! Subassignment was not successfully added. Click Close and try again ";
				     
			}
				
					document.getElementById('subassignment').selectedIndex = 0;
					document.getElementById('assignmentloader').innerHTML= msgText;

			}else{

				  document.getElementById('mainassignment').style.display='none'
				  document.getElementById('assignmentloader').style.display='block'

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/populatesubsubassignment.php?sval='+sval+'&aid='+aid, true);

	 xmlHttpReq.send(null); 	
}



function validateHref(val){
if( (val=='') || (val==0 )){
alert("Please select an assignment first !")

}
return false;	
}



function getCityByStateId(val){
	
//	alert('dsad')
					document.getElementById('area').length=1
					document.getElementById('area').options[0].text="Select Area"   
					if(document.getElementById('othercity')){
						document.getElementById('othercity').href="addothercity.php?id="+val
					}
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

		//	alert(response)

			 //document.getElementById('msgload').style.display="none"
			 document.getElementById('citydiv').innerHTML= response;
			

			}else{

			  document.getElementById('city').length=1
			  document.getElementById('city').options[0].text="Loading Data..."  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getcitybystateid.php?val='+val, true);

	 xmlHttpReq.send(null); 	

} 

function getAreaByCityId(val){
		 document.getElementById('hidCity').value=val;
	 if(document.getElementById('otherarea')){
		 document.getElementById('otherarea').href="addotherarea.php?id="+val
	 }
	
 var xmlHttpReq = false;

   

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			 //document.getElementById('msgload').style.display="none"
			 document.getElementById('areadiv').innerHTML= response;
			

			}else{

			  document.getElementById('area').length=1
			  document.getElementById('area').options[0].text="Loading Data..."  

		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/getareabycityid.php?val='+val, true);

	 xmlHttpReq.send(null); 	

}

function setHiddenArea(val){
	document.getElementById('hidArea').value=val
}

function  populatesubcity(aid,sval){
	   if(sval==''){
			alert('pleaser add some text');
			return false;   
	   }
		//document.getElementById('otherhref').href="addsubassignment.php?id="+val
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			// document.getElementById('msgload').style.display="none"
			if(response==1){
					 msgText= "Thanks ! City has been successfully added. Click Close and choose again ";
					
			}else{
					 msgText= "Problem ! City was not successfully added. Click Close and try again ";
				     
			}
					document.getElementById('state').selectedIndex = 0;
					document.getElementById('cityloader').innerHTML= msgText;

			}else{
				  document.getElementById('maincity').style.display='none'
				  document.getElementById('cityloader').style.display='block'
		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/populatesubcity.php?sval='+sval+'&aid='+aid, true);

	 xmlHttpReq.send(null); 	
}



function  populatesubarea(aid,sval){
	   if(sval==''){
			alert('pleaser add some text');
			return false;   
	   }
		//document.getElementById('otherhref').href="addsubassignment.php?id="+val
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			//alert(response)

			// document.getElementById('msgload').style.display="none"
			if(response==1){
					 msgText= "Thanks ! Area has been successfully added. Click Close and choose again ";
					
			}else{
					 msgText= "Problem ! Area was not successfully added. Click Close and try again ";
				     
			}
					document.getElementById('city').selectedIndex = 0;
					document.getElementById('cityloader').innerHTML= msgText;

			}else{
				  document.getElementById('mainarea').style.display='none'
				  document.getElementById('cityloader').style.display='block'
		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/populatesubarea.php?sval='+sval+'&aid='+aid, true);

	 xmlHttpReq.send(null); 	
}

function getTargetAmount(bank,amount,tax){
	//alert(lid);
	 if(amount==''){
			alert('pleaser add some amount');
			return false;   
	   }
	   
	   
	
	
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;
			//alert(response)
               
			
					  document.getElementById('netamount').value=response;
				 

			}else{
				  document.getElementById('netamount').value='Calculating ...';
				
		   }

		}

	 xmlHttpReq.open('GET','ajaxCallToPhp/gettargetamount.php?bank='+bank+'&amount='+amount+'&tax='+tax, true);

	 xmlHttpReq.send(null); 	
}


function  getSubServices(sval){
	   if(sval==''){
			alert('Please select a service');
			return false;   
	   }
		//document.getElementById('otherhref').href="addsubassignment.php?id="+val
		
		//alert('dasd')
 var xmlHttpReq = false;

    // Mozilla/Safari

    if (window.XMLHttpRequest)

	 {

        xmlHttpReq = new XMLHttpRequest();

    }

    // IE

    else if (window.ActiveXObject)

	 {

        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	xmlHttpReq.onreadystatechange = function()

      {

		 if (xmlHttpReq.readyState == 4)

	   {    

		     response=xmlHttpReq.responseText;

			
				
					document.getElementById('subservicediv').innerHTML= response;
					convert();

			}else{
				 document.getElementById('subservice').length=1
			     document.getElementById('subservice').options[0].text="Loading Sub Service..." 
		   }

		}

	 xmlHttpReq.open('GET','../ajaxCallToPhp/selectsubservice.php?sval='+sval, true);

	 xmlHttpReq.send(null); 	
}