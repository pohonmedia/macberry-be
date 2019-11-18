<div class="page-title">                    
    <h2><span class="fa fa-sitemap"></span> Daftar Downline User <b><?php echo $upline->first_name; ?></b></h2>
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
                                    <th class="text-center" width="70">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td><b class="text-info">' . $value->first_name . '</b></td>';
                                        echo '<td class="text-center">' . $value->username . '</td>';
                                        echo '<td class="text-center small">' . date('l, d M Y h:i:s', $value->created_on) . '</td>';
                                        echo '<td class="text-center">';
                                        if ($value->active == 1) {
                                            echo '<i class="fa fa-check-circle text-success"></i>';
                                        } else {
                                            echo '<i class="fa fa-minus-circle text-danger"></i>';
                                        }
                                        echo '</td>';
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
                </div>
            </div>
        </div>
    </div>
</div>