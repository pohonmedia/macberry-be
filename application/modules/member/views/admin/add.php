<div class="page-title">                    
    <h2><span class="fa fa-plus-square"></span> Add New Member</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/member'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Member</a>
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
                            <label for="first_name" class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-5">
                                <?php echo form_input($first_name); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="identity" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-5">
                                <?php echo form_input($identity); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sponsor" class="col-sm-2 control-label">Sponsor</label>
                            <div class="col-sm-5">
                                <?php echo form_dropdown('sponsor', $sponsor_data, '0', $sponsor); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-5">
                                <?php echo form_input($email); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="card_id" class="col-sm-2 control-label">No Kartu ID</label>
                            <div class="col-sm-5">
                                <?php echo form_input($card_id); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">No Telp/ HP</label>
                            <div class="col-sm-5">
                                <?php echo form_input($phone); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Alamat Lengkap</label>
                            <div class="col-sm-5">
                                <?php echo form_textarea($address); ?>
                            </div>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary col-md-offset-2"><i class="fa fa-save"></i> Create</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/member'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> <!--/.box-footer-->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>