<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** footer logo */
$pixwell_logo        = pixwell_get_option( 'amp_footer_logo' );
$pixwell_logo_retina = pixwell_get_option( 'amp_footer_logo_retina' );

if ( empty( $pixwell_logo['url'] ) ) {
	$pixwell_logo = pixwell_get_option( 'footer_logo' );
}

if ( empty( $pixwell_logo_retina['url'] ) ) {
	$pixwell_logo_retina = pixwell_get_option( 'footer_logo_retina' );
}

$pixwell_menu         = pixwell_get_option( 'amp_footer_menu' );
$pixwell_footer_link  = pixwell_get_option( 'footer_logo_url' );
$pixwell_social       = pixwell_get_option( 'footer_social' );
$pixwell_social_color = pixwell_get_option( 'footer_social_color' );

if ( $pixwell_social ) {
	$pixwell_social_render = pixwell_render_social_icons( pixwell_get_web_socials(), true );
}
if ( empty( $pixwell_footer_link ) ) {
	$pixwell_footer_link = home_url( '/' );
}
if ( empty( $pixwell_logo['url'] ) && ( empty( $pixwell_menu ) || ! has_nav_menu( 'pixwell_menu_footer' ) ) && empty( $pixwell_social_render ) ) {
	return false;
}
if ( ! empty( $pixwell_logo['alt'] ) ) {
	$pixwell_logo_alt = $pixwell_logo['alt'];
} else {
	$pixwell_logo_alt = get_bloginfo( 'name' );
} ?>
<div class="footer-logo footer-section">
	<div class="rbc-container footer-logo-inner">
		<?php if ( ! empty( $pixwell_logo['url'] ) ): ?>
			<div class="footer-logo-wrap">
				<a href="<?php echo esc_url( $pixwell_footer_link ); ?>" class="footer-logo">
					<?php if ( ! empty( $pixwell_logo_retina['url'] ) ) : ?>
						<img height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" srcset="<?php echo esc_url( $pixwell_logo['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina['url'] ); ?> 2x" alt="<?php echo esc_attr( $pixwell_logo_alt ); ?>">
					<?php else : ?>
						<img height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_alt ); ?>">
					<?php endif; ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $pixwell_social ) ) :
			$pixwell_social_classes = 'footer-social-wrap';
			if ( ! empty( $pixwell_social_color ) ) {
				$pixwell_social_classes = ' is-color';
			} ?>
			<div class="<?php echo esc_attr( $pixwell_social_classes ); ?>">
				<div class="footer-social social-icons is-bg-icon tooltips-s"><?php echo pixwell_render_social_icons( pixwell_get_web_socials(), true ); ?></div>
			</div>
		<?php endif;
		if ( ! empty( $pixwell_menu )  ) : ?>
			<?php wp_nav_menu( array(
				'menu'       => $pixwell_menu,
				'menu_id'    => 'footer-menu',
				'container'  => false,
				'menu_class' => 'footer-menu-inner',
				'depth'      => 1,
				'echo'       => true
			) ); ?>
		<?php endif; ?>
	</div>
</div>