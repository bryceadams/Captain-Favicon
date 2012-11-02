<?php

function ctfavicon_usage() {
	$ctfavicon_options = get_option( 'ctfavicon_options' );
	
	if ( $ctfavicon_options['favicon'] != '' ) {
		echo '<link rel="icon" href="' . $ctfavicon_options['favicon'] . '" type="image/x-icon" />';
    } else {
	    return;
    }
}
add_action( 'wp_head', 'ctfavicon_usage' );  
