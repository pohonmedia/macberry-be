<?php
//    $sliders = Modules::run('sliders/controller/list_all');
?>
<!-- Header Carousel -->
<section id="main-slider" class="no-margin">
    <div class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            for ($i = 0; $i < count($sliders); $i++) {
                if ($i == 0) {
                    echo '<li data-target="#main-slider" data-slide-to="' . $i . '" class="active"></li>';
                } else {
                    echo '<li data-target="#main-slider" data-slide-to="' . $i . '"></li>';
                }
            }
            ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            foreach ($sliders as $key => $value) {
                if ($key == 0) {
                    echo '<div class="item active" style="background-image: url(' . $value->sld_url . ')">';
                } else {
                    echo '<div class="item" style="background-image: url(' . $value->sld_url . ')">';
                }
                echo '<div class="container">';
                echo '<div class="row slide-margin">';
                echo '<div class="col-sm-6">';
                echo '<div class="carousel-content">';
                echo '<h1 class="animation animated-item-1">' . $value->sld_text1 . '</h1>';
                echo '<h2 class="animation animated-item-2">' . $value->sld_text2 . '</h2>';
                echo '<a class="btn-slide animation animated-item-3" href="#">Read More</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <!-- Controls -->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</section>
