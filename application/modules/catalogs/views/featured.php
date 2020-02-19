<?php

echo '<br />';
echo '<h2 class="text-center">Latest Product</h2>';
echo '<br />';
echo '<div class="table-responsive">';
echo '<table class="table table-hover table-condensed">';
if (!empty($latest)) {
    foreach ($latest as $key => $value) {
        echo '<tr>';
        echo '<td><img class="img-thumbnail img-responsive" src="' . base_url($value->img_thumb) . '" data-src="holder.js/120x100/auto/#ccc:#666/text:Produk Terbaru" alt="Produk" width="100" height="80"></td>';
        echo '<td>';
        echo '<a href="#"><h5><strong>' . $value->type_name . '</strong></h5></a>';
        echo character_limiter(strip_tags($value->prod_desc), 50);
        echo '</td>';
        echo '<td class="text-right" style="vertical-align:middle"><strong>Rp . ' . number_format($value->prod_price, 2) . '</strong></td>';
        echo '<td class="text-center" style="vertical-align:middle" width="120">' . ucwords(strtolower($value->prod_location)) . '</td>';
        echo '</tr>';
    }
}
echo '</table>';
echo '</div>';
//echo '<tr>';
//echo '<td><img class="img-thumbnail img-responsive" data-src="holder.js/120x100/auto/#ccc:#666/text:Produk Terbaru" alt="Produk"></td>';
//echo '<td><a href="#"><h5><strong>Small Ice class Box Tween</strong></h5></a>';
//echo '98 TDW, 1998 KVAERNER FJELLSTRAND, NORWAY<br>';
//echo '411pax/13cars<br>';
//echo 'MTU 16V396TE74L 2,000 KW X 4 SETS</td>';
//echo '<td><strong>Rp.900,000.00</strong></td>';
//echo '<td>Surabaya</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td><img class="img-thumbnail img-responsive" data-src="holder.js/120x100/auto/#ccc:#666/text:Produk Terbaru" alt="Produk"></td>';
//echo '<td><a href="#"><h5><strong>Small Ice class Box Tween</strong></h5></a>';
//echo '98 TDW, 1998 KVAERNER FJELLSTRAND, NORWAY<br>';
//echo '411pax/13cars<br>';
//echo 'MTU 16V396TE74L 2,000 KW X 4 SETS</td>';
//echo '<td><strong>Rp.900,000.00</strong></td>';
//echo '<td>Surabaya</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td><img class="img-thumbnail img-responsive" data-src="holder.js/120x100/auto/#ccc:#666/text:Produk Terbaru" alt="Produk"></td>';
//echo '<td><a href="#"><h5><strong>Small Ice class Box Tween</strong></h5></a>';
//echo '98 TDW, 1998 KVAERNER FJELLSTRAND, NORWAY<br>';
//echo '411pax/13cars<br>';
//echo 'MTU 16V396TE74L 2,000 KW X 4 SETS</td>';
//echo '<td><strong>Rp.900,000.00</strong></td>';
//echo '<td>Surabaya</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td><img class="img-thumbnail img-responsive" data-src="holder.js/120x100/auto/#ccc:#666/text:Produk Terbaru" alt="Produk"></td>';
//echo '<td><a href="#"><h5><strong>Small Ice class Box Tween</strong></h5></a>';
//echo '98 TDW, 1998 KVAERNER FJELLSTRAND, NORWAY<br>';
//echo '411pax/13cars<br>';
//echo 'MTU 16V396TE74L 2,000 KW X 4 SETS</td>';
//echo '<td><strong>Rp.900,000.00</strong></td>';
//echo '<td>Surabaya</td>';
//echo '</tr>';