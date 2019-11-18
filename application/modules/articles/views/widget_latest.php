<?php
echo '<div class="widget">';
echo '<h3>Latest News</h3>';
echo '<div class="row">';
echo '<div class="col-sm-12">';
echo '<ul class="blog_archieve">';
// var_dump($result);
if(!empty($result)) {
	foreach ($result as $key => $value) {
		echo '<li><a href="'.base_url('articles/read/' . $value->art_slug).'"><i class="fa fa-angle-double-right"></i> ' . $value->art_title . '</a></li>';
	}
}
echo '</ul>';
echo '</div>';
echo '</div>';
echo '</div>';