<?php
if (!isset($category_to_show)) {
    $category_to_show = 'anime';
}

$args = array(
    'post_type' => 'cnews',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'cnews_category',
            'value' => $category_to_show,
            'compare' => '='
        )
    )
);

$cnews_query = new WP_Query($args);

if ($cnews_query->have_posts()) :
?>
    <div class="concise-news-container">
        <?php while ($cnews_query->have_posts()) : $cnews_query->the_post(); ?>
            <div class="concise-news-card concise-news-card-<?php echo $category_to_show; ?>">
                <div class="concise-news-description all-common-content">
                    <div><?php the_excerpt(); ?></div>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                    <img class="concise-news-thumbnail" src="<?php the_post_thumbnail_url(); ?>">
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php
else :
    echo '<div class="all-common-content">No news found! Please check back later.</div>';
endif;

wp_reset_postdata();
?>
