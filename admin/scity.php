<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google Like Auto Suggest Search Using PHP Ajax</title>
<meta content='Freeze coders is a programming blog and tutorials Jquery, Ajax, PHP, HTML, Web Design, Javascript, and MySQL.' name='description'/>

<meta content='java script, web development, web design, web programming, jquery ajax, ajax php, jquery ajax demos, jquery demos, regular expression, ajax demos, ajax programming, tutorials, php script, ajax tutorial, ajax examples, jquery tutorial, database, mysql, web database development, blogger, google ajax api, google visualization, google app, rss, technology, coding, code, examples, php programming, facebook scripts, twitter API, facebook like, twitter scripts, form validation, hosting, form submit, validation, application development, software, free scripts, free hosting, sql script, programming, jsp, tomcat, SMTP Mail' name='keywords'/>

<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
</script>



<script type="text/javascript">
function fill(Value) 
{		
$('#name').val(Value); 
$('#display').hide();
}

$(document).ready(function(){ 
$("#name").keyup(function() {
        var name = $('#name').val();
		if(name=="")
		{
			$("#display").html("");
		}
		else
		{
		$.ajax({  
                type: "POST",  
                url: "ajax.php",  
                data: "name="+ name ,  
                success: function(html){  
                    $("#display").html(html).show();
                }  
            });
		}
});
});
</script>



</head>


<body>
<div id="head2">
<div id="head1">
<a href="http://www.freezecoders.com">Freeze Coders</a>
</div>
</div>

<div id="wrapper">
<div id="leftbar"> 



</div><div id="content">

<h1 id="title">Google Like Auto Suggest Search Using PHP Ajax</h1>

<div id="tutorial"><a href="http://freezecoders.com/2013/03/google-like-auto-suggest-search-using-php-ajax.html">Back To Tutorial Page</a></div>


<div id="content">

<b>Search here with this keywords</b><br />
Nikon D5100<br />
Nikon D3100<br />
Canon SLR<br />
Sony Digital Camera<br /><br /><br />


<center><img src="freeze.PNG"></center>
<form method="post" action="index.php" style="margin: 0 0 -16px 0;">
Search : <input type="text" name="name" id="name" autocomplete="off" value="">
<input type="submit" name="submit" id="submit" value="Search">
</form>

<div id="display"></div>
</div>


</div>

<div id="rightbar"> 



</div></div>



</body>
</html>