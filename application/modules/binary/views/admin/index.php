<div class="page-title">                    
    <h2><span class="fa fa-map-marker"></span> Manajemen Titik Usaha</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url('admin/binary/approval'); ?>"><i class="fa fa-check"></i>&nbsp;&nbsp;Approval Node</a>
                    <a class="btn btn-sm btn-danger btn-flat pull-right disabled" href="<?php echo base_url('admin/binary/dist_reward_all'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Dist. Semua Reward</a>
                    <a class="btn btn-sm btn-info btn-flat pull-right disabled" href="<?php echo base_url('admin/binary/dist_reward_first'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Dist. Reward Pertama</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                    <div class="row">
                        <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                        <div class="form-group">
                            <label for="search_type" class="col-sm-1 control-label">Berdasar</label>
                            <div class="col-sm-3">
                                <?php echo form_dropdown('search_type', $sr_type_data, '0', $search_type); ?>
                            </div>
                            <div class="col-sm-7">
                                <?php echo form_dropdown('user', $user_data, '0', $user); ?>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-md btn-default">&nbsp;<i class="fa fa-search"></i>&nbsp;</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <br />
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="30">#</th>
                                <th class="text-center" width="100">Username</th>
                                <th class="text-center" width="145">Upline</th>
                                <th class="text-center" width="145">Sponsor</th>
                                <th class="text-center" width="60">Date Create </th>
                                <th class="text-center" width="90">Total Reward</th>
                                <th class="text-center" width="50">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list)) {
                                foreach ($list as $key => $value) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . ($key + 1) . '</td>';
                                    echo '<td><b>';
                                    echo $value->usaha_name;
                                    echo '</b></td>';
                                    echo '<td>';
                                    echo $value->mb_parent_id == 0 ? "System" : $value->parent . ' #' . $value->mb_parent_id;
//                                    echo $value->mb_parent_id == 0 ? "System" : $value->parent_name . ' [ ' . $value->parent_username . ' ] #' . $value->mb_parent_id;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $value->mb_sponsor_id == 0 ? "System" : $value->sponsor_username . ' [ ' . $value->sponsor_name . ' ]';
                                    echo '</td>';
                                    echo '<td class="small">' . mdate("%d/%M/%Y %H:%i:%s", strtotime($value->mb_date_create)) . '</td>';
                                    echo '<td class="text-right"><b>';
                                    echo 'Rp. ' . number_format($value->total_reward, 2);
                                    echo '</b></td>';
                                    echo '<td class="text-center">';
                                    if ($value->reward_status == 0) {
                                        echo '<a class="text-info" href="' . base_url('admin/binary/dist_reward/' . $value->usaha_id) . '"><i class="fa fa-check"></i> Dist. Reward</a>';
                                    }
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