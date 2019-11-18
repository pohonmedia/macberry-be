<div class="page-title">                    
    <h2><span class="fa fa-users"></span> Daftar Semua Member</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/member'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List All Member</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/member/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Tambah Member</a>
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
                                    <th class="text-center" width="35">#</th>
                                    <th class="text-center"  width="150">Nama Lengkap</th>
                                    <th class="text-center"  width="120">Username </th>
                                    <th class="text-center"  width="120">Join Date</th>
                                    <th class="text-center" width="170">Upline</th>
                                    <th class="text-center" width="50">Status</th>
                                    <th class="text-center" width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td><a class="text-info" href="' . base_url('admin/member/edit/' . $value->id) . '"><b>' . $value->first_name . '</b></a></td>';
                                        echo '<td class="text-center">' . $value->username . '</td>';
                                        echo '<td class="small">' . date('l, d M Y h:i:s', $value->created_on) . '</td>';
                                        echo '<td><a class="text-info" href="' . base_url('admin/member/downline/' . $value->upline_id) . '"><b>' . $value->upline_name . '</b></a> [ <span class="small">' . $value->upline_username . ' </span>]</td>';
                                        echo '<td class="text-center">';
                                        if ($value->id != 1) {
                                            if ($value->active == 1) {
                                                echo '<a href="' . base_url('admin/member/deactivate/' . $value->id) . '"><i class="fa fa-check-circle text-success"></i></a>';
                                            } else {
                                                echo '<a href="' . base_url('admin/member/activate/' . $value->id) . '"><i class="fa fa-minus-circle text-danger"></i></a>';
                                            }
                                        }
                                        echo '</td>';
                                        echo '<td class="text-center small">';
                                        if ($value->id != 1) {
                                            echo '<a class="text-info" href="' . base_url('admin/member/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                            echo '<a class="text-danger" href="' . base_url('admin/member/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-minus-circle"></i> Delete</a>';
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="7"><span class="text-danger">Tidak ada data</span></td>';
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