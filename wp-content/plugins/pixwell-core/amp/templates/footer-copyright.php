<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pixwell_copyright = pixwell_get_option( 'footer_copyright' );
$pixwell_back_top        = pixwell_get_option( 'amp_back_top' );
if ( ! empty( $pixwell_copyright ) || ! empty( $pixwell_back_top ) ) : ?>
	<div class="footer-copyright footer-section">
		<div class="rbc-container">
			<div class="copyright-inner rb-p20-gutter">
				<?php if ( ! empty( $pixwell_copyright ) ) : ?>
					<?php echo wp_kses_post( wpautop( $pixwell_copyright ) ) ?>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( ! empty( $pixwell_back_top )) : ?>
			<a href="#top" class="amp-back-top">&uarr;</a>
		<?php endif; ?>
	</div>
<?php endif;