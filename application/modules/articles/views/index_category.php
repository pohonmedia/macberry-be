<?php
echo '<br />';
echo '<div class="center">';
if(!empty($not_found)) {
	echo '<h2>' . $not_found . '</h2>';
	echo '</div>';
	echo '<div class="blog">';
	echo '<div class="blog-item">';
	echo '<p>' . $not_found_msg . '</p>';
	echo '</div>';
} else {
	if(!empty($articles)) {
		echo '<h2>List all article(s) under category</h2>';
		echo '</div>';
		echo '<div class="blog">';
		echo '<div class="blog-item">';
		foreach ($articles as $key => $value) {
			echo '<ul>';
			echo '<li><a href="'.base_url('articles/read/' . $value->art_slug).'">'. $value->art_title . '</a></li>';
			echo '</ul>';
		}
		echo '</div>';
	} else {
		echo '<h2>0 Articles Found</h2>';
		echo '</div>';
		echo '<div class="blog">';
		echo '<div class="blog-item">';
		echo '<p>There\'s no article(s) under this category</p>';
		echo '</div>';
	}
}
echo '</div>';