<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_ajax_nopriv_rb_add_reaction', 'rb_add_reaction' );
add_action( 'wp_ajax_rb_add_reaction', 'rb_add_reaction' );
add_action( 'wp_ajax_nopriv_rb_load_reaction', 'rb_load_user_reaction' );
add_action( 'wp_ajax_rb_load_reaction', 'rb_load_user_reaction' );
add_shortcode( 'rb_show_reaction', 'rb_render_reaction' );

/**
 * get user IPs
 */
if ( ! function_exists( 'rb_get_user_ip' ) ) {
	function rb_get_user_ip() {

		if ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$user_ip = getenv( 'HTTP_CLIENT_IP' );
		} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$user_ip = getenv( 'HTTP_X_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
			$user_ip = getenv( 'HTTP_X_FORWARDED' );
		} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
			$user_ip = getenv( 'HTTP_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
			$user_ip = getenv( 'HTTP_FORWARDED' );
		} else {
			$user_ip = $_SERVER['REMOTE_ADDR'];
		}

		if ( ! filter_var( $user_ip, FILTER_VALIDATE_IP ) ) {
			return '127.0.0.1';
		} else {
			return rb_mask_anonymise_ip( $user_ip );
		}
	}
}

if ( ! function_exists( 'rb_mask_anonymise_ip' ) ) {
	function rb_mask_anonymise_ip( $user_ip ) {
		if ( strpos( $user_ip, "." ) == true ) {
			return preg_replace( '~[0-9]+$~', 'x', $user_ip );
		} else {
			return preg_replace( '~[0-9]*:[0-9]+$~', 'xxxx:xxxx', $user_ip );
		}
	}
}

if ( ! function_exists( 'rb_register_reaction' ) ) {
	function rb_register_reaction() {
		$defaults = array(
			'love'   => array(
				'id'    => 'love',
				'title' => pixwell_translate( 'love' ),
				'icon'  => 'symbol-love'
			),
			'sad'    => array(
				'id'    => 'sad',
				'title' => pixwell_translate( 'sad' ),
				'icon'  => 'symbol-sad'
			),
			'happy'  => array(
				'id'    => 'happy',
				'title' => pixwell_translate( 'happy' ),
				'icon'  => 'symbol-happy'
			),
			'sleepy' => array(
				'id'    => 'sleepy',
				'title' => pixwell_translate( 'sleepy' ),
				'icon'  => 'symbol-sleepy'
			),
			'angry'  => array(
				'id'    => 'angry',
				'title' => pixwell_translate( 'angry' ),
				'icon'  => 'symbol-angry'
			),
			'dead'   => array(
				'id'    => 'dead',
				'title' => pixwell_translate( 'dead' ),
				'icon'  => 'symbol-dead'
			),
			'wink'   => array(
				'id'    => 'wink',
				'title' => pixwell_translate( 'wink' ),
				'icon'  => 'symbol-wink'
			),
		);

		return apply_filters( 'rb_add_reaction', $defaults );
	}
}

if ( ! function_exists( 'rb_render_reaction' ) ) {
	function rb_render_reaction( $attrs ) {

		$attrs = shortcode_atts( array(
			'id' => '',
		), $attrs );

		if ( pixwell_is_amp() ) {
			return false;
		}

		if ( empty( $attrs['id'] ) ) {

			global $post;
			$post_id = get_the_ID();
		} else {
			$post_id = $attrs['id'];
		}

		if ( empty( $post_id ) ) {
			return false;
		}

		$output    = '';
		$reactions = rb_register_reaction();

		if ( is_array( $reactions ) ) {

			$output .= '<aside id="reaction-' . $post_id . '" class="rb-reaction reaction-wrap" data-reaction_uid="' . esc_attr( $post_id ) . '">';

			foreach ( $reactions as $reaction ) {
				if ( empty( $reaction['id'] ) ) {
					continue;
				}
				$output .= '<div class="reaction" data-reaction="' . $reaction['id'] . '" data-reaction_uid="' . esc_attr( $post_id ) . '">';
				$output .= '<span class="reaction-content">';
				$output .= '<div class="reaction-icon"><svg class="rb-svg" viewBox="0 0 150 150"><use xlink:href="#' . esc_attr( $reaction['icon'] ) . '"></use></svg></div>';
				$output .= '<span class="reaction-title h6">' . esc_html( $reaction['title'] ) . '</span>';
				$output .= '</span>';
				$output .= '<span class="total-wrap"><span class="reaction-count">' . rb_count_reaction( $reaction['id'], $post_id ) . '</span></span>';
				$output .= '</div>';
			}

			$output .= '</aside>';
		}

		return $output;
	}
}

