<?php
/**
 * What's New Page
 *
 * @package Keenness
 */
?>

<?php get_header(); ?>

<section class="rest-of-the-webpage">
    <div>
        <h2 class="common-page-title"><?php wp_title('', true); ?></h2>
        <div class="tabs-switch has-bottom-margin">
            <button class="active-tab">Feed</button></button>
            <button class="">Events</button>
        </div>
        <div class="whats-new-tabs active-tab-content">
            <?php
            $args = array(
                'post_type' => 'cnews',
                'posts_per_page' => 10,
                'orderby' => 'date',
                'order' => 'DESC',
            );

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) : ?>
                <div class="has-bottom-margin each-cnews-item">
                    <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                        <div class="each-cnews-meta common-discolored-text">
                            <img src="<?php echo esc_url(get_the_author_meta('profile_picture', $author_id)); ?>" alt="Profile Picture">
                            <div>
                                <a href="<?php echo home_url('/author/') . get_the_author_meta('user_nicename', $author_id); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                                <?php $post_time = get_the_time('U'); ?>
                                <div class="common-discolored-text"><?php echo human_time_diff($post_time, current_time('timestamp')) . ' ago'; ?></div>
                            </div>
                        </div>
                        <div class="all-common-content"><?php the_excerpt(); ?></div>
                        <div class="each-cnews-nonmeta">
                            <?php if (has_post_thumbnail()) : ?>
                                <img class="each-cnews-thumb" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <div class="each-cnews-inimage">
                                <div class="common-discolored-text each-cnews-cat">
                                    <?php
                                    $category = get_post_meta(get_the_ID(), 'cnews_category', true);
                                    echo esc_html($category);
                                    ?>
                                </div>
                            </div> 
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>No news found.</p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </div>
    <div class="right-sidebar">
        <?php get_template_part('templates/right-sidebar'); ?>
    </div>
</section>

<?php get_footer(); ?>
