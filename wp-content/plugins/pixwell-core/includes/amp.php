<?php
/** AMP support */
add_action( 'plugin_loaded', 'pixwell_setup_amp_theme' );
add_action( 'after_setup_theme', 'pixwell_support_amp', 5 );
add_filter('amp_supportable_post_types', 'pixwell_remove_post_types');

/** setup theme data */
if ( ! function_exists( 'pixwell_amp_setup_theme_data' ) ) {
	function pixwell_amp_setup_theme_data() {
		add_filter( 'pre_option_stylesheet', 'pixwell_amp_theme_name' );
		add_filter( 'pre_option_template', 'pixwell_amp_theme_name' );
		add_filter( 'pre_option_template_root', 'pixwell_amp_theme_name' );
		add_filter( 'pre_option_stylesheet_root', 'pixwell_amp_theme_name' );
		add_filter( 'template', 'pixwell_amp_theme_name' );
		add_filter( 'stylesheet', 'pixwell_amp_theme_name' );
		add_action( 'stylesheet_directory_uri', 'pixwell_amp_stylesheet_uri' );

	}
}

if ( ! function_exists( 'pixwell_amp_installed' ) ) {
	function pixwell_amp_installed() {
		if ( defined( 'AMP__VERSION' ) ) {
			return true;
		}

		return false;
	}
}

/** is amp request */
if ( ! function_exists( 'pixwell_is_amp_request' ) ) {
	function pixwell_is_amp_request() {
		global $_REQUEST;

		if ( pixwell_amp_installed() && isset( $_REQUEST[ AMP_Theme_Support::SLUG ] ) ) {
			return true;
		}

		return false;
	}
}


/** check AMP */
if ( ! function_exists( 'pixwell_is_amp' ) ) {
	function pixwell_is_amp() {
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}
}

/** setup AMP */
if ( ! function_exists( 'pixwell_support_amp' ) ) {
	function pixwell_support_amp() {

		add_theme_support( 'amp', array(
			'paired' => true
		) );

		if ( pixwell_amp_installed() ) {
			add_action( 'wp_loaded', 'pixwell_amp_config_backend' );
			add_action( 'admin_menu', 'pixwell_amp_remove_validated', 9999 );
			add_action('wp_loaded', 'pixwell_amp_remove_notice', 9999);
		}
	}
}

/** remove validated */
if ( ! function_exists( 'pixwell_amp_remove_validated' ) ) {
	function pixwell_amp_remove_validated() {
		remove_submenu_page( 'amp-options', 'edit.php?post_type=amp_validated_url' );
		remove_submenu_page( 'amp-options', esc_attr( 'edit-tags.php?taxonomy=amp_validation_error&post_type=amp_validated_url' ) );
		remove_filter( 'dashboard_glance_items', array( 'AMP_Validated_URL_Post_Type', 'filter_dashboard_glance_items' ) );
	}
}

if ( ! function_exists( 'pixwell_amp_remove_notice' ) ) {
	function pixwell_amp_remove_notice() {
		remove_action( 'admin_bar_menu', 'AMP_Validation_Manager::add_admin_bar_menu_items', 101 );
		remove_action( 'edit_form_top', 'AMP_Validation_Manager::print_edit_form_validation_status' );
		remove_action( 'edit_form_top', 'AMP_Validated_URL_Post_Type::print_url_as_title' );
		remove_action( 'all_admin_notices', 'AMP_Validation_Manager::print_plugin_notice' );
		remove_action( 'enqueue_block_editor_assets', 'AMP_Validation_Manager::enqueue_block_validation' );
		remove_action( 'all_admin_notices', 'AMP_Validation_Manager::print_plugin_notice' );
	}
}


/** config AMP */
if ( ! function_exists( 'pixwell_amp_config_backend' ) ) {
	function pixwell_amp_config_backend() {

		/** remove post type support */
		remove_post_type_support( 'rb-portfolio', AMP_Post_Type_Support::SLUG );
		remove_post_type_support( 'rb-gallery', AMP_Post_Type_Support::SLUG );
		remove_post_type_support( 'rb-deal', AMP_Post_Type_Support::SLUG );

		if ( true === AMP_Options_Manager::get_option( 'all_templates_supported' ) ) {
			AMP_Options_Manager::update_option( 'all_templates_supported', false );
		}

		if ( 'transitional' !== AMP_Options_Manager::get_option( 'theme_support' ) ) {
			AMP_Options_Manager::update_option( 'theme_support', 'transitional' );
		} else {
			add_action( 'admin_print_styles', 'pixwell_amp_remove_mode' );
			add_action( 'admin_footer', 'pixwell_amp_mode_info' );
		}
	}
}


