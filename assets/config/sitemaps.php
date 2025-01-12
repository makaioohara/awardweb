<?php
add_action('init', 'generate_post_sitemap');

function generate_post_sitemap() {
    if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === '/post-sitemap.xml') {
        header('Content-Type: application/xml');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_url = get_permalink();
                $post_modified = get_the_modified_date('c');
                echo '<url>';
                echo '<loc>' . esc_url($post_url) . '</loc>';
                echo '<lastmod>' . esc_html($post_modified) . '</lastmod>';
                echo '</url>';
            }
        }
        echo '</urlset>';
        $file_path = ABSPATH . 'post-sitemap.xml';
        file_put_contents($file_path, ob_get_contents());
        exit;
    }
}