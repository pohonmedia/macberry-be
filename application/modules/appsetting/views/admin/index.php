<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/appsetting'); ?>"><i class="fa fa-gear"></i>&nbsp;&nbsp;General</a>
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/appsetting/profile'); ?>"><i class="fa fa-user-secret"></i>&nbsp;&nbsp;Profile</a>
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/appsetting/favicon'); ?>"><i class="fa fa-globe"></i>&nbsp;&nbsp;Favicon</a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">General Settings</h3>
        </div>
        <div class="box-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="art_title" class="col-sm-2 control-label">Nama Website</label>
                        <div class="col-sm-6"><?php echo form_input($website_name); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="art_cat_id" class="col-sm-2 control-label">Theme</label>
                        <div class="col-sm-6"><?php echo form_dropdown('theme_name', $themes, '0', $theme_name); ?></div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="box-tools">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </div><!-- /.box -->
</section><!-- /.content -->