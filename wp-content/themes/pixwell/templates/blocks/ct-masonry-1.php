<?php
/**
 * @param array $settings
 * content masonry 1
 */
if ( ! function_exists( 'pixwell_rbc_ct_masonry_1' ) ) {
	function pixwell_rbc_ct_masonry_1( $attrs ) {
		$settings = shortcode_atts( array(
			'uuid'               => '',
			'name'               => 'ct_masonry_1',
			'category'           => '',
			'categories'         => '',
			'format'             => '',
			'tags'               => '',
			'tag_not_in'         => '',
			'author'             => '',
			'post_not_in'        => '',
			'post_in'            => '',
			'order'              => '',
			'posts_per_page'     => '',
			'offset'             => '',
			'title'              => '',
			'viewmore_title'     => '',
			'viewmore_link'      => '',
			'quick_filter'       => '',
			'quick_filter_ids'   => '',
			'quick_filter_label' => '',
			'pagination'         => '',
			'text_style'         => '',
			'top_classic'        => '',
			'infeed_ad'          => '',
			'infeed_description' => '',
			'html_advert'        => '',
			'ad_attachment'      => '',
			'ad_destination'     => '',
			'ad_pos_1'           => '',
			'ad_pos_2'           => '',
		), $attrs );

		$settings['classes']          = 'ct-block ct-masonry-1 is-masonry none-margin';
		$settings['content_classes']  = 'rb-n20-gutter is-masonry-reload';
		$settings['infeed_classname'] = 'p-masonry p-masonry-1';

		$query_data = pixwell_query( $settings );

		ob_start();

		pixwell_block_open( $settings, $query_data );
		pixwell_block_header( $settings );
		if ( $query_data->have_posts() ) :
			pixwell_block_content_open( $settings );
			pixwell_rbc_ct_masonry_1_listing( $settings, $query_data );
			pixwell_block_content_close();
			pixwell_render_pagination( $settings, $query_data );
			wp_reset_postdata();
		else:
			pixwell_no_post();
		endif;
		pixwell_block_close();

		return ob_get_clean();
	}
}


/**
 * content masonry 1 listing
 */
if ( ! function_exists( 'pixwell_rbc_ct_masonry_1_listing' ) ) :
	function pixwell_rbc_ct_masonry_1_listing( $settings, $query_data ) {
		$flag    = false;
		$counter = 1;

		if ( ! empty( $settings['top_classic'] ) && ! wp_doing_ajax() ) {
			$flag = true;
		}
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="ct-ms-1"></div>';
			while ( $query_data->have_posts() ) :

				$query_data->the_post();
				if ( $flag ) {
					echo '<div class="ct-mh-1 ct-mh-1--width2">';
					echo '<div class="rb-p20-gutter">';
					pixwell_post_classic_2( $settings );
					echo '</div>';
					echo '</div>';
				} else {
					echo '<div class="ct-mh-1">';

					/** render in-feed adverts */
					if ( ! empty( $settings['infeed_ad'] ) && ! wp_doing_ajax() ) :
						if ( ( ! empty( $settings['ad_pos_1'] ) && intval( $settings['ad_pos_1'] ) == $counter ) || ( ! empty( $settings['ad_pos_2'] ) && intval( $settings['ad_pos_2'] ) == $counter ) ) {
							echo '<div class="rb-p20-gutter infeed-outer">';
							pixwell_infeed_advert( $settings );
							echo '</div>';
						}
						$counter ++;
					endif;

					echo '<div class="rb-p20-gutter">';
					pixwell_post_masonry_1( $settings );
					echo '</div>';
					echo '</div>';
				}
				$flag = false;
			endwhile;

			/** render in-feed adverts at the end */
			if ( ! empty( $settings['infeed_ad'] ) && ! wp_doing_ajax() ) :
				if ( ( ! empty( $settings['ad_pos_1'] ) && intval( $settings['ad_pos_1'] ) >= $settings['posts_per_page'] ) || ( ! empty( $settings['ad_pos_2'] ) && intval( $settings['ad_pos_2'] ) >= $settings['posts_per_page'] ) ) {
					echo '<div class="rb-p20-gutter infeed-outer">';
					pixwell_infeed_advert( $settings );
					echo '</div>';
				}
			endif;

		endif;
	}
endif;

/**
 * @param $blocks
 *
 * @return array
 * register block settings
 */
