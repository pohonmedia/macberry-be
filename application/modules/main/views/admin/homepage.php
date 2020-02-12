<!-- Main content -->
    <!-- Default box -->
    <h2 class="section-title">Setting Section 1 (Tour Packages)</h2>
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
    <?php echo form_open_multipart(uri_string()); ?>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_img" class="control-label">Background Image</label>
                            <?php echo form_upload($img_section1); ?>
                            <p class="help-block"><small>Image Format : *.png, *.jpg, *.jpeg</small></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Desc</label>
                            <?php echo form_textarea($desc_section1); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Button URL</label>
                            <?php echo form_input($link_section1); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <h2 class="section-title">Setting Section 2 (Our Destination)</h2>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_img" class="control-label">Background Image</label>
                            <?php echo form_upload($img_section2); ?>
                            <p class="help-block"><small>Image Format : *.png, *.jpg, *.jpeg</small></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Desc</label>
                            <?php echo form_textarea($desc_section2); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Button URL</label>
                            <?php echo form_input($link_section2); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="section-title">Setting Section 3 (Mice Packages)</h2>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_img" class="control-label">Background Image</label>
                            <?php echo form_upload($img_section3); ?>
                            <p class="help-block"><small>Image Format : *.png, *.jpg, *.jpeg</small></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Desc</label>
                            <?php echo form_textarea($desc_section3); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Button URL</label>
                            <?php echo form_input($link_section3); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <h2 class="section-title">Setting Section 4 (Recent Works)</h2>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_img" class="control-label">Background Image</label>
                            <?php echo form_upload($img_section4); ?>
                            <p class="help-block"><small>Image Format : *.png, *.jpg, *.jpeg</small></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Desc</label>
                            <?php echo form_textarea($desc_section4); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords" class="control-label">Section Button URL</label>
                            <?php echo form_input($link_section4); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a class="btn btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/catalogs'); ?>"><i class="fa fa-undo"></i> Batal</a>
                </div>
            </div>
        </div>
    </div> <!--/.box-footer-->
    <?php echo form_close(); ?>
    </div><!-- /.box -->
