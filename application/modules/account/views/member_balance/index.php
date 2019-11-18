<div class="page-title">                    
    <h2><span class="fa fa-dollar"></span> Saldo Saya</h2>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="widget widget-info widget-padding-sm">
            <div class="widget-int">Rp. <?php echo number_format($user_info->saldo_total, 2); ?></div>
            <div class="widget-title">Total Saldo</div>
            <div class="widget-subtitle">Di akun anda</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="widget widget-warning widget-padding-sm">
            <div class="widget-int">Rp. <?php echo number_format($user_info->wd_total, 2); ?></div>
            <div class="widget-title">Total Withdrawal</div>
            <div class="widget-subtitle">Di akun anda</div>
        </div>
    </div>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default" href="<?php echo base_url('member/account/balance'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;History Saldo</a>
                    <a class="btn btn-sm btn-info" href="<?php echo base_url('member/account/balance/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Tambah Saldo</a>
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
                                    <th class="text-center"  width="100">Trans ID</th>
                                    <th class="text-center"  width="150">Nominal</th>
                                    <th class="text-center" width="150">Trans. Date</th>
                                    <th class="text-center" width="70">Status</th>
                                    <th class="text-center" width="70">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td><a class="text-info" href="' . base_url('member/account/balance/detail/' . $value->id) . '"><b>' . $value->mab_trans_id . $value->id . '</b></a></td>';
                                        echo '<td> <b>Rp. ' . number_format($value->mab_total, 2) . '</b></td>';
                                        echo '<td class="small">' . date('l, d M Y h:i:s', strtotime($value->mab_init_date)) . '</td>';
                                        echo '<td class="text-center">';
                                        if ($value->mab_status == 1) {
                                            echo '<span class="label label-danger">Pending</span>';
                                        } else if ($value->mab_status == 2) {
                                            echo '<span class="label label-info">Confirmed</span>';
                                        } else if ($value->mab_status == 3) {
                                            echo '<span class="label label-success">Approved</span>';
                                        } else {
                                            echo '<span class="label label-primary">N/A</span>';
                                        }
                                        echo '</td>';
                                        echo '<td class="text-center small">';
                                        if ($value->mab_status == 1) {
                                            echo '<a class="text-info" href="' . base_url('member/account/balance/konfirmasi/' . $value->id) . '"><i class="fa fa-edit"></i> Konfirmasi</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                            echo '<a class="text-danger" href="' . base_url('member/account/balance/cancel/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-minus-circle"></i> Batal</a>';
                                        }
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
                <div class="panel-footer">
                    <ul style="padding:0px;margin:0px;list-style: none">
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-danger">Pending</span> Transaksi belum dikonfirmasi oleh user.</li>
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-info">Confirmed</span> Transaksi sudah dikonfirmasi oleh user. Menunggu approval system.</li>
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-success">Approved</span> Transaksi sudah di approve oleh system. Saldo bertambah.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>