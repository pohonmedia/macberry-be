<div class="page-title">                    
    <h2><span class="fa fa-clipboard"></span> Reward Summary</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-4">
            <div class="widget widget-info widget-padding-sm">
                <div class="widget-int"><?php echo 'Rp. ' . number_format($user_info->reward_total, 2); ?></div>
                <div class="widget-title">Total Reward</div>
                <div class="widget-subtitle">Dari semua titik usaha anda</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-warning widget-padding-sm">
                <div class="widget-int">Rp. <?php echo number_format($user_info->wd_total, 2); ?></div>
                <div class="widget-title">Total Withdrawal</div>
                <div class="widget-subtitle">Di akun anda</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">	 
                    <h3 class="panel-title"><i class="fa fa-sitemap"> </i> History Reward Anda</h3>
                </div>                                
                <div class="panel-body">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="35">#</th>
                                <th class="text-center" width="80">Trans ID</th>
                                <th class="text-center" width="100">Nominal</th>
                                <th class="text-center" width="80">Type</th>
                                <th class="text-center" width="80">Status</th>
                                <th class="text-center" width="70">Tgl Trans</th>
                                <th class="text-center" width="120">Catatan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>