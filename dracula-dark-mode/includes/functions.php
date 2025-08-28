<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
function dracula_get_settings(  $key = null, $default = ''  ) {
    $settings_name = 'dracula_settings';
    $settings = get_option( $settings_name, [] );
    if ( !$key ) {
        return ( !empty( $settings ) ? $settings : [] );
    }
    if ( isset( $settings[$key] ) ) {
        return $settings[$key];
    }
    return $default;
}

function dracula_get_config() {
    $activeCustomPreset = dracula_get_settings( 'activeCustomPreset' );
    $customPresets = ( !empty( dracula_get_settings( 'customPresets' ) ) ? dracula_get_settings( 'customPresets' ) : array() );
    $index = array_search( $activeCustomPreset, array_column( $customPresets, 'id' ) );
    $currentCustomPreset = ( !empty( $index ) ? $customPresets[$index] : '' );
    $color_mode = dracula_get_settings( 'colorMode', false );
    $background_color = $currentCustomPreset['colors']['bg'] ?? '#181a1b';
    $text_color = $currentCustomPreset['colors']['text'] ?? '#e8e6e3';
    $brightness = dracula_get_settings( 'brightness', 100 );
    $contrast = dracula_get_settings( 'contrast', 90 );
    $sepia = dracula_get_settings( 'sepia', 10 );
    $grayscale = dracula_get_settings( 'grayscale', 0 );
    $change_font = dracula_get_settings( 'changeFont', false );
    $font_family = dracula_get_settings( 'fontFamily' );
    $darken_background_images = dracula_get_settings( 'darkenBackgroundImages', true );
    $text_stroke = dracula_get_settings( 'textStroke', '0' );
    $dark_to_light = dracula_get_settings( 'darkToLight' );
    $preset_key = dracula_get_settings( 'preset', 'dracula' );
    $scrollbar_dark_mode = dracula_get_settings( 'scrollbarDarkMode', 'auto' );
    $scrollbar_color = dracula_get_settings( 'scrollbarColor', '#181a1b' );
    $config = array(
        'mode'                   => ( $dark_to_light ? 0 : 1 ),
        'brightness'             => $brightness,
        'contrast'               => $contrast,
        'sepia'                  => $sepia,
        'grayscale'              => $grayscale,
        'excludes'               => dracula_get_excludes(),
        'darkenBackgroundImages' => $darken_background_images,
        'textStroke'             => $text_stroke,
    );
    if ( 'presets' === $color_mode ) {
        $preset = dracula_get_preset( $preset_key );
        $config['darkSchemeBackgroundColor'] = $preset['colors']['bg'];
        $config['darkSchemeTextColor'] = $preset['colors']['text'];
        $config['lightSchemeBackgroundColor'] = $preset['colors']['bg'];
        $config['lightSchemeTextColor'] = $preset['colors']['text'];
    } elseif ( 'custom' === $color_mode ) {
        $config['darkSchemeBackgroundColor'] = $background_color;
        $config['darkSchemeTextColor'] = $text_color;
        $config['lightSchemeTextColor'] = $background_color;
        $config['lightSchemeBackgroundColor'] = $text_color;
    }
    if ( $change_font ) {
        $config['useFont'] = $change_font;
        $config['fontFamily'] = $font_family;
    }
    // Scrollbar
    if ( 'custom' == $scrollbar_dark_mode ) {
        $config['scrollbarColor'] = $scrollbar_color;
    } elseif ( 'disabled' == $scrollbar_dark_mode ) {
        $config['scrollbarColor'] = '';
    } elseif ( 'auto' == $scrollbar_dark_mode ) {
        $config['scrollbarColor'] = 'auto';
    } else {
        $config['scrollbarColor'] = '';
    }
    return $config;
}

function dracula_get_excludes() {
    // Default excludes
    $default_excludes = array('.dracula-ignore');
    // Get user-defined excludes and ensure it's always an array
    $settings_excludes = (array) dracula_get_settings( 'excludes', array() );
    // Clean up empty values and trim whitespace
    $settings_excludes = array_filter( array_map( 'trim', $settings_excludes ) );
    // Merge defaults with user-defined excludes
    return array_merge( $default_excludes, $settings_excludes );
}

function dracula_get_user_roles() {
    $user_roles = array();
    $roles = get_editable_roles();
    foreach ( $roles as $role => $details ) {
        $user_roles[$role] = $details['name'];
    }
    return $user_roles;
}

function dracula_is_user_dark_mode() {
    if ( !is_user_logged_in() ) {
        return false;
    }
    if ( current_user_can( 'administrator' ) ) {
        return true;
    }
    $dark_mode_user_roles = dracula_get_settings( 'userRoles', ['administrator'] );
    $user = wp_get_current_user();
    $roles = $user->roles;
    if ( !array_intersect( $dark_mode_user_roles, $roles ) ) {
        return false;
    }
    return true;
}

function dracula_page_excluded() {
    $excludes = dracula_get_settings( 'excludePages' );
    $exclude_all = dracula_get_settings( 'excludeAll', false );
    $excludes_except = dracula_get_settings( 'excludeExceptPages', [] );
    if ( empty( $excludes ) && !$exclude_all ) {
        return false;
    }
    if ( is_front_page() ) {
        if ( $exclude_all ) {
            return !in_array( 'home', $excludes_except ) && !in_array( get_the_ID(), $excludes_except );
        } else {
            return in_array( 'home', $excludes ) || in_array( get_the_ID(), $excludes );
        }
    }
    //check search page
    if ( is_search() ) {
        if ( $exclude_all ) {
            return !in_array( 'search', $excludes_except );
        } else {
            return in_array( 'search', $excludes );
        }
    }
    //check 404 page
    if ( is_404() ) {
        if ( $exclude_all ) {
            return !in_array( '404', $excludes_except );
        } else {
            return in_array( '404', $excludes );
        }
    }
    //check archive page
    if ( is_archive() ) {
        if ( $exclude_all ) {
            return !in_array( 'archive', $excludes_except );
        } else {
            return in_array( 'archive', $excludes );
        }
    }
    //check author page
    if ( is_author() ) {
        if ( $exclude_all ) {
            return !in_array( 'author', $excludes_except );
        } else {
            return in_array( 'author', $excludes );
        }
    }
    //check tag page
    if ( is_tag() ) {
        if ( $exclude_all ) {
            return !in_array( 'tag', $excludes_except );
        } else {
            return in_array( 'tag', $excludes );
        }
    }
    //check category page
    if ( is_category() ) {
        if ( $exclude_all ) {
            return !in_array( 'category', $excludes_except );
        } else {
            return in_array( 'category', $excludes );
        }
    }
    //check if is login page
    if ( !empty( $GLOBALS['pagenow'] ) && sanitize_text_field( $GLOBALS['pagenow'] ) === 'wp-login.php' ) {
        $is_register = !empty( $_GET['action'] ) && $_GET['action'] == 'register';
        $is_lost_password = !empty( $_GET['action'] ) && $_GET['action'] == 'lostpassword';
        if ( $is_register ) {
            if ( $exclude_all ) {
                return !in_array( 'register', $excludes_except );
            } else {
                return in_array( 'register', $excludes );
            }
        } elseif ( $is_lost_password ) {
            if ( $exclude_all ) {
                return !in_array( 'lostpassword', $excludes_except );
            } else {
                return in_array( 'lostpassword', $excludes );
            }
        } else {
            if ( $exclude_all ) {
                return !in_array( 'login', $excludes_except );
            } else {
                return in_array( 'login', $excludes );
            }
        }
    }
    // Check if post_id is in exclude list
    $query_id = get_queried_object_id();
    if ( !empty( $query_id ) ) {
        if ( $exclude_all ) {
            return !in_array( $query_id, $excludes_except );
        } else {
            return in_array( $query_id, $excludes );
        }
    }
    return false;
}

