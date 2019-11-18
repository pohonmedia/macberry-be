<div class="page-title">                    
    <h2><span class="fa fa-edit"></span> Edit Selected Bank</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('member/bank'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Bank</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <div class="form-group">
                        <label for="bank_name" class="col-sm-2 control-label">Nama Bank</label>
                        <div class="col-sm-5">
                            <?php echo form_dropdown('bank_name', $bank_data, '0', $bank_name); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bank_norek" class="col-sm-2 control-label">No. Rekening</label>
                        <div class="col-sm-5">
                            <?php echo form_input($bank_norek); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bank_pemilik_name" class="col-sm-2 control-label">Pemilik Rekening</label>
                        <div class="col-sm-5">
                            <?php echo form_input($bank_pemilik_name); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bank_cabang" class="col-sm-2 control-label">Cabang</label>
                        <div class="col-sm-5">
                            <?php echo form_input($bank_cabang); ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                    <a class="btn btn-sm btn-flat btn-warning" style="margin-left: 5px;" href="<?php echo base_url('member/bank'); ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div> <!--/.box-footer-->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div class="modal-body" id="modalContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm btn-simple" onclick="return closeModal()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--SCRIPT TAMBAHAN-->
<script>
//SCRIPT TAMBAHAN
    var menuType = '<?php echo $menu_type_val; ?>';
    var linkVal = '<?php echo $menu_url_val; ?>';
</script>