<?php
$pixwell_header_classname = 'header-wrap header-9 none-sright';
if ( is_active_sidebar( 'pixwell_header_ad' ) ) {
	$pixwell_header_classname = 'header-wrap header-9 has-sright';
}

?><header id="site-header" class="<?php echo esc_attr( $pixwell_header_classname ); ?>">
	<div class="navbar-outer">
		<div class="banner-wrap">
			<div class="rbc-container rb-p20-gutter">
				<div class="banner-inner rb-row">
					<div class="banner-left rb-col-d3">
						<?php get_template_part( 'templates/header/module', 'logo' ); ?>
					</div>
					<div class="banner-right rb-col-d9">
                        <?php get_template_part( 'templates/header/module', 'social' ); ?>
						<?php if ( is_active_sidebar( 'pixwell_header_ad' ) ) {
							dynamic_sidebar( 'pixwell_header_ad' );
						} ?>
					</div>
				</div>
			</div>
		</div>
		<div class="navbar-wrap">
			<div class="rbc-container">
				<?php get_template_part( 'templates/header/module', 'mnav' ); ?>
				<div class="navbar-holder is-main-nav">
					<div class="navbar-inner rb-p20-gutter">
						<div class="navbar-left">
							<?php get_template_part( 'templates/header/module', 'toggle' ); ?>
							<?php get_template_part( 'templates/header/module', 'menu' ); ?>
						</div>
						<div class="navbar-right">
							<?php get_template_part( 'templates/header/module', 'trend' ); ?>
							<?php get_template_part( 'templates/header/module', 'bookmark' ); ?>
							<?php get_template_part( 'templates/header/module', 'cart' ); ?>
                            <?php get_template_part( 'templates/header/module', 'darkmode' ); ?>
							<?php get_template_part( 'templates/header/module', 'search' ); ?>
							<?php get_template_part( 'templates/header/module', 'widget' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part( 'templates/header/module', 'sticky' ); ?>
</header>