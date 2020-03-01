<section class="product-single-page pt-80 c-product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    <div class="product-image mt-50">
                        <?php 
                            if (!empty($product->img)) {
                                foreach($product->img as $val) {
                                    echo '<div class="single-product-image">';
                                    echo '<img src="' . base_url($val->prod_img_url) . '" alt="' . $product->prod_name . '" />';
                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>
                    <!-- product image -->
                </div>
                <div class="col-lg-7 col-md-10 ">
                    <div class="product-description mt-45 ml-15">
                        <h4 class="description-title text-capitalize">
                            <?php echo $product->prod_name; ?>
                        </h4>
                        <!-- <div class="product-rating d-flex pt-10">
                            <ul>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="far fa-star"></i>
                                </li>
                            </ul>
                            <span class="review" style="opacity:0.9;">128 / 200 Review</span>
                        </div> -->
                        <!-- product rating -->
                        <div class="product-price mt-15  text-uppercase">
                            <span class="regular-price">
                                idr <?php echo number_format($product->prod_price); ?>
                            </span>
                            <span class="discount-price">IDR <?php echo number_format($product->prod_pricewas == 0 ? $product->prod_price : $product->prod_pricewas); ?></span>
                        </div>

                        <div class="row c-product-detail-specs pt-10">
                            <div class="col-6">
                                <p>
                                    ram:
                                </p>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo $product->spec_ram; ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <p>
                                    ruang penyimpanan :
                                </p>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo $product->spec_storage; ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-12">
                                <p>
                                    warna :
                                </p>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo $product->spec_color; ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <p>
                                    ukuran :
                                </p>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo $product->spec_dimension; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="available pt-10 text-capitalize">
                            <p>Stok :
                                <span><?php echo $product->prod_stock; ?> produk</span></p>
                        </div>
                        <?php
                            echo form_open_multipart('order/add');
                            echo '<div class="product-add d-flex pt-10">';
                            echo '<input type="hidden" value="' .$product->id .'" class="form-control" name="intproductid">';
                            echo '<input type="hidden" value="' .$product->prod_name .'" class="form-control" name="vcproductname">';
                            echo '<input type="hidden" value="' .$product->prod_price .'" class="form-control" name="decprice">';
                            echo '<input type="hidden" value="' .$product->prod_stock .'" class="form-control" name="intstock">';
                        
                            echo '<div class="product-add-count mt-10">';
                            echo '<input type="number" value="0" name="intqty">';
                            echo '</div>';
                            echo '<div class="product-add-btn mt-10 text-capitalize">';
                            echo '<button type="submit" class="c-btn-primary">Beli sekarang</button>';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';
                        ?>
                    </div>
                    <!-- product description -->
                </div>
            </div>
            <!-- row -->
            <div class="shop-review-area mt-50">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-reviews">
                            <ul class="nav text-capitalize" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">deskripsi produk</a>
                                </li>
                                <li class="nav-item">
                                    <a id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Ulasan produk</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <div class="tab-description">
                                        <div class="description-details mt-45">
                                            <h5 class="title mb-25 text-capitalize">deskripsi produk</h5>
                                            <?php echo $product->prod_desc; ?>
                                        </div>
                                        <div class="description-features mt-45">
                                            <h5 class="title mb-25 text-capitalize">spesifikasi</h5>

                                            <!-- spesifikasi #1 -->
                                            <div class="row pt-15">
                                                <div class="col-3">
                                                    <h6 class="text-capitalize font-weight-normal">
                                                        layar
                                                    </h6>
                                                </div>
                                                <div class="col-9">
                                                    <?php echo $product->desc_screen; ?>
                                                </div>
                                                <div class="col-12 pt-10">
                                                    <hr>
                                                </div>
                                            </div>
                                            <!-- spesifikasi #1 -->

                                            <!-- spesifikasi #2 -->
                                            <div class="row pt-15">
                                                <div class="col-3">
                                                    <h6 class="text-capitalize font-weight-normal">
                                                        prosesor
                                                    </h6>
                                                </div>
                                                <div class="col-9">
                                                    <?php echo $product->desc_processor; ?>
                                                </div>
                                                <div class="col-12 pt-10">
                                                    <hr>
                                                </div>
                                            </div>
                                            <!-- spesifikasi #2 -->

                                            <!-- spesifikasi #3 -->
                                            <div class="row pt-15">
                                                <div class="col-3">
                                                    <h6 class="text-capitalize font-weight-normal">
                                                        penyimpanan
                                                    </h6>
                                                </div>
                                                <div class="col-9">
                                                    <?php echo $product->desc_storage; ?>
                                                </div>
                                                <div class="col-12 pt-10">
                                                    <hr>
                                                </div>
                                            </div>
                                            <!-- spesifikasi #3 -->

                                            <!-- spesifikasi #4 -->
                                            <div class="row pt-15">
                                                <div class="col-3">
                                                    <h6 class="text-capitalize font-weight-normal">
                                                        memori
                                                    </h6>
                                                </div>
                                                <div class="col-9">
                                                    <?php echo $product->desc_ram; ?>                                                
                                                </div>
                                                <div class="col-12 pt-10">
                                                    <hr>
                                                </div>
                                            </div>
                                            <!-- spesifikasi #4 -->

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="tab-review">
                                        <div class="review-item">
                                            <div class="review-content media-body">
                                            <p class="mt-10">Belum ada review untuk saat ini</p>
                                            </div>
                                            <!-- <ul>
                                                <li>
                                                    <div class="single-review d-sm-flex">
                                                        <div class="review-thumb">
                                                            <img src="https://placehold.it/100" alt="Review" style="max-height:65px; min-height:65px">
                                                        </div>
                                                        <div class="review-content media-body">
                                                            <div class="review-name">
                                                                <h5 class="name">Daniel Vandaft</h5>
                                                                <span>25 June, 2019</span>
                                                                <ul class="review-rating mt-15">
                                                                    <li>
                                                                        <i class="far fa-star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i class="far fa-star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i class="far fa-star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i class="far fa-star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i class="far fa-star"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p class="mt-10">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul> -->
                                        </div>
                                        <!-- review item -->
                                        <br />
                                        <h5 class="title mb-0 text-capitalize">Tulis Review</h5>

                                        <div class="review-form pt-20">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="single-review-input">
                                                            <input type="text" placeholder="Nama Anda*">
                                                        </div>
                                                        <!-- single review input -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-review-input">
                                                            <input type="email" placeholder="Email*">
                                                        </div>
                                                        <!-- single review input -->
                                                    </div>
                                                    <!-- <div class="col-md-12">
                                                        <div class="single-review-input d-flex">
                                                            <p>Rating :</p>
                                                            <div class="star-rating">
                                                                <i class="far fa-star" data-rating="1"></i>
                                                                <i class="far fa-star" data-rating="2"></i>
                                                                <i class="far fa-star" data-rating="3"></i>
                                                                <i class="far fa-star" data-rating="4"></i>
                                                                <i class="far fa-star" data-rating="5"></i>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-12">
                                                        <div class="single-review-input">
                                                            <textarea placeholder="Your Review*"></textarea>
                                                        </div>
                                                        <!-- single review input -->
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-review-input">
                                                            <button type="submit" class="c-btn-primary text-capitalize">Kirim ulasan</button>
                                                        </div>
                                                        <!-- single review input -->
                                                    </div>
                                                </div>
                                                <!-- row -->
                                            </form>
                                        </div>
                                        <!-- review form -->
                                    </div>
                                    <!-- tab review -->
                                </div>
                            </div>
                            <!-- tab content -->
                        </div>
                        <!-- shop reviews -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>