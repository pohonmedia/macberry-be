<div class="page-title">                    
    <h2><span class="fa fa-gears"></span> General Settings</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">                                
                <div class="panel-body">
                    <div class="row">
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/appsetting'); ?>"><i class="fa fa-gear"></i>&nbsp;&nbsp;General</a>
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/appsetting/profile'); ?>"><i class="fa fa-lock"></i>&nbsp;&nbsp;Profile</a>
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/appsetting/favicon'); ?>"><i class="fa fa-globe"></i>&nbsp;&nbsp;Favicon</a>
                    </div>
                    <br />

                    <div class="box-body table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                        <h1>General Setting Form</h1>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <?php
                        if (!empty($template['partials']['pagination'])) {
                            echo $template['partials']['pagination'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>