/**
 * Taxonomy & Tags Exclude
 * @darkmode
 * @since 1.10.0
 */
function dracula_taxonomy_excluded() {
    if ( !is_singular() ) {
        return false;
    }
    $excludes = dracula_get_settings( 'excludeTaxs', [] );
    $exclude_all = dracula_get_settings( 'excludeAllTaxs' );
    $excludes_except = dracula_get_settings( 'excludeExceptTaxs', [] );
    if ( empty( $excludes ) && !$exclude_all ) {
        return false;
    }
    $id = get_queried_object_id();
    $taxonomy_ids = get_taxonomy_ids( $id );
    if ( !empty( $taxonomy_ids ) ) {
        if ( $exclude_all ) {
            return !array_intersect( $taxonomy_ids, $excludes_except );
        } else {
            return array_intersect( $taxonomy_ids, $excludes );
        }
    }
    return false;
}

/**
 * Reading Mode Excluded
 */
function dracula_reading_mode_excluded() {
    $excludes = dracula_get_settings( 'excludeReadingModePages', [] );
    $exclude_all = dracula_get_settings( 'excludeReadingModeAll', false );
    $excludes_except = dracula_get_settings( 'excludeReadingModeExceptPages', [] );
    if ( empty( $excludes ) && !$exclude_all ) {
        return false;
    }
    if ( is_front_page() ) {
        if ( $exclude_all ) {
            return !in_array( 'home', $excludes_except );
        } else {
            return in_array( 'home', $excludes );
        }
    }
    //check search page
    if ( is_search() ) {
        if ( $exclude_all ) {
            return !in_array( 'search', $excludes_except );
        } else {
            return in_array( 'search', $excludes );
        }
    }
    //check 404 page
    if ( is_404() ) {
        if ( $exclude_all ) {
            return !in_array( '404', $excludes_except );
        } else {
            return in_array( '404', $excludes );
        }
    }
    //check archive page
    if ( is_archive() ) {
        if ( $exclude_all ) {
            return !in_array( 'archive', $excludes_except );
        } else {
            return in_array( 'archive', $excludes );
        }
    }
    //check author page
    if ( is_author() ) {
        if ( $exclude_all ) {
            return !in_array( 'author', $excludes_except );
        } else {
            return in_array( 'author', $excludes );
        }
    }
    //check tag page
    if ( is_tag() ) {
        if ( $exclude_all ) {
            return !in_array( 'tag', $excludes_except );
        } else {
            return in_array( 'tag', $excludes );
        }
    }
    //check category page
    if ( is_category() ) {
        if ( $exclude_all ) {
            return !in_array( 'category', $excludes_except );
        } else {
            return in_array( 'category', $excludes );
        }
    }
    //check if is login page
    if ( !empty( $GLOBALS['pagenow'] ) && sanitize_text_field( $GLOBALS['pagenow'] ) === 'wp-login.php' ) {
        $is_register = !empty( $_GET['action'] ) && $_GET['action'] == 'register';
        $is_lost_password = !empty( $_GET['action'] ) && $_GET['action'] == 'lostpassword';
        if ( $is_register ) {
            if ( $exclude_all ) {
                return !in_array( 'register', $excludes_except );
            } else {
                return in_array( 'register', $excludes );
            }
        } elseif ( $is_lost_password ) {
            if ( $exclude_all ) {
                return !in_array( 'lostpassword', $excludes_except );
            } else {
                return in_array( 'lostpassword', $excludes );
            }
        } else {
            if ( $exclude_all ) {
                return !in_array( 'login', $excludes_except );
            } else {
                return in_array( 'login', $excludes );
            }
        }
    }
    //check if post_id is in exclude list
    global $post;
    if ( !empty( $post ) ) {
        if ( $exclude_all ) {
            return !in_array( $post->ID, $excludes_except );
        } else {
            return in_array( $post->ID, $excludes );
        }
    }
    return false;
}

/**
 * Reading Mode Taxonomy Exclude
 * @reading-mode
 * @since 1.10.0
 */
function dracula_reading_mode_taxonomy_excluded() {
    $excludes = dracula_get_settings( 'excludeReadingModeTaxs', [] );
    $exclude_all = dracula_get_settings( 'excludeReadingModeAllTaxs' );
    $excludes_except = dracula_get_settings( 'excludeReadingModeExceptTaxs', [] );
    if ( empty( $excludes ) && !$exclude_all ) {
        return false;
    }
    $id = get_queried_object_id();
    $taxonomy_ids = get_taxonomy_ids( $id );
    if ( !empty( $taxonomy_ids ) ) {
        if ( $exclude_all ) {
            return !array_intersect( $taxonomy_ids, $excludes_except );
        } else {
            return array_intersect( $taxonomy_ids, $excludes );
        }
    }
    return false;
}

function dracula_get_menus() {
    //get all menus
    $menus = wp_get_nav_menus();
    $menu_list = array();
    foreach ( $menus as $menu ) {
        $menu_list[$menu->slug] = $menu->name;
    }
    return $menu_list;
}

