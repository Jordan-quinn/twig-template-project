<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

// Get site configurations and defines
require_once 'config.php';

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
    require_once $composer_autoload;
    $timber = new Timber\Timber();
}

/*
 * Check to see if Timber class exists
 */
if ( ! class_exists( 'Timber' ) ) {

    add_action(
        'admin_notices',
        function() {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
        }
    );

    return;
}

/*
 * Sets the directories inside this theme to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/*
 * Create widget areas
 *
 * @sidebar 1
 * @footCol FOOTCOL_COUNT
 */
function generate_widgetareas() {
    if ( function_exists('register_sidebar') ) {

        // Primary sidebar
        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar_primary',
            'before_widget' => '<div class="sb-main">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        ));

        for($fc_count = 0; $fc_count < FOOTCOL_COUNT; $fc_count++) {

            // Footer columns
            register_sidebar(array(
                'name' => 'Footer Column '.$fc_count.'',
                'before_widget' => '<div class="footcol-'.$fc_count.'">',
                'after_widget' => '</div>',
                'before_title' => '<h3>',
                'after_title' => '</h3>'
            ));
        }
    }
}
add_action( 'widgets_init', 'generate_widgetareas' );