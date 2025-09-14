<?php

defined('ABSPATH') || exit;

class Dracula_Admin
{

    private static $instance = null;

    public $admin_pages = array(
        'toggle_builder' => '',
    );

    public function __construct()
    {
        add_action('admin_head', [$this, 'remove_admin_notices']);
        add_action('admin_menu', array($this, 'add_admin_menu'));

        $admin_dark_mode = dracula_get_settings('adminDarkMode', true);
        $classic_editor_dark_mode = dracula_get_settings('classicEditorDarkMode', false);
        $block_editor_dark_mode = dracula_get_settings('blockEditorDarkMode', false);

        if ($admin_dark_mode || $classic_editor_dark_mode || $block_editor_dark_mode) {
            add_action('admin_head', array($this, 'header_scripts'));
        }

        if ($admin_dark_mode) {

            if ('adminbar' === dracula_get_settings('adminDarkModePosition', 'adminbar')) {
                add_action('admin_bar_menu', array($this, 'add_admin_bar_menu'), 9999);
            }

            add_action('admin_init', array($this, 'add_admin_color_scheme'));
            add_action('admin_color_scheme_picker', array($this, 'add_user_profile_fields'), 11);
            add_action('personal_options_update', array($this, 'save_user_profile_fields'));

            if ('floating' === dracula_get_settings('adminDarkModePosition')) {
                add_action('admin_footer', array($this, 'render_admin_toggle'));
            }
        }

        add_action('admin_init', array($this, 'includes'));
        add_action('in_admin_header', array($this, 'remove_admin_notices'));

        // Redirect URL after activation
        ddm_fs()->add_filter('connect_url', [$this, 'redirect_after_activation']);
    }

    public function redirect_after_activation($url)
    {

        try {
            $className = 'Freemius';
            $reflector = new \ReflectionClass($className);
            $file = $reflector->getFileName();

            // Return original URL if file is not found or not inside 'dracula-dark-mode' directory
            if ($file === false || strpos($file, 'dracula-dark-mode') === false) {
                return $url;
            }

        } catch (\ReflectionException $e) {
            // Optionally log the error here for debugging
            return $url;
        }

        if (ddm_fs()->is_premium()) {
            return $url;
        }

        // Parse the URL into its components
        $url_parts = wp_parse_url($url);

        // Parse existing query parameters into an array, or initialize empty if none
        $query_params = [];
        if (!empty($url_parts['query'])) {
            parse_str($url_parts['query'], $query_params);
        }

        // Set or replace the 'page' parameter
        $query_params['page'] = 'dracula-getting-started';

        // Rebuild the query string with updated parameters
        $url_parts['query'] = http_build_query($query_params);

        // Rebuild the full URL safely
        $new_url = $url_parts['scheme'] . '://' . $url_parts['host'];

        if (!empty($url_parts['path'])) {
            $new_url .= $url_parts['path'];
        }

        if (!empty($url_parts['query'])) {
            $new_url .= '?' . $url_parts['query'];
        }

        if (!empty($url_parts['fragment'])) {
            $new_url .= '#' . $url_parts['fragment'];
        }


        // Escape the URL before returning
        return esc_url_raw($new_url);
    }

    public function remove_admin_notices()
    {
        global $current_screen;

        if (!empty($current_screen) && !in_array($current_screen->id, [
                'dracula_page_dracula-getting-started',
                'dracula_page_dracula-toggle-builder',
                'toplevel_page_dracula',
            ])) {
            return;
        }

        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');

        add_filter('admin_footer_text', '__return_empty_string');
        add_filter('update_footer', '__return_empty_string');
    }

    public function add_user_profile_fields($user_id)
    {
        if (!dracula_is_user_dark_mode()) {
            return;
        }

        $profile_user = get_userdata($user_id);

        ?>
        <tr class="show-admin-bar user-admin-bar-front-wrap">
            <th scope="row"><?php _e('Show Dark Mode Toggle', 'dracula-dark-mode'); ?></th>
            <td>
                <label for="admin_bar_toggle">
                    <input name="admin_bar_toggle" type="checkbox" id="admin_bar_toggle"
                           value="on"<?php checked('off' != $profile_user->admin_bar_toggle); ?> />
                    <?php _e('Show dark mode toggle in the top admin bar.', 'dracula-dark-mode'); ?>
                </label><br/>
            </td>
        </tr>
    <?php }

    public function save_user_profile_fields($user_id)
    {
        if (!dracula_is_user_dark_mode()) {
            return;
        }

        if (!current_user_can('edit_user', $user_id)) {
            return;
        }

        $admin_bar_toggle = isset($_POST['admin_bar_toggle']) ? 'on' : 'off';

        update_user_meta($user_id, 'admin_bar_toggle', $admin_bar_toggle);
    }

