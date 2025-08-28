<?php

$features = [
        'toggle-shortcode' => [
                'title' => __('Toggle Button Shortcode', 'dracula-dark-mode'),
                'description' => __('You can display the dark mode toggle button anywhere on your website using the [dracula_toggle] shortcode.', 'dracula-dark-mode'),
        ],
        'default-dark-mode' => [
                'title' => __('Default Dark Mode', 'dracula-dark-mode'),
                'description' => __('Dracula Dark Mode lets you set the dark mode as your website\'s default theme. Thus, first-time visitors will experience the site in dark mode.', 'dracula-dark-mode'),
        ],
        'performance-mode' => [
                'title' => __('Performance Mode', 'dracula-dark-mode'),
                'description' => __('The Performance Mode feature enhances website\'s loading speed by deferring script loading, reducing initial page load times. ', 'dracula-dark-mode'),
        ],
        'dark-mode-user-roles' => [
                'title' => __('Admin Dark Mode', 'dracula-dark-mode'),
                'description' => __('You can allow other users to use the dark mode color scheme on their backend admin dashboard by selectively certain user roles such as: Administrator, Editor, Author etc.', 'dracula-dark-mode'),
        ],
        'custom-size' => [
                'title' => __('Button Size Customization', 'dracula-dark-mode'),
                'description' => __('Dracula Dark Mode allows you to customize the dark mode toggle button size as small, normal, large or even in a custom width and height of the button.', 'dracula-dark-mode'),
        ],
        'custom-position' => [
                'title' => __('Button Position Customization', 'dracula-dark-mode'),
                'description' => __('You can also set the custom position for the dark mode toggle button as on the left, right, or even can place the toggle button in a specific location on the site for easy access.', 'dracula-dark-mode'),
        ],
        'typography' => [
                'title' => __('Dark Mode Based Typography', 'dracula-dark-mode'),
                'description' => __('Dracula Dark Mode allows you to set a different font family with a customized font size when dark mode is enabled  to improve readability and legibility of their website.', 'dracula-dark-mode'),
        ],
        'exclude-page' => [
                'title' => __('Exclude Pages/ Posts', 'dracula-dark-mode'),
                'description' => __('Dracula Dark Mode allows to exclude certain pages, posts or any custom post types from dark mode. This can be useful if you want to keep certain pages or posts, in their original light mode when the rest of the website is in dark mode. ', 'dracula-dark-mode'),
        ],
        'exclude-elements' => [
                'title' => __('Excludes Elements', 'dracula-dark-mode'),
                'description' => __('You can also exclude certain sections and elements of the website from dark mode for having more control over their website\'s dark mode experience and can help to improve the overall usability of the site.', 'dracula-dark-mode'),
        ],

        'custom-css' => [
                'title' => __('Custom CSS', 'dracula-dark-mode'),
                'description' => __('Dracula Dark Mode allows you to add your custom CSS code to customize the appearance of the website both in the light and dark mode.', 'dracula-dark-mode'),
        ],
        'cookie' => [
                'title' => __('Save User Choice', 'dracula-dark-mode'),
                'description' => __('If any user chooses dark mode on their last visit to your website the plugin will remember their preference and automatically load the same mode when they visit the website again. ', 'dracula-dark-mode'),
        ],
        'time-based' => [
                'title' => __('Time Based Dark Mode', 'dracula-dark-mode'),
                'description' => __('Dracula Dark Mode allows to schedule the dark mode based on the time of the day. This feature can be useful for users who prefer dark mode during nighttime hours and switch back to light mode during daytime hours.', 'dracula-dark-mode'),
        ],
    //	'url-parameter'        => [
    //		'title'       => __( 'URL Parameter', 'dracula-dark-mode' ),
    //		'description' => __( 'Dracula Dark Mode allows you to enable/ disable dark mode by adding the darkmode and lightmode  parameter to the website URL.', 'dracula-dark-mode' ),
    //	],
        'draggable-switch' => [
                'title' => __('Draggable Switch', 'dracula-dark-mode'),
                'description' => __('You can also enable the draggable switch option to allow users to drag the floating dark mode toggle button to the desired position on the screen.', 'dracula-dark-mode'),
        ],
        'keyboard-shortcut' => [
                'title' => __('Keyboard Shortcut', 'dracula-dark-mode'),
                'description' => __('Dracula Dark Mode allows users to switch between light and dark mode using the keyboard shortcut `(Ctrl + Alt + D)`.', 'dracula-dark-mode'),
        ],
        'transition-animation' => [
                'title' => __('Page Transition Animation', 'dracula-dark-mode'),
                'description' => __('Smooth and stylish transitions when switching between dark and light modes.', 'dracula-dark-mode'),
        ],
        'attention-effect' => [
                'title' => __('Toggle Switch Attention Effect', 'dracula-dark-mode'),
                'description' => __('Eye-catching effects on the toggle, ensuring users notice the dark mode option.', 'dracula-dark-mode'),
        ],
        'gutenberg-block' => [
                'title' => __('Gutenberg Toggle Block', 'dracula-dark-mode'),
                'description' => __('Embed a dark mode switch directly within the Gutenberg editor for easy reader access. ', 'dracula-dark-mode'),
        ],
        'elementor-widget' => [
                'title' => __('Elementor Toggle Widget', 'dracula-dark-mode'),
                'description' => __('Add a dark mode toggle to your Elementor designs effortlessly.', 'dracula-dark-mode'),
        ],
];