if ( ! function_exists( 'rb_count_reaction' ) ) {
	/**
	 * @param $reaction
	 * @param $post_id
	 *
	 * @return int
	 */
	function rb_count_reaction( $reaction, $post_id ) {
		$data = get_post_meta( $post_id, 'rb_reaction_data', true );
		if ( ! empty( $data[ $reaction ] ) ) {
			return count( $data[ $reaction ] );
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'rb_load_user_reaction' ) ) {
	function rb_load_user_reaction() {

		if ( empty( $_POST['uid'] ) ) {
			wp_send_json( '', null );
		}

		$current_user = get_current_user_id();
		if ( ! empty( $current_user ) ) {
			$user_ip = $current_user;
		} else {
			$user_ip = rb_get_user_ip();
		}

		$uid      = esc_attr( $_POST['uid'] );
		$data     = get_post_meta( $uid, 'rb_reaction_data', true );
		$response = array();

		if ( is_array( $data ) ) {
			foreach ( $data as $reaction => $stored_data ) {
				if ( in_array( $user_ip, $stored_data ) ) {
					$response[] = $reaction;
					if ( pixwell_get_option( 'unique_reaction' ) ) {
						break;
					}
				}
			}
		}

		wp_send_json( $response, null );
	}
}

if ( ! function_exists( 'rb_add_reaction' ) ) {
	function rb_add_reaction() {

		if ( empty( $_POST['uid'] ) || empty( $_POST['reaction'] ) || empty( $_POST['push'] ) ) {
			wp_send_json( '', null );
		}

		$current_user = get_current_user_id();

		if ( ! empty( $current_user ) ) {
			$user_ip = $current_user;
		} else {
			$user_ip = rb_get_user_ip();
		}

		$uid             = esc_attr( $_POST['uid'] );
		$reaction        = esc_attr( $_POST['reaction'] );
		$push            = esc_attr( $_POST['push'] );
		$data            = get_post_meta( $uid, 'rb_reaction_data', true );
		$unique_reaction = pixwell_get_option( 'unique_reaction' );

		if ( ! is_array( $data ) ) {
			$data = array();
		}

		if ( empty( $data[ $reaction ] ) || ! is_array( $data[ $reaction ] ) ) {
			$data[ $reaction ] = array();
		}

		/** remove reactions */
		if ( $unique_reaction ) {
			foreach ( $data as $item => $stored_data ) {
				if ( $item !== $reaction ) {
					$data[ $item ] = array_diff( $stored_data, array( $user_ip ) );
				}
			}
		}

		if ( $push > 0 ) {
			$data[ $reaction ][] = $user_ip;
			$data[ $reaction ]   = array_unique( $data[ $reaction ] );
		} else {
			if ( ( $key = array_search( $user_ip, $data[ $reaction ] ) ) !== false ) {
				unset( $data[ $reaction ][ $key ] );
			}
		}

		update_post_meta( $uid, 'rb_reaction_data', $data );
		if ( $unique_reaction ) {
			wp_send_json( 2, null );
		} else {
			wp_send_json( true, null );
		}
	}
}

