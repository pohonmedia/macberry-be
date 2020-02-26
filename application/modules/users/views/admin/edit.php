<h2 class="section-title">Edit Users</h2>
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
                    <label for="art_title" class="control-label">Nama Lengkap</label>
                    <?php echo form_input($first_name); ?>
                </div>
                <div class="form-group">
                    <label for="art_content" class="control-label">Email</label>
                    <?php echo form_input($email); ?>
                </div>
                <div class="form-group">
                    <label for="art_img" class="control-label">Password (Jika Ganti)</label>
                    <?php echo form_input($password); ?>
                </div>
                <div class="form-group">
                    <label for="art_img_caption" class="control-label">Password Confirm</label>
                    <?php echo form_input($password_confirm); ?>
                </div>
                <?php if ($this->ion_auth->is_admin()): ?>
                    <div class="form-group">
                        <label for="groups" class="control-label">Group Pengguna</label>
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
                                        <?php echo htmlspecialchars(ucwords($group['name']), ENT_QUOTES, 'UTF-8'); ?>
                                    </label>
                                </div>
                            <?php endforeach ?>
                    </div>
                <?php endif ?>

                <?php echo form_hidden('id', $user->id); ?>
                <?php echo form_hidden($csrf); ?>
                </div>
            </div>
        </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                <a class="btn btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->