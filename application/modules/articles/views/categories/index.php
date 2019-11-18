<?php
echo '<br />';
echo '<div class="center">';
if(!empty($category)) {
	echo '<h2>List All Categories</h2>';
	echo '</div>';
	echo '<div class="blog">';
	echo '<div class="blog-item">';
	foreach ($category as $key => $value) {
		echo '<ul>';
		echo '<li><a href="'.base_url('articles/category/' . $value->ct_slug).'">'. $value->ct_name . '</a></li>';
		echo '</ul>';
	}
	echo '</div>';
} else {
	echo '<h2>0 Categories Found</h2>';
	echo '</div>';
	echo '<div class="blog">';
	echo '<div class="blog-item">';
	echo '<p>There\'s no categories found</p>';
	echo '</div>';
}
echo '</div>';