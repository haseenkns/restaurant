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
  
  
</header>
<div class="container-fluid">
  
  <div class="dashboard-wrapper" style="margin-left:0px;">
    <div class="main-container">
      
   
     <div class="row-fluid">
     
        <div class="span6 offset3" style="margin-top:50px">
          <div class="widget">
          
            <div class="widget-body" style="padding: 0;">
             <div class="signup" style="margin: 0px auto;">
                        <form action="dashboard.php" class="signup-wrapper" method="post">
                          <div class="header">
                            <h2>Login</h2>
                            <p>Fill out the form below to login to your control panel.</p>
                          </div>
                          <div class="content">
                            <input class="input input-block-level" placeholder="Email"  type="email" value="">
                            <input class="input input-block-level" placeholder="Password" type="password">
                          </div>
                          <div class="actions">
                           <input class="btn btn-info btn-large pull-right" onClick="window.location(dashboard.html)" type="submit" value="Login">
                            <span class="checkbox-wrapper">
                              <a href="#" class="pull-left" data-original-title="">Forgot Password</a>
                            </span>
                            <div class="clearfix"></div>
                          </div>
                        </form>
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