<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package photolab
 */
?>
	<div id="secondary" class="widget-area col-sm-3" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="widget" class="widget widget_search">
				<?php dynamic_sidebar( 'home_right_1' ); ?>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
