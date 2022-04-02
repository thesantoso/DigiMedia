<?php
$pixwell_logo        = pixwell_get_option( 'sticky_logo' );
$pixwell_logo_retina = pixwell_get_option( 'retina_sticky_logo' );

$pixwell_logo_dark        = pixwell_get_option( 'sticky_logo_dark' );
$pixwell_logo_retina_dark = pixwell_get_option( 'retina_sticky_logo_dark' );

if ( empty( $pixwell_logo['url'] ) ) {
	$pixwell_logo = pixwell_get_option( 'site_logo' );
}
$pixwell_logo_name = get_bloginfo( 'name' );

if ( ! empty( $pixwell_logo['url'] ) ) :
	$pixwell_classname = 'logo-wrap is-logo-image site-branding';
	if ( substr( $pixwell_logo['url'], - 4, 4 ) == '.svg' ) {
		$pixwell_classname .= ' is-svg';
	}
	if ( ! empty( $pixwell_logo_retina['url'] ) ) : ?>
		<div class="<?php echo esc_attr( $pixwell_classname ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo default" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
				<img class="logo-default logo-sticky-retina logo-retina" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>" srcset="<?php echo esc_url( $pixwell_logo['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina['url'] ); ?> 2x">
			</a>
            <?php if ( pixwell_dark_mode() && ! empty( $pixwell_logo_retina_dark['url'] ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
                    <img class="logo-default logo-sticky-retina logo-retina logo-dark" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_retina_dark['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>" srcset="<?php echo esc_url( $pixwell_logo_retina_dark['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina_dark['url'] ); ?> 2x">
                </a>
            <?php elseif(pixwell_dark_mode() && ! empty( $pixwell_logo_dark['url'])) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
                    <img class="logo-default logo-dark" height="<?php echo esc_attr( $pixwell_logo_dark['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo_dark['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
                    <img class="logo-default logo-sticky-retina logo-retina" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_retina['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>" srcset="<?php echo esc_url( $pixwell_logo_retina['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina['url'] ); ?> 2x">
                </a>
            <?php endif; ?>
		</div>
	<?php else : ?>
		<div class="<?php echo esc_attr( $pixwell_classname ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo default" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
				<img class="logo-default" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
			</a>
            <?php if ( pixwell_dark_mode() && ! empty( $pixwell_logo_dark['url'] ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
                    <img class="logo-default logo-dark" height="<?php echo esc_attr( $pixwell_logo_dark['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo_dark['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                </a>
            <?php elseif(pixwell_dark_mode()) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
                    <img class="logo-default" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                </a>
            <?php endif; ?>
		</div>
	<?php endif;
else : ?>
	<div class="logo-wrap is-logo-text site-branding">
		<p class="h1 logo-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $pixwell_logo_name ) ?>"><?php echo esc_html( $pixwell_logo_name ); ?></a>
		</p>
	</div>
<?php endif;
