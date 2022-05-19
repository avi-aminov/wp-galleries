<?php
/**
 * Plugin Name: WP Galleries
 * Plugin URI:
 * Description: Galleries Plugin
 * Version: 1.0.0
 * Author: Avi Aminov
 * Author URI: https://www.linkedin.com/in/avi-aminov-developer/
 * Text Domain: wp-galleries
 * Domain Path: /languages/
 */


/** plugin path constant */
define( 'WP_GALLERIES_PLUGIN_PATH', trailingslashit(plugins_url('/', __FILE__)) );

/** includes */
include_once 'inc/helper.class.php';
include_once 'inc/gallery-post-type.php';
include_once 'inc/short-code.php';


class WPGalleries {

    public function __construct() {

        /** add new post type */
        add_action( 'init', 'gallery_post_type', 0 );

        /** add shortcode */
        add_shortcode('galleries', 'show_gallery_func');

        /** add image size with crop */
        add_image_size( 'medium-gallery', 640, 480, true );
        add_image_size( 'small-gallery', 250, 250, true );

        /** include assets files frontend and backend */
        add_action( 'wp_enqueue_scripts', [ $this, 'include_gallery_assets' ]);
        add_action( 'admin_enqueue_scripts', [ $this, 'include_gallery_admin_assets' ]);

        /** add meta box to gallery post type */
        add_action( 'admin_init', [$this, 'add_gallery_meta_box'] );

        /** save gallery data */
        add_action( 'save_post', [$this, 'update_post_gallery'], 10, 2 );
    }

    /** include assets client side */
    public function include_gallery_assets() {
        wp_enqueue_script('wp-galleries-bootstrap-bundle',
            WP_GALLERIES_PLUGIN_PATH . '/assets/js/bootstrap.bundle.min.js',
            ['jquery'], '5.1.3', true
        );

        wp_enqueue_style('wp-galleries-bootstrap-css',
            WP_GALLERIES_PLUGIN_PATH . '/assets/css/bootstrap.min.css',
            [], '5.1.3', 'all'
        );
    }

    /** include assets admin side */
    public function include_gallery_admin_assets() {
        global $post;
        if( isset($post) && $post->post_type === 'galleries') {
            wp_enqueue_script('wp-galleries-custom-js',
                WP_GALLERIES_PLUGIN_PATH . '/assets/js/custom.js',
                ['jquery'], '1.0.1', true
            );

            wp_enqueue_style('wp-galleries-custom-css',
                WP_GALLERIES_PLUGIN_PATH . '/assets/css/custom.css',
                [], '1.0.1', 'all'
            );
        }
    }

    /** add meta box to gallery post type */
    public function add_gallery_meta_box() {
        add_meta_box(
            'post_gallery', 'Gallery', [$this, 'gallery_meta_box_content'],
            'galleries', 'advanced', 'core'
        );
    }

    /** print the Meta Box content */
    public function gallery_meta_box_content() {

        /** Use nonce for verification */
        wp_nonce_field( plugin_basename( __FILE__ ), 'name_of_nonce_field' );

        /** includes parts */
        include_once 'parts/form.php';
        include_once 'parts/master-row.php';
        include_once 'parts/add-row.php';
        include_once 'parts/guide.php';
    }

    /**
     * Save post action, process fields
     */
    function update_post_gallery( $post_id ) {

        /** Verify authenticity */
        if ( !isset($_POST['name_of_nonce_field']) ||
            !wp_verify_nonce( $_POST['name_of_nonce_field'], plugin_basename( __FILE__ ) ) )
            return;

        /** return if not correct post type */
        if ( 'galleries' != $_POST['post_type'] )
            return;

        if ( $_POST['gallery'] ){

            /** Build array for saving post meta */
            $gallery_data = array();
            for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ) {
                if ( '' != $_POST['gallery']['image_url'][ $i ] ) {
                    $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
                }
            }

            if ( $gallery_data ){
                update_post_meta( $post_id, 'gallery_data', $gallery_data );
            } else {
                delete_post_meta( $post_id, 'gallery_data' );
            }

        }else {
            /** Nothing received, all fields are empty, delete option */
            delete_post_meta( $post_id, 'gallery_data' );
        }
    }
}

$galleries = new WPGalleries();