if ( ! function_exists( 'pixwell_register_ct_masonry_1' ) ) {
	function pixwell_register_ct_masonry_1( $blocks ) {

		if ( ! is_array( $blocks ) ) {
			$blocks = array();
		}

		$blocks[] = array(
			'name'        => 'ct_masonry_1',
			'title'       => esc_html__( 'Masonry Mix 1', 'pixwell' ),
			'description' => esc_html__( 'Display your posts as a masonry (classic and grid layouts) grid in the content section.', 'pixwell' ),
			'section'     => 'content',
			'img'         => get_theme_file_uri( 'assets/images/ct-masonry-1.png' ),
			'inputs'      => array(
				array(
					'type'        => 'category',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Category Filter', 'pixwell' ),
					'description' => esc_html__( 'Select category filter for this block.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'type'        => 'categories',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Categories Filter', 'pixwell' ),
					'description' => esc_html__( 'Select categories filter for this block. This option will override category filter option.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'tags',
					'type'        => 'text',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Tags Slug Filter', 'pixwell' ),
					'description' => esc_html__( 'Filter posts by tags slug, separated by commas (for example: tagslug1,tagslug2,tagslug3).', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'tag_not_in',
					'type'        => 'text',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Exclude Tags Slug', 'pixwell' ),
					'description' => esc_html__( 'Exclude some tags slug from this block, separated by commas (for example: tagslug1,tagslug2,tagslug3).', 'pixwell' ),
					'default'     => ''
				),
				array(
					'type'        => 'format',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Post Format', 'pixwell' ),
					'description' => esc_html__( 'Filter posts by post format', 'pixwell' ),
					'default'     => ''
				),
				array(
					'type'        => 'author',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Author Filter', 'pixwell' ),
					'description' => esc_html__( 'Filter posts by the author.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'post_not_in',
					'type'        => 'text',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Exclude Post IDs', 'pixwell' ),
					'description' => esc_html__( 'Exclude some post IDs from this block, separated by commas (for example: 1,2,3).', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'post_in',
					'type'        => 'text',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Post IDs Filter', 'pixwell' ),
					'description' => esc_html__( 'Filter posts by post IDs. separated by commas (for example: 1,2,3)', 'pixwell' ),
					'default'     => ''
				),
				array(
					'type'        => 'order',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Sort Order', 'pixwell' ),
					'description' => esc_html__( 'Select sort order type for this block.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'posts_per_page',
					'type'        => 'number',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Posts per Page', 'pixwell' ),
					'description' => esc_html__( 'Select number of posts per page (total posts to show).', 'pixwell' ),
					'default'     => 7
				),
				array(
					'name'        => 'offset',
					'type'        => 'number',
					'tab'         => 'filter',
					'title'       => esc_html__( 'Post Offset', 'pixwell' ),
					'description' => esc_html__( 'Select number of posts to pass over. Leave blank or set 0 if you want to show at the beginning.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'title',
					'type'        => 'text',
					'tab'         => 'header',
					'title'       => esc_html__( 'Block Title', 'pixwell' ),
					'description' => esc_html__( 'Input block title, Leave blank if you want to disable block header.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'viewmore_link',
					'type'        => 'text',
					'tab'         => 'header',
					'title'       => esc_html__( 'View More URL', 'pixwell' ),
					'description' => esc_html__( 'Input the block destination link, Leave blank if you want to disable clickable on the block header.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'viewmore_title',
					'type'        => 'text',
					'tab'         => 'header',
					'title'       => esc_html__( 'View More Label', 'pixwell' ),
					'description' => esc_html__( 'Input the block header tagline, this is description display below the block title.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'pagination',
					'type'        => 'select',
					'tab'         => 'pagination',
					'title'       => esc_html__( 'Pagination', 'pixwell' ),
					'description' => esc_html__( 'Select ajax pagination for this block, default is disable.', 'pixwell' ),
					'options'     => array(
						'0'               => esc_html__( '-Disable-', 'pixwell' ),
						'next_prev'       => esc_html__( 'Next Prev', 'pixwell' ),
						'loadmore'        => esc_html__( 'Load More', 'pixwell' ),
						'infinite_scroll' => esc_html__( 'infinite Scroll', 'pixwell' )
					),
					'default'     => 0
				),
				array(
					'name'        => 'margin',
					'type'        => 'dimension',
					'tab'         => 'design',
					'title'       => esc_html__( 'Margin', 'pixwell' ),
					'description' => esc_html__( 'Select margin top and bottom values (in px) for this block, default is 50px', 'pixwell' ),
					'default'     => array(
						'top'    => 0,
						'bottom' => 50
					),
				),
				array(
					'name'        => 'mobile_margin',
					'type'        => 'dimension',
					'tab'         => 'design',
					'title'       => esc_html__( 'Mobile - Margin', 'pixwell' ),
					'description' => esc_html__( 'Select margin top and bottom values (in px) for this block in mobile devices, default is 35px', 'pixwell' ),
					'default'     => array(
						'top'    => 0,
						'bottom' => 35
					),
				),
				array(
					'name'        => 'top_classic',
					'type'        => 'select',
					'tab'         => 'design',
					'title'       => esc_html__( '1st Classic', 'pixwell' ),
					'description' => esc_html__( 'Enable or disable 1st classic (centered) layout for this this block.', 'pixwell' ),
					'options'     => array(
						'0' => esc_html__( '-Disable-', 'pixwell' ),
						'1' => esc_html__( 'Enable', 'pixwell' )
					),
					'default'     => 1
				),
				array(
					'name'        => 'header_color',
					'type'        => 'text',
					'tab'         => 'design',
					'title'       => esc_html__( 'Header Style Color', 'pixwell' ),
					'description' => esc_html__( 'Input hex color value (ie: #ff8763) for the block header title.', 'pixwell' )
				),
				array(
					'name'        => 'text_style',
					'type'        => 'select',
					'tab'         => 'design',
					'title'       => esc_html__( 'Text Style', 'pixwell' ),
					'description' => esc_html__( 'Select block text style, Select light if you have a dark background.', 'pixwell' ),
					'options'     => array(
						'0'     => esc_html__( '-Dark-', 'pixwell' ),
						'light' => esc_html__( 'Light', 'pixwell' )
					),
					'default'     => 0
				),
				array(
					'name'        => 'infeed_ad',
					'type'        => 'select',
					'tab'         => 'advert',
					'title'       => esc_html__( 'In-feed Advertising', 'pixwell' ),
					'description' => esc_html__( 'Select in-feed adverts for this block. This feature is not compatible with ajax pagination in some cases.', 'pixwell' ),
					'options'     => array(
						'0'     => esc_html__( '-Disable-', 'pixwell' ),
						'code'  => esc_html__( 'Script Code', 'pixwell' ),
						'image' => esc_html__( 'Custom Image', 'pixwell' )
					),
					'default'     => 0
				),
				array(
					'name'        => 'html_advert',
					'type'        => 'textarea',
					'tab'         => 'advert',
					'title'       => esc_html__( 'In-feed Ad Code', 'pixwell' ),
					'description' => esc_html__( 'Input your in-feed Adsense or your script code.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'ad_attachment',
					'type'        => 'text',
					'tab'         => 'advert',
					'title'       => esc_html__( 'In-feed Ad Image', 'pixwell' ),
					'description' => esc_html__( 'Input your advert image URL (attachment URL).', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'ad_destination',
					'type'        => 'text',
					'tab'         => 'advert',
					'title'       => esc_html__( 'In-feed Ad Destination', 'pixwell' ),
					'description' => esc_html__( 'Input destination URL for your advert.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'infeed_description',
					'type'        => 'text',
					'tab'         => 'advert',
					'title'       => esc_html__( 'In-feed Ad Description', 'pixwell' ),
					'description' => esc_html__( 'Small description to show at top of adverts.', 'pixwell' ),
					'default'     => esc_html__( '- Advertisement -', 'pixwell' )
				),
				array(
					'name'        => 'ad_pos_1',
					'type'        => 'text',
					'tab'         => 'advert',
					'title'       => esc_html__( 'Position 1', 'pixwell' ),
					'description' => esc_html__( 'Display advert before X articles (Except the 1st classic), allow integer number, leave blank if you want to disable this position.', 'pixwell' ),
					'default'     => ''
				),
				array(
					'name'        => 'ad_pos_2',
					'type'        => 'text',
					'tab'         => 'advert',
					'title'       => esc_html__( 'Position 2', 'pixwell' ),
					'description' => esc_html__( 'Display advert before X articles (Except the 1st classic), allow integer number, leave blank if you want to disable this position.', 'pixwell' ),
					'default'     => ''
				)
			)
		);

		return $blocks;
	}
}

add_filter( 'rbc_add_block', 'pixwell_register_ct_masonry_1', 140 );
