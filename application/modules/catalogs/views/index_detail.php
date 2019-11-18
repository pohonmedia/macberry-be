<?php

// echo '<div>';
// echo '<h1>' . $product->type_name . ' - ' . $product->prod_name . '</h1>';
// echo '</div>';
// echo '<div class="blog row">';
// echo '<div class="blog-item col-md-8">';
// if (!empty($product->img)) {
//     echo '<div class="col-md-12">';
//     foreach ($product->img as $val) {
//         echo '<img class="img-thumbnail" src="' . base_url($val->prod_img_url) . '" alt="Produk />';
//     }
//     echo '</div>';
//     echo '<div class="clearfix" style="margin-bottom:15px"></div>';
// }
// echo '<p>' . $product->prod_desc . '</p>';
// echo '</div>';
// echo '<div class="col-md-4">';
// echo '<div>';
// echo '<h2 style="margin: 0px 0px 5px 0px; padding: 0px 0px 0px 0px;color:#777"> Rp. ' . number_format($product->prod_price, 2) . '</h2>';
// echo '<b>&nbsp;<i class="fa fa-map-marker"></i>&nbsp;&nbsp;</b> ' . $product->prod_location . ' / <b>&nbsp;<i class="fa fa-magic"></i>&nbsp;&nbsp;</b>' . ($product->prod_status == 0 ? 'Baru' : ($product->prod_status == 1 ? 'Second' : 'Rekondisi'));
// echo '</div>';
// echo '<br />';
// echo '<div class="well">';
// echo '<h2 style="margin-top:0px;">Seller Info</h2>';
// echo '<b><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Phone </b> ' . $product->first_name . ' / ' . ($product->company == "" ? 'Nama Perusahaan belum di isi' : $product->company);
// echo '<br />';
// echo '<b><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;Phone </b> ' . ($product->phone == "" ? 'Telp. belum di isi' : $product->phone);
// echo '<br />';
// echo '<b><i class="fa fa-building"></i>&nbsp;&nbsp;&nbsp;Address </b> ' . ($product->address == "" ? 'Alamat belum di isi' : $product->address);
// echo '<br />';
// echo '<br />';
// echo '<p>' . ($product->company_desc == "" ? 'Deskripsi Perusahaan Belum diisi' : $product->company_desc) . '</p>';
// echo '</div>';
// echo '</div>';
// echo '</div>';
// echo '<br />';
// echo '<div>';
// echo '<h3>Product in this category :</h3>';
// echo '</div>';
// echo '<br />';

echo '<div class="col-lg-9">';
echo '<p class="lead">'. $product->prod_desc . '</p>';
echo '<div id="productMain" class="row">';
echo '<div class="col-sm-6">';
echo '<div data-slider-id="1" class="owl-carousel shop-detail-carousel">';
if (!empty($product->img)) {
    foreach ($product->img as $val) {
        	// echo '<img class="img-thumbnail" src="' . base_url($val->prod_img_url) . '" alt="Produk />';
			echo '<div> <img src="' . base_url($val->prod_img_url) . '" alt="" class="img-fluid"></div>';
    }
}
// echo '<div> <img src="img/detailbig1.jpg" alt="" class="img-fluid"></div>';
// echo '<div> <img src="img/detailbig2.jpg" alt="" class="img-fluid"></div>';
// echo '<div> <img src="img/detailbig3.jpg" alt="" class="img-fluid"></div>';
echo '</div>';
echo '</div>';
echo '<div class="col-sm-6">';
echo '<div class="box" style="margin-top:0px;margin-bottom:0px;">';
echo form_open_multipart('order/add');
echo '<input type="hidden" value="' .$product->id .'" class="form-control" name="intproductid">';
echo '<input type="hidden" value="' .$product->prod_name .'" class="form-control" name="vcproductname">';
echo '<input type="hidden" value="' .$product->prod_price .'" class="form-control" name="decprice">';
echo '<p class="price" style="margin:0px;font-size:18px">Qty : <input type="number" value="1" class="form-control" name="intqty"></p>';
echo '<p class="price">Rp. ' . number_format($product->prod_price, 2) . '</p>';
echo '<p class="text-center">';
echo '<button type="submit" class="btn btn-template-outlined"><i class="fa fa-shopping-cart"></i> Add to cart</button>';
// echo '<button type="submit" data-toggle="tooltip" data-placement="top" title="Add to wishlist" class="btn btn-default"><i class="fa fa-heart-o"></i></button>';
echo '</p>';
echo '</form>';
echo '</div>';
echo '<div data-slider-id="1" class="owl-thumbs">';
if (!empty($product->img)) {
    foreach ($product->img as $val) {
			echo '<button class="owl-thumb-item"><img src="' . base_url($val->prod_thumb_url) . '" alt="" class="img-fluid"></button>';
    }
}
// echo '<button class="owl-thumb-item"><img src="img/detailsquare.jpg" alt="" class="img-fluid"></button>';
// echo '<button class="owl-thumb-item"><img src="img/detailsquare2.jpg" alt="" class="img-fluid"></button>';
// echo '<button class="owl-thumb-item"><img src="img/detailsquare3.jpg" alt="" class="img-fluid"></button>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="col-lg-3">';
  // <!-- MENUS AND FILTERS-->
// if (!empty($template['partials']['right_sidebar'])) {
//     echo $template['partials']['right_sidebar'];
// }

echo '<div class="panel panel-default sidebar-menu">';
echo '<div class="panel-heading">';
echo '<h3 class="h4 panel-title">Categories</h3>';
echo '</div>';
echo '<div class="panel-body">';
echo '<ul class="nav nav-pills flex-column text-sm category-menu">';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link d-flex align-items-center justify-content-between"><span>Office & Stationery </span></a>';
echo '<ul class="nav nav-pills flex-column">';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Ballpoint</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Crayon</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Pensil</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Tinta</a></li>';
echo '</ul>';
echo '</li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link d-flex align-items-center justify-content-between"><span>Aksesoris Komputer</span></a>';
echo '<ul class="nav nav-pills flex-column">';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Flashdisk</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Mouse</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Kabel Data</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">CD-R</a></li>';
echo '</ul>';
echo '</li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link d-flex align-items-center justify-content-between"><span>Toys/Mainan</span></a>';
echo '<ul class="nav nav-pills flex-column">';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Puzzle</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Fun Games</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Mobil-mobilan</a></li>';
echo '<li class="nav-item"><a href="shop-category.html" class="nav-link">Fun Doh</a></li>';
echo '</ul>';
echo '</li>';
echo '</ul>';
echo '</div>';
echo '</div>';
echo '<div class="panel panel-default sidebar-menu">';
echo '<div class="panel-heading d-flex align-items-center justify-content-between">';
echo '</div>';
echo '</div>';
echo '</div>';