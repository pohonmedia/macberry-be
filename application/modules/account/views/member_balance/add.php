<div class="page-title">                    
    <h2><i class="fa fa-dollar"></i> Tambah Saldo</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">                                
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3><i class="fa fa-folder-open"></i> Form Topup Saldo</h3>
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
                            <div class="form-group">
                                <label for="mab_value" class="col-sm-2 control-label">Nominal Transfer</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($mab_value); ?>
                                    <span class="help-block">Minimal Topup Saldo sebesar Rp. 50.000,-</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bal_bank_tujuan" class="col-sm-2 control-label">Bank Tujuan</label>
                                <div class="col-sm-5">
                                    <?php echo form_dropdown('mab_bank_dest', $bank_data, '0', $mab_bank_dest); ?>
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