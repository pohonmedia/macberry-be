<div class="page-title">                    
    <h2><span class="fa fa-credit-card"></span> Withdrawal</h2>
</div>
<div class="page-content-wrap">
    <?php if (!$bank_user) { ?>
        <div class="row col-md-12">
            <div class="alert alert-info" role="alert">
                <strong>Maaf!</strong> Anda belum memasukkan data bank di Account. Klik <a class="btn btn-xs btn-danger" href="<?php echo base_url('member/account/bank/add'); ?>">di sini</a> untuk menambah data bank.
            </div>   
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-4">
            <div class="widget widget-info widget-padding-sm">
                <div class="widget-int"><?php echo 'Rp. ' . number_format($user_info->reward_total, 2); ?></div>
                <div class="widget-title">Total Reward</div>
                <div class="widget-subtitle">Dari semua titik usaha anda</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-danger widget-padding-sm">
                <div class="widget-int">Rp. <?php echo number_format($user_info->saldo_total, 2); ?></div>
                <div class="widget-title">Total Saldo</div>
                <div class="widget-subtitle">Di akun anda</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">	 
                    <a class="btn btn-sm btn-info btn-flat<?php echo $bank_user ? '' : ' disabled' ?>" href="<?php echo base_url('member/account/withdrawal/add'); ?>"><i class="fa fa-dollar"></i>Get Withdrawal</a>
                </div>                 
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                        echo '<br />';
                    }
                    ?>
                    <div class="row">
                        <blockquote class="blockquote-danger">
                            <h3>Proses withdraw maksimal 3x24 jam, pada hari kerja.</h3>
                            <!--                            <footer></footer>-->
                        </blockquote>
                    </div>
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="35">#</th>
                                <th class="text-center" width="50">Trans. ID</th>
                                <th class="text-center" width="80">Nominal</th>
                                <th class="text-center" width="80">Biaya Admin</th>
                                <th class="text-center" width="40">Status</th>
                                <th class="text-center" width="100">Tgl Request</th>
                                <th class="text-center" width="100">Tgl Payment</th>
                                <th class="text-center" width="80">Type WD</th>
                                <th class="text-center" width="50">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list)) {
                                foreach ($list as $key => $value) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . ($key + 1) . '</td>';
                                    echo '<td class="text-center"><a class="text-info" href="' . base_url('member/account/withdrawal/detail/' . $value->id) . '"><b>' . $value->maw_trans_id . $value->id . '</b></a></td>';
                                    echo '<td class="text-right">Rp. ' . number_format($value->maw_value, 2) . '</td>';
                                    echo '<td class="text-right">Rp. ' . number_format($value->maw_admin_charge, 2) . '</td>';
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
                                    echo '<td class="text-center">' . ($value->maw_type == 1 ? "WD Uang Tunai" : ($value->maw_type == 2 ? "WD Barang" : "Tukar Saldo")) . '</td>';
                                    echo '<td class="text-center">';
                                    if ($value->maw_status == 0) {
                                        echo '<a class="text-danger" href="' . base_url('member/account/withdrawal/cancel/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-minus-circle"></i> Batal</a>';
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
                <div class="panel-footer">
                    <ul style="padding:0px;margin:0px;list-style: none">
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-danger">Info</span> Untuk member, dengan bank penerima bonus,selain bank yang ada pada admin (Lihat Halaman Dashboard), maka di kenakan biaya transfer antar bank.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>