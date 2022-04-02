<?php
namespace PixwellElementorElement\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Fw_Portfolio_1 extends Widget_Base {

    public function get_name() {
        return 'fw-portfolio-1';
    }

    public function get_title() {
        return esc_html__( 'Portfolio List', 'pixwell-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'pixwell-fw' );
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'query_filters', array(
                'label' => esc_html__( 'Query Filters', 'pixwell-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'post_not_in',
            array(
                'label'       => esc_html__( 'Exclude Post IDs', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Exclude some post IDs from this block, separated by commas (for example: 1,2,3).', 'pixwell-core' ),
                'default'     => '',
            )
        );
        $this->add_control(
            'post_in',
            array(
                'label'       => esc_html__( 'Post IDs Filter', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Filter posts by post IDs. separated by commas (for example: 1,2,3).', 'pixwell-core' ),
                'default'     => '',
            )
        );
        $this->add_control(
            'posts_per_page',
            array(
                'label'       => esc_html__( 'Posts per Page', 'pixwell-core' ),
                'type'        => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Select number of posts per page (total posts to show). Maximum value is 6.', 'pixwell-core' ),
                'default'     => '10'
            )
        );
        $this->add_control(
            'term_filter',
            array(
                'label'       => esc_html__( 'Show Categories Filter', 'pixwell-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Enable or disable categories filter at the block header.', 'pixwell-core' ),
                'default'     => 'yes',
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
                'default'     => '',
            )
        );
        $this->add_control(
            'html_description',
            array(
                'label'       => esc_html__( 'Block Description', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'description' => esc_html__( 'Input the block description, allow Raw HTML.', 'pixwell-core' ),
                'default'     => '',
            )
        );

        $this->add_control(
            'viewmore_link',
            array(
                'label'       => esc_html__( 'View More URL', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input the block destination link, Leave blank if you want to disable clickable on the block header.', 'pixwell-core' ),
                'default'     => '',
            )
        );

        $this->add_control(
            'viewmore_title',
            array(
                'label'       => esc_html__( 'View More Label', 'pixwell-core' ),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__( 'Input the block header tagline, this is description display below the block title.', 'pixwell-core' ),
                'default'     => '',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style', array(
                'label' => esc_html__( 'Style', 'pixwell-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'text_style',
            array(
                'label'       => esc_html__( 'Text Style', 'pixwell-core' ),
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Select block text style, Select light if you have a dark background.', 'pixwell-core' ),
                'options'     => \PixwellElementorControl\Options::textstyle_dropdown(),
                'default'     => '0',
            )
        );

        $this->end_controls_section();
    }

    /** render */
    protected function render() {
        if ( function_exists( 'pixwell_rbc_fw_portfolio_1' ) ) {
            $settings         = $this->get_settings();
            $settings['uuid'] = 'uid_' . $this->get_id();
            echo \pixwell_rbc_fw_portfolio_1( $settings );
        }
    }
}
