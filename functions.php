<?php
add_action( 'wp_enqueue_scripts', 'storefront_child_styles', 18 );
add_action( 'after_setup_theme', 'child_theme_setup', 11 );
add_action( 'after_setup_theme', 'elementor_widgets' );


add_action( 'init', 'sb_custom_post_type_sb_widgets', 9 );
// Add this code to your theme's functions.php or create a new plugin

add_action( 'init', 'sb_custom_taxonomies_type_sb_widgets', 9 );
add_action( 'admin_menu', 'sb_custom_add_metabox' );
add_action( 'save_post', 'sb_custom_save_metaboxes' );

add_filter( 'upload_mimes',	 'storefront_child_themes_mime_types' );
add_shortcode('sb_widgets_tab_shortcode', 'widgets_tab_shortcode');


function storefront_child_styles() {
	wp_dequeue_style( 'storefront-fonts' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap', array(), '1.0.0' );
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/assets/css
	/child-style.css', array(), time() );


	wp_enqueue_style( 'child-style', get_stylesheet_uri() );
	wp_enqueue_script( 'isotop', get_stylesheet_directory_uri() . '/assets/js/isotop.pkgd.min.js', array( 'jquery' ),time(),true );
	wp_enqueue_script( 'child-theme', get_stylesheet_directory_uri() . '/assets/js/child-theme.js', array( 'jquery' ), time(),true );
}

function elementor_widgets() {
	if ( did_action( 'elementor/loaded' ) ) {
		require_once 'inc/elementor/init.php';
	}
}

function child_theme_setup() {
	/*Header*/
	remove_action( 'storefront_header', 'storefront_site_branding', 20 );
	remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
	remove_action( 'storefront_header', 'storefront_product_search', 40 );
	remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
	remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
	add_action( 'storefront_header', 'child_theme_storefront_header_wrapper_start', 43 );
	add_action( 'storefront_header', 'child_theme_storefront_brand_logo', 44 );
	add_action( 'storefront_header', 'child_theme_storefront_primary_navigation_wrapper', 45 );
	remove_action( 'storefront_header', 'storefront_header_cart', 60 );
	remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );
	remove_action( 'storefront_header', 'child_theme_storefront_primary_navigation_wrapper_close', 68 );
	add_action( 'storefront_header', 'child_theme_storefront_price_button', 69 );
	add_action( 'storefront_header', 'child_theme_storefront_header_wrapper_end', 70 );
	add_filter( 'storefront_menu_toggle_text', function( $text ) {
		return '';
	}, 10 );

	/*Footer*/
	remove_action( 'storefront_footer', 'storefront_credit', 20 );
	add_action( 'storefront_footer', 'child_theme_storefront_credit', 20 );
	add_action( 'storefront_before_footer', 'child_theme_storefront_footer_upper' );

}

function child_theme_storefront_footer_upper() {
	?>
    <div class="col-full">
        <div class="footer-banner">
            <div class="shape1"></div>
            <div class="shape2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer-shape.png" alt="shape">
            </div>
            <div class="banner-text">
                <p><span>Join us today</span> and let’s help you</p>
                <p>to Build your Next <span>WooCommerce Shop</span></p>
            </div>
            <div class="button-area">
                <a href="" class="btn-style1">
                    <span>Let’s Make Your Store</span>
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </div>
        </div>
    </div>
	<?php
}

function child_theme_storefront_credit() {
	?>
    <div class="copyright-area site-info">
        <div class="copy-text">
			<?php printf( '<p>© 2015 - 2023 <a href="%s">RadiusTheme</a>, All Rights Reserved.</p>', esc_url( 'https://www.radiustheme.com/' ) ); ?>
        </div>
        <ul class="payment">
            <li><?php esc_html_e( 'Secure Payment:', 'storefront-child' ); ?></li>
            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/payment-method.png"
                     alt="Payment method"></li>
        </ul>
    </div>
	<?php
}

function child_theme_storefront_price_button() {
	?>
    <div class="shopbuilder-button">
        <a href="https://wordpress.org/plugins/shopbuilder/" target="_blank"><?php esc_html_e( 'Download Now', 'storefront-child' ); ?></a>
    </div>
	<?php
}

function child_theme_storefront_header_wrapper_start() {
	echo '<div class="shopbuilder-header-wrapper">';
}

function child_theme_storefront_header_wrapper_end() {
	echo '</div>';
}

function child_theme_storefront_brand_logo() {

	?>
    <div class="site-branding">
		<?php
		if ( is_front_page() ) {
			?>
            <a class="light-logo" href="<?php echo esc_url( site_url() ); ?>">
                <img width="199" height="51"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/white-logo.svg" alt="logo">
            </a>
            <a width="199" height="51" class="dark-logo" href="<?php echo esc_url( site_url() ); ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/dark-logo.svg" alt="logo">
            </a>
			<?php
		} else {
			storefront_site_title_or_logo();
		}

		?>
    </div>
	<?php
}

