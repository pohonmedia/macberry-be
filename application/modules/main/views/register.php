<section id="main">
    <div class="new-product">
        <h2>Pendaftaran Member</h2>
        <br />
        <?php
        if (!empty($msg)) {
            echo $msg;
        }
        ?>

        <div class="row contact-form">
            <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
            <?php echo form_hidden('ref_code', $referal); ?>
            <div class="form-group">
                <label for="first_name" class="col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-5">
                    <?php echo form_input($first_name); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="identity" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-5">
                    <?php echo form_input($identity); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-5">
                    <?php echo form_input($email); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="card_id" class="col-sm-2 control-label">No Kartu ID</label>
                <div class="col-sm-5">
                    <?php echo form_input($card_id); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">No Telp/ HP</label>
                <div class="col-sm-5">
                    <?php echo form_input($phone); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Alamat Lengkap</label>
                <div class="col-sm-5">
                    <?php echo form_textarea($address); ?>
                </div>
            </div>
            <div class="col-md-offset-2">
                &nbsp;&nbsp;<input name="submit" type="submit" id="submit" value="Daftar">
            </div>
            <?php echo form_close(); ?>
        </div>   
    </div>
    <div class="clearfix"></div>
</section>