    public function includes()
    {
        $is_user_dark_mode = dracula_is_user_dark_mode();
        $dashboard_dark_mode = dracula_get_settings('adminDarkMode', true);
        $classic_editor_dark_mode = dracula_get_settings('classicEditorDarkMode', true);

        if ($is_user_dark_mode && $dashboard_dark_mode && $classic_editor_dark_mode) {
            include_once DRACULA_INCLUDES . '/class-tinymce.php';
        }
    }

    public function header_scripts()
    { ?>

        <script>
            const savedMode = localStorage.getItem('dracula_mode_admin');

            if (savedMode) {
                window.draculaMode = savedMode;
            }

            if ('dark' === window.draculaMode) {
                window.draculaDarkMode.enable();
            } else if ('auto' === window.draculaMode) {
                window.draculaDarkMode.auto();
            }

        </script>
        <?php
    }

    public function add_admin_color_scheme()
    {
        if (!dracula_is_user_dark_mode()) {
            return;
        }

        $admin_background_color = dracula_get_settings('adminBackgroundColor', '#181a1b');
        $admin_text_color = dracula_get_settings('adminTextColor', '#e8e6e3');

        wp_admin_css_color('z_dracula', __('Dark Mode', 'dracula-dark-mode'), '', [
            $admin_background_color,
            $admin_text_color
        ], '');
    }

    public function add_admin_bar_menu($wp_admin_bar)
    {

        if ($this->should_exclude_darkmode()) {
            return;
        }

        $user_id = get_current_user_id();

        if (!$user_id) {
            return;
        }

        $admin_bar_toggle = get_user_meta($user_id, 'admin_bar_toggle', true);
        if ($admin_bar_toggle == 'off') {
            return;
        }

        $args = [
            'parent' => 'top-secondary',
            'id' => 'dracula',
            'title' => <<<HTML
    <button
        class="dracula-toggle admin-menu-item dracula-ignore style-14"
        onclick="draculaDarkMode.toggle()"
    >
        <i class="dracula-toggle-icon"></i>
    </button>
HTML
            ,
        ];

        $wp_admin_bar->add_node($args);
    }

    public function render_admin_toggle()
    {

        if ($this->should_exclude_darkmode()) {
            return;
        }

        echo <<<HTML
<div class="dracula-toggle-wrap floating position-right">
        <button
            class="dracula-toggle dracula-ignore style-2"
            onclick="draculaDarkMode.toggle()"
         >
            <div class="dracula-toggle-icon-wrap">
                <div class="dracula-toggle-icon"></div>
            </div>

            <div class="dracula-toggle-label">
                <span class="--light">Light</span>
                <span class="--dark">Dark</span>
            </div>
        </button>
</div>
HTML;

    }

    public function add_admin_menu()
    {
        $this->admin_pages['dracula'] = add_menu_page('Dracula Dark Mode', 'Dark Mode', 'manage_options', 'dracula', array(
            $this,
            'admin_page'
        ), DRACULA_ASSETS . '/images/dracula-icon.svg', 50);

        // Settings Page
        $this->admin_pages['settings'] = add_submenu_page('dracula', __('Settings - Dracula', 'dracula-dark-mode'), __('Settings', 'dracula-dark-mode'), 'manage_options', 'dracula');

        // Toggle Builder Page
        $this->admin_pages['toggle_builder'] = add_submenu_page('dracula', __('Toggle Builder - Dracula', 'dracula-dark-mode'), __('Toggle Builder', 'dracula-dark-mode'), 'manage_options', 'dracula-toggle-builder', array(
            'Dracula_Toggle_Builder',
            'view'
        ));

        // Getting Started Page
        $this->admin_pages['getting_started'] = add_submenu_page('dracula', __('Getting Started - Dracula', 'dracula-dark-mode'), __('Getting Started', 'dracula-dark-mode'), 'manage_options', 'dracula-getting-started', array(
            $this,
            'render_getting_started_page'
        ));

        do_action('dracula_admin_menu', $this);

    }

    public function render_getting_started_page()
    {


        if (isset($_GET['setup_complete'])) {
            update_option('dracula_setup_complete', true);
        }

        if (get_option('dracula_setup_complete', false)) {
            include_once DRACULA_INCLUDES . '/views/getting-started/index.php';
        } else {
            include_once DRACULA_INCLUDES . '/views/setup.php';
        }

    }


    public function admin_page()
    {
        ?>
        <div id="dracula-settings-app"></div>
    <?php }

    public function get_admin_pages()
    {
        return $this->admin_pages;
    }

    /**
     * Whether Dark Mode should be excluded (e.g., during onboarding).
     */
    public function should_exclude_darkmode(): bool
    {
        // Only relevant in wp-admin with screens available.
        if (!is_admin() || !function_exists('get_current_screen')) {
            return false;
        }

        $screen = get_current_screen();
        if (!$screen || empty($screen->id)) {
            return false;
        }

        if ($screen->id === 'dark-mode_page_dracula-getting-started') {
            // Exclude until setup is complete.
            return !(bool)get_option('dracula_setup_complete', false);
        }

        return false;
    }


    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}

Dracula_Admin::instance();