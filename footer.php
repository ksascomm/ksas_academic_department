<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>


<footer class="footer">
	<div class="footer-container">
		<div class="grid-x grid-padding-x hide-for-print">
			<div class="small-12 large-3 cell quicklinks">
			<?php
			// Check Theme Options for Quicklinks setting.
				$theme_option = flagship_sub_get_global_options();
			if ( $theme_option['flagship_sub_quicklinks'] == '1' ) {
				global $switched;
				$quicklinks_id = $theme_option['flagship_sub_quicklinks_id'];
				switch_to_blog( $quicklinks_id ); }

				// Quicklinks Menu.
				wp_nav_menu(
					array(
						'theme_location' => 'quick_links',
						'menu_class'     => 'vertical menu drilldown',
						'items_wrap'     => '<ul id="%1$s" class="%2$s" data-drilldown data-auto-height="true" data-animate-height="true">%3$s</ul>',
						'fallback_cb'    => false,
					)
				);

				// Return to current site.
				if ( $theme_option['flagship_sub_quicklinks'] == '1' ) {
					restore_current_blog();
				}
				?>

			</div>
			<div class="small-12 large-6 cell">
				<ul id="menu-footer-links" class="menu" role="menu">
					<li role="menuitem"><a href="<?php echo esc_url( get_site_url() ); ?>/sitemap/" target="_blank">Sitemap</a></li>
					<li role="menuitem"><a href="https://accessibility.jhu.edu/" target="_blank">Accessibility</a></li>
					<li role="menuitem"><a href="https://jobs.jhu.edu/" target="_blank">Careers</a></li>
					<li role="menuitem"><a href="https://it.johnshopkins.edu/policies/privacystatement" target="_blank">Privacy Statement</a></li>
				</ul>
			</div>
			<div class="small-12 large-3 cell social-media">
				<a href="http://facebook.com/JHUArtsSciences"><span class="fab fa-facebook fa-2x"></span><span class="screen-reader-text">Facebook</span></a>
				<a href="https://www.instagram.com/JHUArtsSciences/"><span class="fab fa-instagram fa-2x"></span><span class="screen-reader-text">Instagram</span></a>
				<a href="https://twitter.com/JHUArtsSciences"><span class="fab fa-twitter fa-2x"></span><span class="screen-reader-text">Twitter</span></a>
				<a href="https://www.youtube.com/jhuartssciences"><span class="fab fa-youtube fa-2x"></span><span class="screen-reader-text">YouTube</span></a>
			</div>
		</div>
		<div class="grid-x">
			<div class="small-12 cell copydate">
				<a href="https://www.jhu.edu/" class="hide-for-print">
					<img class="jhushield" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/university.logo.white.png" alt="Johns Hopkins University"  width="567" height="109" loading="lazy">
				</a>
				<p>&copy; <?php print gmdate( 'Y' ); ?> Johns Hopkins University, <?php echo $theme_option['flagship_sub_copyright']; ?></p>
			</div>
		</div>
	</div>
</footer>


<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
