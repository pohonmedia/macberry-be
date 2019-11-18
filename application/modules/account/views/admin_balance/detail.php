<div class="page-title">                    
    <h2><span class="fa fa-list"></span> Topup Detail</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default" href="<?php echo base_url('admin/account/balance'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;History Saldo</a>
                </div>
                <div class="panel-body">
                    <div class="box-body table-responsive">
                        <h3>Detail Topup ID <b class="text-danger">#<?php echo $detail->mab_trans_id . '</b> a.n ' . $detail->full_name; ?></h3>
                        <table>
                            <tr>
                                <th colspan="2" style="padding: 30px 10px 10px 20px"><h4>Data Topup</h4></th>
                            </tr>
                            <tr>
                                <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">Status</th>
                                <td style="padding: 10px">
                                    <?php
                                    if ($detail->mab_status == 1) {
                                        echo '<span class="label label-danger">Pending</span>';
                                    } else if ($detail->mab_status == 2) {
                                        echo '<span class="label label-info">Confirmed</span>';
                                    } else if ($detail->mab_status == 3) {
                                        echo '<span class="label label-success">Approved</span>';
                                    } else {
                                        echo '<span class="label label-primary">N/A</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">Nominal Topup</th>
                                <td style="padding: 10px">Rp. <?php echo number_format($detail->mab_value, 2); ?>,-</td>
                            </tr>
                            <tr>
                                <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">Nominal Transfer</th>
                                <td style="padding: 10px" class="text-danger">Rp. <?php echo number_format($detail->mab_total, 2); ?>,-</td>
                            </tr>
                            <tr>
                                <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">Bank Tujuan</th>
                                <td style="padding: 10px"><?php echo $detail->bank_tujuan_name . ' ' . $detail->bank_tujuan_branch . ' a.n ' . $detail->bank_tujuan_acc . ' [' . $detail->bank_tujuan_rek . ']'; ?></td>
                            </tr>
                            <tr>
                                <th colspan="2" style="padding: 30px 10px 10px 20px"><h4>Data Konfirmasi</h4></th>
                            </tr>
                            <?php if (empty($konfirmasi)) { ?>
                                <tr>
                                    <td colspan="2" style="padding: 0px 10px 10px 20px" class="text-danger">Transaksi Topup Belum di Konfirmasi</td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">Bank Asal</th>
                                    <td style="padding: 10px"><?php echo $konfirmasi->bac_bank_asal; ?></td>
                                </tr>
                                <tr>
                                    <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">Pemilik Rekening</th>
                                    <td style="padding: 10px"><?php echo $konfirmasi->bac_bank_acc; ?></td>
                                </tr>
                                <tr>
                                    <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">No Rekening Bank</th>
                                    <td style="padding: 10px"><?php echo $konfirmasi->bac_bank_norek; ?></td>
                                </tr>
                                <tr>
                                    <th class="pull-right" style="width: 170px;text-align: right;padding: 10px">Nominal Transfer</th>
                                    <td style="padding: 10px">Rp. <?php echo number_format($konfirmasi->bac_trx_value, 2); ?>,-</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>