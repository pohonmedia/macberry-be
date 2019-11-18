<div class="page-title">                    
    <h2><span class="fa fa-key"></span> Change Password</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">                                
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3><span class="fa fa-lock text-danger"></span> Ubah Password</h3>
                    </div>                                    
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                        <div class="row">
                            <!--<div class="col-md-8">-->
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($password); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm" class="col-sm-2 control-label">Password Confirm</label>
                                <div class="col-sm-5">
                                    <?php echo form_input($password_confirm); ?>
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-danger col-md-offset-2"><i class="fa fa-save"></i> Update</button>
                </div> <!--/.box-footer-->
                </form>
            </div>
        </div>
    </div>
</div>
</div>