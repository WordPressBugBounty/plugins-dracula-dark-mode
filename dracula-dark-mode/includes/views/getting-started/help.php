<?php

$faqs = [
    [
        'question' => __('1. I have a pre-sale question. How can I get support?', 'dracula-dark-mode'),
        'answer'    => sprintf(
            '%s <a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
            __('For any pre-sale inquiries, please contact us directly by submitting a form here: ', 'dracula-dark-mode'),
            'https://softlabbd.com/support/',
            __('Contact Us.', 'dracula-dark-mode')
        ),
    ],

    [
        'question' => __('2. I have purchased a plan, but it still shows the free plan. What should I do?', 'dracula-dark-mode'),
        'answer'    => sprintf(
            '%s <a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
            __('After purchase, you should receive a confirmation email containing the PRO download link and license key. If you did not receive it due to email delivery issues, you can access your PRO download and license key from the ', 'dracula-dark-mode'),
            'https://users.freemius.com/store/1760/',
            __('Freemius Customer Portal.', 'dracula-dark-mode')
        ),
    ],

    [
        'question' => __('3. Where can I find the PRO download link and license key?', 'dracula-dark-mode'),
        'answer'    => __('After purchasing the PRO plugin, download and install it on your website. Deactivate the Free plugin first (your data will remain intact). Once the PRO plugin is installed, activate your license key. For details on where to find the download link and license key, refer to the related FAQ.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('4. Can I use the same license key on my production, staging, and development sites?', 'dracula-dark-mode'),
        'answer'    => <<<HTML
            <p>If you’re using a staging or localhost site alongside your live site, you may use the same license key for all, provided the domain clearly identifies as a dev or staging environment.</p>

            <p>Whitelisted TLDs considered as dev or staging:</p>
            <ul>
                <li><code>*.dev</code></li>
                <li><code>*.dev.cc</code> (DesktopServer)</li>
                <li><code>*.test</code></li>
                <li><code>*.local</code></li>
                <li><code>*.staging</code></li>
                <li><code>*.example</code></li>
                <li><code>*.invalid</code></li>
            </ul>

            <p>Whitelisted subdomains considered as dev or staging:</p>
            <ul>
                <li><code>local.*</code></li>
                <li><code>dev.*</code></li>
                <li><code>test.*</code></li>
                <li><code>stage.*</code></li>
                <li><code>staging.*</code></li>
                <li><code>stagingN.*</code> (SiteGround; N is an unsigned int)</li>
                <li><code>*.myftpupload.com</code> (GoDaddy)</li>
                <li><code>*.cloudwaysapps.com</code> (Cloudways)</li>
                <li><code>*.wpsandbox.pro</code> (WPSandbox)</li>
                <li><code>*.ngrok.io</code> (tunneling)</li>
                <li><code>*.mystagingwebsite.com</code> (Pressable)</li>
                <li><code>*.tempurl.host</code> (WPMU DEV)</li>
                <li><code>*.wpmudev.host</code> (WPMU DEV)</li>
                <li><code>*.websitepro-staging.com</code> (Vendasta)</li>
                <li><code>*.websitepro.hosting</code> (Vendasta)</li>
                <li><code>*.instawp.xyz</code> (InstaWP)</li>
                <li><code>*.wpengine.com</code> (WP Engine)</li>
                <li><code>*.wpenginepowered.com</code> (WP Engine)</li>
                <li><code>dev-*.pantheonsite.io</code> (Pantheon)</li>
                <li><code>test-*.pantheonsite.io</code> (Pantheon)</li>
                <li><code>staging-*.kinsta.com</code> (Kinsta)</li>
                <li><code>staging-*.kinsta.cloud</code> (Kinsta)</li>
                <li><code>*-dev.10web.site</code> (10Web)</li>
                <li><code>*-dev.10web.cloud</code> (10Web)</li>
            </ul>

            <p>Domains using <code>localhost</code> (any port) are also treated as localhost domains.</p>

            <p>If your dev site’s domain does not match these, you can deactivate the license from the Account page in your WP Admin dashboard, and then reuse it on your staging or dev site.</p>
            HTML
    ],

    [
        'question' => __('05. Can I try a live demo version of the plugin?', 'dracula-dark-mode'),
        'answer'   => sprintf(
            __('Yes! You can try the ready-made live demo of the PRO plugin to explore all features on both Front-End and Back-End. %s', 'dracula-dark-mode'),
            '<a href="https://demo.softlabbd.com/?product=dracula-dark-mode" target="_blank" rel="noopener noreferrer">Try Live Demo</a>'
        ),
    ],

    [
        'question' => __('06. Is a trial version of the PRO plugin available?', 'dracula-dark-mode'),
        'answer'   => sprintf(
            __('Yes, we offer a 3-day trial period for the PRO plugin, allowing you to test its full capabilities on your website before purchase. No payment method is required. Get your trial here: %s', 'dracula-dark-mode'),
            '<a href="' . ddm_fs()->get_trial_url() . '" target="_blank" rel="noopener noreferrer">Get Trial Version</a>'
        ),
    ],

    [
        'question' => __('07. Does Dracula Dark Mode works with all WordPress themes?', 'dracula-dark-mode'),
        'answer'   => __('Yes, Dracula Dark Mode has been built to be compatible with all the popular themes like Divi, Avada, Astra, Generatepress, and almost every WordPress compatibility themes.', 'dracula-dark-mode'),
    ],
    [
        'question' => __('08. Can I display dark mode toggle button in menu?', 'dracula-dark-mode'),
        'answer'   => __('Yes, you can display the toggle switch button in any menu of your website. Even you can set the positions of the toggle button at the start or end of the menu.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('09. Can I create & customize my own custom toggle button?', 'dracula-dark-mode'),
        'answer'   => __('Yes, you can create your fully customized own custom toggle button using the Toggle Button builder and display it anywhere on your website using the shortcode. You can also customize the switch color, text, layout, icons and many other options.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('10. Can I replace light mode images & videos in dark mode?', 'dracula-dark-mode'),
        'answer'   => __('Dracula Dark Mode provides an advanced image & video replacement feature where you can replace any light mode images &  any self-hosted, Youtube, Vimeo, or DailyMotion videos in dark mode.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('11. Can I exclude certain sections/ elements in a  page from being affected by the dark mode?', 'dracula-dark-mode'),
        'answer'   => __('Yes, you can exclude certain sections or elements on any page to keep them from being affected by dark mode. You have to use proper CSS selectors for the elements in the Excludes settings to exclude them from the dark mode. Even you can also exclude them by just clicking on the elements when you are in live edit dark mode.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('12. Can I use dark mode on Admin Dashboard?', 'dracula-dark-mode'),
        'answer'   => __('Yes, Dracula Dark Mode allows site admins to enable and use dark mode in their admin dashboard. You can also allow the admin dashboard dark mode based on specific user roles (Administrator, Editor, Subscriber, etc). ', 'dracula-dark-mode'),
    ],

    [
        'question' => __('13. Can I exclude specific posts or pages from dark mode?', 'dracula-dark-mode'),
        'answer'   => __('Yes, Dracula Dark Mode allows you to exclude certain pages, posts, or any custom post types from dark mode from the Excludes settings.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('14. Can I schedule dark mode to turn on and off automatically based on a specific time?', 'dracula-dark-mode'),
        'answer'   => __('Yes, you can schedule dark mode to turn it on and off automatically based on your selected time. This setting will work based on the user\'s device time zone.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('15. Can I set different color schemes for different pages?', 'dracula-dark-mode'),
        'answer'   => __('Yes, you can set different color schemes for different pages by using our page-wise dark mode feature. Using the page-wise dark mode you can use different color schemes for each page to improve your brand image.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('16. Will Dracula Dark Mode plugin slow my website loading speed?', 'dracula-dark-mode'),
        'answer'   => __('Dracula Dark Mode may have a minimal impact on your site load speed. But we have given ‘Performance Mode’ settings which will improve your website speed loading scripts in a deferred manner to reduce the initial page load time and improve overall website performance.', 'dracula-dark-mode'),
    ],

    [
        'question' => __('17. Why Dark Mode not working properly with caching plugins (WP Rocket, W3 Total Cache, WP Super Cache, LiteSpeed Cache, WP-Optimize, etc)?', 'dracula-dark-mode'),
        'answer'   => __('Dracula Dark Mode plugin relies on multiple JavaScript files and dependencies to work properly. So, if you are using any caching plugins, you have to disable the JavaScript deferred/ delay/ lazy load settings from the caching plugins to make the dark mode work properly.', 'dracula-dark-mode'),
    ],

];

?>


<div id="help" class="dracula-help getting-started-content">

    <div class="content-heading overview-heading">
        <h2><?php esc_html_e('Frequently Asked', 'dracula-dark-mode'); ?><mark><?php _e('Questions', 'dracula-dark-mode'); ?></mark></h2>
        <p><?php esc_html_e('Find quick answers to common queries in our FAQ section.', 'dracula-dark-mode'); ?></p>
    </div>

    <section class="section-faq">
        <?php foreach ($faqs as $faq) : ?>
            <div class="faq-item">
                <div class="faq-header">
                    <i class="dashicons dashicons-arrow-down-alt2"></i>
                    <h3><?php echo esc_html($faq['question']); ?></h3>
                </div>

                <div class="faq-body">
                    <p><?php echo $faq['answer']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <div class="content-heading heading-overview">
        <h2><?php esc_html_e('Video ', 'integrate-google-drive'); ?>
            <mark><?php esc_html_e('Tutorials', 'integrate-google-drive'); ?></mark>
        </h2>
        <p><?php esc_html_e('Watch our detailed video tutorials to easily master the plugin—from setup to advanced features.', 'integrate-google-drive'); ?></p>
    </div>

    <section class="section-video-tutorials section-half">
        <div class="col-image">
            <iframe src="https://www.youtube.com/embed/videoseries?list=PLaR5hjDXnXZzB_t1OoEGai98qfwpYqRYD&rel=0"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </section>

    <div class="content-heading heading-overview">
        <h2><?php esc_html_e('Need', 'dracula-dark-mode'); ?><mark><?php esc_html_e('Help?', 'dracula-dark-mode'); ?></mark></h2>
        <p><?php esc_html_e('Read our knowledge base documentation or you can contact us directly.', 'dracula-dark-mode'); ?></p>
    </div>

    <div class="section-wrap">
        <section class="section-documentation section-half">
            <div class="col-image">
                <img src="<?php echo esc_attr(DRACULA_ASSETS . '/images/getting-started/documentation.png'); ?>"
                    alt="<?php esc_attr_e('Documentation', 'dracula-dark-mode'); ?>">
            </div>
            <div class="col-description">
                <h2><?php _e('Documentation', 'dracula-dark-mode') ?></h2>
                <p>
                    <?php esc_html_e('Check out our detailed online documentation and video tutorials to find out more about what you can do.', 'dracula-dark-mode'); ?>
                </p>
                <a class="dracula-btn btn-primary" href="https://softlabbd.com/docs-category/dracula-dark-mode-docs/" target="_blank">
                    <i class="dashicons dashicons-editor-help"></i>
                    <?php esc_html_e('Documentation', 'dracula-dark-mode'); ?>
                </a>
            </div>
        </section>

        <section class="section-contact section-half">
            <div class="col-image">
                <img src="<?php echo esc_attr(DRACULA_ASSETS . '/images/getting-started/contact.png'); ?>"
                    alt="<?php esc_attr_e('Get Support', 'dracula-dark-mode'); ?>">
            </div>
            <div class="col-description">
                <h2><?php esc_html_e('Support', 'dracula-dark-mode'); ?></h2>
                <p><?php esc_html_e('We have dedicated support team to provide you fast, friendly & top-notch customer support.', 'dracula-dark-mode'); ?></p>

                <a class="dracula-btn btn-primary" href="https://softlabbd.com/support" target="_blank">
                    <i class="dashicons dashicons-sos"></i>
                    <?php esc_html_e('Get Support', 'dracula-dark-mode'); ?>
                </a>
            </div>
        </section>
    </div>

    <section class="facebook-cta">
        <img src="<?php echo DRACULA_ASSETS . '/images/getting-started/facebook-icon.png'; ?>" />

        <div class="cta-content">
            <h2><?php esc_html_e('Join our Facebook community?', 'dracula-dark-mode'); ?></h2>
            <p>
                <?php esc_html_e('Discuss, and share your problems & solutions for the Dracula Dark Mode WordPress plugin. Let\'s make a better community, share ideas, solve problems and finally build good relations.', 'dracula-dark-mode'); ?>
            </p>
        </div>

        <div class="cta-btn">
            <a href="https://www.facebook.com/groups/dracula.dark.mode" class="dracula-btn btn-primary"
                target="_blank"><?php esc_html_e('Join Now', 'dracula-dark-mode'); ?></a>
        </div>

    </section>

</div>

<script>
    jQuery(document).ready(function($) {
        $('.dracula-help .faq-item .faq-header').on('click', function() {
            $(this).parent().toggleClass('active');
        });
    });
</script>