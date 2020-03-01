<div class="container mt-150 p-5" style="background-color:#f9f9f9; border-radius:10px;">
        <div class="row">
            <!-- checkout tabs start here -->
            <section id="checkout-tabs" class="c-checkout-tabs col-lg-8 col-12">

                <div class="card text-capitalize">
                    <a href="#collapseProduk" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseProduk">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="p-2">
                                    <p>
                                        detail produk
                                    </p>
                                </div>
                                <div class="px-2 pb-2">
                                    <i class="fas fa-lg fa-sort-down"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- content start here -->
                <div class="collapse" id="collapseProduk">
                    <div class="card card-body mt-4 p-4" style="box-shadow:unset !important;">
                        <p class="text-capitalize px-2 py-3">detail pesanan</p>
                        <div class="content">

                            <div class="media ">
                            <?php 
                            $total = 0;
                            if(!empty($cart)) {
                                
                                echo '<div class="row">';
                                foreach ($cart as $items) {
                                    echo '<div class="col-lg-3 col-12">';
                                    echo '<img src="' . base_url($items['img']->prod_img_url) . '" class="mr-3" alt="gambar barang">';
                                    echo '</div>';
                                    
                                    echo '<div class="col-lg-9 col-12">';
                                    echo '<div class="media-body">';
                                    echo '<p class="mt-0 text-capitalize" style="font-size:16px">' . $items['qty'] . ' x ' . $items['name'] . ' (IDR ' . number_format($items['price']) . ')</p>';
                                    echo '<div class="text-capitalize pt-2" style="font-size:16px; opacity:0.8">';
                                    echo 'Ram ( ' . $items['detail']->spec_ram . '), Storage ( ' . $items['detail']->spec_storage . ' ), Color ( ' . $items['detail']->spec_color . ' ), Size ( ' . $items['detail']->spec_dimension . ' )';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';

                                    // echo '<input style="padding:5px" width="500" type="number" class="item-qty" value="' . intval($items['qty']) . '">';  
                                    // echo '<input type="hidden" class="item-rowid" name="rowid"' . $items['id'] .'" . value="'. $items['rowid'] . '">';
                                    // echo '</td>';
                                    // echo '<td class="text-right">';
                                    // echo number_format($items['price'], 2); 
                                    // echo '</td>';
                                    // echo '<td class="text-right">'; 
                                    // echo number_format($items['qty']* $items['price'], 2) ; 
                                    // echo '</td>'; 
                                    // echo '<td class="text-center">'; 
                                    // echo '<a href="' . base_url() . 'order/delete/' . $items['rowid'] . '" class="fa fa-trash-o"></a>'; 
                                    // echo '</td>'; 
                                    // echo '</tr>';
                                    
                                    $total += ($items['qty']*$items['price']);
                                }
                                echo '</div>'; 
                            } else {
                                $total = 0;
                                echo '<h6 style="margin-left:10px;color: grey">';
                                echo 'Cart Kosong';
                                echo '</h6>';
                            }
                            ?>
                            </div>

                            <form class="pl-2">
                                <div class="row">
                                    <div class="col-12 pt-4">
                                        <label for="inputNama" class="text-capitalize">catatan untuk penjual</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan catatan"></textarea>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    <!-- content end here -->

                </section>
                <!-- checkout tabs end here -->

                <!-- order pricing start here -->
                <section id="checkoutpricing" class="c-checkout-pricing col-lg-4 col-12">

                    <div class="card text-capitalize">
                        <div class="card-body">

                            <p class="pt-2 pb-1">detail pesanan</p>
                            <hr>

                            <div class="d-flex align-items-center justify-content-between" style="letter-spacing:0.5px; font-size:14px;">
                                <div class="p-1">harga barang&nbsp;:
                                </div>
                                <div class="p-1">IDR <?php echo number_format($total); ?></div>
                            </div>
                            <hr>

                            <div class="d-flex align-items-center justify-content-between pt-2 font-weight-bolder" style="letter-spacing:0.5px; font-size:16px;">
                                <div class="p-1">total harga&nbsp;:
                                </div>
                                <div class="p-1">IDR <?php echo number_format($total); ?></div>
                            </div>

                            <a href="<?php echo base_url('order/payment'); ?>" class="c-btn-primary w-100 mt-4">
                                lanjutkan pemesanan
                            </a>
                            <a href="<?php echo base_url('catalogs'); ?>" class="c-btn-primary btn-danger w-100 mt-4">
                                Lanjut Belanja
                            </a>
                            <a href="<?php echo base_url('order/delete/all'); ?>" class="c-btn-primary btn-danger w-100 mt-4">
                                Kosongkan Cart
                            </a>

                        </div>
                    </div>

                </section>
                <!-- order pricing end here -->

            </div>

        </div>