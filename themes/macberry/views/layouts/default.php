<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
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
            <section id="home" class="slider-area pt-100 c-slider-homepage" style="padding-top:150px;">
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
    <?php echo $template['body']; ?>
    <!-- Footer start here -->
    <?php echo $template['partials']['footer']; ?>

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