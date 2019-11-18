<?php

echo '<div class="center">';
if (!empty($not_found)) {
    echo '<h2>' . $not_found . '</h2>';
    echo '</div>';
    echo '<div class="blog">';
    echo '<div class="blog-item">';
    echo '<p>' . $not_found_msg . '</p>';
    echo '</div>';
} else {
    if (!empty($result)) {
        echo '<h2>List all product(s) under category</h2>';
        echo '<br />';
        //LIST ITEM
        echo '<div class="table-responsive">';
        echo '<table class="table table-hover table-condensed">';
        echo '<thead><tr>';
        echo '<th class="text-center">Foto</th>';
        echo '<th>Deskripsi</th>';
        echo '<th class="text-right" width="150">Harga</th>';
        echo '<th class="text-center" width="100">Lokasi</th>';
        echo '</tr></thead>';
        foreach ($result as $key => $value) {
            echo '<tr>';
            echo '<td class="text-center"><img class="img-thumbnail img-responsive" src="' . base_url($value->img_thumb) . '" data-src="holder.js/120x100/auto/#ccc:#666/text:Produk Terbaru" alt="Produk" width="100" height="80"></td>';
            echo '<td>';
            echo '<a href="' . base_url('catalogs/product/' . $value->id) . '"><h5><strong>' . $value->type_name . '</strong></h5></a>';
            echo character_limiter(strip_tags($value->prod_desc), 40);
            echo '</td>';
            echo '<td class="text-right" style="vertical-align:middle"><strong>Rp . ' . number_format($value->prod_price, 2) . '</strong></td>';
            echo '<td class="text-center" style="vertical-align:middle">' . ucwords(strtolower($value->prod_location)) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo '<h2>0 Products Found</h2>';
        echo '</div>';
        echo '<div class="blog">';
        echo '<div class="blog-item">';
        echo '<p class="text-danger">There\'s no product(s) under this category</p>';
        echo '</div>';
    }
}
echo '</div>';
