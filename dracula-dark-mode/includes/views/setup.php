<div class="dracula-setup">

    <div class="dracula-setup-sidebar-wrap">

        <div class="dracula-setup-header">
            <h1>
                <?php esc_html_e('Welcome to ', 'dracula-dark-mode'); ?>

                <div class="logo-wrap">
                    <img src="<?php echo esc_attr(DRACULA_ASSETS) ?>/images/dracula-logo.svg" alt="Dracula Logo"/>
                    <span class="dracula-logo-text"><?php esc_html_e('Dracula Dark Mode', 'dracula-dark-mode'); ?></span>
                </div>
            </h1>

            <p><?php esc_html_e('Let\'s get you started with a quick setup wizard.', 'dracula-dark-mode'); ?></p>
        </div>

        <div id="dracula-setup-sidebar" class="dracula-live-edit-wrap"></div>
    </div>

    <div class="dracula-setup-site">
        <iframe
                src="<?php echo esc_url(home_url()); ?>/?dracula-setup=1"
                frameborder="0"
                class="dracula-setup-iframe"
        ></iframe>
    </div>

</div>