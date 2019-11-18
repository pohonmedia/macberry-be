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
        <div class="container">
            <div class="row">
                <br />
                <br />
                <br />
                <h1>This is Plus Layout</h1>
                <?php
                echo '<div class="col-md-12">';
                echo $template['body'];
                echo'</div>';
                ?>
            </div>
            <?php echo $template['partials']['footer']; ?>
            <script src="<?php echo $theme_assets . 'js/jQuery-2.1.4.min.js'; ?>"></script>
            <script src="<?php echo $theme_assets . 'js/bootstrap.min.js'; ?>"></script>
    </body>
</html>