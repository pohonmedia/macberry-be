<div class="page-title">                    
    <h2><span class="fa fa-map-marker"></span> Titik Usaha Saya</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-info btn-flat" href="<?php echo base_url('member/binary/usaha/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Tambah Usaha</a>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">#</th>
                                <th class="text-center" width="100">Date Create </th>
                                <th class="text-center" width="200">Upline</th>
                                <th class="text-center" width="70">Total Downline</th>
                                <th class="text-center" width="150">Reward Usaha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list)) {
                                foreach ($list as $key => $value) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . ($key + 1) . '</td>';
                                    echo '<td><a href="' . base_url("member/binary/tree/show/" . $value->mb_usaha_id) . '"><b>' . mdate("%d %F %Y %H:%i:%s", strtotime($value->mb_date_create)) . '</b></a></td>';
                                    echo '<td>';
                                    echo $value->status_approval == 0 ? "<b>Pending</b>" : ($value->mb_parent_id == 0 ? "System" : $value->parent);
                                    echo '</td>';
                                    echo '<td class="text-center">';
                                    echo $value->status_approval == 0 ? "Pending" : 'On Progress';
                                    echo '</td>';
                                    echo '<td class="text-right"><b>';
                                    echo $value->status_approval == 0 ? "Pending" : 'Rp. ' . number_format($value->total_reward, 2);
                                    echo '</b></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr>';
                                echo '<td colspan="5"><span class="text-danger">Belum ada data</span></td>';
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