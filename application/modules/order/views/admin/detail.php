<div class="page-title">                    
    <h2><span class="fa fa-shopping-cart"></span> Detail Order <?php echo $order->vcordercode; ?></h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/order'); ?>">
                        <i class="fa fa-list"></i>&nbsp;&nbsp;All Orders&nbsp;&nbsp;&nbsp;</a>
                    <!-- <a class="btn btn-sm btn-default btn-flat" href="<?php // echo base_url('admin/order/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Orders</a> -->
                </div>
                <div class="panel-body">
                    <h3 class="heading">Summary</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="heading">Nama Customer</h4> 
                        </div>
                        <div class="col-md-1">
                            <h4 class="heading">:</h4> 
                        </div>
                        <div class="col-md-7">
                            <h4><?php echo $order->vcmembername; ?></h4> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="heading">Alamat</h4>                            
                        </div>
                        <div class="col-md-1">
                            <h4 class="heading">:</h4> 
                        </div>
                        <div class="col-md-7">
                            <h4><?php echo $order->vcmemberalamat; ?></h4> 
                        </div>
                    </div>
                    <br />
                    <h3 class="heading"> Detail Order</h3>
                    <div class="box-body table-responsive">
                         <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="50">#</th>
                                    <th>Nama Barang</th>
                                    <th width="110" class="text-center">Qty</th>
                                    <th width="150" class="text-right">Harga</th>
                                    <th width="140" class="text-right">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($order_detail)) {
                                    foreach ($order_detail as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td>';
                                        echo '<strong>' . $value->vcnamaproduct . '</strong>';
                                        echo '</td>';
                                        echo '<td class="text-center">' . number_format($value->intqty, 2) . '</td>';
                                        echo '<td class="text-right">' . number_format($value->decprice, 2) . '</td>';
                                        echo '<td class="text-right">' . number_format($value->dectotalprice, 2) . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="5"><span class="text-danger">Tidak ada data</span></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                if (!empty($order_detail)) {
                                    echo '<tr>';
                                    echo '<td colspan="4" class="text-right"><strong>Total</strong></td>';
                                    echo '<td class="text-right"><strong>' . number_format($order->dectotal, 2) . '</strong></td>';
                                    echo '</tr>';
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="4" class="text-right"><strong>Total</strong></td>';
                                    echo '<td class="text-right"><strong>0</strong></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tfoot>

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