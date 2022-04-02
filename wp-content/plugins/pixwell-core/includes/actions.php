<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', 'pixwell_start_wp_head_buffer', 0 );
add_action( 'wp_head', 'pixwell_end_wp_head_buffer', PHP_INT_MAX );
add_action( 'wp_head', 'pixwell_bookmarklet_icon', 1 );
add_action( 'wp_head', 'pixwell_pingback_header', 5 );
add_action( 'wp_head', 'pixwell_preload_font_icon', 9 );
add_action( 'pre_get_posts', 'pixwell_blog_posts_per_page' );
add_action( 'save_post', 'pixwell_add_total_review', 99, 1 );
add_action( 'save_post', 'pixwell_add_total_word', 100, 1 );
add_action( 'pre_get_posts', 'pixwell_filter_search' );
add_action( 'wp_enqueue_scripts', 'pixwell_remove_default_cooked', 999 );
add_action( 'wp_footer', 'rb_render_cookie_popup' );
add_action( 'wp_footer', 'pixwell_load_svg_icons', 99 );
add_action( 'init', 'pixwell_remove_plugin_hooks' );
add_filter( 'user_contactmethods', 'pixwell_additional_author_info' );
add_filter( 'cooked_get_settings', 'pixwell_cooked_restore_content' );
add_filter( 'pvc_post_views_html', 'pixwell_post_views_remove', 999 );
add_filter( 'rbc_default_sidebar', 'pixwell_set_sidebar' );
add_filter( 'cooked_default_content', 'pixwell_cooked_default_content' );
add_filter( 'rb_deal_feat_medium', 'pixwell_deal_feat_medium' );
add_filter( 'bcn_pick_post_term', 'pixwell_pick_primary_cat', 10, 4 );
add_filter( 'post_class', 'pixwell_remove_hatom', 10, 1 );
add_filter( 'pvc_enqueue_styles', '__return_false' );

remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );
add_filter( 'wp_lazy_loading_enabled', 'pixwell_lazy_load' );

add_action( 'init', 'pixwell_elementor_font_display', 20 );
add_action( 'wp_enqueue_scripts', 'pixwell_enqueue_optimized', 1000 );
add_filter( 'wp_get_attachment_image_attributes', 'pixwell_optimize_featured_image', 10, 3 );
add_filter( 'widget_text', 'do_shortcode' );

if ( ! function_exists( 'pixwell_pingback_header' ) ):
	function pixwell_pingback_header() {
		if ( is_singular() && pings_open() ) : ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
		<?php endif;
	}
endif;

/**
 * bookmarklet icons
 */
if ( ! function_exists( 'pixwell_bookmarklet_icon' ) ) :
	function pixwell_bookmarklet_icon() {

		$apple_icon = pixwell_get_option( 'icon_touch_apple' );
		$metro_icon = pixwell_get_option( 'icon_touch_metro' );

		if ( ! empty( $apple_icon['url'] ) ) : ?>
            <link rel="apple-touch-icon" href="<?php echo esc_url( $apple_icon['url'] ); ?>"/>
		<?php endif;

		if ( ! empty( $metro_icon['url'] ) ) : ?>
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="<?php echo esc_url( $metro_icon['url'] ); ?>"/>
		<?php endif;
	}
endif;

/**
 * @param $html
 *
 * @return bool
 * remove post view
 */
if ( ! function_exists( 'pixwell_post_views_remove' ) ) :
	function pixwell_post_views_remove( $html ) {
		if ( is_single() ) {
			return false;
		} else {
			return $html;
		}
	}
endif;

/**
 * @param $query
 * post per pages
 */
