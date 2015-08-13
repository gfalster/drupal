<?php
function ttics_mbanner_nav($variables) {
	$banner_navigation  = '<div id="header-image-navigation" class="marinelli-hide-no-js">';
	$banner_navigation .= '<a href="#" id="header-image-prev" title="' . $variables['url'] . '">&lsaquo;</a>';
	$banner_navigation .= '</div>';

	return $banner_navigation;
}