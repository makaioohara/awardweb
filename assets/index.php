<?php
/**
 * Common Index file
 *
 * @package Keenness
 */
?>

<?php get_header() ?>

<section class="rest-of-the-webpage">
    <div>
        <h2 class="common-page-title"><?php wp_title('', true); ?></h2>
        <div class="all-common-content">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="right-sidebar">
        <?php get_template_part('templates/right-sidebar'); ?>
    </div>
</section>
    
<?php get_footer() ?>