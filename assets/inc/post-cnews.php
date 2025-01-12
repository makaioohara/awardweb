<?php

function concise_news(){
    register_post_type ('cnews',
        array(
            'labels' => array(
                'name' => _x('News', 'Post Type General Name', 'keennesstoday'),
		'singular_name' => _x('News', 'Post Type Singular Name', 'keennesstoday'),
		'menu_name' => _x('News', 'Admin Menu text', 'keennesstoday'),
		'name_admin_bar' => _x('News', 'Add New on Toolbar', 'keennesstoday'),
		'archives' => __('News Archives', 'keennesstoday'),
		'attributes' => __('News Attributes', 'keennesstoday'),
		'parent_item_colon' => __('Parent News:', 'keennesstoday'),
		'all_items' => __('All News', 'keennesstoday'),
		'add_new_item' => __('Add New News', 'keennesstoday'),
		'add_new' => __('Add New news', 'keennesstoday'),
		'new_item' => __('New News', 'keennesstoday'),
		'edit_item' => __('Edit News', 'keennesstoday'),
		'update_item' => __('Update News', 'keennesstoday'),
		'view_item' => __('View News', 'keennesstoday'),
		'view_items' => __('View News', 'keennesstoday'),
		'search_items' => __('Search News', 'keennesstoday'),
		'not_found' => __('Not found', 'keennesstoday'),
		'not_found_in_trash' => __('Not found in Trash', 'keennesstoday'),
		'featured_image' => __('Featured Image', 'keennesstoday'),
		'set_featured_image' => __('Set featured image', 'keennesstoday'),
		'remove_featured_image' => __('Remove featured image', 'keennesstoday'),
		'use_featured_image' => __('Use as featured image', 'keennesstoday'),
		'insert_into_item' => __('Insert into News', 'keennesstoday'),
		'uploaded_to_this_item' => __('Uploaded to this News', 'keennesstoday'),
		'items_list' => __('News list', 'keennesstoday'),
		'items_list_navigation' => __('News list navigation', 'keennesstoday'),
		'filter_items_list' => __('Filter News list', 'keennesstoday'),
            ),
            'menu_icon' => 'dashicons-superhero-alt',
            'public' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'menu_position' => 7, 
            'has_archive' => false,
            'hierarchical' => false,
            'show_ui' => true,
            'capability_type' => 'post',
            'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
            'register_meta_box_cb' => 'add_cnews_category_meta_box',
            'show_in_rest' => true, 
        )
    );
}

add_action('init', 'concise_news');

function add_cnews_category_meta_box() {
    add_meta_box(
        'cnews_category_meta_box',
        'Category',
        'cnews_category_meta_box_callback',
        'cnews',
        'side',
        'default'
    );
}

function cnews_category_meta_box_callback($post) {
    $category = get_post_meta($post->ID, 'cnews_category', true);
    ?>
    <select name="cnews_category" id="cnews_category">
        <option value="anime" <?php selected($category, 'anime'); ?>>Anime</option>
        <option value="manga" <?php selected($category, 'manga'); ?>>Manga</option>
        <option value="other" <?php selected($category, 'other'); ?>>Other</option>
    </select>
    <?php
}

add_action('save_post', 'save_cnews_category_meta_box');
function save_cnews_category_meta_box($post_id) {
    if (array_key_exists('cnews_category', $_POST)) {
        update_post_meta(
            $post_id,
            'cnews_category',
            $_POST['cnews_category']
        );
    }
}

add_filter('manage_cnews_posts_columns', 'custom_cnews_columns');
function custom_cnews_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __('Title'),
        'category' => __('Category'),
        'author' => __('Author'),
        'date' => __('Date'),
    );
    return $columns;
}

add_action('manage_cnews_posts_custom_column', 'custom_cnews_column_content', 10, 2);
function custom_cnews_column_content($column, $post_id) {
    switch ($column) {
        case 'excerpt':
            echo get_the_excerpt($post_id);
            break;
        case 'category':
            $category = get_post_meta($post_id, 'cnews_category', true);
            echo esc_html($category);
            break;
        default:
            break;
    }
}