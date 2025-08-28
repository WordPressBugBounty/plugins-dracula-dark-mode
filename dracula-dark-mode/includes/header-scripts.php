<?php

defined( 'ABSPATH' ) || exit;
$is_static = dracula_get_settings( 'colorType' ) === 'static';
$is_active = dracula_get_settings( 'frontendDarkMode', true ) && !dracula_page_excluded();
$is_active_tax = dracula_get_settings( 'frontendDarkMode', true ) && !dracula_taxonomy_excluded();
if ( !$is_active || !$is_active_tax ) {
    return;
}
$timeBasedMode = dracula_get_settings( 'timeBasedMode', false );
$timeBasedModeStart = dracula_get_settings( 'timeBasedModeStart', '19:00' );
$timeBasedModeEnd = dracula_get_settings( 'timeBasedModeEnd', '07:00' );
$config = dracula_get_config();
$is_default_mode = dracula_get_settings( 'defaultDarkMode', false );
$is_auto = dracula_get_settings( 'matchOsTheme', true );
$url_parameter = dracula_get_settings( 'urlParameter', false );
$custom_preset_colors = dracula_get_current_custom_preset_colors();
$color_mode = dracula_get_settings( 'colorMode', 'dynamic' );
$preset_key = dracula_get_settings( 'preset', 'dracula' );
$dark_to_light = dracula_get_settings( 'darkToLight' );
$colors = [
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
];
if ( 'presets' === $color_mode ) {
    $preset = dracula_get_preset( $preset_key );
    if ( $preset ) {
        $colors = array_merge( $colors, $preset['colors'] );
    }
    if ( $is_static && $dark_to_light ) {
        $light_colors = [];
        foreach ( $colors as $key => $color ) {
            $step = 180;
            if ( in_array( $key, ['link', 'link_hover', 'border'] ) ) {
                $step = -80;
            } elseif ( in_array( $key, [
                'input_text',
                'input_placeholder',
                'btn_text',
                'btn_text_hover',
                'text'
            ] ) ) {
                $step = -180;
            }
            $light_colors[$key] = dracula_color_brightness( $color, $step );
        }
        $colors = $light_colors;
    }
} elseif ( 'custom' === $color_mode ) {
    $custom_preset_colors = dracula_get_current_custom_preset_colors();
    if ( $custom_preset_colors ) {
        $colors = array_merge( $colors, $custom_preset_colors );
    }
}
?>

<!-- Colors Variable -->
<?php 
if ( $is_static || 'custom' == $color_mode ) {
    ?>
    <style id="dracula-color-css">
        <?php 
    echo ":root {\n";
    echo "    --dracula-bg-color: {$colors['bg']};\n";
    echo "    --dracula-secondary-bg-color: {$colors['secondary_bg']};\n";
    echo "    --dracula-text-color: {$colors['text']};\n";
    echo "    --dracula-link-color: {$colors['link']};\n";
    echo "    --dracula-link-hover-color: {$colors['link_hover']};\n";
    echo "    --dracula-btn-bg-color: {$colors['btn_bg']};\n";
    echo "    --dracula-btn-text-color: {$colors['btn_text']};\n";
    echo "    --dracula-btn-hover-bg-color: {$colors['btn_hover_bg']};\n";
    echo "    --dracula-btn-text-hover-color: {$colors['btn_text_hover']};\n";
    echo "    --dracula-input-placeholder-color: {$colors['input_placeholder']};\n";
    echo "    --dracula-input-text-color: {$colors['input_text']};\n";
    echo "    --dracula-input-bg-color: {$colors['input_bg']};\n";
    echo "    --dracula-border-color: {$colors['border']};\n";
    echo "}";
    ?>
    </style>
<?php 
}
?>

<?php 
// Toggle size css
$toggle_size = dracula_get_settings( 'toggleSize', 'normal' );
if ( in_array( $toggle_size, ['small', 'large'] ) ) {
    $toggle_scale = ( 'small' == $toggle_size ? '.8' : '1.5' );
}
// Menu toggle size css
$menu_toggle_size = dracula_get_settings( 'menuToggleSize', 'normal' );
if ( in_array( $menu_toggle_size, ['small', 'large'] ) ) {
    $menu_toggle_scale = ( 'small' == $menu_toggle_size ? '.8' : '1.5' );
}
?>
<style id="dracula-inline-css" class="dracula-inline-css">
    <?php 
