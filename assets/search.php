<?php
/**
 * Search Page
 *
 * @package Keenness
 */
?>

<?php get_header(); ?>

<section class="rest-of-the-webpage">
    <div>
        <h2 class="common-page-title">
            <?php 
            if ( have_posts() ) {
                echo 'Showing results for - ' . get_search_query();
            } else {
                echo 'Your search - ' . get_search_query() . ' - did not match any content';
            }
            ?>
        </h2>
        <div class="all-common-content">
            <?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
            } else {
                echo '<p>No content found. Please make sure that all words are spelled correctly and also try different keywords.</p>';
            }
            ?>
        </div>
    </div>
    <div class="right-sidebar">
        <?php get_template_part('templates/right-sidebar'); ?>
    </div>
</section>

<?php get_footer(); ?>
