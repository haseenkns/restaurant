<!DOCTYPE html>
<!--[if lt IE 7]>

<html class="lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]-->
<!--[if IE 7]>

<html class="lt-ie9 lt-ie8" lang="en">

<![endif]-->
<!--[if IE 8]>

<html class="lt-ie9" lang="en">

<![endif]-->
<!--[if gt IE 8]>
  <!-->

  <html lang="en">
  
  <!--
  <![endif]-->
<head>
<meta charset="utf-8">
<title>:: PPAC ::</title>
<meta name="author" content="">
<meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
<meta name="description" content="">
<meta name="author" content="">
<!-- bootstrap css -->
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
    </script>
<link href="css/style.css" rel="stylesheet">
<!--[if lte IE 7]>
    <script src="css/icomoon-font/lte-ie7.js">
    </script>
    <![endif]-->
       <link href="css/bootstrap-editable.css" rel="stylesheet">
    <link href="css/select2.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">

</head>
<body>
<header> <a href="dashboard.html" class="logo"> <img src="img/logo.png" style="height:40px" alt="Logo"/> </a>
  <div class="user-profile"> <a data-toggle="dropdown" class="dropdown-toggle"> <img src="img/avatar.jpg" alt="profile"> </a> <span class="caret"></span>
    <ul class="dropdown-menu pull-right">
      <li> <a href="#"> Logout </a> </li>
    </ul>
  </div>
</header>
<div class="container-fluid">
  <div id="mainnav" class="hidden-phone hidden-tablet">
    <ul style="display: block;">
      <li> <a href="dashboard.php">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></span> </div>
        Dashboard </a> </li>
          <li class="active"> <a href="profile.php">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe0d2;"></span> </div>
        Profile </a> </li>
      <li> <a href="setting.php">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span> </div>
        Setting </a> </li>
      <li> <a href="about_membership.php">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe096;"></span> </div>
        Membership </a> </li>
     
      <!--<li> <a href="#">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe0a9;"></span> </div>
        Menu Item </a> </li>
      <li> <a href="#">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe14a;"></span> </div>
        Menu Item </a> </li>-->
    
      <!--<li class="submenu"> <a href="#" class="selected">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe0aa;"></span> </div>
        Submenu </a>
        <ul>
          <li> <a href="#">Submenu Item</a> </li>
          <li> <a href="#">Submenu Item</a> </li>
          <li> <a href="#">Submenu Item</a> </li>
          <li> <a href="#">Submenu Item</a> </li>
          <li> <a href="#">Submenu Item</a> </li>
          <li> <a href="#">Submenu Item</a> </li>
        </ul>
      </li>-->
    </ul>
  </div>
  <div class="dashboard-wrapper">
    <div class="main-container">
      <div class="navbar hidden-desktop">
        <div class="navbar-inner">
          <div class="container"> <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> </a>
            <div class="nav-collapse collapse navbar-responsive-collapse">
              <ul class="nav">
                 <li> <a href="dashboard.php">Dashboard</a> </li>
                <li> <a href="profile.php">Profile</a> </li>
                <li> <a href="setting.php">Setting</a> </li>
                <li> <a href="about_membership.php">Membership</a> </li>
              </ul>
            </div>
            <!-- /.nav-collapse -->
          </div>
        </div>
        <!-- /navbar-inner -->
      </div>
   <!--<div class="alert alert-block alert-success fade in">
              <button data-dismiss="alert" class="close" type="button">
                ×
              </button>
              <h4 class="alert-heading">
               Success!
              </h4>
              <p>
                Profile Updated
              </p>
            </div>-->

     
          

           <div class="row-fluid">
              <div class="span12">
                <div class="widget no-margin">
                  <div class="widget-header">
                    <div class="title">
                      <span class="fs1" aria-hidden="true" data-icon="&#xe023;"></span> Profile
                    </div>
                  </div>
                  <div class="widget-body">
                    <div class="container-fluid">
                      
                      <div class="row-fluid">
                        <div class="span3">
                          <div class="thumbnail">
                            <img alt="300x200" src="img/profile.jpg">
                            <div class="caption" >
                              <p class="no-margin">
                                <a href="#" class="btn btn-info">
                                  Change Image
                                </a>
                                <a href="#" class="btn" style="margin-right:0px;float:right;">
                                  Cancel
                                </a>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="span9">
                          <div class="form-horizontal">
                            <h5>
                              Information
                            </h5>
                            <hr>
                            <div class="control-group">
                              <label class="control-label">
                                First Name
                              </label>
                              <div class="controls">
                                <input type="text" id="lastName" style="padding: 5px 10px;display: block;"  value="Srinu" class="span12"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">
                                Last Name
                              </label>
                              <div class="controls">
                                <input type="text" id="lastName" style="padding: 5px 10px;display: block;"  value="Baswa" class="span12"/>
                               
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">
                                Location
                              </label>
                              <div class="controls">
                                <input type="text" id="lastName" style="padding: 5px 10px;display: block;"  value=" Banglore, India." class="span12"/>
                                
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">
                                Date of Birth
                              </label>
                              <div class="controls">
                                <input type="text" id="lastName" style="padding: 5px 10px;display: block;"  value=" 01/07/1995" class="span12"/>
                               
                              </div>
                            </div>
                            <!--<div class="control-group">
                              <label class="control-label">
                                Tags
                              </label>
                              <div class="controls">
                                <a href="#" id="tags" data-type="select2" data-pk="1" data-original-title="Enter tags" class="editable editable-click">
                                  Html, CSS, Javascript
                                </a>
                              </div>
                            </div>-->
                            
                            <div class="control-group">
                              <label class="control-label">
                                About
                              </label>
                              <div class="controls">
                                <textarea type="text" id="lastName" style="padding: 5px 10px;display: block;" class="span12">   About me :)</textarea>
                               
                              </div>
                            </div>
                            <div class="form-actions no-margin">
                              <a href="profile_edit.php" type="submit" class="btn btn-info">
                                Update
                              </a>
                              <a href="profile.php" type="button" class="btn">
                                Cancel
                              </a>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
          </div>
    
     
      
    </div>
  </div>
  <!--/.fluid-container-->
