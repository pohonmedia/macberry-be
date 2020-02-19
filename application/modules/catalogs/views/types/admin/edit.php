<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Catalogs</a>
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs/types'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Types&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo $count_data; ?></span></a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Selected Type</h3>
        </div>
        <div class="box-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open(uri_string()); ?>
            <div class="form-group">
                <label for="type_name" class="control-label">Type Name</label>
                <?php echo form_input($type_name); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/catalogs/types'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->