<?php 
/**
 * Add specific favicons if not custom set.
 *
 */

add_action( 'wp_head',    'ksas_default_site_icon', 99 );
add_action( 'login_head', 'ksas_default_site_icon', 99 );

function ksas_default_site_icon()
{
    if( ! has_site_icon()  && ! is_customize_preview() )
    {
       echo '<link rel="shortcut icon" type="image/png" href="'.get_template_directory_uri().'/dist/assets/images/favicons/favicon.ico" />';
    	
		echo '<link rel="icon" type="image/png" sizes="16x16" href="'.get_template_directory_uri().'/dist/assets/images/favicons/favicon-16x16.png" />';
		echo '<link rel="icon" type="image/png" sizes="32x32" href="'.get_template_directory_uri().'/dist/assets/images/favicons/favicon-32x32.png" />';
		echo '<link rel="icon" type="image/png" sizes="96x96" href="'.get_template_directory_uri().'/dist/assets/images/favicons/favicon-96x96.png" />';

		echo '<link rel="apple-touch-icon" sizes="120x120" href="'.get_template_directory_uri().'/dist/assets/images/favicons/apple-touch-icon-120x120.png" />';
		echo '<link rel="apple-touch-icon" sizes="152x152" href="'.get_template_directory_uri().'/dist/assets/images/favicons/apple-touch-icon-152x152.png" />';
		echo '<link rel="apple-touch-icon" sizes="180x180" href="'.get_template_directory_uri().'/dist/assets/images/favicons/apple-touch-icon-180x180.png" />';
    }
}