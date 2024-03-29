<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Erric_Post_Message
 * @subpackage Erric_Post_Message/includes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Erric_Post_Message
 * @subpackage Erric_Post_Message/admin
 * @author     Eric Gunawan <erricgunawan@gmail.com>
 */
class Erric_Post_Message_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $name    The ID of this plugin.
	 */
	private $name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $version ) {

		$this->name = $name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Erric_Post_Message_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Erric_Post_Message_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->name, plugin_dir_url( __FILE__ ) . 'css/erric-post-message-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Erric_Post_Message_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Erric_Post_Message_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/erric-post-message-public.js', array( 'jquery' ), $this->version, FALSE );

	}

	/**
	 * 
	 */
	public function prepend_post_message( $content ) {

		// If there is a notice, prepend it to the content
		if ( '' != get_post_meta( get_the_ID(), 'post_message', true ) ) {
			$post_message = '<p class="post-message">';
			$post_message .= get_post_meta( get_the_ID(), 'post_message', true );
			$post_message .= '</p><!-- /.post-message -->'; // end of journey

			$content = $post_message . $content;
		} // end if

		return $content;

	}
}