function child_theme_storefront_primary_navigation_wrapper() {
	echo '<div class="storefront-primary-navigation">';
}

function child_theme_storefront_primary_navigation_wrapper_close() {
	echo '</div>';
}

function sb_custom_post_type_sb_widgets() {
	$labels = array(
		'name'               => 'SB Widgets',
		'singular_name'      => 'SB Widget',
		'menu_name'          => 'SB Widgets',
		'name_admin_bar'     => 'SB Widget',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New SB Widget',
		'new_item'           => 'New SB Widget',
		'edit_item'          => 'Edit SB Widget',
		'view_item'          => 'View SB Widget',
		'all_items'          => 'All SB Widgets',
		'search_items'       => 'Search SB Widgets',
		'parent_item_colon'  => 'Parent SB Widgets:',
		'not_found'          => 'No sb widgets found.',
		'not_found_in_trash' => 'No sb widgets found in Trash.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'sb_widgets' ), // The URL slug for your post type
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'sb_widget', $args );
}

function sb_custom_taxonomies_type_sb_widgets() {
	$labels = array(
		'name'              => 'Widget Categories',
		'singular_name'     => 'Widget Categorie',
		'search_items'      => 'Search Widget Categories',
		'all_items'         => 'All Widget Categories',
		'parent_item'       => 'Parent Widget Categorie',
		'parent_item_colon' => 'Parent Widget Categorie:',
		'edit_item'         => 'Edit Widget Categorie',
		'update_item'       => 'Update Widget Categorie',
		'add_new_item'      => 'Add New Widget Categorie',
		'new_item_name'     => 'New Widget Categorie Name',
		'menu_name'         => 'Widget Categories',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'widget_category' ),
	);

	register_taxonomy( 'widget_category', 'sb_widget', $args );
}

function sb_custom_add_metabox() {
	add_meta_box( 'sb_widget_post_metabox', 'ShopBuilder Widget Option', 'render_metabox_box', 'sb_widget', 'side', 'default' );
}

