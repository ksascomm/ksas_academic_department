<?php
/**
 * Adds Widget Title Shortcode and custom sidebar widget metabox
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

/**  Add Widget Title shortcode */
function sidebar_title_shortcode( $attr, $content = null ) {
	return '<div class="widget_title"><h5>' . $content . '</h5></div>';
}
add_shortcode( 'sidebar-title', 'sidebar_title_shortcode' );

/**  Register meta box */
function ksasacademic_add_meta_box() {

	$post_types = array( 'page' );

	foreach ( $post_types as $post_type ) {

		add_meta_box(
			'ksasacademic_meta_box',         // Unique ID of meta box.
			'Custom Sidebar Widget',         // Title of meta box.
			'ksasacademic_display_meta_box', // Callback function.
			$post_type                       // Post type.
		);

	}

}
add_action( 'add_meta_boxes', 'ksasacademic_add_meta_box' );

/** Display meta box */
function ksasacademic_display_meta_box( $post ) {

	$value = get_post_meta( $post->ID, '_ksasacademic_meta_key', true );

	wp_nonce_field( basename( __FILE__ ), 'ksasacademic_meta_box_nonce' );

	?>

	<label for="ksasacademic-meta-box">Select a Custom Sidebar</label>
	<select id="ksasacademic-meta-box" name="ksasacademic-meta-box">
		<option value="">Select sidebar...</option>
		<option value="sidebar-1" <?php selected( $value, 'sidebar-1' ); ?>>Sidebar 1</option>
		<option value="sidebar-2" <?php selected( $value, 'sidebar-2' ); ?>>Sidebar 2</option>
	</select>

	<?php

}

/** Save Meta Box */
function ksasacademic_save_meta_box( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	$is_valid_nonce = false;

	if ( isset( $_POST['ksasacademic_meta_box_nonce'] ) ) {

		if ( wp_verify_nonce( wp_unslash( $_POST['ksasacademic_meta_box_nonce'], basename( __FILE__ ) ) ) ) {

			$is_valid_nonce = true;

		}
	}

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( array_key_exists( 'ksasacademic-meta-box', $_POST ) ) {

		update_post_meta(
			$post_id,                                              // Post ID.
			'_ksasacademic_meta_key',                              // Meta key.
			sanitize_text_field( wp_unslash( $_POST['ksasacademic-meta-box'] ) ) // Meta value.
		);

	}

}
add_action( 'save_post', 'ksasacademic_save_meta_box' );
