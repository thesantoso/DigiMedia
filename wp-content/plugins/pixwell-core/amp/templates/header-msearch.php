<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pixwell_mobile_search = pixwell_get_option( 'mobile_search' );
if ( empty( $pixwell_mobile_search ) ) {
	return;
}; ?>
<div class="mobile-search">
	<a href="<?php echo esc_url( home_url( '/?s' ) ); ?>" title="<?php echo esc_attr( pixwell_translate( 'search' ) ); ?>" class="search-icon nav-search-link"><i class="rbi rbi-search-light"></i></a>
</div>
