    <!-- about macberry start here -->
    <section id="service" class="about-us pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-30">
                        <h3 class="title mb-15 text-capitalize">about macberry</h3>
                        <p>MACBERRYSTORE established di Kota Pelajar, Yogyakarta, sebagai salah satu pelopor berdirinya “Warung Gadget Independen” yang secara eksklusif mengusung brand APPLE</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="services-left mt-25">
                        <div class="services">
                            <img src="<?php echo $theme_assets . 'img/img-1.jpg'; ?>" alt="about us" style="max-width: 450px; max-height: 400px; object-fit:cover; border-radius:10px;">
                            <a href="<?php echo base_url('pages/read/about-us'); ?>" class="c-btn-primary mt-30">pelajari lebih lanjut
                                <i class="lni-chevron-right"></i>
                            </a>
                        </div>
                        <!-- services btn -->
                    </div>
                    <!-- services left -->
                </div>
                <div class="col-lg-6 d-none d-md-block d-lg-block">

                    <div class="services-right">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-medal"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Trusted & Recommended</h5>
                                        <p>Terpercaya dan Pengalaman sejak tahun 2009 di dunia Apple.</p>
                                    </div>
                                </div>
                                <!-- single services -->

                                <div class="single-services text-center mt-30 about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">fast response</h5>
                                        <p>Mudah dihubungi via Whatsapp, Line, Instagram untuk konsultasi selama 24/7</p>
                                    </div>
                                </div>
                                <!-- single services -->
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center mt-30 about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-mobile"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Bergaransi dan Beragam</h5>
                                        <p>Tersedia semua produk Mac dan iDevice yang sesuai dengan kebutuhan, dan Garansi Service 1 Bulan / Tukar Unit untuk unit secondhand.</p>
                                    </div>
                                </div>
                                <!-- single services -->

                                <div class="single-services text-center mt-30 about-us-card">
                                    <div class="services-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Free Ongkir se-Indonesia</h5>
                                        <p>serta Free instalasi aplikasi lengkap dan Free Update OS terbaru. T&C berlaku.</p>
                                    </div>
                                </div>
                                <!-- single services -->
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- services right -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- about macberry end here -->

    <!-- product list start here -->
    <section id="product-list" class="c-product-homepage">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="section-title pb-30 pt-100">
                        <h3 class="title mb-15 text-capitalize">our products</h3>
                    </div>
                    <!-- section title -->
                </div>
                <div class="col-lg-6">
                    <a href="<?php echo base_url('catalogs'); ?>" class="c-btn-secondary text-capitalize mt-15 pb-15 mt-100" style="letter-spacing:0.5px; right:0; position: absolute;">
                        produk lainya
                    </a>
                </div>
            </div>

            <div class="row">
			<?php
				foreach ($prod_featured as $key => $value) {
					echo '<div class="col-lg-4 col-md-6">';
					echo '<div class="single-product mt-30">';
					
					echo '<div class="product-image">';
					echo '<img src="' . $value->prod_img_url . '" alt="product img">';
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
    </section>
    <!-- product list end here -->

    <!-- product category start here -->
    <section id="product-category" class="c-product-category">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="section-title text-center pb-25">
                        <h3 class="title text-capitalize mb-15">Kategori kami</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum libero esse asperiores, consectetur quos labore eius.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <a href="<?php echo base_url('catalogs/category/iphone');?>" alt="Iphone"><img src="<?php echo $theme_assets . 'img/product-1.png'; ?>" alt="product img"></a>
                </div>
                <div class="col-lg-4">
                    <a href="<?php echo base_url('catalogs/category/imac');?>" alt="Iphone"><img src="<?php echo $theme_assets . 'img/product-2.png'; ?>" alt="product img"></a>
                </div>
                <div class="col-lg-4">
                    <a href="<?php echo base_url('catalogs/category/macbook');?>" alt="Iphone"><img src="<?php echo $theme_assets . 'img/product-3.png'; ?>" alt="product img"></a>
                </div>
                <div class="col-lg-4">
                    <a href="<?php echo base_url('catalogs/category/ipad');?>" alt="Iphone"><img src="<?php echo $theme_assets . 'img/product-4.png'; ?>" alt="product img"></a>
                </div>
                <div class="col-lg-4">
                    <a href="<?php echo base_url('catalogs/category/apple-watch');?>" alt="Iphone"><img src="<?php echo $theme_assets . 'img/product-5.png'; ?>" alt="product img"></a>
                </div>
                <div class="col-lg-4">
                    <a href="<?php echo base_url('catalogs/category/earpods');?>" alt="Iphone"><img src="<?php echo $theme_assets . 'img/product-6.png'; ?>" alt="product img"></a>
                </div>

            </div>
        </div>
    </section>
    <!-- product category end here -->

    <!-- product promo start here -->
    <section id="product-promo" class="c-promo">
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="section-title text-center pb-25 mt-50">
                        <h3 class="title text-capitalize mb-15">Promo terbaru</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum libero esse asperiores, consectetur quos labore eius.</p>
                    </div>
                </div>
            </div>

            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="10000">
                        <img src="<?php echo $theme_assets . 'img/promo-1.jpg'; ?>" class="d-block w-100" alt="product img">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img src="<?php echo $theme_assets . 'img/promo-2.jpg'; ?>" class="d-block w-100" alt="product img">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo $theme_assets . 'img/promo-3.jpg'; ?>" class="d-block w-100" alt="product img">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </section>
    <!-- product promo end here -->

    <!-- news start here -->
    <section id="blog" class="c-blog blog-area pt-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h3 class="title text-capitalize mb-15">Berita terbaru</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum libero esse asperiores, consectetur quos labore eius.</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->
            <div class="row justify-content-center">
			<?php
				foreach ($art_featured as $key => $value) {
					echo '<div class="col-lg-4 col-md-6">';
					echo '<div class="single-blog mt-30">';
					
					echo '<div class="blog-image">';
					echo '<img src="' . $value->art_img . '" alt="product img">';
					echo '</div>';
					
					echo '<div class="blog-content">';
					echo '<div class="content">';
					
                    echo '<div class="row justify-content-between pt-10">';
					echo '<div class="col-7"><p>Posted at ' . mdate("%d-%m-%Y", strtotime($value->date_create)) .'</p></div>';
					echo '<div class="col-5"><span class="badge badge-pill badge-light font-weight-normal">' . $value->art_tags .'</span></div>';
					echo '</div>';
								
					echo '<div class="row">';
					echo '<div class="col-12">';
					echo '<h6 class="pt-10 pb-15 text-capitalize">' . character_limiter(strip_tags($value->art_title), 50) . '</h6>';
					echo '<p>';
					echo character_limiter(strip_tags($value->art_content), 100);
					echo '</p>';
					echo '</div>';
					echo '<a href="' . base_url('articles/read/' . $value->art_slug) . '" class="c-btn-primary text-capitalize mt-15 pb-15 w-100" style="letter-spacing:0.5px;">';
					echo 'baca lebih lanjut';
					echo '</a>';
					echo '</div>';
					echo '</div>';
					echo ' </div>';

					echo '</div>';
					echo '</div>';
				}
			?>

            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- news end here -->