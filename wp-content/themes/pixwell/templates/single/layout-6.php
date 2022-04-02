<?php
/** render single 6 */
if ( ! function_exists( 'pixwell_single_layout_6' ) ) :
	function pixwell_single_layout_6() {
		$sidebar_name     = pixwell_get_single_sidebar_name();
		$sidebar_position = pixwell_get_single_sidebar_pos();
		$format           = pixwell_get_post_format();
		$self_hosted_audio_id = rb_get_meta( 'audio_hosted' );
		$class_name       = 'site-content single-6 single-podcast rbc-content-section clearfix has-sidebar is-sidebar-' . $sidebar_position;
		?>
		<div class="<?php echo esc_attr( $class_name ); ?>">
			<?php pixwell_single_open_tag(); ?>
			<header class="single-header entry-header">
                <div class="rbc-container rb-p20-gutter">
                <div class="p-podcast-wrap rb-row">
                    <div class="rb-col-m12 rb-col-t5 col-left">
	                    <?php
                        if ( 'audio'== $format && empty( $self_hosted_audio_id ) ) { ?>
                            <div class="p-no-hosted">
                                <?php pixwell_single_featured_audio(); ?>
                            </div>
	                    <?php
                        } else {
		                    pixwell_single_featured_image( 'pixwell_780x0' );
                        }
                        ?>
                    </div>
                    <div class="rb-col-m12 rb-col-t7 col-right">
                        <?php
                        pixwell_single_cat_info();
                        pixwell_single_title();
                        pixwell_single_sponsor();
                        if ( ! empty( $self_hosted_audio_id ) ) {
                            pixwell_single_featured_audio();
                        }
                        pixwell_single_tagline();
                        pixwell_single_entry_meta();
                        ?>
                    </div>
                </div>
                </div>
			</header>
			<div class="wrap rbc-container rb-p20-gutter">
				<div class="rbc-wrap">
					<main id="main" class="site-main rbc-content">
						<div class="single-content-wrap">
							<?php
							pixwell_single_shop_top();
							pixwell_single_entry(); ?>
							<div class="single-box clearfix">
								<?php
								pixwell_render_author_box();
								pixwell_single_navigation();
								pixwell_single_comment(); ?>
							</div>
						</div>
					</main>
					<?php pixwell_render_sidebar( $sidebar_name ); ?>
				</div>
			</div>

			<?php
			pixwell_single_close_tag();
			pixwell_single_related();
			?>
		</div>
	<?php
	}
endif;
