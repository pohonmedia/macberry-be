<div class="page-title">                    
    <h2><span class="fa fa-bank"></span> Daftar Akun Bank</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">   
                <div class="panel-heading">
                    <a class="btn btn-sm btn-info" href="<?php echo base_url('member/account/bank/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Tambah Bank</a>
                </div>                             
                <div class="panel-body">
                    <div class="row table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="35">#</th>
                                    <th class="text-center"  width="100">Nama Bank</th>
                                    <th class="text-center"  width="100">Cabang</th>
                                    <th class="text-center" width="100">No Rekening</th>
                                    <th class="text-center" width="150">Pemilik</th>
                                    <th class="text-center" width="70">Default</th>
                                    <th class="text-center" width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td class="text-center"><b>' . $value->bank_name . '</b></td>';
                                        echo '<td class="text-center"><b>' . $value->bank_cabang . '</b></td>';
                                        echo '<td class="text-center"><b>' . $value->bank_norek . '</b></td>';
                                        echo '<td class="text-center"><b>' . $value->bank_pemilik_name . '</b></td>';
                                        echo '<td class="text-center">';
                                        if ($value->is_default == 1) {
                                            echo '<i class="fa fa-check-circle text-success"></i>';
                                        } else {
                                            echo '<a href="' . base_url('member/account/bank/publish/' . $value->id) . '"><i class="fa fa-minus-circle text-danger"></i></a>';
                                        }
                                        echo '</td>';
                                        echo '<td class="text-center small">'
                                        . ' <a class="text-info" href="' . base_url('member/account/bank/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;'
                                        . ' <a class="text-danger" href="' . base_url('member/account/bank/del/' . $value->id) . '"><i class="fa fa-minus-circle"></i> Delete</a></td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="7"><span class="text-danger">Tidak ada data</span></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <?php $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</div>