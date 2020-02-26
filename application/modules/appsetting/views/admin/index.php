<!-- Toolbars -->
<h2 class="section-title">General Settings</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/appsetting'); ?>"><i class="fa fa-cog"></i>&nbsp;&nbsp;General</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/appsetting/favicon'); ?>"><i class="fa fa-globe"></i>&nbsp;&nbsp;Favicon</a>
    </div>
</div>
</br>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open_multipart(uri_string()); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="art_title" class="control-label">Nama Website</label>
                        <?php echo form_input($website_name); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_cat_id" class="control-label">Theme</label>
                        <?php echo form_dropdown('theme_name', $themes, '0', $theme_name); ?>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
            </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->