<?php
namespace PixwellElementorControl;

class Options {
	static function cat_dropdown( $post_type = 'post' ) {

		$data       = array(
			0 => esc_html__( '-- All categories --', 'pixwell-core' ),
		);
		$categories = get_categories( array(
			'hide_empty' => 0,
			'type'       => $post_type,
		) );

		$array_walker = new CatWalker;
		$array_walker->walk( $categories, 4 );
		$buffer = $array_walker->cat_array;
		foreach ( $buffer as $name => $id ) {
			$data[ $id ] = $name;
		}

		return $data;
	}

    static function fw_cat_dropdown( $post_type = 'post' ) {

        $data       = array();
        $categories = get_categories( array(
            'hide_empty' => 0,
            'type'       => $post_type,
        ) );

        $array_walker = new CatWalker;
        $array_walker->walk( $categories, 4 );
        $buffer = $array_walker->cat_array;
        foreach ( $buffer as $name => $id ) {
            $data[ $id ] = $name;
        }

        return $data;
    }

	static function format_dropdown() {
		return array(
			'0'       => esc_html__( '-- All --', 'pixwell-core' ),
			'default' => esc_html__( 'Default', 'pixwell-core' ),
			'gallery' => esc_html__( 'Gallery', 'pixwell-core' ),
			'video'   => esc_html__( 'Video', 'pixwell-core' ),
			'audio'   => esc_html__( 'Audio', 'pixwell-core' )
		);
	}

	static function author_dropdown() {

		$blogusers = get_users( array(
			'role__not_in' => array( 'subscriber' ),
			'fields'       => array( 'ID', 'display_name' )
		) );

		$dropdown = array(
			'0' => esc_html__( '--All Authors--' )
		);

		if ( is_array( $blogusers ) ) {
			foreach ( $blogusers as $user ):
				$dropdown[ esc_attr( $user->ID ) ] = esc_attr( $user->display_name );
			endforeach;
		}

		return $dropdown;
	}

	static function order_dropdown() {
		return array(
			'date_post'               => esc_html__( 'Latest Post', 'pixwell-core' ),
			'update'                  => esc_html__( 'Last Updated', 'pixwell-core' ),
			'comment_count'           => esc_html__( 'Popular Comment', 'pixwell-core' ),
			'popular'                 => esc_html__( 'Popular (Require Post Views Plugin)', 'pixwell-core' ),
			'popular_m'               => esc_html__( 'Popular Last 30 Days (Require Post Views Plugin)', 'pixwell-core' ),
			'popular_w'               => esc_html__( 'Popular Last 7 Days (Require Post Views Plugin)', 'pixwell-core' ),
			'top_review'              => esc_html__( 'Top Review', 'pixwell-core' ),
			'last_review'             => esc_html__( 'Latest Review', 'pixwell-core' ),
			'post_type'               => esc_html__( 'Post Type', 'pixwell-core' ),
			'rand'                    => esc_html__( 'Random', 'pixwell-core' ),
			'author'                  => esc_html__( 'Author', 'pixwell-core' ),
			'alphabetical_order_decs' => esc_html__( 'Title DECS', 'pixwell-core' ),
			'alphabetical_order_asc'  => esc_html__( 'Title ACS', 'pixwell-core' ),
			'by_input'                => esc_html__( 'by input IDs Data (Work with Post IDs filter)', 'pixwell-core' )
		);
	}

	static function filter_dropdown() {
		return array(
			'0'        => esc_html__( '-Disable-', 'pixwell-core' ),
			'category' => esc_html__( 'by Categories', 'pixwell-core' ),
			'tag'      => esc_html__( 'by Tags', 'pixwell-core' )
		);
	}


    /**
     * @param bool $default
     *
     * @return array|string[]
     */
    static function heading_html_dropdown( $default = true ) {
        $settings = array(
            '0'    => esc_html__( '- Default -', 'foxiz-core' ),
            'h1'   => esc_html__( 'H1', 'foxiz-core' ),
            'h2'   => esc_html__( 'H2', 'foxiz-core' ),
            'h3'   => esc_html__( 'H3', 'foxiz-core' ),
            'h4'   => esc_html__( 'H4', 'foxiz-core' ),
            'h5'   => esc_html__( 'H5', 'foxiz-core' ),
            'h6'   => esc_html__( 'H6', 'foxiz-core' ),
            'p'    => esc_html__( 'p tag', 'foxiz-core' ),
            'span' => esc_html__( 'span', 'foxiz-core' )
        );

        if ( ! $default ) {
            unset( $settings['0'] );
        }

        return $settings;
    }

