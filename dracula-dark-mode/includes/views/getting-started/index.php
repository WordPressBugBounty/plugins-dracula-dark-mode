<?php

defined( 'ABSPATH' ) || exit;

if ( ! ddm_fs()->is_premium() && ! ddm_fs()->is_registered() && ddm_fs()->is_activation_page() && !ddm_fs()->is_anonymous_site()) {
    ddm_fs()->_connect_page_render();
}

?>

<div class="dracula-getting-started">
    <div class="getting-started-header">

        <div class="header-logo">
            <img src="<?php echo esc_url( DRACULA_ASSETS . '/images/dracula-logo.svg' ); ?>">
            <span><?php _e( 'Dracula Dark Mode', 'dracula-dark-mode' ) ?></span>
        </div>

        <p><?php _e( 'Smooth Dark Mode & Better Accessibility for WordPress', 'dracula-dark-mode' ) ?></p>

    </div>

    <div class="getting-started-main">

        <div class="getting-started-menu">
            <div class="menu-item active" data-target="introduction">
                <img src="<?php echo esc_url(DRACULA_ASSETS) ?>/images/getting-started/menu/introduction.svg" />
                <span><?php _e( 'Introduction','dracula-dark-mode') ?></span>
            </div>

            <div class="menu-item" data-target="basic-usage">
                <img src="<?php echo esc_url(DRACULA_ASSETS) ?>/images/getting-started/menu/basic-usage.svg" />
                <span><?php _e( 'Basic Usage','dracula-dark-mode') ?></span>
            </div>

            <div class="menu-item" data-target="help">
                <img src="<?php echo esc_url(DRACULA_ASSETS) ?>/images/getting-started/menu/help.svg" />

                <span><?php _e( 'Help','dracula-dark-mode') ?></span>
            </div>

            <div class="menu-item" data-target="what-new">
                <img src="<?php echo esc_url(DRACULA_ASSETS) ?>/images/getting-started/menu/what-new.svg" />


                <span><?php _e( 'Changelog','dracula-dark-mode') ?></span>
            </div>

			<?php if ( ddm_fs()->is_not_paying() ) { ?>
                <div class="menu-item" data-target="get-pro">
                    <img src="<?php echo esc_url(DRACULA_ASSETS) ?>/images/getting-started/menu/get-pro.svg" />

                    <span><?php _e( 'Get PRO','dracula-dark-mode') ?></span>
                </div>
			<?php } ?>

        </div>

		<?php include_once DRACULA_INCLUDES . '/views/getting-started/introduction.php'; ?>
		<?php include_once DRACULA_INCLUDES . '/views/getting-started/what-new.php'; ?>
		<?php include_once DRACULA_INCLUDES . '/views/getting-started/basic-usage.php'; ?>
		<?php include_once DRACULA_INCLUDES . '/views/getting-started/help.php'; ?>

		<?php
		if ( ddm_fs()->is_not_paying() ) {
			include_once DRACULA_INCLUDES . '/views/getting-started/get-pro.php';
		}
		?>

    </div>

</div>

<script>
    jQuery(document).on('ready', function () {
        jQuery('.dracula-getting-started .menu-item').on('click', function () {
            const target = jQuery(this).data('target');

            jQuery('.menu-item').removeClass('active');
            jQuery('.getting-started-content').removeClass('active');

            jQuery(this).addClass('active');
            jQuery('#' + target).addClass('active');
        });
    });
</script>