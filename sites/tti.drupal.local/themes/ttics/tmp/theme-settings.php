<?php 
// $Id$
include_once 'template.php';


/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param array $form
 *   The form.
 * @param array $form_state
 *   The form state.
 */
function ttics_form_system_theme_settings_alter(&$form, $form_state)
{
	$form['ttics_settings'] = array(
		'#type' => 'fieldset',
		'#title' => t('TTi Theme Settings'),
		'#collapsible' => FALSE,
		'#collapsed' => FALSE,
	);
	$form['ttics_settings']['breadcrumbs'] = array(
		'#type' => 'checkbox',
		'#title' => t('Show breadcrumbs in a page'),
		'#default_value' => theme_get_setting('breadcrumbs'),
		'#description'   => t("Check this option to show breadcrumbs in page. Uncheck to hide."),
	);
	$form['ttics_settings']['display_theme_credit'] = array(
		'#type' => 'checkbox',
		'#title' => t('Remove Theme Credit from the footer'),
		'#default_value' => theme_get_setting('display_theme_credit'),
		'#description' => t("check this option to remove the theme credit from the footer"),
	);		
	$form['ttics_settings']['copyright_information'] = array(
			'#type' => 'fieldset',
			'#title' => t('Copyright Information'),
			'#collapsible' => TRUE,
			'#collapsed' => FALSE,
	);
	$form['ttics_settings']['copyright_information']['remove_copyright'] = array(
			'#type' => 'checkbox',
			'#title' => t('Remove copyright from the footer'),
			'#default_value' => theme_get_setting('remove_copyright'),
			'#description' => t("check this option to remove the copyright information from the footer"),
	);
	
	$form['ttics_settings']['copyright_information']['copyright_override'] = array(
			'#type' => 'textfield',
			'#title' => t('Copyright Override'),
			'#default_value' => theme_get_setting('copyright_override'),
			'#description' => 'override the entire copyright line',
	);
	
	$form['ttics_settings']['copyright_information']['copyright_holder'] = array(
			'#type' => 'textfield',
			'#title' => t('Copyright Holder'),
			'#default_value' => theme_get_setting('copyright_holder'),
			'#description' => 'Name the copyright holder of the site that will be displayed in the footer',
	);
	
	
	$form['ttics_settings']['minibanner'] = array(
			'#type' => 'fieldset',
			'#title' => t('Minibanner configurations'),
			'#weight' => 1,
			'#collapsible' => TRUE,
			'#collapsed' => FALSE,
			//'#tree' => TRUE,
	);

	$form['ttics_settings']['minibanner']['banner_usage'] = array(
			'#type' => 'select',
			'#options' => array(
					1 => t('TTics banners'),
					0 => t('Drupal region (sidebar_first)')
			),
			'#title' => t('Do you want to use ttics minibanners or a classic drupal region?'),
			'#default_value' => theme_get_setting('minibanner_usage'),
	);
	$form['ttics_settings']['minibanner']['banner_showtext'] = array(
			'#type' => 'radios',
			'#title' => t('Do you want to show title and description over the minibanner?'),
			'#default_value' => theme_get_setting('banner_showtext'),
			'#options' => array(
					0 => t('No'),
					1 => t('Yes'),
			)
	);
	
	$form['ttics_settings']['minibanner']['minibanner_shownavigation'] = array(
			'#type' => 'radios',
			'#title' => t('Do you want to show the minibanner navigation over the banner?'),
			'#default_value' => theme_get_setting('banner_shownavigation'),
			'#options' => array(
					0 => t('No'),
					1 => t('Yes'),
			)
	);		
		
	$form['ttics_settings']['minibanner']['images'] = array(
		'#type' => 'vertical_tabs',
		'#title' => t('Minibanner images'),
		'#weight' => 2,
		'#collapsible' => TRUE,
		'#collapsed' => FALSE,
		'#tree' => TRUE,
	);
	
	$images = ttics_get_minibanners();
	var_dump($images);
	$i = 0;
	foreach ($images as $image_data ) {
		$form['ttics_settings']['minibanner']['images'][$i] = array(
				'#type' => 'fieldset',
				'#title' => t('Image !number: !title', array(
							'!number' => $i + 1,
							'!title' => 'test',//$image_data['title'],
				 	)
				),
				'#weight' => $i,
				'#collapsible' => TRUE,
				'#collapsed' => TRUE,
				'#tree' => TRUE,
				'#image' => _ttics_minibanner_form($image_data),
		);
		$i++;
	}
	$form['ttics_settings']['minibanner']['image_upload'] = array(
			'#type' => 'file',
			'#title' => t('Upload a new minibanner'),
			'#weight' => $i,
	);
	
	$form['#submit'][]   = 'ttics_settings_submit';
	return $form;	
}

/**
 * Save settings data.
 */
