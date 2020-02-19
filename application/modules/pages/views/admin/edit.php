<h2 class="section-title">Edit Selected Page</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" style="margin-right: 5px;" href="<?php echo base_url('admin/pages'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;All Pages&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
    </div>
</div>
</br>
<!-- Main content -->
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open(uri_string()); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="hal_title" class="control-label">Title</label>
                        <?php echo form_input($hal_title); ?>
                    </div>
                    <div class="form-group">
                        <label for="hal_desc" class="control-label">Deskripsi</label>
                        <?php echo form_textarea($hal_desc); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="hal_meta_desc" class="control-label">Meta Description</label>
                        <?php echo form_textarea($hal_meta_desc); ?>
                    </div>
                    <div class="form-group">
                        <label for="hal_meta_key" class="control-label">Meta Keywords</label>
                        <?php echo form_textarea($hal_meta_key); ?>
                    </div>
                    <div class="form-group">
                        <label for="hal_meta_author" class="control-label">Meta Author</label>
                        <?php echo form_input($hal_meta_author); ?>
                    </div>
                </div>
            </div>
            </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                <a class="btn btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/pages'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->