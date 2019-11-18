<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/widgets'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Widgets&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo!empty($count_data) ? $count_data : 0; ?></span></a>
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/widgets/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Widget</a>
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/widgets/setting'); ?>"><i class="fa fa-gears"></i>&nbsp;&nbsp;Setting</a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">List All Widgets</h3>
        </div>
        <div class="box-body table-responsive">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>

            <div>
                <?php echo form_open(uri_string()); ?>
                <div class="input-group">
                    <input type="text" name="articles_search" class="form-control input-sm pull-right" placeholder="Search by Name">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-default btn-flat"><i class="fa fa-search"></i></button>
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

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center" width="70">#</th>
                        <th width="300">Title </th>
                        <th>Ordering </th>
                        <th>Publish </th>
                        <th class="text-center" width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($list)) {
                        foreach ($list as $key => $value) {
                            echo '<tr>';
                            echo '<td class="text-center">' . ($key + 1) . '</td>';
                            echo '<td>' . strtoupper($value->hal_title) . '</td>';
                            echo '<td>image</td>';
                            echo '<td>' . character_limiter(strip_tags($value->hal_desc), 100) . '</td>';
                            echo '<td class="text-center">'
                            . ' <a class="text-info" href="' . base_url('admin/pages/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;'
                            . ' <a class="text-danger" href="' . base_url('admin/pages/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="5"><span class="text-danger">Tidak ada data</span></td>';
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
    </div><!-- /.box -->
</section><!-- /.content -->