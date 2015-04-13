<?php 

/*
This code is intended to allow you to add custom options to the existing Genesis settings pages. 
*/

function iamp_defaults($defaults) {
  $defaults['option1'] = '';
  $defaults['option2'] = '';
  
  return $defaults;
}

add_action('genesis_theme_settings_defaults', 'iamp_defaults');

// now sanitize the inputs, in this case we go for no HTML

function iamp_register_sanitization_filters() {
  genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD,
		array(
			'option1',
			'option2',
		) );
}
add_action( 'genesis_settings_sanitizer_init', 'iamp_register_sanitization_filters' );

// now register the settings box itself

function iamp_register_settings_box( $_genesis_theme_settings_pagehook ) {
  add_meta_box('iamp-settings-box', 'ThemeName Theme Options', 'iamp_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high');
}
add_action('genesis_theme_settings_metaboxes', 'iamp_register_settings_box');

// and finally, we'll create the options box itself.

function iamp_settings_box() {
  ?>
 	<strong>Home Page Options</strong>
 	<i>Please note that this section does not support HTML</i><br />
	
	<p>Option 1:<br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[option1]" value="<?php echo esc_attr( genesis_get_option('option1') ); ?>" size="80" /> </p>
 
	<p>Option 2:<br />
	<textarea name="<?php echo GENESIS_SETTINGS_FIELD; ?>[option2]" style="margin: 1px; width: 589px; height: 70px;"><?php echo esc_attr( genesis_get_option('option2') ); ?></textarea> </p>
 
	<?php
}
?>