$plugins = [
        [
                'key' => 'integrate-google-drive',
                'title' => 'Integrate Google Drive',
                'desc' => __('Complete Google Drive integration for WordPress.', 'dracula-dark-mode'),
                'user' => 15,
                'color' => '#2FB44A',
        ],
        [
                'key' => 'radio-player',
                'title' => 'Radio Player',
                'desc' => __('Live Shoutcast, Icecast and Any Audio Stream Player for WordPress', 'dracula-dark-mode'),
                'user' => 10,
                'color' => '#9BE494',
        ],
        [
                'key' => 'essential-addons-for-contact-form-7',
                'title' => 'Essential Addons for Contact Form 7',
                'desc' => __('50+ Fields, Features & Integrations Add-ons for Contact Form 7.', 'dracula-dark-mode'),
                'user' => 1,
                'color' => '#33C6F4',
        ],
        [
                'key' => 'soft-multimedia-player',
                'title' => 'Multimedia Player',
                'desc' => __('Play Audio, Video & Podcasts Easily in WordPress.', 'dracula-dark-mode'),
                'user' => 0,
                'color' => '#0156D7',
        ],
];

?>

<div id="introduction" class="getting-started-content content-introduction active">

    <div class="content-heading overview-heading">
        <h2><?php esc_html_e('Quick', 'dracula-dark-mode'); ?>
            <mark><?php _e('Overview', 'dracula-dark-mode') ?></mark>
        </h2>
        <p><?php esc_html_e('Discover the features and benefits of Dracula Dark Mode', 'dracula-dark-mode'); ?></p>
    </div>

    <section class="section-introduction section-full">
        <div class="col-description">
            <p>
                <?php esc_html_e('Experience the future of website design with Dracula Dark Mode — the ultimate dark mode plugin for your website. Designed for simplicity and elegance, Dracula Dark Mode effortlessly transforms your site into an eye-friendly dark mode, reducing eye strain and enhancing the browsing experience for your visitors.', 'dracula-dark-mode'); ?>
            </p>
            <p>
                <?php esc_html_e('What sets Dracula Dark Mode apart is its dynamic color generator algorithm. This intelligent feature automatically calculates the optimal dark mode color scheme for your website, adapting seamlessly to your design without the need for complex configurations. It\'s not just about aesthetics — it\'s about smart, adaptive design.', 'dracula-dark-mode'); ?>
            </p>
        </div>

        <div class="col-image">

            <iframe src="https://www.youtube.com/embed/yHs8OdK-TQo?rel=0"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        </div>

    </section>

    <div class="content-heading heading-standout">
        <h2><?php printf(__('Explore The %s Standout Features %s', 'dracula-dark-mode'), '<mark>', '</mark>'); ?></h2>
        <p><?php esc_html_e('Let\'s explore the awesome features of the plugin', 'dracula-dark-mode'); ?></p>
    </div>

    <!--  Multiple Color Generator Algorithms -->
    <section class="section-reading-mode section-full">
        <div class="col-description">
            <h2><?php echo sprintf('%s <span class="badge">%s</span>', 'Multiple Color Generator Algorithms', 'New ⚡'); ?></h2>
            <p>
                <?php esc_html_e('Dracula offers two dark mode color generation algorithms: Dynamic and Static.Dynamic automatically adapts to your website’s main color for a personalized dark mode, and Static uses a fixed formula with customizable options for a consistent and balanced dark mode look.', 'dracula-dark-mode'); ?>
            </p>
        </div>

        <div class="col-image">
            <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/multiple-color-generator.png'); ?>"
                 alt="<?php esc_attr_e('Media Player', 'dracula-dark-mode'); ?>">
        </div>
    </section>

    <!--  Reading Mode -->
    <section class="section-reading-mode section-full">
        <div class="col-description">
            <h2><?php echo sprintf('%s <span class="badge">%s</span>', 'Reading Mode', 'New ⚡'); ?></h2>
            <p>
                <?php esc_html_e('Reading Mode enhances user experience by providing a distraction-free environment, removing clutter from articles and posts for improved focus. It prioritizes readability, accessibility, and ease of navigation, making it an invaluable tool for engaging and effortless content interaction.', 'dracula-dark-mode'); ?>
            </p>
        </div>

        <div class="col-image">
            <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/reading-mode.png'); ?>"
                 alt="<?php esc_attr_e('Media Player', 'dracula-dark-mode'); ?>">
        </div>
    </section>

    <div class="section-wrap">

        <!-- Frontend Dark Mode -->
        <section class="section-frontend-dark-mode section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Frontend Dark Mode', 'dracula-dark-mode'); ?></h2>

                <p>
                    <?php
                    esc_html_e('Frontend dark mode refers to the implementation of a dark color scheme on a website frontend while users interact. This feature is highly beneficial for the users, offering them a comfortable viewing experience.', 'dracula-dark-mode');
                    ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/frontend.png'); ?>">
            </div>
        </section>

        <!-- Backend Dark Mode -->
        <section class="section-dashboard-dark-mode section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Admin Dashboard Dark Mode', 'dracula-dark-mode'); ?></h2>

                <p>
                    <?php esc_attr_e('Dracula Dark Mode also allows site administrators to seamlessly enable dark mode for their admin dashboard. This provides a consistent look and feel and also help to reduce eye strain when working in the admin dashboard.', 'dracula-dark-mode'); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/dashboard.png'); ?>"
                     alt="<?php esc_attr_e('File Uploader', 'dracula-dark-mode'); ?>">
            </div>
        </section>
    </div>

    <div class="section-wrap">

        <!-- Auto Match OS Mode -->
        <section class="section-os-mode section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Auto Match OS Theme', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php esc_html_e('Dracula Dark Mode automatically detect user’s device theme and enable website them to match the user device. Users who prefer dark mode will appreciate the effortless transition and consistent experience.', 'dracula-dark-mode'); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/os.png'); ?>">
            </div>
        </section>

        <!-- Dynamic, Presets and Custom Colors -->
        <section class="section-colors section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Seamless Dark Mode Colors', 'dracula-dark-mode'); ?></h2>
                <p><?php esc_html_e('Dracula Dark Mode use a smart dynamic algorithm to effortlessly create a dark mode color scheme for your website. Additionally, the plugin offers 24+ popular color presets, with the flexibility to customize your own palette.', 'dracula-dark-mode'); ?></p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/colors.png'); ?>">
            </div>
        </section>
    </div>

    <div class="section-wrap">
        <section class="section-color-adjustment section-half">

            <!-- Color Adjustment -->
            <div class="col-description">
                <h2><?php esc_html_e('Color Adjustments', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php
                    esc_html_e('Dracula Dark Mode offers color adjustment options for its dark mode theme, including brightness, contrast, sepia and grayscale. To insure perfect match of the dark theme is with your website design.', 'dracula-dark-mode');
                    ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/adjustments.png'); ?>">
            </div>

        </section>

        <section class="section-live-edit section-half">

            <!--  Live Edit Widget -->
            <div class="col-description">
                <h2><?php esc_html_e('Dark Mode Instant Preview', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php esc_html_e('Dark Mode plugin features a live edit widget to instantly adjust and see settings like colors, buttons, and typography. Skip back-end edits and easily exclude elements or replace images. It\'s a real-time view that saves you time.', 'dracula-dark-mode'); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/live-edit.png'); ?>"
                     alt="<?php esc_attr_e('Media Player', 'dracula-dark-mode'); ?>">
            </div>
        </section>

    </div>

    <div class="section-wrap">

        <!-- Dark Mode Toggle Button -->
        <section class="section-floating-toggle section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Floating Dark Mode Toggle Button', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php esc_html_e('Dracula Dark Mode offers a floating dark mode toggle button with 14+ attractive styles that allows users to easily switch between the light and dark modes. The floating button is designed to provide a convenient and user-friendly way to access the dark mode feature, regardless of where the user is on the website.', 'dracula-dark-mode'); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/floating-toggle.png'); ?>">
            </div>
        </section>

        <!-- Display Toggle Button in Menu -->
        <section class="section-toggle-menu section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Display Toggle Button in Menu', 'dracula-dark-mode'); ?></h2>
                <p><?php esc_html_e('Dracula Dark Mode also offers to display dark mode the toggle button in the website navigation menu so that users can easily enable dark mode from the menu.', 'dracula-dark-mode'); ?></p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/menu-toggle.png'); ?>">
            </div>
        </section>
    </div>

    <div class="section-wrap">
        <section class="section-toggle-styles section-half">

            <!-- 14+ Dark Mode Toggle Button Styles -->
            <div class="col-description">
                <h2><?php esc_html_e('14+ Dark Mode Toggle Button Styles', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php
                    esc_html_e('Dracula Dark Mode offers a variety of styles for the dark mode toggle button. You can choose from 14+ different toggle button styles, which can be easily customized to match the website\'s design and branding.', 'dracula-dark-mode');
                    ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/toggle-styles.png'); ?>">
            </div>

        </section>

        <section class="section-toggle-builder section-half">

            <!--  Toggle Button Builder -->
            <div class="col-description">
                <h2><?php esc_html_e('Custom Toggle Button Designer', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php esc_html_e('Dracula Dark Mode provides a custom toggle button builder that gives you the ability to create your own customized dark mode toggle button. The Custom Toggle Button builder allows you to create a unique toggle switch button that fits seamlessly with your website\'s design and branding.', 'dracula-dark-mode'); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/toggle-builder.png'); ?>">
            </div>

        </section>
    </div>

    <div class="section-wrap">

        <!-- Image and Video Replacement -->
        <section class="section-image-video-replacement section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Image and Video Replacement', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php esc_html_e('Sometimes all the images & videos don’t look better in dark mode and you might want to replace them in dark mode. Dracula Dark Mode lets you replace the light-mode images and videos with different images and videos in dark mode. ', 'dracula-dark-mode'); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/replacements.png'); ?>">
            </div>
        </section>

        <!-- Gutenberg and Classic Editor Compatibility -->
        <section class="section-gutenberg-classic-editor-support section-half">
            <div class="col-description">
                <h2><?php esc_html_e('Classic and Block Editor Compatibility', 'dracula-dark-mode'); ?></h2>
                <p><?php esc_html_e('Dracula Dark Mode is designed to be compatible with both the classic editor and the block editor. This can be a great way to make the editing experience more comfortable for users, especially for those who spend a lot of time editing and creating content in WordPress.', 'dracula-dark-mode'); ?></p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/editor-compatibility.png'); ?>">
            </div>
        </section>
    </div>

    <div class="section-wrap">
        <!-- Page Specific Dark Mode -->
        <section class="section-toggle-styles section-half">

            <div class="col-description">
                <h2><?php esc_html_e('Page Specific Dark Mode', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php
                    esc_html_e('Dracula Dark Mode allows you to set and customize every page of your website separately with different dark mode color schemes, switch variations, typography styles, and many others settings. This gives you the flexibility and fully customize controls to present every page of your website more perfectly in dark mode.', 'dracula-dark-mode');
                    ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/page-wise-dark-mode.png'); ?>">
            </div>

        </section>

        <!-- Dark Mode Usage Analytics -->
        <section class="section-analytics section-half">

            <div class="col-description">
                <h2><?php esc_html_e('Usage Analytics Dashboard', 'dracula-dark-mode'); ?></h2>
                <p>
                    <?php
                    esc_html_e('Dracula Dark Mode provides a detailed usage analytics report that allows you to track the number of users who use the dark mode, how many times the dark mode is enabled/ disabled, and many other useful information.', 'dracula-dark-mode');
                    ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/analytics.png'); ?>">
            </div>

        </section>
    </div>

    <div class="content-heading">
        <h2><?php printf(__('Never Miss a %s Valuable Features %s', 'dracula-dark-mode'), '<mark>', '</mark>'); ?></mark></h2>
        <p><?php _e('Packed with extra features and enhancements to fine-tune your media experience.', 'dracula-dark-mode') ?></p>
    </div>

    <section class="features valuable-features">
        <?php
        $i = 0;
        foreach ($features as $key => $feature) {
            $i++;
            ?>
            <div class="feature <?php echo ($i > 9) ? 'dracula-hidden' : ''; ?>">
                <div class="feature-logo">
                    <img src="<?php echo esc_url(DRACULA_ASSETS . '/images/getting-started/features/' . $key . '.svg'); ?>">
                </div>
                <h3 class="feature-title"><?php echo esc_html($feature['title']); ?></h3>
                <p><?php echo esc_html($feature['description']); ?></p>
            </div>
        <?php } ?>

        <div class="show-all-btn-wrap">
            <button type="button" class="dracula-btn btn-primary show-all-btn" aria-label="Show All Fields">
                <i class="dashicon dashicons dashicons-arrow-down-alt2"></i>
                <?php _e('Show More Features', 'dracula-dark-mode'); ?>
            </button>
        </div>
    </section>

    <div class="content-heading">
        <h2><?php _e('Explore Our Popular Plugins', 'dracula-dark-mode') ?>
            <mark><?php esc_html_e('You Might Love.', 'dracula-dark-mode'); ?></mark>
        </h2>
        <p><?php _e('Dracula Dark Mode is developed by the same team behind some of the most popular WordPress plugins.', 'dracula-dark-mode') ?></p>
    </div>

    <div class="popular-plugins-wrap">
        <?php
        foreach ($plugins as $index => $item):
            $plugin_img_url = DRACULA_ASSETS . '/images/getting-started/plugins/' . $item['key'] . '.png';
            $install_url = esc_url(admin_url("plugin-install.php?tab=plugin-information&plugin={$item['key']}"));
            $learn_more_url = esc_url("https://softlabbd.com/{$item['key']}");
            ?>
            <div class="popular-plugin-item">
                <img src="<?php echo $plugin_img_url; ?>" alt="<?php echo esc_attr($item['title']); ?>"/>

                <div class="plugin-info">
                    <h3><?php echo esc_html($item['title']); ?></h3>
                    <p><?php echo esc_html($item['desc']); ?></p>
                    <div class="users-count" style="<?php echo '--plugin-color: ' . $item['color']; ?>">
                        <i class="dashicons dashicons-admin-users"></i>
                        <?php echo !empty($item['user']) ? sprintf('%1$sK+ Active Users', $item['user']) : __('New Plugin', 'dracula-dark-mode'); ?>
                    </div>
                </div>

                <div class="button-group">
                    <a class="dracula-btn btn-info"
                       href="<?php echo $install_url; ?>">
                        <i class="dashicons dashicons-admin-plugins"></i>
                        <?php _e('Install Now', 'dracula-dark-mode'); ?>
                    </a>

                    <a class="dracula-btn btn-primary button"
                       href="<?php echo $learn_more_url; ?>"
                       target="_blank">
                        <i class="dashicons dashicons-external"></i>
                        <?php _e('Learn More', 'dracula-dark-mode'); ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>