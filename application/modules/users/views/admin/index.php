<div class="page-title">                    
    <h2><span class="fa fa-users"></span> List All Users</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Users</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/users/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New User</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-users"></i>&nbsp;&nbsp;Groups</a>
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
                                    <th width="300">Full Name</th>
                                    <th width="200">Username</th>
                                    <th width="200">Email</th>
                                    <th width="180">Last Login</th>
                                    <th class="text-center" width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td><a class="text-info" href="' . base_url('admin/users/edit/' . $value->id) . '"><b>' . $value->first_name . '</b></a></td>';
                                        echo '<td>' . $value->username . '</td>';
                                        echo '<td>' . $value->email . '</td>';
                                        echo '<td class="small">' . date('l, d M Y h:i:s', $value->last_login) . '</td>';
                                        echo '<td class="text-center small">';
                                        echo '<a class="text-info" href="' . base_url('admin/users/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                        echo '<a class="text-danger" href="' . base_url('admin/users/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-minus-circle"></i> Delete</a>';
                                        echo '</td>';
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
                </div>
            </div>
        </div>
    </div>
</div>