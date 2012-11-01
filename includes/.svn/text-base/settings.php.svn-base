<?php
function ctfavicon_get_default_options() {
	$options = array(
		'favicon' => ''
	);
	return $options;
}

// NOT NEEDED FOR NOW
/*function ctfavicon_options_init() {
     $ctfavicon_options = get_option( 'ctfavicon_options' );
	 
     if ( false === $ctfavicon_options ) {
		  // If not, we'll save our default options
          $ctfavicon_options = ctfavicon_get_default_options();
		  add_option( 'ctfavicon_options', $ctfavicon_options );
     }
	 
}
register_activation_hook( __FILE__, 'ctfavicon_options_init' );*/

function ctfavicon_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
	}
}
add_action( 'admin_init', 'ctfavicon_options_setup' );

function replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		$referer = strpos( wp_get_referer(), 'ctfavicon-settings' );
		if ( $referer != '' ) {
			return __('Set As Favicon', 'ctfavicon' );
		}
	}

	return $translated_text;
}

function ctfavicon_menu_options() {
     add_submenu_page(
		'options-general.php',
		__( 'Captain Favicon Settings', 'ctfavicon' ),
		__( 'Captain Favicon', 'ctfavicon' ),
		'administrator',
		'ctfavicon-settings',
		'ctfavicon_admin_options_page'
	);
}
// Load the Admin Options page
add_action('admin_menu', 'ctfavicon_menu_options');

function ctfavicon_admin_options_page() {
	?>
		<div class="wrap">
			
			<?php screen_icon(); ?>
		
			<h2><?php _e( 'Captain Favicon Settings', 'ctfavicon' ); ?></h2>
			
			<?php settings_errors( 'ctfavicon-settings-errors' ); ?>
			
			<form id="form-ctfavicon-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('ctfavicon_options');
					do_settings_sections('ctfavicon');
				?>
			
				<p class="submit">
					<input name="ctfavicon_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'ctfavicon'); ?>" />
					<input name="ctfavicon_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'ctfavicon'); ?>" />		
				</p>
			
			</form>
			
		</div>
	<?php
}

function ctfavicon_options_validate( $input ) {
	$default_options = ctfavicon_get_default_options();
	$valid_input = $default_options;
	
	$ctfavicon_options = get_option('ctfavicon_options');
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_favicon = ! empty($input['delete_favicon']) ? true : false;
	
	if ( $submit ) {
		if ( $ctfavicon_options['favicon'] != $input['favicon']  && $ctfavicon_options['favicon'] != '' )
			delete_image( $ctfavicon_options['favicon'] );
		
		$valid_input['favicon'] = $input['favicon'];
	}
	elseif ( $reset ) {
		delete_image( $ctfavicon_options['favicon'] );
		$valid_input['favicon'] = $default_options['favicon'];
	}
	elseif ( $delete_favicon ) {
		delete_image( $ctfavicon_options['favicon'] );
		$valid_input['favicon'] = '';
	}
	
	return $valid_input;
}

function delete_image( $image_url ) {
	global $wpdb;
	
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
	$results = $wpdb -> get_results($query);
	
	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}

/********************* JAVASCRIPT ******************************/
function ctfavicon_options_enqueue_scripts() {

	if (isset($_GET['page']) && $_GET['page'] == 'ctfavicon-settings') {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('ctfavicon-upload', plugins_url( '/js/upload.js', __FILE__ ), array( 'jquery','media-upload','thickbox'), false, true );
		
	}
	
}
add_action('admin_enqueue_scripts', 'ctfavicon_options_enqueue_scripts');


function ctfavicon_options_settings_init() {
	register_setting( 'ctfavicon_options', 'ctfavicon_options', 'ctfavicon_options_validate' );
	
	add_settings_section('ctfavicon_settings_header', __( '', 'ctfavicon' ), 'ctfavicon_settings_header_text', 'ctfavicon');
	
	add_settings_field('ctfavicon_setting_favicon',  __( 'Favicon', 'ctfavicon' ), 'ctfavicon_setting_favicon', 'ctfavicon', 'ctfavicon_settings_header');
	
	add_settings_field('ctfavicon_setting_favicon_preview',  __( 'Favicon Preview', 'ctfavicon' ), 'ctfavicon_setting_favicon_preview', 'ctfavicon', 'ctfavicon_settings_header');
}
add_action( 'admin_init', 'ctfavicon_options_settings_init' );

function ctfavicon_setting_favicon_preview() {
	$ctfavicon_options = get_option( 'ctfavicon_options' );  ?>
	<div id="upload_favicon_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $ctfavicon_options['favicon'] ); ?>" />
	</div>
	<?php
}

function ctfavicon_settings_header_text() {
	?>
		<p><?php _e( 'Upload Your Favicon! You can use a service like <a href="http://favicon.cc/">favicon.cc</a> to create it. Need Help? View <a href="http://captaintheme.com/docs/captain-favicon-documentation/">Captain Favicon Documentation</a>.', 'ctfavicon' ); ?></p>
	<?php
}

function ctfavicon_setting_favicon() {
	$ctfavicon_options = get_option( 'ctfavicon_options' );
	?>
		<input type="hidden" id="favicon_url" name="ctfavicon_options[favicon]" value="<?php echo esc_url( $ctfavicon_options['favicon'] ); ?>" />
		<input id="upload_favicon_button" type="button" class="button" value="<?php _e( 'Upload Favicon', 'ctfavicon' ); ?>" />
		<?php if ( '' != $ctfavicon_options['favicon'] ): ?>
			<input id="delete_favicon_button" name="ctfavicon_options[delete_favicon]" type="submit" class="button" value="<?php _e( 'Delete Favicon', 'ctfavicon' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload a 16px x 16px image. If you want retina-support, upload a 32px x 32px image.', 'ctfavicon' ); ?></span>
	<?php
}



?>