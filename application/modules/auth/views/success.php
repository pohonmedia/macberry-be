<div class="login-container">

    <div class="login-box animated fadeInDown">
        <div class="login-logo"></div> 
        <div class="login-body">
            <div class="login-title"><strong>Success</strong></div>
            <div class="login-title-small">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            </div>
            <div class="text-center">
                <a href="<?php echo base_url('member'); ?>">JualBeliPlus.com</a>
            </div>
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