<!-- Toolbars -->
<h2 class="section-title">Add New Product</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info btn-flat" href="<?php echo base_url('admin/catalogs'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Products&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
        <a class="btn btn-sm btn-info btn-flat" href="<?php echo base_url('admin/catalogs/categories'); ?>"><i class="fa fa-folder"></i>&nbsp;&nbsp;Categories</a>
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
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="prod_name" class="control-label">Product Name</label>
                        <?php echo form_input($prod_name); ?>
                    </div>
                    <div class="form-group">
                        <label for="prod_category" class="control-label">Category</label>
                        <?php echo form_dropdown('prod_category', $cat_data, '0', $prod_category); ?>
                    </div>
                    <div class="form-group">
                        <label for="prod_subcategory" class="control-label">Sub Category</label>
                        <?php echo form_dropdown('prod_subcategory', $subcat_data, '0', $prod_subcategory); ?>
                    </div>
                    <div class="form-group">
                        <label for="prod_desc" class="control-label">Content</label>
                        <?php echo form_textarea($prod_desc); ?>
                    </div>
                    <div class="form-group">
                        <label for="product_img" class="control-label">Product Image</label>
                        <?php echo form_upload($product_img); ?>
                        <p class="help-block"><small>Image Format : *.png, *.jpg, *.jpeg, *.gif</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="prod_price" class="control-label">Price</label>
                        <?php echo form_input($prod_price); ?>
                    </div>
                    <div class="form-group">
                        <label for="prod_stock" class="control-label">Stock</label>
                        <?php echo form_input($prod_stock); ?>
                    </div>
                    <div class="form-group">
                        <label for="prod_tags" class="control-label">Tags</label>
                        <?php echo form_input($prod_tags); ?>
                        <p class="help-block"><small>Separated by commas (,)</small></p>
                    </div>
                    <div class="form-group">
                        <label for="meta_desc" class="control-label">Meta Description</label>
                        <?php echo form_textarea($meta_desc); ?>
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords" class="control-label">Meta Keywords</label>
                        <?php echo form_textarea($meta_keywords); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <!--Spec-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="spec_processor" class="control-label">Processor</label>
                        <?php echo form_input($spec_processor); ?>
                    </div>
                    <div class="form-group">
                        <label for="spec_ram" class="control-label">Memory</label>
                        <?php echo form_input($spec_ram); ?>
                    </div>
                    <div class="form-group">
                        <label for="spec_storage" class="control-label">Storage</label>
                        <?php echo form_input($spec_storage); ?>
                    </div>
                    <div class="form-group">
                        <label for="spec_dimension" class="control-label">Screen</label>
                        <?php echo form_input($spec_dimension); ?>
                    </div>
                    <div class="form-group">
                        <label for="spec_color" class="control-label">Color</label>
                        <?php echo form_input($spec_color); ?>
                    </div>
                </div>
                <!--Desc-->
                <div class="col-md-6">
                <div class="form-group">
                        <label for="desc_screen" class="control-label">Screen Desc.</label>
                        <?php echo form_textarea($desc_screen); ?>
                    </div>
                    <div class="form-group">
                        <label for="desc_processor" class="control-label">Processor Desc.</label>
                        <?php echo form_textarea($desc_processor); ?>
                    </div>
                    <div class="form-group">
                        <label for="desc_storage" class="control-label">Storage Desc.</label>
                        <?php echo form_textarea($desc_storage); ?>
                    </div>
                    <div class="form-group">
                        <label for="desc_ram" class="control-label">Memory Desc.</label>
                        <?php echo form_textarea($desc_ram); ?>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Create</button>
            <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/catalogs'); ?>"><i class="fa fa-undo"></i> Batal</a>
        </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->