<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Catalogs</a>
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs/categories'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Categories&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo $count_data; ?></span></a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Selected Category</h3>
        </div>
        <div class="box-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open(uri_string()); ?>
            <div class="form-group">
                <label for="ct_name" class="control-label">Category Name</label>
                <?php echo form_input($ct_name); ?>
            </div>
            <div class="form-group">
                <label for="ct_parent" class="control-label">Parent</label>
                <?php echo form_dropdown('ct_parent', $parent_data, $ct_parent_val, $ct_parent); ?>
            </div>
            <div class="form-group">
                <label for="ct_desc" class="control-label">Description</label>
                <?php echo form_textarea($ct_desc); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/catalogs/categories'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->