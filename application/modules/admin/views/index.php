<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Dashboard</h3>
            <!--        <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>-->
        </div>
        <div class="box-body">
            <!--            <div class="alert alert-danger alert-dismissable">
                            There's error in form.
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>-->
            <div class="alert alert-info alert-dismissable">
                Selamat Datang, <?php echo $this->ion_auth->user()->row()->first_name; ?>.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            <!--Content Goes Here...-->
        </div><!-- /.box-body -->
        <!--      <div class="box-footer">
                Footer
              </div> /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->