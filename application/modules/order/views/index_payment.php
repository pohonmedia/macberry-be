<div id="content">
	<div class="container">
		<div class="row">
			<div id="checkout" class="col-lg-9">
				<div class="box border-bottom-0">
					<form method="post" action="<?php echo base_url('order/checkout');?>">
						<div class="content">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="firstname">Firstname</label>
										<input name="vcfname" id="firstname" type="text" class="form-control">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="lastname">Lastname</label>
										<input name="vclname" id="lastname" type="text" class="form-control">
									</div>
								</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="company">Street</label>
											<input name="vcstreet" id="company" type="text" class="form-control">
										</div>
									</div>
									<input type="hidden" name="ongk" id="ongk">
					                <div class="col-sm-6">
										<div class="form-group">
									  		<label for="selectprop">State</label>
									  		<select name="vcstate" class="form-control" id="selectprop">
									  			<?php
													foreach($province as $val) {
														echo '<option name='.$val['province'].' value="'. $val['province_id'].'">'.$val['province'].'</option>';
													}
												?>
											</select>
											
										</div>

									</div>
									<input type="hidden" name="nama_state" id="nama_state">
									<input type="hidden" name="nama_city" id="nama_city">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="city">City</label>
											<select name="vccity" class="form-control" id="selectcity">
												<?php
												?>
											</select>
										</div>
									</div>
		                      		<div class="col-sm-12">
										<div id="jnetype">
											<!-- <div class="form-group col-sm-12">
												<label style="margin-right: 10px"><input type="radio" name="optradio" value="2000"> Option 1</label>
											</div>
											<div class="form-group col-sm-12">
												<label style="margin-right: 10px"><input type="radio" name="optradio"> Option 2</label>
											</div>
											<div class="form-group col-sm-12">
												<label style="margin-right: 10px"><input type="radio" name="optradio"> Option 3</label>
											</div> -->
			                      		</div>
		                      		</div>
		                      		<div class="col-sm-3">
		                        		<div class="form-group">
					                    	<label for="phone">Telephone</label>
					                        <input name="inttelephone" id="phone" type="text" class="form-control">
		                       			</div>
		                      		</div>
		                      		<div class="col-sm-3">
		                        		<div class="form-group">
		                          			<label for="email">Email</label>
											<input name="vcemail" id="email" type="text" class="form-control">
										</div>
									</div>
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
									<th id="ongkir"><b>Rp. 0</b></th>
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
</div>