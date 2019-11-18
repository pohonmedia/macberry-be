<div class="page-title">                    
    <h2><i class="fa fa-money"></i> Approval Withdraw</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">                                
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3><i class="fa fa-dollar"></i> Form Konfirmasi Withdrawal</h3>
                    </div>                                    
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <div class="row">
                        <!--<div class="col-md-8">-->
                        <?php echo form_hidden('wd_trans_id', $wd_trans_id); ?>
                        <h4>Data Withdrawal</h4>
                        <div class="form-group">
                            <label for="bac_bank_asal" class="col-sm-2 control-label">Nominal Withdrawal</label>
                            <div class="col-sm-5 text-danger" style="padding: 7px 10px 0px 10px;font-weight: bold">
                                Rp. <?php echo number_format($wd_detail->maw_value, 2); ?>,-
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bac_bank_asal" class="col-sm-2 control-label">Bank Tujuan</label>
                            <div class="col-sm-5 text-info" style="padding: 7px 10px 0px 10px;">
                                <?php echo '<b>' . $bank_detail->bank_name . '</b> Cabang ' . $bank_detail->bank_cabang; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bac_bank_asal" class="col-sm-2 control-label">No Rekening Tujuan</label>
                            <div class="col-sm-5 text-info" style="padding: 7px 10px 0px 10px;">
                                <?php echo '<b class="text-danger">' . $bank_detail->bank_norek . '</b> a.n <b>' . $bank_detail->bank_pemilik_name . '</b>'; ?>
                            </div>
                        </div>
                        <br />
                        <h4>Data Approval</h4>
                        <div class="form-group">
                            <label for="maw_bank_id" class="col-sm-2 control-label">Bank Admin Asal</label>
                            <div class="col-sm-5">
                                <?php echo form_dropdown('maw_bank_id', $bank_data, '0', $maw_bank_id); ?>
                            </div>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-danger col-md-offset-2"><i class="fa fa-save"></i> Confirm</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/account/withdrawal'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> <!--/.box-footer-->
                </form>
            </div>
        </div>
    </div>
</div>
</div>