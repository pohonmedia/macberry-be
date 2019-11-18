<?php

echo '<div>';
echo '<h1>' . $product->type_name . ' - ' . $product->prod_name . '</h1>';
echo '</div>';
echo '<div class="blog row">';
echo '<div class="blog-item col-md-8">';
if (!empty($product->img)) {
    echo '<div class="col-md-12">';
    foreach ($product->img as $val) {
        echo '<img class="img-thumbnail" src="' . base_url($val->prod_img_url) . '" alt="Produk />';
    }
    echo '</div>';
    echo '<div class="clearfix" style="margin-bottom:15px"></div>';
}
echo '<p>' . $product->prod_desc . '</p>';
echo '</div>';
echo '<div class="col-md-4">';
echo '<div>';
echo '<h2 style="margin: 0px 0px 5px 0px; padding: 0px 0px 0px 0px;color:#777"> Rp. ' . number_format($product->prod_price, 2) . '</h2>';
echo '<b>&nbsp;<i class="fa fa-map-marker"></i>&nbsp;&nbsp;</b> ' . $product->prod_location . ' / <b>&nbsp;<i class="fa fa-magic"></i>&nbsp;&nbsp;</b>' . ($product->prod_status == 0 ? 'Baru' : ($product->prod_status == 1 ? 'Second' : 'Rekondisi'));
echo '</div>';
echo '<br />';
echo '<div class="well">';
echo '<h2 style="margin-top:0px;">Seller Info</h2>';
echo '<b><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Phone </b> ' . $product->first_name . ' / ' . ($product->company == "" ? 'Nama Perusahaan belum di isi' : $product->company);
echo '<br />';
echo '<b><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;Phone </b> ' . ($product->phone == "" ? 'Telp. belum di isi' : $product->phone);
echo '<br />';
echo '<b><i class="fa fa-building"></i>&nbsp;&nbsp;&nbsp;Address </b> ' . ($product->address == "" ? 'Alamat belum di isi' : $product->address);
echo '<br />';
echo '<br />';
echo '<p>' . ($product->company_desc == "" ? 'Deskripsi Perusahaan Belum diisi' : $product->company_desc) . '</p>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '<br />';
echo '<div>';
echo '<h3>Product in this category :</h3>';
echo '</div>';
echo '<br />';