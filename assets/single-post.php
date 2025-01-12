<?php
/**
 * Single post page
 *
 * @package Keenness
 */
?>

<?php get_header(); ?>

<?php setPostViews(get_the_ID()); ?>

<section class="rest-of-the-webpage">
    <div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div>
                <div class="common-discolored-text has-a-margin">
                    <?php
                    $tags_list = get_the_tags();
                    if ($tags_list) {
                        $tag_count = count($tags_list);
                        $i = 1;
                        foreach ($tags_list as $tag) {
                            echo '<span class="common-tags-span"><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></span>';
                            if ($i >= 2) {
                                break;
                            }
                        }
                    }
                    ?>
                </div>
                <h2 class="common-page-title has-no-margin"><?php wp_title('', true); ?></h2>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php 
                    $thumbnail_id = get_post_thumbnail_id();
                    $thumbnail_description = get_post_field('post_content', $thumbnail_id);
                    if (!empty($thumbnail_description)) : ?>
                        <div class="smallest-text">Image: <?php echo $thumbnail_description; ?></div>
                    <?php endif; ?> 
                    <?php
                    // Display spoiler alert message if the post contains spoilers
                    $spoiler_alert = get_post_meta(get_the_ID(), 'spoiler_alert', true);
                    if ($spoiler_alert == '1') : ?>
                        <div class="has-top-margin smallest-text" style="color: #E0CB5C;">
                            <b>Warning: </b>May contain unwanted spoiler and/or graphic images with violence and exposed nipples.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="post-content all-common-content">
                    <?php the_content(); ?>
                </div>
                <?php
                $score = get_post_meta(get_the_ID(), 'score', true);
                $postexcerpt = get_the_excerpt();
                if (has_category('reviews')) {
                    echo '
                    <div class="single-post-scoreboard-container">
                        <div class="single-post-scoreboard-a">
                            <div class="common-review-score-div single-post-scoreboard-score-div">
                                 <h4>' . $score . '</h4>
                            </div>
                            <a class="common-discolored-text">In Rating Scale</a>
                        </div>
                        <div>
                            <h3>';
                    
                    if ($score == 1) {
                        echo 'Unbearable';
                    } elseif ($score == 1.5 || $score == 2) {
                        echo 'Terrible';
                    } elseif ($score == 2.5 || $score == 3) {
                        echo 'Bad';
                    } elseif ($score == 3.5 || $score == 4) {
                        echo 'Poor';
                    } elseif ($score == 4.5 || $score == 5) {
                        echo 'Acceptable';
                    } elseif ($score == 5.5 || $score == 6) {
                        echo 'Average';
                    } elseif ($score == 6.5 || $score == 7) {
                        echo 'Good';
                    } elseif ($score == 7.5 || $score == 8) {
                        echo 'Great';
                    } elseif ($score == 8.5 || $score == 9) {
                        echo 'Excellent';
                    } elseif ($score == 9.5) {
                        echo 'Exceptional';
                    } elseif ($score == 10) {
                        echo 'Masterpiece';
                    }
            
                    echo '</h3>
                        </div>
                        <div class="all-common-content">'
                            . $postexcerpt . 
                        '</div>
                    </div>
                    ';
                }
                ?>
                <?php $author_id = get_the_author_meta('ID'); ?>
                <div class="single-post-author common-discolored-text has-a-margin">
                    <img src="<?php echo esc_url(get_the_author_meta('profile_picture', $author_id)); ?>" alt="Profile Picture">
                    <div>By <a href="<?php echo home_url('/author/') . get_the_author_meta('user_nicename', $author_id); ?>"><?php echo get_the_author_meta('display_name'); ?></a></div>
                </div>
                <hr>
                <?php
                $source = get_post_meta(get_the_ID(), 'source', true);
                if (!empty($source)) :
                ?>
                    <div class="post-source common-discolored-text has-a-margin">
                        <div>Source: <?php echo wp_kses_post($source); ?></div>
                    </div>
                    <hr>
                <?php endif; ?>
                </div>
                <div>
                    <?php
                    $post_time = get_the_time('U');
                    $modified_time = get_the_modified_time('U');
    
                        if ($modified_time != $post_time) :
                    ?>
                            <div class="common-discolored-text has-a-margin">Updated: <?php echo human_time_diff($modified_time, current_time('timestamp')) . ' ago'; ?></div>
                            <hr>
                    <?php endif; ?>
                    <div class="common-discolored-text has-a-margin">Posted: <?php echo human_time_diff($post_time, current_time('timestamp')) . ' ago'; ?></div>
                    <hr>
                </div>
                <div class="single-post-meta common-discolored-text has-a-margin">
                    <span>
                        <i class='bx bx-paper-plane'></i>
                        <?php echo getPostViews(get_the_ID()); ?> Views
                    </span>
                    <span>
                        <i class='bx bx-message-square-dots'></i>
                        <?php echo get_comments_number(); ?> Comments
                    </span>
                </div>
                <hr>
                <div id="comments_area">
                    <?php comments_template(); ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
    <div class="right-sidebar">
        <?php get_template_part('templates/right-sidebar'); ?>
    </div>
</section>

<?php get_footer(); ?>