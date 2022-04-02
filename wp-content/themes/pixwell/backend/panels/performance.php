<?php
if ( ! function_exists( 'pixwell_register_options_performance' ) ) {
	/**
	 * @return array
	 */
	function pixwell_register_options_performance() {
		return array(
			'id'     => 'pixwell_config_section_performance',
			'title'  => esc_html__( 'Performance', 'pixwell' ),
			'desc'   => esc_html__( 'Select options to optimize your website speed.', 'pixwell' ),
			'icon'   => 'el el-dashboard',
			'fields' => array(
				array(
					'id'    => 'performance_info',
					'type'  => 'info',
					'title' => sprintf( esc_html__( 'We recommend you to refer this <a target="_blank" href="%s">DOCUMENTATION</a> to optimize for you website', 'pixwell' ), 'https://help.themeruby.com/pixwell/optimizing-your-site-speed-and-google-pagespeed-insights/' ),
					'style' => 'success',
				),
				array(
					'id'       => 'disable_srcset',
					'type'     => 'switch',
					'title'    => esc_html__( 'Disable Srcset', 'pixwell' ),
					'subtitle' => esc_html__( 'Disable Srcset to optimize page speed score on mobile device.', 'pixwell' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'lazy_load',
					'type'     => 'switch',
					'title'    => esc_html__( 'Lazy Load Featured Image', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable the lazy load for the featured image.', 'pixwell' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'disable_dashicons',
					'type'     => 'switch',
					'title'    => esc_html__( 'Disable Dashicons', 'pixwell' ),
					'subtitle' => esc_html__( 'Some 3rd party plugins will load this font icon. Disable it if you have not plan to use it.', 'pixwell' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'disable_block_style',
					'type'     => 'switch',
					'title'    => esc_html__( 'Disable Gutenberg Style on Page Builder', 'pixwell' ),
					'subtitle' => esc_html__( 'Disable the block style css on the page built with Ruby Composer or Elementor.', 'pixwell' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'disable_polyfill',
					'type'     => 'switch',
					'title'    => esc_html__( 'Disable Polyfill Script', 'pixwell' ),
					'subtitle' => esc_html__( 'Disable wp-polyfill script (supporting older browsers that do not understand ES6) to improve the page speed score.', 'pixwell' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'preload_gfonts',
					'type'     => 'switch',
					'title'    => esc_html__( 'Preload Google Fonts', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable preload Google fonts to increase the site speed score.', 'pixwell' ),
					'default'  => 1,
				),
				array(
					'id'       => 'preload_icon',
					'type'     => 'switch',
					'title'    => esc_html__( 'Preload Font Icon', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable preload font icons to increase the site speed score.', 'pixwell' ),
					'default'  => 1,
				),
				array(
					'id'       => 'css_file',
					'type'     => 'switch',
					'title'    => esc_html__( 'Force write Dynamic CSS to file', 'pixwell' ),
					'subtitle' => esc_html__( 'Write CSS to file to reduce CPU usage and reduce the load time.', 'pixwell' ),
					'desc'     => esc_html__( 'The dynamic file CSS may not apply immediately on some servers due to the server cache.', 'pixwell' ),
					'default'  => 0,
				),
				array(
					'id'       => 'disable_default_style',
					'type'     => 'switch',
					'title'    => esc_html__( 'Disable Default Stylesheet', 'pixwell' ),
					'subtitle' => esc_html__( 'Disable default stylesheet style.css file, The theme information will be hidden in the HTML code.', 'pixwell' ),
					'switch'   => true,
					'default'  => 1
				),
			)
		);
	}
}