<?php
/**
 * Register widget areas
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_sidebar_widgets' ) ) :
function foundationpress_sidebar_widgets() {
		register_sidebar(
        array(
			'name'          => 'Default Sidebar',
			'id'            => 'page-sb',
			'description'   => 'This is the default sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content %1$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget_title"><h4>',
			'after_title'   => '</h4></div>',
		)
		);

		register_sidebar(
			array(
				'name'          => 'Graduate Sidebar',
				'id'            => 'graduate-sb',
				'description'   => 'This sidebar will appear on pages under Graduate',
				'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content %1$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => 'Undergraduate Sidebar',
				'id'            => 'undergrad-sb',
				'description'   => 'This sidebar will appear on pages under Undergraduate',
				'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content %1$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => 'Research Sidebar',
				'id'            => 'research-sb',
				'description'   => 'This sidebar will appear on pages under Research',
				'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content %1$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => 'Homepage Sidebar',
				'id'            => 'homepage-sb',
				'description'   => 'This sidebar will only appear on the homepage',
				'before_widget' => '<aside aria-label="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => 'Homepage Featured Sidebar',
				'id'            => 'homepage-featured-sb',
				'description'   => 'This sidebar will only appear on the "Front (Buckets)" template',
				'before_widget' => '<aside aria-label="%1$s" class="widget home-featured %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h3>',
				'after_title'   => '</h3></div>',
			)
		);			

		register_sidebar(
			array(
				'name'          => 'News Archive Sidebar',
				'id'            => 'archive-sb',
				'description'   => 'This sidebar will only appear on the news archive page',
				'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
			)
		);

		register_sidebar( array(
				'name' => 'Custom Sidebar 1',
				'id' => 'sidebar-1',
				'description' => __('Custom Sidebar #1. This sidebar will only appear when selected on the page editor', 'foundationpress'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
		));

		register_sidebar( array(
				'name' => 'Custom Sidebar 2',
				'id' => 'sidebar-2',
				'description' => __('Sidebar #2. This sidebar will only appear when selected on the page editor', 'foundationpress'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h4>',
				'after_title'   => '</h4></div>',
		));			
}

add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );
endif;
