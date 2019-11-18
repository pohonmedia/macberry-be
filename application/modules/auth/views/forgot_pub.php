<div class="login-container">

    <div class="login-box animated fadeInDown">
        <div class="login-logo"></div> 
        <div class="login-body">
            <div class="login-title"><strong>Forgot Password</strong></div>
            <div class="login-title-small">Masukkan <b>username</b> yang valid untuk melakukan reset password.</div>
            <?php
            if (!empty($msg)) {
                echo '<ul class="text-danger" style="margin:0px 0px 5px 0px;padding:0px">';
                echo $msg;
                echo '</ul>';
            }
            ?>
            <form action="<?php echo base_url('auth/forgot'); ?>" class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <?php echo form_input($username); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        &nbsp;
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="text-center">
                &copy; 2016 JualBeliPlus.com
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>

</div>