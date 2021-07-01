<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

register_nav_menus(
	array(
		'top-bar-r'   => esc_html__( 'Right Top Bar', 'ksasacademic' ),
		'mobile-nav'  => esc_html__( 'Mobile', 'ksasacademic' ),
		'quick_links' => esc_html__( 'Quick Links', 'ksasacademic' ),
	)
);


/**
 * Desktop navigation - right top bar
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'ksasacademic_top_bar_r' ) ) {
	function ksasacademic_top_bar_r() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'dropdown menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s desktop-menu" data-dropdown-menu aria-label="Primary Navigation">%3$s</ul>',
				'theme_location' => 'top-bar-r',
				'depth'          => 2,
				'fallback_cb'    => false,
				'walker'         => new Ksasacademic_Top_Bar_Walker(),
			)
		);
	}
}


/**
 * Mobile navigation - topbar (default) or offcanvas
 */
if ( ! function_exists( 'ksasacademic_mobile_nav' ) ) {
	function ksasacademic_mobile_nav() {
		wp_nav_menu(
			array(
				'container'      => false,                         // Remove nav container
				'menu'           => __( 'mobile-nav', 'ksasacademic' ),
				'menu_class'     => 'vertical menu',
				'theme_location' => 'mobile-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu data-submenu-toggle="true" aria-label="Mobile Navigation">%3$s</ul>',
				'fallback_cb'    => false,
				'walker'         => new Ksasacademic_Mobile_Walker(),
			)
		);
	}
}


/**
 * Add support for buttons in the top-bar menu:
 * 1) In WordPress admin, go to Apperance -> Menus.
 * 2) Click 'Screen Options' from the top panel and enable 'CSS CLasses' and 'Link Relationship (XFN)'
 * 3) On your menu item, type 'has-form' in the CSS-classes field. Type 'button' in the XFN field
 * 4) Save Menu. Your menu item will now appear as a button in your top-menu
*/
if ( ! function_exists( 'ksasacademic_add_menuclass' ) ) {
	function ksasacademic_add_menuclass( $ulclass ) {
		$find    = array( '/<a rel="button"/', '/<a title=".*?" rel="button"/' );
		$replace = array( '<a rel="button" class="button"', '<a rel="button" class="button"' );

		return preg_replace( $find, $replace, $ulclass, 1 );
	}
	add_filter( 'wp_nav_menu', 'ksasacademic_add_menuclass' );
}

// remove menu-item-id from <li> in navigation. ksasaca_css_attributes_filter is in ksas_global_functions.php plugin.
add_filter( 'nav_menu_item_id', 'ksasaca_css_attributes_filter', 100, 1 );
