<?php
defined('ABSPATH') || exit;// Exit if accessed directly

function csp_admin_menu() {
    add_menu_page(
        __('Contact Signups', 'domain'),
        __('Contact Signups', 'domain'),
        'manage_options',
        'csp-admin',
        'csp_render_admin_page',
        'dashicons-admin-users',
        6
    );
}
add_action('admin_menu', 'csp_admin_menu');

function csp_render_admin_page() {
    ?>
    <div id="csp-admin-app"></div>
    <script src="<?php echo plugins_url('assets/build/js/admin.js', CSP__FILE__); ?>"></script>
    <?php
}
