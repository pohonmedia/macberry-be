<!-- Header Carousel -->
<div id="main-slider" class="carousel slide" data-ride="carousel">
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
    <div class="carousel-inner" role="listbox">
        <?php
            if(!empty($sliders)) {
                foreach ($sliders as $key => $value) {
                    if ($key == 0) {
                        echo '<div class="item active">';
                    } else {
                        echo '<div class="item">';
                    }
        //            if ($key == 0) {
        //                echo '<div class="item active" style="background-image: url(' . $value->sld_url . ')">';
        //            } else {
        //                echo '<div class="item" style="background-image: url(' . $value->sld_url . ')">';
        //            }
                    echo '<img class="img-responsive" src="'.  base_url($value->sld_url).'" data-src="holder.js/815x330/auto/#999:#666/text:Slider 01" alt="Generic placeholder image">';
        //            echo '<h1 class="animation animated-item-1">' . $value->sld_text1 . '</h1>';
                    echo '</div>';
                }
            }
        ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#main-slider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>