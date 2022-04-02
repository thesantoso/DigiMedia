<?php
/** amp panel */
if ( ! function_exists( 'pixwell_register_options_amp' ) ) {
	function pixwell_register_options_amp() {
		if ( function_exists( 'amp_init' ) ) {
			return array(
				'id'     => 'pixwell_config_section_amp',
				'title'  => esc_html__( 'AMP Settings', 'pixwell' ),
				'desc'   => esc_html__( 'Select special options for AMP site, You can control other settings as background, text style, copyright text in Theme Options > Footer Settings.', 'pixwell' ),
				'icon'   => 'el el-road',
				'fields' => array(
					array(
						'id'     => 'section_start_amp_footer',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Footer Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_footer_logo',
						'type'     => 'media',
						'url'      => true,
						'preview'  => true,
						'title'    => esc_html__( 'AMP Footer Logo', 'pixwell' ),
						'subtitle' => esc_html__( 'Upload AMP footer logo, This setting will override default footer logo in Logo Settings > Footer Logo.', 'pixwell' ),
						'description' => esc_html__( 'INFORMATION NOTE: If you just imported a demo, please update this setting to an image that is stored on your website ASAP.', 'pixwell' ),
					),
					array(
						'id'       => 'amp_footer_logo_retina',
						'type'     => 'media',
						'url'      => true,
						'preview'  => true,
						'title'    => esc_html__( 'AMP Footer Logo Retina', 'pixwell' ),
						'subtitle' => esc_html__( 'Upload AMP footer logo, This setting will override default footer logo in Logo Settings > Footer Logo Retina.', 'pixwell' ),
						'description' => esc_html__( 'INFORMATION NOTE: If you just imported a demo, please update this setting to an image that is stored on your website ASAP.', 'pixwell' ),
					),
					array(
						'id'       => 'amp_footer_menu',
						'type'     => 'select',
						'data'     => 'menu',
						'title'    => esc_html__( 'AMP Footer Menu', 'pixwell' ),
						'subtitle' => esc_html__( 'Aside a menu for the AMP site footer.', 'pixwell' )
					),
					array(
						'id'       => 'amp_back_top',
						'type'     => 'switch',
						'title'    => esc_html__( 'Back to Top', 'pixwell' ),
						'subtitle' => esc_html__( 'Enable or disable the back to top button.', 'pixwell' ),
						'default'  => 0
					),
					array(
						'id'     => 'section_end_amp_footer',
						'type'   => 'section',
						'class'  => 'ruby-section-end',
						'indent' => false
					),
					array(
						'id'     => 'section_start_amp_single',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Single Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_disable_author',
						'type'     => 'switch',
						'title'    => esc_html__( 'Author Card', 'pixwell' ),
						'off'      => esc_html__( 'Default from Single Settings', 'pixwell' ),
						'on'       => esc_html__( 'Disable on AMP', 'pixwell' ),
						'subtitle' => esc_html__( 'Disable the Author Card on the AMP site.', 'pixwell' ),
						'default'  => 0
					),
					array(
						'id'       => 'amp_disable_single_pagination',
						'type'     => 'switch',
						'title'    => esc_html__( 'Next/Prev Articles', 'pixwell' ),
						'off'      => esc_html__( 'Default from Single Settings', 'pixwell' ),
						'on'       => esc_html__( 'Disable on AMP', 'pixwell' ),
						'subtitle' => esc_html__( 'Disable the Next/Prev Articles section on the AMP site.', 'pixwell' ),
						'default'  => 0
					),
					array(
						'id'       => 'amp_disable_comment',
						'type'     => 'switch',
						'title'    => esc_html__( 'Comment Box', 'pixwell' ),
						'off'      => esc_html__( 'Default', 'pixwell' ),
						'on'       => esc_html__( 'Disable on AMP', 'pixwell' ),
						'subtitle' => esc_html__( 'Disable comment form on AMP site.', 'pixwell' ),
						'default'  => 0
					),
					array(
						'id'       => 'amp_disable_related',
						'type'     => 'switch',
						'title'    => esc_html__( 'Related Section', 'pixwell' ),
						'off'      => esc_html__( 'Default from Single Settings', 'pixwell' ),
						'on'       => esc_html__( 'Disable on AMP', 'pixwell' ),
						'subtitle' => esc_html__( 'Disable the related section on the AMP site.', 'pixwell' ),
						'default'  => 0
					),
					array(
						'id'     => 'section_end_amp_single',
						'type'   => 'section',
						'class'  => 'ruby-section-end',
						'indent' => false
					),
					array(
						'id'     => 'section_start_amp_composer',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Ruby Composer Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_featured_section',
						'type'     => 'switch',
						'title'    => esc_html__( 'Featured Section on HomePage', 'pixwell' ),
						'subtitle' => esc_html__( 'Enable or disable the featured section in the page build with Ruby Composer on the AMP site.', 'pixwell' ),
						'default'  => 1
					),
					array(
						'id'       => 'amp_home_ppp',
						'type'     => 'text',
						'class'    => 'small-text',
						'validate' => 'numeric',
						'title'    => esc_html__( 'Posts per Page', 'pixwell' ),
						'subtitle' => esc_html__( 'Select total posts per page for the Ruby Composer on the AMP site. Leave blank if you would like set as the default.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'     => 'section_end_amp_composer',
						'type'   => 'section',
						'class'  => 'ruby-section-end',
						'indent' => false
					),
					/** header advert */
					array(
						'id'     => 'section_start_amp_header_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Header Ad Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_header_ad_type',
						'type'     => 'select',
						'title'    => esc_html__( 'Header - Ad Type', 'pixwell' ),
						'subtitle' => esc_html__( 'Select your ad type to display at the header.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Adsense --', 'pixwell' ),
							'2' => esc_html__( 'AMP Custom Script Ad', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_header_adsense_client',
						'type'     => 'text',
						'required' => array( 'amp_header_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Header - Data Ad Client', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-client number ID (without ca-pub-).', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_header_adsense_slot',
						'type'     => 'text',
						'required' => array( 'amp_header_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Header - Data Ad Slot', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-slot number ID.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_header_adsense_size',
						'type'     => 'select',
						'required' => array( 'amp_header_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Header - Adsense Size', 'pixwell' ),
						'subtitle' => esc_html__( 'Select a size for this ad.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Responsive --', 'pixwell' ),
							'2' => esc_html__( 'Fixed Height (90px)', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_header_ad_code',
						'type'     => 'textarea',
						'required' => array( 'amp_header_ad_type', '=', '2' ),
						'title'    => esc_html__( 'Header - AMP Custom Ad Script', 'pixwell' ),
						'subtitle' => esc_html__( 'Input your AMP custom ad script.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'     => 'section_end_amp_header_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-end',
						'indent' => false
					),
					/** footer advert */
					array(
						'id'     => 'section_start_amp_footer_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Footer Ad Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_footer_ad_type',
						'type'     => 'select',
						'title'    => esc_html__( 'Footer - Ad Type', 'pixwell' ),
						'subtitle' => esc_html__( 'Select your ad type to display at the footer.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Adsense --', 'pixwell' ),
							'2' => esc_html__( 'AMP Custom Script Ad', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_footer_adsense_client',
						'type'     => 'text',
						'required' => array( 'amp_footer_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Footer - Data Ad Client', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-client number ID (without ca-pub-).', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_footer_adsense_slot',
						'type'     => 'text',
						'required' => array( 'amp_footer_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Footer - Data Ad Slot', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-slot number ID.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_footer_adsense_size',
						'type'     => 'select',
						'required' => array( 'amp_footer_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Footer - Adsense Size', 'pixwell' ),
						'subtitle' => esc_html__( 'Select a size for this ad.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Responsive --', 'pixwell' ),
							'2' => esc_html__( 'Fixed Height (90px)', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_footer_ad_code',
						'type'     => 'textarea',
						'required' => array( 'amp_footer_ad_type', '=', '2' ),
						'title'    => esc_html__( 'Footer - AMP Custom Ad Script', 'pixwell' ),
						'subtitle' => esc_html__( 'Input your AMP custom ad script.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'     => 'section_end_amp_footer_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-end',
						'indent' => false
					),
					/** top article */
					array(
						'id'     => 'section_start_amp_top_single_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Top Single Content Ad Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_top_single_ad_type',
						'type'     => 'select',
						'title'    => esc_html__( 'Top - Ad Type', 'pixwell' ),
						'subtitle' => esc_html__( 'Select your ad type to display at the top single content.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Adsense --', 'pixwell' ),
							'2' => esc_html__( 'AMP Custom Script Ad', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_top_single_adsense_client',
						'type'     => 'text',
						'required' => array( 'amp_top_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Top - Data Ad Client', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-client number ID (without ca-pub-).', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_top_single_adsense_slot',
						'type'     => 'text',
						'required' => array( 'amp_top_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Top - Data Ad Slot', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-slot number ID.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_top_single_adsense_size',
						'type'     => 'select',
						'required' => array( 'amp_top_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Top - Adsense Size', 'pixwell' ),
						'subtitle' => esc_html__( 'Select a size for this ad.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Responsive --', 'pixwell' ),
							'2' => esc_html__( 'Fixed Height (90px)', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_top_single_ad_code',
						'type'     => 'textarea',
						'required' => array( 'amp_top_single_ad_type', '=', '2' ),
						'title'    => esc_html__( 'Top - AMP Custom Ad Script', 'pixwell' ),
						'subtitle' => esc_html__( 'Input your AMP custom ad script.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'     => 'section_end_amp_top_single_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-end',
						'indent' => false
					),
					/** bottom single */
					array(
						'id'     => 'section_start_amp_bottom_single_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Bottom Single Content Ad Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_bottom_single_ad_type',
						'type'     => 'select',
						'title'    => esc_html__( 'Bottom - Ad Type', 'pixwell' ),
						'subtitle' => esc_html__( 'Select your ad type to display at the bottom single content.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Adsense --', 'pixwell' ),
							'2' => esc_html__( 'AMP Custom Script Ad', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_bottom_single_adsense_client',
						'type'     => 'text',
						'required' => array( 'amp_bottom_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Bottom - Data Ad Client', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-client number ID (without ca-pub-).', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_bottom_single_adsense_slot',
						'type'     => 'text',
						'required' => array( 'amp_bottom_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Bottom - Data Ad Slot', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-slot number ID.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_bottom_single_adsense_size',
						'type'     => 'select',
						'required' => array( 'amp_bottom_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Bottom - Adsense Size', 'pixwell' ),
						'subtitle' => esc_html__( 'Select a size for this ad.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Responsive --', 'pixwell' ),
							'2' => esc_html__( 'Fixed Height (90px)', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_bottom_single_ad_code',
						'type'     => 'textarea',
						'required' => array( 'amp_bottom_single_ad_type', '=', '2' ),
						'title'    => esc_html__( 'Bottom - AMP Custom Ad Script', 'pixwell' ),
						'subtitle' => esc_html__( 'Input your AMP custom ad script.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'     => 'section_end_amp_bottom_single_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-end',
						'indent' => false
					),
					/** inline content */
					array(
						'id'     => 'section_start_amp_inline_single_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-start',
						'title'  => esc_html__( 'Inline Single Content Ad Settings', 'pixwell' ),
						'indent' => true
					),
					array(
						'id'       => 'amp_inline_single_ad_type',
						'type'     => 'select',
						'title'    => esc_html__( 'Inline - Ad Type', 'pixwell' ),
						'subtitle' => esc_html__( 'Select your ad type to display at the bottom single content.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Adsense --', 'pixwell' ),
							'2' => esc_html__( 'AMP Custom Script Ad', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_inline_single_adsense_client',
						'type'     => 'text',
						'required' => array( 'amp_inline_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Inline - Data Ad Client', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-client number ID (without ca-pub-).', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_inline_single_adsense_slot',
						'type'     => 'text',
						'required' => array( 'amp_inline_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Inline - Data Ad Slot', 'pixwell' ),
						'subtitle' => esc_html__( 'Input the data-ad-slot number ID.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_inline_single_adsense_size',
						'type'     => 'select',
						'required' => array( 'amp_inline_single_ad_type', '=', '1' ),
						'title'    => esc_html__( 'Inline - Adsense Size', 'pixwell' ),
						'subtitle' => esc_html__( 'Select a size for this ad.', 'pixwell' ),
						'options'  => array(
							'1' => esc_html__( '-- Responsive --', 'pixwell' ),
							'2' => esc_html__( 'Fixed Height (90px)', 'pixwell' ),
						),
						'default'  => 1
					),
					array(
						'id'       => 'amp_inline_single_ad_code',
						'type'     => 'textarea',
						'required' => array( 'amp_inline_single_ad_type', '=', '2' ),
						'title'    => esc_html__( 'Inline - AMP Custom Ad Script', 'pixwell' ),
						'subtitle' => esc_html__( 'Input your AMP custom ad script.', 'pixwell' ),
						'default'  => ''
					),
					array(
						'id'       => 'amp_inline_single_ad_pos',
						'type'     => 'text',
						'title'    => esc_html__( 'Inline - After Paragraph', 'pixwell' ),
						'subtitle' => esc_html__( 'display this ad after x paragraph. Default is 2', 'pixwell' ),
						'default'  => '2'
					),
					array(
						'id'     => 'section_end_amp_inline_single_advert',
						'type'   => 'section',
						'class'  => 'ruby-section-end no-border',
						'indent' => false
					),
				)
			);
		} else {
			return array(
				'id'     => 'pixwell_config_section_amp',
				'title'  => esc_html__( 'AMP Settings', 'pixwell' ),
				'desc'   => esc_html__( 'Select options for AMP settings.', 'pixwell' ),
				'icon'   => 'el el-road',
				'fields' => array(
					array(
						'id'    => 'amp_info_warning',
						'type'  => 'info',
						'title' => esc_html__( 'AMP Plugin is missing!', 'pixwell' ),
						'style' => 'warning',
						'desc'  => html_entity_decode( esc_html__( 'Accelerated Mobile Pages support, Please install <a target="_blank" href=\"https://wordpress.org/plugins/amp\">Automattic AMP</a> plugin to activate the features.', 'pixwell' ) ),
					),
				)
			);
		}
	}
}
