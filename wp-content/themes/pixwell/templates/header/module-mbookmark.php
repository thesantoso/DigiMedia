<?php
$pixwell_header_bookmark = pixwell_get_option( 'header_bookmark' );
$pixwell_mobile_bookmark = pixwell_get_option( 'mobile_bookmark' );
if ( empty( $pixwell_header_bookmark ) || empty( $pixwell_mobile_bookmark ) ) {
	return;
}
$pixwell_header_bookmark_url = pixwell_get_option( 'header_bookmark_url' );
if ( empty( $pixwell_header_bookmark_url ) ) {
	$pixwell_header_bookmark_url = '#';
} else {
	$pixwell_header_bookmark_url = get_permalink( $pixwell_header_bookmark_url );
} ?>
<aside class="bookmark-section">
    <a class="bookmark-link" href="<?php echo esc_url( $pixwell_header_bookmark_url ); ?>">
        <span class="bookmark-icon"><i><?php pixwell_render_svg( 'bookmark' ); ?></i><span class="bookmark-counter rb-counter">0</span></span>
    </a>
</aside>