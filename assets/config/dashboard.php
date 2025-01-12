<?php

// Remove default dashboard widgets
function remove_dashboard_widgets() {
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function remove_site_health_status() {
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_site_health_status');

// Add custom dashboard widget showing number of posts by the logged-in user
function custom_dashboard_widget() {
    $user_id = get_current_user_id();
    $post_count = count_user_posts($user_id);
    ?>
    <div>
        <b><?php echo $post_count; ?></b>
    </div>
    <?php
}
function add_custom_dashboard_widget() {
    wp_add_dashboard_widget('custom_dashboard_widget', 'Your Post Count', 'custom_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');
