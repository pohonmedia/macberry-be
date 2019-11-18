<div class="page-title">                    
    <h2><i class="fa fa-money"></i> Konfirmasi Topup Saldo</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">                                
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Form Konfirmasi Transfer</h3>
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
                            <?php echo form_hidden('bap_trans_id', $bap_trans_id); ?>
                            <div class="form-group">
                                <label for="bac_bank_asal" class="col-sm-2 control-label">Bank Asal</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($bac_bank_asal); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bac_bank_norek" class="col-sm-2 control-label">Bank No. Rekening</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($bac_bank_norek); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bac_bank_acc" class="col-sm-2 control-label">Bank Nama Rekening</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($bac_bank_acc); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bac_trx_value" class="col-sm-2 control-label">Jumlah Transfer (Rp)</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($bac_trx_value); ?>
                                    <span class="help-block">Nilai di atas adalah sesuai dengan <b>Jumlah</b> yang harus di transfer</span>
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-danger col-md-offset-2"><i class="fa fa-save"></i> Simpan</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('member/account/balance'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> <!--/.box-footer-->
                </form>
            </div>
        </div>
    </div>
</div>
</div>