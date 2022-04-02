<?php
namespace PixwellElementorElement\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Fw_Feat_17 extends Widget_Base {

	public function get_name() {
		return 'fw-feat-17';
	}

	public function get_title() {
		return esc_html__( 'Pixwell - Marketing Grid (Wrapper)', 'pixwell-core' );
	}

	public function get_icon() {
		return 'eicon-posts-group';
	}

	public function get_categories() {
		return array( 'pixwell-fw' );
	}

	protected function _register_controls() {

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

		$this->add_control(
			'sub_title',
			array(
				'label'       => esc_html__( 'Sub Title', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Input the sub section tile, Leave blank if you want to it.', 'pixwell-core' ),
				'default'     => esc_html__( 'Popular News', 'pixwell-core' ),
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
			'query_filters', array(
				'label' => esc_html__( 'Query Filters', 'pixwell-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'category',
			array(
				'label'       => esc_html__( 'Category Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Select category filter for this block.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::cat_dropdown(),
				'default'     => '0',
			)
		);
		$this->add_control(
			'categories',
			array(
				'label'       => esc_html__( 'Categories Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Filter posts by multiple category IDs, separated category IDs by commas (for example: 1,2,3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'tags',
			array(
				'label'       => esc_html__( 'Tags Slug Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Filter posts by tags slug, separated by commas (for example: tagslug1,tagslug2,tagslug3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'tag_not_in',
			array(
				'label'       => esc_html__( 'Exclude Tags Slug', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude some tags slug from this block, separated by commas (for example: tagslug1,tagslug2,tagslug3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'format',
			array(
				'label'       => esc_html__( 'Post Format', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Filter posts by post format.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::format_dropdown(),
				'default'     => '0',
			)
		);
		$this->add_control(
			'author',
			array(
				'label'       => esc_html__( 'Author Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Filter posts by the author.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::author_dropdown(),
				'default'     => '0',
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
			'order',
			array(
				'label'       => esc_html__( 'Sort Order', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Select sort order type for this block.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::order_dropdown(),
				'default'     => 'date_post',
			)
		);
		$this->add_control(
			'offset',
			array(
				'label'       => esc_html__( 'Post Offset', 'pixwell-core' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Select number of posts to pass over. Leave blank or set 0 if you want to show at the beginning.', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->end_controls_section();

		/** sub section */
		$this->start_controls_section(
			'sub_query_filters', array(
				'label' => esc_html__( 'Sub Section Query Filters', 'pixwell-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'sub_category',
			array(
				'label'       => esc_html__( 'Category Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Select category filter for this block.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::cat_dropdown(),
				'default'     => '0',
			)
		);
		$this->add_control(
			'categories_sub',
			array(
				'label'       => esc_html__( 'Categories Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Filter posts by multiple category IDs, separated category IDs by commas (for example: 1,2,3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'sub_tags',
			array(
				'label'       => esc_html__( 'Tags Slug Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Filter posts by tags slug, separated by commas (for example: tagslug1,tagslug2,tagslug3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'sub_tag_not_in',
			array(
				'label'       => esc_html__( 'Exclude Tags Slug', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude some tags slug from this block, separated by commas (for example: tagslug1,tagslug2,tagslug3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'sub_format',
			array(
				'label'       => esc_html__( 'Post Format', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Filter posts by post format.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::format_dropdown(),
				'default'     => '0',
			)
		);
		$this->add_control(
			'sub_author',
			array(
				'label'       => esc_html__( 'Author Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Filter posts by the author.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::author_dropdown(),
				'default'     => '0',
			)
		);

		$this->add_control(
			'sub_post_not_in',
			array(
				'label'       => esc_html__( 'Exclude Post IDs', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude some post IDs from this block, separated by commas (for example: 1,2,3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'sub_post_in',
			array(
				'label'       => esc_html__( 'Post IDs Filter', 'pixwell-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Filter posts by post IDs. separated by commas (for example: 1,2,3).', 'pixwell-core' ),
				'default'     => '',
			)
		);
		$this->add_control(
			'sub_order',
			array(
				'label'       => esc_html__( 'Sort Order', 'pixwell-core' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Select sort order type for this block.', 'pixwell-core' ),
				'options'     => \PixwellElementorControl\Options::order_dropdown(),
				'default'     => 'date_post',
			)
		);
		$this->add_control(
			'sub_offset',
			array(
				'label'       => esc_html__( 'Post Offset', 'pixwell-core' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Select number of posts to pass over. Leave blank or set 0 if you want to show at the beginning.', 'pixwell-core' ),
				'default'     => '',
			)
		);


		/**** test */
		$this->add_control(
			'posts_per_page',
			array(
				'label'       => esc_html__( 'Posts per Page', 'pixwell-core' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Select number of posts per page (total posts to show). Maximum value is 6.', 'pixwell-core' ),
				'default'     => '5'
			)
		);
		$this->end_controls_section();
	}

	/** render */
	protected function render() {
		if ( function_exists( 'pixwell_rbc_fw_feat_17' ) ) {
			$settings         = $this->get_settings();
			$settings['uuid'] = 'uid_' . $this->get_id();
			echo \pixwell_rbc_fw_feat_17( $settings );
		}
	}
}
