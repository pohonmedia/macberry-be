<?php
//LIST ITEM
// echo '<div class="table-responsive">';
// echo '<table class="table table-hover table-condensed">';
// echo '<thead><tr>';
// echo '<th class="text-center">Foto</th>';
// echo '<th>Deskripsi</th>';
// echo '<th class="text-right" width="150">Harga</th>';
// echo '<th class="text-center" width="100">Lokasi</th>';
// echo '</tr></thead>';
// if (!empty($catalogs)) {
//     foreach ($catalogs as $key => $value) {
//         echo '<tr>';
//         echo '<td class="text-center"><img class="img-thumbnail img-responsive" src="' . base_url($value->img_thumb) . '" data-src="holder.js/120x100/auto/#ccc:#666/text:Produk Terbaru" alt="Produk" width="100" height="80"></td>';
//         echo '<td>';
//         echo '<a href="' . base_url('catalogs/product/' . $value->id) . '"><h5><strong>' . $value->type_name . '</strong></h5></a>';
//         echo character_limiter(strip_tags($value->prod_desc), 40);
//         echo '</td>';
//         echo '<td class="text-right" style="vertical-align:middle"><strong>Rp . ' . number_format($value->prod_price, 2) . '</strong></td>';
//         echo '<td class="text-center" style="vertical-align:middle">' . ucwords(strtolower($value->prod_location)) . '</td>';
//         echo '</tr>';
//     }
// }
// echo '</table>';
// echo '</div>';

if (!empty($catalogs)) {
    foreach ($catalogs as $key => $value) {
        echo '<div class="col-lg-2 col-md-2">';
        echo '<div class="product">';
        echo '<div class="image"><a href="' . base_url('catalogs/product/' . $value->id) . '"><img src="' . base_url($value->img_thumb) . '" alt="" class="img-fluid image1"></a></div>';
        echo '<div class="text">';
        echo '<h3 class="h5"><a href="' . base_url('catalogs/product/' . $value->id) . '"><strong>' . $value->prod_name . '</strong></a></h3>';
        echo '<p class="price">Rp . ' . number_format($value->prod_price, 2) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}