<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $template['title']; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo $theme_assets . 'vendor/bootstrap/css/bootstrap.min.css'; ?>">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo $theme_assets . 'vendor/font-awesome/css/font-awesome.min.css'; ?>">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="<?php echo $theme_assets . 'vendor/bootstrap-select/css/bootstrap-select.min.css'; ?>">
    <!-- owl carousel-->
    <link rel="stylesheet" href="<?php echo $theme_assets . 'vendor/owl.carousel/assets/owl.carousel.css'; ?>">
    <link rel="stylesheet" href="<?php echo $theme_assets . 'vendor/owl.carousel/assets/owl.theme.default.css'; ?>">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo $theme_assets . 'css/style.yellow.css'; ?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo $theme_assets . 'css/custom.css'; ?>">
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div id="all">
      <!-- Top bar-->
      <div class="top-bar">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-md-6 d-md-block d-none">
              <p>Contact Us On 0821 4356 2925</p>
            </div>
            <div class="col-md-6">
              <div class="d-flex justify-content-md-end justify-content-between">
                <ul class="list-inline contact-info d-block d-md-none">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                </ul>
                <div class="login">
                    <?php if(!$this->ion_auth->logged_in()) {?>
                    <a href="#" data-toggle="modal" data-target="#login-modal" class="login-btn">
                        <i class="fa fa-sign-in"></i><span class="d-none d-md-inline-block">Sign In</span>
                    </a>
                    <a href="<?php echo base_url('auth/register'); ?>" class="signup-btn">
                      <i class="fa fa-user"></i><span class="d-none d-md-inline-block">Sign Up</span>
                    </a>
                  <?php } else { ?>
                    <a href="<?php echo base_url('member'); ?>" class="signup-btn">
                      <i class="fa fa-user"></i><span class="d-none d-md-inline-block">My Account</span>
                    </a>
                  <?php } ?>
                    <a href="<?php echo base_url('order/detail'); ?>" class="signup-btn">
                      <i class="fa fa-shopping-cart"></i><span class="d-none d-md-inline-block">My Cart</span>
                    </a>
                    <?php if($this->ion_auth->logged_in()) {?>
                    <a href="<?php echo base_url('auth/logout'); ?>" class="signup-btn">
                      <i class="fa fa-sign-out"></i><span class="d-none d-md-inline-block">Logout</span>
                    </a>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Top bar end-->
      <!-- Login Modal-->
      <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Customer Login</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <form action="<?php echo base_url('auth/login');?>" method="post">
                <div class="form-group">
                  <input name="identity" id="email_modal" type="text" placeholder="username" class="form-control">
                </div>
                <div class="form-group">
                  <input name="password" id="password_modal" type="password" placeholder="password" class="form-control">
                </div>
                  <input name="ref_form" type="hidden" placeholder="password" class="form-control" value="member">
                <p class="text-center">
                  <button class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Log in</button>
                </p>
              </form>
              <p class="text-center text-muted">Not registered yet?</p>
              <p class="text-center text-muted"><a href="<?php echo base_url('auth/register'); ?>"><strong>Register now</strong></a>! It is easy and done in 1 minute and gives you access to special discounts and much more!</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Login modal end-->
      <!-- Navbar Start-->
      <header class="nav-holder make-sticky">
        <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
          <div class="container"><a href="<?php echo base_url(); ?>" class="navbar-brand home"><img src="<?php echo $theme_assets . 'img/logo.png'; ?>" alt="Universal logo" class="d-none d-md-inline-block"><img src="img/logo-small.png" alt="Universal logo" class="d-inline-block d-md-none"><span class="sr-only">Makadata - go to homepage</span></a>
            <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <div id="navigation" class="navbar-collapse collapse">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown "><a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">Home <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="index.html" class="nav-link">Option 1: Default Page</a></li>
                    <li class="dropdown-item"><a href="index2.html" class="nav-link">Option 2: Application</a></li>
                    <li class="dropdown-item"><a href="index3.html" class="nav-link">Option 3: Startup</a></li>
                    <li class="dropdown-item"><a href="index4.html" class="nav-link">Option 4: Agency</a></li>
                    <li class="dropdown-item"><a href="index5.html" class="nav-link">Option 5: Portfolio</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown"><a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">Profile <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="<?php echo base_url('profiles/profile'); ?>" class="nav-link">Profile Us</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Catalogue <b class="caret"></b></a>
                  <ul class="dropdown-menu megamenu">
                    <li>
                      <div class="row">
                        <div class="col-lg-6"><img src="img/template-homepage.png" alt="" class="img-fluid d-none d-lg-block"></div>
                        <div class="col-lg-3 col-md-6">
                          <h5>Office & Stationery</h5>
                          <ul class="list-unstyled mb-3">
                            <li class="nav-item"><a href="portfolio-2.html" class="nav-link">Ballpoint</a></li>
                            <li class="nav-item"><a href="portfolio-no-space-2.html" class="nav-link">Crayon</a></li>
                            <li class="nav-item"><a href="portfolio-3.html" class="nav-link">Pensil</a></li>
                            <li class="nav-item"><a href="portfolio-no-space-3.html" class="nav-link">Tinta</a></li>
                          </ul>
                        </div>
                        <div class="col-lg-3 col-md-6">
                          <h5>Aksesoris Komputer</h5>
                          <ul class="list-unstyled mb-3">
                            <li class="nav-item"><a href="about.html" class="nav-link">Flashdisk</a></li>
                            <li class="nav-item"><a href="team.html" class="nav-link">Mouse</a></li>
                            <li class="nav-item"><a href="team-member.html" class="nav-link">Kabel Data</a></li>
                            <li class="nav-item"><a href="services.html" class="nav-link">CD-R</a></li>
                          </ul>
                          <h5>Toys/Mainan</h5>
                          <ul class="list-unstyled">
                            <li class="nav-item"><a href="packages.html" class="nav-link">Puzzle</a></li>
                            <li class="nav-item"><a href="packages.html" class="nav-link">Fun Games</a></li>
                            <li class="nav-item"><a href="packages.html" class="nav-link">Mobil-mobilan</a></li>
                            <li class="nav-item"><a href="packages.html" class="nav-link">Fun Doh</a></li>
                          </ul>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <!-- ========== FULL WIDTH MEGAMENU ==================-->
                <!-- ========== FULL WIDTH MEGAMENU END ==================-->
                <!-- ========== Contact dropdown ==================-->
                <li class="nav-item dropdown"><a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">Contact <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="<?php echo base_url('contacts/contact'); ?>" class="nav-link">Contact Us</a></li>
                  </ul>
                </li>
                <!-- ========== Contact dropdown end ==================-->
              </ul>
            </div>
            <div id="search" class="collapse clearfix">
              <form role="search" class="navbar-form">
                <div class="input-group">
                  <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </header>
      <!-- Navbar End-->
      
      <?php
      if (is_homepage()) {
      ?>
      <section style="background: url('img/photogrid.jpg') center center repeat; background-size: cover;" class="bar background-white relative-positioned">
        <div class="container">
          <!-- Carousel Start-->
          <div class="home-carousel">
            <div class="dark-mask mask-primary"></div>
            <div class="container">
              <div class="homepage owl-carousel">
                <div class="item">
                  <div class="row">
                    <div class="col-md-5 text-right">
                      <p><img src="img/logo.png" alt="" class="ml-auto"></p>
                      <h1>Multipurpose responsive theme</h1>
                      <p>Business. Corporate. Agency.<br>Portfolio. Blog. E-commerce.</p>
                    </div>
                    <div class="col-md-7"><img src="img/template-homepage.png" alt="" class="img-fluid"></div>
                  </div>
                </div>
                <div class="item">
                  <div class="row">
                    <div class="col-md-7 text-center"><img src="img/template-mac.png" alt="" class="img-fluid"></div>
                    <div class="col-md-5">
                      <h2>46 HTML pages full of features</h2>
                      <ul class="list-unstyled">
                        <li>Sliders and carousels</li>
                        <li>4 Header variations</li>
                        <li>Google maps, Forms, Megamenu, CSS3 Animations and much more</li>
                        <li>+ 11 extra pages showing template features</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="row">
                    <div class="col-md-5 text-right">
                      <h1>Design</h1>
                      <ul class="list-unstyled">
                        <li>Clean and elegant design</li>
                        <li>Full width and boxed mode</li>
                        <li>Easily readable Roboto font and awesome icons</li>
                        <li>7 preprepared colour variations</li>
                      </ul>
                    </div>
                    <div class="col-md-7"><img src="img/template-easy-customize.png" alt="" class="img-fluid"></div>
                  </div>
                </div>
                <div class="item">
                  <div class="row">
                    <div class="col-md-7"><img src="img/template-easy-code.png" alt="" class="img-fluid"></div>
                    <div class="col-md-5">
                      <h1>Easy to customize</h1>
                      <ul class="list-unstyled">
                        <li>7 preprepared colour variations.</li>
                        <li>Easily to change fonts</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Carousel End-->
        </div>
      </section>
      <?php
      } else {
        echo '<div id="heading-breadcrumbs">';
        echo '<div class="container">';
        echo '<div class="row d-flex align-items-center flex-wrap">';
        echo '<div class="col-md-7">';
        echo '<h1 class="h2">' . $page_desc . '</h1>';
        echo '</div>';
        echo '<div class="col-md-5">';
        echo $this->breadcrumbs->show();
        // echo '<ul class="breadcrumb d-flex justify-content-end">';
        // echo '<li class="breadcrumb-item"><a href="index.html">Home</a></li>';
        // echo '<li class="breadcrumb-item active">Category Full</li>';
        // echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      ?>
       <div id="content">
        <div class="container">
          <div class="row bar">
            <div class="col-md-12">
              <div class="products-big">
                <div class="row products">
                    
                  <?php echo $template['body']; ?>

                </div>
              </div>
              <!-- <div class="pages">
                <p class="loadMore text-center"><a href="#" class="btn btn-template-outlined"><i class="fa fa-chevron-down"></i> Load more</a></p>
                <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                  <ul class="pagination">
                    <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-double-left"></i></a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                  </ul>
                </nav>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      
      
      <!-- FOOTER -->
      <footer class="main-footer">
        <div class="copyrights">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 text-center-md">
                <p>&copy; 2019. Makadata Stationery</p>
              </div>
              <div class="col-lg-8 text-right text-center-md">
                <p>Template design by <a href="https://bootstrapious.com/free-templates">Bootstrapious Templates </a></p>
                <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Javascript files-->
    <script src="<?php echo $theme_assets . 'vendor/jquery/jquery.min.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'vendor/popper.js/umd/popper.min.js'; ?>"> </script>
    <script src="<?php echo $theme_assets . 'vendor/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'vendor/jquery.cookie/jquery.cookie.js'; ?>"> </script>
    <script src="<?php echo $theme_assets . 'vendor/waypoints/lib/jquery.waypoints.min.js'; ?>"> </script>
    <script src="<?php echo $theme_assets . 'vendor/jquery.counterup/jquery.counterup.min.js'; ?>"> </script>
    <script src="<?php echo $theme_assets . 'vendor/owl.carousel/owl.carousel.min.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'js/jquery.parallax-1.1.3.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'vendor/bootstrap-select/js/bootstrap-select.min.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'vendor/jquery.scrollto/jquery.scrollTo.min.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'js/front.js'; ?>"></script>
    <script type="text/javascript">
            var BASE_URL = "<?php echo base_url(); ?>";
    </script>
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.js"></script> -->
    <script src="<?php echo $theme_assets . 'js/app.js'; ?>"></script>
  </body>
</html>