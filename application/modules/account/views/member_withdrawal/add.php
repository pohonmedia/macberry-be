<div class="page-title">                    
    <h2><i class="fa fa-dollar"></i> Form Withdrawal</h2>
</div>
<!--<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">                                
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3><i class="fa fa-folder-open"></i> Form Withdrawal</h3>
                    </div>                                    
                </div>
                <div class="panel-body">-->
<div class="row">
    <?php
    if (!empty($msg)) {
        echo $msg;
        echo '<br />';
    }
    ?>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <blockquote class="blockquote-danger">
                <h3>Total Saldo + Reward anda adalah <b class="text-danger"><?php echo 'Rp. ' . number_format($user_info->reward_total + $user_info->saldo_total, 2); ?>,-</b></h3>
                <footer>Anda dapat melakukan withdraw minimal Rp. 50.000,- dengan saldo minimum <b class="text-danger">JUMLAH WITHDRAW + 10% JUMLAH WITHDRAW</b></footer>
            </blockquote>
        </div>
        <!-- START TABS -->                                
        <div class="panel panel-default tabs">                            
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-first" role="tab" data-toggle="tab"><i class="fa fa-dollar"></i> Uang Tunai</a></li>
                <li><a href="#tab-second" role="tab" data-toggle="tab"><i class="fa fa-credit-card"></i> Tukar Saldo</a></li>
                <li><a href="#tab-third" role="tab" data-toggle="tab"><i class="fa fa-shopping-cart"></i> Tukar Barang</a></li>
            </ul>                            
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="tab-first">
                    <p>Form withdraw uang tunai</p>
                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <div class="row">
                        <div class="form-group" id="cmb-bank">
                            <label for="wd_bank_dest" class="col-sm-2 control-label">Bank Member</label>
                            <div class="col-sm-5">
                                <?php echo form_dropdown('wd_bank_dest', $bank_data, '0', $wd_bank_dest); ?>
                            </div>
                        </div>
                        <div class="form-group" id="wd-value">
                            <label for="wd_value" class="col-sm-2 control-label">Nominal Withdrawal</label>
                            <div class="col-sm-5">
                                <?php echo form_input($wd_value); ?>
                                <span class="help-block text-info">Minimal Withdrawal sebesar <span class="text-danger">Rp. 50.000,-</span>. <br /> Saldo minimum adalah <b class="text-danger">JUMLAH WITHDRAW + 10% JUMLAH WITHDRAW</b> (Biaya Admin)</span>
                            </div>
                        </div>
                        <div class="form-group" id="wd-charge">
                            <label for="wd_charge" class="col-sm-2 control-label">Biaya Admin</label>
                            <div class="col-sm-5">
                                <?php echo form_input($wd_charge); ?>
                            </div>
                        </div>
                        <div class="form-group" id="wd-bank-charge">
                            <label for="wd_bank_charge" class="col-sm-2 control-label">Biaya Bank</label>
                            <div class="col-sm-5">
                                <?php echo form_input($wd_bank_charge); ?>
                            </div>
                        </div>
                        <div class="form-group" id="wd-total">
                            <label for="wd_total" class="col-sm-2 control-label">Total Withdrawal</label>
                            <div class="col-sm-5">
                                <?php echo form_input($wd_total); ?>
                            </div>
                        </div
                    </div>
                    <button class="btn btn-sm btn-danger col-md-offset-2"><i class="fa fa-save"></i> SAVE</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="tab-pane" id="tab-second">
                <p>Form Tukar Saldo.</p>
                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <div class="row">
                        <div class="form-group" id="wd-sd-value">
                            <label for="wd_sd_value" class="col-sm-2 control-label">Nominal Withdrawal</label>
                            <div class="col-sm-5">
                                <?php echo form_input($wd_sd_value); ?>
                                <span class="help-block text-info">Minimal Withdrawal sebesar <span class="text-danger">Rp. 50.000,-</span>. <br /> Saldo minimum adalah <b class="text-danger">JUMLAH WITHDRAW + 10% JUMLAH WITHDRAW</b> (Biaya Admin)</span>
                            </div>
                        </div>
                        <div class="form-group" id="wd-sd-charge">
                            <label for="wd_sd_charge" class="col-sm-2 control-label">Biaya Admin</label>
                            <div class="col-sm-5">
                                <?php echo form_input($wd_sd_charge); ?>
                            </div>
                        </div>
                        <div class="form-group" id="wd-sd-total">
                            <label for="wd_sd_total" class="col-sm-2 control-label">Total Withdrawal</label>
                            <div class="col-sm-5">
                                <?php echo form_input($wd_sd_total); ?>
                            </div>
                        </div
                    </div>
                    <button class="btn btn-sm btn-danger col-md-offset-2"><i class="fa fa-save"></i> SAVE</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="tab-pane" id="tab-third">
                <p>Form Tukar Barang</p>
            </div>
        </div>
    </div>                                                   
    <!-- END TABS -->                        
</div>
<!--</div>-->

<!--                    <?php // echo form_open(uri_string(), 'class="form-horizontal"');        ?>
                    <div class="row">
                        <div class="form-group">
                            <label for="wd_type" class="col-sm-2 control-label">Type Withdrawal</label>
                            <div class="col-sm-3">
<?php // echo form_dropdown('wd_type', $wd_type_data, '0', $wd_type); ?>
                                <span class="help-block">Jenis withdraw yang anda inginkan.</span>
                            </div>
                        </div>

                        <div class="form-group" id="wd-item">
                            <label for="wd_item_name" class="col-sm-2 control-label">Penukaran Barang</label>
                            <div class="col-sm-5">
<?php // echo form_input($wd_item_name); ?>
                            </div>
                        </div>
                    </div>-->
<!--</div>-->
<!--                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-danger col-md-offset-2"><i class="fa fa-save"></i> Simpan</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('member/account/withdrawal'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> /.box-footer-->
<!--</form>-->
<!--        </div>
    </div>
</div>
</div>
</div>-->