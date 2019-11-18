<div class="page-title">                    
    <h2><span class="fa fa-user"></span> Edit Profile Member</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Ubah Profil User</h3>
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
                            <label for="first_name" class="col-sm-3 control-label">Nama Lengkap</label>
                            <div class="col-sm-7">
                                <?php echo form_input($first_name); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-7">
                                <?php echo form_input($username); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-7">
                                <?php echo form_input($address); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Telepon</label>
                            <div class="col-sm-7">
                                <?php echo form_input($phone); ?>
                            </div>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                </div> <!--/.box-footer-->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>