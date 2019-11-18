<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Users</h3>
            <div class="box-tools">
                <a class="btn btn-sm btn-flat btn-primary" style="margin-right: 5px;" href="<?php echo base_url('admin/users/create'); ?>"><i class="fa fa-plus-square"></i> Tambah Data</a>
                <div class="input-group pull-right" style="width: 200px;">
                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-default btn-flat"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <div class="col-sm-offset-0" style="margin-bottom: 20px">
                <?php
                if (!empty($message)) {
                    echo $message;
                }
                ?>
            </div>
            <table id="list-users" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama </th>
                        <th>Username </th>
                        <th>Email </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($list)) {
                        foreach ($list as $key => $value) {
                            echo '<tr>';
                            echo '<td>' . ($key + 1) . '</td>';
                            echo '<td>' . strtoupper($value->first_name) . '</td>';
                            echo '<td>' . $value->username . '</td>';
                            echo '<td>' . $value->email . '</td>';
                            echo '<td>'
                            . '<a class="btn btn-xs btn-flat btn-info" href="' . base_url('admin/users/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a> '
                            . '<a class="btn btn-xs btn-flat btn-danger" href="' . base_url('admin/users/del/' . $value->id) . '" onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Hapus</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div><!-- /.box-body -->
        <!--      <div class="box-footer">
                Footer
              </div> /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->