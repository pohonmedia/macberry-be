<h2 class="section-title">Add New Users</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" style="margin-right: 5px;" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Users&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
    </div>
</div>
</br>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <?php echo form_open(uri_string()); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name" class="control-label">Nama Lengkap</label>
                        <?php echo form_input($first_name); ?>
                    </div>
                    <div class="form-group">
                        <label for="identity" class="control-label">Username</label>
                        <?php echo form_input($identity); ?>
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
                </div>
            </div>
        </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create</button>
                <a class="btn btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->