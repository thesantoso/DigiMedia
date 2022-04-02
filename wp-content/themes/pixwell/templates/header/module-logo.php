<?php
$pixwell_logo        = pixwell_get_option( 'site_logo' );
$pixwell_logo_retina = pixwell_get_option( 'retina_site_logo' );
$pixwell_logo_dark        = pixwell_get_option( 'site_logo_dark' );
$pixwell_logo_retina_dark = pixwell_get_option( 'retina_site_logo_dark' );
$pixwell_logo_name   = get_bloginfo( 'name' );

if ( ! empty( $pixwell_logo['url'] ) ) :
	$pixwell_classname = 'logo-wrap is-logo-image site-branding';
	if ( substr( $pixwell_logo['url'], - 4, 4 ) == '.svg' ) {
		$pixwell_classname .= ' is-svg';
	} ?>
	<div class="<?php echo esc_attr( $pixwell_classname ); ?>">
		<?php if ( empty( $pixwell_logo_retina['url'] ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo default" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
				<img class="logo-default" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
			</a>
            <?php if ( pixwell_dark_mode() && ! empty( $pixwell_logo_dark['url'] ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
                    <img class="logo-default logo-dark" height="<?php echo esc_attr( $pixwell_logo_dark['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo_dark['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                </a>
            <?php else: ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ) ?>">
                    <img class="logo-default" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                </a>
            <?php endif; ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo default" title="<?php echo esc_attr( $pixwell_logo_name ); ?>">
				<img class="logo-default logo-retina" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" srcset="<?php echo esc_url( $pixwell_logo['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina['url'] ); ?> 2x" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
			</a>
            <?php if ( pixwell_dark_mode() && ! empty( $pixwell_logo_retina_dark['url'] ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                    <img class="logo-default logo-retina logo-dark" height="<?php echo esc_attr( $pixwell_logo_dark['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo_dark['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?>" srcset="<?php echo esc_url( $pixwell_logo_dark['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina_dark['url'] ); ?> 2x" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                </a>
            <?php else: ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo dark" title="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                    <img class="logo-default logo-retina" height="<?php echo esc_attr( $pixwell_logo['height'] ); ?>" width="<?php echo esc_attr( $pixwell_logo['width'] ); ?>" src="<?php echo esc_url( $pixwell_logo['url'] ) ?>" srcset="<?php echo esc_url( $pixwell_logo['url'] ) ?> 1x, <?php echo esc_url( $pixwell_logo_retina['url'] ); ?> 2x" alt="<?php echo esc_attr( $pixwell_logo_name ); ?>">
                </a>
            <?php endif; ?>
		<?php endif;
		if ( is_front_page() ) : ?>
			<h1 class="logo-title"><?php echo esc_html( $pixwell_logo_name ); ?></h1>
			<?php if ( get_bloginfo( 'description' ) ) : ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif;
		endif; ?>
	</div>
<?php else : ?>
	<div class="logo-wrap is-logo-text site-branding">
		<?php if ( is_front_page() ) : ?>
			<h1 class="logo-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $pixwell_logo_name ) ?>"><?php echo esc_html( $pixwell_logo_name ); ?></a>
			</h1>
		<?php else: ?>
			<p class="logo-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $pixwell_logo_name ) ?>"><?php echo esc_html( $pixwell_logo_name ); ?></a>
			</p>
		<?php endif;
		if ( get_bloginfo( 'description' ) ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>
	</div>
<?php endif;
