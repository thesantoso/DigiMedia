<?php
/** Don't load directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Pixwell_Table_Contents', false ) ) {
	/**
	 * Class Pixwell_Table_Contents
	 * table of contents
	 */
	class Pixwell_Table_Contents {

		private static $instance;

		public $settings;
		public $supported_headings;

		public static function get_instance() {
			if ( self::$instance === null ) {
				return new self();
			}

			return self::$instance;
		}

		function __construct() {
			self::$instance = $this;

			$this->get_supported_headings();
			if ( ! is_admin() ) {
				add_filter( 'the_content', array( $this, 'the_content' ), 0 );
			}
		}

		/** get all settings */
		public function get_settings() {

			$this->settings = array(
				'post'      => $this->get_setting( 'table_contents_post' ),
				'page'      => $this->get_setting( 'table_contents_page' ),
				'enable'    => $this->get_setting( 'table_contents_enable' ),
				'heading'   => $this->get_setting( 'table_contents_heading' ),
				'position'  => $this->get_setting( 'table_contents_position' ),
				'hierarchy' => $this->get_setting( 'table_contents_hierarchy' ),
				'numlist'   => $this->get_setting( 'table_contents_numlist' ),
				'scroll'    => $this->get_setting( 'table_contents_scroll' ),
			);
		}

		/**
		 * get supported heading settings
		 */
		public function get_supported_headings() {
			$this->supported_headings = array();
			for ( $i = 1; $i <= 6; $i ++ ) {
				if ( $this->get_setting( 'table_contents_h' . $i ) ) {
					array_push( $this->supported_headings, $i );
				}
			}
		}

		/**
		 * @param string $setting_id
		 *
		 * @return false|mixed
		 * get settings
		 */
		public function get_setting( $setting_id = '' ) {
			$setting = rb_get_meta( $setting_id );

			if ( '-1' == $setting ) {
				return '';
			}

			if ( ! $setting || 'default' == $setting ) {
				$setting = pixwell_get_option( $setting_id );
			}

			return $setting;
		}

		/**
		 * @param $content
		 *
		 * @return string|string[]
		 * the_content filter
		 */
		public function the_content( $content ) {

			$this->get_settings();
			if ( ! $this->is_enabled( $content ) ) {
				return $content;
			}

			$matches = $this->extract_headings( $content );

			if ( ! $matches || ! is_array( $matches ) || ! $this->minimum_headings( $matches ) ) {
				return $content;
			}

			$table_contents = $this->create_table_contents( $matches );

			$content = $this->replace_content( $content, $matches );
			$content = $this->add_table_contents( $content, $table_contents );

			return $content;
		}

		/**
		 * @param $content
		 * @param $matches
		 *
		 * @return string|string[]
		 * replace content
		 */
		function replace_content( $content, $matches ) {
			$find    = array();
			$replace = array();
			foreach ( $matches as $index => $value ) {
				if ( ! empty( $value[0] ) && ! empty( $value[1] ) && ! empty( $value[2] ) ) {
					array_push( $find, $value[0] );
					array_push( $replace, '<h' . $value[2] . ' id="' . $this->generate_uid( $value[0] ) . '">' . strip_tags( $value[0] ) . '</h' . $value[2] . '>' );
				}
			}

			return str_replace( $find, $replace, $content );
		}

		/**
		 * @param $matches
		 *
		 * @return string
		 * create table content
		 */
		function create_table_contents( $matches ) {

			$output = '';
			if ( $this->settings['hierarchy'] ) {
				$min_depth = 6;

				foreach ( $matches as $index => $value ) {
					if ( $min_depth > $value[2] ) {
						$min_depth = intval( $value[2] );
					}
				}
				foreach ( $matches as $index => $value ) {
					$matches[ $index ]['depth'] = intval( $value[2] ) - $min_depth;
				}
			}

			$classes = 'rb-table-contents';
			if ( ! empty( $this->settings['scroll'] ) ) {
				$classes .= ' rb-smooth-scroll';
			}
			$output .= '<div id="ruby-table-contents" class="' . esc_attr( $classes ) . '">';
			if ( ! empty( $this->settings['heading'] ) ) {
				$output .= '<div class="table-content-header"><span class="h3">' . esc_html( $this->settings['heading'] ) . '</span></div>';
			}
			$output .= '<div class="inner">';
			foreach ( $matches as $index => $value ) {
				$link_classes = 'table-link h5';
				if ( ! empty( $value['depth'] ) ) {
					$link_classes .= ' depth-' . $value['depth'];
				}
				$output .= '<div class="' . esc_attr( $link_classes ) . '"><a href="#' . $this->generate_uid( $value[0] ) . '">';
				$output .= strip_tags( $value[0] );
				$output .= '</a></div>';
			}

			$output .= '</div></div>';

			return $output;
		}

		/**
		 * @param $content
		 * @param $table_contents
		 *
		 * @return string|string[]
		 * add table of contents section
		 */
		function add_table_contents( $content, $table_contents ) {

			if ( strpos( $content, '<!--RUBY:TOC-->' ) ) {
				return str_replace( '<!--RUBY:TOC-->', $table_contents, $content );
			}

			$pos = 0;
			$tag = '</p>';
			if ( ! empty( $this->settings['position'] ) ) {
				$pos = absint( $this->settings['position'] );
			}
			$content = explode( $tag, $content );
			foreach ( $content as $index => $paragraph ) {
				if ( $pos == $index ) {
					$content[ $index ] = $table_contents . $paragraph;
				}
				if ( trim( $paragraph ) ) {
					$content[ $index ] .= $tag;
				}
			}

			$content = implode( '', $content );

			return $content;
		}

		/**
		 * @param $content
		 *
		 * @return false|mixed
		 */
		public function extract_headings( $content ) {
			$matches = array();
			if ( preg_match_all( '/(<h([1-6]{1})[^>]*>).*<\/h\2>/msuU', $content, $matches, PREG_SET_ORDER ) ) {

				$matches = $this->filter_headings( $matches );
				$matches = $this->remove_empty( $matches );

				return $matches;
			}

			return false;
		}

		/** filter supported headings */
		public function filter_headings( $matches ) {
			foreach ( $matches as $index => $value ) {
				if ( ! in_array( $value[2], $this->supported_headings ) ) {
					unset( $matches[ $index ] );
				}
			}

			return $matches;
		}

		/** remove empty */
		function remove_empty( $matches ) {
			foreach ( $matches as $index => $value ) {
				$text = trim( strip_tags( $value[0] ) );
				if ( empty( $text ) ) {
					unset( $matches[ $index ] );
				}
			}

			return $matches;
		}

		/**
		 * @param $matches
		 *
		 * @return bool
		 * minimum headings
		 */
		public function minimum_headings( $matches ) {

			if ( count( $matches ) < $this->settings['enable'] ) {
				return false;
			}

			return true;
		}
		public function rb_remove_accent($output)
		{
			$rb_accented = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
			$rb_remove = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
			return str_replace($rb_accented, $rb_remove, $output);
		}

		/**
		 * @param $text
		 *
		 * @return string
		 * generate ID
		 */
		public function generate_uid( $text ) {

			$output = trim( strip_tags( $text ) );
			$output = str_replace( array( "\r", "\n", "\n\r", "\r\n" ), ' ', $output );
			$output = esc_attr( $output );
			$output = strtolower(preg_replace(array('/[^\x{0600}-\x{06FF}a-zA-Z0-9 -]/u', '/[ -]+/', '/^-|-$/'), array('', '-', ''), self::rb_remove_accent($output)));
			$output = str_replace( array( '  ', ' ' ), '-', $output );
			$output = 'rb-' . rtrim( $output, '-' );

			return $output;
		}

		/**
		 * @param $content
		 *
		 * @return bool
		 * is enabled
		 */
		function is_enabled( $content ) {

			if ( is_front_page() || strpos( $content, 'id="ruby-table-contents"' ) || is_page_template( 'rbc-frontend.php' ) ) {

				return false;
			}

			if ( ( $this->settings['post'] && is_single() ) || ( $this->settings['page'] && is_page() ) ) {
				return true;
			}

			return false;
		}
	}
}
