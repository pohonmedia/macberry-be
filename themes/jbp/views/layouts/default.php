<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $template['title']; ?></title>
        <meta name="generator" content="B2M Team" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Official B2M Website">
        <meta name="author" content="B2M Team">
        <!--Meta end-->

        <link href="<?php echo $theme_assets . 'css/bootstrap.min.css'; ?>" rel='stylesheet' type='text/css' />
        <link href="<?php echo $theme_assets . 'fonts/css/font-awesome.css'; ?>" rel='stylesheet' type='text/css' />
        <link href="<?php echo $theme_assets . 'css/megamenu.css'; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo $theme_assets . 'css/flexslider.css'; ?>" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo $theme_assets . 'css/style.css'; ?>" rel="stylesheet" type="text/css" media="all" />
        <!--webfont-->
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!--<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />-->
        <!--<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />-->
        <!--<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />-->
        <!--<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />-->
        <!--CSS Original Comment-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="<?php echo $theme_assets . 'js/jQuery-2.1.4.min.js'; ?>"></script>
        <!--<script type="text/javascript" src="<?php // echo $theme_assets . 'js/megamenu.js';   ?>"></script>-->
        <!--<script type="text/javascript" src="<?php // echo $theme_assets . 'js/responsiveslides.min.js';   ?>"></script>-->
        <script type="text/javascript" src="<?php echo $theme_assets . 'js/jquery.flexisel.js'; ?>"></script>

        <!-- Custom Theme files -->
        <script type="application/x-javascript">
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
        </script>
        <script type="text/javascript">
