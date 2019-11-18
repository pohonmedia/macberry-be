<div class="page-title">                    
    <h2><span class="fa fa-plus-square"></span> Add New Menu</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/menus'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;All Menus</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string()); ?>
                    <div class="form-group">
                        <label for="menu_name" class="control-label">Menu Title</label>
                        <?php echo form_input($menu_name); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu_parent_id" class="control-label">Parent</label>
                        <?php echo form_dropdown('menu_parent_id', $parent_data, '0', $menu_parent_id); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu_type" class="control-label">Menu Type</label>
                        <?php echo form_dropdown('menu_type', $type_data, '0', $menu_type); ?>
                    </div>
                    <div id="pages-select">
                        <div class="form-group">
                            <a class="btn btn-sm btn-flat btn-default" onclick="return showSelectPages()"><i class="fa fa-copy"></i> Select Pages</a>
                        </div>
                    </div>
                    <div id="article-select" class="hidden">
                        <div class="form-group">
                            <label for="article_type" class="control-label">Article Type</label>
                            <div class="radio" id="typeArticleSelect">
                                <label>
                                    <input type="radio" name="article_type" value="1" checked>List All Article
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="article_type" value="2">List Article Category
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="article_type" value="3">List Article by Category
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-sm btn-flat btn-default" onclick="return showArticleCategory()" id="btnSelectArticleCat"><i class="fa fa-folder"></i> Select Category</a>
                            </div>
                        </div>
                    </div>
                    <div id="catalog-select" class="hidden">
                        <div class="form-group">
                            <label for="catalog_type" class="control-label">Catalog Type</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="catalog_type" value="1" checked>List All Catalog
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="catalog_type" value="2">List Catalog Category
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="catalog_type" value="3">List Catalog by Category
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-sm btn-flat btn-default" onclick="return showCatalogCategory()" id="btnSelectCatalogCat"><i class="fa fa-folder"></i> Select Category</a>
                            </div>
                        </div>
                    </div>
                    <div id="link-select">
                        <div class="form-group">
                            <label for="menu_url" class="control-label">Menu URL</label>
                            <?php echo form_input($menu_url); ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Create</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/menus'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> <!--/.box-footer-->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div class="modal-body" id="modalContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm btn-simple" onclick="return closeModal()">Save</button>
            </div>
        </div>
    </div>
</div>