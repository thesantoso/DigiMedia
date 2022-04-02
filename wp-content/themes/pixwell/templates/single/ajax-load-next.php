<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** single ajax */
global $post;
$response      = array();
$next_url      = '';
$ajax_next_cat = pixwell_get_option( 'ajax_next_cat' );
if ( ! empty( $ajax_next_cat ) ) {
	$post_prev = get_adjacent_post( true, '', true );
} else {
	$post_prev = get_adjacent_post( false, '', true );
}

if ( ! empty( $post_prev ) ) {
	$next_url = get_permalink( $post_prev );
}

if ( have_posts() ) :
	while ( have_posts() ) {
		the_post(); ?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="https://gmpg.org/xfn/11">
			<link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>"/>
		</head>
		<body>
		<div class="single-p-outer" data-postid="<?php echo get_the_ID(); ?>" data-postlink="<?php echo esc_url( get_permalink() ); ?>" data-nextposturl="<?php echo esc_url( $next_url ); ?>">
			<?php pixwell_single_render_layout(); ?>
		</div>
		</body>
		</html>
		<?php
		wp_reset_postdata();
	}
endif;

/** exits */
die();
