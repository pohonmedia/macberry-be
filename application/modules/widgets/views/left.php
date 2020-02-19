<?php
if (!empty($left_widgets) || isset($left_widgets) != "") {
    echo '<div class="col-md-3">';
    echo $left_widgets;
    echo '</div>';
    if (!empty($right_widgets) || isset($right_widgets) != "") {
        echo '<div class="col-md-6">';
    } else {
        echo '<div class="col-md-9">';
    }
} else {
    if (!empty($right_widgets) || isset($right_widgets) != "") {
        echo '<div class="col-md-9">';
    } else {
        echo '<div class="col-md-12">';
    }
}
