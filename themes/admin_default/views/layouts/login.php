<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?php echo $template['title']; ?></title>
        <!--<meta name="description" content="<?php // echo $description;   ?>">-->
        <!-- Tell the browser to be responsive to screen width -->
        <!-- favicon.ico and apple-touch-icon.png -->

        <!-- Bootstrap core CSS  and Font Awesome-->
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $admin_assets . 'css/bootstrap-social.css'; ?>">
        <link rel="stylesheet" href="<?php echo $admin_assets . 'css/style.css'; ?>">
        <link rel="stylesheet" href="<?php echo $admin_assets . 'css/components.css'; ?>">
        <!-- Ionicons -->
        <?php if (ENVIRONMENT == 'production') { ?>
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <?php } ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
    </head>
    <body<?php echo!empty($body_class) ? $body_class : ""; ?>>
        <?php echo $template['body']; ?>
        <!-- / -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <link rel="stylesheet" href="<?php echo $admin_assets . 'js/stisla.js'; ?>">
        <link rel="stylesheet" href="<?php echo $admin_assets . 'js/scripts.js'; ?>">
        <link rel="stylesheet" href="<?php echo $admin_assets . 'js/custom.js'; ?>">
    </body>
</html>