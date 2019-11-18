<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $template['title']; ?></title>

        <!-- core CSS -->
        <link href="<?php echo $theme_assets . 'dist/css/bootstrap.min.css'; ?>" rel="stylesheet">
        <link href="<?php echo $theme_assets . 'dist/css/font-awesome.min.css'; ?>" rel="stylesheet">
        <link href="<?php echo $theme_assets . 'data/css/ie10-viewport-bug-workaround.css'; ?>" rel="stylesheet">
        <link href="<?php echo $theme_assets . 'css/kapalsurabaya.css'; ?>" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head><!--/head-->

    <body>

        <?php echo $template['partials']['header']; ?>

        <!-- <div class="container"> -->
            <?php
            if (is_homepage()) {
                if (!empty($template['partials']['sliders'])) {
                    echo $template['partials']['sliders'];
                }
                echo '<div class="row">';
                if (!empty($template['partials']['left_sidebar'])) {
                    echo $template['partials']['left_sidebar'];
                }
                echo $template['body'];
//                if (!empty($template['partials']['featured'])) {
//                    echo $template['partials']['featured'];
//                }
                if (!empty($template['partials']['right_sidebar'])) {
                    echo $template['partials']['right_sidebar'];
                }
                echo '</div>';
            } else {
                echo '<div class="row">';
                echo $this->breadcrumbs->show();
                echo '</div>';
                echo '<div class="clearfix"></div>';
                echo '<div class="row">';
                if (!empty($template['partials']['left_sidebar'])) {
                    echo $template['partials']['left_sidebar'];
                }
                echo $template['body'];
                if (!empty($template['partials']['right_sidebar'])) {
                    echo $template['partials']['right_sidebar'];
                }
                echo '</div>';
            }
            ?>
        <!-- </div> -->
        <?php echo $template['partials']['footer']; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>');</script>-->
        <script>window.jQuery || document.write('<script src="<?php echo $theme_assets . 'data/js/vendor/jquery.min.js'; ?>"><\/script>');</script>
        <script src="<?php echo $theme_assets . 'dist/js/bootstrap.min.js'; ?>"></script>

        <script src="<?php echo $theme_assets . 'dist/ckeditor/ckeditor.js'; ?>"></script>
        <script src="<?php echo $theme_assets . 'dist/chained.min.js'; ?>"></script>
        <script src="<?php echo $theme_assets . 'dist/custom.js'; ?>"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="<?php echo $theme_assets . 'data/js/vendor/holder.min.js'; ?>"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo $theme_assets . 'data/js/ie10-viewport-bug-workaround.js'; ?>"></script>
    </body>
</html>