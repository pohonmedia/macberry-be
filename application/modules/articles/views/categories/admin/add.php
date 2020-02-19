<!-- Toolbars -->
<h2 class="section-title">Add New Category</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Articles</a>
        <a class="btn btn-sm btn-info" style="margin-right: 5px;" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Categories&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
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
                <div class="form-group">
                    <label for="ct_name" class="control-label">Category Name</label>
                    <?php echo form_input($ct_name); ?>
                </div>
                <div class="form-group">
                    <label for="ct_parent" class="control-label">Parent</label>
                    <?php echo form_dropdown('ct_parent', $parent_data, '0', $ct_parent); ?>
                </div>
                <div class="form-group">
                    <label for="ct_desc" class="control-label">Description</label>
                    <?php echo form_textarea($ct_desc); ?>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create</button>
                <a class="btn btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->