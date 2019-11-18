<div class="page-title">                    
    <h2><span class="fa fa-desktop"></span> Administration Dashboard</h2>
</div><!-- Main content -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">                                
                <div class="panel-body">
                    <div class="alert alert-info alert-dismissable">
                        Selamat Datang, <?php echo $this->ion_auth->user()->row()->first_name; ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>