function dracula_get_exclude_list() {
    $front_page_id = null;
    if ( get_option( 'show_on_front' ) === 'page' ) {
        $front_page_id = get_option( 'page_on_front' );
    }
    $general_options = [];
    if ( empty( $front_page_id ) ) {
        $general_options['home'] = __( 'Homepage', 'dracula-dark-mode' );
    }
    $general_options['search'] = __( 'Search page', 'dracula-dark-mode' );
    $general_options['tag'] = __( 'Tag page', 'dracula-dark-mode' );
    $general_options['category'] = __( 'Category page', 'dracula-dark-mode' );
    $general_options['archive'] = __( 'Archive page', 'dracula-dark-mode' );
    $general_options['author'] = __( 'Author page', 'dracula-dark-mode' );
    $general_options['404'] = __( '404 error page', 'dracula-dark-mode' );
    $general_options['login'] = __( 'Login page', 'dracula-dark-mode' );
    $general_options['register'] = __( 'Register page', 'dracula-dark-mode' );
    $general_options['lostpassword'] = __( 'Lost password page', 'dracula-dark-mode' );
    $list = [
        'general' => [
            'label'   => 'General',
            'options' => $general_options,
        ],
    ];
    // Get only visible post types
    $visible_post_types = get_post_types( array(
        "public" => true,
    ) );
    // Each post types
    foreach ( $visible_post_types as $post_type ) {
        $query = new WP_Query(array(
            'post_type'      => $post_type,
            'posts_per_page' => 999,
        ));
        if ( $query->have_posts() ) {
            $list[$post_type] = [
                'label' => ucfirst( $post_type ),
            ];
            $post_type_options = [];
            while ( $query->have_posts() ) {
                $query->the_post();
                $post_type_options[get_the_ID()] = get_the_title();
            }
            $list[$post_type]['options'] = $post_type_options;
        }
    }
    return $list;
}

/**
 * Post List for Reading Mode post/pages
 */
function dracula_get_exclude_reading_list() {
    $list = [];
    // Get only visible post types
    $visible_post_types = get_post_types( array(
        "public" => true,
    ) );
    // Each post types
    foreach ( $visible_post_types as $post_type ) {
        $query = new WP_Query(array(
            'post_type'      => $post_type,
            'posts_per_page' => 999,
        ));
        if ( $query->have_posts() ) {
            $list[$post_type] = [
                'label' => ucfirst( $post_type ),
            ];
            $post_type_options = [];
            while ( $query->have_posts() ) {
                $query->the_post();
                $post_type_options[get_the_ID()] = get_the_title();
            }
            $list[$post_type]['options'] = $post_type_options;
        }
    }
    return $list;
}

/**
 * Taxonomy List
 */
function dracula_get_exclude_taxonomy_list() {
    $list = array();
    $args = array(
        'public'  => true,
        'show_ui' => true,
    );
    $taxonomies = get_taxonomies( $args );
    foreach ( $taxonomies as $taxonomy ) {
        $query = get_terms( array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => 0,
        ) );
        $taxonomy_type_options = [];
        foreach ( $query as $data ) {
            $list[$data->taxonomy] = [
                'label' => ucfirst( ( $data->taxonomy == 'post_tag' ? 'tags' : $data->taxonomy ) ),
            ];
            $taxonomy_type_options[$data->term_id] = $data->name;
            $list[$data->taxonomy]['options'] = $taxonomy_type_options;
        }
    }
    return $list;
}

function dracula_is_block_editor_page() {
    if ( function_exists( 'get_current_screen' ) ) {
        $current_screen = get_current_screen();
        if ( !empty( $current_screen->is_block_editor ) ) {
            return true;
        }
    }
    return false;
}

function dracula_is_classic_editor_page() {
    if ( function_exists( 'get_current_screen' ) ) {
        $current_screen = get_current_screen();
        if ( $current_screen && $current_screen->base == 'post' && empty( $current_screen->is_block_editor ) ) {
            return true;
        }
    }
    return false;
}

function dracula_is_elementor_editor_page() {
    return !empty( $_GET['elementor-preview'] );
}

