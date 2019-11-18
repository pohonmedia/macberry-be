<!DOCTYPE html>
<html lang="en">
    <!--<html>-->
    <head>
        <title><?php echo $template['title']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo $admin_assets . 'css/theme-blue.css'; ?>">
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo $admin_assets . 'css/tree-view.css'; ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
        <style>
            ul.error-msg-item {
                margin-left: 15px;
                padding-left: 0px;
            }
        </style>
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <?php echo $template['partials']['sidebar']; ?>
            <!-- PAGE CONTENT -->
            <div class="page-content">
                <?php echo $template['partials']['header']; ?>
                <!-- PAGE CONTENT WRAPPER -->
                <?php echo $template['body']; ?>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo $admin_assets . 'audio/alert.mp3'; ?>" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo $admin_assets . 'audio/fail.mp3'; ?>" preload="auto"></audio>
        <!-- END PRELOADS -->                  

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script src="<?php echo $admin_assets . 'js/plugins/jquery/jquery.min.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/plugins/jquery/jquery-ui.min.js'; ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-route.min.js"></script>
        <script src = "<?php echo $admin_assets . 'js/plugins/bootstrap/bootstrap.min.js'; ?>" ></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <!--<script src="<?php echo $admin_assets . 'js/plugins/icheck/icheck.min.js'; ?>"></script>-->
        <script src="<?php echo $admin_assets . 'js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/plugins/scrolltotop/scrolltopcontrol.js'; ?>"></script>
        <!--<script src="<?php echo $admin_assets . 'js/plugins/morris/raphael-min.js'; ?>"></script>-->
        <!--<script src="<?php echo $admin_assets . 'js/plugins/morris/morris.min.js'; ?>"></script>-->
        <!--<script src="<?php echo $admin_assets . 'js/plugins/rickshaw/d3.v3.js'; ?>"></script>-->
        <!--<script src="<?php echo $admin_assets . 'js/plugins/rickshaw/rickshaw.min.js'; ?>"></script>-->
        <!--<script src="<?php echo $admin_assets . 'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'; ?>"></script>-->
        <script src="<?php echo $admin_assets . 'js/plugins/bootstrap/bootstrap-select.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/plugins/bootstrap/bootstrap-datepicker.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/plugins/owl/owl.carousel.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $admin_assets . 'js/plugins/summernote/summernote.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/plugins/daterangepicker/daterangepicker.js'; ?>"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START DEFAULT TEMPLATE TEMPLATE -->
        <script type="text/javascript" src="<?php echo $admin_assets . 'js/settings.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $admin_assets . 'js/plugins.js'; ?>"></script>        
        <script type="text/javascript" src="<?php echo $admin_assets . 'js/actions.js'; ?>"></script>
        <!-- END TEMPLATE -->

        <?php if (!empty($module_js)) { ?>
            <script type="text/javascript" src="<?php echo $admin_assets . 'module/' . $module_js . '.js'; ?>"></script>
        <?php } ?>
        <!-- END SCRIPTS -->         
    </body>
</html>