
    <div class="jumbotron c-pkg-detail-header">
        <div class="c-pkg-detail-header-content">
            <div class="container d-flex align-items-center">
                <div class="row no-gutters">
                    <!-- wording start here -->
                    <div class="col-lg-12">
                        <h1 class="display-4">
                            <?php echo $product->prod_name; ?>
                        </h1>
                        <p>
                        <?php echo $product->prod_desc; ?>
                        </p>
                    </div>
                    <!-- wording end here -->

                    <!-- detail start here -->
                    <div class="col-lg-12">

                        <!-- detail item #1 start here -->
                        <div class="media">
                            <img src="<?php echo base_url('themes/akana/assets/img/event.svg'); ?>" class="mr-3 img-fluid align-self-center" alt="detail icon">
                            <div class="media-body">
                                <h5>
                                <?php echo $product->prod_duration_day; ?> days <?php echo $product->prod_duration_night; ?> nights
                                </h5>
                            </div>
                        </div>
                        <!-- detail item #1 end here -->

                        <!-- detail item #1 start here -->
                        <div class="media mt-2">
                            <img src="<?php echo base_url('themes/akana/assets/img/placeholder.svg'); ?>" class="mr-3 img-fluid align-self-center" alt="detail icon">
                            <div class="media-body">
                                <h5>
                                <?php echo $product->prod_location; ?>
                                </h5>
                            </div>
                        </div>
                        <!-- detail item #1 end here -->

                        <a href="#" class="btn btn-outline-success mt-4 btn--primary" style="letter-spacing:2px;">book now</a>

                    </div>
                    <!-- detail end here -->

                </div>

            </div>
        </div>
    </div>
    <!-- package header end here -->

    <!-- what to do start here -->
    <div class="container-fluid c-pkg-detail-todo d-flex justify-content-center align-items-center">
        <div class="container ">
            <div class="row no-gutters">

                <!-- content kiri start here -->
                <div class="col-lg-5">
                    <h1>what to do</h1>
                    <?php echo $product->prod_todo_desc; ?>
                </div>
                <!-- content kiri start here -->

                <!-- content kanan start here -->
                <div class="col-lg-7">

                    <!-- Carousel start here -->
                    <div class="c-product-carousel swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">

                            <!-- Slides -->
                            <div class="swiper-slide">
                                <!--carousel card #1 start here-->
                                <div class="col">
                                    <div class="card c-card-img">
                                        <img src="<?php echo base_url('themes/akana/assets/img/bromo2.jpg'); ?>" class="card-img-top" alt="card image" style="z-index:0;">
                                    </div>
                                </div>
                                <!-- carousel card #1 end here-->
                            </div>

                            <div class="swiper-slide">
                                <!--carousel card #1 start here-->
                                <div class="col">
                                    <div class="card c-card-img">
                                        <img src="<?php echo base_url('themes/akana/assets/img/bromo3.jpg'); ?>" class="card-img-top" alt="card image" style="z-index:0;">
                                    </div>
                                </div>
                                <!-- carousel card #1 end here-->
                            </div>

                            <div class="swiper-slide">
                                <!--carousel card #1 start here-->
                                <div class="col">
                                    <div class="card c-card-img">
                                        <img src="<?php echo base_url('themes/akana/assets/img/bromo2.jpg'); ?>" class="card-img-top" alt="card image" style="z-index:0;">
                                    </div>
                                </div>
                                <!-- carousel card #1 end here-->
                            </div>

                            <div class="swiper-slide">
                                <!--carousel card #1 start here-->
                                <div class="col">
                                    <div class="card c-card-img">
                                        <img src="./assets/img/bromo3.jpg" class="card-img-top" alt="card image" style="z-index:0;">
                                    </div>
                                </div>
                                <!-- carousel card #1 end here-->
                            </div>

                            <div class="swiper-slide">
                                <!--carousel card #1 start here-->
                                <div class="col">
                                    <div class="card c-card-img">
                                        <img src="./assets/img/bromo2.jpg" class="card-img-top" alt="card image" style="z-index:0;">
                                    </div>
                                </div>
                                <!-- carousel card #1 end here-->
                            </div>

                        </div>
                    </div>
                    <!-- Carousel end here -->

                </div>
                <!-- content kanan end here -->

            </div>
        </div>
    </div>
    <!-- what to do end here -->

    <!-- tour highlight start here -->
    <div class="container-fluid c-pkg-detail-highlight">
        <div class="row no-gutters">

            <!-- tour highlight #1 start here -->
            <div class="col-lg-3 col-6">
                <div class="card text-white">
                    <img src="<?php echo base_url('themes/akana/assets/img/bromo2.jpg') ;?>" class="card-img" alt="recent works image">
                    <div class="overlay card-img-overlay text-left">
                        <div class="c-content">
                            <h5 class="card-title">Tour highlight #1</h5>
                            <a href="#" class="btn btn-link stretched-link">lihat detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tour highlight #1 end here -->

            <!-- tour highlight #2 start here -->
            <div class="col-lg-3 col-6">
                <div class="card text-white">
                    <img src="<?php echo base_url('themes/akana/assets/img/bromo3.jpg'); ?>" class="card-img" alt="recent works image">
                    <div class="overlay card-img-overlay text-left">
                        <div class="c-content">
                            <h5 class="card-title">Tour highlight #2</h5>
                            <a href="#" class="btn btn-link stretched-link">lihat detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tour highlight #2 end here -->

            <!-- tour highlight #3 start here -->
            <div class="col-lg-3 col-6">
                <div class="card text-white">
                    <img src="<?php echo base_url('themes/akana/assets/img/bromo2.jpg'); ?>" class="card-img" alt="recent works image">
                    <div class="overlay card-img-overlay text-left">
                        <div class="c-content">
                            <h5 class="card-title">Tour highlight #3</h5>
                            <a href="#" class="btn btn-link stretched-link">lihat detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tour highlight #3 end here -->

            <!-- tour highlight #4 start here -->
            <div class="col-lg-3 col-6">
                <div class="card text-white">
                    <img src="<?php echo base_url('themes/akana/assets/img/bromo3.jpg'); ?>" class="card-img" alt="recent works image">
                    <div class="overlay card-img-overlay text-left">
                        <div class="c-content">
                            <h5 class="card-title">Tour highlight #4</h5>
                            <a href="#" class="btn btn-link stretched-link">lihat detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tour highlight #4 end here -->

        </div>
    </div>
    <!-- tour highlight end here -->

    <!-- tour timeline start here -->
    <div class="container c-pkg-detail-timeline mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4>Tour timeline</h4>
                <ul class="timeline">
                <?php
                    if(isset($product_tml) && $product_tml != null) {
                        foreach($product_tml as $key => $value) {
                            echo '<li><a href="#">';
                            echo $value->tml_title;
                            echo '</a> <a href="#" class="float-right">';
                            echo $value->tml_day;
                            echo '</a><p>';
                            echo $value->tml_desc;
                            echo '</p></li>';
                        }
                    } else {
                        echo '<li> <a href="#"> Belum Ada Data </a> </li>';
                    }
                ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- tour timeline end here -->

    <!-- tour detail start here -->
    <div class="container-fluid c-pkg-detail-tour">
        <div class="c-pkg-detail-tour-content">
            <div class="container">
                <div class="row no-gutters">

                    <!-- content atas start here -->
                    <div class="col-lg-12 c-title text-center">
                        <h5>
                            this tour includes
                        </h5>
                    </div>
                    <?php

                        if(isset($product_include) && $product_include != null) {
                            foreach($product_include as $key => $value) {
                                echo '<div class="col-lg-4 mt-4 d-flex justify-content-left">';
                                echo '<div class="media">';
                                echo '<img src="' . base_url('themes/akana/assets/img/fireworks.svg') . '" class="mr-3 img-fluid" alt="...">';
                                echo '<div class="media-body"><p class="mt-0">';
                                echo $value->icl_desc;
                                echo '</p> </div> </div> </div>';
                            }
                        } else {
                                echo '<div class="col-lg-12 c-title text-center">';
                                echo '<p>Belum ada data</p> </div>';
                        }
                    ?>
                    <!-- content atas end here -->

                    <!-- content bawah start here -->
                    <div class="col-lg-12 c-title mt-5 text-center">
                        <h5>
                            this tour excludes
                        </h5>
                    </div>

                    <?php
                        if(isset($product_exclude) && $product_exclude != null) {
                            foreach($product_exclude as $key => $value) {
                                echo '<div class="col-lg-4 mt-4 d-flex justify-content-left">';
                                echo '<div class="media">';
                                echo '<img src="' . base_url('themes/akana/assets/img/fireworks.svg') . '" class="mr-3 img-fluid" alt="...">';
                                echo '<div class="media-body"><p class="mt-0">';
                                echo $value->ecl_desc;
                                echo '</p> </div> </div> </div>';
                            }
                        } else {
                                echo '<div class="col-lg-12 c-title text-center">';
                                echo '<p>Belum ada data</p> </div>';
                        }
                    ?>
                    <!-- content bawah end here -->

                </div>
            </div>
        </div>
    </div>
    <!-- tour detail end here -->

    <!-- our recomendation start here -->
    <div class="container-fluid c-pkg-list-recomendation">
        <div class="container">

            <!-- wording start here -->
            <div class="wording">
                <h2>
                    Similiar packages
                </h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis quos ratione facere amet, nihil, minus tempore illo odit ea, nostrum impedit doloribus reiciendis non autem maxime necessitatibus exercitationem culpa nobis.
                </p>
            </div>
            <!-- wording end here -->

            <!-- Carousel start here -->
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <!--carousel card #1 start here-->
                        <div class="col">
                            <div class="card c-card-product">
                                <img src="<?php echo $theme_assets . 'img/dest--2.jpg'; ?>" class="card-img-top" alt="card image">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Borobudur trip 1
                                    </h5>
                                    <p class="card-text text-capitalize">
                                        <span class="c-card-date mt-2 mb-2">
                                            <i class="far fa-calendar-alt pr-2"></i>
                                            3 Days 2 Night
                                        </span>
                                        <span class="c-card-dest">
                                            <i class="fas fa-map-marker-alt pr-2"></i>
                                            yogyakarta - magelang
                                        </span>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-block btn--primary">
                                        packages detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- carousel card #1 end here-->
                    </div>
                    <div class="swiper-slide">
                        <!--carousel card #1 start here-->
                        <div class="col">
                            <div class="card c-card-product">
                                <img src="<?php echo $theme_assets . 'img/dest--2.jpg'; ?>" class="card-img-top" alt="card image">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Borobudur trip 2
                                    </h5>
                                    <p class="card-text text-capitalize">
                                        <span class="c-card-date mt-2 mb-2">
                                            <i class="far fa-calendar-alt pr-2"></i>
                                            3 Days 2 Night
                                        </span>
                                        <span class="c-card-dest">
                                            <i class="fas fa-map-marker-alt pr-2"></i>
                                            yogyakarta - magelang
                                        </span>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-block btn--primary">
                                        packages detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- carousel card #1 end here-->
                    </div>
                    <div class="swiper-slide">
                        <!--carousel card #1 start here-->
                        <div class="col">
                            <div class="card c-card-product">
                                <img src="<?php echo $theme_assets . 'img/dest--2.jpg'; ?>" class="card-img-top" alt="card image">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Borobudur trip 3
                                    </h5>
                                    <p class="card-text text-capitalize">
                                        <span class="c-card-date mt-2 mb-2">
                                            <i class="far fa-calendar-alt pr-2"></i>
                                            3 Days 2 Night
                                        </span>
                                        <span class="c-card-dest">
                                            <i class="fas fa-map-marker-alt pr-2"></i>
                                            yogyakarta - magelang
                                        </span>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-block btn--primary">
                                        packages detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- carousel card #1 end here-->
                    </div>
                    <div class="swiper-slide">
                        <!--carousel card #1 start here-->
                        <div class="col">
                            <div class="card c-card-product">
                                <img src="<?php echo $theme_assets . 'img/dest--2.jpg'; ?>" class="card-img-top" alt="card image">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Borobudur trip 4
                                    </h5>
                                    <p class="card-text text-capitalize">
                                        <span class="c-card-date mt-2 mb-2">
                                            <i class="far fa-calendar-alt pr-2"></i>
                                            3 Days 2 Night
                                        </span>
                                        <span class="c-card-dest">
                                            <i class="fas fa-map-marker-alt pr-2"></i>
                                            yogyakarta - magelang
                                        </span>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-block btn--primary">
                                        packages detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- carousel card #1 end here-->
                    </div>
                    <div class="swiper-slide">
                        <!--carousel card #1 start here-->
                        <div class="col">
                            <div class="card c-card-product">
                                <img src="<?php echo $theme_assets . 'img/dest--2.jpg'; ?>" class="card-img-top" alt="card image">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Borobudur trip 5
                                    </h5>
                                    <p class="card-text text-capitalize">
                                        <span class="c-card-date mt-2 mb-2">
                                            <i class="far fa-calendar-alt pr-2"></i>
                                            3 Days 2 Night
                                        </span>
                                        <span class="c-card-dest">
                                            <i class="fas fa-map-marker-alt pr-2"></i>
                                            yogyakarta - magelang
                                        </span>
                                    </p>
                                    <a href="#" class="btn btn-primary btn-block btn--primary">
                                        packages detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- carousel card #1 end here-->
                    </div>
                </div>
            </div>
            <!-- Carousel end here -->

        </div>
    </div>
    <!-- our recomendation end here -->