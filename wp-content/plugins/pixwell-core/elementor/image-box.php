<?php
namespace PixwellElementorElement\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class Fw_Image_Box extends Widget_Base {

    public function get_name() {
        return 'image_box';
    }

    public function get_title() {
        return esc_html__( 'Images Box', 'pixwell-core' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return array( 'pixwell-fw' );
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'query_filters', array(
                'label' => esc_html__( 'Content', 'pixwell-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'c1_image',
            array(
                'label'       => esc_html__( 'Column 1 - Image', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input image attachment URL for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c1_title',
            array(
                'label'       => esc_html__( 'Column 1 - Title', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a title for column for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c1_link',
            array(
                'label'       => esc_html__( 'Column 1 - Link', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a destination link for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c1_btn',
            array(
                'label'       => esc_html__( 'Column 1 - Button Text', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a button text for this column', 'pixwell-core' ),
                'default'     => 'Learn More'
            )
        );
        $this->add_control(
            'html_c1_desc',
            array(
                'label'       => esc_html__( 'Column 1 - Description', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'description' => esc_html__( 'Input description (allow raw HTML) for for this column.', 'pixwell-core' ),
                'default'     => '',
            )
        );
        $this->add_control(
            'c2_image',
            array(
                'label'       => esc_html__( 'Column 2 - Image', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input image attachment URL for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c2_title',
            array(
                'label'       => esc_html__( 'Column 2 - Title', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a title for column for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c2_link',
            array(
                'label'       => esc_html__( 'Column 2 - Link', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a destination link for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c2_btn',
            array(
                'label'       => esc_html__( 'Column 2 - Button Text', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a button text for this column', 'pixwell-core' ),
                'default'     => 'Learn More'
            )
        );
        $this->add_control(
            'html_c2_desc',
            array(
                'label'       => esc_html__( 'Column 2 - Description', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'description' => esc_html__( 'Input description (allow raw HTML) for for this column.', 'pixwell-core' ),
                'default'     => '',
            )
        );
        $this->add_control(
            'c3_image',
            array(
                'label'       => esc_html__( 'Column 3 - Image', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input image attachment URL for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c3_title',
            array(
                'label'       => esc_html__( 'Column 3 - Title', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a title for column for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c3_link',
            array(
                'label'       => esc_html__( 'Column 3 - Link', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a destination link for this column.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->add_control(
            'c3_btn',
            array(
                'label'       => esc_html__( 'Column 3 - Button Text', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input a button text for this column', 'pixwell-core' ),
                'default'     => 'Learn More'
            )
        );
        $this->add_control(
            'html_c3_desc',
            array(
                'label'       => esc_html__( 'Column 3 - Description', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'description' => esc_html__( 'Input description (allow raw HTML) for for this column.', 'pixwell-core' ),
                'default'     => '',
            )
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title', array(
                'label' => esc_html__( 'Block Header', 'pixwell-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Block Title', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input block title, Leave blank if you want to disable block header.', 'pixwell-core' ),
                'default'     => ''
            )
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style', array(
                'label' => esc_html__( 'Layouts', 'pixwell-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'content_align',
            array(
                'label'       => esc_html__( 'Content Align', 'pixwell-core' ),
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Select content align for this block.', 'pixwell-core' ),
                'options'     => \PixwellElementorControl\Options::img_content_dropdown(),
                'default'     => '0'
            )
        );
        $this->add_control(
            'image_width',
            array(
                'label'       => esc_html__( 'Image Width', 'pixwell-core' ),
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Select image width for this block.', 'pixwell-core' ),
                'options'     => \PixwellElementorControl\Options::image_width_dropdown(),
                'default'     => '0'
            )
        );
        $this->add_control(
            'target',
            array(
                'label'       => esc_html__( 'Link Target', 'pixwell-core' ),
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Select target type for links in this block.', 'pixwell-core' ),
                'options'     => \PixwellElementorControl\Options::target_dropdown(),
                'default'     => '0'
            )
        );
        $this->add_control(
            'text_style',
            array(
                'label'       => esc_html__( 'Text Style', 'pixwell-core' ),
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Select block text style, Select light if you have a dark background.', 'pixwell-core' ),
                'options'     => \PixwellElementorControl\Options::textstyle_dropdown(),
                'default'     => '0'
            )
        );
        $this->end_controls_section();

    }

    /** render */
    protected function render() {
        if ( function_exists( 'pixwell_rbc_image_box' ) ) {
            $settings         = $this->get_settings();
            $settings['uuid'] = 'uid_' . $this->get_id();
            $settings['elementor_block'] = '1';
            echo \pixwell_rbc_image_box( $settings );
        }
    }
}
