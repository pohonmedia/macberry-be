<div class="page-title">                    
    <h2><span class="fa fa-list"></span> List All Product Categories</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Products</a>
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs/categories'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Categories&nbsp;&nbsp;&nbsp;</a>
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/catalogs/categories/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Category</a>
                </div>
                <div class="panel-body">
                    <div>
                        <?php echo form_open(uri_string()); ?>
                        <div class="input-group">
                            <input type="text" name="catalogs_categories_search" class="form-control input-sm pull-right" placeholder="Search by Name">
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

                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="70">#</th>
                                <th>Category Name </th>
                                <th>Description</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list)) {
                                foreach ($list as $key => $value) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . ($key + 1) . '</td>';
                                    echo '<td><a class="text-info" href="' . base_url('admin/catalogs/categories/edit/' . $value->id) . '"><b>' . $value->ct_name . '</b></a></td>';
                                    echo '<td>' . character_limiter(strip_tags($value->ct_desc), 100) . '</td>';
                                    echo '<td class="text-center small">';
                                    echo '<a class="text-info" href="' . base_url('admin/catalogs/categories/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                    echo '<a class="text-danger" href="' . base_url('admin/catalogs/categories/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                    if (!empty($value->child)) {
                                        foreach ($value->child as $key => $value) {
                                            echo '<tr>';
                                            echo '<td class="text-center">&nbsp;</td>';
                                            echo '<td><a class="text-info" href="' . base_url('admin/catalogs/categories/edit/' . $value->id) . '">' . $value->ct_name . '</a></td>';
                                            echo '<td>' . character_limiter(strip_tags($value->ct_desc), 100) . '</td>';
                                            echo '<td class="text-center small">';
                                            echo '<a class="text-info" href="' . base_url('admin/catalogs/categories/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                            echo '<a class="text-danger" href="' . base_url('admin/catalogs/categories/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                }
                            } else {
                                echo '<tr>';
                                echo '<td colspan="4"><span class="text-danger">Tidak ada data</span></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>

                    </table>
                    <div class="text-center">
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