	static function pagination_dropdown() {
		return array(
			'0'               => esc_html__( '-Disable-', 'pixwell-core' ),
			'next_prev'       => esc_html__( 'Next Prev', 'pixwell-core' ),
			'loadmore'        => esc_html__( 'Load More', 'pixwell-core' ),
			'infinite_scroll' => esc_html__( 'infinite Scroll', 'pixwell-core' )
		);
	}

	static function pagination_dropdown_append() {
		return array(
			'0'               => esc_html__( '-Disable-', 'pixwell-core' ),
			'loadmore'        => esc_html__( 'Load More', 'pixwell-core' ),
			'infinite_scroll' => esc_html__( 'infinite Scroll', 'pixwell-core' )
		);
	}

	static function textstyle_dropdown() {
		return array(
			'0'     => esc_html__( '-Dark-', 'pixwell-core' ),
			'light' => esc_html__( 'Light', 'pixwell-core' )
		);
	}

    static function shadow_dropdown() {
        return array(
            '0'     => esc_html__( '-Disable-', 'pixwell-core' ),
            '1' => esc_html__( 'Enable', 'pixwell-core' )
        );
    }

	static function infeed_dropdown() {
		return array(
			'0'     => esc_html__( '-- Disable --', 'pixwell-core' ),
			'code'  => esc_html__( 'Script Code', 'pixwell-core' ),
			'image' => esc_html__( 'Custom Image', 'pixwell-core' )
		);
	}

    static function tagline_tag_dropdown() {
        return array(
            'h1' => esc_html__( 'h1', 'pixwell-core' ),
            'h2' => esc_html__( 'h2', 'pixwell-core' ),
            'h3' => esc_html__( 'h3', 'pixwell-core' ),
            'h4' => esc_html__( 'h4', 'pixwell-core' ),
            'h5' => esc_html__( 'h5', 'pixwell-core' ),
            'h6' => esc_html__( 'h6', 'pixwell-core' ),
        );
    }

    static function button_style_dropdown() {
        return array(
            'border' => esc_html__( '- Border -', 'pixwell-core' ),
            'bg'     => esc_html__( 'Background', 'pixwell-core' ),
        );
    }

    static function target_dropdown() {
        return array(
            '0' => esc_html__( '- Self -', 'pixwell-core' ),
            '1' => esc_html__( 'Blank', 'pixwell-core' )
        );
    }

    static function content_align_dropdown() {
        return array(
            '0'     => esc_html__( '- Center -', 'pixwell-core' ),
            'left' => esc_html__( 'Left', 'pixwell-core' )
        );
    }

    static function img_content_dropdown() {
        return array(
            '0'      => esc_html__( '- Left -', 'pixwell-core' ),
            'center' => esc_html__( 'Center', 'pixwell-core' ),
            'right'  => esc_html__( 'Right', 'pixwell-core' ),
        );
    }

    static function heading_content_dropdown() {
        return array(
            'center' => esc_html__( '- Center -', 'pixwell-core' ),
            'left'   => esc_html__( 'Left', 'pixwell-core' ),
            'right'  => esc_html__( 'Right', 'pixwell-core' )
        );
    }

    static function image_width_dropdown() {
        return array(
            '0' => esc_html__( '-Auto-', 'pixwell-core' ),
            '1' => esc_html__( 'Full Width', 'pixwell-core' )
        );
    }

    static function icon_position_dropdown() {
        return array(
            '0'     => esc_html__( '- After Button Label -', 'pixwell-core' ),
            '1' => esc_html__( 'Before Button Label', 'pixwell-core' )
        );
    }

    static function style_layout_dropdown() {
        return array(
            '1' => esc_html__( '-Default (Right Form)-', 'pixwell-core' ),
            '2' => esc_html__( 'Style 2 (Bottom Form)', 'pixwell-core' )
        );
    }

    static function separator_dropdown() {
        return array(
            '0' => esc_html__( '- Disable -', 'pixwell-core' ),
            '1' => esc_html__( 'Enable', 'pixwell-core' )
        );
    }

}

/** get cat output */
class CatWalker extends \Walker {

	var $tree_type = 'category';
	var $cat_array = array();
	var $db_fields = array(
		'id'     => 'term_id',
		'parent' => 'parent'
	);

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
	}

	public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$this->cat_array[ str_repeat( ' - ', $depth ) . $object->name . ' - [ ID: ' . $object->term_id . ' / Posts: ' . $object->category_count . ' ]' ] = $object->term_id;
	}

	public function end_el( &$output, $object, $depth = 0, $args = array() ) {
	}
}