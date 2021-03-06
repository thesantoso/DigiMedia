<?php
/**
 * @param array $settings
 * @param null  $query_data
 * loop grid 1
 */
if ( ! function_exists( 'pixwell_post_grid_1' ) ) :
	function pixwell_post_grid_1( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'grid_1' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h3';
		}
		$post_classes   = array();
		$post_classes[] = 'p-wrap p-grid p-grid-1 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}

		if ( ! empty( $settings['post_shadow'] ) ) {
            $post_classes[] = 'is-post-shadow';
        }

		if ( ! pixwell_is_featured_image( 'pixwell_370x250' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = ' rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_370x250' ) ) : ?>
				<div class="p-feat-holder">
					<div class="p-feat">
						<?php
						pixwell_post_thumb( 'pixwell_370x250' );
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

/**
 * @param array $settings
 * @param null  $query_data
 * loop grid 2
 */
if ( ! function_exists( 'pixwell_post_grid_2' ) ) :
	function pixwell_post_grid_2( $settings = array() ) {
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


/**
 * @param array $settings
 * @param null  $query_data
 * loop grid 3
 */
if ( ! function_exists( 'pixwell_post_grid_3' ) ) :
	function pixwell_post_grid_3( $settings = array() ) {

		$settings = pixwell_get_meta_setting( $settings, 'grid_3' );
		$padding  = pixwell_get_option( 'padding_content_grid_3' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-grid p-grid-3 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_370x250-2x' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		}
		if ( ! empty( $padding ) ) {
			$post_classes[] = 'is-padding';
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_370x250-2x' ) ) : ?>
				<div class="p-feat-holder">
					<div class="p-feat">
						<?php
						pixwell_post_thumb( 'pixwell_370x250-2x' );
						pixwell_post_cat_info( $settings );;
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


/**
 * @param array $settings
 * @param null  $query_data
 * loop grid 4
 */
if ( ! function_exists( 'pixwell_post_grid_4' ) ) :
	function pixwell_post_grid_4( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'grid_4' );
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h4';
		}

		$title_classes  = 'h5';

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-grid p-grid-4 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_280x210' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( ! empty( $settings['popular_style'] ) ) {
			$post_classes[] = 'is-pop-style';
			$title_classes  = 'h6';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) ) {
			$post_classes[] = 'rb-hf';
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
			<div class="p-body">
				<div class="p-header">
					<?php if ( ! empty( $settings['popular_count'] ) ) : ?>
						<span class="counter-index"><?php echo esc_attr( $settings['popular_count'] ); ?>
							<span class="dot-index">.</span></span>
					<?php endif;
					pixwell_post_title( $settings['h_tag'], $settings['bookmark'], $title_classes ); ?>
				</div>
				<div class="p-footer">
					<?php echo pixwell_post_meta_info( $settings ); ?>
				</div>
			</div>
		</div>
	<?php
	}
endif;


/**
 * @param array $settings
 * @param null  $query_data
 * loop grid 5
 */
if ( ! function_exists( 'pixwell_post_grid_5' ) ) :
	function pixwell_post_grid_5( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'grid_5' );

		$settings['cat_classes'] = 'is-relative';
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h3';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-grid p-grid-5 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! empty( $settings['classes'] ) ) {
			$post_classes[] = esc_attr( $settings['classes'] );
		}
		if ( ! pixwell_is_featured_image( 'pixwell_400x450' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_400x450' ) ) : ?>
				<div class="p-feat">
					<?php
					pixwell_post_thumb( 'pixwell_400x450', 'pc-110' );
					pixwell_post_review_info( $settings );
					?>
				</div>
			<?php endif; ?>
			<div class="p-content-wrap">
				<?php pixwell_post_cat_info( $settings ); ?>
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


/**
 * @param array $settings
 * @param null  $query_data
 * loop grid 6
 */
if ( ! function_exists( 'pixwell_post_grid_6' ) ) :
	function pixwell_post_grid_6( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'grid_6' );

		$settings['cat_classes'] = 'is-relative';
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h3';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-grid p-grid-6 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		$text_style = pixwell_get_option( 'text_style_grid_6' );
		if ( ! empty( $settings['classes'] ) ) {
			$post_classes[] = esc_attr( $settings['classes'] );
		}
		if ( ! empty( $text_style ) && 'light' == $text_style ) {
			$post_classes[] = 'is-light-text';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_400x450' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
		<div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_400x450' ) ) : ?>
				<div class="p-feat">
					<?php
					pixwell_post_thumb( 'pixwell_400x450', 'pc-110' );
					pixwell_post_review_info( $settings );
					?>
				</div>
			<?php endif; ?>
			<div class="p-content-wrap">
				<div class="p-content-inner">
					<?php pixwell_post_cat_info( $settings ); ?>
					<div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'] ); ?></div>
					<?php pixwell_post_summary( $settings ); ?>
					<div class="p-footer">
						<?php echo pixwell_post_meta_info( $settings );
						pixwell_post_readmore( $settings ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
endif;

/**
 * @param array $settings
 * @param null  $query_data
 * loop grid 7
 */
if ( ! function_exists( 'pixwell_post_grid_7' ) ) :
	function pixwell_post_grid_7( $settings = array() ) {

		$format           = pixwell_get_post_format();
		$self_hosted_audio_id = rb_get_meta( 'audio_hosted' );
		$settings = pixwell_get_meta_setting( $settings, 'grid_7' );
		$padding  = pixwell_get_option( 'padding_content_grid_7' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-podcast-wrap p-grid p-grid-7 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_370x250-2x' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		}
		if ( ! empty( $padding ) ) {
			$post_classes[] = 'is-padding';
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_370x250-2x' ) ) : ?>
                <div class="p-feat-holder">
                    <div class="p-feat">
						<?php
						if ( 'audio'== $format && empty( $self_hosted_audio_id ) ) { ?>
                            <div class="p-no-hosted">
								<?php pixwell_single_featured_audio(); ?>
                            </div>
							<?php
						} else {
							pixwell_post_thumb( 'pixwell_370x250-2x' );
						}
						pixwell_post_cat_info( $settings );;
						?>
                    </div>
					<?php pixwell_post_review_info( $settings ); ?>
                </div>
			<?php endif; ?>
            <div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'] ); ?></div>
	        <?php
	        if ( ! empty( $self_hosted_audio_id ) ) {
		        pixwell_single_featured_audio();
	        }
	        ?>
			<?php pixwell_post_summary( $settings ); ?>
            <div class="p-footer">
				<?php echo pixwell_post_meta_info( $settings );
				pixwell_post_readmore( $settings ); ?>
            </div>
        </div>
		<?php
	}
endif;

/**
 * @param array $settings
 * @param null  $query_data
 * loop grid w1
 */
if ( ! function_exists( 'pixwell_post_grid_w1' ) ) :
	function pixwell_post_grid_w1() { ?>
		<div class="p-wrap p-grid p-grid-w1 post-<?php echo get_the_ID(); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_280x210' ) ) : ?>
				<div class="p-feat">
					<?php pixwell_post_thumb( 'pixwell_280x210' , 'pc-75' ); ?>
				</div>
			<?php endif;
			pixwell_post_title( 'h6' );  ?>
		</div>
	<?php
	}
endif;
