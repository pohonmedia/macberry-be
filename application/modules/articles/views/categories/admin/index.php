<!-- Toolbars -->
<h2 class="section-title">List All Article Categories</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Articles</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Categories&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo!empty($count_data) ? $count_data : 0; ?></span></a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/articles/categories/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Category</a>
    </div>
</div>
</br>

<!-- Main content -->
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body table-responsive">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>

            <div>
                <?php echo form_open(uri_string()); ?>
                <div class="input-group">
                    <input type="text" name="articles_categories_search" class="form-control" placeholder="Search by Title">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
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

            <table class="table table-hover table-striped table-condensed">
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
                            echo '<td><a class="text-info" href="' . base_url('admin/articles/categories/edit/' . $value->id) . '"><b>' . $value->ct_name . '</b></td>';
                            echo '<td>' . character_limiter(strip_tags($value->ct_desc), 100) . '</td>';
                            echo '<td class="text-center small">';
                            echo '<a class="text-info" href="' . base_url('admin/articles/categories/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                            echo '<a class="text-danger" href="' . base_url('admin/articles/categories/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                            if (!empty($value->child)) {
                                foreach ($value->child as $key => $value) {
                                    echo '<tr>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td><a class="text-info" href="' . base_url('admin/articles/categories/edit/' . $value->id) . '">' . $value->ct_name . '</td>';
                                    echo '<td>' . character_limiter(strip_tags($value->ct_desc), 100) . '</td>';
                                    echo '<td class="text-center small">';
                                    echo '<a class="text-info" href="' . base_url('admin/articles/categories/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                    echo '<a class="text-danger" href="' . base_url('admin/articles/categories/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a>';
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
            </div>
            <div class="card-footer text-center">
            <?php echo $template['partials']['pagination'] ?>
            </div>

        </div>
    </div>
</div>