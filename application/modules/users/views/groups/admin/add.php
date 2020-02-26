<h2 class="section-title">Add New Group</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" style="margin-right: 5px;" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Groups&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
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
                    <label for="group_name" class="control-label">Nama Group</label>
                    <?php echo form_input($group_name); ?>
                </div>
                <!--desc-->
                <div class="form-group">
                    <label for="description" class="control-label">Deskripsi</label>
                    <?php echo form_input($description); ?>
                </div>
                </div>
            </div>
        </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create</button>
                <a class="btn btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->