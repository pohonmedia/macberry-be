<div class="page-title">                    
    <h2><span class="fa fa-dropbox"></span> List All Products</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs'); ?>">
                        <i class="fa fa-list"></i>&nbsp;&nbsp;Products&nbsp;&nbsp;&nbsp;</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Product</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs/categories'); ?>"><i class="fa fa-folder"></i>&nbsp;&nbsp;Categories</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs/types'); ?>"><i class="fa fa-copy"></i>&nbsp;&nbsp;Types</a>
                </div>
                <div class="panel-body">
                    <div>
                        <?php echo form_open(uri_string()); ?>
                        <div class="input-group">
                            <input type="text" name="products_search" class="form-control input-sm pull-right" placeholder="Search by Product Name">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-md btn-default btn-flat"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <?php
                        if (!empty($search)) {
                            ?>
                            <div class="input-group">
                                <p class="help-block">Search query : <strong>"<?php echo $search; ?>"</strong></p>
                            </div>
                        <?php } ?>
                        </form>
                    </div>
                    <br />

                    <div class="box-body table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                         <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="50">#</th>
                                    <th class="text-center" width="100"></th>
                                    <th width="250">Product Name </th>
                                    <th width="150">Category</th>
                                    <th>Descriptons </th>
                                    <th width="130">Author</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td class="text-center"><img class="img-thumbnail" src="' . base_url($value->img_thumb) . '" width="50" height="30"></td>';
                                        echo '<td>';
                                        echo '<strong><a class="text-info" href="' . base_url('admin/catalogs/edit/' . $value->id) . '">' . $value->prod_name . '</a></strong><br />';
                                        echo '<small>';
                                        echo ' <a class="text-info" href="' . base_url('catalogs/product/' . $value->id) . '"><i class="fa fa-eye"></i> Preview</a>';
                                        echo '&nbsp;&nbsp;-&nbsp;&nbsp;';
                                        echo ' <a class="text-info" href="' . base_url('admin/catalogs/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>';
                                        echo '&nbsp;&nbsp;-&nbsp;&nbsp;';
                                        echo ' <a class="text-danger" href="' . base_url('admin/catalogs/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a>';
                                        echo '</small>';
                                        echo '</td>';
                                        echo '<td>' . $value->ct_name . '</td>';
                                        echo '<td>' . character_limiter(strip_tags($value->prod_desc), 50) . '</td>';
                                        echo '<td>' . $value->username . '</td>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="6"><span class="text-danger">Tidak ada data</span></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <?php
                        if (!empty($template['partials']['pagination'])) {
                            echo $template['partials']['pagination'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>