</div>
<footer>
 <p> &copy; Copyright 2016 All Rights Reserved by PPAC | Designed by <a href="http://www.imission.com.hk/" target="_blank">iMission Group Limited</a> </p>
</footer>
  <script src="js/jquery.min.js">
    </script>
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.scrollUp.js">
    </script>
    <script src="js/bootstrap-editable.min.js">
    </script>
    <script src="js/select2.js">
    </script>
    
    
    <script type="text/javascript">
      //ScrollUp
      $(function () {
        $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          topDistance: '300', // Distance from top before showing element (px)
          topSpeed: 300, // Speed back to top (ms)
          animation: 'fade', // Fade, slide, none
          animationInSpeed: 400, // Animation in speed (ms)
          animationOutSpeed: 400, // Animation out speed (ms)
          scrollText: 'Scroll to top', // Text for element
          activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
      });

      //Tooltip
      $('a').tooltip('hide');

      //Xeditable form fields
      $(function () {


        //enable / disable
        $('#enable').click(function () {
          $('#user .editable').editable('toggleDisabled');
        });


        //editables 
        $('.inputText').editable({
          type: 'text',
          pk: 1,
          name: 'name',
          title: 'Enter Name'
        });


        $('.inputTextArea').editable({
          showbuttons: true
        });



        $('#tags').editable({
          inputclass: 'input-large',
          select2: {
            tags: ['html5', 'javascript', 'Jquery', 'css3', 'ajax', 'Sass', 'Haml', 'Photoshop'],
            tokenSeparators: [",", " "]
          }
        });

        $('#user .editable').on('hidden', function (e, reason) {
          if (reason === 'save' || reason === 'nochange') {
            var $next = $(this).closest('tr').next().find('.editable');
            if ($('#autoopen').is(':checked')) {
              setTimeout(function () {
                $next.editable('show');
              }, 300);

            } else {
              $next.focus();
            }

          }
        });

      });
      //Xeditable form fields end

      //Main menu navigation
  
      $('.submenu > a').click(function(e){
        e.preventDefault();
        var submenu = $(this).siblings('ul');
        var li = $(this).parents('li');
        var submenus = $('#mainnav li.submenu ul');
        var submenus_parents = $('#mainnav li.submenu');
        if(li.hasClass('open'))
        {
          if(($(window).width() > 768) || ($(window).width() < 479)) {
            submenu.slideUp();
          } else {
            submenu.fadeOut(250);
          }
          li.removeClass('open');
        } else 
        {
          if(($(window).width() > 768) || ($(window).width() < 479)) {
            submenus.slideUp();     
            submenu.slideDown();
          } else {
            submenus.fadeOut(250);      
            submenu.fadeIn(250);
          }
          submenus_parents.removeClass('open');   
          li.addClass('open');  
        }
      });
      
      var ul = $('#mainnav > ul');
      
      $('#mainnav > a').click(function(e)
      {
        e.preventDefault();
        var mainnav = $('#mainnav');
        if(mainnav.hasClass('open'))
        {
          mainnav.removeClass('open');
          ul.slideUp(250);
        } else 
        {
          mainnav.addClass('open');
          ul.slideDown(250);
        }
      });
    </script>
</body>
</html>