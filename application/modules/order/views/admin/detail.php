<h2 class="section-title"><span class="fa fa-shopping-cart"></span> Detail Order <?php echo $order->vcordercode; ?></h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info btn-flat" href="<?php echo base_url('admin/order'); ?>"> <i class="fa fa-list"></i>&nbsp;&nbsp;All Orders&nbsp;&nbsp;&nbsp;</a>
    </div>
</div>
</br>
<div class="invoice">
        <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
            <div class="invoice-title">
                <h2>Invoice</h2>
                <div class="invoice-number">Order #<?php echo $order->vcordercode; ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                <address>
                    <strong>Billed To:</strong><br>
                    <?php echo $order->vcmembername; ?><br>
                    <?php echo $order->vcmemberalamat; ?><br>
                    {vckota_member}
                </address>
                </div>
                <div class="col-md-6 text-md-right">
                <address>
                    <strong>Shipped To:</strong><br>
                    <?php echo $order->vcnama_shipping . ' (' . $order->vchp_shipping . ')'; ?><br>
                    <?php echo $order->vcalamat_shipping; ?><br>
                    {vckota_shipped}
                </address>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-md-left">
                <address>
                    <strong>Order Date:</strong><br>
                    <?php echo mdate("%d %F %Y", strtotime($order->dtorderdate)); ?><br>
                </address>
                </div>
            </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
            <div class="section-title">Order Summary</div>
            <p class="section-lead">All items here cannot be deleted.</p>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md">
                <tr>
                    <th data-width="40">#</th>
                    <th>Item</th>
                    <th class="text-right">Price (IDR)</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Totals (IDR)</th>
                </tr>
                <?php
                    if (!empty($order_detail)) {
                        foreach ($order_detail as $key => $value) {
                            echo '<tr>';
                            echo '<td class="text-center">' . ($key + 1) . '</td>';
                            echo '<td>';
                            echo '<strong>' . $value->vcnamaproduct . '</strong>';
                            echo '</td>';
                            echo '<td class="text-right">' . number_format($value->decprice, 2) . '</td>';
                            echo '<td class="text-center">' . number_format($value->intqty, 2) . '</td>';
                            echo '<td class="text-right">' . number_format($value->dectotalprice, 2) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="5"><span class="text-danger">Tidak ada data</span></td>';
                        echo '</tr>';
                    }
                ?>
                </table>
            </div>
            <div class="row mt-4">
                <div class="col-lg-8">
                <div class="section-title">Payment Method</div>
                <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p>
                <p class="section-lead">
                    <strong> BCA 456.071.2893 </strong>
                    <br>
                    <strong> MANDIRI 137.000.624.9631 </strong>
                    <br>
                    Atas Nama : RB Ide Winarswasepta
                </p>
                
                <!-- 
                <div class="d-flex">
                    <div class="mr-2 bg-visa" data-width="61" data-height="38"></div>
                    <div class="mr-2 bg-jcb" data-width="61" data-height="38"></div>
                    <div class="mr-2 bg-mastercard" data-width="61" data-height="38"></div>
                    <div class="bg-paypal" data-width="61" data-height="38"></div>
                </div>
                -->
                </div>
                <div class="col-lg-4 text-right">
                <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Subtotal</div>
                    <div class="invoice-detail-value"><?php echo number_format($order->dectotal, 2); ?></div>
                </div>
                <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Shipping</div>
                    <div class="invoice-detail-value"><?php echo number_format($order->decshipping, 2);?></div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Total</div>
                    <div class="invoice-detail-value invoice-detail-value-lg"><?php echo number_format($order->dectotal + $order->decshipping, 2); ?></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <hr>
        <div class="text-md-right">
        <!-- <div class="float-lg-left mb-lg-0 mb-3">
            <button class="btn btn-primary btn-icon icon-left" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-credit-card"></i> Konfirmasi Pembayaran </button>
        </div> -->
        <!-- <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button> -->
        </div>
    </div>
</div>