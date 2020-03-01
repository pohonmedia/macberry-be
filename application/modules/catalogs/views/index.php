<section id="header">
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light c-header">
        <div class="row">
            <div class="col-md-7 p-lg-5 mr-auto my-5 pb-5 text-left">
                <h1 class="display-4 font-weight-normal pb-3 text-capitalize">explore our product</h1>
                <p class="font-weight-normal pb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia placeat sunt delectus, atque eum sapiente veritatis velit fuga aperiam error voluptatem eligendi magni.</p>
                <a class="c-btn-primary" href="#">Coming soon</a>
            </div>
            <div class="col-md-5">
                <img src="<?php echo $theme_assets . 'img/showcase-2.png'; ?>" alt="product-image header">
            </div>
        </div>
    </div>
</section>
<!-- promo start here -->
<section id="discount-product" class="discount-product pt-50 c-product-promo">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-discount-product mt-0">
                    <div class="product-image">
                        <img src="<?php echo $theme_assets . 'img/showcase-1.png'; ?>" alt="Product" style="object-fit:cover;">
                    </div>
                    <!-- product image -->
                    <div class="product-content">
                        <h4 class="content-title mb-15">our brand new promo</h4>
                        <a href="#">View Collection
                        </a>
                    </div>
                    <!-- product content -->
                </div>
                <!-- single discount product -->
            </div>
            <div class="col-lg-6">
                <div class="single-discount-product mt-30">
                    <div class="product-image">
                        <img src="<?php echo $theme_assets . 'img/iphone-3.jpg'; ?>" alt="Product">
                    </div>
                    <!-- product image -->
                    <div class="product-content">
                        <h4 class="content-title mb-15">High-quality accessories</h4>
                        <a href="#">View Collection
                        </a>
                    </div>
                    <!-- product content -->
                </div>
                <!-- single discount product -->
            </div>
            <div class="col-lg-6">
                <div class="single-discount-product mt-30">
                    <div class="product-image">
                        <img src="<?php echo $theme_assets . 'img/macbook-1.jpg'; ?>" alt="Product">
                    </div>
                    <!-- product image -->
                    <div class="product-content">
                        <h4 class="content-title mb-15">Hot Offer
                            <br>
                            Discount up to 80%</h4>
                        <a href="#">View Collection
                        </a>
                    </div>
                    <!-- product content -->
                </div>
                <!-- single discount product -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- promo end here -->

<section id="product-header" class="mt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-capitalize">our product list</h3>
                <br>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, minus reiciendis. Enim quo.
                </p>
            </div>
            <div class="col-lg-6">
                <form>
                    <div class="row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control" placeholder="Cari produk..."></div>
                        <div class="col-lg-5">
                            <select class="form-control">
                                <option value="1">Produk second</option>
                                <option value="2">Produk baru</option>
                                <option value="3">lain lain</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<section id="product-list" class="c-product-list">
    <div class="container">
        <div class="row">
            <?php
				foreach ($catalogs as $key => $value) {
					echo '<div class="col-lg-4 col-md-6">';
					echo '<div class="single-product mt-30">';
					
					echo '<div class="product-image">';
					echo '<img src="' . $value->img_thumb . '" alt="product img">';
					echo '</div>';
					
					echo '<div class="product-content">';
					echo '<div class="content">';
					
                    // echo '<div class="row justify-content-between pt-10">';
					// echo '<div class="col-12">';
					// echo '<span style="font-size:20px; color:#ffa500;">';
					// echo '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
					// echo '</span>';
					// echo '</div>';
					// echo '</div>';
								
					echo '<div class="row">';
					echo '<div class="col-12">';
					echo '<h6 class="pt-10 pb-15 text-capitalize">' . character_limiter(strip_tags($value->prod_name), 50) . '</h6>';
					echo '<p>';
					echo character_limiter(strip_tags($value->prod_desc), 100);
					echo '</p>';
					echo '</div>';
					echo '<div class="col-lg-6 col-6">';
					echo '<span class="pt-20 text-capitalize">';
					echo '<small >harga</small>';
					echo '</span>';
					echo '<h3 style="letter-spacing:1px; color: #212121;">';
					echo number_format($value->prod_price);
					echo '</h3>';
					echo '</div>';
					echo '<div class="col-lg-6 col-6">';
					echo '<a href="' . base_url('catalogs/product/' . $value->id) . '" class="c-btn-cart text-capitalize mt-20 ml-80" type="submit" style="letter-spacing:0.5px;">';
					echo '<i class="fas fa-shopping-cart"></i>';
					echo '</a>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo ' </div>';

					echo '</div>';
					echo '</div>';
				}
			?>
        </div>
    </div>
</div>