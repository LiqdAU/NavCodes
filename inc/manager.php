<?php

class NavCodes {

    public $url = '';

    public function __construct() {
        self::$instance = $this;
        $this->hooks();
    }

    public function edit_after_title() {
        global $post;
        if ('menu-shortcode' === $post->post_type) {
            include(__DIR__ . '/editor-shortcode.php');
        }
    }

    public function hooks() {
        add_action('init',                      [$this, 'init']);
        add_action('edit_form_after_title',     [$this, 'edit_after_title']);
        add_action('wp_enqueue_scripts',        [$this, 'enqueue_frontend']);

        add_shortcode('quick-links',            [$this, 'render_quicklinks']);
        add_shortcode('show-menu',              [$this, 'render_shortcode']);
    }

    public function enqueue_frontend() {
        wp_enqueue_style('navcodes-styles', $this->url . '/assets/css/navcodes.css' );
        wp_enqueue_script('navcodes-script', $this->url . '/assets/js/navcodes.js', ['jquery']);
    }

    public function render_quicklinks($atts, $content) {
        ob_start();
        @include(__DIR__ . '/layouts/quicklinks.php');
        return ob_get_clean();
    }

    public function render_shortcode($atts, $content) {
        // No menu name supplied, render nothing
        if (!isset($atts['menu'])) { return is_admin() ? 'No menu specified' : ''; }
        $layout = strtolower(@$atts['layout']);

        switch ($layout) {
            case 'tiles':
                $layout = $atts['layout'];
                break;
            default:
                $layout = 'list';
                break;
        }

        // Find our menu
        $menu = get_posts([
            'post_type' => 'menu-shortcode',
            'numberposts' => 1,
            'name' => $atts['menu']
        ]);

        // If no menu was found, render nothing
        if (count($menu) !== 1) { return is_admin() ? 'Invalid menu name' : ''; }

        $menu = $menu[0];
        $heading = is_string(@$atts['heading']) ? @$atts['heading'] : get_field('menu_heading', $menu->ID);

        ob_start();

        include(__DIR__ . "/layouts/{$layout}.php");

        return ob_get_clean();
    }

    public function init() {

        if (!class_exists('ACF')) {

            // Deactivate
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            deactivate_plugins( NAVCODES );

            // Admin Notice
            add_action('admin_notices', function() {
                echo '<div class="notice notice-warning is-dismissible"><p>Please enable Advanced Custom Fields to use this plugin.</p></div>';
            });

            return;
        }

    	register_post_type( 'menu-shortcode', [
    		'label'                 => __( 'NavCodes', 'navcodes' ),
    		'description'           => __( 'NavCodes', 'navcodes' ),
    		'labels'                => [
        		'name'                  => __( 'NavCodes', 'navcodes' ),
        		'singular_name'         => __( 'NavCode', 'navcodes' ),
        		'menu_name'             => __( 'NavCodes', 'navcodes' ),
        		'name_admin_bar'        => __( 'NavCodes', 'navcodes' ),
        		'all_items'             => __( 'All NavCodes', 'navcodes' ),
        		'add_new_item'          => __( 'Add New NavCode', 'navcodes' ),
        		'add_new'               => __( 'Add New', 'navcodes' ),
        		'new_item'              => __( 'New NavCode', 'navcodes' ),
        		'edit_item'             => __( 'Edit NavCode', 'navcodes' ),
        		'update_item'           => __( 'Update NavCode', 'navcodes' ),
        	],
    		'supports'              => array( 'title' ),
    		'hierarchical'          => false,
    		'public'                => false,
    		'show_ui'               => true,
    		'show_in_menu'          => true,
            'menu_icon'             => 'dashicons-location-alt',
            'menu_position'         => 99,
    		'can_export'            => true
    	]);

        require_once(__DIR__ . '/fields.php');
    }

    public static $instance = null;
    public static function instance() { return self::$instance; }
}