if ( ! function_exists( 'pixwell_blog_posts_per_page' ) ) :
	function pixwell_blog_posts_per_page( $query ) {

		if ( is_admin() ) {
			return false;
		}

		if ( $query->is_main_query() ) {

			if ( $query->is_search() || $query->is_category() || $query->is_tag() || $query->is_author() || $query->is_archive() ) {
				$query->set( 'post_status', 'publish' );
			}
			if ( $query->is_home() ) {
				$blog_index_posts_per_page = pixwell_get_option( 'blog_posts_per_page_index' );
				if ( ! empty( $blog_index_posts_per_page ) ) {
					$query->set( 'posts_per_page', intval( $blog_index_posts_per_page ) );
				}
			} elseif ( $query->is_search() ) {
				$search_posts_per_page = pixwell_get_option( 'blog_posts_per_page_search' );
				if ( ! empty( $search_posts_per_page ) ) {
					$query->set( 'posts_per_page', intval( $search_posts_per_page ) );
				}
			} elseif ( $query->is_category() ) {
				$cat_id         = $query->get_queried_object_id();
				$cat_cf_options = get_option( 'pixwell_meta_categories', array() );
				if ( ! empty( $cat_cf_options[ $cat_id ] ) && ! empty( $cat_cf_options[ $cat_id ]['posts_per_page'] ) ) {
					$cat_posts_per_page = $cat_cf_options[ $cat_id ]['posts_per_page'];
				} else {
					$cat_posts_per_page = pixwell_get_option( 'blog_posts_per_page_cat' );
				}
				if ( ! empty( $cat_posts_per_page ) ) {
					$query->set( 'posts_per_page', intval( $cat_posts_per_page ) );
				}
			} elseif ( $query->is_author() ) {
				$author_posts_per_page = pixwell_get_option( 'blog_posts_per_page_author' );
				if ( ! empty( $author_posts_per_page ) ) {
					$query->set( 'posts_per_page', intval( $author_posts_per_page ) );
				}
			} elseif ( $query->is_archive() ) {

				if ( $query->is_post_type_archive( 'rb-portfolio' ) || $query->is_tax( 'portfolio-category' ) ) {
					$portfolio_posts_per_page = pixwell_get_option( 'portfolio_posts_per_page' );
					if ( ! empty( $portfolio_posts_per_page ) ) {
						$query->set( 'posts_per_page', intval( $portfolio_posts_per_page ) );
					}
				} else {
					$archive_posts_per_page = pixwell_get_option( 'blog_posts_per_page_archive' );
					if ( ! empty( $archive_posts_per_page ) ) {
						$query->set( 'posts_per_page', intval( $archive_posts_per_page ) );
					}
				}
			}
		}

		return false;
	}
endif;

/**
 * @return string
 * set default sidebar name
 */
if ( ! function_exists( 'pixwell_set_sidebar' ) ) {
	function pixwell_set_sidebar() {
		return 'pixwell_sidebar_default';
	}
}

/**
 * @return bool
 * remove search page
 */
if ( ! function_exists( 'pixwell_filter_search' ) ) {
	function pixwell_filter_search( $query ) {

		$search_page = pixwell_get_option( 'search_post' );
		if ( ! empty( $search_page ) && ! is_admin() && $query->is_search() && $query->is_main_query() ) {
			$query->set( 'post_type', 'post' );
		}

		return $query;
	}
}

/**
 * @return array
 * author info
 */
if ( ! function_exists( 'pixwell_additional_author_info' ) ) :
	function pixwell_additional_author_info( $user ) {

		if ( ! is_array( $user ) ) {
			$user = array();
		}

		$data = array(
			'job'        => esc_html__( 'Your Job Name', 'pixwell-core' ),
			'feat'       => esc_html__( 'Author Box Background', 'pixwell-core' ) . '<br/><small>' . esc_html__( '(Input attachment Image URL)', 'pixwell-core' ),
			'facebook'   => esc_html__( 'Facebook profile URL', 'pixwell-core' ),
			'rb_twitter' => esc_html__( 'Twitter profile URL', 'pixwell-core' ),
			'instagram'  => esc_html__( 'Instagram profile URL', 'pixwell-core' ),
			'pinterest'  => esc_html__( 'Pinterest profile URL', 'pixwell-core' ),
			'linkedin'   => esc_html__( 'LinkedIn profile URL', 'pixwell-core' ),
			'tumblr'     => esc_html__( 'Tumblr profile URL', 'pixwell-core' ),
			'flickr'     => esc_html__( 'Flickr profile URL', 'pixwell-core' ),
			'skype'      => esc_html__( 'Skype profile URL', 'pixwell-core' ),
			'snapchat'   => esc_html__( 'Snapchat profile URL', 'pixwell-core' ),
			'myspace'    => esc_html__( 'Myspace profile URL', 'pixwell-core' ),
			'youtube'    => esc_html__( 'Youtube profile URL', 'pixwell-core' ),
			'bloglovin'  => esc_html__( 'Bloglovin profile URL', 'pixwell-core' ),
			'digg'       => esc_html__( 'Digg profile URL', 'pixwell-core' ),
			'dribbble'   => esc_html__( 'Dribbble profile URL', 'pixwell-core' ),
			'soundcloud' => esc_html__( 'Soundcloud profile URL', 'pixwell-core' ),
			'vimeo'      => esc_html__( 'Vimeo profile URL', 'pixwell-core' ),
			'reddit'     => esc_html__( 'Reddit profile URL', 'pixwell-core' ),
			'vkontakte'  => esc_html__( 'Vkontakte profile URL', 'pixwell-core' ),
			'telegram'   => esc_html__( 'Telegram profile URL', 'pixwell-core' ),
			'whatsapp'   => esc_html__( 'Whatsapp profile URL', 'pixwell-core' ),
			'rss'        => esc_html__( 'Rss', 'pixwell-core' ),
		);

		$user = array_merge( $user, $data );

		return $user;
	}
