<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php echo $template['title']; ?></title>

        <meta name="generator" content="B2M Team" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Official B2M Website">
        <meta name="author" content="B2M Team">

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo $theme_assets . 'css/bootstrap.min.css'; ?>">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $theme_assets . 'fonts/css/font-awesome.min.css'; ?>" type="text/css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

        <!--Default CSS-->
        <link rel="stylesheet" href="<?php echo $theme_assets . 'css/default.css'; ?>">

        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico'); ?>">

    </head>
    <body>
        <?php echo $template['partials']['header']; ?>

        <!-- Sliders -->
        <?php
        if ($this->uri->uri_string() == "") {
            ?>
            <section class="container-fluid" id="count-page">
                <h1 class="text-center v-center big-h1">IDR. <span id="withdrawl-count">0</span>.00,-</h1>
                <h3 class="text-center">Withdrawal hari ini, dan terus bertambah.</h3>
                <br />
                <div class="container">
                    <div class="row text-center">
                        <a href="#form-gabung-home" class="btn btn-lg btn-danger"><b>GABUNG SEKARANG!</b></a>
                    </div><!--/row-->
                    <div class="row"><br></div>
                </div><!--/container-->
            </section>

            <?php echo $template['partials']['featured']; ?>

            <section class="container-fluid" id="form-gabung-home">
                <h1 class="text-center">Pendaftaran Peserta</h1>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <h3 class="text-center">Hubungi admin website,<br />atau gunakan form di bawah ini.</h3>
                        <p class="text-center">Masukkan data Anda dengan valid, Team kami akan segera menghubungi anda.</p>
                        <br />
                        <div class="row">
                            <form name="sentMessage" id="contactForm" novalidate>
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label>Phone Number</label>
                                        <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div id="success"></div>
                                <div class="row">
                                    <div class="form-group col-xs-12 text-center">
                                        <button type="submit" class="btn btn-warning btn-lg">Daftar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        <?php } else { ?>
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
            </div>
        <?php } ?>
        <?php echo $template['partials']['footer']; ?>
        <script src="<?php echo $theme_assets . 'js/jQuery-2.1.4.min.js'; ?>"></script>
        <script src="<?php echo $theme_assets . 'js/bootstrap.min.js'; ?>"></script>
        <!--other plugin-->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
        <script src="<?php echo $theme_assets . 'js/classie.js'; ?>"></script>
        <script src="<?php echo $theme_assets . 'js/animatedHeader.js'; ?>"></script>
        <script src="<?php echo $theme_assets . 'js/jquery.animateNumber.min.js'; ?>"></script>
        <!--morris chart-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

        <script src="<?php echo $theme_assets . 'js/scripts.js'; ?>"></script>
    </body>
</html>