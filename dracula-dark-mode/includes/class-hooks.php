<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
class Dracula_Hooks {
    private static $instance = null;

    public function __construct() {
        // Frontend Hooks
        if ( !is_admin() ) {
            if ( dracula_get_settings( 'frontendDarkMode', true ) ) {
                add_action( 'wp_head', array($this, 'render_header_scripts') );
                add_action( 'login_head', array($this, 'render_header_scripts') );
                add_action( 'init', function () {
                    if ( dracula_get_settings( 'performanceMode', false ) ) {
                        add_filter(
                            'script_loader_tag',
                            [$this, 'add_defer_attribute'],
                            10,
                            2
                        );
                    }
                } );
                // Render Floating Toggle
                add_action( 'wp_footer', array($this, 'render_floating_toggle') );
                add_action( 'login_footer', array($this, 'render_floating_toggle') );
                add_action(
                    'wp_nav_menu_items',
                    [$this, 'add_menu_toggle'],
                    10,
                    2
                );
                // Add page transition animation
                add_filter( 'body_class', [$this, 'add_page_transition_class'] );
            }
        }
        add_filter( 'autoptimize_filter_js_exclude', array($this, 'exclude_js_from_cache_plugins') );
    }

    public function exclude_js_from_cache_plugins( $excludes ) {
        $excludes .= ',dracula-dark-mode,dracula-frontend';
        return $excludes;
    }

    public function add_svg_support( $mimes ) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    public function add_page_transition_class( $classes ) {
        $transition = dracula_get_settings( 'pageTransition', 'none' );
        $classes[] = "dracula-transition-{$transition}";
        return $classes;
    }

    public function print_custom_css() {
        //Light Mode CSS
        $css = dracula_get_settings( 'lightModeCSS' );
        if ( !empty( $css ) ) {
            echo '<style type="text/css" id="dracula-light-mode-css">' . $css . '</style>';
        }
    }

    public function add_menu_toggle( $items, $args ) {
        $display_in_menu = dracula_get_settings( 'displayInMenu', false );
        if ( !$display_in_menu ) {
            return $items;
        }
        if ( empty( $args->menu->slug ) ) {
            return $items;
        }
        $menu_id = $args->menu->slug;
        $toggleMenus = dracula_get_settings( 'toggleMenus', [] );
        if ( in_array( $menu_id, $toggleMenus ) ) {
            $position = dracula_get_settings( 'menuTogglePosition', 'end' );
            $style = dracula_get_settings( 'menuToggleStyle', '14' );
            $class = 'dracula-toggle-wrap menu-item';
            $id = '';
            if ( strpos( $style, 'custom-' ) !== false ) {
                $id = str_replace( 'custom-', '', $style );
            }
            if ( !empty( $id ) ) {
                $class .= " custom-toggle";
                $toggle = Dracula_Toggle_Builder::instance()->get_toggle( $id );
                if ( !empty( $toggle->config ) ) {
                    $data = unserialize( $toggle->config );
                    $item = sprintf(
                        '<li class="%s" data-id="%s" data-data="%s"></li>',
                        $class,
                        $id,
                        json_encode( $data )
                    );
                }
            } else {
                $item = '<li class="dracula-toggle-wrap menu-item" data-style="' . $style . '"></li>';
            }
            if ( dracula_page_excluded() || dracula_taxonomy_excluded() ) {
                $items;
            } else {
                if ( 'start' == $position ) {
                    $items = $item . $items;
                } else {
                    $items .= $item;
                }
            }
        }
        return $items;
    }

    public function add_defer_attribute( $tag, $handle ) {
        if ( in_array( $handle, array('dracula-dark-mode', 'dracula-frontend') ) ) {
            $tag = str_replace( ' src', ' defer src', $tag );
        }
        return $tag;
    }

    public function render_header_scripts() {
        include_once DRACULA_INCLUDES . '/header-scripts.php';
    }

    public function render_floating_toggle() {
        $show_toggle = dracula_get_settings( 'showToggle', true );
        if ( !$show_toggle ) {
            return;
        }
        $display_on = dracula_get_settings( 'floatingDevices', ['mobile', 'tablet', 'desktop'] );
        $device = ( wp_is_mobile() ? ( dracula_is_tablet() ? 'tablet' : 'mobile' ) : 'desktop' );
        if ( !in_array( $device, $display_on, true ) ) {
            return;
        }
        $style = dracula_get_settings( 'toggleStyle', '1' );
        $id = '';
        if ( str_contains( $style, 'custom-' ) ) {
            $id = str_replace( 'custom-', '', $style );
        }
        // Check if the toggle is excluded on the current page or taxonomy
        if ( dracula_page_excluded() ) {
            return;
        }
        if ( dracula_taxonomy_excluded() ) {
            return;
        }
        echo do_shortcode( sprintf( '[dracula_toggle style="%1$s" id="%2$s" floating="1" ]', $style, $id ) );
    }

