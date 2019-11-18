<div class="page-title">                    
    <h2><span class="fa fa-edit"></span> Edit Selected Group</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" style="margin-right: 5px;" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Groups</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <div class="row">
                        <div class="form-group">
                            <label for="group_name" class="col-sm-2 control-label">Nama Group</label>
                            <div class="col-sm-5">
                                <?php echo form_input($group_name); ?>
                            </div>
                        </div>
                        <!--desc-->
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-5">
                                <?php echo form_input($group_description); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>