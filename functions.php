<?php
/**
 * @name Driving
 * @since 1.0.0
 *
 * functions.php
 */

define( 'DRIVING_TEMPLATE', get_template_directory() );

define( 'DRIVING_TEMPLATE_URL', get_template_directory_uri() );

define( 'DRIVING_OBJECT_DIRECTORY', 'objects/' );

define( 'DRIVING_THEME_URL', get_template_directory_uri() );

define( 'DRIVING_SITE_URL', home_url() );

define( 'DRIVING_PLUGIN_DIRECTORY', get_template_directory_uri() . '/includes/plugins/' );

define( 'BLANK_IMAGE', get_template_directory_uri() . '/images/blank.gif' );

$HTTP_HOST = isset( $_SERVER['HTTP_HOST'] ) && ! empty( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';

define( 'HTTP_HOST', $HTTP_HOST );

$REQUEST_URI = isset( $_SERVER['REQUEST_URI'] ) && ! empty( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

define( 'REQUEST_URI', $REQUEST_URI );

/**
 * Initialize VIP
 */
require_once WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php';

// Initialize Postmedia Library
require_once WP_CONTENT_DIR . '/themes/vip/postmedia-plugins/postmedia-library/init.php';

// Load library plugins.
new \Postmedia\Web\Plugins\Video();
new \Postmedia\Web\Plugins\Analytics();
$theme_settings = new \Postmedia\Web\Theme\Settings();
$theme_settings->initialize();

/**
 * Custom image urls based on the host
 */
$cdn_host = sprintf( 'wpmedia.%s', sanitize_text_field( wp_unslash( HTTP_HOST ) ) );

wpcom_vip_load_custom_cdn(
	array(
		'cdn_host_media'  => $cdn_host,
		'disable_ssl'     => true,
		'exclude_preview' => true,
	)
);

unset( $cdn_host );

/**
 * Load the default permastructure
 */
if ( function_exists( 'wpcom_vip_load_permastruct' ) ) {

	wpcom_vip_load_permastruct( '/%make%/%category%/%postname%' );
}

/**
 *  Enable VIP Opengraph
 */
wpcom_vip_enable_opengraph();

/**
 * Load all VIP hosted plugins
 */
wpcom_vip_load_plugin( 'subheading', 'plugins', '1.8' );

wpcom_vip_load_plugin( 'storify' );

wpcom_vip_load_plugin( 'edit-flow' );

wpcom_vip_load_plugin( 'seo-friendly-images-mod' );

wpcom_vip_load_plugin( 'easy-custom-fields' );

wpcom_vip_load_plugin( 'post-revision-workflow' );

wpcom_vip_load_plugin( 'add-meta-tags-mod' );

wpcom_vip_load_plugin( 'zoninator', 'plugins', '0.7' );

wpcom_vip_load_plugin( 'taxonomy-images' );

wpcom_vip_load_plugin( 'json-feed' );

wpcom_vip_require_lib( 'codebird' );

wpcom_vip_load_plugin( 'wp-large-options' );

wpcom_vip_load_plugin( 'external-permalinks-redux' );

wpcom_vip_load_plugin( 'msm-sitemap', 'plugins', '1.3' );

wpcom_vip_load_plugin( 'lazy-load', 'plugins', '0.7' );

wpcom_vip_load_plugin( 'shortcode-ui', 'plugins', '0.7.2' );

wpcom_vip_load_plugin( 'safe-redirect-manager' );

wpcom_vip_load_plugin( 'seo-auto-linker' );

wpcom_vip_load_plugin( 'wpcom-legacy-redirector', 'plugins', '1.3.0' );

wpcom_vip_load_plugin( 'es-wp-query', 'plugins', '0.1.3' );

wpcom_vip_load_plugin( 'wpcom-thumbnail-editor' );

wpcom_vip_load_plugin( 'sailthru', 'plugins', '3.2' );

/**
 * Load all VIP hosted Postmedia-plugins
 */
wpcom_vip_load_plugin( 'inform', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'wp-to-saxotech', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'wp-timbits', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'widget-title-link', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'pointer-plugin', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'ad-mapper', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'dfp-ads', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'category-list', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'pm-es-search', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'pn-video-override', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'postmedia-taxonomy-seo', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'custom-feeds', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'main-taxonomy', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'pm-advertorial-plugin', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'all-in-one-video-pack', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'postmedia-plugin-custom-amp', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'postmedia-plugin-quizzes', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'easy-sidebars', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'postmedia-plugin-layouts', 'postmedia-plugins' );

wpcom_vip_load_plugin( 'wp-async-task', 'postmedia-plugins' );

/**
 * Include class and function files from includes folder
 */
require_once DRIVING_TEMPLATE . '/functions/posts.php';

require_once DRIVING_TEMPLATE . '/functions/author.php';

require_once DRIVING_TEMPLATE . '/functions/global.php';

require_once DRIVING_TEMPLATE . '/functions/ads.php';

require_once DRIVING_TEMPLATE . '/includes/class/content-structure.php'; // Taxonomies, custom post types, rewrite rules

require_once DRIVING_TEMPLATE . '/includes/class/redirects.php'; // Redirects for content from old site

require_once DRIVING_TEMPLATE . '/includes/class/metaboxes.php'; // Class for custom metaboxes

require_once DRIVING_TEMPLATE . '/includes/class/AjaxFunctions.php';

require_once DRIVING_TEMPLATE . '/includes/class/RelatedPosts.php';

require_once DRIVING_TEMPLATE . '/includes/class/ThemeOptions.php';

require_once DRIVING_TEMPLATE . '/includes/class/post-type-buyers-guide.php';

require_once DRIVING_TEMPLATE . '/includes/class/PostImage.php'; // Class to combine and filter image data

require_once DRIVING_TEMPLATE . '/includes/class/TaxonomyCustomFields.php';

require_once DRIVING_TEMPLATE . '/includes/class/MakeModelTaxonomyCustomFields.php';

require_once DRIVING_TEMPLATE . '/includes/class/custom-zone-rss-feed.php'; // Custom Atom feeds for parsing zones from Zoninator

require_once DRIVING_TEMPLATE . '/includes/class/vehicle-ratings/VehicleRatings.php';

require_once DRIVING_TEMPLATE . '/includes/class/page-per-views/PagePerViews.php';

require_once DRIVING_TEMPLATE . '/includes/functions/PostmediaObjectInit.php'; // Site Functions

require_once DRIVING_TEMPLATE . '/includes/functions/elastic-extension.php'; // Site Functions

require_once DRIVING_TEMPLATE . '/includes/functions/social.php';

require_once DRIVING_TEMPLATE . '/includes/functions/smrt.php'; // Digital Innovation Updates

require_once DRIVING_TEMPLATE . '/includes/functions/capabilities.php';

require_once DRIVING_TEMPLATE . '/includes/plugins/story-order-override/StoryOverride.php';

require_once DRIVING_TEMPLATE . '/includes/plugins/pricing-widget-settings/PricingWidgetSettings.php';

require_once DRIVING_TEMPLATE . '/includes/plugins/CustomPostTemplate.php';

require_once DRIVING_TEMPLATE . '/includes/plugins/resource-center/resource-center.php';

require_once DRIVING_TEMPLATE . '/pm_layouts/custom/custom.php';

require_once DRIVING_TEMPLATE . '/includes/common_templates/PostmediaSnippets.php';

require_once DRIVING_TEMPLATE . '/includes/plugins/ads-txt/AdsTxt.php';

/**
 * Load all widgets
 */
require_once DRIVING_TEMPLATE . '/widgets/LatestStories.php'; // Latest Story

require_once DRIVING_TEMPLATE . '/widgets/TopChartbeatStories.php'; // Top Chartbeat Stories

require_once DRIVING_TEMPLATE . '/widgets/UnhaggleWidget.php'; // Featured Comparison

if ( defined( 'WP_CLI' ) && WP_CLI ) {

	require_once DRIVING_TEMPLATE . '/includes/class/WpCliBadgeGeneration.php';

	require_once DRIVING_TEMPLATE . '/includes/class/WpCliDrvCommands.php';
}
/**
 * Require Admin related files.
 */
if ( is_admin() ) {
	require_once DRIVING_TEMPLATE . '/functions/make-model.php';
}

/**
 * Initial setup for driving.com theme
 *
 * This function is attached to the 'after_setup_theme' action hook.
 *
 * @uses DRIVING_TEMPLATE
 */
add_action( 'after_setup_theme', 'drv_setup' );

function drv_setup() {
	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu' ) );

	add_filter( 'grunion_contact_form_success_message', 'drv_modify_thank_you_message' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails', array( 'post', 'pn_pointer', 'buyers-guide', 'quizzes' ) );

	add_image_size( 'search', 150, 100, true );

	add_image_size( 'archive', 185, 125, true );

	add_image_size( 'default', 620, 400, true );

	add_image_size( 'left-column-one', 800, 520, true );

	add_image_size( 'left-column-two', 385, 250, true );

	add_image_size( 'left-column-three', 350, 225, true );

	add_image_size( 'full-width', 1140, 735, true );

	add_image_size( 'big-box', 300, 250, true );

	add_image_size( 'sponsor', 52, 52, true );

	add_image_size( 'slider', 767, 494, true );

	add_image_size( 'hero-large', 1120, 720, true );

	add_image_size( 'hero-medium', 910, 585, true );

	add_image_size( 'hero-small', 320, 205, true );

	add_image_size( 'tab-hero-large', 780, 500, true );

	add_image_size( 'tab-hero-medium', 580, 370, true );

	add_image_size( 'des-archive', 185, 120, true );

	add_image_size( 'mob-archive', 135, 90, true );

	add_image_size( 'buyers-guide-more', 234, 152, true );

	add_image_size( 'newspaper-site', 800, 600, true );

	// social sharing
	add_image_size( 'social-sharing', 600, 315, true );

	add_image_size( 'social-sharing-og', 600, 600, true );

	// newsletter sizes
	add_image_size( 'newsletter-s', 149, 97, true );

	add_image_size( 'newsletter-s-below-featured', 170, 110, true );

	add_image_size( 'newsletter-s-bottom-right', 130, 84, true );

	add_image_size( 'newsletter-m', 208, 134, true );

	add_image_size( 'newsletter-l', 323, 207, true );

	add_image_size( 'newsletter-l_2_1', 495, 248, true );

	add_image_size( 'newsletter-l_80_52', 420, 315, true );

	add_image_size( 'newsletter-xl', 664, 427, true );

	// LEGO
	add_image_size( 'lego', 440, 300, true );

	// Resource center size 2:1 ratio
	add_image_size( 'resource_center', 120, 60, true );

	// Featured image 2:1 ratio image
	add_image_size( 'featured_2_1', 960, 480, true );

	// Extra large image 2:1 ratio image
	add_image_size( 'extra_large_2_1', 1200, 600, true );

	// Large 2:1 ratio image
	add_image_size( 'large_2_1', 800, 400, true );

	// Medium 2:1 ratio image
	add_image_size( 'medium_2_1', 600, 300, true );

	// Small 2:1 ratio image
	add_image_size( 'small_2_1', 400, 200, true );

	// large 1:1 ratio image
	add_image_size( 'large_1_1', 800, 800, true );

	// medium 1:1 ratio image
	add_image_size( 'medium_1_1', 600, 600, true );

	// small 1:1 ratio image
	add_image_size( 'small_1_1', 400, 400, true );

	// extra large 80:52 ratio image
	add_image_size( 'extra_large_80_52', 1200, 780, true );

	// large 80:52 ratio image
	add_image_size( 'large_80_52', 800, 520, true );

	// medium 80:52 ratio image
	add_image_size( 'medium_80_52', 620, 400, true );

	// small 80:52 ratio image
	add_image_size( 'small_80_52', 400, 260, true );

	// large 4:3 ratio image
	add_image_size( 'large_4_3', 1280, 960, true );

	// medium 4:3 ratio image
	add_image_size( 'medium_4_3', 750, 563, true );

	// small 4:3 ratio image
	add_image_size( 'small_4_3', 400, 300, true );

	// set default media link type to 'none'
	update_option( 'image_default_link_type', 'none' );

}

/**
 * Load all JavaScript and stylesheets to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 * @uses    is_admin()
 * @uses    wp_enqueue_script()
 * @uses    wp_enqueue_style()
 * @uses    DRIVING_TEMPLATE
 */
add_action( 'wp_enqueue_scripts', 'drv_add_css_js' );

function drv_add_css_js() {

	if ( ! is_admin() ) {

		global $post;

		$page = $query_var = $template = '';

		$query_var = get_query_var( 'style_ids' );

		if ( ! empty( $query_var ) ) {

			$page = 'car-comparison-results';
		}

		$template = get_page_template_slug( $post->ID );

		if ( 'page-compare.php' == $template ) {

			$page = 'car-comparison';
		}

		if ( is_page( 'pricing' ) ) {

			$page = 'pricing';
		}

		if ( 'buyers-guide' == is_singular( 'buyers-guide' ) ) {

			$page = 'buyers-guide';
		}

		$drv_theme_options = get_theme_options();

		wp_enqueue_style( 'style-css', DRIVING_TEMPLATE_URL . '/style.css?minify=true' );

		wp_enqueue_style( 'drv-bootstrap-css', DRIVING_TEMPLATE_URL . '/css/bootstrap.css?minify=true' );

		wp_enqueue_style( 'drv-common-css', DRIVING_TEMPLATE_URL . '/css/drv-common.css?minify=true' );

		wp_enqueue_style( 'drv-browse-by-css', DRIVING_TEMPLATE_URL . '/css/drv-browse-by.css?minify=true' );

		wp_enqueue_style( 'drv-footer-css', DRIVING_TEMPLATE_URL . '/css/drv-footer.css?minify=true' );

		wp_enqueue_style( 'drv-header-css', DRIVING_TEMPLATE_URL . '/css/drv-header.css?minify=true' );

		wp_enqueue_style( 'drv-follow-us-css', DRIVING_TEMPLATE_URL . '/css/drv-follow-us.css?minify=true' );

		wp_enqueue_style( 'wp-styles-css', DRIVING_TEMPLATE_URL . '/css/wp-styles.css?minify=true' );

		wp_enqueue_style( 'drv-story-css', DRIVING_TEMPLATE_URL . '/css/drv-story.css?minify=true' );

		wp_enqueue_style( 'drv-header-footer-css', DRIVING_TEMPLATE_URL . '/css/drv-header-footer.css?minify=true' );

		wp_enqueue_style( 'drv-outfits-css', DRIVING_TEMPLATE_URL . '/css/drv-outfits.css?minify=true' );

		wp_enqueue_style( 'drv-video-player-css', DRIVING_TEMPLATE_URL . '/css/drv-playlist-player.css?minify=true' );

		if ( ! empty( $page ) && ( 'car-comparison' == $page || 'car-comparison-results' == $page || 'pricing' == $page || 'buyers-guide' == $page ) || is_archive( 'make' ) || is_archive( 'bodystyle' ) ) {

			wp_enqueue_style( 'drv-compare-css', DRIVING_TEMPLATE_URL . '/css/drv-compare.css?minify=true' );

			wp_enqueue_style( 'drv-vehicle-compare-css', DRIVING_TEMPLATE_URL . '/css/drv-vehicle-compare.css?minify=true' );
		}

		if ( is_home() || is_page( 'browse-by-body-styles' ) || is_page( 'our-experts' ) ) {

			wp_enqueue_style( 'drv-browse-new-cars-css', DRIVING_TEMPLATE_URL . '/css/drv-browse-new-cars.css?minify=true' );

			wp_enqueue_style( 'drv-slider-css', DRIVING_TEMPLATE_URL . '/css/drv-slider.css?minify=true' );

			wp_enqueue_style( 'drv-our-experts-css', DRIVING_TEMPLATE_URL . '/css/drv-our-experts.css?minify=true' );

		}

		if ( ! empty( $page ) && 'car-comparison' == $page ) {

			wp_enqueue_style( 'drv-modal-css', DRIVING_TEMPLATE_URL . '/css/drv-modal.css?minify=true' );

			wp_enqueue_style( 'drv-modal-gallery-css', DRIVING_TEMPLATE_URL . '/css/drv-modal-gallery.css?minify=true' );

			wp_enqueue_style( 'drv-filters-css', DRIVING_TEMPLATE_URL . '/css/drv-filters.css?minify=true' );

		}

		if ( is_singular() ) {

			wp_enqueue_style( 'drv-popular-now', DRIVING_TEMPLATE_URL . '/css/drv-popular-now.css?minify=true' );

			wp_enqueue_style( 'swipe-gallery', DRIVING_TEMPLATE_URL . '/css/drv-swipe-gallery.css?minify=true' );

			wp_enqueue_style( 'editors-choice-css', DRIVING_TEMPLATE_URL . '/css/drv-editors-choice.css?minify=true' );

			wp_enqueue_style( 'drv-related-tags', DRIVING_TEMPLATE_URL . '/css/drv-related-tags.css?minify=true' );

		}

		if ( is_tax( 'make' ) || is_tax( 'bodystyle' ) ) {

			wp_enqueue_style( 'swipe-gallery', DRIVING_TEMPLATE_URL . '/css/drv-swipe-gallery.css?minify=true' );

			wp_enqueue_style( 'pricing-css', DRIVING_TEMPLATE_URL . '/css/drv-pricing-page.css?minify=true' );

			wp_enqueue_style( 'drv-buyers-guide-css', DRIVING_TEMPLATE_URL . '/css/drv-buyers-guide.css?minify=true' );

			wp_enqueue_style( 'drv-latest-review', DRIVING_TEMPLATE_URL . '/css/drv-latest-review.css?minify=true' );

			wp_enqueue_style( 'drv-popular-now', DRIVING_TEMPLATE_URL . '/css/drv-popular-now.css?minify=true' );
		}

		if ( 'quizzes' == get_query_var( 'post_type' ) ) {

			wp_enqueue_style( 'quizzes-css', DRIVING_TEMPLATE_URL . '/css/drv-quiz.css?minify=true' );

			wp_enqueue_style( 'drv-buyers-guide-css', DRIVING_TEMPLATE_URL . '/css/drv-buyers-guide.css?minify=true' );
		}

		if ( 'pricing' == $page ) {

			wp_enqueue_style( 'pricing-css', DRIVING_TEMPLATE_URL . '/css/drv-pricing-page.css?minify=true' );
		}

		wp_enqueue_style( 'drv-resource-center', DRIVING_TEMPLATE_URL . '/css/drv-resource-center.css?minify=true' );

		wp_enqueue_style( 'drv-search-results', DRIVING_TEMPLATE_URL . '/css/drv-search-results.css?minify=true' );

		wp_enqueue_style( 'drv-shop-used-cars', DRIVING_TEMPLATE_URL . '/css/drv-shop-used-cars.css?minify=true' );

		wp_enqueue_style( 'drv-story-from-home', DRIVING_TEMPLATE_URL . '/css/drv-story-from-home.css?minify=true' );

		wp_enqueue_style( 'featured-vehicle-css', DRIVING_TEMPLATE_URL . '/css/drv-featured-vehicle.css?minify=true' );

		wp_enqueue_style( 'unhaggle-css', DRIVING_TEMPLATE_URL . '/css/drv-unhaggle.css?minify=true' );

		wp_enqueue_style( 'vehicle-ratings-css', DRIVING_TEMPLATE_URL . '/css/drv-scorecard-ratings.css?minify=true' );

		wp_enqueue_style( 'vehicle-spotlight-css', DRIVING_TEMPLATE_URL . '/css/drv-vehicle-spotlight.css?minify=true' );

		wp_enqueue_style( 'featured-comparison-css', DRIVING_TEMPLATE_URL . '/css/drv-featured-comparison.css?minify=true' );

		wp_enqueue_style( 'ion.rangeSlider-css', DRIVING_TEMPLATE_URL . '/css/ion.rangeSlider.css?minify=true' );

		wp_enqueue_style( 'touchcarousel', DRIVING_TEMPLATE_URL . '/css/touchcarousel.min.css?minify=true' );

		wp_enqueue_style( 'sailthru-widget', DRIVING_TEMPLATE_URL . '/css/drv-sailthru-widget.css?minify=true' );

		if ( ! empty( $drv_theme_options['polar_instance'] ) ) {

			$polar_url = $drv_theme_options['polar_instance'] . '&rand=' . wp_rand();

			wp_enqueue_script( 'drv-polar', $polar_url, array( 'jquery' ), '' );
		}

		wp_enqueue_script( 'jquery-ui-autocomplete' );

		wp_enqueue_script( 'jquery-easing', DRIVING_TEMPLATE_URL . '/js/jquery-easing.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'modernizr', DRIVING_TEMPLATE_URL . '/js/modernizr.min.js', '', true );

		wp_enqueue_script( 'drv-analytics', DRIVING_TEMPLATE_URL . '/js/drv-analytics.js?minify=true', array( 'jquery' ), '1.9.0', true );

		wp_enqueue_script( 'drv-common', DRIVING_TEMPLATE_URL . '/js/drv-common.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-main', DRIVING_TEMPLATE_URL . '/js/main.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-raphel-js', DRIVING_TEMPLATE_URL . '/js/raphael.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-svg', DRIVING_TEMPLATE_URL . '/js/drv-svg.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-sell-page', DRIVING_TEMPLATE_URL . '/js/drv-sell-page.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-author', DRIVING_TEMPLATE_URL . '/js/drv-author.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-bg-model', DRIVING_TEMPLATE_URL . '/js/drv-bg-model-page.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-buyers-guide', DRIVING_TEMPLATE_URL . '/js/drv-buyersguide.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-quiz', DRIVING_TEMPLATE_URL . '/js/drv-quiz.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-slider', DRIVING_TEMPLATE_URL . '/js/drv-slider.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-special-section', DRIVING_TEMPLATE_URL . '/js/drv-special-section.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-bg-model', DRIVING_TEMPLATE_URL . '/js/drv-bg-model-page.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-story-page', DRIVING_TEMPLATE_URL . '/js/drv-story-page.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-omniture-account', DRIVING_TEMPLATE_URL . '/js/account-s-code.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-utils', DRIVING_TEMPLATE_URL . '/js/Postmedia-Utils.js?minify=true', '', '', true );

		wp_enqueue_script( 'drv-adserver', DRIVING_TEMPLATE_URL . '/js/Postmedia-AdServer.js?minify=true', array( 'drv-utils' ), '', true );

		wp_enqueue_script( 'drv-waypoints', DRIVING_TEMPLATE_URL . '/js/waypoints.min.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-waypoints-sticky', DRIVING_TEMPLATE_URL . '/js/waypoints-sticky.min.js?minify=true', array( 'drv-waypoints' ), '', true );

		wp_enqueue_script( 'drv-social', DRIVING_TEMPLATE_URL . '/js/drv-social.js?minify=true', array( 'drv-waypoints-sticky' ), '', true );

		if ( ! empty( $page ) && ( 'car-comparison' == $page || 'pricing' == $page || 'buyers-guide' == $page ) || is_archive( 'make' ) ) {

			wp_enqueue_script( 'drv-compare', DRIVING_TEMPLATE_URL . '/js/drv-compare.js?minify=true', array( 'jquery' ), '', true );

			wp_enqueue_script( 'drv-compare-filters', DRIVING_TEMPLATE_URL . '/js/drv-filters.js?minify=true', array( 'jquery' ), '', true );
		}

		wp_enqueue_script( 'drv-wp-dev', DRIVING_TEMPLATE_URL . '/js/wp-dev.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-swipe-gallery', DRIVING_TEMPLATE_URL . '/js/drv-swipe-gallery.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-search', DRIVING_TEMPLATE_URL . '/js/drv-search.js?minify=true', array( 'jquery' ), '1.10.3', true );

		if ( ! empty( $page ) && ( 'car-comparison-results' == $page || 'pricing' == $page || 'buyers-guide' == $page ) || is_archive( 'make' ) ) {

			wp_enqueue_script( 'drv-timbit', DRIVING_TEMPLATE_URL . '/js/timbits.csi.js?minify=true', array( 'jquery' ), '1.10.3', true );

			wp_enqueue_script( 'drv-featured-vehicle', DRIVING_TEMPLATE_URL . '/js/drv-featured-vehicle.js?minify=true', array( 'jquery' ), '', true );

			wp_enqueue_script( 'drv-vehicle-compare', DRIVING_TEMPLATE_URL . '/js/drv-vehicle-compare.js?minify=true', array( 'jquery' ), '', true );

		}

		if ( is_home() ) {

			wp_enqueue_script( 'drv-localize', DRIVING_TEMPLATE_URL . '/js/drv-localize.js?minify=true', array( 'jquery' ), '', true );
		}

		if ( ! empty( $page ) && 'car-comparison' == $page ) {

			wp_enqueue_script( 'drv-modal-gallery', DRIVING_TEMPLATE_URL . '/js/modal-gallery.js?minify=true', array( 'jquery' ), '', true );

			wp_enqueue_script( 'drv-car-compare-modal', DRIVING_TEMPLATE_URL . '/js/drv-car-compare-modal.js?minify=true', array( 'jquery' ), '', true );
		}

		wp_enqueue_script( 'drv-bootstrap-js', DRIVING_TEMPLATE_URL . '/js/bootstrap.js?minify=true', array( 'jquery' ), '1.10.3', true );

		wp_enqueue_script( 'drv-pricing-page', DRIVING_TEMPLATE_URL . '/js/drv-pricing-page.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-unhaggle-elastic-callback', DRIVING_TEMPLATE_URL . '/js/drv-unhaggle-elastic-callback.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-unhaggle', DRIVING_TEMPLATE_URL . '/js/drv-unhaggle.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-elastic', DRIVING_TEMPLATE_URL . '/js/drv-elastic.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-header-footer', DRIVING_TEMPLATE_URL . '/js/drv-header-footer.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'drv-outfits', DRIVING_TEMPLATE_URL . '/js/drv-outfits.js?minify=true', array( 'jquery' ), '', true );

		wp_enqueue_script( 'plugins', DRIVING_TEMPLATE_URL . '/js/plugins.min.js', array( 'jquery' ), '', true );

		$current_time = current_time( 'timestamp' );

		$start_date = strtotime( $drv_theme_options['tactical_promo_start_date'] );

		$end_date = strtotime( $drv_theme_options['tactical_promo_end_date'] );

		if ( 'mob' == drv_smrt_theme_prefix() && is_home() ) {

			wp_enqueue_style( 'drv-tactical-promo-css', DRIVING_TEMPLATE_URL . '/css/drv-tactical-promo.css?minify=true' );

			if ( ( ! empty( $start_date ) && $start_date <= $current_time ) && ( ! empty( $end_date ) && $current_time <= $end_date ) ) {

				wp_enqueue_script( 'drv-tactical-promo-js', DRIVING_TEMPLATE_URL . '/js/drv-tactical-promo.js?minify=true', array( 'jquery' ), '', true );
			}
		}
	}
}

add_action( 'admin_enqueue_scripts', 'drv_load_custom_admin_files' );

function drv_load_custom_admin_files() {

	// javascript files
	wp_enqueue_script( 'drv-admin-makes', DRIVING_TEMPLATE_URL . '/js/admin-makes.js?minify=true', '', '1.0.0' );

	wp_enqueue_script( 'drv-admin-unhaggle-js', DRIVING_TEMPLATE_URL . '/js/admin-elastic.js?minify=true', array( 'jquery' ), '1.0.0' );

	wp_enqueue_script( 'drv-custom-admin-js', DRIVING_TEMPLATE_URL . '/js/custom-admin-js.js?minify=true', array( 'jquery', 'jquery-ui-sortable' ), '1.0.0' );

	// css files
	wp_enqueue_style( 'drv-custom-admin-styles', DRIVING_TEMPLATE_URL . '/css/custom-admin-styles.css?minify=true' );

	// register TinyMCE editor plugins - CM
	if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) ) {

		add_filter( 'mce_external_plugins', 'drv_add_tinymce_plugins' );

		add_editor_style( DRIVING_TEMPLATE_URL . '/css/custom-admin-styles.css?minify=true' );
	}
}

/**
 * Add Async Attributes to WordPress Scripts
 */
function add_async_attribute( $tag, $handle ) {
	$async_handles = array(
		'ad-index-wrapper',
	);
	if ( ! in_array( $handle, $async_handles, true ) ) {
		return $tag;
	}
	return str_replace( ' src', ' async="async" src', $tag );
}
add_filter( 'script_loader_tag', 'add_async_attribute', 10, 2 );

/**
 * Enqueues additional scripts.
 * use wp_enqueue_script
 */
function drv_enqueue_scripts() {
	/*
	* Index Header Wrapper,
	* The script references unique key values and bids on standard impression opportunities creating higher bid density and leading to incremental revenue in the programmatic space.
	* Since we currently only have ADX monetizing Driving.ca AdOps would like to get this up on the site so that this opportunity can be bid on by these additional partners.
	*/
	wp_enqueue_script( 'ad-index-wrapper', '//js-sec.indexww.com/ht/p/184635-100458272109689.js', array(), '', false );

	if ( is_single() ) {
		$advertorial_meta_box = get_post_meta( get_the_ID(), 'advertorial_meta_box', true );
		$sponsored            = get_post_meta( get_the_ID(), 'drv_sponsored_content', true );
		if ( 'on' !== $advertorial_meta_box && 'on' !== $sponsored ) {
			// Fetch Freeskreen js for Slimcut Video Ads.
			wp_enqueue_script( 'pn-postpoints-slimcut', 'https://static.freeskreen.com/publisher/220/freeskreen.min.js', array( 'jquery' ), false, true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'drv_enqueue_scripts', 100 );

/**
 * Admin Scripts Hook
 * Load scripts specific to admin
 */
add_action( 'admin_enqueue_scripts', 'drv_load_admin_scripts' );

function drv_load_admin_scripts( $hook ) {

	if ( 'post.php' == $hook || 'post-new.php' == $hook ) {

		wp_enqueue_script( 'wp-admin-post', get_template_directory_uri() . '/js/wp-admin-post.js?minify=true' );
	}
}

/**
 * TinyMCE editor plugin hook
 */
function drv_add_tinymce_plugins( $plugin_array ) {

	$plugin_array['wpeditimage'] = DRIVING_TEMPLATE_URL . '/includes/plugins/pm-wpeditimage/editor_plugin.js?minify=true';

	return $plugin_array;
}

/**
* Changes to the <title> tag.
*/
add_filter( 'wp_title', 'drv_wp_title', 10, 2 );

function drv_wp_title( $title, $sep ) {

	global $drv_buyers_guide, $wp_query;

	$term = get_queried_object();

	$key = $post_id = '';

	$options = array();

	if ( is_single() ) {

		$post_id = get_the_ID();
	}

	if ( is_object( $term ) ) {

		$key = 'postmedia_taxonomy_seo_' . $term->taxonomy . '_' . $term->term_id;

		if ( ! is_single() ) {

			$post_id = $term->term_id;
		}
	}

	$concat = ' ' . $sep . ' ';

	$paged = '';

	if ( is_paged() ) {

		$paged = ' Page ' . get_query_var( 'paged' ) . $concat;
	}

	$driving = $concat . $paged . ' Driving';

	if ( function_exists( 'wlo_get_option' ) && ! empty( $key ) ) {

		$options = wlo_get_option( $key );
	}

	if ( ! empty( $options ) && isset( $options['seo_title'] ) && ! empty( $options['seo_title'] ) ) {

		$seo_title = $options['seo_title'];
	} else {

		$seo_title = str_replace( $sep, '', $title );
	}

	if ( 'buyers-guide' == get_query_var( 'post_type' ) ) {

		$title = str_replace( $sep, '', $title );

		if ( is_singular( 'buyers-guide' ) ) {

			$bodystyle = drv_get_taxonomy_terms_for_post( $post_id, 'bodystyle' );

			$bodystyle_parent_child = drv_get_taxonomy_terms_parent_child_string_array( $bodystyle );

			$make = drv_get_taxonomy_terms_for_post( $post_id, 'make' );

			$make_parent_child = drv_get_taxonomy_terms_parent_child_string_array( $make );

			if ( count( $make ) > 1 ) {

				$make_model = $make_parent_child['parent_name'] . ' ' . $make_parent_child['child_name'];

			} else {

				$make_model = $make_parent_child['parent_name'];
			}

			if ( ! empty( $bodystyle ) ) {

				if ( count( $bodystyle ) > 1 ) {

					$title = $drv_buyers_guide->get_bodystyle_plural_name( $bodystyle_parent_child['parent_name'] ) . $concat . $drv_buyers_guide->get_bodystyle_plural_name( $bodystyle_parent_child['child_name'] ) . $concat . $make_model . $concat . "Buyer's Guide" . $driving;

				} else {

					$title = $drv_buyers_guide->get_bodystyle_plural_name( $bodystyle_parent_child['parent_name'] ) . $concat . $make_model . $concat . "Buyer's Guide" . $driving;
				}
			} else {

				$title = "Buyer's Guide" . $driving;
			}
		} elseif ( is_tax( 'bodystyle' ) ) {

			$bodystyle = drv_get_taxonomy_term_parent_child_order( $term->term_id, 'bodystyle' );

			$bodystyle_parent_child = drv_get_taxonomy_terms_parent_child_string_array( $bodystyle );

			if ( count( $bodystyle ) > 1 ) {

				$title = $drv_buyers_guide->get_bodystyle_plural_name( $bodystyle_parent_child['parent_name'] ) . $concat . $drv_buyers_guide->get_bodystyle_plural_name( $bodystyle_parent_child['child_name'] ) . $concat . "Buyer's Guide" . $driving;
			} else {

				$title = $drv_buyers_guide->get_bodystyle_plural_name( $bodystyle_parent_child['parent_name'] ) . $concat . "Buyer's Guide" . $driving;
			}
		} else {

			$title = "Buyer's Guide" . $driving;
		}
	} elseif ( is_tax( 'make' ) ) {

		$title = str_replace( $sep, '', $title );

		$parent = array_reverse( get_ancestors( $term->term_id, 'make' ) );

		if ( ! empty( $parent ) ) {

			$parent_term = get_term_by( 'id', $parent[0], 'make' );

			$title = $parent_term->name . ' ' . $term->name . ' ' . drv_get_current_site_year() . ' - View Specs, Prices, Photos & More' . $driving;

		} else {

			$title = $term->name . ' ' . drv_get_current_site_year() . ' Cars - Discover the New ' . $term->name . ' Models' . $driving;
		}
	} elseif ( is_tax( 'bodystyle' ) ) {

		$title = $term->name . 's - ' . drv_get_current_site_year() . ' New Car Buyer\'s Guide' . $driving;

	} elseif ( is_tax( 'classification' ) || is_tax( 'specialsection' ) || is_tax( 'model_year' ) ) {

		$title = str_replace( $sep, '', $title );

		$parent = array_reverse( get_ancestors( $term->term_id, 'make' ) );

		if ( ! empty( $parent ) ) {

			$parent_term = get_term_by( 'id', $parent[0], 'make' );

			$title = $parent_term->name . ' ' . $term->name . $driving;

		} else {

			$title = $term->name . $driving;
		}
	} elseif ( is_object( $term ) && 'category' == $term->taxonomy ) {

		$title = $seo_title . $driving;

	} elseif ( is_page( 'car-comparison-results' ) ) {

		$car_description = get_query_var( 'car_description' );

		$car_descriptions = array();

		if ( ! empty( $car_description ) ) {

			$car_description = explode( '-vs-', $car_description );

			foreach ( $car_description as $value ) {

				$car_descriptions[] = str_replace( '-', ' ', $value );
			}
		}

		$title = 'Compare ' . $car_descriptions[0] . ' vs ' . $car_descriptions[1] . $driving;

	} elseif ( is_page( 'pricing' ) ) {

		$style_id = get_query_var( 'style_id' );

		$car_description = get_query_var( 'car_description' );

		$unhaggle = drv_return_pricing_make_model( $style_id, $car_description );

		$title = $unhaggle['year'] . ' ' . $unhaggle['make'] . ' ' . $unhaggle['model'] . ' Prices' . $driving;

	} elseif ( is_home() ) {

		$title = get_bloginfo( 'name' );

	} elseif ( is_single() ) {

		$title = apply_filters( 'the_title', $title, $term->ID );

		$title = $title . $paged . ' Driving';

	} else {

		$title .= $paged . 'Driving';
	}

	return $title;
}


/**
 * Creating the sidebars
 *
 * This function is attached to the 'widgets_init' action hook.
 *
 * @uses  register_sidebar()
 *
 * @since 1.0.0
 */
add_action( 'widgets_init', 'drv_widgets_init' );

function drv_widgets_init() {

	// widget support for a right sidebar
	register_sidebar(
		array(
			'name'          => 'Right SideBar',
			'id'            => 'right-sidebar',
			'description'   => 'Widgets in this area will be shown on the right-hand side.',
			'before_widget' => '<div id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	// widget support for the footer
	register_sidebar(
		array(
			'name'          => 'Author SideBar',
			'id'            => 'author-sidebar',
			'description'   => 'Widgets in this area will be shown in the authors page.',
			'before_widget' => '<div id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	 // widget support for the footer
	register_sidebar(
		array(
			'name'          => 'Search SideBar',
			'id'            => 'search-sidebar',
			'description'   => 'Widgets in this area will be shown in the search page.',
			'before_widget' => '<div id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	// widget support for the footer
	register_sidebar(
		array(
			'name'          => 'Footer SideBar',
			'id'            => 'footer-sidebar',
			'description'   => 'Widgets in this area will be shown in the footer.',
			'before_widget' => '<div id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

}


// Disable emojicons introduced with WP 4.2
function disable_wp_emojicons() {
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'init', 'disable_wp_emojicons' );
// Remove the DNS prefetch by returning false on filter emoji_svg_url
add_filter( 'emoji_svg_url', '__return_false' );

// Disable WP 3.6 Post format UI
add_filter( 'enable_post_format_ui', '__return_false' );

add_action( 'parse_query', 'drv_check_is_blog_author' );

function drv_check_is_blog_author() {

	global $wp_query;

	$query = $wp_query;

	if ( ! is_admin() && $query->is_main_query() && $query->is_author() ) {

		$is_user = false;

		$author_name = get_query_var( 'author_name' );

		$author = get_user_by( 'slug', $author_name );

		if ( ! empty( $author ) ) {

			$blog_id = get_current_blog_id();

			$is_user = is_user_member_of_blog( $author->ID, $blog_id );
		}

		if ( ! $is_user ) {

			wp_safe_redirect( DRIVING_SITE_URL . '/our-experts' );

			exit();
		}
	}
}

/**
 * Removes the specified taxonomies from the quick edit screen and the column
 */
add_action( 'admin_init', 'pm_remove_quick_edit_tax_box' );

function pm_remove_quick_edit_tax_box() {

	global $pagenow;

	if ( 'edit.php' == $pagenow ) {

		$post_types = array( 'post', 'buyers-guide', 'quizzes' );

		foreach ( $post_types as $value ) {

			unregister_taxonomy_for_object_type( 'make', $value );

			unregister_taxonomy_for_object_type( 'classification', $value );

			unregister_taxonomy_for_object_type( 'model_year', $value );
		}
	}
}

/**
 * Image optimization
 */
//VIP: on WordPress.com DRIVING_SITE_URL is undefined because it get accessed in get_theme_options() which i called by drv_image_quality()
// Inside the context of the API this will generate PHP Warnings. Moving this to be on init after the constant is defined solves the problem.
add_action( 'init', function() {
	wpcom_vip_set_image_quality( drv_image_quality(), true );
}, 11 );

/**
 * Adding a redirect to pricing page urls xml file
 */
vip_substr_redirects(
	array(
		'/pricing-page-urls.xml'      => get_template_directory_uri() . '/xml/pricing-page-urls.xml',
		'/authors-sitemap.xml'        => get_template_directory_uri() . '/xml/authors-sitemap.xml',
		'/bodystyle-sitemap.xml'      => get_template_directory_uri() . '/xml//bodystyle-sitemap.xml',
		'/categories-sitemap.xml'     => get_template_directory_uri() . '/xml/categories-sitemap.xml',
		'/classification-sitemap.xml' => get_template_directory_uri() . '/xml/classification-sitemap.xml',
		'/make-model-sitemap.xml'     => get_template_directory_uri() . '/xml/make-model-sitemap.xml',
		'/pages-sitemap.xml'          => get_template_directory_uri() . '/xml/pages-sitemap.xml',
		'/specialsection-sitemap.xml' => get_template_directory_uri() . '/xml/specialsection-sitemap.xml',
		'/stories-sitemap.xml'        => get_template_directory_uri() . '/xml/stories-sitemap.xml',
	)
);

/**
 * Enable Bulk User Management
 */
if ( function_exists( 'wpcom_vip_bulk_user_management_whitelist' ) ) {

	wpcom_vip_bulk_user_management_whitelist( array( 'postmediabarbaraklose', 'scottcox55' ) );
}

/**
 * Remove rel="prev" from the previous_post_link
 */
add_filter( 'previous_post_link', 'remove_rel_previous_post_link', 10, 1 );

function remove_rel_previous_post_link( $html ) {

	$html = str_replace( 'rel="prev"', '', $html );

	return $html;
}

/**
 * Remove rel="next" from the next_post_link
 */
add_filter( 'next_post_link', 'remove_rel_next_post_link', 10, 1 );

function remove_rel_next_post_link( $html ) {

	$html = str_replace( 'rel="next"', '', $html );

	return $html;
}

/**
 * Remove make word from make term link
 */
add_filter( 'term_link', 'remove_make_word_from_link', 10, 3 );

function remove_make_word_from_link( $term_link, $term, $taxonomy ) {

	switch ( $taxonomy ) {

		case 'make':
			if ( strpos( $term_link, '/make/' ) !== -1 ) {

				$term_link = str_replace( '/make/', '/', $term_link );
			}

			break;
	}

	return $term_link;
}

/**
 * Remove Auto P tags from around images and iframes
 */
function custom_wpautop( $content ) {
	$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	return preg_replace( '/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content );
}
add_filter( 'the_content', 'custom_wpautop' );

/**
 * Removing next & prev links in the head
 * https://lobby.vip.wordpress.com/2016/01/05/performance-improvements/
 */
wpcom_vip_enable_performance_tweaks();
