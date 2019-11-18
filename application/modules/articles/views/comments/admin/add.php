<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" style="margin-right: 5px;" href="<?php echo base_url('admin/articles/comments'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Comments&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo $count_data; ?></span></a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Comment</h3>
        </div>
        <div class="box-body">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
        </div><!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div>
    </div><!-- /.box -->
</section><!-- /.content -->