function dracula_is_tablet() {
    if ( !isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
        return false;
    }
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if ( preg_match( '/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $user_agent ) ) {
        return true;
    }
    return false;
}

function dracula_get_preset(  $key = null  ) {
    $presets = array(
        // --- Neutrals / Editors ---
        array(
            'key'    => 'default',
            'label'  => 'Default',
            'colors' => array(
                'bg'                => '#181a1b',
                'text'              => '#e8e6e3',
                'secondary_bg'      => '#202324',
                'link'              => '#6ea5d9',
                'link_hover'        => '#88b9e3',
                'btn_bg'            => '#3b6f99',
                'btn_text'          => '#dcdcdc',
                'btn_text_hover'    => '#f0f0f0',
                'btn_hover_bg'      => '#325d80',
                'input_text'        => '#e8e6e3',
                'input_bg'          => '#1f2223',
                'input_placeholder' => '#8c8c8c',
                'border'            => '#2d2d2d',
            ),
        ),
        array(
            'key'    => 'dracula',
            'label'  => 'Dracula',
            'colors' => array(
                'bg'                => '#282b36',
                'text'              => '#e8e6e3',
                'secondary_bg'      => '#343746',
                'link'              => '#9a87cc',
                'link_hover'        => '#b79ce2',
                'btn_bg'            => '#5a6288',
                'btn_text'          => '#dedede',
                'btn_text_hover'    => '#f0f0f0',
                'btn_hover_bg'      => '#4b5274',
                'input_text'        => '#e8e6e3',
                'input_bg'          => '#3a3c4e',
                'input_placeholder' => '#8b8b9c',
                'border'            => '#45475a',
            ),
        ),
        array(
            'key'    => 'catppuccin',
            'label'  => 'Catppuccin',
            'colors' => array(
                'bg'                => '#161320',
                'text'              => '#d9e0ee',
                'secondary_bg'      => '#1e1a2e',
                'link'              => '#b69ad8',
                'link_hover'        => '#c5b0e1',
                'btn_bg'            => '#8a74b8',
                'btn_text'          => '#d9e0ee',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#7a66a3',
                'input_text'        => '#d9e0ee',
                'input_bg'          => '#1e1a2e',
                'input_placeholder' => '#8e89a3',
                'border'            => '#2a2438',
            ),
        ),
        array(
            'key'    => 'gruvbox',
            'label'  => 'Gruvbox',
            'colors' => array(
                'bg'                => '#282828',
                'text'              => '#ebdbb2',
                'secondary_bg'      => '#32302f',
                'link'              => '#d4a73c',
                'link_hover'        => '#e0b252',
                'btn_bg'            => '#a97e2c',
                'btn_text'          => '#ebdbb2',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#8f6a25',
                'input_text'        => '#ebdbb2',
                'input_bg'          => '#32302f',
                'input_placeholder' => '#a89984',
                'border'            => '#504945',
            ),
        ),
        array(
            'key'    => 'nord',
            'label'  => 'Nord',
            'colors' => array(
                'bg'                => '#2e3440',
                'text'              => '#eceff4',
                'secondary_bg'      => '#3b4252',
                'link'              => '#88c0d0',
                'link_hover'        => '#a3d1dc',
                'btn_bg'            => '#5e81ac',
                'btn_text'          => '#eceff4',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#4c6a92',
                'input_text'        => '#eceff4',
                'input_bg'          => '#434c5e',
                'input_placeholder' => '#9aa0a6',
                'border'            => '#4c566a',
            ),
        ),
        array(
            'key'    => 'rosePine',
            'label'  => 'Rose Pine',
            'colors' => array(
                'bg'                => '#191724',
                'text'              => '#e0def4',
                'secondary_bg'      => '#1f1d2e',
                'link'              => '#d2879d',
                'link_hover'        => '#e2a3b7',
                'btn_bg'            => '#6d879c',
                'btn_text'          => '#e0def4',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#5a6f81',
                'input_text'        => '#e0def4',
                'input_bg'          => '#26233a',
                'input_placeholder' => '#908caa',
                'border'            => '#524f67',
            ),
        ),
        array(
            'key'    => 'solarized',
            'label'  => 'Solarized',
            'colors' => array(
                'bg'                => '#002b36',
                'text'              => '#93a1a1',
                'secondary_bg'      => '#073642',
                'link'              => '#6aa6a6',
                'link_hover'        => '#82bcbc',
                'btn_bg'            => '#2f5f66',
                'btn_text'          => '#cfe3e3',
                'btn_text_hover'    => '#e6f0f0',
                'btn_hover_bg'      => '#2a5359',
                'input_text'        => '#a7b6b6',
                'input_bg'          => '#0d3944',
                'input_placeholder' => '#6f8383',
                'border'            => '#0f3a44',
            ),
        ),
        array(
            'key'    => 'tokyoNight',
            'label'  => 'Tokyo Night',
            'colors' => array(
                'bg'                => '#1a1b26',
                'text'              => '#a9b1d6',
                'secondary_bg'      => '#1f2230',
                'link'              => '#7aa2f7',
                'link_hover'        => '#8fb5ff',
                'btn_bg'            => '#3b4a7a',
                'btn_text'          => '#cfd6f2',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#323f68',
                'input_text'        => '#b7bfe1',
                'input_bg'          => '#212335',
                'input_placeholder' => '#7c85a9',
                'border'            => '#2a2e42',
            ),
        ),
        array(
            'key'    => 'monokai',
            'label'  => 'Monokai',
            'colors' => array(
                'bg'                => '#272822',
                'text'              => '#f8f8f2',
                'secondary_bg'      => '#2f302a',
                'link'              => '#8fc66a',
                'link_hover'        => '#a1d57a',
                'btn_bg'            => '#5b6e4a',
                'btn_text'          => '#e6f1dd',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#4d5e3f',
                'input_text'        => '#efeede',
                'input_bg'          => '#303126',
                'input_placeholder' => '#9aa08f',
                'border'            => '#3a3b33',
            ),
        ),
        array(
            'key'    => 'ayuMirage',
            'label'  => 'Ayu Mirage',
            'colors' => array(
                'bg'                => '#1f2430',
                'text'              => '#cbccc6',
                'secondary_bg'      => '#252b39',
                'link'              => '#9ccfd8',
                'link_hover'        => '#b7e0e6',
                'btn_bg'            => '#5f7890',
                'btn_text'          => '#dfe2e0',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#50677d',
                'input_text'        => '#d5d6d0',
                'input_bg'          => '#262d3b',
                'input_placeholder' => '#8d94a1',
                'border'            => '#2c3443',
            ),
        ),
        array(
            'key'    => 'ayuDark',
            'label'  => 'Ayu Dark',
            'colors' => array(
                'bg'                => '#0a0e14',
                'text'              => '#b3b1ad',
                'secondary_bg'      => '#121721',
                'link'              => '#5aa7c8',
                'link_hover'        => '#72b8d5',
                'btn_bg'            => '#3a6075',
                'btn_text'          => '#cfd6da',
                'btn_text_hover'    => '#e7eef2',
                'btn_hover_bg'      => '#314f61',
                'input_text'        => '#c2c0bc',
                'input_bg'          => '#121722',
                'input_placeholder' => '#808693',
                'border'            => '#1b2230',
            ),
        ),
        array(
            'key'    => 'material',
            'label'  => 'Material',
            'colors' => array(
                'bg'                => '#263238',
                'text'              => '#eceff1',
                'secondary_bg'      => '#2e3b41',
                'link'              => '#82b1ff',
                'link_hover'        => '#9bbfff',
                'btn_bg'            => '#546e7a',
                'btn_text'          => '#e6eff3',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#465c65',
                'input_text'        => '#e4eaee',
                'input_bg'          => '#2b3940',
                'input_placeholder' => '#9aaab1',
                'border'            => '#31434a',
            ),
        ),
        array(
            'key'    => 'oneDark',
            'label'  => 'One Dark',
            'colors' => array(
                'bg'                => '#282c34',
                'text'              => '#abb2bf',
                'secondary_bg'      => '#2f3440',
                'link'              => '#6fb4f0',
                'link_hover'        => '#89c2f4',
                'btn_bg'            => '#3d5872',
                'btn_text'          => '#cfd6e2',
                'btn_text_hover'    => '#eaf1fb',
                'btn_hover_bg'      => '#334a60',
                'input_text'        => '#b9c0cd',
                'input_bg'          => '#2c303a',
                'input_placeholder' => '#8a909c',
                'border'            => '#3a3f4a',
            ),
        ),
        array(
            'key'    => 'oceanicNext',
            'label'  => 'Oceanic Next',
            'colors' => array(
                'bg'                => '#1B2B34',
                'text'              => '#CDD3DE',
                'secondary_bg'      => '#203340',
                'link'              => '#5fb3b3',
                'link_hover'        => '#77c4c4',
                'btn_bg'            => '#3f6d6d',
                'btn_text'          => '#d8e4e4',
                'btn_text_hover'    => '#f0f7f7',
                'btn_hover_bg'      => '#355c5c',
                'input_text'        => '#d2d8e1',
                'input_bg'          => '#223746',
                'input_placeholder' => '#8ca1ad',
                'border'            => '#2a4050',
            ),
        ),
        array(
            'key'    => 'cityLights',
            'label'  => 'City Lights',
            'colors' => array(
                'bg'                => '#1d252c',
                'text'              => '#b6bfc4',
                'secondary_bg'      => '#232c34',
                'link'              => '#76a8d9',
                'link_hover'        => '#8bb9e3',
                'btn_bg'            => '#3e5f7a',
                'btn_text'          => '#d4dde2',
                'btn_text_hover'    => '#f0f6fb',
                'btn_hover_bg'      => '#344f66',
                'input_text'        => '#c2cbd0',
                'input_bg'          => '#232c34',
                'input_placeholder' => '#8b97a0',
                'border'            => '#2a343e',
            ),
        ),
        array(
            'key'    => 'nightOwl',
            'label'  => 'Night Owl',
            'colors' => array(
                'bg'                => '#011627',
                'text'              => '#d6deeb',
                'secondary_bg'      => '#071d33',
                'link'              => '#82aaff',
                'link_hover'        => '#9bb6ff',
                'btn_bg'            => '#425b8a',
                'btn_text'          => '#e4ecfa',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#394f78',
                'input_text'        => '#dbe3f0',
                'input_bg'          => '#0a1f36',
                'input_placeholder' => '#8aa0be',
                'border'            => '#0f2740',
            ),
        ),
        // --- Sites ---
        array(
            'key'    => 'youtube',
            'label'  => 'YouTube',
            'colors' => array(
                'bg'                => '#181818',
                'text'              => '#ffffff',
                'secondary_bg'      => '#202020',
                'link'              => '#e05a5a',
                'link_hover'        => '#ff6b6b',
                'btn_bg'            => '#8a2b2b',
                'btn_text'          => '#f2f2f2',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#722424',
                'input_text'        => '#f0f0f0',
                'input_bg'          => '#222222',
                'input_placeholder' => '#9a9a9a',
                'border'            => '#2a2a2a',
            ),
        ),
        array(
            'key'    => 'twitter',
            'label'  => 'Twitter',
            'colors' => array(
                'bg'                => '#15202b',
                'text'              => '#ffffff',
                'secondary_bg'      => '#1b2733',
                'link'              => '#69b3ff',
                'link_hover'        => '#8cc6ff',
                'btn_bg'            => '#3a6fa1',
                'btn_text'          => '#e8f3ff',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#325f8a',
                'input_text'        => '#eef6ff',
                'input_bg'          => '#1e2a36',
                'input_placeholder' => '#8ea5bd',
                'border'            => '#263544',
            ),
        ),
        array(
            'key'    => 'reddit',
            'label'  => 'Reddit (Night mode)',
            'colors' => array(
                'bg'                => '#1a1a1b',
                'text'              => '#d7dadc',
                'secondary_bg'      => '#202021',
                'link'              => '#ff9566',
                'link_hover'        => '#ffb187',
                'btn_bg'            => '#7a4a2e',
                'btn_text'          => '#efd9cf',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#693f27',
                'input_text'        => '#e3e6e8',
                'input_bg'          => '#222223',
                'input_placeholder' => '#9aa0a3',
                'border'            => '#2a2a2b',
            ),
        ),
        array(
            'key'    => 'discord',
            'label'  => 'Discord',
            'colors' => array(
                'bg'                => '#36393f',
                'text'              => '#dcddde',
                'secondary_bg'      => '#3c4047',
                'link'              => '#8ea1e1',
                'link_hover'        => '#a5b3ea',
                'btn_bg'            => '#4957d6',
                'btn_text'          => '#e7e9ff',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#3f4bc0',
                'input_text'        => '#e3e4e6',
                'input_bg'          => '#40444b',
                'input_placeholder' => '#9aa1ae',
                'border'            => '#454a52',
            ),
        ),
        array(
            'key'    => 'slack',
            'label'  => 'Slack',
            'colors' => array(
                'bg'                => '#1d1c1d',
                'text'              => '#e7e7e7',
                'secondary_bg'      => '#232223',
                'link'              => '#cf8fb6',
                'link_hover'        => '#dda6c5',
                'btn_bg'            => '#6b5a6e',
                'btn_text'          => '#efe3ef',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#5b4d5d',
                'input_text'        => '#ededed',
                'input_bg'          => '#242324',
                'input_placeholder' => '#9a969b',
                'border'            => '#2a292a',
            ),
        ),
        array(
            'key'    => 'whatsapp',
            'label'  => 'WhatsApp',
            'colors' => array(
                'bg'                => '#121212',
                'text'              => '#e6e5e4',
                'secondary_bg'      => '#161616',
                'link'              => '#67b97a',
                'link_hover'        => '#7acc8d',
                'btn_bg'            => '#2f6b3e',
                'btn_text'          => '#d8f0df',
                'btn_text_hover'    => '#f2fff6',
                'btn_hover_bg'      => '#285b35',
                'input_text'        => '#ecebe9',
                'input_bg'          => '#1a1a1a',
                'input_placeholder' => '#8d8d8d',
                'border'            => '#222222',
            ),
        ),
        array(
            'key'    => 'github',
            'label'  => 'GitHub',
            'colors' => array(
                'bg'                => '#0d1117',
                'text'              => '#c9d1d9',
                'secondary_bg'      => '#11161e',
                'link'              => '#6aa6ff',
                'link_hover'        => '#8abaff',
                'btn_bg'            => '#2f3a4a',
                'btn_text'          => '#d8e2ec',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#26303d',
                'input_text'        => '#d3dbe2',
                'input_bg'          => '#0f1420',
                'input_placeholder' => '#8894a1',
                'border'            => '#1a2230',
            ),
        ),
        array(
            'key'    => 'stackoverflow',
            'label'  => 'StackOverflow',
            'colors' => array(
                'bg'                => '#2d2d2d',
                'text'              => '#f2f2f2',
                'secondary_bg'      => '#333333',
                'link'              => '#ffa654',
                'link_hover'        => '#ffbb7a',
                'btn_bg'            => '#7a4e1f',
                'btn_text'          => '#fdeedd',
                'btn_text_hover'    => '#ffffff',
                'btn_hover_bg'      => '#683f18',
                'input_text'        => '#f0f0f0',
                'input_bg'          => '#353535',
                'input_placeholder' => '#9a9a9a',
                'border'            => '#3c3c3c',
            ),
        ),
    );
    if ( !is_null( $key ) ) {
        foreach ( $presets as $preset ) {
            if ( $preset['key'] === $key ) {
                return $preset;
            }
        }
    }
    return $presets;
}

function dracula_get_current_custom_preset_colors() {
    $active_custom_preset = dracula_get_settings( 'activeCustomPreset' );
    $custom_presets = ( !empty( dracula_get_settings( 'customPresets' ) ) ? dracula_get_settings( 'customPresets' ) : array() );
    $index = array_search( $active_custom_preset, array_column( $custom_presets, 'id' ) );
    $current_custom_preset = $custom_presets[$index] ?? [];
    $colors = ( !empty( $current_custom_preset['colors'] ) ? $current_custom_preset['colors'] : array() );
    if ( !empty( $colors['bg'] ) ) {
        $colors['secondary_bg'] = dracula_color_brightness( $colors['bg'], 10 );
    }
    if ( !empty( $colors['link'] ) ) {
        $colors['link_hover'] = dracula_color_brightness( $colors['link'], -40 );
    }
    if ( !empty( $colors['btn_bg'] ) ) {
        $colors['btn_hover_bg'] = dracula_color_brightness( $colors['btn_bg'], -10 );
    }
    if ( !empty( $colors['btn_text'] ) ) {
        $colors['btn_text_hover'] = dracula_color_brightness( $colors['btn_text'], 20 );
    }
    if ( !empty( $colors['input_text'] ) ) {
        $colors['input_placeholder'] = dracula_color_brightness( $colors['input_text'], 10 );
    }
    return $colors;
}

function dracula_sanitize_array(  $array  ) {
    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = dracula_sanitize_array( $value );
        } else {
            if ( in_array( $value, ['true', 'false'] ) ) {
                $value = filter_var( $value, FILTER_VALIDATE_BOOLEAN );
            } elseif ( is_numeric( $value ) ) {
                if ( strpos( $value, '.' ) !== false ) {
                    $value = floatval( $value );
                } elseif ( filter_var( $value, FILTER_VALIDATE_INT ) !== false && $value <= PHP_INT_MAX ) {
                    $value = intval( $value );
                } else {
                    // Keep large integers or non-integer values as string
                    $value = $value;
                }
            } else {
                $value = wp_kses_post( $value );
            }
        }
    }
    return $array;
}

