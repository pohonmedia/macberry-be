<!-- Toolbars -->
<h2 class="section-title">Add New Article</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info btn-flat" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Articles&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
        <a class="btn btn-sm btn-info btn-flat" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-folder"></i>&nbsp;&nbsp;Categories</a>
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
            <?php echo form_open_multipart(uri_string()); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="art_title" class="control-label">Title</label>
                        <?php echo form_input($art_title); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_cat_id" class="control-label">Category</label>
                        <?php echo form_dropdown('art_cat_id', $cat_data, '0', $art_cat_id); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_content" class="control-label">Content</label>
                        <?php echo form_textarea($art_content); ?>
                        <?php // echo $this->ckeditor->editor("art_content", $art_content_value); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_img" class="control-label">Intro Image</label>
                        <?php echo form_upload($art_img); ?>
                        <p class="help-block"><small>Image Format : *.png, *.jpg, *.jpeg, *.gif</small></p>
                    </div>
                    <div class="form-group">
                        <label for="art_img_caption" class="control-label">Image Caption</label>
                        <?php echo form_input($art_img_caption); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_img_source" class="control-label">Image Source</label>
                        <?php echo form_input($art_img_source); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="art_is_publish" class="control-label">Publish Status</label>
                        <?php echo form_dropdown('art_is_publish', $publish_data, '0', $art_is_publish); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_is_feature" class="control-label d-block">Featured</label>
                        <div class="radio form-check-inline">
                            <input class="form-check-input" type="radio" name="art_is_feature" value="1">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="radio form-check-inline">
                            <input class="form-check-input" type="radio" name="art_is_feature" value="2" checked>
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="art_tags" class="control-label">Tags</label>
                        <?php echo form_input($art_tags); ?>
                        <p class="help-block"><small>Separated by commas (,)</small></p>
                    </div>
                    <div class="form-group">
                        <label for="art_meta_desc" class="control-label">Meta Description</label>
                        <?php echo form_textarea($art_meta_desc); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_meta_keywords" class="control-label">Meta Keywords</label>
                        <?php echo form_textarea($art_meta_keywords); ?>
                    </div>
                </div>
            </div>
            </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create</button>
                <a class="btn btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->