<?php
/**
 * Plugin Name:    Pixwell Deal
 * Plugin URI:     https://themeforest.net/user/theme-ruby/
 * Description:    Deal features (requires Pixwell Core), this is the plugin that manages deal (affiliate marketing) post type.
 * Version:        8.2
 * Text Domain:    pixwell-deal
 * Domain Path:    /languages/
 * Author:         Theme-Ruby
 * Author URI:     https://themeforest.net/user/theme-ruby/
 * @package        pixwell-deal
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RB_DEAL_VERSION', '8.2' );
define( 'RB_DEAL_URL', plugin_dir_url( __FILE__ ) );
define( 'RB_DEAL_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'rb_deal_core' ) ) {
	class rb_deal_core {

		protected static $instance = null;

		static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		function __construct() {

			if ( function_exists( 'rb_get_meta' ) ) {
				do_action( 'rb_deal_init' );
				$this->init_components();
			}
		}

		private function init_components() {

			include_once RB_DEAL_PATH . 'core.php';
			include_once RB_DEAL_PATH . 'parts.php';

			add_action( 'init', array( $this, 'register_deal' ), 2 );
			add_filter( 'rb_meta_boxes', array( $this, 'register_metaboxes' ) );

			add_shortcode( 'rb_deals', 'rb_deal_render_listing' );
		}

		public function register_metaboxes( $rb_meta = array() ) {
			$rb_meta[] = array(
				'id'         => 'rb_deal_options',
				'title'      => esc_html__( 'Deal Options', 'pixwell-deal' ),
				'context'    => 'normal',
				'post_types' => array( 'rb-deal' ),
				'fields'     => array(
					array(
						'id'          => 'rb_deal_link',
						'name'        => esc_html__( 'Deal Affiliate Link', 'pixwell-deal' ),
						'desc'        => esc_html__( 'Input the affiliate link for this deal. This is required information, The deal could not display if missing this information.', 'pixwell-deal' ),
						'type'        => 'textarea',
						'placeholder' => esc_html__( 'https://affiliate-website.com/product', 'pixwell-deal' ),
						'default'     => ''
					),
					array(
						'id'      => 'rb_deal_link_label',
						'name'    => esc_html__( 'Deal Affiliate Link Text', 'pixwell-deal' ),
						'desc'    => esc_html__( 'Input the text for this deal link.', 'pixwell-deal' ),
						'type'    => 'text',
						'default' => ''
					),
					array(
						'id'      => 'rb_deal_start',
						'name'    => esc_html__( 'Start Date', 'pixwell-deal' ),
						'desc'    => esc_html__( 'Set start date for this deal.', 'pixwell-deal' ),
						'type'    => 'datetime',
						'key'     => 'rb_deal_start',
						'kvd'     => 0,
						'default' => ''
					),
					array(
						'id'      => 'rb_deal_end',
						'name'    => esc_html__( 'Expire Date', 'pixwell-deal' ),
						'desc'    => esc_html__( 'Set expire date for this deal, Leave blank the date input for unlimited last.', 'pixwell-deal' ),
						'type'    => 'datetime',
						'key'     => 'rb_deal_end',
						'kvd'     => 99999999999,
						'default' => ''
					),
					array(
						'id'      => 'rb_deal_card',
						'name'    => esc_html__( 'Deal Card Text', 'pixwell-deal' ),
						'desc'    => esc_html__( 'Input intro text to show on this featured image.', 'pixwell-deal' ),
						'type'    => 'text',
						'default' => ''
					),
					array(
						'id'      => 'rb_deal_coupon',
						'name'    => esc_html__( 'Deal Coupon Text', 'pixwell-deal' ),
						'desc'    => esc_html__( 'Input a coupon to show on this featured image.', 'pixwell-deal' ),
						'type'    => 'text',
						'default' => ''
					)
				),
			);

			return $rb_meta;
		}

		/** register deal post type */
		public function register_deal() {

			$slug     = apply_filters( 'rb_deal_slug', esc_html__( 'deal', 'pixwell-deal' ) );
			$cat_slug = apply_filters( 'rb_deal_cat_slug', esc_html__( 'deal-category', 'pixwell-deal' ) );

			$slug = array(
				'slug'       => $slug,
				'with_front' => false
			);
			register_post_type( 'rb-deal', array(
				'labels'          => array(
					'name'               => esc_html__( 'Deals', 'pixwell-deal' ),
					'all_items'          => esc_html__( 'All Deals', 'pixwell-deal' ),
					'add_new'            => esc_html__( 'Add New Deal', 'pixwell-deal' ),
					'menu_name'          => esc_html__( 'Deals', 'pixwell-deal' ),
					'singular_name'      => esc_html__( 'Deal', 'pixwell-deal' ),
					'add_item'           => esc_html__( 'New Deal', 'pixwell-deal' ),
					'add_new_item'       => esc_html__( 'Add New Deal', 'pixwell-deal' ),
					'edit_item'          => esc_html__( 'Edit Deal', 'pixwell-deal' ),
					'not_found'          => esc_html__( 'No deal item found.', 'pixwell-deal' ),
					'not_found_in_trash' => esc_html__( 'No deal item found in Trash.', 'pixwell-deal' ),
					'parent_item_colon'  => ''
				),
				'public'          => true,
				'has_archive'     => true,
				'can_export'      => true,
				'rewrite'         => $slug,
				'capability_type' => 'post',
				'menu_position'   => 4,
				'show_ui'         => true,
				'menu_icon'       => 'dashicons-megaphone',
				'supports'        => array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'page-attributes'
				),
				'taxonomies'      => array( 'deal-category' ),
			) );

			$labels = array(
				'name'              => esc_html__( 'Deal Categories', 'pixwell-deal' ),
				'menu_name'         => esc_html__( 'Deal Categories', 'pixwell-deal' ),
				'singular_name'     => esc_html__( 'Category', 'pixwell-deal' ),
				'search_items'      => esc_html__( 'Search Categories', 'pixwell-deal' ),
				'all_items'         => esc_html__( 'All Categories', 'pixwell-deal' ),
				'parent_item'       => esc_html__( 'Parent Category', 'pixwell-deal' ),
				'parent_item_colon' => esc_html__( 'Parent Category:', 'pixwell-deal' ),
				'edit_item'         => esc_html__( 'Edit Category', 'pixwell-deal' ),
				'update_item'       => esc_html__( 'Update Category', 'pixwell-deal' ),
				'add_new_item'      => esc_html__( 'Add New Category', 'pixwell-deal' ),
				'new_item_name'     => esc_html__( 'New Category Name', 'pixwell-deal' )
			);

			register_taxonomy( 'deal-category', array( 'rb-deal' ), array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'query_var'         => true,
				'show_admin_column' => true,
				'rewrite'           => array( 'slug' => $cat_slug )
			) );

			flush_rewrite_rules();
		}
	}
}

/** LOAD */
rb_deal_core::get_instance();