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
            <?php echo form_open(uri_string()); ?>
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="form-group">
                        <label for="first_name" class="control-label">Nama Lengkap</label>
                        <?php echo form_input($first_name); ?>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <?php echo form_input($email); ?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <?php echo form_input($password); ?>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="control-label">Password Confirm</label>
                        <?php echo form_input($password_confirm); ?>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Alamat</label>
                        <?php echo form_input($address); ?>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label">Telepon</label>
                        <?php echo form_input($phone); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_img_caption" class="control-label">Nama Perusahaan</label>
                        <?php echo form_input($company); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_img_caption" class="control-label">Tentang Perusahaan</label>
                        <?php echo form_textarea($company_desc); ?>
                    </div>
                </div>
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