$absolute_toggle_selector = '.dracula-toggle-wrap.position-absolute';
if ( isset( $toggle_scale ) ) {
    echo sprintf( '.dracula-toggle-wrap:not(.menu-item) .dracula-toggle{ --toggle-scale: %s; }', $toggle_scale );
}
if ( isset( $menu_toggle_scale ) ) {
    echo sprintf( '.dracula-toggle-wrap.menu-item .dracula-toggle{ --toggle-scale: %s; }', $menu_toggle_scale );
}
// Toggle absolute position css
if ( $absolute_toggle_position ) {
    printf( '.dracula-toggle-wrap.floating{ --toggle-position: absolute; }' );
}
// Toggle custom position css
if ( 'custom' == dracula_get_settings( 'togglePosition', 'right' ) ) {
    $side = dracula_get_settings( 'sideOffset', '30' );
    $bottom = dracula_get_settings( 'bottomOffset', '30' );
    echo sprintf( '.dracula-toggle-wrap.position-custom{ --side-offset: %spx; --bottom-offset: %spx; }', $side, $bottom );
}
// Font size css
if ( dracula_get_settings( 'changeFont' ) ) {
    $font_size = dracula_get_settings( 'fontSize' );
    if ( 'custom' == $font_size ) {
        $font_size = dracula_get_settings( 'customFontSize', 100 ) / 100;
    }
    echo sprintf( 'html[data-dracula-scheme="dark"] body>*:not(#dracula-live-edit){zoom: %s;}', $font_size );
}
?>
</style>
<?php 
// Scrollbar CSS
$scrollbar_dark_mode = dracula_get_settings( 'scrollbarDarkMode', 'auto' );
if ( 'auto' == $scrollbar_dark_mode || 'custom' == $scrollbar_dark_mode ) {
    $track_color = dracula_color_brightness( $colors['secondary_bg'], 10 );
    $thumb_color = dracula_color_brightness( $colors['secondary_bg'], 30 );
    if ( 'custom' == $scrollbar_dark_mode ) {
        $track_color = dracula_hex_to_rgba( dracula_get_settings( 'scrollbarColor', $track_color ), 0.25 );
        $thumb_color = dracula_get_settings( 'scrollbarColor', $thumb_color );
    }
    ?>

    <style id="dracula-scrollbar-css">
        html,
        *{
            scrollbar-width: thin;

            &[data-dracula-scheme="dark"]{
                scrollbar-color: <?php 
    echo esc_attr( $thumb_color );
    ?> <?php 
    echo esc_attr( $track_color );
    ?>;
            }
        }
    </style>
<?php 
}
?>

<!-- Initialize listeners for cross-tab session management.  -->
<script>
    window.draculaCrossTabSession = {

        init: function() {
            window.addEventListener("storage", this.sessionStorageTransfer.bind(this));
            if (!sessionStorage.length) {
                localStorage.setItem('getSessionStorage', 'init');
                localStorage.removeItem('getSessionStorage');
            }
        },

        /**
         * Handle the transfer of sessionStorage between tabs.
         */
        sessionStorageTransfer: function(event) {
            if (!event.newValue) return;

            switch (event.key) {
                case 'getSessionStorage':
                    this.sendSessionStorageToTabs();
                    break;
                case 'sessionStorage':
                    if (!sessionStorage.length) {
                        this.receiveSessionStorageFromTabs(event.newValue);
                    }
                    break;
            }
        },

        /**
         * Send current sessionStorage to other tabs.
         */
        sendSessionStorageToTabs: function() {
            localStorage.setItem('sessionStorage', JSON.stringify(sessionStorage));
            localStorage.removeItem('sessionStorage');
        },

        /**
         * Populate current tab's sessionStorage with data from another tab.
         */
        receiveSessionStorageFromTabs: function(dataValue) {
            const data = JSON.parse(dataValue);
            for (let key in data) {
                sessionStorage.setItem(key, data[key]);
            }
        },

        /**
         * Set data to sessionStorage and share it across tabs.
         */
        set: function(key, value) {
            sessionStorage.setItem(key, value);
            this.sendSessionStorageToTabs();
        },

        /**
         * Get data from sessionStorage.
         */
        get: function(key) {
            return sessionStorage.getItem(key);
        }
    };

    window.draculaCrossTabSession.init();
