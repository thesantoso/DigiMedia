<?php
/** footer logo */
$pixwell_logo         = pixwell_get_option( 'footer_logo' );
$pixwell_logo_retina  = pixwell_get_option( 'footer_logo_retina' );
$pixwell_logo_dark         = pixwell_get_option( 'footer_logo_dark' );
$pixwell_logo_retina_dark  = pixwell_get_option( 'footer_logo_retina_dark' );
$pixwell_menu         = pixwell_get_option( 'footer_menu' );
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
		<?php if ( ! empty( $pixwell_logo['url'] ) ):
			$pixwell_classname = 'footer-logo-wrap';
			if ( substr( $pixwell_logo['url'], - 4, 4 ) == '.svg' ) {
				$pixwell_classname .= ' is-svg';
			} ?>
			<div class="<?php echo esc_attr( $pixwell_classname ); ?>">
				<a href="<?php echo esc_url( $pixwell_footer_link ); ?>" class="footer-logo">
					<?php if ( ! empty( $pixwell_logo_retina['url'] ) ) : ?>
						<img loading="lazy" class="logo default" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" srcset="<?php echo esc_url( $pixwell_logo['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina['url'] ); ?> 2x" alt="<?php echo esc_attr( $pixwell_logo_alt ); ?>">
                        <?php if ( pixwell_dark_mode() && ! empty( $pixwell_logo_retina_dark['url'] ) ) : ?>
                            <img loading="lazy" class="logo dark" height="<?php echo esc_attr( $pixwell_logo_dark['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo_dark['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?>" srcset="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina_dark['url'] ); ?> 2x" alt="<?php echo esc_attr( $pixwell_logo_alt ); ?>">
                        <?php endif; ?>
					<?php else : ?>
						<img loading="lazy" class="logo default" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_alt ); ?>">
                        <?php if ( pixwell_dark_mode() && ! empty( $pixwell_logo_dark['url'] ) ) : ?>
                            <img loading="lazy" class="logo dark" height="<?php echo esc_attr( $pixwell_logo_dark['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo_dark['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_alt ); ?>">
                        <?php endif; ?>
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
		if ( ! empty( $pixwell_menu ) && has_nav_menu( 'pixwell_menu_footer' ) ) : ?>
			<?php wp_nav_menu( array(
				'theme_location' => 'pixwell_menu_footer',
				'menu_id'        => 'footer-menu',
				'container'      => false,
				'menu_class'     => 'footer-menu-inner',
				'depth'          => 1,
				'echo'           => true
			) ); ?>
		<?php endif; ?>
		</div>
</div>