<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Extra metadata -->
        <?php // echo $metadata; ?>
        <!-- / -->

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?php echo $template['title']; ?></title>
        <!--<meta name="description" content="<?php // echo $description;   ?>">-->
        <!-- Tell the browser to be responsive to screen width -->

        <!-- Bootstrap core CSS  and Font Awesome-->
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo $admin_assets . 'css/summernote-bs4.css'; ?>">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $admin_assets . 'css/style.css'; ?>">
        <link rel="stylesheet" href="<?php echo $admin_assets . 'css/components.css'; ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
    </head>
    <body<?php echo!empty($body_class) ? $body_class : ""; ?>>
        <div id="app">
            <div class="main-wrapper">
                <?php echo $template['partials']['header']; ?>
                <?php echo $template['partials']['sidebar']; ?>
                <div class="main-content">
                    <section class="section">
                        <!-- Content Header (Page header) -->
                        <section class="section-header">
                            <?php
                                if(!empty($back_url)) {
                                    echo '<div class="section-header-back">';
                                    echo '<a href="' . base_url($back_url) . '" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>';
                                    echo '</div>';
                                }
                            ?>
                            <h1>
                                <?php 
                                    $string = str_replace($this->config->item('website_name'). ' | ', '', $template['title']);
                                    echo $string; 
                                ?>
                                <span class="small"><?php echo !empty($page_desc) ? $page_desc : "" ;?></span>
                            </h1>
                            <?php echo $this->breadcrumbs->show(); ?>
                        </section>
                        <section class="section-body">
                            <?php echo $template['body']; ?>
                        </section>
                    </section>
                </div>
                <?php echo $template['partials']['footer']; ?>
            </div>
        </div>
            
        <script>
            var BASE_URL = '<?php echo base_url(); ?>';
            var ENV = '<?php ENVIRONMENT; ?>';
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="<?php echo $admin_assets . 'js/summernote-bs4.min.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/ckeditor/ckeditor.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/ckfinder/ckfinder.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/stisla.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/jquery.chained.min.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/scripts.js'; ?>"></script>
        <script src="<?php echo $admin_assets . 'js/custom.js'; ?>"></script>
        

        <!-- Modal -->
        <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalTitle"></h4>
                    </div>
                    <div class="modal-body" id="modalContent">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-sm btn-simple" onclick="return closeModal()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>