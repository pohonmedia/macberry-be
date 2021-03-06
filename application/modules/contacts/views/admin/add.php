<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/sliders'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Sliders&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo $count_data; ?></span></a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Slide</h3>
        </div>
        <div class="box-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open_multipart(uri_string()); ?>
            <div class="form-group">
                <label for="sld_title" class="control-label">Title</label>
                <?php echo form_input($sld_title); ?>
            </div>
            <div class="form-group">
                <label for="sld_url" class="control-label">Image</label>
                <?php echo form_upload($sld_url); ?>
                <p class="help-block"><small>Image Format : *.png, *.jpg, *.jpeg, *.gif</small></p>
            </div>
            <div class="form-group">
                <label for="sld_text1" class="control-label">Slide Text 1</label>
                <?php echo form_input($sld_text1); ?>
            </div>
            <div class="form-group">
                <label for="sld_text2" class="control-label">Slide Text 2</label>
                <?php echo form_input($sld_text2); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Create</button>
                <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/sliders'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->