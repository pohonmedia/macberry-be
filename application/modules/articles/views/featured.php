<?php

if (isset($featured) && !empty($featured)) {
    foreach ($featured as $key => $value) {
        echo '<section class = "container-fluid" id="' . $value->art_slug . '" style="' . $value->art_style . '">';
        echo '<div class = "row">';
        echo '<div class = "col-sm-8 col-sm-offset-2">';
        echo '<h1 class="text-center">' . $value->art_title . '</h1>';
        echo '<br>';
        echo $value->art_content;
        echo '<br>';
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }
}
