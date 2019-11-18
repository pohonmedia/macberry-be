<section class="content">
    <!-- Default box -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Data Pengguna</h3>
        </div>
        <div class="box-body">
            <div class="col-sm-offset-2" style="margin-bottom: 20px"><?php echo $message; ?></div>
            <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
            <!--nama lengkap-->
            <div class="form-group">
                <label for="first_name" class="col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-5">
                    <?php echo form_input($first_name); ?>
                </div>
            </div>
            <!--email-->
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-5">
                    <?php echo form_input($email); ?>
                </div>
            </div>
            <!--password-->
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password (Jika Ganti)</label>
                <div class="col-sm-5">
                    <?php echo form_input($password); ?>
                </div>
            </div>
            <!--password confirm-->
            <div class="form-group">
                <label for="password_confirm" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-xs-5">
                    <?php echo form_input($password_confirm); ?>
                </div>
            </div>
            <?php if ($this->ion_auth->is_admin()): ?>
                <div class="form-group">
                    <label for="groups" class="col-sm-2 control-label">Group Pengguna</label>
                    <div class="col-sm-5">
                        <?php foreach ($groups as $group): ?>
                            <div class="checkbox">
                                <label>
                                    <?php
                                    $gID = $group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach ($currentGroups as $grp) {
                                        if ($gID == $grp->id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                    <?php echo htmlspecialchars(strtoupper($group['name']), ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>

            <?php echo form_hidden('id', $user->id); ?>
            <?php echo form_hidden($csrf); ?>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="box-tools">
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div>
            </div>
        </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
    </div><!-- /.box -->
</section><!-- /.content -->