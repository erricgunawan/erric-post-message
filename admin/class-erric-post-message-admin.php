<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Erric_Post_Message
 * @subpackage Erric_Post_Message/includes
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Erric_Post_Message
 * @subpackage Erric_Post_Message/admin
 * @author     Eric Gunawan <erricgunawan@gmail.com>
 */
class Erric_Post_Message_Admin {

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
	 * @var      string    $name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $version ) {

		$this->name = $name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Erric_Post_Message_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Erric_Post_Message_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->name, plugin_dir_url( __FILE__ ) . 'css/erric-post-message-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Erric_Post_Message_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Erric_Post_Message_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/erric-post-message-admin.js', array( 'jquery' ), $this->version, FALSE );

	}

	/**
	 * 
	 */
	public function add_notice_metabox() {
		add_meta_box(
			'post_message',
			__( 'Erric Post Message', 'erric-post-message' ),
			array( $this, 'post_message_display' ),
			'post',
			'normal',
			'high'
		);
	}

	/**
	 * 
	 */
	public function post_message_display( $post ) {
		wp_nonce_field( plugin_basename( __FILE__ ), 'post_message_nonce' );

		// The textfield and preview area
		echo '<textarea id="post-message" name="post_message" placeholder="' . __( 'Enter your post message here. HTML accepted.', 'erric-post-message' ) . '">' . esc_textarea( get_post_meta( $post->ID, 'post_message', true ) ) . '</textarea>';

	} // end post_message_display

	/**
	 * 
	 */
	public function save_notice( $post_id ) {

		if ( isset( $_POST['post_message_nonce'] ) && isset( $_POST['post_type'] ) ) {

			// Don't save if the user hasn't submitted the changes
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			} // end if

			// Verify that the input is coming from the proper form
			if ( ! wp_verify_nonce( $_POST['post_message_nonce'], plugin_basename( __FILE__ ) ) ) {
				return;
			} // end if

			// Make sure the user has permissions to post
			if ( 'post' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				} // end if
			} // end if/else

			// Read the post message
			$post_message = isset( $_POST['post_message'] ) ? $_POST['post_message'] : '';

			// If the value for the post message exists, delete it first. Don't want to write extra rows into the table.
			if ( 0 == count( get_post_meta( $post_id, 'post_message' ) ) ) {
				delete_post_meta( $post_id, 'post_message' );
			}

			// Update it for this post.
			update_post_meta( $post_id, 'post_message', $post_message );

		} // end if

	} // end save_notice

}
