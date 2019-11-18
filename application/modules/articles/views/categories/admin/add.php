<div class="page-title">                    
    <h2><span class="fa fa-plus-square"></span> Add New Category</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Articles</a>
                    <a class="btn btn-sm btn-default btn-flat" style="margin-right: 5px;" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Categories</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string()); ?>
                    <div class="row">
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
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Create</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> <!--/.box-footer-->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>