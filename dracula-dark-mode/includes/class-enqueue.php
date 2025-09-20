<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
class Dracula_Enqueue {
    private static $instance = null;

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array($this, 'frontend_scripts'), 999 );
        add_action( 'login_enqueue_scripts', array($this, 'frontend_scripts') );
        add_action( 'enqueue_block_assets', array($this, 'frontend_scripts') );
        add_action( 'admin_enqueue_scripts', array($this, 'admin_scripts') );
    }

    public function frontend_scripts() {
        wp_register_style(
            'dracula-dark-mode',
            DRACULA_ASSETS . '/css/dark-mode.css',
            array(),
            DRACULA_VERSION
        );
        wp_register_style(
            'dracula-frontend',
            DRACULA_ASSETS . '/css/frontend.css',
            array(),
            DRACULA_VERSION
        );
        wp_style_add_data( 'dracula-frontend', 'rtl', 'replace' );
        $custom_css = $this->get_custom_css();
        wp_add_inline_style( 'dracula-frontend', $custom_css );
        // JS Scripts
        $deps = ['wp-i18n', 'wp-util'];
        $color_type = dracula_get_settings( 'colorType', 'dynamic' );
        wp_register_script(
            'dracula-dark-mode',
            DRACULA_ASSETS . '/js/' . (( $color_type === 'dynamic' ? 'dark-mode' : 'dark-mode-static' )) . '.js',
            [],
            DRACULA_VERSION
        );
        $deps[] = 'dracula-dark-mode';
        $deps = apply_filters( 'dracula_frontend_scripts_deps', $deps );
        wp_register_script(
            'dracula-frontend',
            DRACULA_ASSETS . '/js/frontend.js',
            $deps,
            DRACULA_VERSION,
            true
        );
        wp_localize_script( 'dracula-frontend', 'dracula', $this->get_localize_data() );
        wp_localize_script( 'dracula-dark-mode', 'dracula', $this->get_localize_data() );
        $is_active = dracula_get_settings( 'frontendDarkMode', true ) && !dracula_page_excluded();
        // Live Edit && Setup Scripts
        if ( ddm_fs()->can_use_premium_code__premium_only() || dracula_is_elementor_editor_page() || dracula_is_embed_request() ) {
            $is_live_edit_request = !empty( $_GET['dracula-live-edit'] );
            $is_admin_user = current_user_can( 'manage_options' );
            $is_live_edit = $is_admin_user && ($is_active || $is_live_edit_request);
            if ( $is_live_edit || dracula_is_elementor_editor_page() || dracula_is_embed_request() ) {
                $this->enqueue_live_edit_scripts();
            }
        }
        $is_reading_mode = dracula_get_settings( 'readingMode' );
        // Custom Dark Mode Style
        if ( $color_type === 'static' || 'custom' === dracula_get_settings( 'colorMode' ) ) {
            wp_enqueue_style( 'dracula-dark-mode' );
        }
        // Frontend Scripts
        if ( $is_active || $is_reading_mode ) {
            wp_enqueue_style( 'dracula-frontend' );
            wp_enqueue_script( 'dracula-frontend' );
            // Link the script with its translations.
            wp_set_script_translations( 'dracula-frontend', 'dracula-dark-mode', plugin_dir_path( DRACULA_FILE ) . 'languages' );
        }
    }

    public function admin_scripts( $hook ) {
        // Check if user can access dracula pages
        if ( !dracula_is_user_dark_mode() && !dracula_is_block_editor_page() ) {
            return;
        }
        if ( !class_exists( 'Dracula_Admin' ) ) {
            require_once DRACULA_INCLUDES . '/class-admin.php';
        }
        $admin_pages = Dracula_Admin::instance()->get_admin_pages();
        // By default, style id startWith dracula- ignored by dark mode.
        // that why we need to add dracula_ prefix to the selector where we don't want to ignore dark mode
        wp_register_style(
            'dracula_sweetalert2',
            DRACULA_ASSETS . '/vendor/sweetalert2/sweetalert2.min.css',
            [],
            DRACULA_VERSION
        );
        // Ignore toggle styles from dark mode
        wp_register_style(
            'dracula-toggle',
            DRACULA_ASSETS . '/css/toggle.css',
            array(),
            DRACULA_VERSION
        );
        wp_enqueue_style(
            'dracula_admin',
            DRACULA_ASSETS . '/css/admin.css',
            array('wp-components', 'dracula-toggle', 'dracula_sweetalert2'),
            DRACULA_VERSION
        );
        wp_style_add_data( 'dracula_admin', 'rtl', 'replace' );
        // Javascript Dependencies
        $deps = [
            'react',
            'react-dom',
            'wp-components',
            'wp-i18n',
            'wp-util'
        ];
        if ( !Dracula_Admin::instance()->should_exclude_darkmode() ) {
            wp_register_script(
                'dracula-dark-mode',
                DRACULA_ASSETS . '/js/dark-mode.js',
                [],
                DRACULA_VERSION
            );
            $deps[] = 'dracula-dark-mode';
        }
        // If block editor page and !active return
        $block_editor_dark_mode = dracula_get_settings( 'blockEditorDarkMode', true );
        if ( !$block_editor_dark_mode && dracula_is_block_editor_page() ) {
            $deps = array_diff( $deps, ['dracula-dark-mode'] );
        }
        // Analytics page scripts
        if ( !empty( $admin_pages['analytics'] ) && $admin_pages['analytics'] === $hook ) {
            wp_register_script(
                'dracula-chart',
                DRACULA_ASSETS . '/vendor/chart.js',
                array('jquery-ui-datepicker'),
                DRACULA_VERSION,
                true
            );
            $deps[] = 'dracula-chart';
        }
        wp_register_script(
            'dracula-sweetalert2',
            DRACULA_ASSETS . '/vendor/sweetalert2/sweetalert2.min.js',
            [],
            DRACULA_VERSION,
            true
        );
        $deps[] = 'dracula-sweetalert2';
        // Enqueue media scripts for settings and toggle builder page
        if ( in_array( $hook, [$admin_pages['settings'], $admin_pages['toggle_builder']] ) ) {
            wp_enqueue_media();
        }
        // CSS Editor Scripts
        if ( $admin_pages['dracula'] === $hook || dracula_is_block_editor_page() || dracula_is_classic_editor_page() ) {
            wp_enqueue_script( 'wp-theme-plugin-editor' );
            wp_enqueue_style( 'wp-codemirror' );
            wp_enqueue_code_editor( array(
                'type'  => 'text/css',
                'theme' => 'dracula',
            ) );
        }
        wp_enqueue_script(
            'dracula-admin',
            DRACULA_ASSETS . '/js/admin.js',
            $deps,
            DRACULA_VERSION,
            true
        );
        wp_localize_script( 'dracula-admin', 'dracula', $this->get_localize_data( $hook ) );
        wp_localize_script( 'dracula-dark-mode', 'dracula', $this->get_localize_data( $hook ) );
        // Link the script with its translations.
        wp_set_script_translations( 'dracula-admin', 'dracula-dark-mode', plugin_dir_path( DRACULA_FILE ) . 'languages' );
    }

    public function enqueue_live_edit_scripts() {
        wp_enqueue_style(
            'dracula-live-edit',
            DRACULA_ASSETS . '/css/live-edit.css',
            [
                'dashicons',
                'wp-components',
                'dracula-frontend',
                'dracula_sweetalert2',
                'wp-codemirror'
            ],
            DRACULA_VERSION
        );
        wp_enqueue_media();
        wp_enqueue_script( 'dracula-sweetalert2' );
        wp_enqueue_script( 'wp-theme-plugin-editor' );
        $cm_settings = [
            'codeEditor' => wp_enqueue_code_editor( array(
                'type'  => 'text/css',
                'theme' => 'dracula',
            ) ),
        ];
        wp_localize_script( 'dracula-frontend', 'cm_settings', $cm_settings );
        wp_enqueue_script(
            'dracula-live-edit',
            DRACULA_ASSETS . '/js/live-edit.js',
            ['wp-components', 'dracula-frontend'],
            DRACULA_VERSION,
            true
        );
    }

    public function get_localize_data( $hook = false ) {
        $data = array(
            'homeUrl'        => home_url(),
            'adminUrl'       => admin_url(),
            'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
            'pluginUrl'      => DRACULA_URL,
            'settings'       => dracula_get_settings(),
            'isPro'          => ddm_fs()->can_use_premium_code__premium_only(),
            'upgradeUrl'     => ddm_fs()->get_upgrade_url(),
            'nonce'          => wp_create_nonce( 'dracula' ),
            'switches'       => dracula_get_switches_markups(),
            'customSwitches' => dracula_custom_toggle_switches(),
            'presets'        => dracula_get_preset(),
        );
        if ( is_admin() ) {
            $data['isAdmin'] = true;
            $admin_pages = Dracula_Admin::instance()->get_admin_pages();
            if ( $admin_pages['dracula'] === $hook ) {
                $data['isBlockTheme'] = function_exists( 'wp_is_block_theme' ) && wp_is_block_theme();
                $data['userRoles'] = dracula_get_user_roles();
                $data['excludeList'] = dracula_get_exclude_list();
                $data['excludeReadingList'] = dracula_get_exclude_reading_list();
                $data['excludeTaxList'] = dracula_get_exclude_taxonomy_list();
                $data['showReviewPopup'] = current_user_can( 'manage_options' ) && 'off' != get_option( 'dracula_rating_notice' ) && 'off' != get_transient( 'dracula_rating_notice_interval' );
                $data['postTypes'] = dracula_get_post_type_list();
            }
        }
        $is_active = dracula_get_settings( 'frontendDarkMode', true ) && !dracula_page_excluded();
        $is_live_edit = current_user_can( 'manage_options' ) && ($is_active || !empty( $_GET['dracula-live-edit'] ));
        $is_editor = dracula_is_block_editor_page() || dracula_is_classic_editor_page() || dracula_is_elementor_editor_page();
        if ( $is_live_edit || $is_editor ) {
        }
        return $data;
    }

    /**
     * Custom css
     */
    public function get_custom_css() {
        $custom_css = '';
        // General Button
        $buttonAlignment = dracula_get_settings( 'buttonAlignment', 'start' );
        $button_variable = sprintf( '--reading-mode-button-alignment: %s !important;', $buttonAlignment );
        $custom_css .= sprintf( '.reading-mode-buttons { %s }', $button_variable );
        // Reading Mode CSS Variable
        $readingModeBGColor = dracula_get_settings( 'readingModeBGColor', '#E3F5FF' );
        $readingModeBGDarker = dracula_color_brightness( $readingModeBGColor, -30 );
        $readingModeTextColor = dracula_get_settings( 'readingModeTextColor', '#2F80ED' );
        $dracula_variable = '';
        $dracula_variable .= ( !empty( $readingModeBGColor ) ? sprintf( '--reading-mode-bg-color: %s;', $readingModeBGColor ) : '' );
        $dracula_variable .= ( !empty( $readingModeBGColor ) ? sprintf( '--reading-mode-bg-darker: %s;', $readingModeBGDarker ) : '' );
        $dracula_variable .= ( !empty( $readingModeTextColor ) ? sprintf( '--reading-mode-text-color: %s;', $readingModeTextColor ) : '' );
        $custom_css .= sprintf( '.reading-mode-buttons .reading-mode-button { %s }', $dracula_variable );
        // Time CSS Variable
        $timeBGColor = dracula_get_settings( 'timeBGColor' );
        $timeBGDarker = dracula_color_brightness( $timeBGColor, -30 );
        $timeTextColor = dracula_get_settings( 'timeTextColor' );
        $time_variable = '';
        $time_variable .= ( !empty( $timeBGColor ) ? sprintf( '--time-bg-color: %s;', $timeBGColor ) : '' );
        $time_variable .= ( !empty( $timeBGColor ) ? sprintf( '--time-bg-darker: %s;', $timeBGDarker ) : '' );
        $time_variable .= ( !empty( $timeTextColor ) ? sprintf( '--time-text-color: %s;', $timeTextColor ) : '' );
        $custom_css .= sprintf( '.reading-mode-buttons .reading-mode-time { %s }', $time_variable );
        // Progressbar CSS Variable
        $progressbar_height = dracula_get_settings( 'progressbarHeight', '7' );
        $progressbar_style = dracula_get_settings( 'progressbarStyle', 'solid' );
        if ( 'solid' == $progressbar_style ) {
            $progressbar_color = dracula_get_settings( 'progressbarColor', '#7C7EE5' );
        } else {
            $progressbar_color = dracula_get_settings( 'progressbarColorGradient', 'linear-gradient(90deg, #004AFF 80%, rgba(96, 239, 255, 0) 113.89%)' );
        }
        $progressbar_variable = '';
        $progressbar_variable .= sprintf( '--reading-mode-progress-height: %spx;', $progressbar_height );
        $progressbar_variable .= sprintf( '--reading-mode-progress-color: %s;', $progressbar_color );
        $custom_css .= sprintf( '.reading-mode-progress { %s }', $progressbar_variable );
        // Dark Mode Custom css
        $custom_css .= dracula_get_settings( 'compiledCss' );
        return $custom_css;
    }

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Dracula_Enqueue::instance();