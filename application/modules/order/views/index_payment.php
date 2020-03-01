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
					<ul class="timeline">
						<li>
							<h5>detail barang</h5>
							<div class="content">
								<div class="media">
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
							</div>
						</li>

						<li class="pt-5">
							<h5>alamat pengiriman</h5>
							<div class="content">
								<form>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label for="inputNama">nama penerima</label>
												<input type="text" class="form-control" id="inputNama" placeholder="Masukan nama lengkap">
											</div>
										</div>
										<div class="col-6">
											<label for="inputNama">nomor telefon/ hp</label>
											<input type="text" class="form-control" id="inputNama" placeholder="Masukan Nomor Telp">
										</div>
										<div class="col-12 pt-3">
											<label for="inputNama">alamat</label>
											<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan alamat"></textarea>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="vcstate">Propinsi</label>
												<select name="vcstate" class="form-control" id="selectprop">
													<?php
														foreach($province as $val) {
															echo '<option name='.$val['province'].' value="'. $val['province_id'].'">'.$val['province'].'</option>';
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<label for="vccity">Kota</label>
											<select name="vccity" class="form-control" id="selectcity">
												<?php
												?>
											</select>
										</div>
									</div>	
								</form>
							</div>
						</li>

						<li class="pt-5">
							<h5>detail kurir</h5>
							<div class="content">
								<!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item text-center">
										<a class="nav-link active p-3" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">

											<img src="<?php echo $theme_assets . 'img/kurir-1.png'; ?>" alt="gambar kurir">

										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">

											<img src="<?php echo $theme_assets . 'img/kurir-2.png'; ?>" alt="gambar kurir">

										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
											<img src="<?php echo $theme_assets . 'img/kurir-3.png'; ?>" alt="gambar kurir">
										</a>
									</li>
								</ul> -->

								<div class="col-12 pt-3">
									<div id="jnetype"></div>
								</div>


							</div>
						</li>
					</ul>

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
                        <div class="p-1">harga barang&nbsp;:</div>
                        <div class="p-1" id="subtotal" data="<?php echo $total;?>">IDR <?php echo number_format($total, 2); ?></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between" style="letter-spacing:0.5px; font-size:14px;">
                        <div class="p-1">ongkos kirim&nbsp;:</div>
                        <div class="p-1" id="ongkir">IDR 0</div>
                    </div>
                    <hr>

                    <div class="d-flex align-items-center justify-content-between pt-2 font-weight-bolder" style="letter-spacing:0.5px; font-size:16px;">
                        <div class="p-1">total harga&nbsp;:</div>
                        <div class="p-1">IDR <span id="total-value">0</span></div>
                    </div>

                    <button type="submit" class="c-btn-primary w-100 mt-4">bayar sekarang</button>
                    <a href="<?php echo base_url('order/detail'); ?>" class="c-btn-secondary btn-danger w-100 mt-4">Detail Order</a>
                </div>
            </div>
        </section>
        <!-- order pricing end here -->

    </div>
</div>

<!-- <div id="content">
	<div class="container">
		<div class="row">
			<div id="checkout" class="col-lg-9">
				<div class="box border-bottom-0">
					<form method="post" action="<?php echo base_url('order/checkout');?>">
						<div class="content">
							<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
									  		<label for="selmethod">Payment</label>
									  		<select name="vcpayment" class="form-control" id="selmethod">
											    <option>Transfer Bank</option>
											    <option>Cash On Delivery</option>
											</select>
										</div>
									</div>
								</div>
							<div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
								<div class="left-col"><a href="<?php echo base_url('order/detail'); ?>" class="btn btn-template-outlined mt-0"><i class="fa fa-chevron-left">		</i>Back to Order Detail</a>
								</div>
								<div class="right-col">
									<button type="submit" class="btn btn-template-outlined">Review Order<i class="fa fa-chevron-right"></i></button>
								</div>
							</div>
						</div>	
            		</form>
              	</div>
            </div>
			<div class="col-lg-3">
  				<div id="order-summary" class="box mb-4 p-0">
					<div class="box-header mt-0">
						<h3>Rincian Pesanan</h3>
					</div>
					<p class="text-muted text-small">Pengiriman dan biaya tambahan dihitung berdasarkan nilai yang Anda masukkan.</p>
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
									<td>Subtotal</td>
									<th id="subtotal" data="<?php echo $total;?>"><b>Rp. <?php echo number_format ($total, 2);?></b></th>
									</tr>
									<tr>
									<td>Ongkos Kirim</td>
									<th id="ongkirxx"><b>Rp. 0</b></th>
									</tr>
									<tr>
									<td>Total</td>
									<th><b>Rp. <span id="total-value">0</span></b></th>
									</tr>
								</tbody>
							</table>
						</div>
				</div>
			</div>
		</div>
	</div>
</div> -->