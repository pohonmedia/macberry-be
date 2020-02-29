<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $template['title']; ?></title>
    <meta name="description" content="">
    <meta name="robots" content="all,follow">
    <!-- Required font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/212416152f.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo $theme_assets . 'css/plugin.min.css'; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/slick-carousel@1/slick/slick-theme.min.css,npm/slick-carousel@1/slick/slick.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1/slick/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1/slick/slick.min.css">

    <link rel="stylesheet" href="<?php echo $theme_assets . 'css/main.min.css'; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/favicon-16x16.png">
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <?php echo $template['partials']['header']; ?>
    <!-- Content block start here -->
        

<?php
    // $sliders = Modules::run('sliders/controller/get_all');
		if ($this->uri->uri_string() == "" && !empty($sliders)) {
?>
            <!-- Header Carousel -->
            <section id="home" class="slider-area pt-100 c-slider-homepage">
            <div class="container-fluid position-relative">
                <div  class="slider-active">
                <!-- Indicators -->
                <!-- <ol class="carousel-indicators"> -->
                    <?php
                    // $i = 0;
                    // for ($i = 0; $i < count($sliders); $i++) {
                    //     if ($i == 0) {
                    //         echo '<li data-target="#carouselHome" data-slide-to="' . $i . '" class="active"></li>';
                    //     } else {
                    //         echo '<li data-target="#carouselHome" data-slide-to="' . $i . '"></li>';
                    //     }
                    // }
                    ?>
                <!-- </ol> -->

                <!-- Wrapper for slides -->
                    <?php
                    foreach ($sliders as $key => $value) {
                        echo '<div class="single-slider">';
                        echo '<div class="slider-bg">';
                        echo '<div class="row no-gutters align-items-center">';
                        // item-start
                        echo '<div class="col-lg-4 col-md-5">';
                        echo '<div class="slider-product-image d-none d-md-block">';
                        echo '<img src="' . $value->sld_url . '" alt="Slider">';
                        // echo '<div class="slider-discount-tag">';
                        // echo '<p>80% disc</p>';
                        // echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-lg-8 col-md-7">';
                        echo '<div class="slider-product-content">';
                        echo '<h1 class="slider-title mb-10" data-animation="fadeInUp" data-delay="0.3s">';
                        echo $value->sld_title;
                        echo '</h1>';
                        echo '<p class="mb-30 mt-30 mr-50" data-animation="fadeInUp" data-delay="0.9s" style="letter-spacing:1px; line-height:1.5em;">';
                        echo $value->sld_text1;
                        echo '</p>';
                        echo '<a class="c-btn-primary" href="' . $value->sld_link . '" data-animation="fadeInUp" data-delay="1.5s">';
                        echo $value->sld_linktext;
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';

                        // echo '<img src="' . $value->sld_url . '" class="d-block w-100" alt="' . $value->sld_title . '">';
                        // echo '<div class="overlay"></div>';
                        // echo '<div class="carousel-caption d-none d-md-block">';
                        // echo '<h5>' . $value->sld_title . '</h5>';
                        // echo '<p>' . $value->sld_text1 . '</p>';
                        // echo '<a href="' . $value->sld_link . '" class="btn btn-outline-success my-2 my-sm-0 btn--primary" style="letter-spacing:2px;">' . $value->sld_linktext . '</a>';
                        // echo '</div>';
                        // item-end
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
            </div>
            </div>
        </section>
<?php } ?>
    <!-- about macberry start here -->
    <section id="service" class="about-us pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-30">
                        <h3 class="title mb-15 text-capitalize">about macberry</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusm od tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="services-left mt-25">
                        <div class="services">
                            <img src="./assets/img/img-1.jpg" alt="about us" style="max-width: 450px; max-height: 400px; object-fit:cover; border-radius:10px;">
                            <a href="#" class="c-btn-primary mt-30">pelajari lebih lanjut
                                <i class="lni-chevron-right"></i>
                            </a>
                        </div>
                        <!-- services btn -->
                    </div>
                    <!-- services left -->
                </div>
                <div class="col-lg-6 d-none d-md-block d-lg-block">

                    <div class="services-right">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-medal"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">terpercaya</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusm od tempor.</p>
                                    </div>
                                </div>
                                <!-- single services -->

                                <div class="single-services text-center mt-30 about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">fast response</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusm od tempor.</p>
                                    </div>
                                </div>
                                <!-- single services -->
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center mt-30 about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-mobile"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">produk beragam</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusm od tempor.</p>
                                    </div>
                                </div>
                                <!-- single services -->

                                <div class="single-services text-center mt-30 about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">free ongkir</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusm od tempor.</p>
                                    </div>
                                </div>
                                <!-- single services -->
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- services right -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- about macberry end here -->

    <!-- product list start here -->
    <section id="product-list" class="c-product-homepage">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="section-title pb-30 pt-100">
                        <h3 class="title mb-15 text-capitalize">our products</h3>
                    </div>
                    <!-- section title -->
                </div>
                <div class="col-lg-6">
                    <button class="c-btn-secondary text-capitalize mt-15 pb-15 mt-100" type="submit" style="letter-spacing:0.5px; right:0; position: absolute;">
                        produk lainya
                    </button>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6">

                    <!-- product post #1 -->
                    <div class="single-product mt-30">
                        <div class="product-image">
                            <img src="./assets/img/macbook-1.jpg" alt="product img">
                        </div>
                        <div class="product-content">
                            <div class="content">
                                <div class="row justify-content-between pt-10">
                                    <div class="col-12">
                                        <span style="font-size:20px; color:#ffa500;">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="pt-10 pb-15 text-capitalize">MacBook Air 13” 128gb new co…</h6>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, voluptatibus? Iste enim explicabo facilis molestias consectetur.
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <span class="pt-20 text-capitalize">
                                            <small >harga</small>
                                        </span>
                                        <h3 style="letter-spacing:1px; color: #212121;">
                                            16,000,000
                                        </h3>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <button class="c-btn-cart text-capitalize mt-20 ml-80" type="submit" style="letter-spacing:0.5px;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- meta -->
                        </div>
                    </div>
                    <!-- product post #1 end here-->

                </div>

                <div class="col-lg-4 col-md-6">

                    <!-- product post #1 -->
                    <div class="single-product mt-30">
                        <div class="product-image">
                            <img src="./assets/img/macbook-2.jpg" alt="product img">
                        </div>
                        <div class="product-content">
                            <div class="content">
                                <div class="row justify-content-between pt-10">
                                    <div class="col-12">
                                        <span style="font-size:20px; color:#ffa500;">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="pt-10 pb-15 text-capitalize">MacBook Air 13” 128gb new co…</h6>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, voluptatibus? Iste enim explicabo facilis molestias consectetur.
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <span class="pt-20 text-capitalize">
                                            <small >harga</small>
                                        </span>
                                        <h3 style="letter-spacing:1px; color: #212121;">
                                            16,000,000
                                        </h3>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <button class="c-btn-cart text-capitalize mt-20 ml-80" type="submit" style="letter-spacing:0.5px;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- meta -->
                        </div>
                    </div>
                    <!-- product post #1 end here-->

                </div>

                <div class="col-lg-4 col-md-6">

                    <!-- product post #1 -->
                    <div class="single-product mt-30">
                        <div class="product-image">
                            <img src="./assets/img/macbook-3.jpg" alt="product img">
                        </div>
                        <div class="product-content">
                            <div class="content">
                                <div class="row justify-content-between pt-10">
                                    <div class="col-12">
                                        <span style="font-size:20px; color:#ffa500;">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="pt-10 pb-15 text-capitalize">MacBook Air 13” 128gb new co…</h6>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, voluptatibus? Iste enim explicabo facilis molestias consectetur.
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <span class="pt-20 text-capitalize">
                                            <small >harga</small>
                                        </span>
                                        <h3 style="letter-spacing:1px; color: #212121;">
                                            16,000,000
                                        </h3>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <button class="c-btn-cart text-capitalize mt-20 ml-80" type="submit" style="letter-spacing:0.5px;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- meta -->
                        </div>
                    </div>
                    <!-- product post #1 end here-->

                </div>

            </div>
        </div>
    </section>
    <!-- product list end here -->

    <!-- product category start here -->
    <section id="product-category" class="c-product-category">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="section-title text-center pb-25">
                        <h3 class="title text-capitalize mb-15">Kategori kami</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum libero esse asperiores, consectetur quos labore eius.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <img src="../assets/img/product-1.png" alt="product img">
                </div>
                <div class="col-lg-4">
                    <img src="../assets/img/product-2.png" alt="product img">
                </div>
                <div class="col-lg-4">
                    <img src="../assets/img/product-3.png" alt="product img">
                </div>
                <div class="col-lg-4">
                    <img src="../assets/img/product-4.png" alt="product img">
                </div>
                <div class="col-lg-4">
                    <img src="../assets/img/product-5.png" alt="product img">
                </div>
                <div class="col-lg-4">
                    <img src="../assets/img/product-6.png" alt="product img">
                </div>

            </div>
        </div>
    </section>
    <!-- product category end here -->

    <!-- product promo start here -->
    <section id="product-promo" class="c-promo">
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="section-title text-center pb-25 mt-50">
                        <h3 class="title text-capitalize mb-15">Promo terbaru</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum libero esse asperiores, consectetur quos labore eius.</p>
                    </div>
                </div>
            </div>

            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="10000">
                        <img src="./assets/img/promo-1.jpg" class="d-block w-100" alt="product img">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img src="./assets/img/promo-2.jpg" class="d-block w-100" alt="product img">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/promo-3.jpg" class="d-block w-100" alt="product img">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </section>
    <!-- product promo end here -->

    <!-- news start here -->
    <section id="blog" class="c-blog blog-area pt-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h3 class="title text-capitalize mb-15">Berita terbaru</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum libero esse asperiores, consectetur quos labore eius.</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">

                    <!-- blog post #1 -->
                    <div class="single-blog mt-30">
                        <div class="blog-image">
                            <img src="./assets/img/macbook-2.jpg" alt="blog img">
                        </div>
                        <div class="blog-content">
                            <div class="content">
                                <div class="row justify-content-between pt-10">
                                    <div class="col-7">
                                        <p>Posted at 29/09/2019</p>
                                    </div>
                                    <div class="col-5">
                                        <span class="badge badge-pill badge-light font-weight-normal">long categories</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="pt-10 pb-15 text-capitalize">
                                            16-inch MacBook Pro Could Have This Massive Upgrade
                                        </h5>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, voluptatibus? Iste enim explicabo facilis molestias consectetur.
                                        </p>
                                        <button class="c-btn-primary text-capitalize mt-15 pb-15 w-100" type="submit" style="letter-spacing:0.5px;">
                                            baca lebih lanjut
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- meta -->
                        </div>
                    </div>
                    <!-- blog post #1 end here-->

                </div>
                <div class="col-lg-4 col-md-6">

                    <!-- blog post #1 -->
                    <div class="single-blog mt-30">
                        <div class="blog-image">
                            <img src="./assets/img/macbook-3.jpg" alt="blog img">
                        </div>
                        <div class="blog-content">
                            <div class="content">
                                <div class="row justify-content-between pt-10">
                                    <div class="col-7">
                                        <p>Posted at 29/09/2019</p>
                                    </div>
                                    <div class="col-5">
                                        <span class="badge badge-pill badge-light font-weight-normal">long categories</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="pt-10 pb-15 text-capitalize">
                                            MacBook Pro Best Productivity
                                        </h5>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, voluptatibus? Iste enim explicabo facilis molestias consectetur.
                                        </p>
                                        <button class="c-btn-primary text-capitalize mt-15 pb-15 w-100" type="submit" style="letter-spacing:0.5px;">
                                            baca lebih lanjut
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- meta -->
                        </div>
                    </div>
                    <!-- blog post #1 end here-->

                </div>
                <div class="col-lg-4 col-md-6">

                    <!-- blog post #1 -->
                    <div class="single-blog mt-30">
                        <div class="blog-image">
                            <img src="./assets/img/iphone-2.jpg" alt="blog img">
                        </div>
                        <div class="blog-content">
                            <div class="content">
                                <div class="row justify-content-between pt-10">
                                    <div class="col-7">
                                        <p>Posted at 29/09/2019</p>
                                    </div>
                                    <div class="col-5">
                                        <span class="badge badge-pill badge-light font-weight-normal">long categories</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="pt-10 pb-15 text-capitalize">New iPhone Pro specs, news and release date</h5>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, voluptatibus? Iste enim explicabo facilis molestias consectetur.
                                        </p>
                                        <button class="c-btn-primary text-capitalize mt-15 pb-15 w-100" type="submit" style="letter-spacing:0.5px;">
                                            baca lebih lanjut
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- meta -->
                        </div>
                    </div>
                    <!-- blog post #1 end here-->

                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- news end here -->


        <!-- Content block end here -->

        <!-- footer start here -->
        <section id="footer" class="c-footer footer-area mt-50">
            <div class="container">
                <div class="footer-widget pt-30 pb-30">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-7">
                            <div class="footer-logo mt-40">
                                <a href="#">
                                    <img src="./assets/img/macberry.svg" alt="Logo" style="height:40px;">
                                </a>
                                <p class="mt-10">Gravida nibh vel velit auctor aliquetn quibibendum auci elit cons equat ipsutis sem nibh id elit.</p>
                                <ul class="footer-social mt-25">
                                    <li>
                                        <a href="#">
                                            <i class="lni-facebook-filled"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="lni-twitter-original"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="lni-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- footer logo -->
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-5">
                            <div class="footer-link mt-50 ml-50">
                                <h5 class="f-title text-capitalize">Produk kami</h5>
                                <ul>
                                    <li>
                                        <a href="#">iPhone</a>
                                    </li>
                                    <li>
                                        <a href="#">Macbook
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">iMac</a>
                                    </li>
                                    <li>
                                        <a href="#">Accessories</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- footer link -->
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-7">
                            <div class="footer-info mt-50">
                                <h5 class="f-title">Kontak Kami</h5>
                                <ul>
                                    <li>
                                        <div class="single-footer-info mt-20">
                                            <span class="text-capitalize">Nomor &nbsp;:</span>
                                            <div class="footer-info-content">
                                                <p>+62 878-4565-1984</p>
                                            </div>
                                        </div>
                                        <!-- single footer info -->
                                    </li>
                                    <li>
                                        <div class="single-footer-info mt-20">
                                            <span class="text-capitalize">Alamat&nbsp;:</span>
                                            <div class="footer-info-content">
                                                <p>Jl. Kaliurang KM 6,5 Blok A No. 03, Kentungan, Condongcatur, Yogyakarta 55281</p>
                                            </div>
                                        </div>
                                        <!-- single footer info -->
                                    </li>
                                </ul>
                            </div>
                            <!-- footer link -->
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- footer widget -->
                <div class="footer-copyright pt-15 pb-15">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright text-center">
                                <p>Crafted by
                                    <a href="https://pohonmedia.com" rel="nofollow">Pohonmedia</a>
                                </p>
                            </div>
                            <!-- copyright -->
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- footer copyright -->
            </div>
            <!-- container -->
        </section>
    <!-- Javascript files-->
    <script src="<?php echo $theme_assets . 'js/plugin.min.js'; ?>"></script>
    <script src="<?php echo $theme_assets . 'js/main.js'; ?>"> </script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1/slick/slick.min.js"></script>
    <script type="text/javascript">
            var BASE_URL = "<?php echo base_url(); ?>";
    </script>
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.js"></script> -->
    <script src="<?php echo $theme_assets . 'js/app.js'; ?>"></script>
  </body>
</html>