function ttics_settings_submit($form, &$form_state) 
{
  $settings = array();

  // Update image field
  foreach ($form_state['input']['images'] as $image) {
    if (is_array($image)) {
      $image = $image['image'];
      
      if ($image['image_delete']) {
        // Delete banner file
        file_unmanaged_delete($image['image_path']);
        // Delete banner thumbnail file
        file_unmanaged_delete($image['image_thumb']);
      } else {
        // Update image
        $settings[] = $image;
      }
    }
  }
  
  // Check for a new uploaded file, and use that if available.
  if ($file = file_save_upload('image_upload')) {
    $file->status = FILE_STATUS_PERMANENT;
    if ($image = _ttics_save_image($file)) {
      // Put new image into settings
      $settings[] = $image;
    }
  }

  // Save settings
  ttics_set_minibanners($settings);
}

/**
 * Check if folder is available or create it.
 *
 * @param <string> $dir
 *    Folder to check
 */
function _ttics_check_dir($dir) 
{
  // Normalize directory name
  $dir = file_stream_wrapper_uri_normalize($dir);

  // Create directory (if not exist)
  file_prepare_directory($dir,  FILE_CREATE_DIRECTORY);
}

/**
 * Save file uploaded by user and generate setting to save.
 *
 * @param <file> $file
 *    File uploaded from user
 *
 * @param <string> $mbanner_folder
 *    Folder where save image
 *
 * @param <string> $mbanner_thumb_folder
 *    Folder where save image thumbnail
 *
 * @return <array>
 *    Array with file data.
 *    FALSE on error.
 */
function _ttics_save_image($file, $mbanner_folder = 'public://banner/', $mbanner_thumb_folder = 'public://banner/thumb/') 
{
  // Check directory and create it (if not exist)
  _ttics_check_dir($mbanner_folder);
  _ttics_check_dir($mbanner_thumb_folder);

  $parts = pathinfo($file->filename);
  $destination = $mbanner_folder . $parts['basename'];
  $setting = array();

  $file->status = FILE_STATUS_PERMANENT;
  
  // Copy temporary image into banner folder
  if ($img = file_copy($file, $destination, FILE_EXISTS_REPLACE)) {
    // Generate image thumb
    $image = image_load($destination);
    $small_img = image_scale($image, 300, 100);
    $image->source = $mbanner_thumb_folder . $parts['basename'];
    image_save($image);

    // Set image info
    $setting['image_path'] = $destination;
    $setting['image_thumb'] = $image->source;
    $setting['image_title'] = '';
    $setting['image_description'] = '';
    $setting['image_url'] = '<front>';
    $setting['image_weight'] = 0;
    $setting['image_published'] = FALSE;
    $setting['image_visibility'] = '*';

    return $setting;
  }
  
  return FALSE;
}

/**
 * Provvide default installation settings for ttics.
 */
function _ttics_install() {
  // Deafault data
  $file = new stdClass;
  $mbanners = array();
  // Source base for images
  
  $src_base_path = drupal_get_path('theme', 'ttics');
  $default_mbanners = theme_get_setting('default_mbanners');
  dpm(get_defined_vars());
  // Put all image as banners
  foreach ($default_mbanners as $i => $data) {
    $file->uri = $src_base_path . '/' . $data['image_path'];
    $file->filename = $file->uri;

    $mbanner = _ttics_save_image($file);
    unset($data['image_path']);
    $mbanner = array_merge($mbanner, $data);
    $mbanners[$i] = $mbanner;
  }

  // Save banner data
  ttics_set_minibanners($mbanners);

  // Flag theme is installed
  variable_set('theme_ttics_first_install', FALSE);
}

/**
 * Generate form to mange banner informations
 *
 * @param <array> 
 *    Array with image data
 *
 * @return <array>
 *    Form to manage image informations
 */
function _ttics_minibanner_form($image_data) 
{
    $img_form = array();

    // Image preview
    $img_form['image_preview'] = array(
      '#markup' => theme('image', array('path' => $image_data['image_thumb'])),
    );

    // Image path
    $img_form['image_path'] = array(
      '#type' => 'hidden',
      '#value' => ['image_path'],
    );

    // Thumbnail path
    $img_form['image_thumb'] = array(
      '#type' => 'hidden',
      '#value' => ['image_thumb'],
    );

    // Image title
    $img_form['image_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => ['image_title'],
    );

    // Image description
    $img_form['image_description'] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
      '#default_value' => ['image_description'],
    );

    // Link url
    $img_form['image_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Url'),
      '#default_value' => ['image_url'],
    );

    // Image visibility
    $img_form['image_visibility'] = array(
      '#type' => 'textarea',
      '#title' => t('Visibility'),
      '#description' => t("Specify pages by using their paths. Enter one path per line. The '*' character is a wildcard. Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page.", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>')),
      '#default_value' => ['image_visibility'],
    );

    // Image weight
    $img_form['image_weight'] = array(
      '#type' => 'weight',
      '#title' => t('Weight'),
      '#default_value' => ['image_weight'],
    );

    // Image is published
    $img_form['image_published'] = array(
      '#type' => 'checkbox',
      '#title' => t('Published'),
      '#default_value' => ['image_published'],
    );

    // Delete image
    $img_form['image_delete'] = array(
      '#type' => 'checkbox',
      '#title' => t('Delete image.'),
      '#default_value' => FALSE,
    );

    return $img_form;
}
