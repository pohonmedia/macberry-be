<div class="page-title">                    
    <h2><span class="fa fa-map-marker"></span> Titik Usaha Saya</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-info btn-flat" href="<?php echo base_url('admin/binary'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Titik Usaha</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">#</th>
                                <th class="text-center" width="100">Username</th>
                                <th class="text-center" width="90">Date Create </th>
                                <th class="text-center" width="200">Upline</th>
                                <th class="text-center" width="70">Total Downline</th>
                                <th class="text-center" width="100">Total Reward</th>
                                <th class="text-center" width="50">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list)) {
                                foreach ($list as $key => $value) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . ($key + 1) . '</td>';
                                    echo '<td>' . $value->first_name . ' [ <b>' . $value->username . '</b> ]</td>';
                                    echo '<td class="text-center">' . mdate("%d/%M/%Y %H:%i:%s", strtotime($value->mb_date_create)) . '</td>';
                                    echo '<td>';
                                    echo $value->status_approval == 0 ? "<b>Pending</b>" : ($value->mb_parent_id == 0 ? "System" : $value->username . ' [ ' . $value->first_name . ' ]');
                                    echo '</td>';
                                    echo '<td class="text-center">';
                                    echo $value->status_approval == 0 ? "Pending" : $value->mb_count_child;
                                    echo '</td>';
                                    echo '<td class="text-right"><b>';
                                    echo $value->status_approval == 0 ? "Pending" : 'Rp. ' . number_format($value->total_reward, 2);
                                    echo '</b></td>';
                                    echo '<td class="text-center">';
                                    echo '<a class="text-info" href="' . base_url('admin/binary/approve/' . $value->usaha_id) . '"><i class="fa fa-check"></i> Approve</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr>';
                                echo '<td colspan="7"><span class="text-danger">Belum ada data</span></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>