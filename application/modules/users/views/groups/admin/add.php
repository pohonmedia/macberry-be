<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Groups&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo $count_data; ?></span></a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Group</h3>
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
                    <label for="group_name" class="col-sm-2 control-label">Nama Group</label>
                    <div class="col-sm-5">
                        <?php echo form_input($group_name); ?>
                    </div>
                </div>
                <!--desc-->
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Deskripsi</label>
                    <div class="col-sm-5">
                        <?php echo form_input($description); ?>
                    </div>
                </div>
                <!--</div>-->
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="box-tools">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Create</button>
                <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
            </div>
        </div> <!--/.box-footer-->
        <?php echo form_close(); ?>
    </div><!-- /.box -->
</section><!-- /.content -->