<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/sliders'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Sliders&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo!empty($count_data) ? $count_data : 0; ?></span></a>
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/sliders/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Slide</a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">List All Sliders</h3>
        </div>
        <div class="box-body table-responsive">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>

            <table class="table table-hover table-striped table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" width="70">#</th>
                        <th class="text-center" width="100"> </th>
                        <th width="300">Title </th>
                        <th>Text 1 </th>
                        <th>Text 2 </th>
                        <th class="text-center" width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($list)) {
                        foreach ($list as $key => $value) {
                            echo '<tr>';
                            echo '<td class="text-center">' . ($key + 1) . '</td>';
                            echo '<td class="text-center"><img class="img-thumbnail" src="' . base_url($value->sld_url) . '" width="50" height="30"></td>';
                            echo '<td><a class="text-info" href="' . base_url('admin/sliders/edit/' . $value->id) . '"><b>' . $value->sld_title . '</b></a></td>';
                            echo '<td>' . $value->sld_text1 . '</td>';
                            echo '<td>' . $value->sld_text2 . '</td>';
                            echo '<td class="text-center small">'
                            . ' <a class="text-info" href="' . base_url('admin/sliders/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;'
                            . ' <a class="text-danger" href="' . base_url('admin/sliders/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini?\')"><i class="fa fa-trash"></i> Delete</a></td>';
                            echo '</tr>';
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
    </div><!-- /.box -->
</section><!-- /.content -->