function sb_custom_save_metaboxes( $post_id ) {

	if ( ! isset( $_POST['sb_widget_post_nonce'] ) ) {
		return $post_id;
	}

	$nonce = $_POST['sb_widget_post_nonce'];

	if ( ! wp_verify_nonce( $nonce, 'sb_widget_post_meta' ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	$data = array(
		'is_pro'  => isset( $_POST['sb_widget_is_pro'] ) ? 1 : 0,
		'badge'   => sanitize_text_field( $_POST['sb_widget_badge'] ),
		'btn_url' => sanitize_url( $_POST['sb_widget_btn_link'] ),
	);

	update_post_meta( $post_id, '_sb_widget_post_meta_key', $data );
}

function render_metabox_box( $post ) {
	wp_nonce_field( 'sb_widget_post_meta', 'sb_widget_post_nonce' );

	$data = get_post_meta( $post->ID, '_sb_widget_post_meta_key', true );

	$is_pro = isset( $data['is_pro'] ) ? $data['is_pro'] : false;

	$badge = isset( $data['badge'] ) ? $data['badge'] : '';

	$btn_url = isset( $data['btn_url'] ) ? $data['btn_url'] : '';

	?>
    <div class="meta-container">
        <label class="meta-label w-50 text-left" for="sb_widget_is_pro">Is Pro?</label>
        <div class="text-right w-50 inline">
            <div class="ui-toggle inline"><input type="checkbox" id="sb_widget_is_pro" name="sb_widget_is_pro"
                                                 value="1" <?php echo $is_pro ? 'checked' : ''; ?>>
                <label for="sb_widget_is_pro">
                    <div></div>
                </label>
            </div>
        </div>
    </div>
    <p>
        <label class="meta-label" for="sb_widget_badge">Widget Badge</label>
        <input type="text" id="sb_widget_badge" name="sb_widget_badge" class="widefat"
               value="<?php echo esc_attr( $badge ); ?>">
    </p>
    <p>
        <label class="meta-label" for="sb_widget_btn_link">Widget Title Link</label>
        <input type="url" id="sb_widget_btn_link" name="sb_widget_btn_link" class="widefat"
               value="<?php echo esc_attr( $btn_url ); ?>">
    </p>

	<?php
}
function storefront_child_themes_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
function widgets_tab_shortcode(){
    ob_start();
	$uniqueid = time() . rand( 1, 99 );
	$count    = 0;
	$terms = get_terms(
		[
			'taxonomy'   => 'widget_category',
			'hide_empty' => true,
			'orderby' => 'name',
			'order' => 'DSC',
		]
	);

    ?>

    <div class="isotop-wrapper" id="inner-isotope">
        <div class="filter-wrapper">
            <div class="isotope-classes-tab">
                <a class="nav-item current" data-filter="*"><?php echo esc_html__( 'All Widgets', 'storefront-child' ); ?></a>
                <?php
                 foreach ( $terms as $term ):
                     $term_name = str_replace(' ','-',strtolower($term->name));
                     ?>
                     <a class="nav-item" data-filter=".<?php echo esc_attr( $term_name ); ?>"><?php echo esc_html( $term->name  ); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
            $args = array(
                'post_type'      => 'sb_widget',
                'posts_per_page' => -1,
                'orderby'        => 'name',
                'order'          => 'DSC',
                'post_status'   =>'publish'
            );
            $query = new \WP_Query($args);

        ?>
        <div id="preloader">
            <div class="loader"></div>
        </div>
        <div class="widgets-wrapper">
            <div class="featuredContainer">
                <?php if ($query->have_posts()){
                    while ($query->have_posts()){
                        $query->the_post();
	                    $terms = wp_get_post_terms( get_the_ID(), 'widget_category' );
                        $single_term = $terms[0];
	                    $single_term = str_replace(' ','-',strtolower($single_term->name));
                        $meta = get_post_meta(get_the_ID(),'_sb_widget_post_meta_key',true);
	                    $is_pro =  $meta['is_pro'] == 1 ? 'Pro' : '';

	                    $badge =  $meta['badge']  ? $meta['badge'] : '';

	                    $btn_url =  $meta['btn_url']  ? $meta['btn_url'] : '';

                ?>
                    <div class="<?php echo esc_attr( $single_term ); ?>">
                        <div class="widget-box">
                            <?php
                            if (!empty($is_pro)){
                                ?>
                                <div class="badge"><?php echo esc_html($badge); ?></div>
                            <?php } ?>
                            <?php
                                if (!empty($is_pro)){
                                ?>
                                    <div class="pro-badge"><?php esc_html_e('Pro','storefront-child'); ?></div>
                            <?php } ?>
                            <div class="media-icon">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <h3 class="title"><a target="_blank" href="<?php echo esc_url($btn_url); ?>"><?php the_title(); ?></a></h3>
                        </div>
                    </div>
                <?php
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>

    </div>
    <?php
	if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
		?>
        <script>jQuery('.featuredContainer').isotope();</script>
		<?php
	}
    return ob_get_clean();
}

add_filter( 'woocommerce_get_image_size_single', function( $size ) {
	return array(
		'width' => 600,
		'height' => 720,
		'crop' => 0,
	);
}, 99 );

add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
	return array(
		'width' => 500,
		'height' => 600,
		'crop' => 0,
	);
}, 99 );

add_action( 'pre_get_posts', 'sb_modify_rtsb_templates_page' );
function sb_modify_rtsb_templates_page( $q ) {
    if ( is_admin() ) {
        return $q;
    }

	$p_ids = [ 5734, 5740, 5751, 5773, 5797, 5837, 5860, 5895, 5900, 5911, 5916, 5924, 5935, 5937, 5943, 5948, 5960, 5966 ];

	if ( 'rtsb_builder' === get_post_type( get_the_id() ) ) {
		$page = get_queried_object();

		if ( 2061 === $page->ID || 7836 === $page->ID || 7887 === $page->ID || 7932 === $page->ID || 2059 === $page->ID || 2064 === $page->ID || 2065 === $page->ID ) {
			$q->set( 'post__not_in', $p_ids );
		}

		if ( 2059 === $page->ID ) {
			$q->set( 'posts_per_page', 15 );
		}
	}

    if ( is_post_type_archive( 'product' ) ) {
	    $q->set( 'post__not_in', $p_ids );
	    $q->set( 'posts_per_page', 9 );
    }

    return $q;
}

add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
	return 'medium';
} );

add_filter( 'woocommerce_get_endpoint_url', 'rtsb_my_account_endpoint_urls', 10, 4 );
function rtsb_my_account_endpoint_urls( $url, $endpoint, $value, $permalink ) {
	$page = get_queried_object();

	if ( is_user_logged_in() && 'rtsb_builder' !== $page->post_type ) {
		return $url;
	}

	switch ( $endpoint ) {
		case 'orders':
			$url = home_url( '/rtsb-template/my-account-order-template-1/' );
			break;
		case 'downloads':
			$url = home_url( '/rtsb-template/my-account-downloads-template-1/' );
			break;
		case 'edit-address':
			$url = home_url( '/rtsb-template/my-account-address-template-1/' );
			break;
		case 'edit-account':
			$url = home_url( '/rtsb-template/my-account-details-template-1/' );
			break;
		case 'view-order':
			$url = home_url( '/rtsb-template/my-account-order-details-template-1/' );
			break;
        case 'lost-password':
            $url = home_url( '/rtsb-template/lost-password-template-1/' );
            break;
		case 'customer-logout':
			$url = home_url( '/rtsb-template/login-register-template-1/' );
			break;
	}

	return $url;
}

add_action( 'template_redirect', 'rtsb_custom_redirect' );
function rtsb_custom_redirect() {
	global $wp, $wp_query;

	if ( ! is_user_logged_in() && ( 'my-account' == $wp->request ) || ( 'my-account/my_returns' == $wp->request ) && ( 'lost-password' != $wp->request )
	) {
		wp_safe_redirect( home_url( 'rtsb-template/my-account-dashboard-template-1' ) );
		exit;
	}
}




