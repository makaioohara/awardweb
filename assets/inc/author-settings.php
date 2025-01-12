<?php

function add_custom_user_profile_fields( $contactmethods ) {
    $user = wp_get_current_user();
    $user_roles = (array) $user->roles;

    // Set default links for avatar and banner fields
    $default_avatar_link = 'https://i.ibb.co/ssDR7v2/Untitled1730-20240416235048-2.png';
    $default_banner_link = 'https://i.ibb.co/THShvm3/Banners-20240416-222603-0000.jpg';
    
    // Allow everyone to edit banner and profile picture
    if (!isset($contactmethods['profile_picture'])) {
        $contactmethods['profile_picture'] = 'Profile Picture Link [Please consider using an image hosting platform to upload your favorite anime\'s picture, (e.g. imgbb). Also make sure your image link ends with an extension of (.png or .jpg)]';
    }
    if (!isset($contactmethods['banner_link'])) {
        $contactmethods['banner_link'] = 'Banner Link';
    }
    
    if (empty(get_user_meta($user->ID, 'profile_picture', true))) {
        update_user_meta($user->ID, 'profile_picture', $default_avatar_link);
    }
    if (empty(get_user_meta($user->ID, 'banner_link', true))) {
        update_user_meta($user->ID, 'banner_link', $default_banner_link);
    }
    
    $contactmethods['favorite_anime_1'] = 'Anime Name 1 [Anime that you recommend others]';
    $contactmethods['anime_picture_1'] = 'Picture URL for Anime 1';
    $contactmethods['favorite_anime_2'] = 'Anime Name 2';
    $contactmethods['anime_picture_2'] = 'Picture URL for Anime 2';
    $contactmethods['favorite_anime_3'] = 'Anime Name 3';
    $contactmethods['anime_picture_3'] = 'Picture URL for Anime 3';
    $contactmethods['favorite_anime_4'] = 'Anime Name 4';
    $contactmethods['anime_picture_4'] = 'Picture URL for Anime 4';
    $contactmethods['favorite_anime_5'] = 'Anime Name 5';
    $contactmethods['anime_picture_5'] = 'Picture URL for Anime 5';
    
    return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_custom_user_profile_fields', 10, 1 );

// Author URL
add_action('init', 'wp_custom_author_urlbase');
function wp_custom_author_urlbase() {
    global $wpdb;

    $users = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users");

    foreach ($users as $user) {
        $sanitized_display_name = str_replace(array(' ', '-'), '', $user->display_name);
        $author_slug = sanitize_title($sanitized_display_name);
        $wpdb->update($wpdb->users, array('user_nicename' => $author_slug), array('ID' => $user->ID));
    }
}
