<div class="page-title">                    
    <h2><span class="fa fa-dollar"></span> Manage Member Balance</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default disabled" href="<?php echo base_url('member/account/balance'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;History Saldo</a>
                    <a class="btn btn-sm btn-info disabled" href="<?php echo base_url('member/account/balance/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Tambah Saldo</a>
                </div>
                <div class="panel-body">
                    <div class="row table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="35">#</th>
                                    <th class="text-center"  width="70">Trans ID</th>
                                    <th class="text-center"  width="180">Member Name</th>
                                    <th class="text-center"  width="90">Nominal</th>
                                    <th class="text-center"  width="150">Bank Tujuan</th>
                                    <th class="text-center" width="90">Trans. Date</th>
                                    <th class="text-center" width="50">Status</th>
                                    <th class="text-center" width="70">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        if ($value->mab_status == 1) {
                                            echo '<tr class="active">';
                                        } else if ($value->mab_status == 2) {
                                            echo '<tr class="warning">';
                                        } else {
                                            echo '<tr>';
                                        }
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td><a class="text-info" href="' . base_url('admin/account/balance/detail/' . $value->id) . '"><b>' . $value->mab_trans_id . $value->id . '</b></a></td>';
                                        echo '<td><b>' . $value->full_name . '</b> [ ' . $value->username . ']</td>';
//                                        echo '<td><a class="text-info" href="' . base_url('admin/account/balance_det/' . $value->id) . '"><b>' . $value->mab_trans_id . $value->id . '</b></a></td>';
                                        echo '<td class="text-right"> <b>Rp. ' . number_format($value->mab_total, 2) . '</b></td>';
                                        $bank = '<b>' . $value->bank_tujuan_name . '</b> [' . $value->bank_tujuan_rek . ' a.n. ' . $value->bank_tujuan_acc . ']';
                                        echo '<td> ' . character_limiter($bank, 37) . '</td>';
//                                        echo '<td class="small">' . date('l, d M Y h:i:s', strtotime($value->mab_init_date)) . '</td>';
                                        echo '<td class="small text-center">' . date('d M Y h:i:s', strtotime($value->mab_init_date)) . '</td>';
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
                                        echo '<td class="text-center">';
                                        if ($value->mab_status == 2) {
                                            echo '<a class="text-info" href="' . base_url('admin/account/balance/approval/' . $value->id) . '"><i class="fa fa-check"></i> Approve</a>';
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
                    </div>

                </div>
                <div class="panel-footer">
                    <ul style="padding:0px;margin:0px;list-style: none">
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-danger">Pending</span> Transaksi belum dikonfirmasi oleh member.</li>
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-info">Confirmed</span> Transaksi sudah dikonfirmasi oleh member. Menunggu approval system.</li>
                        <li style="margin:-7px 0px 0px 0px;"><span class="label label-success">Approved</span> Transaksi sudah di approve oleh system/ admin. Saldo member bertambah.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>