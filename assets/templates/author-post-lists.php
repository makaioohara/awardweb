<?php
$args = array(
    'posts_per_page' => 15,
    'post_type' => 'post',
    'author' => get_query_var('author'),
    'orderby' => 'date',
    'order' => 'DESC'
);

$query = new WP_Query($args);

$post_counter = 0;
$total_posts = $query->post_count;

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        $post_counter++;
?>
        <div class="post-listing-1">
            <div class="post-listing-1-thumbcontent">
                <div class="post-listing-1-thumb has-bottom-margin">
                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('post-thumbnails'); ?></a>
                </div>
                <div>
                    <div class="common-discolored-text has-a-margin">
                        <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                    </div>
                    <div>
                        <h5><a href="<?php the_permalink(); ?>">
                            <?php
                            $title = get_the_title();
                            echo strlen($title) > 50 ? substr($title, 0, 50) . '...' : $title;
                            ?>
                        </a></h5>
                    </div>
                </div>
            </div>
            <?php
            $post_tags = get_the_tags();
            if ($post_tags) {
                echo '<div class="common-discolored-text has-a-margin">';
                $tag_counter = 0;
                foreach ($post_tags as $tag) {
                    $tag_counter++;
                    echo '<span class="common-tags-span">' . $tag->name . '</span>';
                    if ($tag_counter >= 2) {
                        break;
                    }
                }
                echo '</div>';
            }
            ?>
        </div>
<?php
        if ($post_counter !== $total_posts) {
            echo '<hr>';
        }
    endwhile;
    wp_reset_postdata();
else :
    _e('<div class="all-common-content has-bottom-margin">No post found! Please check back later.</div>');
endif;
?>
