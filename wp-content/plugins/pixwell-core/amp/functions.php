<?php
/** Theme function for amp */
add_action( 'after_setup_theme', 'pixwell_amp_theme_setup', 1 );
add_action( 'wp_enqueue_scripts', 'pixwell_amp_enqueue_style', 10 );

/** load translate */
load_theme_textdomain( 'pixwell', PIXWELL_DTHEME_DIR . 'language' );

if ( ! function_exists( 'pixwell_amp_theme_setup' ) ) {
	function pixwell_amp_theme_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'caption',
			'style'
		) );

		register_nav_menus( array(
			'pixwell_menu_main'      => esc_html__( 'Main Menu', 'pixwell-core' ),
			'pixwell_menu_offcanvas' => esc_html__( 'Left Aside Menu (Mobile Menu)', 'pixwell-core' ),
			'pixwell_menu_top'       => esc_html__( 'Top Bar Menu', 'pixwell-core' ),
			'pixwell_menu_footer'    => esc_html__( 'Footer Menu', 'pixwell-core' )
		) );
		add_theme_support( 'woocommerce' );
	}
}


/** register scripts */
if ( ! function_exists( 'pixwell_amp_enqueue_style' ) ) {
	function pixwell_amp_enqueue_style() {
		wp_enqueue_style( 'pixwell-amp-gfonts', esc_url_raw( pixwell_amp_create_font_link() ), array(), PIXWELL_CORE_VERSION, 'all' );
		wp_enqueue_style( 'pixwell-style', esc_url_raw( PIXWELL_DTHEME_URI . 'assets/css/main.css' ), array(), PIXWELL_CORE_VERSION, 'all' );
		wp_enqueue_style( 'pixwell-amp-style', get_stylesheet_uri(), array( 'pixwell-style' ), PIXWELL_CORE_VERSION, 'all' );
		if ( class_exists( 'WooCommerce' ) ) {
			wp_deregister_style( 'yith-wcwl-font-awesome' );
			wp_enqueue_style( 'pixwell-wc', esc_url_raw( PIXWELL_DTHEME_URI . 'assets/css/woocommerce.css' ), array( 'pixwell-amp-style' ), PIXWELL_CORE_VERSION, 'all' );
		}
		if ( is_rtl() ) {
			wp_enqueue_style( 'pixwell-rtl', esc_url_raw( PIXWELL_DTHEME_URI . 'assets/css/rtl.css' ), array(), PIXWELL_CORE_VERSION, 'all' );
		}
	}
}

/** create font link */
if ( ! function_exists( 'pixwell_amp_create_font_link' ) ) {
	function pixwell_amp_create_font_link() {

		$options   = get_option( 'pixwell_theme_options', array() );
		$pre_fonts = array();
		$fonts     = array();
		$subsets   = array();
		$link      = '';

		foreach ( $options as $field ) {
			if ( ! empty( $field['font-family'] ) ) {
				$field['font-family'] = str_replace( ' ', '+', $field['font-family'] );
				if ( ! isset( $field['font-style'] ) ) {
					$field['font-style'] = '';
				}
				if ( ! empty( $field['font-weight'] ) ) {
					$field['font-style'] = $field['font-weight'] . $field['font-style'];
				}
				array_push( $pre_fonts, $field );
			}
		}

		foreach ( $pre_fonts as $field ) {
			if ( ! isset( $fonts[ $field['font-family'] ] ) ) {
				$fonts[ $field['font-family'] ]               = $field;
				$fonts[ $field['font-family'] ]['font-style'] = array();
				array_push( $fonts[ $field['font-family'] ]['font-style'], $field['font-style'] );
			} else {
				if ( ! empty( $field['font-style'] ) ) {
					if ( ! in_array( $field['font-style'], $fonts[ $field['font-family'] ]['font-style'] ) ) {
						array_push( $fonts[ $field['font-family'] ]['font-style'], $field['font-style'] );
					}
				}
			}
		}

		foreach ( $fonts as $family => $font ) {
			if ( ! empty( $link ) ) {
				$link .= "%7C";
			}
			$link .= $family;

			if ( ! empty( $font['font-style'] ) || ! empty( $font['all-styles'] ) ) {
				$link .= ':';
				if ( ! empty( $font['all-styles'] ) ) {
					$link .= implode( ',', $font['all-styles'] );
				} else if ( ! empty( $font['font-style'] ) ) {
					$link .= implode( ',', $font['font-style'] );
				}
			}

			if ( ! empty( $font['subset'] ) ) {
				foreach ( $font['subset'] as $subset ) {
					if ( ! in_array( $subset, $subsets ) ) {
						array_push( $subsets, $subset );
					}
				}
			}
		}

		/** default fonts */
		if ( empty( $link ) ) {
			$link = 'family:Poppins:400,400i,700,700i%7CQuicksand:300,400,500,600,700%7CMontserrat:400,500,600,700';
		}

		if ( ! empty( $subsets ) ) {
			$link .= "&subset=" . implode( ',', $subsets );
		}
		$link .= "&display=swap";

		return '//fonts.googleapis.com/css?family=' . str_replace( '|', '%7C', $link );
	}
}


if ( ! function_exists( 'pixwell_amp_main_nav' ) ) {
	function pixwell_amp_main_nav() {
		$theme_mods = get_option( 'theme_mods_' . PIXWELL_DTEMPLATE );

		if ( ! empty( $theme_mods['nav_menu_locations']['pixwell_menu_offcanvas'] ) ) {
			return $theme_mods['nav_menu_locations']['pixwell_menu_offcanvas'];
		}

		if ( ! empty( $theme_mods['nav_menu_locations']['pixwell_menu_main'] ) ) {
			return $theme_mods['nav_menu_locations']['pixwell_menu_main'];
		}

		return false;
	}
}

/** functions includes */
include_once PIXWELL_DTHEME_DIR . 'includes/core.php';
include_once PIXWELL_DTHEME_DIR . 'includes/actions.php';
include_once PIXWELL_DTHEME_DIR . 'includes/query.php';
include_once PIXWELL_DTHEME_DIR . 'includes/posts.php';
include_once PIXWELL_DTHEME_DIR . 'includes/single.php';
include_once PIXWELL_DTHEME_DIR . 'includes/blog-pages.php';
include_once PIXWELL_DTHEME_DIR . 'includes/translation.php';
include_once PIXWELL_DTHEME_DIR . 'includes/social-data.php';
include_once PIXWELL_DTHEME_DIR . 'includes/dynamic-css.php';
if ( class_exists( 'WooCommerce' ) ) {
	include_once PIXWELL_DTHEME_DIR . 'includes/wc.php';
}

/** templates */
include_once PIXWELL_DTHEME_DIR . 'templates/site-sections.php';
include_once PIXWELL_DTHEME_DIR . 'templates/single-post.php';
include_once PIXWELL_DTHEME_DIR . 'templates/single/parts.php';
include_once PIXWELL_DTHEME_DIR . 'templates/blog.php';
include_once PIXWELL_DTHEME_DIR . 'templates/social-icons.php';
include_once PIXWELL_DTHEME_DIR . 'templates/block-elements.php';
include_once PIXWELL_DTHEME_DIR . 'templates/post-elements.php';
include_once PIXWELL_DTHEME_DIR . 'templates/reviews.php';
include_once PIXWELL_DTHEME_DIR . 'templates/composer.php';
include_once PIXWELL_DTHEME_DIR . 'templates/page.php';
include_once get_theme_file_path( 'templates/parts.php' );
include_once get_theme_file_path( 'templates/layouts.php' );
