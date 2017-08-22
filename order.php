<?php
include_once("configuration/connect.php");
include_once("configuration/functions.php");

if(isset($_POST['submit'])){
    $item_ids = $_POST['item_ids'];
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
<!--//================Bredcrumb starts==============//-->
<section>
    <div class="bredcrumb-section padTB100 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-head">
                        <div class="page-header-heading">
                            <h3 class="theme-color">Menu</h3>
                        </div>
                        <div class="breadcrumb-box">
                            <ul class="breadcrumb colorW marB0">
                                <li>
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="active">Menu</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//================Bredcrumb end==============//-->
<div class="clear"></div>
<!--//================Special Menu start==============//-->
<section class="padT100 padB70">
    <!--- Theme heading start-->
    <div class="theme-heading marB50 positionR">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12  col-md-offset-3 col-sm-offset-2 col-xs-offset-0 heading-box text-center">
                    <h1>Some special menu</h1>
                </div>
            </div>
        </div>
    </div>
    <!--- Theme heading end-->
    <div class="container">
        <!-- <div class="row">
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
                if(isset($_POST['submit'])){
                            $sqQry=mysql_query("select * from `food_menu` where id IN($item_ids) order by `id` desc ");
                            $i=0;
                            $numrow=mysql_num_rows($sqQry);
                            if($numrow>0){
                                while($fetch=mysql_fetch_array($sqQry)){
                                    $i++;
                                    $price = $fetch['price'];
                                    ?>
                                    <div class="row">
                                        <table border="1">
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $fetch['name'] ?></td>
                                                <td>
                                                    <select onchange="setQuantity(this.value,<?php echo $price ?>)">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </td>
                                                <td><span id="final_price"><?php echo $fetch['price'] ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                             <?php }}}?>
                        </div>

            </div>
        </div>
    </div>
</section>
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
            <div class="row">
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
            </div>
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
    function setQuantity(qty,price){
        var final_price = qty*price;
        document.getElementById('final_price').innerHTML = final_price;

    }

</script>
</body>
</html>
