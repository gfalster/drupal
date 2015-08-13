<?php // $Id$

// we define a global tag to use in diferent templates
define('OUTTAG', ( theme_get_setting('outside_tags') ? 'p' : 'h2' ) );

//include_once('theme/theme.inc');
include_once('inc/layout.inc');
include_once('inc/banners.inc');


/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function drupal_rebuild_theme_registry() 
{
	cache_clear_all('theme_registry', 'cache', TRUE);
}

function ttics_theme_html_head_alter(&$head_elements)
{
	$head_elements['system_meta_content_type']['#attributes'] = array(
		'charset' => 'utf-8'	
	);
}
/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function ttics_theme_breadcrumb($vars)
{
	$breadcrumb = $variables['breadcrumb'];
	if (!empty($breadcrumb)) {
		//Use CSS to hide title .element-visible.
		$output .= '<h2 class="element-invisible">' . t('You are here') . '</h2>';
		$breadcrumb[] = drupal_get_title();
		$output .= '';
		return $output;
	}
}

function ttics_preprocess_page(&$vars)
{
  $vars['display'] = theme_get_setting('display', 'bluez');
  $vars['footer_copyright'] = theme_get_setting('footer_copyright');
  $vars['footer_developed'] = theme_get_setting('footer_developed');
  $vars['footer_developedby_url'] = filter_xss_admin(theme_get_setting('footer_developedby_url', 'bluez'));
  $vars['footer_developedby'] = filter_xss_admin(theme_get_setting('footer_developedby', 'bluez'));
  $vars['searchblock'] = module_invoke('search', 'block_view', 'form');
  if (module_exists('i18n_menu')) {
    $vars['main_menu_tree'] = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
  }
  else {
    $vars['main_menu_tree'] = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
  }
  // Frontpage variables.
  $vars['slideshow_display'] = theme_get_setting('slideshow_display', 'bluez');
  
  $vars['minibanner1_title'] = theme_get_setting('minibanner1_title', 'bluez');
  $vars['minibanner2_title'] = theme_get_setting('minibanner2_title', 'bluez');
  $vars['minibanner3_title'] = theme_get_setting('minibanner3_title', 'bluez');
  $vars['minibanner1_desc'] = theme_get_setting('minibanner1_desc', 'bluez');
  $vars['minibanner2_desc'] = theme_get_setting('minibanner2_desc', 'bluez');
  $vars['minibanner3_desc'] = theme_get_setting('minibanner3_desc', 'bluez');
  
  $vars['wtitle'] = filter_xss_admin(theme_get_setting('welcome_title', 'bluez'));
  $vars['wtext'] = filter_xss_admin(theme_get_setting('welcome_text', 'bluez'));
  
  $vars['col1'] = filter_xss_admin(theme_get_setting('colone', 'bluez'));
  $vars['col1title'] = filter_xss_admin(theme_get_setting('colonetitle', 'bluez'));
  $vars['col2'] = filter_xss_admin(theme_get_setting('coltwo', 'bluez'));
  $vars['col2title'] = filter_xss_admin(theme_get_setting('coltwotitle', 'bluez'));
  $vars['col3'] = filter_xss_admin(theme_get_setting('colthree', 'bluez'));
  $vars['col3title'] = filter_xss_admin(theme_get_setting('colthreetitle', 'bluez'));
  
  $vars['img1'] = base_path() . drupal_get_path('theme', 'bluez') . '/images/slideshow/slide-image-1.jpg';
  $vars['img2'] = base_path() . drupal_get_path('theme', 'bluez') . '/images/slideshow/slide-image-2.jpg';
  $vars['img3'] = base_path() . drupal_get_path('theme', 'bluez') . '/images/slideshow/slide-image-3.jpg';
  $image1var = array(
    'path' => $vars['img1'],
    'alt' => $vars['slide1_title'],
    'title' => $vars['slide1_title'],
    'attributes' => array('class' => 'slide-img'),
  );
  $vars['slideimage1'] = theme('image', $image1var);
  $image2var = array(
    'path' => $vars['img2'],
    'alt' => $vars['slide2_title'],
    'title' => $vars['slide2_title'],
    'attributes' => array('class' => 'slide-img'),
  );
  $vars['slideimage2'] = theme('image', $image2var);
  $image3var = array(
    'path' => $vars['img3'],
    'alt' => $vars['slide3_title'],
    'title' => $vars['slide3_title'],
    'attributes' => array('class' => 'slide-img'),
  );
  $vars['slideimage3'] = theme('image', $image3var);


	// LOGO SECTION  ==============================================================
	// site logo
	$vars['imagelogo'] = theme('image', array(
			'path' => $vars['logo'],
			'alt'  => $vars['site_name'],
			'getsize' => FALSE,
			'attributes' => array('id' => 'logo'),
		)
	);	
	$vars['imagelogo'] = l($vars['imagelogo'],'<front>', array(
			'html' => TRUE,
			'attributes' => array(
				'title' => t('Back to homepage'),
			)
		)
	);
	
	// SITE NAME SECTION  ==============================================================
	$vars['sitename']  = '<h2>';
	$vars['sitename'] .= l($vars['site_name'], '<front>', array(
			'attributes' => array(
				'title' => t('Back to homepage')
			),
			'html' => TRUE			
		)
	);	
	$vars['sitename'] .= '</h2>';
	
	// SITE SLOGAN SECTION  ==============================================================
	$vars['siteslogan']  = '<h2>';
	$vars['siteslogan'] .= l($vars['site_slogan'], '<front>', array(
			'attributes' => array(
				'title' => t('Back to homepage')
			),
			'html' => TRUE	
		)
	);
	$vars['siteslogan'] .= '</h2>';	

 	// SITE MAIN MENU SECTION  ==============================================================
  	if (isset($vars['main_menu'])) {
    	$vars['main_menu'] = theme('links__system_main_menu', array(
      		'links' => $vars['main_menu'],
      		'attributes' => array(
        		'class' => array('links', 'main-menu', 'clearfix'),
      		),
      		'heading' => array(
        		'text' => t('Main menu'),
        		'level' => 'h2',
        		'class' => array('element-invisible'),
      		)
    	)
    );
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  
  
  // SITE SECONDARY SECTION  ==============================================================
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      		'links' => $vars['secondary_menu'],
      		'attributes' => array(
        		'class' => array('links', 'secondary-menu', 'clearfix'),
      		),
      		'heading' => array(
        		'text' => t('Secondary menu'),
        		'level' => 'h2',
        		'class' => array('element-invisible'),
      		)
    	)
    );
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }

  
  // MENU SECTION ==============================================================
  // secondary links with <span>
  $links = $vars['secondary_menu'];
  
  foreach ($links as $key => $link) {
  	$links[$key]['html'] = TRUE;
  	$links[$key]['title'] = '<span>' . $link['title'] . '</span>';
  }

  $vars['secondary_menu'] = $links;
  
  // primary links markup
  if (theme_get_setting('menu_type') == 2) { // use mega menu
  	$vars['mainmenu'] = theme('mega_menu', array(
  			'menu' => menu_tree_all_data(theme_get_setting('menu_element')) 			
  	));
  }
  elseif (theme_get_setting('menu_type') == 1) {
  	if (theme_get_setting('menu_headings') == 1) { // use classic <li>
  		$vars['mainmenu'] = theme('links', array('links' => $vars['main_menu'], 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu'))));
  	}
  	elseif (theme_get_setting('menu_headings') == 2){ // use <h2> (custom_links in theme/theme.inc)
  		$vars['mainmenu'] = theme('custom_links', array('links' => $vars['main_menu'], 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu'))));
  	}
  }  
	$banners = ttics_show_minibanners();
	
	// Banners section
	$vars['minibanner_image'] = ttics_minibanners_markup($banners);
	$vars['minibanner_text'] = '';
	$vars['banner_nav'] = '';
	
}

/**
 * Additional block variables
 */
function ttics_preprocess_block(&$vars){ // title visibility
	$vars['blockhide'] = "";
	if (($vars['block']->region != "sidebar_first" && $vars['block']->region != "sidebar_second" && $vars['block']->region != "content"  && theme_get_setting('blocks') == 1) || ($vars['block']->region == "utility_top" || $vars['block']->region == "utility_bottom")) {
		$vars['blockhide'] = "blockhide ";
	}

	// block title tag depends on theme settings and region
	$vars['blocktag'] = "h2";
	if ($vars['block']->region == "topbar" || $vars['block']->region == "utility_top" || $vars['block']->region == "search" || $vars['block']->region == "advertise" || $vars['block']->region == "overcontent" || $vars['block']->region == "overnode") {
		$vars['blocktag'] = OUTTAG;
	}
}
/**
 * Get banner settings.
 *
 * @param <bool> $all
 *    Return all banners or only active.
 *
 * @return <array>
 *    Settings information
 */
function ttics_get_minibanners($all = TRUE) {
	// Get all banners
	$mbanners = variable_get('theme_ttics_minibanner_settings', array());

	// Create list of banner to return
	$mbanners_value = array();
	foreach ($mbanners as $mbanner) {
		if ($all || $mbanner['image_published']) {
			// Add weight param to use `drupal_sort_weight`
			$mbanner['weight'] = $mbanner['image_weight'];
			$mbanners_value[] = $mbanner;
		}
	}

	// Sort image by weight
	usort($mbanners_value, 'drupal_sort_weight');
	
	return $mbanners_value;
}

/**
 * Set banner settings.
 *
 * @param <array> $value
 *    Settings to save
 */
function ttics_set_minibanners($value) {
	variable_set('theme_minibanner_settings', $value);
}
