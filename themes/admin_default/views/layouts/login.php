<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $template['title']; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- favicon.ico and apple-touch-icon.png -->

        <link rel="stylesheet" href="<?php echo $admin_assets . 'css/theme-blue.css'; ?>">

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
    </body>
</html>