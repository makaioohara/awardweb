<?php
/**
 * Review Category Page
 *
 * @package Keenness
 */
?>

<?php get_header(); ?>

<section class="rest-of-the-webpage">
    <div>
        <h2 class="common-page-title"><?php wp_title('', true); ?></h2>
        <div>
            <?php
            $args_latest = array(
                'post_type'      => 'post',
                'posts_per_page' => 1,
                'category_name'  => 'reviews',
            );
            $latest_post = new WP_Query($args_latest);

            if ($latest_post->have_posts()) {
                while ($latest_post->have_posts()) {
                    $latest_post->the_post();
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="cat-review-top"><a href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                            <div class="common-review-score-div cat-review-top-score">
                                <?php
                                $score = get_post_meta(get_the_ID(), 'score', true);
                                if ($score) {
                                    echo '<h4>' . $score . '</h4>';
                                }
                                ?>
                            </div>
                        </a></div>
                        <?php
                    }
                }
            } else {
                echo '<div class="all-common-content">No post found! Please check back later.</div>';
            }

            wp_reset_postdata();
            ?>
        </div>
        <div>
            <h4>Recent Reviews</h4>
            <?php
            $latest_post_id = isset($latest_post->posts[0]) ? $latest_post->posts[0]->ID : null;

            $args_list = array(
                'post_type'      => 'post',
                'posts_per_page' => 10,
                'category_name'  => 'reviews',
                'order'          => 'DESC',
                'orderby'        => 'date',
                'post__not_in'   => array($latest_post_id),
            );

            $query_list = new WP_Query($args_list);

            if ($query_list->have_posts()) {
                while ($query_list->have_posts()) {
                    $query_list->the_post();
                    ?>
                    <div class="all-common-content has-bottom-margin"><strong class="review-score"><?php echo get_post_meta(get_the_ID(), 'score', true); ?></strong> - <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
    <div class="right-sidebar">
        <?php get_template_part('templates/right-sidebar'); ?>
    </div>
</section>

<?php get_footer(); ?>