//            <!-- start menu -->
//            $(document).ready(function () {
//                $(".megamenu").megamenu();
//            });
//              <!-- start slider -->
//            $(function () {
//                $("#slider").responsiveSlides({
//                    auto: true,
//                    speed: 500,
//                    namespace: "callbacks",
//                    pager: true
//                });
//            });

            $(window).load(function () {
            $("#flexiselDemo").flexisel({
            visibleItems: 5,
                    animationSpeed: 1000,
                    autoPlay: false,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                    portrait: {
                    changePoint: 480,
                            visibleItems: 1
                    },
                            landscape: {
                            changePoint: 640,
                                    visibleItems: 2
                            },
                            tablet: {
                           changePoint: 768,
                            visibleItems: 3
                        }
                    }
                });
            });
        </script>
    </head>
    <body>
        <!-- header-section-starts -->
        <div class="header">
            <div class="top-header">
                <div class="wrap">
                    <div class="header-left">
                        <ul>
                            <li><a href="#">24x7 Customer Care  </a></li> |
                            <li><a href="order.html"> Track Order</a></li>
                        </ul>
                    </div>
                    <div class="header-right">
                        <ul>
                            <li>
                                <i class="user"></i>
                                <a href="<?php echo base_url('member'); ?>">My Account</a>
                            </li>
                            <li class="login">
                                <i class="lock"></i>
                                <a href="<?php echo base_url('member'); ?>">Login</a>|
                            </li>
                            <li>
                                <i class="cart"></i>
                                <a href="#">Shopping Cart</a>
                            </li>
                            <li class="last">0</li>
                        </ul>
                        <div class="sign-up-right">
                            <a href="<?php echo base_url('register'); ?>">Sign Up</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="wrap">
                <div class="header-bottom">
                    <div class="logo">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo $theme_assets . '/img/logo.png'; ?>" class="img-responsive" alt="JualBeliPlus" /></a>
                    </div>
                    <?php
                    if ($this->uri->uri_string() == "") {
                        ?>
                        <div class="search">
                            <div class="search2">
                                <form>
                                    <input type="submit" value="">
                                    <input type="text" value="Search for a product, category or brand" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                                    this.value = 'Search for a product, category or brand';
                                                                    }"/>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- header-section-ends -->

        <div class="wrap">
            <div class="navigation-strip">
                <h4>Most Popular<i class="arrow"></i></h4>
                <div class="top-menu">
                    <!-- start header menu -->
                    <ul class="megamenu skyblue">
                        <li><a class="color1" href="#">mobiles</a></li>
                        <li class="grid"><a class="color2" href="#">tablets</a></li>
                        <li class="grid"><a class="color4" href="#">laptops</a></li>				
                        <li><a class="color5" href="#">cameras</a></li>
                        <li><a class="color6" href="#">watches</a></li>
                        <li><a class="color8" href="#">eBooks</a></li>
                        <li><a class="color9" href="#">T-shirts</a></li>
                        <li><a class="color5" href="#">sarees</a></li>
                        <li><a class="color1" href="#">jeans</a></li>
                        <li><a class="color10" href="#">perfumes</a></li>
                        <li><a class="color2" href="#">sofas</a></li>
                        <li><a class="color6" href="#">sunglasses</a></li>
                    </ul> 
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
            if ($this->uri->uri_string() == "") {
                ?>
                <div class="main-top">
                    <div class="col-md-8 banner">
                        <!-- start slider -->
                        <!----->
                        <div class="slider">	  
                            <div class="callbacks_container">
                                <img src="<?php echo $theme_assets . '/img/slider1.jpg'; ?>" alt=""/>
                            </div>
                        </div>
                        <!----->
                        <!-- end  slider -->
                    </div>
                    <div class="col-md-4 right-grid">
                        <div class="right-grid-top">
                            <div class="r-sale text-center">
                                <h6>Winter wear</h6>
                                <h2>Sale</h2>
                            </div>
                            <div class="r-discount">
                                <span>upto</span>
                                <h2>50%</h2>
                                <p>OFF</p>
                                <a href="#">shop now<i class="go"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="right-grid-bottom">
                            <div class="right-grid-bottom-left">
                                <h3>Deal of the Day</h3>
                                <p>Expires in 3:42:56</p>
                                <h5>Wireless Headphones</h5>
                                <h2>Extra 33% OFF</h2>
                                <a href="#">shop now<i class="go"></i></a>
                            </div>
                            <div class="right-grid-bottom-right">
                                <img src="<?php echo $theme_assets . '/img/headset.png'; ?>" alt="" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="new-arrivals text-center">
                    <div class="col-md-3 new-arrival-head">
                        <h3>New Arrivals</h3>
                        <a class="btn btn-1 btn-1d" href="#">View All</a>
                    </div>
                    <div class="col-md-3 product-item">
                        <a href="#"><img src="<?php echo $theme_assets . '/img/watch.jpg'; ?>" class="img-responsive" alt="" /></a>
                        <h3>Watches</h3>
                        <a href="#">Shop Now<i class="go"></i></a>
                    </div>
                    <div class="col-md-3 product-item">
                        <a href="#"><img src="<?php echo $theme_assets . 'img/men-jacket.jpg'; ?>" class="img-responsive zoom-img" alt="" /></a>
                        <h3>jackets</h3>
                        <a href="#">Shop Now<i class="go"></i></a>
                    </div>
                    <div class="col-md-3 product-item">
                        <a href="#"><img src="<?php echo $theme_assets . 'img/shoes.jpg'; ?>" class="img-responsive zoom-img" alt="" /></a>
                        <h3>Footwear</h3>
                        <a href="#">Shop Now<i class="go"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br />
                <div class="best-sellers">
                    <div class="best-sellers-head">
                        <h3>Bestsellers</h3>
                    </div>
                    <div class="best-sellers-menu">
                        <ul>
                            <li><a class="active" href="#">Electronics</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Books</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--Start Comment-->
                <!--            <div class="device">
                                <div class="course_demo">
                                    <ul id="flexiselDemo">	
                                        <li>
                                            <div class="ipad text-center">
                                                <img src="images/phone.jpg" alt="" />
                                                <h4>Ipad Mini</h4>
                                                <h3>$499</h3>
                                                <ul>
                                                    <li><i class="cart-1"></i></li>
                                                    <li><a class="cart" href="#">Add To Cart</a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <ul>
                                                    <li><i class="heart"></i></li>
                                                    <li><a class="cart" href="#">Add To Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="ipad text-center">
                                                <img src="images/phone1.jpg" alt="" />
                                                <h4>Ipad Mini</h4>
                                                <h3>$499</h3>
                                                <ul>
                                                    <li><i class="cart-1"></i></li>
                                                    <li><a class="cart" href="#">Add To Cart</a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <ul>
                                                    <li><i class="heart"></i></li>
                                                    <li><a class="cart" href="#">Add To Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </li>	
                                        <li>
                                            <div class="ipad text-center">
                                                <img src="images/phone2.jpg" alt="" />
                                                <h4>Ipad Mini</h4>
                                                <h3>$499</h3>
                                                <ul>
                                                    <li><i class="cart-1"></i></li>
                                                    <li><a class="cart" href="#">Add To Cart</a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <ul>
                                                    <li><i class="heart"></i></li>
                                                    <li><a class="cart" href="#">Add To Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </li>	
                                        <li>
                                            <div class="ipad text-center">
                                                <img src="images/phone3.jpg" alt="" />
                                                <h4>Ipad Mini</h4>
                                                <h3>$499</h3>
                                                <ul>
                                                    <li><i class="cart-1"></i></li>
                                                    <li><a class="cart" href="#">Add To Cart</a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <ul>
                                                    <li><i class="heart"></i></li>
                                                    <li><a class="cart" href="#">Add To Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </li>	
                                        <li>
                                            <div class="ipad text-center">
                                                <img src="images/phone4.jpg" alt="" />
                                                <h4>Ipad Mini</h4>
                                                <h3>$499</h3>
                                                <ul>
                                                    <li><i class="cart-1"></i></li>
                                                    <li><a class="cart" href="#">Add To Cart</a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <ul>
                                                    <li><i class="heart"></i></li>
                                                    <li><a class="cart" href="#">Add To Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </li>							    	  	       	   	  									    	  	       	   	    	
                                    </ul>
                                </div>
                            </div>
                            <div class="clients">
                                <div class="course_demo1">
                                    <ul id="flexiselDemo1">	
                                        <li>
                                            <div class="client">
                                                <img src="images/c1.jpg" alt="" />
                                            </div>
                                        </li>
                                        <li>
                                            <div class="client">
                                                <img src="images/c2.jpg" alt="" />
                                            </div>
                                        </li>	
                                        <li>
                                            <div class="client">
                                                <img src="images/c4.jpg" alt="" />
                                            </div>
                                        </li>	
                                        <li>
                                            <div class="client">
                                                <img src="images/c3.jpg" alt="" />
                                            </div>
                                        </li>	
                                        <li>
                                            <div class="client">
                                                <img src="images/c5.jpg" alt="" />
                                            </div>
                                        </li>	
                                        <li>
                                            <div class="client">
                                                <img src="images/c6.jpg" alt="" />
                                            </div>
                                        </li>
                                        <li>
                                            <div class="client">
                                                <img src="images/c7.jpg" alt="" />
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
                                <script type="text/javascript">
                                    $(window).load(function () {
                                        $("#flexiselDemo1").flexisel({
                                            visibleItems: 7,
                                            animationSpeed: 1000,
                                            autoPlay: false,
                                            autoPlaySpeed: 3000,
                                            pauseOnHover: true,
                                            enableResponsiveBreakpoints: true,
                                            responsiveBreakpoints: {
                                                portrait: {
                                                    changePoint: 480,
                                                    visibleItems: 1
                                                },
                                                landscape: {
                                                    changePoint: 640,
                                                    visibleItems: 2
                                                },
                                                tablet: {
                                                    changePoint: 768,
                                                    visibleItems: 3
                                                }
                                            }
                                        });
                
                                    });
                                </script>
                                <script type="text/javascript" src="js/jquery.flexisel.js"></script>
                            </div>-->
                <br />
                <div class="transport-grid">
                    <div class="col-md-4 shipping">
                        <h3><i class="shipping-icon"></i>Free Shipping</h3>
                        <p>Syphogrants called into the council chamber, and these are changed every day. It is a fundamental rule of their government,</p>
                    </div>
                    <div class="col-md-4 shipping">
                        <h3><i class="correct-icon"></i>100 % Original</h3>
                        <p>Syphogrants called into the council chamber, and these are changed every day. It is a fundamental rule of their government,</p>
                    </div>
                    <div class="col-md-4 return">
                        <h3><i class="return-icon"></i>Free Return</h3>
                        <p>Syphogrants called into the council chamber, and these are changed every day. It is a fundamental rule of their government,</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php } else { ?>
                    <?php
                    echo $template['body'];
                    ?>
                <?php } ?>
            </div>
        <div class="footer">
            <div class="wrap">
                <div class="contact-section">
                    <div class="col-md-4 follow text-left">
                        <h3>Follow Us</h3>
                        <p>Lorem ipsum dolor sit amet</p>
                        <div class="social-icons">
                            <i class="twitter"></i>
                            <i class="facebook"></i>
                            <i class="googlepluse"></i>
                            <i class="pinterest"></i>
                            <i class="linkedin"></i>
                        </div>
                    </div>
                    <div class="col-md-4 subscribe text-left">
                        <h3>Subscribe Us</h3>
                        <p>Get the latest updates & Offers right in your inbox.</p>
                        <input type="text" class="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                    this.value = '';
                                                    }">
                        <input type="submit" value="Subscribe">
                    </div>
                    <div class="col-md-4 help text-right">
                        <h3>Need Help?</h3>
                        <p>Lorem ipsum dolor sit amet</p>
                        <a href="contact.html">Contact us</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="footer-middle">
                    <div class="col-md-6 different-products">
                        <ul>
                            <li class="first"> Shop </li> -
                            <li><a href=""> Mobiles </a></li> |
                            <li><a href=""> Laptops </a></li> |
                            <li><a href=""> Cameras </a></li> |
                            <li><a href=""> Clothing </a></li> |
                            <li><a href=""> Footwear </a></li> |
                            <li><a href=""> Jewellery </a></li> 
                        </ul>
                        <ul>
                            <li class="first"> Help </li> -
                            <li><a href=""> Faqs </a></li> |
                            <li><a href=""> shipping </a></li> |
                            <li><a href=""> payments </a></li> |
                            <li><a href=""> cancellation&returns </a></li> 
                        </ul>
                        <ul>
                            <li class="first"> account <li> -
                            <li><a href=""> log in </a></li> |
                            <li><a href=""> sign up </a></li> |
                            <li><a href=""> My WhishList </a></li> |
                            <li><a href=""> My cart </a></li> 
                        </ul>
                        <ul>
                            <li class="first"> boxshop </li> -
                            <li><a href="contact.html"> contact us </a></li> |
                            <li><a href=""> about us </a></li> |
                            <li><a href=""> careers </a></li> |
                            <li><a href=""> blog </a></li> |
                            <li><a href=""> press </a></li>
                        </ul>
                        <ul>
                            <li class="first"> policies</li> -
                            <li><a href=""> terms of use </a></li> |
                            <li><a href=""> security </a></li> |
                            <li><a href=""> privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 about-text text-right">
                        <h4>About <span style="color:#00B050">Jual<b>Beli</b></span><span style="color:#E36C0A;">Plus</span></h4>
                        <p>The fashion never alters, and as it is neither disagreeable nor uneasy, so it is suited to the climate, and calculated both for their summers and winters. Every family makes their own clothes; but all among them, women as well as men, learn one or other of the trades formerly mentioned.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="cards text-center">
                    <img src="<?php echo $theme_assets . 'img/cards.jpg'; ?>" alt="" />
                </div>
                <div class="copyright text-center">
                    <p>Copyright &copy; 2016 All rights reserved <span style="color:#00B050">Jual<b>Beli</b></span><span style="color:#E36C0A;">Plus</span></p>
                </div>

            </div>
        </div>
    </body>
</html>