function dracula_add_dark_mode_selector_prefix(  $css  ) {
    // Split the CSS into rules using the '}' delimiter
    $rules = explode( '}', $css );
    // Iterate over each rule
    foreach ( $rules as &$rule ) {
        // Check if there is content in the rule (to avoid empty strings)
        if ( trim( $rule ) ) {
            // Add the .dark-mode prefix to the selector
            // We use '{' as a delimiter to find the end of the selector
            $parts = explode( '{', $rule, 2 );
            if ( count( $parts ) == 2 ) {
                $selectors = explode( ',', $parts[0] );
                foreach ( $selectors as &$selector ) {
                    $selector = trim( $selector );
                    // Prepend .dark-mode to each selector
                    $selector = 'html[data-dracula-scheme="dark"] ' . $selector;
                }
                // Reassemble the rule with modified selectors
                $rule = implode( ', ', $selectors ) . '{' . $parts[1];
            }
        }
    }
    // Reassemble the CSS
    return implode( '}', $rules );
}

/**
 * Color brightness
 */
function dracula_color_brightness(  $hex, $steps  ) {
    // return if not hex color
    if ( !preg_match( '/^#([a-f0-9]{3}){1,2}$/i', $hex ) ) {
        return $hex;
    }
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max( -255, min( 255, $steps ) );
    // Normalize into a six character long hex string
    $hex = str_replace( '#', '', $hex );
    if ( strlen( $hex ) == 3 ) {
        $hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
    }
    // Split into three parts: R, G and B
    $color_parts = str_split( $hex, 2 );
    $return = '#';
    foreach ( $color_parts as $color ) {
        $color = hexdec( $color );
        // Convert to decimal
        $color = max( 0, min( 255, $color + $steps ) );
        // Adjust color
        $return .= str_pad(
            dechex( $color ),
            2,
            '0',
            STR_PAD_LEFT
        );
        // Make two char hex code
    }
    return $return;
}

