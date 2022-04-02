<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** amp grid 2 listing */
if ( ! function_exists( 'pixwell_amp_listing_grid_2' ) ) :
	function pixwell_amp_listing_grid_2( $settings, $query_data ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :

			while ( $query_data->have_posts() ) :
				$query_data->the_post();
				echo '<div class="rb-col-m6 rb-col-d3 rb-p15-gutter">';
				pixwell_amp_post_grid_2( $settings );
				echo '</div>';
			endwhile;
		endif;
	}
endif;


/** featured section */
if ( ! function_exists( 'pixwell_amp_featured_section' ) ) {
	function pixwell_amp_featured_section( $query_data ) {

		$settings['uuid']            = 'amp-featured';
		$settings['classes']         = 'fw-block fw-feat-1 none-margin';
		$settings['content_classes'] = 'rb-n10-all rb-sh rb-row';
		$settings['post_per_pages']  = 'rb-n10-all rb-sh';

		ob_start();
		pixwell_block_open( $settings, $query_data );
		pixwell_block_header( $settings );

		if ( ! $query_data->have_posts() || $query_data->post_count < 3 ) {
			pixwell_not_enough( 3 );
		} else {
			pixwell_block_content_open( $settings );
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
				if ( 1 == $counter ) {
					echo '<div class="col-left rb-col-d8 rb-col-m12">';
					echo '<div class="p-outer rb-p10-all rb-col-m12">';
					pixwell_amp_post_overlay_1( $settings );
					echo '</div>';
					echo '</div>';
				} elseif ( 2 == $counter ) {
					echo '<div class="col-right rb-col-d4 rb-col-m12">';
					echo '<div class="p-outer rb-p10-all rb-col-m12">';
					pixwell_amp_post_overlay_2( $settings );
					echo '</div>';
				} else {
					echo '<div class="p-outer rb-p10-all rb-col-m12">';
					pixwell_amp_post_overlay_2( $settings );
					echo '</div>';
					echo '</div>';
				}

				$counter ++;
				if ( $counter > 3 ) {
					break;
				}
			endwhile;
			pixwell_block_content_close();
			wp_reset_postdata();
		}

		pixwell_block_close();

		echo ob_get_clean();
	}
}


/** amp grid 2 */
if ( ! function_exists( 'pixwell_amp_post_grid_2' ) ) :
	function pixwell_amp_post_grid_2( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'grid_2' );
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h4';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-grid p-grid-2 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_280x210' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = ' rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_280x210' ) ) : ?>
				<div class="p-feat-holder">
					<div class="p-feat">
						<?php
						pixwell_post_thumb( 'pixwell_280x210', 'pc-75' );
						pixwell_post_cat_info( $settings );
						?>
					</div>
					<?php pixwell_post_review_info( $settings ); ?>
				</div>
			<?php endif; ?>
			<div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'] ); ?></div>
			<?php pixwell_post_summary( $settings ); ?>
			<div class="p-footer">
				<?php echo pixwell_post_meta_info( $settings );
				pixwell_post_readmore( $settings ); ?>
			</div>
		</div>
	<?php
	}
endif;



/** amp post list 2 */
if ( ! function_exists( 'pixwell_amp_post_list_2' ) ) :
	function pixwell_amp_post_list_2( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'list_2' );
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h3';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-list p-list-2 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_280x210' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_280x210' ) ) : ?>
				<div class="col-left">
					<div class="p-feat-holder">
						<div class="p-feat">
							<?php
							pixwell_post_thumb( 'pixwell_280x210', 'pc-75' );
							pixwell_post_cat_info( $settings );
							?>
						</div>
						<?php pixwell_post_review_info( $settings ); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-right">
				<div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'] ); ?></div>
				<?php pixwell_post_summary( $settings ); ?>
				<div class="p-footer">
					<?php echo pixwell_post_meta_info( $settings );
					pixwell_post_readmore( $settings ); ?>
				</div>
			</div>
		</div>
	<?php
	}
endif;


/** overlay 1 */
if ( ! function_exists( 'pixwell_amp_post_overlay_1' ) ) :
	function pixwell_amp_post_overlay_1( $settings = array() ) {
		$settings['cat_classes'] = 'is-relative';
		$settings                = pixwell_get_meta_setting( $settings, 'overlay_1' );
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-overlay p-overlay-1 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<div class="p-feat-holder">
				<?php pixwell_post_review_info( $settings ); ?>
				<div class="p-feat">
					<?php pixwell_post_thumb( 'pixwell_370x250-3x' ); ?>
					<div class="content-overlay is-light-text">
						<div class="overlay-holder">
							<?php pixwell_post_cat_info( $settings ); ?>
							<div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'], 'h1' ); ?></div>
							<?php pixwell_post_summary( $settings ); ?>
							<div class="p-footer">
								<?php echo pixwell_post_meta_info( $settings );
								pixwell_post_readmore( $settings ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
endif;

/**
 * @param array $settings
 * loop overlay 2
 */
if ( ! function_exists( 'pixwell_amp_post_overlay_2' ) ) :
	function pixwell_amp_post_overlay_2( $settings = array() ) {
		$settings['cat_classes'] = 'is-relative';
		$settings                = pixwell_get_meta_setting( $settings, 'overlay_2' );
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h3';
		}

		$post_classes   = array();
		$size           = 'pixwell_370x250';
		$post_classes[] = 'p-wrap p-overlay p-overlay-2 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		}
		if ( ! empty( $settings['feat_size'] ) ) {
			$size = $settings['feat_size'];
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<div class="p-feat">
				<?php pixwell_post_thumb( $size ); ?>
				<div class="content-overlay is-light-text">
					<div class="overlay-holder">
						<?php pixwell_post_cat_info( $settings ); ?>
						<div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'] ); ?></div>
						<div class="p-footer">
							<?php echo pixwell_post_meta_info( $settings ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
endif;