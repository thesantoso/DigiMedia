<?php
/**
 * @return array
 * dark mode settings
 */
if ( ! function_exists( 'pixwell_register_options_dark_mode' ) ) {
	function pixwell_register_options_dark_mode() {
		return array(
			'id'     => 'pixwell_config_section_dark_mode',
			'title'  => esc_html__( 'Dark Mode Settings', 'pixwell' ),
			'desc'   => esc_html__( 'Select settings for the dark mode.', 'pixwell' ),
			'icon'   => 'el el-adjust',
			'fields' => array(
				array(
					'id'     => 'section_start_dark_mode_general',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'General Settings', 'pixwell' ),
					'indent' => true
				),
				array(
					'id'       => 'dark_mode',
					'title'    => esc_html__( 'Dark Mode Switch', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable the dark mode switch on the header.', 'pixwell' ),
					'type'     => 'switch',
					'default'  => 0,
				),
				array(
					'id'       => 'dark_mode_default',
					'title'    => esc_html__( 'Default Dark Mode', 'pixwell' ),
					'subtitle' => esc_html__( 'Set the dark mode as the default color scheme when users visit your site a the first time.', 'pixwell' ),
					'type'     => 'switch',
					'default'  => 0,
				),
				array(
					'id'     => 'section_end_dark_mode_general',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				array(
					'id'     => 'section_start_site_logo_dark',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Dark Mode Logos', 'pixwell' ),
					'indent' => true
				),
				array(
					'id'       => 'site_logo_dark',
					'type'     => 'media',
					'url'      => true,
					'preview'  => true,
					'title'    => esc_html__( 'Main Site (Header)', 'pixwell' ),
					'subtitle' => esc_html__( 'Select or upload site logo for the dark mode. Recommended logo height value is 60px, allowed extensions are .jpg, .png and .gif.', 'pixwell' ),
				),
				array(
					'id'       => 'retina_site_logo_dark',
					'type'     => 'media',
					'url'      => true,
					'preview'  => true,
					'title'    => esc_html__( 'Main Site (Header) Retina', 'pixwell' ),
					'subtitle' => esc_html__( 'Select or upload retina (2x) logo for the dark mode. Recommended logo height value is 120px, allowed extensions are .jpg, .png and .gif', 'pixwell' )
				),

				array(
					'id'       => 'sticky_logo_dark',
					'type'     => 'media',
					'url'      => true,
					'preview'  => true,
					'title'    => esc_html__( 'Sticky Logo ', 'pixwell' ),
					'subtitle' => esc_html__( 'Upload a sticky logo for the dark mode. Recommended logo height value is 60px.', 'pixwell' )
				),
				array(
					'id'       => 'retina_sticky_logo_dark',
					'type'     => 'media',
					'url'      => true,
					'preview'  => true,
					'title'    => esc_html__( 'Sticky Retina Logo', 'pixwell' ),
					'subtitle' => esc_html__( 'Upload a retina (2x) sticky logo for the dark mode. Recommended logo height value is 120px.', 'pixwell' )
				),
				array(
					'id'       => 'mobile_logo_dark',
					'type'     => 'media',
					'url'      => true,
					'preview'  => true,
					'title'    => esc_html__( 'Mobile Header Logo', 'pixwell' ),
					'subtitle' => esc_html__( 'Upload a mobile logo for the dark mode. Recommended logo height value is 120px, allowed extensions are .jpg, .png and .gif', 'pixwell' )
				),
				array(
					'id'     => 'section_end_site_logo_dark',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),

				array(
					'id'     => 'section_start_logo_footer_dark',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Footer Logos', 'pixwell' ),
					'indent' => true
				),
				array(
					'id'       => 'footer_logo_dark',
					'type'     => 'media',
					'url'      => true,
					'preview'  => true,
					'title'    => esc_html__( 'Footer Logo', 'pixwell' ),
					'subtitle' => esc_html__( 'Select or upload the footer logo for the dark mode.', 'pixwell' )
				),
				array(
					'id'       => 'footer_logo_retina_dark',
					'type'     => 'media',
					'url'      => true,
					'preview'  => true,
					'title'    => esc_html__( 'Footer Retina Logo', 'pixwell' ),
					'subtitle' => esc_html__( 'Upload a retina (2x) footer logo for the dark mode.', 'pixwell' )
				),
				array(
					'id'     => 'section_end_logo_footer_dark',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
                array(
                    'id'     => 'section_start_header_navbar_color_dark',
                    'type'   => 'section',
                    'class'  => 'ruby-section-start',
                    'title'  => esc_html__( 'Main Menu Background & Text', 'pixwell' ),
                    'indent' => true
                ),
                array(
                    'id'          => 'navbar_bg_dark',
                    'type'        => 'color_gradient',
                    'title'       => esc_html__( 'Main Menu Bar Background', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select background color for the main menu (navigation) bar for the dark mode', 'pixwell' ),
                    'validate'    => 'color',
                    'transparent' => false,
                    'default'     => array(
                        'from' => '',
                        'to'   => '',
                    ),
                ),
                array(
                    'id'          => 'navbar_color_dark',
                    'title'       => esc_html__( 'Menu - Text Color', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select a color value for main navigation text for the dark mode.', 'pixwell' ),
                    'type'        => 'color',
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'          => 'navbar_color_hover_dark',
                    'title'       => esc_html__( 'Menu - Hover Color', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select a color when hovering on main navigation text for the dark mode.', 'pixwell' ),
                    'type'        => 'color',
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'          => 'navsub_bg_dark',
                    'type'        => 'color_gradient',
                    'title'       => esc_html__( 'Main Sub Menu Background', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select background color for the sub-items for the dark mode', 'pixwell' ),
                    'validate'    => 'color',
                    'transparent' => false,
                    'default'     => array(
                        'from' => '',
                        'to'   => '',
                    ),
                ),
                array(
                    'id'          => 'navsub_color_dark',
                    'title'       => esc_html__( 'Sub Menu Text Color', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select a color value for submenu text for the dark mode.', 'pixwell' ),
                    'type'        => 'color',
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'          => 'navsub_color_hover_dark',
                    'title'       => esc_html__( 'Sub Menu Text Hover Color', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select text color when hovering on sub-menu text for the dark mode.', 'pixwell' ),
                    'type'        => 'color',
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'     => 'section_end_header_navbar_color_dark',
                    'type'   => 'section',
                    'class'  => 'ruby-section-end',
                    'indent' => false
                ),
                array(
                    'id'     => 'section_start_global_color_dark',
                    'type'   => 'section',
                    'class'  => 'ruby-section-start',
                    'title'  => esc_html__( 'Global Settings', 'pixwell' ),
                    'indent' => true
                ),
                array(
                    'id'          => 'global_color_dark',
                    'title'       => esc_html__( 'Global Color', 'pixwell' ),
                    'subtitle'    => esc_html__( 'select global color, It will be used for all links, menu, category overlays, main page and many contrasting elements for the dark mode.', 'pixwell' ),
                    'type'        => 'color',
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'          => 'hyperlink_color_dark',
                    'title'       => esc_html__( 'Hyperlink Color', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select a color value for the hyperlink, this option will override on default theme color for the dark mode.', 'pixwell' ),
                    'type'        => 'color',
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'          => 'review_color_dark',
                    'title'       => esc_html__( 'Review Icon Color', 'pixwell' ),
                    'subtitle'    => esc_html__( 'Select a color value for the review icon for the dark mode.', 'pixwell' ),
                    'type'        => 'color',
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'     => 'section_end_global_color_dark',
                    'type'   => 'section',
                    'class'  => 'ruby-section-end no-border',
                    'indent' => false
                )
			)
		);
	}
}
