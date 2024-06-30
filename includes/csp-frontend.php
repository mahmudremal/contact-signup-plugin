<?php
defined('ABSPATH') || exit;// Exit if accessed directly


function csp_add_rewrite_rule() {
    add_rewrite_rule('^sign-up/?$', 'index.php?csp_signup_form=1', 'top');
}
add_action('init', 'csp_add_rewrite_rule');
function csp_add_query_vars($vars) {
    $vars[] = 'csp_signup_form';
    return $vars;
}
add_filter('query_vars', 'csp_add_query_vars');

// Load template
function csp_template_redirect() {
    if (get_query_var('csp_signup_form')) {
        include plugin_dir_path(CSP__FILE__) . 'templates/signup-form-template.php';
        exit;
    }
}
add_action('template_redirect', 'csp_template_redirect');

// Flush rewrite rules on activation
function csp_rewrite_flush() {
    csp_add_rewrite_rule();
    flush_rewrite_rules();
}
register_activation_hook(CSP__FILE__, 'csp_rewrite_flush');


function csp_save_user() {
    if (isset($_POST['submit_signup'])) {
        $name = sanitize_text_field($_POST['name']);
        $address = sanitize_text_field($_POST['address']);
        $phone = sanitize_text_field($_POST['phone']);
        $email = sanitize_email($_POST['email']);
        $hobbies = sanitize_text_field($_POST['hobbies']);

        $user_id = wp_insert_post([
            'post_type' => 'csp_user',
            'post_title'    => $name,
            'post_content'  => '',
            'post_status'   => 'publish',
        ]);
        if ($user_id && !is_wp_error($user_id)) {
            update_post_meta($user_id, '_user_info', [
                'name' => sanitize_text_field($_POST['name']),
                'address' => sanitize_text_field($_POST['address']),
                'phone' => sanitize_text_field($_POST['phone']),
                'email' => sanitize_email($_POST['email']),
                'hobbies' => sanitize_text_field($_POST['hobbies'])
            ]);
            // We can also send without sanitize because on inline update_metadata function sanitize it before sending to database.
        } else {
            // Something went wrong and needs to notify.
        }
    }
}
add_action('init', 'csp_save_user');

function csp_insert_public_css() {
    wp_register_style('csp-public-css', plugins_url('assets/build/css/public.css', CSP__FILE__), [], filemtime(plugin_dir_path(CSP__FILE__) . 'assets/build/css/public.css'), 'all');
    wp_enqueue_style('csp-public-css');
}
add_action('init', 'csp_insert_public_css');