<?php
/** module dark mode */
if ( pixwell_dark_mode() ) { ?>
    <aside class="header-dark-mode">
        <span class="dark-mode-toggle">
            <span class="mode-icons">
                <span class="dark-mode-icon mode-icon-dark"><?php pixwell_render_svg('mode-dark'); ?></span>
                <span class="dark-mode-icon mode-icon-default"><?php pixwell_render_svg('mode-light'); ?></span>
            </span>
        </span>
    </aside>
	<?php
}