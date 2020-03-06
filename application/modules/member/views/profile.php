<h2 class="section-title">Profil Saya</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open_multipart(uri_string()); ?>
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
                        <label for="phone" class="control-label">Telepon/ HP</label>
                        <?php echo form_input($phone); ?>
                    </div>
                    <!-- <div class="form-group">
                        <label for="art_img_caption" class="control-label">Nama Perusahaan</label>
                        <?php // echo form_input($company); ?>
                    </div>
                    <div class="form-group">
                        <label for="art_img_caption" class="control-label">Tentang Perusahaan</label>
                        <?php // echo form_textarea($company_desc); ?>
                    </div> -->
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
            <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('member'); ?>"><i class="fa fa-undo"></i> Batal</a>
        </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->