/**
 * Author
 */
function reading_mode_get_author_name(  $post_id  ) {
    $post = get_post( $post_id );
    $author_id = $post->post_author;
    return get_the_author_meta( 'display_name', $author_id );
}

/**
 * Reading mode render
 */
function dracula_reading_mode_should_render(  $post_id  ) {
    $post_type = get_post_type( $post_id );
    $post_types = dracula_get_settings( 'postTypes', ['post'] );
    return in_array( $post_type, $post_types );
}

/**
 * Show time
 */
function dracula_should_show_time() {
    $enable_reading_time = dracula_get_settings( 'enableReadingTime', true );
    $timeDisplay = dracula_get_settings( 'timeDisplay', ['single'] );
    $should_show_single = in_array( 'single', $timeDisplay ) && is_singular();
    $should_show_blog = in_array( 'blog', $timeDisplay ) && is_home();
    $should_show_archive = in_array( 'archive', $timeDisplay ) && is_archive();
    $should_show_search = in_array( 'search', $timeDisplay ) && is_search();
    return $enable_reading_time && ($should_show_single || $should_show_blog || $should_show_archive || $should_show_search);
}

/**
 * get time html
 */
function dracula_reading_mode_get_time_html(  $post_id  ) {
    $reading_time = dracula_reading_mode_get_reading_time( $post_id );
    $timeStyle = dracula_get_settings( 'timeStyle', 'default' );
    $buttonSize = dracula_get_settings( 'buttonSize', 'medium' );
    $timeIcon = dracula_get_settings( 'timeIcon', 1 );
    $customTimeIcon = dracula_get_settings( 'customTimeIcon', '' );
    $icon = '';
    if ( $customTimeIcon ) {
        $icon_url = $customTimeIcon;
        $icon = sprintf( '<img class="reading-mode-time__icon custom-icon" src="%s" />', $icon_url );
    } else {
        if ( $timeIcon ) {
            $icon_url = 'url(../images/icons/time/' . $timeIcon . '.svg) no-repeat center / contain';
            $icon = sprintf( '<span class="reading-mode-time__icon" style="--time-icon: %s"></span>', $icon_url );
        }
    }
    if ( !empty( $icon ) ) {
        $icon = sprintf( '<span class="time-icon-wrap">%s</span>', $icon );
    }
    $timeText = dracula_get_settings( 'timeText', '%time% minutes read' );
    $timeText = str_replace( '%time%', $reading_time, $timeText );
    $time_text = sprintf( '<span class="reading-mode-time__text">%s</span>', $timeText );
    return sprintf(
        '<span class="reading-mode-time style-%s size-%s">%s %s</span>',
        $timeStyle,
        $buttonSize,
        $icon,
        $time_text
    );
}

/**
 * Dracula reading time
 * @reading_mode
 */
function dracula_reading_mode_get_reading_time(  $post_id, $with_markup = false  ) {
    $content = get_post_field( 'post_content', $post_id );
    $content = wp_strip_all_tags( $content );
    $words = str_word_count( $content );
    $words_per_minute_slow = 200;
    $words_per_minute_fast = 280;
    $reading_time_slow = ceil( $words / $words_per_minute_slow );
    $reading_time_fast = ceil( $words / $words_per_minute_fast );
    if ( $reading_time_slow == 0 && $reading_time_fast == 0 ) {
        $reading_time_slow = 1;
        $reading_time_fast = 1;
    }
    if ( $reading_time_slow == $reading_time_fast ) {
        $time = sprintf( '%s', $reading_time_slow );
    } else {
        $time = sprintf( '%s - %s', $reading_time_fast, $reading_time_slow );
    }
    if ( $with_markup ) {
        $time_text = dracula_get_settings( 'timeText', '%time% minutes read' );
        $time_text = str_replace( '%time%', $time, $time_text );
        $time = '<div class="reading-mode-time"><i class="dashicons dashicons-clock"></i> ' . $time_text . '</div>';
    }
    return $time;
}

