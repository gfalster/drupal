<?php
function neurogenerate_preprocess_page(&$vars)
{
	$image1var = array(
			'path' => $vars['img1'],
			'alt' => $vars['slide1_title'],
			'title' => $vars['slide1_title'],
			'attributes' => array('class' => 'slide-img'),
	);
	$vars['slideimage1'] = theme('image', $image1var);
}