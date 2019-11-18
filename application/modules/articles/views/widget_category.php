<?php
echo '<div class="widget">';
echo '<h3>All Category</h3>';
echo '<div class="row">';
echo '<div class="col-sm-12">';
echo '<ul class="blog_archieve">';
if(!empty($result)) {
	foreach ($result as $key => $value) {
		echo '<li><a href="'.base_url('articles/category/' . $value->ct_slug).'"><i class="fa fa-angle-double-right"></i> ' . $value->ct_name . '</a></li>';
	}
}
echo '</ul>';
echo '</div>';
echo '</div>';
echo '</div>';