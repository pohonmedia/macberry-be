<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Member Profile</h3>
            <br />
        </div>
        <div class="box-body">
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
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-7">
                            <?php echo form_input($email); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-7">
                            <?php echo form_input($password); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="col-sm-3 control-label">Password Confirm</label>
                        <div class="col-sm-7">
                            <?php echo form_input($password_confirm); ?>
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
                    <div class="form-group">
                        <label for="art_img_caption" class="col-sm-3 control-label">Nama Perusahaan</label>
                        <div class="col-sm-7">
                            <?php echo form_input($company); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="art_img_caption" class="col-sm-3 control-label">Tentang Perusahaan</label>
                        <div class="col-sm-7">
                            <?php echo form_textarea($company_desc); ?>
                        </div>
                    </div>
                <!--</div>-->
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="box-tools text-center">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('member'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
            </div>
        </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
    </div><!-- /.box -->
</section><!-- /.content -->