endif;

/** add total stars */
if ( ! function_exists( 'pixwell_add_total_review' ) ) {
	function pixwell_add_total_review( $post_id = '' ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$review = rb_get_meta( 'post_review', $post_id );
		if ( empty( $review ) || $review != 1 ) {
			return false;
		}

		$total = 0;
		$count = 0;

		$data = array(
			array(
				'review_label' => rb_get_meta( 'review_label_1', $post_id ),
				'review_star'  => rb_get_meta( 'review_star_1', $post_id ),
			),
			array(
				'review_label' => rb_get_meta( 'review_label_2', $post_id ),
				'review_star'  => rb_get_meta( 'review_star_2', $post_id ),
			),
			array(
				'review_label' => rb_get_meta( 'review_label_3', $post_id ),
				'review_star'  => rb_get_meta( 'review_star_3', $post_id ),
			),
			array(
				'review_label' => rb_get_meta( 'review_label_4', $post_id ),
				'review_star'  => rb_get_meta( 'review_star_4', $post_id ),
			),
			array(
				'review_label' => rb_get_meta( 'review_label_5', $post_id ),
				'review_star'  => rb_get_meta( 'review_star_5', $post_id ),
			),
			array(
				'review_label' => rb_get_meta( 'review_label_6', $post_id ),
				'review_star'  => rb_get_meta( 'review_star_6', $post_id ),
			),
			array(
				'review_label' => rb_get_meta( 'review_label_7', $post_id ),
				'review_star'  => rb_get_meta( 'review_star_7', $post_id ),
			)
		);

		foreach ( $data as $element ) {
			if ( ! empty( $element['review_label'] ) && ! empty( $element['review_star'] ) ) {
				$element['review_star'] = absint( $element['review_star'] );
				if ( $element['review_star'] > 5 ) {
					$element['review_star'] = 5;
				} elseif ( $element['review_star'] < 1 ) {
					$element['review_star'] = 1;
				}

				$total = $total + $element['review_star'];
				$count ++;
			}
		}

		if ( $count > 0 ) {
			$total = round( $total / $count, 1 );
			update_post_meta( $post_id, 'pixwell_review_stars', $total );

			return $count;
		}

		return false;
	}
}

/**
 * total word of content
 */
if ( ! function_exists( 'pixwell_add_total_word' ) ) {
	function pixwell_add_total_word( $post_id = '' ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$content    = get_post_field( 'post_content', $post_id );
		$total_word = pixwell_total_word( $content );
		update_post_meta( $post_id, 'pixwell_total_word', $total_word );

		return $total_word;
	}
}

/** cooked plugin support */
if ( ! function_exists( 'pixwell_cooked_default_content' ) ) {
	function pixwell_cooked_default_content() {
		return '<p>[cooked-info left="author,taxonomies,difficulty" right="print,fullscreen"]</p><p>[cooked-excerpt]</p><p>[cooked-info left="servings" right="prep_time,cook_time,total_time"]</p><p>[cooked-ingredients]</p><p>[cooked-directions]</p><p>[cooked-gallery]</p>';
	}
}

/** restore default if empty */
if ( ! function_exists( 'pixwell_cooked_restore_content' ) ) {
	function pixwell_cooked_restore_content( $settings ) {
		if ( empty( $settings['default_content'] ) ) {
			$settings['default_content'] = pixwell_cooked_default_content();
		}

		return $settings;
	}
}

/** support cooked plugin with infinite load next */
if ( ! function_exists( 'pixwell_remove_default_cooked' ) ) {
	function pixwell_remove_default_cooked() {
		if ( is_plugin_active( 'cooked/cooked.php' ) ) {
			wp_deregister_script( 'cooked-functions-js' );
			wp_register_script( 'cooked-functions-js', PIXWELL_CORE_URL . 'assets/cooked-reload.js', array( 'jquery' ), '1.0', true );
		}
	}
}

