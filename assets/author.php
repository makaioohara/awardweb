<?php
/**
 * Author Page.
 *
 * @package Keenness
 */
?>

<?php get_header(); ?>

<section class="rest-of-the-webpage">
    <div>
        <?php
        $author_id = get_query_var('author');
        $author = get_user_by('ID', $author_id);
        ?>

        <div class="author-page-profile">
            <div class="author-page-top">
                <div class="author-page-banner">
                    <img src="<?php echo esc_url(get_the_author_meta('banner_link', $author_id)); ?>" alt="Profile Banner">
                </div>
                <div class="author-page-avatar">
                    <img src="<?php echo esc_url(get_the_author_meta('profile_picture', $author_id)); ?>" alt="Profile Picture">
                </div>
            </div>
            <div class="author-page-info">
                <h3 class="has-no-margin"><?php echo $author->display_name; ?></h3>
                <span class="author-page-website common-discolored-text has-a-margin">
                    <i class='bx bxs-hot bx-flip-horizontal bx-tada'></i>
                    <a href="<?php echo esc_url($author->user_url); ?>" target="_blank">Author Website</a>
                </span>
                <div class="all-common-content">
                    <?php echo wpautop($author->description); ?>
                </div>
            </div>
        </div>
        <?php
        $user_id = get_the_author_meta('ID');
        $anime_fields = array();

        for ($i = 1; $i <= 5; $i++) {
            $anime_name = get_user_meta($user_id, 'favorite_anime_' . $i, true);
            $anime_picture = get_user_meta($user_id, 'anime_picture_' . $i, true);

            if (!empty($anime_name) && !empty($anime_picture)) {
                $anime_fields[] = array(
                    'name' => $anime_name,
                    'picture' => $anime_picture
                );
            }
        }

        if (!empty($anime_fields)) {
            echo '<div class="separator-div"></div><div class="anime-section">';
            echo '<h4 class="common-section-title">Recommendations</h4>';
            echo '<div class="author-page-recommendation-list">';
            foreach ($anime_fields as $anime) {
                echo '<div class="author-page-each-recommendation">';
                echo '<img src="' . $anime['picture'] . '" alt="' . $anime['name'] . '">';
                echo '<div class="common-discolored-text has-a-margin">' . $anime['name'] . '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>
        <hr>
        <h4>From Author</h4>
        <?php get_template_part('templates/author-post-lists'); ?>
    </div>
    <div class="right-sidebar">
        <?php get_template_part('templates/right-sidebar'); ?>
    </div>
</section>

<?php get_footer(); ?>
