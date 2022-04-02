<?php

if ( ! function_exists( 'pixwell_register_options_table_contents' ) ) {
	/**
	 * @return array
	 * table of contents
	 */
	function pixwell_register_options_table_contents() {
		return array(
			'title'  => esc_html__( 'Table of Contents', 'pixwell' ),
			'id'     => 'pixwell_config_section_table_contents',
			'desc'   => esc_html__( 'Choose settings for table of contents.', 'pixwell' ),
			'icon'   => 'el el-th-list',
			'fields' => array(
				array(
					'id'     => 'section_start_table_contents_ptype',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Post Type Settings', 'pixwell' ),
					'indent' => true
				),
				array(
					'id'       => 'table_contents_post',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support Single Post', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable the table of content for the single post.', 'pixwell' ),
					'default'  => 0
				),
				array(
					'id'       => 'table_contents_page',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support Single Page', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable the table of content for the single.', 'pixwell' ),
					'default'  => 0
				),
				array(
					'id'     => 'section_end_table_contents_ptype',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				array(
					'id'     => 'section_start_table_contents_heading',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Heading Tag Settings', 'pixwell' ),
					'indent' => true
				),
				array(
					'id'       => 'table_contents_h1',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support H1', 'pixwell' ),
					'subtitle' => esc_html__( 'Support H1 tag, Turn this option off if you would like to exclude H1 tag out of the table of contents.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'       => 'table_contents_h2',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support H2', 'pixwell' ),
					'subtitle' => esc_html__( 'Support H2 tag, Turn this option off if you would like to exclude H2 tag out of the table of contents.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'       => 'table_contents_h3',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support H3', 'pixwell' ),
					'subtitle' => esc_html__( 'Support H3 tag, Turn this option off if you would like to exclude H3 tag out of the table of contents.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'       => 'table_contents_h4',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support H4', 'pixwell' ),
					'subtitle' => esc_html__( 'Support H4 tag, Turn this option off if you would like to exclude H4 tag out of the table of contents.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'       => 'table_contents_h5',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support H5', 'pixwell' ),
					'subtitle' => esc_html__( 'Support H5 tag, Turn this option off if you would like to exclude H5 tag out of the table of contents.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'       => 'table_contents_h6',
					'type'     => 'switch',
					'title'    => esc_html__( 'Support H6', 'pixwell' ),
					'subtitle' => esc_html__( 'Support H6 tag, Turn this option off if you would like to exclude H6 tag out of the table of contents.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'     => 'section_end_table_contents_heading',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				array(
					'id'     => 'section_start_table_contents_layout',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Layout Settings', 'pixwell' ),
					'indent' => true
				),
				array(
					'id'       => 'table_contents_enable',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Enable When', 'pixwell' ),
					'subtitle' => esc_html__( 'Input a minimum value for total heading tags to show the table of contents box.', 'pixwell' ),
					'default'  => 2
				),
				array(
					'id'       => 'table_contents_heading',
					'type'     => 'text',
					'title'    => esc_html__( 'Table of Cotnents Heading', 'pixwell' ),
					'subtitle' => esc_html__( 'Input the heading for the table of contents box.', 'pixwell' ),
					'default'  => esc_html__( 'Contents', 'pixwell' )
				),
				array(
					'id'       => 'table_contents_position',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'type'     => 'text',
					'title'    => esc_html__( 'Display Position', 'pixwell' ),
					'subtitle' => esc_html__( 'Input a position (After x paragraph) to display the table of contents box.', 'pixwell' ),
					'default'  => 0
				),
				array(
					'id'       => 'table_contents_hierarchy',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show Hierarchy', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable hierarchy for the table of contents box.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'       => 'table_contents_scroll',
					'type'     => 'switch',
					'title'    => esc_html__( 'Smooth Scroll', 'pixwell' ),
					'subtitle' => esc_html__( 'Enable or disable smooth scroll effect to jumb to the anchor link.', 'pixwell' ),
					'default'  => 1
				),
				array(
					'id'     => 'section_end_table_contents_layout',
					'type'   => 'section',
					'class'  => 'ruby-section-end no-border',
					'indent' => false
				),
			)
		);
	}
}