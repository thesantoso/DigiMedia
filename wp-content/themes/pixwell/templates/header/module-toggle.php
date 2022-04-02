<?php
$pixwell_toggle = pixwell_get_option( 'offcanvas_toggle' );
$pixwell_toggle_bold = pixwell_get_option( 'offcanvas_toggle_bold' );
if ( ! empty( $pixwell_toggle ) ):
	if ( ! is_active_sidebar( 'pixwell_sidebar_offcanvas' ) && ! has_nav_menu( 'pixwell_menu_offcanvas' ) ) {
		return false;
	}
	if (!empty($pixwell_toggle_bold)) {
	    $add_class = 'btn-toggle-bold';
    } else {
        $add_class = 'btn-toggle-light';
    } ?>
	<a href="#" class="off-canvas-trigger btn-toggle-wrap <?php echo esc_html($add_class)?>"><span class="btn-toggle"><span class="off-canvas-toggle"><span class="icon-toggle"></span></span></span></a>
<?php endif;