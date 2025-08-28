<?php

defined('ABSPATH') or die('No script kiddies please!');

class Dracula_Shortcode
{

    private static $instance = null;

    public function __construct()
    {
        add_shortcode('dracula_toggle', array($this, 'render_toggle'));
    }

    public function render_toggle($atts)
    {

        $atts = shortcode_atts(array(
            'style' => 1,
            'id' => '',
            'floating' => '',
        ), $atts, 'dracula_toggle');

        $style = $atts['style'];
        $floating = $atts['floating'];
        $id = $atts['id'];

        $class = 'dracula-toggle-wrap';

        if ($floating) {
            $class .= ' floating';

            $position = dracula_get_settings('togglePosition', 'right');
            if ('custom' == $position) {
                $class .= ' position-custom';
                $position = dracula_get_settings('toggleSide', 'right');
            }

            $class .= " position-$position";
        }

        if (!empty($id)) {
            $class .= " custom-toggle";

            $toggle = Dracula_Toggle_Builder::instance()->get_toggle($id);

            if (!empty($toggle->config)) {
                $data = maybe_unserialize($toggle->config);

                return sprintf('<div class="%s" data-id="%s" data-data="%s"></div>', $class, $id, base64_encode(json_encode($data)));
            }
        }

        return sprintf('<div class="%s" data-style="%s"></div>', esc_attr($class), esc_attr($style));

    }

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}

Dracula_Shortcode::instance();