/**
 * get button
 */
function dracula_reading_mode_get_button_html(  $post_id  ) {
    $readingModeStyle = dracula_get_settings( 'readingModeStyle', 'default' );
    $buttonSize = dracula_get_settings( 'buttonSize', 'medium' );
    $readingModeLabel = dracula_get_settings( 'readingModeLabel', true );
    $readingModeText = dracula_get_settings( 'readingModeText', 'Reading Mode' );
    $readingModeIcon = dracula_get_settings( 'readingModeIcon', 1 );
    $customReadingModeIcon = dracula_get_settings( 'customReadingModeIcon', '' );
    $icon = '';
    $reading_mode_icon_only = ( !$readingModeLabel ? 'reading-mode-icon-only' : '' );
    if ( $customReadingModeIcon ) {
        $icon_url = $customReadingModeIcon;
        $icon = sprintf( '<img class="reading-mode-button__icon custom-icon" src="%s" />', $icon_url );
    } else {
        if ( $readingModeIcon ) {
            $icon_url = 'url(../images/icons/reading-mode/' . $readingModeIcon . '.svg) no-repeat center / contain';
            $icon = sprintf( '<span class="reading-mode-button__icon" style="--reading-mode-icon: %s"></span>', $icon_url );
        }
    }
    if ( !empty( $icon ) ) {
        $icon = sprintf( '<span class="reading-mode-icon-wrap %s">%s</span>', $reading_mode_icon_only, $icon );
    }
    $reading_mode_text = sprintf( '<span class="reading-mode-button__text">%s</span>', $readingModeText );
    if ( $readingModeLabel ) {
        $html = sprintf(
            '<span class="reading-mode-button style-%s size-%s" data-post-id="%s">%s%s</span>',
            $readingModeStyle,
            $buttonSize,
            $post_id,
            $icon,
            $reading_mode_text
        );
    } else {
        $html = sprintf(
            '<span class="reading-mode-button style-%s %s size-%s" data-post-id="%s">%s</span>',
            $readingModeStyle,
            $reading_mode_icon_only,
            $buttonSize,
            $post_id,
            $icon
        );
    }
    return $html;
}

/**
 * show button
 */
function dracula_should_show_button() {
    $enable_reading_mode = dracula_get_settings( 'readingMode', true );
    $readingModeDisplay = dracula_get_settings( 'readingModeDisplay', ['single'] );
    $should_show_single = in_array( 'single', $readingModeDisplay ) && is_singular();
    $should_show_blog = in_array( 'blog', $readingModeDisplay ) && is_home();
    $should_show_archive = in_array( 'archive', $readingModeDisplay ) && is_archive();
    $should_show_search = in_array( 'search', $readingModeDisplay ) && is_search();
    return $enable_reading_mode && ($should_show_single || $should_show_blog || $should_show_archive || $should_show_search);
}

/**
 * Retrives post type list
 */
function dracula_get_post_type_list() {
    $post_types = get_post_types( array(
        "public" => true,
    ), 'objects' );
    $excludes = array(
        'attachment',
        'elementor_library',
        'Media',
        'My Templates'
    );
    $list = [];
    foreach ( $post_types as $key => $obj ) {
        if ( in_array( $obj->label, $excludes ) ) {
            continue;
        }
        $list[] = [
            'value' => $key,
            'label' => $obj->labels->name,
        ];
    }
    return $list;
}

/**
 * Render Progress Bar
 */
function dracula_render_progressbar() {
    $position = dracula_get_settings( 'progressPosition', 'top' );
    ?>
    <div class="reading-mode-progress position-<?php 
    echo esc_attr( $position );
    ?>">
        <div class="reading-mode-progress-fill"></div>
    </div>
<?php 
}

/**
 * get taxonomy IDs for a post
 */
function get_taxonomy_ids(  $post_id  ) {
    $taxonomy_ids = [];
    $object_taxonomies = get_object_taxonomies( get_post_type( $post_id ) );
    foreach ( $object_taxonomies as $taxonomy ) {
        $taxonomies = get_the_terms( $post_id, $taxonomy );
        if ( !empty( $taxonomies ) ) {
            foreach ( $taxonomies as $attachedTaxonomy ) {
                $taxonomy_ids[] = $attachedTaxonomy->term_id;
            }
        }
    }
    return $taxonomy_ids;
}

/**
 * Build the available toggle switch markups.
 *
 * @return array<int,string> Indexed by variant number (1..18), values are sanitized HTML strings.
 */
