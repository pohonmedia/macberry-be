<?php if ($this->ion_auth->logged_in()) { ?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Members Menu</h3>
    </div>
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            <?php
            echo '<li><a href="' . base_url('member/profile') . '"><span style="padding:0 10px 0 5px;"><i class="fa fa-user"></i></span>Profile</a></li>';
            echo '<li><a href="' . base_url('member/catalogs') . '"><span style="padding:0 8px 0 5px;"><i class="fa fa-cube"></i></span>Product(s)</a></li>';
            echo '<li><a href="' . base_url('auth/logout') . '"><span style="padding:0 10px 0 5px;"><i class="fa fa-sign-out"></i></span>Logout</a></li>';
            ?>
        </ul>
    </div>
</div>
<?php }