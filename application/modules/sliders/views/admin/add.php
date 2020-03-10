<!-- Toolbars -->
<h2 class="section-title">Add New Slide</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/sliders'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Sliders&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
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
                <label for="sld_link_cat" class="control-label">Link Type</label>
                <?php echo form_dropdown('sld_link_cat', $type_data, '0', $menu_type); ?>
            </div>
            <div class="form-group" id="pages-select">
                <a href="#" class="btn btn-sm btn-info" onclick="return showSelectPages()"><i class="fa fa-copy"></i> Select Pages</a>
            </div>
            <div id="article-select" class="d-none">
                <div class="form-group">
                    <label for="article_type" class="control-label d-block">Article Type</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="article_type" value="1" checked>
                        <label class="form-check-label">List All Article </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="article_type" value="2">
                        <label class="form-check-label">List Article Category </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="article_type" value="3">
                        <label class="form-check-label">List Article by Category </label>
                    </div>
                    <a href="#" class="btn btn-sm btn-info" onclick="return showArticleCategory()" id="btnSelectArticleCat"><i class="fa fa-folder"></i> Select Category</a>
                </div>
            </div>
            <div id="catalog-select" class="d-none">
                <div class="form-group">
                    <label for="catalog_type" class="control-label d-block">Catalog Type</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="catalog_type" value="1" checked>
                        <label class="form-check-label"> List All Catalog </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="catalog_type" value="2">
                        <label class="form-check-label"> List Catalog Category </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="catalog_type" value="3">
                        <label class="form-check-label"> List Catalog by Category </label>
                    </div>
                    <a href="#" class="btn btn-sm btn-info" onclick="return showCatalogCategory()" id="btnSelectCatalogCat"><i class="fa fa-folder"></i> Select Category</a>
                </div>
            </div>
            <div id="link-select">
                <div class="form-group">
                    <label for="sld_link" class="control-label">Slide Button Link</label>
                    <?php echo form_input($sld_link); ?>
                </div>
            </div>
            <!-- <div class="form-group">
                <label for="sld_link" class="control-label">Slide Button Link</label>
                <?php //echo form_input($sld_link); ?>
            </div> -->
            </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Create</button>
                <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/sliders'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->