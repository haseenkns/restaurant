<?php
session_start();
include_once("configuration/connect.php");
include_once("configuration/functions.php");
if(isset($_POST['submit'])){
    $_SESSION['itemIds'] = $_POST['item_ids'];
    header("location:order.php");
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <![endif]-->
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Restaurant - Multipurpose Html5 Template For Restaurant, Bar and Cafe" />
    <meta name="author" content="itgeeksin.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Restaurant - Multipurpose Html5 Template For Restaurant, Bar and Cafe</title>
    <!-- Bootstrap -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- Master Css -->
    <link href="main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!--//================preloader  start==============//-->
<div class="preloader">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="first_object"></div>
            <div class="object" id="second_object"></div>
            <div class="object" id="third_object"></div>
            <div class="object" id="forth_object"></div>
        </div>
    </div>
</div>
<!--//================preloader  end==============//-->
<!--//================Header start==============//-->
<header class="positionR">
    <div class="top-bar padTB30">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a class="navbar-brand" href="index.html">
                        <img class="site_logo" alt="Site Logo"  src="assets/img/logo.png" />
                    </a>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12 hidden-xs">
                    <!-- <div class="contact-info pull-right padTB5">
                         <a href="book-table.html" class="itg-button">Book table</a>
                     </div>-->
                    <div class="contact-info pull-right padTB5">
                        <div class="pull-left">
                            <a href="#" class="theme-circle marR10"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                        </div>
                        <div class="pull-left">
                            <h5>Email us :</h5>
                            <p> info@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-info pull-right padTB5">
                        <div class="pull-left">
                            <a href="#" class="theme-circle marR10"><i class="fa fa-phone" aria-hidden="true"></i></a>
                        </div>
                        <div class="pull-left">
                            <h5>Call us :</h5>
                            <p>+5584925214</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-menu" class="wa-main-menu">
        <!-- Menu -->
        <div class="wathemes-menu relative">
            <!-- navbar -->
            <div class="navbar navbar-default black-bg mar0" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="navigation-icon custom-drop">
                                    <ul class="social-icon top-bar-icon">
                                        <!-- <li><a href="#" class="theme-circle marL10"><i class="fa fa-facebook" aria-hidden="true"></i><span>facebook</span></a></li>
                                         <li><a href="#" class="theme-circle marL10"><i class="fa fa-twitter" aria-hidden="true"></i><span>twitter</span></a></li>
                                         <li><a href="#" class="theme-circle marL10"><i class="fa fa-google-plus" aria-hidden="true"></i><span>google</span></a></li>
                                         --><li><a href="#" class="theme-circle marL10"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Cart(3)</span></a></li>
                                        <!--<li>
                                            <a href="#" class="theme-circle marL10"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            <form class="search_bar custom-dropdown">
                                                <input type="text" name="search" placeholder="Search..">
                                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </form>
                                        </li>-->
                                    </ul>
                                </div>
                                <div class="navbar-header">
                                    <!-- Button For Responsive toggle -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <!-- Logo -->
                                </div>
                                <!-- Navbar Collapse -->
                                <div class="navbar-collapse collapse">
                                    <!-- nav -->
                                    <ul class="nav navbar-nav">
                                        <li><a href="index.php">home</a></li>
                                        <li><a href="menu.php">menu</a></li>
                                        <li>
                                            <a href="#">services</a>
                                            <!--<ul class="dropdown-menu">
                                                <li><a href="service.html">services</a></li>
                                                <li><a href="service-2.html">service 2</a></li>
                                                <li><a href="service-detail.html">service detail</a></li>
                                                <li><a href="filter.html">filter</a></li>
                                            </ul>-->
                                        </li>
                                        <!-- <li>
                                             <a href="#">pages<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                             <ul class="dropdown-menu">
                                                 <li><a href="book-table.html">book table</a></li>
                                                 <li>
                                                     <a href="#">about
                                                     <i class="fa fa-angle-right hidden-xs" aria-hidden="true"></i>
                                                     <i class="fa fa-angle-down hidden-md hidden-sm hidden-lg" aria-hidden="true"></i>
                                                     </a>
                                                     <ul class="dropdown-menu">
                                                         <li><a href="about-us.html">about us</a></li>
                                                         <li><a href="our-chef.html">our chef</a></li>
                                                         <li><a href="chef-detail.html">chef detail</a></li>
                                                     </ul>
                                                 </li>
                                                 <li class="left-side">
                                                     <a href="#">gallery
                                                     <i class="fa fa-angle-right hidden-xs" aria-hidden="true"></i>
                                                     <i class="fa fa-angle-down hidden-md hidden-sm hidden-lg" aria-hidden="true"></i></a>
                                                     <ul class="dropdown-menu">
                                                         <li><a href="gallery-style-1.html">style 1</a></li>
                                                         <li><a href="gallery-style-2.html">style 2</a></li>
                                                         <li><a href="gallery-style-3.html">style 3</a></li>
                                                     </ul>
                                                 </li>
                                                 <li>
                                                     <a href="#">dishes
                                                     <i class="fa fa-angle-right hidden-xs" aria-hidden="true"></i>
                                                     <i class="fa fa-angle-down hidden-md hidden-sm hidden-lg" aria-hidden="true"></i></a>
                                                     <ul class="dropdown-menu">
                                                         <li><a href="dishes.html">our dishes</a></li>
                                                         <li><a href="dish-detail.html">dishe detail</a></li>
                                                         <li><a href="dish-detail-left-sidebar.html">with left sidebar</a></li>
                                                         <li><a href="dish-detail-right-sidebar.html">with right Sidebar</a></li>
                                                     </ul>
                                                 </li>
                                                 <li class="left-side">
                                                     <a href="#">comming soon
                                                     <i class="fa fa-angle-right hidden-xs" aria-hidden="true"></i>
                                                     <i class="fa fa-angle-down hidden-md hidden-sm hidden-lg" aria-hidden="true"></i></a>
                                                     <ul class="dropdown-menu">
                                                         <li><a href="comming-soon-1.html">comming soon 1</a></li>
                                                         <li><a href="comming-soon-2.html">comming soon 2</a></li>
                                                     </ul>
                                                 </li>
                                                 <li><a href="faq.html">faq</a></li>
                                                 <li><a href="user-profile.html">user</a></li>
                                                 <li><a href="register.html">register</a></li>
                                                 <li><a href="404-error.html">404 error</a></li>
                                             </ul>
                                         </li>
                                         <li>
                                             <a href="#">blog<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                             <ul class="dropdown-menu">
                                                 <li><a href="blog-style-1.html">Blogs Style 1</a></li>
                                                 <li><a href="blog-style-2.html">Blogs Style 2</a></li>
                                                 <li><a href="blog-style-3.html">Blogs Style 3</a></li>
                                                 <li><a href="blog-style-4.html">Blogs Style 4</a></li>
                                                 <li><a href="blog-style-5.html">Blogs Style 5</a></li>
                                                 <li>
                                                     <a href="#">Single Blog
                                                     <i class="fa fa-angle-right hidden-xs" aria-hidden="true"></i>
                                                     <i class="fa fa-angle-down hidden-md hidden-sm hidden-lg" aria-hidden="true"></i></a>
                                                     <ul class="dropdown-menu">
                                                         <li><a href="blog-full-with-sidebar.html">With left Sidebar</a></li>
                                                         <li><a href="blog-full-with-right-sidebar.html">With right Sidebar</a></li>
                                                         <li><a href="blog-full.html">Without Sidebar</a></li>
                                                     </ul>
                                                 </li>
                                             </ul>
                                         </li>-->
                                        <li>
                                            <a href="#">contact us<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="contact-us.html">Style 1</a></li>
                                                <li><a href="contact-us-style-2.html">Style 2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- navbar-collapse -->
                            </div>
                        </div>
                        <!-- col-md-12 -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- navbar -->
        </div>
        <!--  Menu -->
    </div>
</header>
<!--//================Header end==============//-->
<div class="clear"></div>
<!--//================Slider start==============//-->
<section id="slider-section">
    <div id="main-slider" class="owl-carousel owl-theme slider positionR">
        <div class="item positionR">
            <figure class="slider-image positionR">
                <img src="assets/img/slider/main-1.jpg" alt="" class="hidden-xs"/>
                <img src="assets/img/slider/main-xs-1.jpg" alt="" class="hidden-sm hidden-lg hidden-md"/>
            </figure>
            <div class="slider-text positionA text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0 text-center">
                            <h2><i>The secret to making life better</i></h2>
                            <h1>Delicious <span class="theme-color">beverages and great-tasting</span> food</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum </p>
                            <a href="menu.php" class="itg-button light">Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item positionR">
            <figure class="slider-image positionR">
                <img src="assets/img/slider/main-2.jpg" alt="" class="hidden-xs"/>
                <img src="assets/img/slider/main-xs-2.jpg" alt="" class="hidden-sm hidden-lg hidden-md"/>
            </figure>
            <div class="slider-text positionA text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0 text-center">
                            <h2><i>The secret to making life better</i></h2>
                            <h1>Delicious <span class="theme-color">beverages and great-tasting</span> food</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum </p>
                            <a href="register.html" class="itg-button light">Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item positionR">
            <figure class="slider-image positionR">
                <img src="assets/img/slider/main-3.jpg" alt="" class="hidden-xs"/>
                <img src="assets/img/slider/main-xs-3.jpg" alt="" class="hidden-sm hidden-lg hidden-md"/>
            </figure>
            <div class="slider-text positionA text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0 text-center">
                            <h2><i>The secret to making life better</i></h2>
                            <h1>Delicious <span class="theme-color">beverages and great-tasting</span> food</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum </p>
                            <a href="register.html" class="itg-button light">Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//================Slider end==============//-->
<!--//================Services starts==============//-->
<section class="padT100 padB60 grey-bg">
    <!--- Theme heading start-->
    <div class="theme-heading marB50 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                    <h1>Welcome to our service</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                        quam, adipiscing condimentum
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--- Theme heading end-->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-box text-center">
                    <div class="service-circle">
                        <span class="big-circle"><a href="#"><i class="fa fa-cutlery" aria-hidden="true"></i></a></span>
                    </div>
                    <h3 class="marT20 marB10"><a href="#">Well served</a></h3>
                    <p>Lorem ipsum dolor sit amet co
                        nsectetur adipiscing Integer
                        lorem quam
                    </p>
                    <a href="#" class="itg-button marB40">Read More</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-box text-center">
                    <div class="service-circle">
                        <span class="big-circle"><a href="#"><i class="fa fa-calendar-o" aria-hidden="true"></i></a></span>
                    </div>
                    <h3 class="marT20 marB10"><a href="#">Various menu</a></h3>
                    <p>Lorem ipsum dolor sit amet co
                        nsectetur adipiscing Integer
                        lorem quam
                    </p>
                    <a href="#" class="itg-button marB40">Read More</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-box text-center">
                    <div class="service-circle">
                        <span class="big-circle"><a href="#"><i class="fa fa-futbol-o" aria-hidden="true"></i></a></span>
                    </div>
                    <h3 class="marT20 marB10"><a href="#">Fresh dishes</a></h3>
                    <p>Lorem ipsum dolor sit amet co
                        nsectetur adipiscing Integer
                        lorem quam
                    </p>
                    <a href="#" class="itg-button marB40">Read More</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-box text-center">
                    <div class="service-circle">
                        <span class="big-circle"><a href="#"><i class="fa fa-motorcycle" aria-hidden="true"></i></a></span>
                    </div>
                    <h3 class="marT20 marB10"><a href="#">Fast delivery</a></h3>
                    <p>Lorem ipsum dolor sit amet co
                        nsectetur adipiscing Integer
                        lorem quam
                    </p>
                    <a href="#" class="itg-button marB40">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//================Services end==============//-->
<div class="clear"></div>
<!--//================Featured Dishes start==============//-->
<!-- <section class="padT100 padB100">

     <div class="theme-heading marB50 positionR">
         <div class="container">
             <div class="row">
                 <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                     <h1>Our Featured Dishes</h1>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                         quam, adipiscing condimentum
                     </p>
                 </div>
             </div>
         </div>
     </div>

     <div class="container">
         <div class="row">
             <div id="collection-slider" class="owl-carousel owl-theme">
                 <div class="item">
                     <div class="col-md-12">
                         <div class="collection-box theme-hover sticker">
                             <figure class="marB20">
                                 <img src="assets/img/dishes/1.jpg" alt=""/>
                             </figure>
                             <h3 class="marB10"><a href="#">Muffins</a></h3>
                             <p>Integr lorem quam adipiscing the
                                 tristique , eleifend turpis Pelle
                                 tesque cursus arcu
                             </p>
                             <a href="#" class="colorB">Order Now</a>
                             <div class="sticker-box">
                                 <span class="sticker-tag">Only 12.99 $</span>
                                 <br>
                                 <span class="sticker-tag">10% OFF</span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="item">
                     <div class="col-md-12">
                         <div class="collection-box theme-hover sticker">
                             <figure class="marB20">
                                 <img src="assets/img/dishes/2.jpg" alt=""/>
                             </figure>
                             <h3 class="marB10"><a href="#">Juice</a></h3>
                             <p>Integr lorem quam adipiscing the
                                 tristique , eleifend turpis Pelle
                                 tesque cursus arcu
                             </p>
                             <a href="#" class="colorB">Order Now</a>
                             <div class="sticker-box">
                                 <span class="sticker-tag">Only 12.99 $</span>
                                 <br>
                                 <span class="sticker-tag">10% OFF</span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="item">
                     <div class="col-md-12">
                         <div class="collection-box theme-hover sticker">
                             <figure class="marB20">
                                 <img src="assets/img/dishes/3.jpg" alt=""/>
                             </figure>
                             <h3 class="marB10"><a href="#">BBQ chicken</a></h3>
                             <p>Integr lorem quam adipiscing the
                                 tristique , eleifend turpis Pelle
                                 tesque cursus arcu
                             </p>
                             <a href="#" class="colorB">Order Now</a>
                             <div class="sticker-box">
                                 <span class="sticker-tag">Only 12.99 $</span>
                                 <br>
                                 <span class="sticker-tag">10% OFF</span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="item">
                     <div class="col-md-12">
                         <div class="collection-box theme-hover sticker">
                             <figure class="marB20">
                                 <img src="assets/img/dishes/4.jpg" alt=""/>
                             </figure>
                             <h3 class="marB10"><a href="#">Salade</a></h3>
                             <p>Integr lorem quam adipiscing the
                                 tristique , eleifend turpis Pelle
                                 tesque cursus arcu
                             </p>
                             <a href="#" class="colorB">Order Now</a>
                             <div class="sticker-box">
                                 <span class="sticker-tag">Only 12.99 $</span>
                                 <br>
                                 <span class="sticker-tag">10% OFF</span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="item">
                     <div class="col-md-12">
                         <div class="collection-box theme-hover sticker">
                             <figure class="marB20">
                                 <img src="assets/img/dishes/5.jpg" alt=""/>
                             </figure>
                             <h3 class="marB10"><a href="#">BBQ chicken</a></h3>
                             <p>Integr lorem quam adipiscing the
                                 tristique , eleifend turpis Pelle
                                 tesque cursus arcu
                             </p>
                             <a href="#" class="colorB">Order Now</a>
                             <div class="sticker-box">
                                 <span class="sticker-tag">Only 12.99 $</span>
                                 <br>
                                 <span class="sticker-tag">10% OFF</span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>-->
<!--//================Featured Dishes end==============//-->
<div class="clear"></div>
<!--//================Banner starts==============//-->
<section>
    <div class="special-style overlay">
        <div class="special-banner-image parallax-style"></div>
    </div>
    <div class="padT100 padB70">
        <!--- Theme heading start-->
        <div class="theme-heading background marB50 positionR">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                        <h1>We are bourn to make you foodie</h1>
                        <p class="hidden">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                            quam, adipiscing condimentum
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--- Theme heading end-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="facts text-center marB30">
                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                        <h3>Amazing dishes</h3>
                        <div class="count-number" data-count="2500">
                            <h1><span class="counter">2500</span> +</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="facts text-center marB30">
                        <i class="fa fa-coffee" aria-hidden="true"></i>
                        <h3>Satisfied staff</h3>
                        <div class="count-number" data-count="1200">
                            <h1><span class="counter">1200</span> +</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="facts text-center marB30">
                        <i class="fa fa-smile-o" aria-hidden="true"></i>
                        <h3>Happy customers</h3>
                        <div class="count-number" data-count="2200">
                            <h1><span class="counter">2200</span> +</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//================Banner end==============//-->
<div class="clear"></div>
<!--//================Menu start==============//-->
<!--<section class="padT100 padB70">
    <div class="theme-heading marB50 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                    <h1>Menu of the day</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                        quam, adipiscing condimentum
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/6.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Chinese food</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/7.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Italian pizza</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/8.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Icecreams</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/9.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Kids meals</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/10.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Drinks</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/11.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Cakes</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/12.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Treditionals</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="collection-box theme-hover sticker marB50">
                    <figure class="marB20">
                        <img src="assets/img/dishes/13.jpg" alt=""/>
                    </figure>
                    <h3 class="marB10"><a href="#">Chicken & meat</a></h3>
                    <p>Integr lorem quam adipiscing the
                        tristique , eleifend turpis Pelle
                        tesque cursus arcu
                    </p>
                    <a href="#" class="colorB">Order Now</a>
                    <div class="sticker-box">
                        <span class="sticker-tag">Only 12.99 $</span>
                        <br>
                        <span class="sticker-tag">10% OFF</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-background">
        <figure>
            <img src="assets/img/background/menu-back.png" alt=""/>
        </figure>
    </div>
</section>-->
<!--//================Menu end==============//-->
<div class="clear"></div>
<!--//================Video start==============//-->
<section>
    <div class="special-style overlay">
        <div class="special-video-image parallax-style"></div>
    </div>
    <div class="padT100 padB70">
        <!--- Theme heading start-->
        <div class="theme-heading background marB50 positionR">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                        <h1>Opening hours</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                            quam, adipiscing condimentum
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--- Theme heading end-->
        <div class="container">
            <div class="opening-box text-center">
                <div class="opening-hours pad40">
                    <h2>Monday to friday </h2>
                    <h1>09:00 to 12:00</h1>
                </div>
                <div class="opening-hours marB30 pad40">
                    <h2>Saturday & sunday</h2>
                    <h1>08:00 to 03:00</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//================Video end==============//-->
<div class="clear"></div>
<!--//================Special Menu start==============//-->
<section class="padT100 padB70">
    <!--- Theme heading start-->
    <div class="theme-heading marB50 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                    <h1>Some special menu</h1>
                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                        quam, adipiscing condimentum
                    </p>-->
                </div>
            </div>
        </div>
    </div>
    <!--- Theme heading end-->
    <div class="container">
        <!--<div class="row">
            <div class="col-xs-12">
                <div class="tab text-center marB50">
                    <a class="tablinks active" data-id="lunch">Lunch</a>
                    <a class="tablinks" data-id="breakfast">Breakfast</a>
                    <a class="tablinks " data-id="desert">Desert</a>
                    <a class="tablinks " data-id="pizza">Fresh pizza</a>
                    <a class="tablinks " data-id="dinner">Dinner</a>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div id="lunch" class="tabcontent" style="display:block;" >


                    <?php
                    $sqlQry=mysql_query("select * from `ppac_category` order by `id` desc");
                    $i=0;
                    $numrows=mysql_num_rows($sqlQry);
                    if($numrows>0){
                    while($row=mysql_fetch_array($sqlQry)){
                        $cat_id = $row['id'];
                    ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-xs-4 col-sm-4 col-md-1">

                    </div>
                    <div class="col-sm-8 col-md-8">
                    <h3 class="marT20 marB10">Various <?php echo $row['titles'] ?></h3>
                    </div>

                    <?php
                    $sqQry=mysql_query("select * from `food_menu` where cid=$cat_id order by `id` desc ");
                    $i=0;
                    $numrow=mysql_num_rows($sqQry);
                    if($numrow>0){
                    while($fetch=mysql_fetch_array($sqQry)){
                    $i++;
                    $item_id = $fetch['id'];
                    ?>
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-2">

                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h4><a href="#"><?php echo $fetch['name']; ?></a><span class="theme-color" style="float:right;">$15.00</span></h4>
                                <p><?php echo $fetch['description']; ?> </p>
                                <a href="javascript:void(0)" onclick="addToCart(<?php echo $item_id ?>)" data-toggle="modal" data-target="#myModal" class="itg-button dark">Add to order</a>
                            </div>
                        </div>
                    </div>
                    <?php }}?>
                </div>
                    <?php }}?>
                <!--<div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/15.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Drinks</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>




            <div id="breakfast" class="tabcontent">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/19.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Noodels</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/18.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Cakes</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/17.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Pasta</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/16.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Icecreams</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/14.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Chees pizza </a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/15.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Drinks</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="desert" class="tabcontent">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/14.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Chees pizza </a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/15.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Drinks</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/17.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Pasta</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/16.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Icecreams</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/19.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Noodels</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/18.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Cakes</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pizza" class="tabcontent">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/15.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Drinks</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/18.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Cakes</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/19.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Noodels</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/17.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Pasta</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/16.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Icecreams</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/14.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Chees pizza </a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="dinner" class="tabcontent">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/17.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Pasta</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/19.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Noodels</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/18.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Cakes</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/14.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Chees pizza </a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/16.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Icecreams</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="menu-list-box marB30">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <figure>
                                    <img src="assets/img/dishes/15.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <h3><a href="#">Drinks</a><span class="theme-color">$15.00</span></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adip
                                    elit. Integer lorem quam, adipiscing condi
                                    lorem quam, adipiscing
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//================Special Menu end==============//-->
<div class="clear"></div>
<!--//================ Our Team start ==============//-->
<section class="padT100  grey-bg team">
    <!--- Theme heading start-->
    <div class="theme-heading marB50 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                    <h1>Meet our chefs</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                        quam, adipiscing condimentum
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--- Theme heading end-->
    <div class="container">
        <div class="row">
            <div class="our-team">
                <div id="team-slider" class="owl-carousel owl-theme slider positionR">
                    <div class="item">
                        <div class="col-xs-12">
                            <div class="team-member grey-bg text-center marB30">
                                <figure class="marB30">
                                    <img src="assets/img/team/1.jpg" alt=""/>
                                </figure>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                </ul>
                                <hr>
                                <h4><a href="#">Lorem ipsum</a></h4>
                                <p>(Head Chef)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-xs-12">
                            <div class="team-member grey-bg text-center marB30">
                                <figure class="marB30">
                                    <img src="assets/img/team/2.jpg" alt=""/>
                                </figure>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                </ul>
                                <hr>
                                <h4><a href="#">Lorem ipsum</a></h4>
                                <p>(Chinese Chef)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-xs-12">
                            <div class="team-member grey-bg text-center marB30">
                                <figure class="marB30">
                                    <img src="assets/img/team/3.jpg" alt=""/>
                                </figure>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                </ul>
                                <hr>
                                <h4><a href="#">Lorem ipsum</a></h4>
                                <p>(Non-veg Chef)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-xs-12">
                            <div class="team-member grey-bg text-center marB30">
                                <figure class="marB30">
                                    <img src="assets/img/team/4.jpg" alt=""/>
                                </figure>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                </ul>
                                <hr>
                                <h4><a href="#">Lorem ipsum</a></h4>
                                <p>(Veg Chef)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-xs-12">
                            <div class="team-member grey-bg text-center marB30">
                                <figure class="marB30">
                                    <img src="assets/img/team/1.jpg" alt=""/>
                                </figure>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                </ul>
                                <hr>
                                <h4><a href="#">Lorem ipsum</a></h4>
                                <p>(Head Chef)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//================ Our Team end ==============//-->
<div class="clear"></div>
<!--//================ Our Customer start ==============//-->
<!--<section class="padTB100 customer-section" >
    &lt;!&ndash;- Theme heading start&ndash;&gt;
    <div class="theme-heading background marB100 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                    <h1>Our happy customer</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                        quam, adipiscing condimentum
                    </p>
                </div>
            </div>
        </div>
    </div>
    &lt;!&ndash;- Theme heading end&ndash;&gt;
    <div class="container">
        <div class="row">
            <div id="customer-slider" class="owl-carousel owl-theme slider positionR">
                <div class="item">
                    <div class="col-md-12">
                        <div class="customer-box">
                            <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit
                                eiusmod tempor incididuntdolor sit amet, consectetur
                                adipisicing incididuntdolor sit amet
                            </blockquote>
                            <div class="customer-detail">
                                <div class="customer-img">
                                    <figure>
                                        <img src="assets/img/all/5.jpg" alt=""/>
                                    </figure>
                                </div>
                                <div class="caption">
                                    <h3>Pellentesque cursus</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="customer-box">
                            <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit
                                eiusmod tempor incididuntdolor sit amet, consectetur
                                adipisicing incididuntdolor sit amet
                            </blockquote>
                            <div class="customer-detail">
                                <div class="customer-img">
                                    <figure>
                                        <img src="assets/img/all/6.jpg" alt=""/>
                                    </figure>
                                </div>
                                <div class="caption">
                                    <h3>Pellentesque cursus</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="customer-box">
                            <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit
                                eiusmod tempor incididuntdolor sit amet, consectetur
                                adipisicing incididuntdolor sit amet
                            </blockquote>
                            <div class="customer-detail">
                                <div class="customer-img">
                                    <figure>
                                        <img src="assets/img/all/5.jpg" alt=""/>
                                    </figure>
                                </div>
                                <div class="caption">
                                    <h3>Pellentesque cursus</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="customer-box">
                            <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit
                                eiusmod tempor incididuntdolor sit amet, consectetur
                                adipisicing incididuntdolor sit amet
                            </blockquote>
                            <div class="customer-detail">
                                <div class="customer-img">
                                    <figure>
                                        <img src="assets/img/all/6.jpg" alt=""/>
                                    </figure>
                                </div>
                                <div class="caption">
                                    <h3>Pellentesque cursus</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="customer-background">
        <figure>
            <img src="assets/img/background/customer.png" alt=""/>
        </figure>
    </div>
</section>-->
<!--//================ Our Customer end ==============//-->
<div class="clear"></div>
<!--//================ Blog start ==============//-->
<!--<section class="padTB100">
    &lt;!&ndash;- Theme heading start&ndash;&gt;
    <div class="theme-heading marB50 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                    <h1>Blog post</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem
                        quam, adipiscing condimentum
                    </p>
                </div>
            </div>
        </div>
    </div>
    &lt;!&ndash;- Theme heading end&ndash;&gt;
    <div class="container">
        <div class="row">
            <div id="blog-slider" class="owl-carousel owl-theme slider positionR">
                <div class="item">
                    <div class="col-xs-12">
                        <div class="blog theme-hover sticker">
                            <figure class="marB20">
                                <img src="assets/img/blog/1.jpg" alt="">
                            </figure>
                            <h3 class="marB10"><a href="#">Mauris lacinia lactus</a></h3>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing lorem ipsum dolor sit amet
                                adipisicing sed do eiusmod tempor . sed do eiusmod tempor
                            </p>
                            <a href="#" class="itg-button">Read More</a>
                            <div class="sticker-box">
                                <span class="sticker-tag"><i class="fa fa-calendar marR5" aria-hidden="true"></i> September 5 2017</span>
                                <br>
                                <span class="sticker-tag"><i class="fa fa-comment marR5" aria-hidden="true"></i>10 Comment</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-12">
                        <div class="blog theme-hover sticker">
                            <figure class="marB20">
                                <img src="assets/img/blog/2.jpg" alt="">
                            </figure>
                            <h3 class="marB10"><a href="#">Mauris lacinia lactus</a></h3>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing lorem ipsum dolor sit amet
                                adipisicing sed do eiusmod tempor . sed do eiusmod tempor
                            </p>
                            <a href="#" class="itg-button">Read More</a>
                            <div class="sticker-box">
                                <span class="sticker-tag"><i class="fa fa-calendar marR5" aria-hidden="true"></i> September 5 2017</span>
                                <br>
                                <span class="sticker-tag"><i class="fa fa-comment marR5" aria-hidden="true"></i>10 Comment</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-12">
                        <div class="blog theme-hover sticker">
                            <figure class="marB20">
                                <img src="assets/img/blog/1.jpg" alt="">
                            </figure>
                            <h3 class="marB10"><a href="#">Mauris lacinia lactus</a></h3>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing lorem ipsum dolor sit amet
                                adipisicing sed do eiusmod tempor . sed do eiusmod tempor
                            </p>
                            <a href="#" class="itg-button">Read More</a>
                            <div class="sticker-box">
                                <span class="sticker-tag"><i class="fa fa-calendar marR5" aria-hidden="true"></i> September 5 2017</span>
                                <br>
                                <span class="sticker-tag"><i class="fa fa-comment marR5" aria-hidden="true"></i>10 Comment</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-12">
                        <div class="blog theme-hover sticker">
                            <figure class="marB20">
                                <img src="assets/img/blog/2.jpg" alt="">
                            </figure>
                            <h3 class="marB10"><a href="#">Mauris lacinia lactus</a></h3>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing lorem ipsum dolor sit amet
                                adipisicing sed do eiusmod tempor . sed do eiusmod tempor
                            </p>
                            <a href="#" class="itg-button">Read More</a>
                            <div class="sticker-box">
                                <span class="sticker-tag"><i class="fa fa-calendar marR5" aria-hidden="true"></i> September 5 2017</span>
                                <br>
                                <span class="sticker-tag"><i class="fa fa-comment marR5" aria-hidden="true"></i>10 Comment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!--//================ Blog end ==============//-->
<div class="clear"></div>
<!--//================ Our Partner start ==============//-->
<!-- <div class="container marB100">
     <div class="row">
         <div id="partner-slider" class="owl-carousel owl-theme owl-loaded owl-drag">
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/4.png" alt="">
                     </figure>
                 </div>
             </div>
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/5.png" alt="">
                     </figure>
                 </div>
             </div>
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/6.png" alt="">
                     </figure>
                 </div>
             </div>
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/7.png" alt="">
                     </figure>
                 </div>
             </div>
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/8.png" alt="">
                     </figure>
                 </div>
             </div>
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/6.png" alt="">
                     </figure>
                 </div>
             </div>
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/7.png" alt="">
                     </figure>
                 </div>
             </div>
             <div class="col-xs-12">
                 <div class="item">
                     <figure>
                         <img src="assets/img/partner/8.png" alt="">
                     </figure>
                 </div>
             </div>
         </div>
     </div>
 </div>-->
<!--//================ Our Partner end ==============//-->
<div class="clear"></div>
<!--//================Footer start==============//-->
<footer class="main_footer">
    <div class="container">
        <div class="footer-box padT80 padB40">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="foot-sec marB30">
                        <figure class="marB10">
                            <img src="assets/img/all/footer-logo.png" alt=""/>
                        </figure>
                        <p>
                            Lorem ipsum dolor sit amet conse tetur
                            adipisicing lorem ipsum dolor sit amet
                            conse ctetur adipisicing sed do eiusmod
                            tempor . sed do eiusmod tempor conse
                            ctetur adipisicing sed do eiusmod.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="foot-sec marB30">
                        <h3 class="colorW marB20">Customer care</h3>
                        <p>Cosmetic shop <br>Good Town 122,Food Center</p>
                        <p>011 212 222 3499<br>
                            012 445 887 8888<br>
                            551 894 785 1589
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="foot-sec marB30">
                        <h3 class="colorW marB20">Your account</h3>
                        <ul class="pad0">
                            <li><a href="#"><i class="fa fa-angle-right marR10" aria-hidden="true"></i>My Wishlist</a></li>
                            <li><a href="#"><i class="fa fa-angle-right marR10" aria-hidden="true"></i>Menu item Number</a></li>
                            <li><a href="#"><i class="fa fa-angle-right marR10" aria-hidden="true"></i>Menu item 4</a></li>
                            <li><a href="#"><i class="fa fa-angle-right marR10" aria-hidden="true"></i>Menu Item Five</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="foot-sec foot-img-box marB30">
                        <h3 class="colorW marB20">Gallery</h3>
                        <ul class="pad0">
                            <li><a href="#"><img src="assets/img/all/foot-001%20(1).jpg" alt=""/></a></li>
                            <li><a href="#"><img src="assets/img/all/foot-001%20(2).jpg" alt=""/></a></li>
                            <li><a href="#"><img src="assets/img/all/foot-001%20(3).jpg" alt=""/></a></li>
                            <li><a href="#"><img src="assets/img/all/foot-001%20(4).jpg" alt=""/></a></li>
                            <li><a href="#"><img src="assets/img/all/foot-001%20(5).jpg" alt=""/></a></li>
                            <li><a href="#"><img src="assets/img/all/foot-001%20(6).jpg" alt=""/></a></li>
                            <li><a href="#"><img src="assets/img/all/foot-001%20(7).jpg" alt=""/></a></li>
                            <li><a href="#"><img src="assets/img/all/foot-001%20(8).jpg" alt=""/></a></li>
                        </ul>
                        <p><a href="#"><i class="fa fa-angle-right marR10" aria-hidden="true"></i>View more</a></p>
                    </div>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="foot-sec marB30">
                        <h3 class="colorW marB20">Social media</h3>
                        <ul class="social-icon">
                            <li><a href="#" class="theme-circle marR10"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="theme-circle marR10"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="theme-circle marR10"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="foot-sec marB30">
                        <h3 class="colorW marB20">Newsletter</h3>
                        <form class="search_bar">
                            <input type="text" name="search" placeholder="Search..">
                            <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
    <div class="bottom-footer padTB20 bagB">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center colorW">
                    <p>Copyright 2017  All Right Reserved <a href="http://www.itgeeksin.com/"><span class="theme-color">IT GEEKS</span></a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-background">
        <figure class="top-left">
            <img src="assets/img/background/footer-back-1.png" alt=""/>
        </figure>
        <figure class="bottom-right">
            <img src="assets/img/background/footer-back-2.png" alt=""/>
        </figure>
    </div>
</footer>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Order Summary</h3>
            </div>
            <div class="modal-body">
                <p style="font-size: 18px"><b id="pTxt"></b> item has been selected.</p>
                <input type="hidden" name="item_ids" id="item_ids">
            </div>
            <div class="modal-footer">
                <input type="submit" name="submit" class="btn btn-default" value="Place Order">
                <button type="button" class="btn btn-default" data-dismiss="modal">Add More</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--//================Footer end==============//-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugin/megamenu/js/hover-dropdown-menu.js"></script>
<script src="assets/plugin/megamenu/js/jquery.hover-dropdown-menu-addon.js"></script>
<script src="assets/plugin/owl-carousel/js/owl.carousel.min.js"></script>

<script type="text/javascript" src="assets/plugin/counter/js/jquery.countTo.js"></script>
<script type="text/javascript" src="assets/plugin/counter/js/jquery.appear.js"></script>
<script src="assets/js/main.js"></script>
<script>
    var numArray = [];
    function addToCart(item_id){
       //alert(item_id)
        numArray.push(item_id);
        var unique = numArray.filter( onlyUnique );

        console.log(unique)
        var item_count=unique.length;
        document.getElementById("pTxt").innerHTML = item_count;
        document.getElementById("item_ids").value = unique;
        return false;
    }
    function onlyUnique(value, index, self) {
        return self.indexOf(value) === index;
    }

    // usage example:

</script>
</body>
</html>
