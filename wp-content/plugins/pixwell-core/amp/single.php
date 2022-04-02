<?php
get_header();
if ( have_posts() ) :
	while ( have_posts() ) {
		the_post();
		$format                        = pixwell_get_post_format();
		$amp_disable_author            = pixwell_get_option( 'amp_disable_author' );
		$amp_disable_single_pagination = pixwell_get_option( 'amp_disable_single_pagination' );
		?>
		<div class="site-content single-wrap single-4 clearfix none-sidebar">
			<div class="wrap rbc-container rb-p20-gutter clearfix">
				<main id="main" class="site-main single-inner">
					<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
						<header class="single-header entry-header">
							<div class="header-centred">
								<?php
								pixwell_breadcrumb();
								pixwell_single_cat_info();
								pixwell_single_title();
								pixwell_single_sponsor();
								pixwell_single_tagline();
								pixwell_single_entry_meta();
								?>
							</div>
							<?php
							switch ( $format ) {
								case 'video' :
									pixwell_single_featured_video();
									break;
								case 'audio' :
									pixwell_single_featured_audio();
									break;
								default:
									pixwell_single_featured_image( 'pixwell_780x0' );
									break;
							} ?>
						</header>
						<?php pixwell_single_entry(); ?>
					</article>
					<div class="single-box clearfix">
						<?php
						if ( empty( $amp_disable_author ) ) {
							pixwell_render_author_box();
						}
						if ( empty( $amp_disable_single_pagination ) ) {
							pixwell_single_navigation();
						}
						pixwell_amp_single_comment();
						?>
					</div>
				</main>
			</div>
			<?php pixwell_amp_single_related(); ?>
		</div>
	<?php
	}
endif;

/** get footer */
get_footer();
