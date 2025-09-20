<?php

defined('ABSPATH') || exit;

$logs = [
        'v1.3.1' => [
                'date' => '2025-09-20',
                'fix' => [
                        'Fixed text highlight color issue.',
                        'Fixed toggle switch dragging issue.',
                ],
                'enhancement' => [
                        'Improved toggle display option in nav menus.',
                        'Improved overall performance and speed.',
                ],
        ],
        'v1.2.9' => [
                'date' => '2025-07-13',
                'new' => [
                        'Added new static color generator algorithm for dark mode.',
                        'Added initial quick setup wizard after plugin activation.',
                        'Added border color option for custom presets.',
                ],
                'enhancement' => [
                        'Enhanced overall plugin performance by reducing CSS/JS file sizes and optimizing the codebase.',
                ],
        ],
        'v1.2.8' => [
                'date' => '2025-07-13',
                'new' => [
                        'Added an option to display the toggle switch after a delay.',
                ],
                'fix' => [
                        'Fixed Background Image replacement',
                ],
        ],
        'v1.2.7' => [
                'date' => '2025-01-26',
                'new' => [
                        'Added custom element trigger option to toggle dark mode.',
                ],
                'fix' => [
                        'Fixed conflicts with the Dark Reader browser extension.',
                ],
        ],
        'v1.2.6' => [
                'date' => '2024-11-24',
                'new' => [
                        'Added aria-label attribute to the toggle button.',
                ],
                'enhancement' => [
                        'Updated Tested up to version to the latest WordPress version.',
                ],
        ],
        'v1.2.4' => [
                'date' => '2024-09-09',
                'new' => [
                        'Added floating toggle position setting for admin dashboard dark mode.',
                        'Added keyboard accessible supports for the dark mode toggle buttons.',
                        'Added hide elements settings to hide any specific elements in a post/ page in dark mode.',
                ],
                'fix' => [
                        'Fixed string not translate-able issue.',
                ],
                'enhancement' => [
                        'Improved overall plugin performance & security.',
                ],
        ],
        'v1.2.3' => [
                'date' => '2024-08-14',
                'fix' => [
                        'Fixed toggle style 14 auto-dark transition based on the system dark mode selection.',
                ],
                'enhancement' => [
                        'Added support for the latest WordPress version 6.6.1',
                        'Improved overall plugin performance & security.',
                ],
        ],
        'v1.2.1' => [
                'date' => '2024-04-30',
                'new' => [
                        'Added new adjustable dark mode toggle switch buttons.',
                        'Added absolute switch position.',
                ],
                'fix' => [
                        'Fixed conflicts with Reader Mode browser extension.',
                ],
                'enhancement' => [
                        'Improved dark mode algorithm.',
                        'Optimized dark mode script loading.',
                ],
        ],
        'v1.2.0' => [
                'date' => '2023-03-13',
                'new' => [
                        'Added custom dark mode color presets builder.',
                        'Added excludes settings for Reading Mode.',
                        'Added Exclude Taxonomies settings to exclude posts from dark-mode.',
                        'Added move icon for draggable toggle.',
                        'Added Reading Mode button label text show/hide option.',
                        'Added option to enable/disable the auto-save settings.',
                ],
                'fix' => [
                        'Fixed shortcode not rendering in the reading mode content.',
                        'Fixed Menu toggle size not working in the free version',
                        'Fixed Reading Mode progress bar display issue.'
                ],
                'enhancement' => [
                        'Improved dark mode algorithm',
                        'Improved overall plugin performance & security.',
                ],
        ],

];


?>

<div id="what-new" class="getting-started-content content-what-new">
    <div class="content-heading overview-heading">
        <h2><?php esc_html_e('What\'s New in the', 'dracula-dark-mode'); ?>
            <mark><?php _e('Latest Changes', 'dracula-dark-mode'); ?></mark>
        </h2>
        <p><?php esc_html_e('Check out the latest change logs.', 'dracula-dark-mode'); ?></p>
    </div>

    <?php
    $i = 0;
    foreach (
            $logs

            as $v => $log
    ) { ?>
        <div class="log <?php echo esc_attr($i == 0 ? 'active' : ''); ?>">
            <div class="log-header">
                <span class="log-version"><?php echo esc_html($v); ?></span>
                <span class="log-date">(<?php echo esc_html($log['date']); ?>)</span>

                <i class="<?php echo esc_attr($i == 0 ? 'dashicons-arrow-up-alt2' : 'dashicons-arrow-down-alt2'); ?> dashicons "></i>
            </div>

            <div class="log-body">
                <?php

                if (!empty($log['new'])) { ?>
                    <div class="log-section new"><h3><?php esc_html_e('New Features', 'dracula-dark-mode'); ?></h3>
                        <?php
                        foreach ($log['new'] as $item) {
                            printf('<div class="log-item log-item-new"><i class="dashicons dashicons-plus-alt2"></i> <span>%s</span></div>', $item);
                        }
                        ?>
                    </div>
                    <?php
                }

                if (!empty($log['fix'])) { ?>
                    <div class="log-section fix"><h3><?php esc_html_e('Fixes', 'dracula-dark-mode'); ?></h3>
                        <?php
                        foreach ($log['fix'] as $item) {
                            printf('<div class="log-item log-item-fix"><i class="dashicons dashicons-saved"></i> <span>%s</span></div>', $item);
                        }
                        ?>
                    </div>
                <?php }

                if (!empty($log['enhancement'])) { ?>
                    <div class="log-section enhancement">
                        <h3><?php esc_html_e('Enhancements', 'dracula-dark-mode'); ?></h3>
                        <?php
                        foreach ($log['enhancement'] as $item) {
                            printf('<div class="log-item log-item-enhancement"><i class="dashicons dashicons-star-filled"></i> <span>%s</span></div>', $item);
                        }
                        ?>
                    </div>
                <?php }

                if (!empty($log['remove'])) { ?>
                    <div class="log-section remove"><h3><?php esc_html_e('Removes', 'dracula-dark-mode'); ?></h3>
                        <?php
                        foreach ($log['remove'] as $item) {
                            printf('<div class="log-item log-item-remove"><i class="dashicons dashicons-trash"></i> <span>%s</span></div>', $item);
                        }
                        ?>
                    </div>
                <?php } ?>


                <?php if (!empty($log['video'])) { ?>
                    <div class="log-section video">
                        <h3><?php esc_html_e('Video Overview', 'dracula-dark-mode'); ?></h3>
                        <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/<?php echo esc_attr($log['video']); ?>?si=qh1HTaq7Hitsi2Ld&rel=0"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                    </div>
                <?php } ?>


            </div>

        </div>
        <?php
        $i++;
    } ?>


</div>


<script>
    jQuery(document).ready(function ($) {
        $('.log-header').on('click', function () {
            $(this).next('.log-body').slideToggle();
            $(this).find('i').toggleClass('dashicons-arrow-down-alt2 dashicons-arrow-up-alt2');
            $(this).parent().toggleClass('active');
        });
    });
</script>