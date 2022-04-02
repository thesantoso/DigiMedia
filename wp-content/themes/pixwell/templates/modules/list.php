<?php
/**
 * @param array $settings
 * @param null $query_data
 * loop list 1
 */
if ( ! function_exists( 'pixwell_post_list_1' ) ) :
	function pixwell_post_list_1( $settings = array() ) {

		$settings = pixwell_get_meta_setting( $settings, 'list_1' );
		$border   = pixwell_get_option( 'border_list_1' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}
		$settings['cat_classes'] = 'is-absolute';

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-list p-list-1 rb-row post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_370x250-2x' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( ! empty( $border ) ) {
			$post_classes[] = 'is-border';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) && empty( $settings['readmore'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_370x250-2x' ) ) : ?>
                <div class="rb-col-m12 rb-col-t6 col-left">
                    <div class="p-feat-holder">
                        <div class="p-feat">
							<?php
							pixwell_post_thumb( 'pixwell_370x250-2x' );
							pixwell_post_cat_info( $settings );
							?>
                        </div>
						<?php pixwell_post_review_info( $settings ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <div class="rb-col-m12 rb-col-t6 col-right">
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


if ( ! function_exists( 'pixwell_post_list_2' ) ) {
	/**
	 * @param array $settings
	 */
	function pixwell_post_list_2( $settings = array() ) {
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
}


/**
 * @param array $settings
 * @param null $query_data
 * loop list 3
 */
if ( ! function_exists( 'pixwell_post_list_3' ) ) :
	function pixwell_post_list_3( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'list_3' );
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-list p-list-3 post-' . get_the_ID();
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

/**
 * @param array $settings
 * @param null $query_data
 * loop list 4
 */
if ( ! function_exists( 'pixwell_post_list_4' ) ) :
	function pixwell_post_list_4( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'list_4' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h4';
		}

		if ( ! isset( $settings['h_class'] ) ) {
			$settings['h_class'] = 'h6';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-list p-list-4 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( ! pixwell_is_featured_image( 'pixwell_280x210' ) ) {
			$post_classes[] = 'no-feat';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_280x210' ) ) : ?>
                <div class="col-left">
                    <div class="p-feat">
						<?php pixwell_post_thumb( 'pixwell_280x210', 'pc-75' ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <div class="col-right">
                <div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'], $settings['h_class'] ); ?></div>
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
 * @param null $query_data
 * loop list 5
 */
if ( ! function_exists( 'pixwell_post_list_5' ) ) :
	function pixwell_post_list_5( $settings = array() ) {
		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h3';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-list p-list-5 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( empty( $settings['entry_meta']['enabled'] ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = ' no-avatar';
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
            <div class="p-header">
				<?php pixwell_post_cat_dot(); ?>
				<?php pixwell_post_title( $settings['h_tag'], false, 'h6' ); ?>
            </div>
            <div class="p-footer">
				<?php echo pixwell_post_meta_info( $settings ); ?>
            </div>
        </div>
		<?php
	}
endif;

/**
 * @param array $settings
 * loop list 6
 */
if ( ! function_exists( 'pixwell_post_list_6' ) ) :
	function pixwell_post_list_6( $settings = array() ) {
		$settings   = pixwell_get_meta_setting( $settings, 'list_6' );
		$text_style = pixwell_get_option( 'text_style_list_6' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}
		$settings['cat_classes'] = 'is-absolute';

		$post_classes   = array();
		$post_classes[] = 'p-wrap rb-row p-list p-list-6 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( ! empty( $text_style ) && 'light' == $text_style ) {
			$post_classes[] = 'is-light-text';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
            <div class="rb-col-m12 rb-col-t6 col-left">
                <div class="p-feat-holder">
                    <div class="p-feat">
						<?php
						pixwell_post_thumb( 'pixwell_370x250-2x' );
						pixwell_post_cat_info( $settings );
						?>
                    </div>
					<?php pixwell_post_review_info( $settings ); ?>
                </div>
            </div>
            <div class="rb-col-m12 rb-col-t6 col-right">
                <div class="p-content-wrap">
                    <div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'] ); ?></div>
					<?php pixwell_post_summary( $settings ); ?>
                    <div class="p-footer">
						<?php
						echo pixwell_post_meta_info( $settings );
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
 * loop list 7
 */
if ( ! function_exists( 'pixwell_post_list_7' ) ) :
	function pixwell_post_list_7( $settings = array() ) {
		$settings   = pixwell_get_meta_setting( $settings, 'list_7' );
		$text_style = pixwell_get_option( 'text_style_list_7' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}

		$settings['cat_classes'] = 'is-absolute';

		$post_classes   = array();
		$post_classes[] = 'p-wrap rb-row p-list p-list-7 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( ! empty( $text_style ) && 'light' == $text_style ) {
			$post_classes[] = 'is-light-text';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
            <div class="rb-col-m12 rb-col-t8 col-left">
                <div class="p-feat-holder">
                    <div class="p-feat">
						<?php
						pixwell_post_thumb( 'pixwell_370x250-3x' );
						pixwell_post_cat_info( $settings );
						?>
                    </div>
					<?php pixwell_post_review_info( $settings ); ?>
                </div>
            </div>
            <div class="rb-col-m12 rb-col-t4 col-right">
                <div class="p-content-wrap">
                    <div class="p-header"><?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'], 'h1' ); ?></div>
					<?php pixwell_post_summary( $settings ); ?>
                    <div class="p-footer">
						<?php
						echo pixwell_post_meta_info( $settings );
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
 * @param null $query_data
 * loop list 8
 */
if ( ! function_exists( 'pixwell_post_list_8' ) ) :
	function pixwell_post_list_8( $settings = array() ) {
		$settings = pixwell_get_meta_setting( $settings, 'list_8' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h3';
		}

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-list p-list-8 post-' . get_the_ID();
		if ( is_sticky() ) {
			$post_classes[] = 'sticky';
		}
		if ( empty( pixwell_post_meta_info( $settings ) ) ) {
			$post_classes[] = 'rb-hf';
		}
		if ( empty( pixwell_get_option( 'meta_author_icon' ) ) || ! isset( $settings['entry_meta']['enabled']['author'] ) ) {
			$post_classes[] = 'no-avatar';
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php pixwell_post_title( $settings['h_tag'], $settings['bookmark'] ); ?>
            <div class="p-footer">
				<?php
				echo pixwell_post_meta_info( $settings );
				pixwell_post_readmore( $settings ); ?>
            </div>
        </div>
		<?php
	}
endif;

/* post list podcast */
if ( ! function_exists( 'pixwell_post_list_9' ) ) :
	function pixwell_post_list_9( $settings = array() ) {

		$format               = pixwell_get_post_format();
		$self_hosted_audio_id = rb_get_meta( 'audio_hosted' );
		$settings             = pixwell_get_meta_setting( $settings, 'list_9' );

		if ( empty( $settings['h_tag'] ) ) {
			$settings['h_tag'] = 'h2';
		}
		$settings['cat_classes'] = 'is-relative';

		$post_classes   = array();
		$post_classes[] = 'p-wrap p-podcast-wrap p-list p-list-9 rb-row post-' . get_the_ID();
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
		} ?>
        <div class="<?php echo join( ' ', $post_classes ); ?>">
			<?php if ( pixwell_is_featured_image( 'pixwell_370x250-2x' ) ) : ?>
                <div class="rb-col-m12 rb-col-t5 col-left">
                    <div class="p-feat-holder">
                        <div class="p-feat">
							<?php if ( 'audio' == $format && empty( $self_hosted_audio_id ) ) { ?>
                                <div class="p-no-hosted">
									<?php pixwell_single_featured_audio(); ?>
                                </div>
								<?php
							} else {
								pixwell_post_thumb( 'pixwell_370x250-2x' );
							}
							?>
                        </div>
						<?php pixwell_post_review_info( $settings ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <div class="rb-col-m12 rb-col-t7 col-right">
                <div class="p-header">
					<?php
					pixwell_post_cat_info( $settings );
					pixwell_post_title( $settings['h_tag'], $settings['bookmark'], 'h1' );
					?>
                </div>
				<?php
				if ( ! empty( $self_hosted_audio_id ) ) {
					pixwell_single_featured_audio();
				}
				pixwell_post_summary( $settings ); ?>
                <div class="p-footer">
					<?php echo pixwell_post_meta_info( $settings );
					pixwell_post_readmore( $settings ); ?>
                </div>
            </div>
        </div>
		<?php
	}
endif;