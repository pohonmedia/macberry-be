<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $template['title']; ?></title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo $theme_assets . 'css/bootstrap.min.css'; ?>">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $theme_assets . 'css/default.css'; ?>">
        <link rel="stylesheet" href="<?php echo $theme_assets . 'fonts/css/font-awesome.min.css'; ?>" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php echo $template['partials']['header']; ?>

        <!-- Sliders -->
        <?php
        $sliders = Modules::run('sliders/controller/list_all');
        if ($this->uri->uri_string() == "" && !empty($sliders)) {
            ?>
            <!-- Header Carousel -->
            <header id="main-slider" class="carousel slide">
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

                <!-- Controls -->
                <a class="left carousel-control" href="#main-slider" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#main-slider" data-slide="next">
                    <span class="icon-next"></span>
                </a>
            </header>
        <?php } ?>
        <div class="container">
            <div class="row">
                <?php
                if (!empty($template['partials']['left_sidebar'])) {
                    echo '<div class="col-md-3">';
                    echo $template['partials']['left_sidebar'];
                    echo '</div>';
                    echo '<div class="col-md-8">';
                } else {
                    echo '<div class="col-md-12">';
                }
                echo $template['body'];
                echo'</div>';
                ?>
            </div>
            <?php echo $template['partials']['footer']; ?>
            <script src="<?php echo $theme_assets . 'js/jQuery-2.1.4.min.js'; ?>"></script>
            <script src="<?php echo $theme_assets . 'js/bootstrap.min.js'; ?>"></script>
    </body>
</html>