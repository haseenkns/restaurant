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
<link href="css/main.css" rel="stylesheet">
<link href="css/bootstrap-wysihtml5.css" rel="stylesheet">
<link href="css/wysiwyg-color.css" rel="stylesheet">
<link href="css/charts-graphs.css" rel="stylesheet">
</head>
<body>
<header> <a href="dashboard.html" class="logo"> <img src="img/logo.png" style="height:40px" alt="Logo"/> </a>
  <div class="user-profile"> <a data-toggle="dropdown" class="dropdown-toggle"> <img src="img/avatar.jpg" alt="profile"> </a> <span class="caret"></span>
    <ul class="dropdown-menu pull-right">
      <!--<li> <a href="#"> Edit Profile </a> </li>
      <li> <a href="#"> Account Settings </a> </li>-->
      <li> <a href="#"> Logout </a> </li>
    </ul>
  </div>
</header>
<div class="container-fluid">
  <div id="mainnav" class="hidden-phone hidden-tablet">
    <ul style="display: block;">
      <li class="active"> <a href="dashboard.php">
        <div class="icon"> <span class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></span> </div>
        Dashboard </a> </li>
          <li> <a href="profile.php">
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
      
    
     
      <div class="row-fluid">
        <div class="span8">
          <div class="widget no-margin">
            <div class="widget-header">
              <div class="title"> <span class="fs1" aria-hidden="true" data-icon="&#xe0be;"></span> Upload Photos </div>
            </div>
            <div class="widget-body">
              <div class="row-fluid">
                <div class="span12">
				
				  
				  <div class="img-module-btn">
					  <form method="post" action="#">
								<input type="file" name="categoryname" required="" id="category-feild" placeholder="Add Category Field" value="">
								<button class="btn btn-success input-top-margin" id="success" data-original-title="" type="submit">
								upload image
								</button>
						</form>
						
						<a data-original-title="" class="btn btn-info" href="competition_invoice.php" style="float:right;">Next</a>
				</div>
				  
				  
                </div>
              </div>
            </div>
          </div>
        </div>
		
		<div class="span4">
          <div class="widget no-margin">
            <div class="widget-header">
              <div class="title"> <span class="fs1" aria-hidden="true" data-icon="&#xe0ba;"></span>Message</div>
            </div>
            <div class="widget-body">
              <div class="row-fluid">
                <div class="span12">
				
				  <table style="width:100%">
					<tr>
						<td><h5><strong>Free upload</strong></h5></td>
						<td><b>:&nbsp;&nbsp;</b></td>
						<td>2</td>
					</tr>
					<tr>
						<td><h5><strong>Charge per image after exceeded free upload</strong></h5></td>
						<td><b>:</b></td>
						<td><b>$</b>&nbsp;5</td>
					</tr>
				  </table>
				  
				  
                </div>
              </div>
            </div>
          </div>
        </div>
		
      </div>
	  
	  
	  
      <div class="row-fluid" style="margin-top:20px;">
        <div class="span12">
          <div class="widget no-margin">
            <div class="widget-header">
              <div class="title"> <span class="fs1" aria-hidden="true" data-icon="&#xe00d;"></span> Photo gallery</div>
            </div>
            <div class="widget-body">
			 <div class="widget-body">
                  
                  <div id="accordion1" class="accordion no-margin">
                     <div class="accordion-group">
                      <div class="accordion-heading">
                      <table width="100%">
                      <tr>
                      <td width="15%"> 
                        <a href="#collapseTwo" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle" style="float:right">
                          <i class="icon-th icon-white">
                          </i>
                          view all
                        </a>
                        </td>
                        </tr>
                        <tr> <td colspan="2">
                         <div class="span3">
                         <a href="#myModal" class="thumbnail" data-toggle="modal"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div>
                        </td>
                        </tr>
                        </table>
                      </div>
                      <div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
                        <div class="accordion-inner" style="padding:0px;">
                           <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div>
                       
                         <div class="span3" style="margin-left:0px;">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div>
                           <div class="span3" style="margin-left:0px;">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div>
                           <div class="span3" style="margin-left:0px;">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
                        </div> <div class="span3">
                          <a href="#" class="thumbnail"><img src="img/2.jpg" alt=""></a>
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
  </div>
  <!--/.fluid-container-->
</div>
<footer>
 <p> &copy; Copyright 2016 All Rights Reserved by PPAC | Designed by <a href="#" target="_blank">iMission Group Limited</a> </p>
</footer>
<script src="js/wysihtml5-0.3.0.js">
    </script>
