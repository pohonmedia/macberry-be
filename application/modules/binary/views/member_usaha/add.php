<div class="page-title">                    
    <h2><span class="fa fa-plus-square"></span> Tambah Usaha</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-warning" href="<?php echo base_url('member/binary/usaha'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Titik Usaha Saya</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>

                    <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
                    <div class="row">
                        <?php if ($user_info->saldo_total >= 40000) { ?>
                            <?php echo form_hidden('user_id', $user_info->id); ?>
                            <div class="form-group">
                                <div class="col-sm-6 col-md-offset-1">
                                    <h2 class="text-info">Info</h2>
                                    <p>Klik tombol di bawah untuk membuat dan memulai usaha anda.</p>
                                    <br />
                                    <button type="submit" class="btn btn-lg btn-default btn-info"><i class="fa fa-play-circle"></i> Mulai Usaha</button>
                                </div>
                            </div>
                            <br />
                        <?php } else { ?>
                            <div class="form-group">
                                <div class="col-sm-6 col-md-offset-1">
                                    <h2 class="text-danger">Warning</h2>
                                    <p>Saldo anda tidak mencukupi untuk membuat Usaha Baru. Topup saldo terlebih dahulu.</p>
                                    <br />
                                    <a class="btn btn-lg btn-default btn-info" href="<?php echo base_url('member/account/balance'); ?>"><i class="fa fa-dollar"></i>&nbsp;&nbsp;Topup Saldo</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>