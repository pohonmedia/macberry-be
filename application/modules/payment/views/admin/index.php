<div class="page-title">                    
    <h2><span class="fa fa-money"></span> List All Payment</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/payent'); ?>">
                        <i class="fa fa-list"></i>&nbsp;&nbsp;All Payment&nbsp;&nbsp;&nbsp;</a>
                    <!-- <a class="btn btn-sm btn-default btn-flat" href="<?php // echo base_url('admin/order/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Orders</a> -->
                </div>
                <div class="panel-body">
                    <div>
                        <?php echo form_open(uri_string()); ?>
                        <div class="input-group">
                            <input type="text" name="order_search" class="form-control input-sm pull-right" placeholder="Search by Order Code">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-md btn-default btn-flat"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <?php
                        if (!empty($search)) {
                            ?>
                            <div class="input-group">
                                <p class="help-block">Search query : <strong>"<?php echo $search; ?>"</strong></p>
                            </div>
                        <?php } ?>
                        </form>
                    </div>
                    <br />

                    <div class="box-body table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                         <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="50">#</th>
                                    <th width="140">Tanggal Payment</th>
                                    <th width="110">Kode Order</th>
                                    <th width="150" class="text-right">Total Order</th>
                                    <th width="140" class="text-center">Status Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td>' . mdate('%d-%m-%Y %H:%i:%s', strtotime($value->dttglpayment)) . '</td>';
                                        echo '<td>';
                                        echo '<strong>' . $value->vcordercode . '</strong><br />';
                                        echo '</td>';
                                        echo '<td class="text-right">' . number_format($value->dectotalpayment, 2) . '</td>';
                                        echo '<td class="text-center">';
                                        if($value->intstatusbayar == 0) {
                                            echo '<span class="label label-danger">' . $value->vcstatusbayar . '</span>';
                                        } else if($value->intstatusbayar == 1) {
                                            echo '<span class="label label-info">' . $value->vcstatusbayar . '</span> - ';
                                            echo ' <a class="label label-danger" href="' . base_url('admin/order/detail/' . $value->id) . '"><i class="fa fa-check"></i> Confirm</a>';
                                        } else if($value->intstatusbayar == 2) {
                                            echo '<span class="label label-success">' . $value->vcstatusbayar . '</span>';
                                        } else {
                                            echo '<span class="label label-primary">' . $value->vcstatusbayar . '</span>';
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="8"><span class="text-danger">Tidak ada data</span></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <?php
                        if (!empty($template['partials']['pagination'])) {
                            echo $template['partials']['pagination'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>