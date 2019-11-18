<div class="page-title">                    
    <h2><span class="fa fa-plus-square"></span> Tambah Usaha User</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-warning" href="<?php echo base_url('admin/binary/approval'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Approval</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <div class="row">
                        <h2 class="text-info">Info</h2>
                        <p>Pilih Username member yang akan di buat titik usaha.</p>
                        <br />
                        <div class="form-group">
                            <label for="user_id" class="col-sm-2 control-label">Pilih Username</label>
                            <div class="col-sm-5">
                                <?php echo form_dropdown('user_id', $data_user, $user_id_val, $user_id); ?>
                                <span class="help-block text-danger">Username Otomatis terisi dari system. Jangan Diganti.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usaha_id" class="col-sm-2 control-label">Pilih Upline</label>
                            <div class="col-sm-5">
                                <?php echo form_dropdown('usaha_id', $data_usaha, '0', $usaha_id); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 col-md-offset-2"><button type="submit" class="btn btn-md btn-default btn-info"><i class="fa fa-check-circle"></i> Approve</button></div>
                        </div>
                        <br />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>