</script>

<script>
    const isPerformanceMode = <?php 
echo json_encode( dracula_get_settings( 'performanceMode', false ) );
?>;

    const isStatic = <?php 
echo json_encode( $is_static );
?>;
    const isDefaultMode = <?php 
echo json_encode( $is_default_mode );
?>;
    const isAuto = <?php 
echo json_encode( $is_auto );
?>;
    const isTimeBasedMode = <?php 
echo json_encode( $timeBasedMode );
?>;
    const timeBasedModeStart = <?php 
echo json_encode( $timeBasedModeStart );
?>;
    const timeBasedModeEnd = <?php 
echo json_encode( $timeBasedModeEnd );
?>;
    const urlParameterEnabled = <?php 
echo json_encode( $url_parameter );
?>;

    const config = <?php 
echo json_encode( $config );
?>;

    function initDraculaDarkMode() {
        const draculaDarkMode = window.draculaDarkMode;

        if (isDefaultMode) {
            window.draculaMode = 'dark';
        }

        const savedMode = sessionStorage.getItem('dracula_mode');

        if (savedMode) {
            window.draculaMode = savedMode;
        }

        if ('dark' === window.draculaMode) {
            draculaDarkMode?.enable(config);
        } else if ('auto' === savedMode || (isAuto && !savedMode)) {
            draculaDarkMode?.auto(config);
        }

        // Time based mode
        if (isTimeBasedMode && !savedMode) {

            const currentTime = new Date();
            const startTime = new Date();
            const endTime = new Date();

            // Splitting the start and end times into hours and minutes
            const startParts = timeBasedModeStart.split(':');
            const endParts = timeBasedModeEnd.split(':');

            // Setting hours and minutes for start time
            startTime.setHours(parseInt(startParts[0], 10), parseInt(startParts[1] || '0', 10), 0);

            // Setting hours and minutes for end time
            endTime.setHours(parseInt(endParts[0], 10), parseInt(endParts[1] || '0', 10), 0);

            // Adjust end time to the next day if end time is earlier than start time
            if (endTime <= startTime) {
                endTime.setDate(endTime.getDate() + 1);
            }

            // Check if current time is within the range
            if (currentTime >= startTime && currentTime < endTime) {
                draculaDarkMode?.enable(config);
            }
        }

        // URL Parameter
        if (urlParameterEnabled) {
            const urlParams = new URLSearchParams(window.location.search);
            const mode = urlParams.get('darkmode');

            if (mode) {
                if (parseInt(mode)) {
                    draculaDarkMode?.enable(config);
                } else {
                    window.draculaMode = null;
                    draculaDarkMode?.disable();
                }
            }
        }

        if (draculaDarkMode?.isEnabled()) {
            jQuery(document).ready(function() {
                // Change toggle text
                const toggleTextElements = document.querySelectorAll('.toggle-prefix-text');
                toggleTextElements.forEach(el => {
                    el.textContent = "Dark Mode";
                });

                // Send dark mode page view analytics event
                if (dracula.isPro && dracula.settings.enableAnalytics) {
                    wp.ajax.post('dracula_track_analytics', {
                        type: 'dark_view'
                    });
                }
            });
        } else {
            const toggleTextElements = document.querySelectorAll('.toggle-prefix-text');
            toggleTextElements.forEach(el => {
                el.textContent = "Light Mode";
            });
        }
    }

    if (isPerformanceMode) {
        jQuery(document).ready(initDraculaDarkMode);
    } else {
        initDraculaDarkMode();
    }
</script>