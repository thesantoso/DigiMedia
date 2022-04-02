<?php
/**
 * @param $option_name
 *
 * @return string
 * get theme options
 */
if ( ! function_exists( 'pixwell_get_option' ) ) {
	function pixwell_get_option( $option_name ) {

		$settings = get_option( 'pixwell_theme_options' );
		if ( empty( $settings ) ) {
			$settings = pixwell_default_option_values();
		}

		if ( ! empty( $settings[ $option_name ] ) ) {
			return $settings[ $option_name ];
		}

		return false;
	}
}

/**
 * @param $meta
 * @param $post_id
 *
 * @return bool
 * fallback if don't active plugin
 */
if ( ! function_exists( 'rb_get_meta' ) ) {
	function rb_get_meta( $meta = null, $post_id = null ) {
		return false;
	}
}

/** get protocol */
if ( ! function_exists( 'pixwell_protocol' ) ) {
	function pixwell_protocol() {
		if ( ! is_ssl() ) {
			return 'http';
		}

		return 'https';
	}
}

if ( ! function_exists( 'pixwell_breadcrumb' ) ) {
	/**
	 * @param string $classes
	 *
	 * @return false
	 */
	function pixwell_breadcrumb( $classes = 'rbc-container rb-p20-gutter' ) {
		return false;
	}
}

/** fallback rb_render_newsletter */
if ( ! function_exists( 'rb_render_newsletter' ) ) {
	function rb_render_newsletter() {
		return false;
	}
}

/** filter content for ajax */
if ( ! function_exists( 'pixwell_filter_content_ajax' ) ) {
	function pixwell_filter_content_ajax( $content ) {
		global $wp_query;
		if ( ! isset( $wp_query->query_vars['rbsnp'] ) || ! is_single() ) {
			return $content;
		} else {
			return str_replace( "(adsbygoogle = window.adsbygoogle || []).push({});", '', $content );
		}
	}
}

/** show over k */
if ( ! function_exists( 'pixwell_show_over_k' ) ) {
	function pixwell_show_over_k( $number ) {
		$number = intval( $number );

		if ( $number > 999999 ) {
			$number = str_replace( '.00', '', number_format( ( $number / 1000000 ), 2 ) ) . esc_attr__( 'M', 'pixwell' );
		} elseif ( $number > 999 ) {
			$number = str_replace( '.0', '', number_format( ( $number / 1000 ), 1 ) ) . esc_attr__( 'k', 'pixwell' );
		}

		return $number;
	}
}

/** ensuring backward compatibility with versions of WordPress older than 5.2. */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'pixwell_dark_mode' ) ) {
	/** dark mode activated */
	function pixwell_dark_mode() {
		return pixwell_get_option( 'dark_mode' );
	}
}

/** check AMP */
if ( ! function_exists( 'pixwell_is_amp' ) ) {
	function pixwell_is_amp() {
		return function_exists( 'amp_is_request' ) && amp_is_request();
	}
}

/** create missing fonts url */
if ( ! function_exists( 'pixwell_missing_font_urls' ) ) {
	function pixwell_missing_font_urls() {
		$font_families  = array();
		$font_body      = pixwell_get_option( 'font_body' );
		$font_h1        = pixwell_get_option( 'font_h1' );
		$font_cat_icon  = pixwell_get_option( 'font_cat_icon' );
		$font_post_meta = pixwell_get_option( 'font_post_meta' );

		if ( empty( $font_h1['font-family'] ) ) {
			$font_families[] = 'Quicksand:300,400,500,600,700';
		}

		if ( empty( $font_body['font-family'] ) ) {
			$font_families[] = 'Poppins:400,400i,700,700i';
		}

		if ( empty( $font_cat_icon['font-family'] ) || empty( $font_post_meta['font-family'] ) ) {
			$font_families[] = 'Montserrat:400,500,600,700';
		}

		if ( count( $font_families ) > 0 ) {
			$params = array(
				'family'  => urlencode( implode( '%7C', $font_families ) ),
				'subset'  => urlencode( 'latin,latin-ext' ),
				'display' => 'swap'
			);
			$link   = add_query_arg( $params, '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'google-font-quicksand-montserrat-poppins', esc_url_raw( $link ), array(), PIXWELL_THEME_VERSION, 'all' );
		}

		return false;
	}
}

if ( ! function_exists( 'pixwell_render_svg' ) ) {
	/**
	 * @param string $svg_name
	 * @param string $color
	 * @param string $ui
	 * render svg
	 */
	function pixwell_render_svg( $svg_name = '', $color = '', $ui = '' ) {

		echo pixwell_get_svg( $svg_name, $color, $ui );
	}
}

if ( ! function_exists( 'pixwell_get_svg' ) ) {
	/**
	 * @param string $svg_name
	 * @param string $color
	 * @param string $ui
	 *
	 * @return false
	 * get svg icon
	 */
	function pixwell_get_svg( $svg_name = '', $color = '', $ui = '' ) {

		return false;
	}
}

if ( ! function_exists( 'pixwell_getimagesize' ) ) {
	/**
	 * @param $image
	 *
	 * @return array|false
	 */
	function pixwell_getimagesize( $image ) {
		if ( empty( $image ) ) {
			return false;
		}

		return @getimagesize( $image );
	}
}

