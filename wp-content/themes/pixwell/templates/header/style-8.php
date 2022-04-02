<header id="site-header" class="header-wrap header-8">
	<div class="navbar-outer">
		<div class="navbar-wrap">
			<?php get_template_part( 'templates/header/module', 'mnav' ); ?>
			<div class="navbar-holder">
				<div class="rb-m20-gutter navbar-inner is-main-nav">
					<div class="navbar-left">
						<?php get_template_part( 'templates/header/module', 'toggle' ); ?>
						<?php get_template_part( 'templates/header/module', 'logo' ); ?>
					</div>
					<div class="navbar-center">
						<?php get_template_part( 'templates/header/module', 'menu' ); ?>
					</div>
					<div class="navbar-right">
						<?php get_template_part( 'templates/header/module', 'social' ); ?>
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
	<?php
	get_template_part( 'templates/header/module', 'sticky' );

	if ( is_active_sidebar( 'pixwell_header_ad' ) ) {
		dynamic_sidebar( 'pixwell_header_ad' );
	} ?>
</header>