<?php

//SLIDERS
echo '<div id="main-slider" class="carousel slide" data-ride="carousel">';
echo '<ol class="carousel-indicators">';
$i = 0;
for ($i = 0; $i < count($sliders); $i++) {
    if ($i == 0) {
        echo '<li data-target="#main-slider" data-slide-to="' . $i . '" class="active"></li>';
    } else {
        echo '<li data-target="#main-slider" data-slide-to="' . $i . '"></li>';
    }
}
echo '</ol>';
echo '<div class="carousel-inner" role="listbox">';
if(!empty($sliders)) {
	foreach ($sliders as $key => $value) {
		if ($key == 0) {
			echo '<div class="item active">';
		} else {
			echo '<div class="item">';
		}
		echo '<img class="img-responsive" src="' . base_url($value->sld_url) . '" data-src="holder.js/815x330/auto/#999:#666/text:Slider 01" alt="Generic placeholder image">';
		echo '</div>';
	}
}
echo '</div>';

echo '<a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">';
echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
echo '<span class="sr-only">Previous</span>';
echo '</a>';
echo '<a class="right carousel-control" href="#main-slider" role="button" data-slide="next">';
echo '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
echo '<span class="sr-only">Next</span>';
echo '</a>';
echo '</div>';
//SLIDERS END

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
if (!empty($catalogs)) {
    foreach ($catalogs as $key => $value) {
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
}
echo '</table>';
echo '</div>';
