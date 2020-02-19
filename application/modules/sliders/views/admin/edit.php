<!-- Toolbars -->
<h2 class="section-title">Add New Slide</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/sliders'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Sliders&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $count_data; ?></span></a>
    </div>
</div>
</br>

<!-- Main content -->
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <?php echo form_open(uri_string()); ?>
            <div class="form-group">
                <label for="sld_title" class="control-label">Title</label>
                <?php echo form_input($sld_title); ?>
            </div>
            <div class="form-group">
                <label for="sld_text1" class="control-label">Slide Text 1</label>
                <?php echo form_input($sld_text1); ?>
            </div>
            <div class="form-group">
                <label for="sld_text2" class="control-label">Slide Text 2</label>
                <?php echo form_input($sld_text2); ?>
            </div>
            <div class="form-group">
                <label for="sld_link" class="control-label">Slide Button Link</label>
                <?php echo form_input($sld_link); ?>
            </div>
            </div><!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('admin/sliders'); ?>"><i class="fa fa-undo"></i> Batal</a>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.box -->
    </div><!-- /.box -->
</div><!-- /.content -->