/** hidden mode selection */
if ( ! function_exists( 'pixwell_amp_remove_mode' ) ) {
	function pixwell_amp_remove_mode() {
		?>
		<style type='text/css'> .amp-website-mode fieldset {
				display: none;
			}</style>
	<?php
	}
}

/** amp mode notification */
if ( ! function_exists( 'pixwell_amp_mode_info' ) ) {
	function pixwell_amp_mode_info() {

		$current_screen = get_current_screen();
		if ( $current_screen->id == 'toplevel_page_amp-options' && defined( 'AMP__VERSION' ) && AMP__VERSION >= 2 ) : ?>
			<script>
				(function ($) {
					var templateModeTimeOut = setInterval(function () { console.log('here');
						var templateModes = $('#template-modes');
						if (templateModes.length > 0 ) {
							templateModes.html('<div class="selectable selectable--left"><div class="settings-welcome__illustration"><h3>The theme supported and activated AMP in the Transitional mode.</h3></div></div>');
							clearInterval(templateModeTimeOut);
						}
					},100);
					setTimeout(function(){
						clearInterval(templateModeTimeOut);
					},5000);
				})(jQuery);
			</script>
			<script>
				(function ($) {
					$('.amp-website-mode').find('td').html('<p class="notice notice-success">The theme supported and activated AMP in the Transitional mode.</p>');
					$('#amp-options-supported_post_types-rb-portfolio , #amp-options-supported_post_types-rb-gallery, #amp-options-supported_post_types-rb-deal').next().addBack().remove();
					$('#all_templates_supported_fieldset').remove();
				})(jQuery);
			</script>
		<?php
		endif;
	}
}

/** template */
if ( ! function_exists( 'pixwell_setup_amp_theme' ) ) {
	function pixwell_setup_amp_theme() {

		if ( ! defined( 'PIXWELL_DTHEME_URI' ) ) {
			define( 'PIXWELL_DTHEME_URI', trailingslashit( WP_CONTENT_URL . '/themes/' . get_option( 'template' ) ) );
		}
		if ( ! defined( 'PIXWELL_DTHEME_DIR' ) ) {
			define( 'PIXWELL_DTHEME_DIR', trailingslashit( WP_CONTENT_DIR . '/themes/' . get_option( 'template' ) ) );
		}

		if ( ! defined( 'PIXWELL_DTEMPLATE' ) ) {
			define( 'PIXWELL_DTEMPLATE', get_option( 'template' ) );
		}

		if ( pixwell_is_amp_request() ) {
			add_filter( 'theme_root', 'pixwell_amp_theme_root', 9999, 1 );
			add_filter( 'theme_root_uri', 'pixwell_amp_theme_root_uri', 9999, 1 );
			add_action( 'setup_theme', 'pixwell_amp_setup_theme_data', 999 );
		}
	}
}

/** fix stylesheet uri */
if ( ! function_exists( 'pixwell_amp_stylesheet_uri' ) ) {
	function pixwell_amp_stylesheet_uri( $path ) {
		return rtrim( $path, '/' );
	}
}

/** define theme */
if ( ! function_exists( 'pixwell_amp_theme_name' ) ) {
	function pixwell_amp_theme_name() {
		return 'amp';
	}
}

/** amp root path */
if ( ! function_exists( 'pixwell_amp_theme_root' ) ) {
	function pixwell_amp_theme_root() {
		return PIXWELL_CORE_PATH;
	}
}

/** amp root uri */
if ( ! function_exists( 'pixwell_amp_theme_root_uri' ) ) {
	function pixwell_amp_theme_root_uri() {
		return PIXWELL_CORE_URL;
	}
}

/** remove post types */
if ( ! function_exists( 'pixwell_remove_post_types' ) ) {
	function pixwell_remove_post_types( $post_types ) {

		if ( empty( $post_types ) || ! is_array( $post_types ) ) {
			return $post_types;
		}

		foreach ( $post_types as $index => $post_type ) {
			if ( 'rb-gallery' == $post_type || 'rb-portfolio' == $post_type || 'rb-deal' == $post_type || 'cp_recipe' == $post_type || 'product' == $post_type ) {
				unset( $post_types[ $index ] );
			}
		}

		return $post_types;
	}
}