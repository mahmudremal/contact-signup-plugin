<?php
/** 
 * Plugin Name: Contact Signup Plugin
 * Description: A plugin that allows users to sign up for a contact list and view them as contact cards.
 * Version: 1.0
 * Author: Remal Mahmud
 */

defined('ABSPATH') || exit;// Exit if accessed directly

defined('CSP__FILE__') || define('CSP__FILE__', __FILE__);
// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/csp-frontend.php';
include_once plugin_dir_path(__FILE__) . 'includes/csp-block.php';
include_once plugin_dir_path(__FILE__) . 'includes/csp-admin.php';

function csp_register_rest_routes() {
    register_rest_route('csp/v1', '/contacts', [
        'methods' => 'GET',
        'callback' => 'csp_get_contacts',
    ]);
}
add_action('rest_api_init', 'csp_register_rest_routes');

function csp_get_contacts() {
    $results = get_posts([
        'post_type' => 'csp_user',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ]);
    // if ($results && !is_wp_error($results)) {
    //     foreach ($results as $post) {
    //         $_userinfo = get_post_meta($post->ID, '_user_info', true);
    //         $results[$index]->_userinfo = $userinfo;
    //     }
    // }
    return rest_ensure_response($results);
}
function csp_register_custom_post_type() {
    $labels = array(
      'name'                => __( 'CSP Users', 'csp-plugin' ),
      'singular_name'       => __( 'CSP User', 'csp-plugin' ),
      'menu_name'            => __( 'CSP Users', 'csp-plugin' ),
      'parent_item_plural'   => __( 'Parent CSP Users', 'csp-plugin' ),
      'all_items'            => __( 'All CSP Users', 'csp-plugin' ),
      'view_item'            => __( 'View CSP User', 'csp-plugin' ),
      'add_new_item'         => __( 'Add New CSP User', 'csp-plugin' ),
      'add_new'             => __( 'Add New CSP User', 'csp-plugin' ),
      'edit_item'            => __( 'Edit CSP User', 'csp-plugin' ),
      'update_item'         => __( 'Update CSP User', 'csp-plugin' ),
      'search_items'         => __( 'Search CSP User', 'csp-plugin' ),
      'not_found'            => __( 'No CSP User found', 'csp-plugin' ),
      'not_found_in_trash'  => __( 'No CSP Users found in Trash', 'csp-plugin' ),
    );
  
    $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array('slug' => 'csp_user'),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array('title', 'editor'),
      'show_in_rest'       => true, // Important for REST API support
    );
  
    register_post_type( 'csp_user', $args );
  }
  
  add_action( 'init', 'csp_register_custom_post_type' );
  