<script src="js/jquery.min.js">
    </script>
<script src="js/bootstrap.js">
    </script>
<script src="js/jquery.scrollUp.js">
    </script>
<script src="js/bootstrap-wysihtml5.js">
    </script>
<script type="text/javascript" src="js/date.js">
    </script>
<script type="text/javascript" src="js/daterangepicker.js">
    </script>
    <!-- Google Visualization JS -->
<script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
<!-- Sparkline JS -->
<script src="js/jquery.sparkline.js">
    </script>
<!-- Tiny Scrollbar JS -->
<script src="js/tiny-scrollbar.js">
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

      //wysihtml5
      $('#wysiwyg').wysihtml5();

      google.load("visualization", "1", {
        packages: ["corechart"]
      });

      $(document).ready(function () {
        drawChart1();
        drawChart2();
      })

      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Week', 'Judge-1 ', 'Judge-2', 'Judge-3', 'Judge-4'],
          ['Sun', 300, 1900, 900, 2900],
          ['Mon', 1170, 3860, 1220, 1564],
          ['Tue', 260, 1120, 2870, 2340],
          ['Wed', 1030, 540, 3830, 1200],
          ['Thu', 200, 700, 1700, 770],
          ['Fri', 700, 1200, 2200, 2870],
          ['Sat', 1170, 2160, 3920, 800], ]);

        var options = {
          width: 'auto',
          height: '200',
          backgroundColor: 'transparent',
          colors: ['#b5799e', '#579da9', '#e26666', '#1e825e', '#dba26b'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 60,
            top: 10,
            height: '80%'
          },
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));
        chart.draw(data, options);
      }


      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Google+', 'Facebook'],
          ['2005', 90, 30],
          ['2006', 400, 200],
          ['2007', 1050, 320],
          ['2008', 1940, 550],
          ['2009', 2910, 770],
          ['2010', 970, 1960],
          ['2011', 1660, 2520],
          ['2012', 1030, 3940]
          ]);

        var options = {
          width: 'auto',
          pointSize: 7,
          lineWidth: 1,
          height: '180',
          backgroundColor: 'transparent',
          colors: ['#b5799e', '#579da9', '#e26666', '#1e825e', '#dba26b'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 40,
            top: 10,
            height: "80%"
          }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('area_chart'));
        chart.draw(data, options);
      }

      //Tooltip
      $('a').tooltip('hide');
      $('i').tooltip('hide');


      //Tiny Scrollbar
      $('#scrollbar').tinyscrollbar();
      $('#scrollbar-one').tinyscrollbar();
      $('#scrollbar-two').tinyscrollbar();
      $('#scrollbar-three').tinyscrollbar();



      //Tabs
      $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
      })

      // SparkLine Graphs-Charts
      $(function () {
        try{
          $('#unique-visitors').sparkline('html', {
            type: 'bar',
            barColor: '#e26666',
            barWidth: 6,
            height: 30,
          });
          $('#monthly-sales').sparkline('html', {
            type: 'bar',
            barColor: '#b5799e',
            barWidth: 6,
            height: 30,
          });
          $('#current-balance').sparkline('html', {
            type: 'bar',
            barColor: '#579da9',
            barWidth: 6,
            height: 30,
          });
          $('#registrations').sparkline('html', {
            type: 'bar',
            barColor: '#dba26b',
            barWidth: 6,
            height: 30,
          });
        }catch(e){

        }
      });


      //Range Date Picker

      $('.report_range').daterangepicker({
        ranges: {
          'Today': ['today', 'today'],
          'Yesterday': ['yesterday', 'yesterday'],
          'Last 7 Days': [Date.today().add({
            days: -6
          }), 'today'],
          'Last 30 Days': [Date.today().add({
            days: -29
          }), 'today'],
          'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
          'Last Month': [Date.today().moveToFirstDayOfMonth().add({
            months: -1
          }), Date.today().moveToFirstDayOfMonth().add({
            days: -1
          })]
        },
        opens: 'left',
        format: 'MM/dd/yyyy',
        separator: ' to ',
        startDate: Date.today().add({
          days: -29
        }),
        endDate: Date.today(),
        minDate: '01/01/2012',
        maxDate: '12/31/2013',
        locale: {
          applyLabel: 'Submit',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom Range',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          firstDay: 1
        },
        showWeekNumbers: true,
        buttonClasses: ['btn-danger']
      },

      function (start, end) {
        $('.report_range span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
      });

      //Set the initial state of the picker label
      $('.report_range span').html(Date.today().add({
        days: -29
      }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));


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