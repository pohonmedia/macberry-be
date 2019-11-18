<?php echo form_open("users/login"); ?>
<?php if (!empty($message)) { ?>
    <div id="infoMessage" class="alert alert-danger"><?php echo $message; ?></div>
<?php } ?>
<div class="form-group has-feedback">
    <input type="text" name="identity" class="form-control" placeholder="Username" required="" />
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
    <input type="password" name="password" class="form-control" placeholder="Password" required="" />
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<?php echo form_hidden('ref_form', 'users'); ?>
<div class="row">
    <div class="col-xs-8">
        <a class="reset_pass pull-left" href="#" style="margin: 10px 0px 0px 0px;">Lost your password?</a>
    </div><!-- /.col -->
    <div class="col-xs-4">
        <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary btn-block btn-flat"'); ?>
    </div><!-- /.col -->
</div>
<br />
<div class="social-auth-links text-center">
    <small>Teamworks CMS <span class="label label-danger">beta</span> v 0.2110.2015</small>

    <p>&copy; 2015 <a href="<?php echo base_url(); ?>">KapalSurabaya.com</a></p>
</div><!-- /.social-auth-links -->
<?php echo form_close(); ?>
<!-- form -->
