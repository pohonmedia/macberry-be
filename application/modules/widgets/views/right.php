<?php
if (!empty($right_widgets) || isset($right_widgets) != "") {
    echo '</div>';
    echo '<div class="col-md-3">';
    echo $right_widgets;
    echo '</div>';
} else {
    echo '</div>';
}