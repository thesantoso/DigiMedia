<!DOCTYPE html>
<html amp <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="site" class="site">
	<?php pixwell_amp_render_off_canvas(); ?>
	<div class="site-outer">
		<div class="site-wrap clearfix">
		<header id="site-header" class="header-wrap">
			<aside id="amp-navbar" class="mobile-navbar">
				<div class="mobile-nav-inner rb-p20-gutter">
					<?php if ( ! empty( pixwell_get_option( 'mobile_logo_pos' ) ) && pixwell_get_option( 'mobile_logo_pos' ) == 'left' ) : ?>
						<div class="m-nav-left">
							<?php get_template_part( 'templates/header', 'mlogo' ); ?>
						</div>
						<div class="m-nav-right">
							<?php get_template_part( 'templates/header', 'msearch' ); ?>
							<div on="tap:amp-menu-section.toggle" tabindex="0" class="off-canvas-trigger btn-toggle-wrap"><span class="btn-toggle"><span class="off-canvas-toggle"><span class="icon-toggle"></span></span></span></div>
						</div>
					<?php else : ?>
						<div class="m-nav-left">
							<div on="tap:amp-menu-section.toggle" tabindex="0" class="off-canvas-trigger btn-toggle-wrap"><span class="btn-toggle"><span class="off-canvas-toggle"><span class="icon-toggle"></span></span></span></div>
						</div>
						<div class="m-nav-centered">
							<?php get_template_part( 'templates/header', 'mlogo' ); ?>
						</div>
						<div class="m-nav-right">
							<?php get_template_part( 'templates/header', 'msearch' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</aside>
		</header>
		<?php pixwell_amp_render_header_ad();