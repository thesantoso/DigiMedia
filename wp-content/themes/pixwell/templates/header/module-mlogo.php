<?php
/** mobile logo */
$pixwell_m_logo     = pixwell_get_option( 'mobile_logo' );
$pixwell_m_logo_dark  = pixwell_get_option( 'mobile_logo_dark' );
$pixwell_logo_title = get_bloginfo( 'name' );

if ( empty( $pixwell_m_logo['url'] ) ) {
	$pixwell_m_logo = pixwell_get_option( 'retina_site_logo' );
}

if ( empty( $pixwell_m_logo['url'] ) ) {
	$pixwell_m_logo = pixwell_get_option( 'site_logo' );
}

if ( ! empty( $pixwell_m_logo['url'] ) ) :
	$pixwell_classname = 'logo-mobile-wrap is-logo-image';
	if ( substr( $pixwell_m_logo['url'], - 4, 4 ) == '.svg' ) {
		$pixwell_classname .= ' is-svg';
	} ?>
	<aside class="<?php echo esc_attr( $pixwell_classname ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mobile logo default">
			<img height="<?php echo esc_attr( $pixwell_m_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_m_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_m_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_title ); ?>">
		</a>
        <?php if ( pixwell_dark_mode() && ! empty( $pixwell_m_logo_dark['url'] ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mobile logo dark">
                <img height="<?php echo esc_attr( $pixwell_m_logo_dark['height'] ); ?>" width="<?php echo esc_attr( $pixwell_m_logo_dark['width'] ); ?>" src="<?php echo esc_url( $pixwell_m_logo_dark['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_title ); ?>">
            </a>
        <?php else: ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mobile logo dark">
                <img height="<?php echo esc_attr( $pixwell_m_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_m_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_m_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_title ); ?>">
            </a>
        <?php endif; ?>
	</aside>
<?php else : ?>
	<aside class="logo-mobile-wrap is-logo-text">
		<a class="logo-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><strong><?php echo esc_html( $pixwell_logo_title ); ?></strong></a>
	</aside>
<?php endif;
