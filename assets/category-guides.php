<?php
/**
 * Guide Category Page
 *
 * @package Keenness
 */
?>

<?php get_header(); ?>

<section class="rest-of-the-webpage">
    <div>
        <h2 class="common-page-title"><?php wp_title('', true); ?></h2>
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'category_name' => 'guides',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            echo '<h5><ol>';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li class="has-bottom-margin"><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ol></h5>';
        }

        wp_reset_postdata();
        ?>
    </div>
    <div class="right-sidebar">
        <?php get_template_part('templates/right-sidebar'); ?>
    </div>
</section>

<?php get_footer(); ?>
