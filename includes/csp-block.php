<?php
defined('ABSPATH') || exit;// Exit if accessed directly

function csp_register_block() {
    wp_register_script(
        'csp-block',
        plugins_url('assets/build/js/block.js', CSP__FILE__), // Make sure the path is correct
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data'],
        filemtime(plugin_dir_path(CSP__FILE__) . 'assets/build/js/block.js'),
        true
    );
    // 
    register_block_type('csp/contact-list', [
        'editor_script' => 'csp-block',
        'render_callback' => 'csp_render_contact_list',
        'attributes' => [
            'selectedPerson' => [
                'type' => 'string',
                'default' => '',
            ],
        ],
    ]);
}
add_action('init', 'csp_register_block');

function csp_render_contact_list($attributes) {
    $person_id = intval($attributes['selectedPerson']);
    $person_id = ($person_id && !empty($person_id))?$person_id:0;
    // 
    if ($person_id) {
        // $result = get_post($person_id);
        $_userinfo = get_post_meta($person_id, '_user_info', true);
        // 
        if ($_userinfo && !is_wp_error($_userinfo)) {
            $_userinfo = (object) $_userinfo;
            ob_start();
            ?>
            <div class="contact-card" data-persion="<?php echo esc_attr($person_id); ?>">
                <h2><?php echo esc_html($_userinfo->name); ?></h2>
                <p>Address: <?php echo esc_html($_userinfo->address); ?></p>
                <p>Phone: <?php echo esc_html($_userinfo->phone); ?></p>
                <p>Email: <?php echo esc_html($_userinfo->email); ?></p>
                <p>Hobbies: <?php echo esc_html($_userinfo->hobbies); ?></p>
            </div>
            <?php
            return ob_get_clean();
        } else {
            return '<p>Something went wrong!</p>';
        }
    }
    // 
    return '<p>No person selected.</p>';
}

