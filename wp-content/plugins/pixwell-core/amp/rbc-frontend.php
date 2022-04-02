<?php
/** composer AMP */
get_header(); ?>
	<div class="site-content">
		<?php
		$pixwell_breadcrumb = pixwell_get_option( 'blog_breadcrumb_index' );
		if ( ! empty( $pixwell_breadcrumb ) && ! is_front_page() ) {
			pixwell_breadcrumb();
		}

		$pixwell_settings     = pixwell_get_settings_blog( 'index' );
		$amp_featured_section = pixwell_get_option( 'amp_featured_section' );
		$amp_home_ppp         = pixwell_get_option( 'amp_home_ppp' );
		if ( ! empty( $amp_home_ppp ) ) {
			$pixwell_settings['posts_per_page'] = intval( $amp_home_ppp );
		}
		$pixwell_paged        = 1;

		if ( ! empty( get_query_var( 'paged' ) ) ) {
			$pixwell_paged = get_query_var( 'paged' );
		}

		$query_data = pixwell_query( array(
			'posts_per_page' => $pixwell_settings['posts_per_page'],
		), $pixwell_paged );

		if ( have_posts() ) :
			if ( ! empty( $amp_featured_section ) ) {
				$pixwell_settings['featured_section'] = 1;
				echo '<div class="amp-featured-outer rbc-container rb-p20-gutter">';
				pixwell_amp_featured_section( $query_data );
				echo '</div>';
			}

			$query_data->rewind_posts();
			pixwell_amp_render_blog( $pixwell_settings, $query_data );
		else :
			pixwell_render_section_empty_content();
		endif; ?>
	</div>
<?php get_footer();