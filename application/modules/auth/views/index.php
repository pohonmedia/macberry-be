<div class="login-container">

    <div class="login-box animated fadeInDown">
         <div class="login-logo"></div> 
        <div class="login-body">
            <div class="login-title text-center"><strong>Administration Login</strong></div>
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <form action="<?php echo base_url('auth/login');?>" class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" name="identity" class="form-control" placeholder="Username"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                </div>
                <?php echo form_hidden('ref_form', 'admin'); ?>
                <div class="form-group">
                    <div class="col-md-6">
                        <a href="<?php echo base_url('auth/forgot');?>" class="btn btn-link btn-block">Forgot your password?</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info btn-block">Log In</button>
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