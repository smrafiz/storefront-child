<?php
/**
 * Template Name: ShopBuilder Template
 *
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
    <?php get_template_part('page-template/header'); ?>
	<div id="content" class="site-content" tabindex="-1">
			<?php
			do_action( 'storefront_content_top' );

?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) :
					the_post();

					do_action( 'storefront_page_before' );

					get_template_part( 'content', 'page' );

					/**
					 * Functions hooked in to storefront_page_after action
					 *
					 * @hooked storefront_display_comments - 10
					 */
					do_action( 'storefront_page_after' );

				endwhile; // End of the loop.
				?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- #content -->
<?php get_template_part('page-template/footer'); ?>