/** default deal thumbnails */
if ( ! function_exists( 'pixwell_deal_feat_medium' ) ) {
	function pixwell_deal_feat_medium( $size ) {
		return 'pixwell_280x210';
	}
}

/** render cookie popup */
if ( ! function_exists( 'rb_render_cookie_popup' ) ) :
	function rb_render_cookie_popup() {
		$popup = pixwell_get_option( 'cookie_popup' );
		if ( empty( $popup ) || pixwell_is_amp() ) {
			return;
		}

		$content = pixwell_get_option( 'cookie_popup_content' );
		$button  = pixwell_get_option( 'cookie_popup_button' ); ?>
        <aside id="rb-cookie" class="rb-cookie">
            <p class="cookie-content"><?php echo do_shortcode( $content ); ?></p>
            <div class="cookie-footer">
                <a id="cookie-accept" class="cookie-accept" href="#"><?php echo esc_html( $button ) ?></a>
            </div>
        </aside>
		<?php
	}
endif;

/** primary category */
if ( ! function_exists( 'pixwell_pick_primary_cat' ) ) {
	function pixwell_pick_primary_cat( $terms, $id, $type, $taxonomy ) {
		if ( 'post' == $type ) {
			$primary_category = rb_get_meta( 'primary_cat', $id );
			if ( empty( $primary_category ) ) {
				return $terms;
			};

			return get_term_by( 'id', $primary_category, $taxonomy );
		}

		return $terms;
	}
}

/** load svg */
if ( ! function_exists( 'pixwell_load_svg_icons' ) ) {
	function pixwell_load_svg_icons() {
		if ( pixwell_is_amp() ) {
			return false;
		}
		include_once PIXWELL_CORE_PATH . 'includes/icons.php';
	}
}

