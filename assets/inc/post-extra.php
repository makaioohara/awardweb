<?php

// Thumbnil Image Area
add_theme_support( 'post-thumbnails', array('page', 'post', 'cnews') );

// Function to track post views
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return " ";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Add custom field for source
function add_source_field() {
    add_meta_box(
        'source_field',
        'Source',
        'display_source_field',
        'post',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_source_field');

function display_source_field($post) {
    $source = get_post_meta($post->ID, 'source', true);
    wp_nonce_field('source_nonce', 'source_nonce');
    ?>
    <p>Just paste the source link if you don't know how to use html 'a' tag. Leave it empty if you are not writing a news post.</p>
    <textarea name="source" id="source" rows="5" style="width: 100%;"><?php echo esc_html($source); ?></textarea>
    <?php
}

function save_source_field($post_id) {
    if (!isset($_POST['source_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['source_nonce'], 'source_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['source'])) {
        update_post_meta($post_id, 'source', wp_kses_post($_POST['source']));
    }
}
add_action('save_post', 'save_source_field');

// Add custom field for score
function add_score_field() {
    add_meta_box(
        'score_field',
        'Score',
        'display_score_field',
        'post',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_score_field');

function display_score_field($post) {
    $score = get_post_meta($post->ID, 'score', true);
    wp_nonce_field('score_nonce', 'score_nonce');
    ?>
    <p>Leave it empty if you are not writing a review post.</p>
    <select name="score" id="score">
        <?php for ($i = 2; $i <= 20; $i++) {
            $value = $i / 2;
            $selected = ($score == $value) ? 'selected' : '';
            echo "<option value='$value' $selected>$value</option>";
        } ?>
    </select>
    <?php
}

function save_score_field($post_id) {
    if (!isset($_POST['score_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['score_nonce'], 'score_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['score'])) {
        $score = floatval($_POST['score']);
        // Ensure score is between 1 and 10
        $score = max(1, min(10, $score));
        update_post_meta($post_id, 'score', $score);
    }
}
add_action('save_post', 'save_score_field');

// Add custom field for SEO metawords
function add_seo_metawords_field() {
    add_meta_box(
        'seo_metawords_field',
        'SEO Metawords',
        'display_seo_metawords_field',
        'post',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_seo_metawords_field');

function display_seo_metawords_field($post) {
    $seo_metawords = get_post_meta($post->ID, 'seo_metawords', true);
    wp_nonce_field('seo_metawords_nonce', 'seo_metawords_nonce');
    ?>
    <p>Enter SEO metawords separated by commas. Eg. - Jobless Reincarnation, Isekai, Reincarnation, Moushuko Tensei</p>
    <input type="text" name="seo_metawords" id="seo_metawords" value="<?php echo esc_attr($seo_metawords); ?>" style="width: 100%;">
    <?php
}

function save_seo_metawords_field($post_id) {
    if (!isset($_POST['seo_metawords_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['seo_metawords_nonce'], 'seo_metawords_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['seo_metawords'])) {
        $seo_metawords = sanitize_text_field($_POST['seo_metawords']);
        $seo_metawords = rtrim($seo_metawords, ',');
        update_post_meta($post_id, 'seo_metawords', $seo_metawords);
    }
}
add_action('save_post', 'save_seo_metawords_field');

function add_custom_meta_tags() {
    $default_keywords = 'Anime Bangladesh, Anime News, Bangladesh, Anime, Manga, Keenness Today';
    
    if (is_single()) {
        global $post;
        $seo_metawords = get_post_meta($post->ID, 'seo_metawords', true);
        if (!empty($seo_metawords)) {
            $keywords = $seo_metawords . ', ' . $default_keywords;
        } else {
            $keywords = $default_keywords;
        }
    } else {
        $keywords = $default_keywords;
    }

    echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . PHP_EOL;
}
add_action('wp_head', 'add_custom_meta_tags'); 

// Add custom field for spoiler alert
function add_spoiler_alert_field() {
    add_meta_box(
        'spoiler_alert_field',
        'Spoiler Alert',
        'display_spoiler_alert_field',
        'post',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_spoiler_alert_field');

function display_spoiler_alert_field($post) {
    $spoiler_alert = get_post_meta($post->ID, 'spoiler_alert', true);
    wp_nonce_field('spoiler_alert_nonce', 'spoiler_alert_nonce');
    ?>
    <input type="checkbox" name="spoiler_alert" id="spoiler_alert" value="1" <?php checked($spoiler_alert, '1'); ?> />
    <span>Check this box if the article contains spoilers.</span>
    <?php
}

function save_spoiler_alert_field($post_id) {
    if (!isset($_POST['spoiler_alert_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['spoiler_alert_nonce'], 'spoiler_alert_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    $spoiler_alert = isset($_POST['spoiler_alert']) ? '1' : '';
    update_post_meta($post_id, 'spoiler_alert', $spoiler_alert);
}
add_action('save_post', 'save_spoiler_alert_field');
