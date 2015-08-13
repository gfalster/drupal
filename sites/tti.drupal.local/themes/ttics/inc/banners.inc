<?php
/**
 * Generate markup for ttics's mbanners.
 *
 * @return <string>
 *    HTML markup to printo into page
 */
function ttics_minibanners_markup($mbanners) 
{
	if ($mbanners && theme_get_setting('minibanner_usage') != 0) {
		// Add javascript to manage mbanners
		//ttics_minibanners_add_js(count($mbanners));

		// Generate HTML markup for mbanners
		return ttics_minibanner_markup($mbanners);
	} else {
		return '';
	}
}
/**
 * Generate mbanners markup.
 *
 * @return <string>
 *    HTML code to display menubanner markup.
 */
function ttics_minibanner_markup($mbanners) 
{
	$output = '';

	foreach($mbanners as $i => $mbanner) {
		$variables = array(
				'path'  => $mbanner['image_path'],
				'alt' => t('@image_desc', array('@image_desc'=>$mbanner['image_description'])),
				'title'   => t('@image_title', array('@image_title'=>$mbanner['image_title'])),
				'attributes' => array(
						'id' => 'nav-number-' . $i,
						'longdesc' => t('@image_desc', array('@image_desc'=>$mbanner['image_description']))
				),
		);
		// Draw image
		$image   = theme('image', $variables);

		// Add link (if required)
		$output .= $mbanner['image_url'] ? l($image, $mbanner['image_url'], array('html' => TRUE)) : $image;
	}
	return $output;
}

/**
 * Get menubanner to show into current page in accord with settings
 *
 * @return <array>
 *    mbanners to show
 */
function ttics_show_minibanners() 
{
	$mbanners = ttics_get_minibanners(FALSE);
	$display_mbanners = array();

	// Current path alias
	$path = drupal_strtolower(drupal_get_path_alias($_GET['q']));

	// Check visibility for each menubanner
	foreach ($mbanners as $mbanner) {
		// Pages
		$pages = drupal_strtolower($mbanner['image_visibility']);

		// Check path for alias, and (if required) for path
		$page_match = drupal_match_path($path, $pages);
		if ($path != $_GET['q']) {
			$page_match = $page_match || drupal_match_path($_GET['q'], $pages);
		}

		// Add menubanner to visible menubanner
		if ($page_match) {
			$display_mbanners[] = $mbanner;
		}
	}
	return $display_mbanners;
}