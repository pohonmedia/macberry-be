<div class="page-title">                    
    <h2><span class="fa fa-money"></span> Manage Member Withdrawal</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default disabled" href="<?php echo base_url('admin/account/withdrawal'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;History Withdrawal</a>
                </div>
                <div class="panel-body">
                    <div class="row table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="35">#</th>
                                    <th class="text-center" width="50">Trans. ID</th>
                                    <th class="text-center" width="80">Username</th>
                                    <th class="text-center" width="80">Nominal</th>
                                    <th class="text-center" width="40">Status</th>
                                    <th class="text-center" width="100">Tgl Request</th>
                                    <th class="text-center" width="100">Tgl Payment</th>
                                    <th class="text-center" width="70">Bank Tujuan</th>
                                    <th class="text-center" width="50">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td class="text-center"><a class="text-info" href="' . base_url('admin/account/withdrawal/detail/' . $value->id) . '"><b>' . $value->maw_trans_id . $value->id . '</b></a></td>';
                                        echo '<td>' . $value->full_name . '</td>';
                                        echo '<td class="text-right"> <b>Rp. ' . number_format($value->maw_value, 2) . '</b></td>';
                                        echo '<td class="text-center">';
                                        if ($value->maw_status == 0) {
                                            echo '<span class="label label-danger">Pending</span>';
                                        } else {
                                            echo '<span class="label label-success">Approved</span>';
                                        }
                                        echo '</td>';
                                        echo '<td class="small">' . date('l, d M Y h:i:s', strtotime($value->maw_init_date)) . '</td>';
                                        if ($value->maw_status == 0) {
                                            echo '<td class="text-center">';
                                            echo '<span class="label label-danger">Pending</span>';
                                            echo '</td>';
                                        } else {
                                            echo '<td class="small">';
                                            echo date('l, d M Y h:i:s', strtotime($value->maw_appr_date));
                                            echo '</td>';
                                        }
                                        echo '<td class="">' . $value->pay_to . '</td>';
                                        echo '<td class="text-center small">';
                                        if ($value->maw_status == 0) {
                                            if ($value->maw_type == 3) {
                                                echo '<a class="text-info" href="' . base_url('admin/account/withdrawal/approval_saldo/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-check"></i> Approve</a>';
                                            } else {
                                                echo '<a class="text-info" href="' . base_url('admin/account/withdrawal/approval/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-check"></i> Approve</a>';
                                            }
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="9"><span class="text-danger">Tidak ada data</span></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="panel-footer">
                    <ul style="padding:0px;margin:0px;list-style: none">
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-danger">Pending</span> Transaksi belum di approve.</li>
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-success">Approved</span> Transaksi sudah di approve oleh system/ admin.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>