function dracula_get_switches_markups() {
    $labels = array(
        'light'       => __( 'Light', 'dracula-dark-mode' ),
        'dark'        => __( 'Dark', 'dracula-dark-mode' ),
        'light_mode'  => __( 'Light Mode', 'dracula-dark-mode' ),
        'dark_mode'   => __( 'Dark Mode', 'dracula-dark-mode' ),
        'system_mode' => __( 'System Mode', 'dracula-dark-mode' ),
    );
    $size_class = ( !is_admin() ? dracula_get_settings( 'toggleSize' ) : '' );
    // Keep all templates in one place. Use placeholders for labels and the size class.
    $templates = array(
        1  => <<<HTML
\t<div class="toggle-icon-wrap">
\t\t<div class="toggle-icon __dark"></div>
\t\t<div class="toggle-icon __light"></div>
\t</div>
HTML
,
        2  => <<<HTML
\t<div class="dracula-toggle-icon-wrap %size%">
\t\t<div class="dracula-toggle-icon"></div>
\t</div>
\t<div class="dracula-toggle-label">
\t\t<span class="--light">%light%</span>
\t\t<span class="--dark">%dark%</span>
\t</div>
HTML
,
        3  => <<<HTML
\t<div class="dracula-toggle-icon-wrap %size%">
\t\t<div class="dracula-toggle-icon"></div>
\t</div>
HTML
,
        4  => <<<HTML
\t<div class="prefix-icon"></div>
\t<div class="dracula-toggle-icon-wrap">
\t\t<div class="dracula-toggle-icon %size%"></div>
\t</div>
\t<div class="suffix-icon"></div>
HTML
,
        5  => <<<HTML
\t<div class="dracula-toggle-icon-wrap %size%"></div>
\t<div class="dracula-toggle-icon %size%"></div>
HTML
,
        6  => <<<HTML
\t<div class="dracula-toggle-icon-wrap">
\t\t<div class="dracula-toggle-icon %size%"></div>
\t</div>
HTML
,
        7  => <<<HTML
\t<div class="dracula-toggle-icon --light"></div>
\t<div class="dracula-toggle-icon --dark"></div>
\t<div class="dracula-toggle-icon-wrap %size%"></div>
HTML
,
        8  => <<<HTML
\t<div class="dracula-toggle-icon-wrap">
\t\t<div class="dracula-toggle-icon"></div>
\t</div>
HTML
,
        9  => <<<HTML
\t<div class="dracula-toggle-icon --light"></div>
\t<div class="dracula-toggle-icon --dark"></div>
\t<div class="dracula-toggle-icon-wrap %size%"></div>
HTML
,
        10 => <<<HTML
\t<div class="dracula-toggle-icon-wrap %size%"></div>
HTML
,
        11 => <<<HTML
\t<div class="toggle-prefix">%light%</div>
\t<div class="dracula-toggle-icon-wrap">
\t\t<div class="dracula-toggle-icon %size%"></div>
\t</div>
\t<div class="toggle-suffix">%dark%</div>
HTML
,
        12 => <<<HTML
\t<div class="dracula-toggle-icon --light"></div>
\t<div class="dracula-toggle-icon --dark"></div>
\t<div class="dracula-toggle-icon-wrap %size%"></div>
HTML
,
        13 => <<<HTML
\t<span class="toggle-prefix-icon"></span>
\t<span class="toggle-prefix-text">%dark_mode%</span>
\t<div class="dracula-toggle-icon-wrap">
\t\t<div class="dracula-toggle-icon"></div>
\t</div>
HTML
,
        14 => <<<HTML
\t<span class="dracula-toggle-icon"></span>
\t<div class="toggle-modal dracula-ignore">
\t\t<div class="toggle-modal-content">
\t\t\t<div class="toggle-option light">
\t\t\t\t<span class="toggle-option-icon --light"></span>
\t\t\t\t<span class="toggle-option-label">%light_mode%</span>
\t\t\t</div>
\t\t\t<div class="toggle-option dark">
\t\t\t\t<span class="toggle-option-icon --dark"></span>
\t\t\t\t<span class="toggle-option-label">%dark_mode%</span>
\t\t\t</div>
\t\t\t<div class="toggle-option auto">
\t\t\t\t<span class="toggle-option-icon --auto"></span>
\t\t\t\t<span class="toggle-option-label">%system_mode%</span>
\t\t\t</div>
\t\t</div>
\t\t<div class="toggle-modal-arrow"></div>
\t</div>
HTML
,
        15 => <<<HTML
\t<div class="dracula-toggle-icon --light"></div>
\t<div class="dracula-toggle-icon --dark"></div>
\t<div class="dracula-toggle-icon-wrap"></div>
HTML
,
        16 => <<<HTML
\t<span class="toggle-prefix-icon"></span>
\t<span class="toggle-prefix-text dracula-toggle-text">%light_mode%</span>
\t<div class="dracula-toggle-icon-wrap">
\t\t<div class="dracula-toggle-icon"></div>
\t</div>
HTML
,
        17 => <<<HTML
\t<button class="dracula-toggle-icon --typography"></button>
\t<button class="dracula-toggle-icon --light"></button>
HTML
,
        18 => <<<HTML
\t<button type="button" class="dracula-toggle-icon --light"></button>
\t<button type="button" class="dracula-toggle-icon --typography"></button>
HTML
,
    );
    // Replace placeholders (labels & %size%), trim whitespace, and kses sanitize.
    $replacements = array(
        '%light%'       => esc_html( $labels['light'] ),
        '%dark%'        => esc_html( $labels['dark'] ),
        '%light_mode%'  => esc_html( $labels['light_mode'] ),
        '%dark_mode%'   => esc_html( $labels['dark_mode'] ),
        '%system_mode%' => esc_html( $labels['system_mode'] ),
        '%size%'        => esc_attr( $size_class ),
    );
    $allowed = array(
        'div'    => array(
            'class' => true,
        ),
        'span'   => array(
            'class' => true,
        ),
        'button' => array(
            'class' => true,
            'type'  => true,
        ),
    );
    $out = array();
    foreach ( $templates as $i => $tpl ) {
        $html = strtr( $tpl, $replacements );
        $html = trim( preg_replace( '/\\s+/', ' ', $html ) );
        $out[(int) $i] = wp_kses( $html, $allowed );
    }
    /**
     * Filter the list of toggle switch markups.
     *
     * @param array<int,string> $out
     * @param array $labels
     * @param string $size_class
     */
    return apply_filters(
        'dracula_toggle_switches',
        $out,
        $labels,
        $size_class
    );
}

function dracula_custom_toggle_switches() {
    $switches = [
        1 => '<div class="toggle-icon-wrap">
				<span class="toggle-icon __dark"></span>
				<span class="toggle-icon __light"></span>
			</div>',
        2 => '
			<div class="dracula-toggle-icon position-before"></div>
			<div class="dracula-toggle-label">
                <span class="--light"></span>
                <span class="--dark"></span>
            </div>
			<div class="dracula-toggle-icon position-after"></div>
		',
        3 => '
			<div class="toggle-prefix"></div>
            <div class="dracula-toggle-icon-wrap">
                <div class="dracula-toggle-icon"></div>
            </div>
            <div class="toggle-suffix"></div>
		',
        4 => '
			<div class="dracula-toggle-icon-wrap">
                <div class="dracula-toggle-icon"></div>
            </div>

            <div class="dracula-toggle-label">
                <span class="--light"></span>
                <span class="--dark"></span>
            </div>
		',
        5 => '
			<div class="dracula-toggle-icon-wrap">
                <div class="dracula-toggle-icon"></div>
            </div>

            <span class="dracula-toggle-label --light"></span>
            <span class="dracula-toggle-label --dark"></span>
		',
    ];
    return $switches;
}

function dracula_hex_to_rgba(  $hex, $alpha = 1.0  ) {
    // Remove `#` if present
    $hex = ltrim( $hex, '#' );
    // Support shorthand hex (e.g. #f00 -> #ff0000)
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    // Bail out if invalid
    if ( strlen( $hex ) !== 6 || !ctype_xdigit( $hex ) ) {
        return 'rgba(0,0,0,' . floatval( $alpha ) . ')';
    }
    // Convert hex to RGB
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    // Clamp alpha between 0 and 1
    $alpha = max( 0, min( 1, floatval( $alpha ) ) );
    return "rgba({$r}, {$g}, {$b}, {$alpha})";
}

function dracula_is_embed_request() {
    // Canonical: signed query arg
    if ( isset( $_GET['dracula-setup'] ) ) {
        return true;
    }
    // Heuristic: modern browsers set these when loading in an iframe
    $dest = $_SERVER['HTTP_SEC_FETCH_DEST'] ?? '';
    $mode = $_SERVER['HTTP_SEC_FETCH_MODE'] ?? '';
    // often "navigate" or "nested-navigate"
    if ( strtolower( $dest ) === 'iframe' || strtolower( $mode ) === 'nested-navigate' ) {
        return true;
    }
    return false;
}
