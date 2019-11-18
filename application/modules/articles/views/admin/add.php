<div class="page-title">                    
    <h2><span class="fa fa-plus-square"></span> Add New Article</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Articles</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-folder"></i>&nbsp;&nbsp;Categories</a>
                </div>
                <div class="panel-body">
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
                                <label for="art_is_feature" class="control-label">Featured</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="art_is_feature" value="1">Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="art_is_feature" value="2" checked>No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="art_style" class="control-label">Custom CSS</label>
                                <?php echo form_input($art_style); ?>
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
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Create</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> <!--/.box-footer-->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>