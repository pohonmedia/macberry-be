<!-- Toolbars -->
<section class="content-header">
    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/widgets'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Widgets&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo $count_data; ?></span></a>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Widget Sertting Form</h3>
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