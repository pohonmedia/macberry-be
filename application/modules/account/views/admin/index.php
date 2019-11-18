<div class="page-title">                    
    <h2><span class="fa fa-list"></span> List All Menu</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/menus'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Menus</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/menus/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Create Menu</a>
                </div>
                <div class="panel-body">
                    <div class="box-body table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="70">#</th>
                                    <th width="250">Menu Title </th>
                                    <th width="200">URL</th>
                                    <th class="text-center" width="30">Order</th>
                                    <th class="text-center" width="70">Publish</th>
                                    <th class="text-center" width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    $jumlah_1 = count($list);
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td><a class="text-info" href="' . base_url('admin/menus/edit/' . $value['id']) . '"><b>' . $value['menu_title'] . '</b></a></td>';
                                        echo '<td class="small">' . $value['menu_url'] . '</td>';
                                        echo '<td class="text-center">';
                                        if ($key == 0) {
                                            echo '<a href="' . base_url('admin/menus/down_pos/' . $value['id']) . '"><i class="fa fa-arrow-circle-down text-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                                        } else if ($key == ($jumlah_1 - 1)) {
                                            echo '<a href="' . base_url('admin/menus/up_pos/' . $value['id']) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-up text-success"></i></a>';
                                        } else {
                                            echo '<a href="' . base_url('admin/menus/down_pos/' . $value['id']) . '"><i class="fa fa-arrow-circle-down text-warning"></i> &nbsp;</a>';
                                            echo '<a href="' . base_url('admin/menus/up_pos/' . $value['id']) . '"><i class="fa fa-arrow-circle-up text-success"></i> &nbsp;</a>';
                                        }
//                            echo $value['menu_order'];
                                        echo '</td>';
                                        echo '<td class="text-center">';
                                        if ($value['is_published'] == 1) {
                                            echo '<a href="' . base_url('admin/menus/unpublish/' . $value['id']) . '"><i class="fa fa-check-circle text-success"></i></a>';
                                        } else {
                                            echo '<a href="' . base_url('admin/menus/publish/' . $value['id']) . '"><i class="fa fa-minus-circle text-danger"></i></a>';
                                        }
                                        echo '</td>';
                                        echo '<td class="text-center small">'
                                        . ' <a class="text-info" href="' . base_url('admin/menus/edit/' . $value['id']) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;'
                                        . ' <a class="text-danger" href="' . base_url('admin/menus/del/' . $value['id']) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini?.Jika Parent Menu, Child akan dihapus juga.\')"><i class="fa fa-minus-circle"></i> Delete</a></td>';
                                        echo '</tr>';
                                        if (!empty($value['child'])) {
                                            $jumlah_2 = count($value['child']);
                                            foreach ($value['child'] as $k => $v) {
                                                echo '<tr>';
                                                echo '<td class="text-center">&nbsp;</td>';
                                                echo '<td><a class="text-info" href="' . base_url('admin/menus/edit/' . $v['id']) . '">' . $v['menu_title'] . '</a></td>';
                                                echo '<td class="small">' . $v['menu_url'] . '</td>';
                                                echo '<td class="text-center">';
                                                if ($k == 0) {
                                                    echo '<a href="' . base_url('admin/menus/down_pos/' . $v['id']) . '"><i class="fa fa-arrow-circle-o-down text-danger"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                                                } else if ($k == ($jumlah_2 - 1)) {
                                                    echo '<a href="' . base_url('admin/menus/up_pos/' . $v['id']) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-up text-info"></i></a>';
                                                } else {
                                                    echo '<a href="' . base_url('admin/menus/down_pos/' . $v['id']) . '"><i class="fa fa-arrow-circle-o-down text-danger"></i>&nbsp;&nbsp;&nbsp;</a>';
                                                    echo '<a href="' . base_url('admin/menus/up_pos/' . $v['id']) . '"><i class="fa fa-arrow-circle-o-up text-info"></i> &nbsp;</a>';
                                                }
//                            echo $value['menu_order'];
                                                echo '</td>';
                                                echo '<td class="text-center">';
                                                if ($value['is_published'] == 1) {
                                                    echo '<a href="' . base_url('admin/menus/unpublish/' . $value['id']) . '"><i class="fa fa-check-circle text-success"></i></a>';
                                                } else {
                                                    echo '<a href="' . base_url('admin/menus/publish/' . $value['id']) . '"><i class="fa fa-minus-circle text-danger"></i></a>';
                                                }
                                                echo '</td>';
                                                echo '<td class="text-center small">'
                                                . ' <a class="text-info" href="' . base_url('admin/menus/edit/' . $value['id']) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;'
                                                . ' <a class="text-danger" href="' . base_url('admin/menus/del/' . $value['id']) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini?.Jika Parent Menu, Child akan dihapus juga.\')"><i class="fa fa-minus-circle"></i> Delete</a></td>';
                                                echo '</tr>';
                                            }
                                        }
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
                </div>
            </div>
        </div>
    </div>
</div>