/** remove hatom */
if ( ! function_exists( 'pixwell_remove_hatom' ) ):
	function pixwell_remove_hatom( $classes ) {
		foreach ( $classes as $key => $value ) {
			if ( $value == 'hentry' ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;
	}
endif;

/** preload font icons */
if ( ! function_exists( 'pixwell_preload_font_icon' ) ):
	function pixwell_preload_font_icon() {

		$preload_icon = pixwell_get_option( 'preload_icon' );
		if ( ! empty( $preload_icon ) ) {
			echo '<link rel="preload" href="' . get_theme_file_uri( 'assets/fonts/ruby-icon.woff' ) . '" as="font" type="font/woff" crossorigin="anonymous"> ';
		}
	}
endif;

if ( ! function_exists( 'pixwell_lazy_load' ) ) {
	/**
	 * @return bool
	 */
	function pixwell_lazy_load() {

		if ( empty( pixwell_get_option( 'lazy_load' ) ) ) {
			return false;
		} else {
			return true;
		}
	}
}

if ( ! function_exists( 'pixwell_remove_plugin_hooks' ) ) {
	/**
	 * remove multiple authors
	 */
	function pixwell_remove_plugin_hooks() {

		global $multiple_authors_addon;
		if ( ! empty( $multiple_authors_addon ) ) {
			remove_filter( 'the_content', array( $multiple_authors_addon, 'filter_the_content' ) );
		}
	}
}

if ( ! function_exists( 'pixwell_enqueue_optimized' ) ) {
	function pixwell_enqueue_optimized() {

		/** disable on elementor live editor */
		if ( ! empty( $_GET['elementor-preview'] ) ) {
			return;
		}

		if ( pixwell_get_option( 'disable_dashicons' ) && ! is_user_logged_in() ) {
			wp_deregister_style( 'dashicons' );
		}
		if ( pixwell_get_option( 'disable_block_style' ) && ( is_page_template( 'rbc-frontend.php' ) || pixwell_is_elementor() ) && ! is_admin() ) {
			wp_deregister_style( 'wp-block-library' );
		}
		if ( pixwell_get_option( 'disable_polyfill' ) && ! is_admin() ) {
			wp_deregister_script( 'wp-polyfill' );
		}
	}
}

if ( ! function_exists( 'pixwell_is_elementor' ) ) {
	/**
	 * @return bool
	 */
	function pixwell_is_elementor() {

		if ( ! is_page() ) {
			return false;
		}
		$document = false;
		if ( class_exists( 'Elementor\Plugin' ) ) {
			$document = Elementor\Plugin::$instance->documents->get( get_the_ID() );
		}
		if ( $document && $document->is_built_with_elementor() ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'pixwell_elementor_font_display' ) ) {
	function pixwell_elementor_font_display() {
		if ( empty( get_option( 'elementor_font_display' ) ) ) {
			update_option( 'elementor_font_display', 'swap' );
		}
	}
}

if ( ! function_exists( 'pixwell_optimize_featured_image' ) ) {
	/**
	 * @param $attr
	 * @param $attachment
	 * @param $size
	 *
	 * @return mixed
	 */
	function pixwell_optimize_featured_image( $attr, $attachment, $size ) {
		if ( pixwell_get_option( 'disable_srcset' ) ) {
			unset( $attr['srcset'] );
			unset( $attr['sizes'] );
		}

		return $attr;
	}
}

/** per load google font */
if ( ! function_exists( 'pixwell_start_wp_head_buffer' ) ) {
	function pixwell_start_wp_head_buffer() {
		ob_start();
	}
}

if ( ! function_exists( 'pixwell_end_wp_head_buffer' ) ) {
	function pixwell_end_wp_head_buffer() {

		$in = ob_get_clean();
		if ( ! pixwell_get_option( 'preload_gfonts' ) || pixwell_is_amp() || is_admin() || ! empty( $_GET['elementor-preview'] ) ) {
			echo $in;

			return false;
		}

		$markup = preg_replace( '/<!--(.*)-->/Uis', '', $in );
		preg_match_all( '#<link(?:\s+(?:(?!href\s*=\s*)[^>])+)?(?:\s+href\s*=\s*([\'"])((?:https?:)?\/\/fonts\.googleapis\.com\/css(?:(?!\1).)+)\1)(?:\s+[^>]*)?>#iU', $markup, $matches );

		if ( ! $matches[2] ) {
			echo $in;
			return false;
		}

		$fonts_data    = array();
		$index             = 0;
		$fonts_string  = '';
		$subset_string = '';
		$add_pos       = '<link';

		foreach ( $matches[2] as $font ) {
			if ( ! preg_match( '/rel=["\']dns-prefetch["\']/', $matches[0][ $index ] ) ) {
				$font = str_replace( array( '%7C', '%7c' ), '|', $font );
				if ( strpos( $font, 'fonts.googleapis.com/css2' ) !== false ) {
					$font = rawurldecode( $font );
					$font = str_replace( array(
						'css2?',
						'ital,wght@',
						'wght@',
						'ital@',
						'0,',
						'1,',
						':1',
						';',
						'&family='
					), array( 'css?', '', '', '', '', 'italic', ':italic', ',', '%7C' ), $font );
				}
				$font      = explode( 'family=', $font );
				$font      = ( isset( $font[1] ) ) ? explode( '&', $font[1] ) : array();
				$this_font = array_values( array_filter( explode( '|', reset( $font ) ) ) );
				if ( ! empty( $this_font ) ) {
					$fonts_data[ $index ]['fonts'] = $this_font;
					$subset                    = ( is_array( $font ) ) ? end( $font ) : '';
					if ( false !== strpos( $subset, 'subset=' ) ) {
						$subset                      = str_replace( array( '%2C', '%2c' ), ',', $subset );
						$subset                      = explode( 'subset=', $subset );
						$fonts_data[ $index ]['subsets'] = explode( ',', $subset[1] );
					}
				}
				$in = str_replace( $matches[0][ $index ], '', $in );
			}
			$index ++;
		}

		foreach ( $fonts_data as $font ) {
			$fonts_string .= '|' . trim( implode( '|', $font['fonts'] ), '|' );
			if ( ! empty( $font['subsets'] ) ) {
				$subset_string .= ',' . trim( implode( ',', $font['subsets'] ), ',' );
			}
		}

		if ( ! empty( $subset_string ) ) {
			$subset_string = str_replace( ',', '%2C', ltrim( $subset_string, ',' ) );
			$fonts_string  = $fonts_string . '&#038;subset=' . $subset_string;
		}

		$fonts_string = str_replace( '|', '%7C', ltrim( $fonts_string, '|' ) );
		$fonts_string .= '&amp;display=swap';
		$fonts_html   = '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
		$fonts_html   .= '<link rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" id="rb-preload-gfonts" href="https://fonts.googleapis.com/css?family=' . $fonts_string . '" crossorigin>';
		$fonts_html   .= '<noscript><link rel="stylesheet" id="rb-preload-gfonts" href="https://fonts.googleapis.com/css?family=' . $fonts_string . '"></noscript>';
		echo substr_replace( $in, $fonts_html . $add_pos, strpos( $in, $add_pos ), strlen( $add_pos ) );
	}
}
