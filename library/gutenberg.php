<?php
if ( ! function_exists( 'foundationpress_gutenberg_support' ) ) :
	function foundationpress_gutenberg_support() {
    // Add foundation color palette to the editor
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'Heritage Blue', 'ksasacademic' ),
            'slug' => 'heritage',
            'color' => '#002d72',
        ),
        array(
            'name' => __( 'Spirit Blue', 'ksasacademic' ),
            'slug' => 'spirit',
            'color' => '#68ace5',
        ),
        array(
            'name' => __( 'Black', 'ksasacademic' ),
            'slug' => 'black',
            'color' => '#31261d',
        ),
    ) );
	}
	add_action( 'after_setup_theme', 'foundationpress_gutenberg_support' );

	// Disable custom colors
	add_theme_support( 'disable-custom-colors' );

	// Set normal font size
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'Normal', 'ksasacademic' ),
			'shortName' => __( 'N', 'ksasacademic' ),
			'size' => 16,
			'slug' => 'normal'
		),
	) );

	// Disable custom font sizing
	add_theme_support( 'disable-custom-font-sizes' );

endif;