    /**
     * Render Template
     * @reading_mode
     */
    public function dracula_reading_mode() {
        if ( empty( $_GET['reading-mode'] ) ) {
            return;
        }
        include_once DRACULA_TEMPLATES . '/reading-mode.php';
        exit;
    }

    /**
     * Position placement
     * @reading_mode
     */
    public function add_positions() {
        $post_id = get_the_ID();
        if ( !dracula_reading_mode_should_render( $post_id ) ) {
            return false;
        }
        // check reading mode enable
        $readingMode = dracula_get_settings( 'readingMode' );
        // check & return reading mode button
        if ( dracula_reading_mode_excluded() ) {
            return;
        }
        if ( dracula_reading_mode_taxonomy_excluded() ) {
            return;
        }
        if ( !!$readingMode ) {
            if ( !is_front_page() && !is_home() ) {
                add_filter(
                    'the_title',
                    array($this, 'title_content'),
                    10,
                    2
                );
            }
            if ( is_singular() ) {
                if ( !is_front_page() && !is_home() ) {
                    add_filter( 'the_content', [$this, 'content_single'] );
                }
            } else {
                if ( is_home() || is_archive() || is_search() ) {
                    add_filter( 'get_the_excerpt', array($this, 'content_archive') );
                }
            }
            add_filter( 'comments_template', array($this, 'remove_comments_title_content') );
        }
    }

    public function remove_comments_title_content( $theme_template ) {
        remove_filter( 'the_title', array($this, 'title_content') );
        return $theme_template;
    }

    /**
     * Title content
     * @reading_mode
     */
    public function title_content( $title, $id ) {
        if ( in_the_loop() ) {
            if ( is_singular() ) {
                $current_object = get_queried_object();
                $post_id = $current_object->ID;
            } else {
                $post_id = get_the_ID();
            }
            // If not the same post, return.
            if ( $id != $post_id ) {
                return $title;
            }
            $title_prefix = '';
            $title_suffix = '';
            $button_position = dracula_get_settings( 'buttonPosition', 'aboveContent' );
            // Reading Mode Button
            if ( dracula_should_show_button() ) {
                if ( $button_position == 'aboveTitle' ) {
                    $title_prefix .= dracula_reading_mode_get_button_html( $post_id );
                } elseif ( $button_position == 'belowTitle' ) {
                    $title_suffix .= dracula_reading_mode_get_button_html( $post_id );
                }
            }
            return '<span class="reading-mode-buttons">' . $title_prefix . '</span>' . $title . '<span class="reading-mode-buttons">' . $title_suffix . '</span>';
        }
        return $title;
    }

    /**
     * Content Single
     * @reading_mode
     */
    public function content_single( $content ) {
        $excludeReadingModePages = dracula_get_settings( 'excludeReadingModePages', [] );
        $excludeReadingModeAll = dracula_get_settings( 'excludeReadingModeAll' );
        $excludeReadingModeExceptPages = dracula_get_settings( 'excludeReadingModeExceptPages', [] );
        if ( in_the_loop() ) {
            $post_id = get_the_ID();
            $content_prefix = '';
            // Reading Time
            if ( dracula_should_show_time() ) {
                $time_position = dracula_get_settings( 'timePosition', 'aboveTitle' );
                if ( $time_position === 'aboveContent' ) {
                    $content_prefix .= dracula_reading_mode_get_time_html( $post_id );
                }
            }
            $button_position = dracula_get_settings( 'buttonPosition', 'aboveContent' );
            // Reading Mode Button
            if ( dracula_should_show_button() ) {
                if ( $button_position === 'aboveContent' ) {
                    if ( !$excludeReadingModeAll && !in_array( $post_id, $excludeReadingModePages ) || $excludeReadingModeAll && in_array( $post_id, $excludeReadingModeExceptPages ) ) {
                        $content_prefix .= dracula_reading_mode_get_button_html( $post_id );
                    }
                }
            }
            return '<span class="reading-mode-buttons">' . $content_prefix . '</span><div class="reading-mode-content">' . $content . '</div>';
        }
        return $content;
    }

    public function content_archive( $excerpt ) {
        if ( in_the_loop() ) {
            $post_id = get_the_ID();
            $content_prefix = '';
            // Reader Mode Button
            if ( dracula_should_show_button() ) {
                $button_position = dracula_get_settings( 'buttonPosition', 'aboveContent' );
                if ( $button_position === 'aboveContent' ) {
                    $content_prefix .= dracula_reading_mode_get_button_html( $post_id );
                }
            }
            return '<span class="reading-mode-buttons">' . $content_prefix . '</span>' . $excerpt;
        }
        return $excerpt;
    }

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Dracula_Hooks::instance();