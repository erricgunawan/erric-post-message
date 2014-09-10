<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Erric_Post_Message
 *
 * @wordpress-plugin
 * Plugin Name:       Erric Post Message
 * Plugin URI:        http://code.tutsplus.com/articles/developing-plugins-with-wordpress-boilerplates-building-a-plugin--wp-29300
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress dashboard.
 * Version:           1.0.0
 * Author:            Eric Gunawan
 * Author URI:        http://erricgunawan.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       erric-post-message
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-erric-post-message-activator.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-erric-post-message-deactivator.php';

/** This action is documented in includes/class-erric-post-message-activator.php */
register_activation_hook( __FILE__, array( 'Erric_Post_Message_Activator', 'activate' ) );

/** This action is documented in includes/class-erric-post-message-deactivator.php */
register_deactivation_hook( __FILE__, array( 'Erric_Post_Message_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-erric-post-message.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_erric_post_message() {

	$plugin = new Erric_Post_Message();
	$plugin->run();

}
run_erric_post_message();
