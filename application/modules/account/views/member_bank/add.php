<div class="page-title">                    
    <h2><span class="fa fa-bank"></span> Add Bank Account</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">   
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default" href="<?php echo base_url('member/account/bank'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp; List Bank Account</a>
                </div>                             
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <form class="form-horizontal">
                        <div class="row">
                            <!--<div class="col-md-8">-->
                            <div class="form-group">
                                <label for="bank_name" class="col-sm-2 control-label">Nama Bank</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($bank_name); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bank_cabang" class="col-sm-2 control-label">Bank Cabang</label>
                                <div class="col-sm-5">
                                   <?php echo form_input($bank_cabang); ?> 
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="bank_norek" class="col-sm-2 control-label">No.Rekening</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($bank_norek); ?> 
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="bank_pemilik_name" class="col-sm-2 control-label">Nama Pemilik Rekening</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($bank_pemilik_name); ?> 
                                </div>

                            </div>
                            <!--</div>-->
                        </div>
                </div>
                <div class="panel-footer">
                    <button  ng-click="" class="btn btn-sm btn-danger col-md-offset-2"><i class="fa fa-save"></i> SAVE</button>
                </div> <!--/.box-footer-->
                </form>
            </div>
        </div>
    </div>
</div>
</div>