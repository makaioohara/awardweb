<?php
/**
 * Single post comment template
 *
 * @package Keenness
 */
?>

<?php
// Do not allow direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                _nx(
                    '<h4>Thought</h4>',
                    '<h4>Thoughts</h4>',
                    get_comments_number(),
                    'comments title',
                    'keennesstoday'
                ),
                number_format_i18n( get_comments_number() ),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 40,
                'callback'    => 'custom_comment_output'
            ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="navigation comment-navigation" role="navigation">
                <div class="common-discolored-text has-a-margin"><?php previous_comments_link( __( 'Older Comments', 'keennesstoday' ) ); ?></div>
                <div class="common-discolored-text has-a-margin"><?php next_comments_link( __( 'Newer Comments', 'keennesstoday' ) ); ?></div>
            </nav>
        <?php endif; ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.', 'keennesstoday' ); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php comment_form( array(
        'comment_field' => '<div><textarea id="comment" name="comment" placeholder="Comment..." aria-required="true"></textarea></div>',
        'fields' => array(
            'author' => '<div><input id="author" name="author" placeholder="Your name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
            'email' => '<div><input id="email" name="email" placeholder="Email address" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        ),
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'title_reply' => '<h4>' . __( 'Your Opinion Matters', 'keennesstoday' ) . '</h4>',
        'class_submit' => 'comment-submit-button',
    )); ?>

</div>

<?php
// Custom function to output each comment
function custom_comment_output($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-meta has-bottom-margin">
                <?php
                    if ( 0 != $args['avatar_size'] ) {
                        $author_id = $comment->user_id;
                        $avatar_url = '';
                        
                        if ($author_id && get_the_author_meta('profile_picture', $author_id)) {
                            $avatar_url = esc_url(get_the_author_meta('profile_picture', $author_id));
                        } else {
                            $avatar_url = get_avatar_url($comment, array('size' => $args['avatar_size']));
                        }

                        echo '<img class="comment-author-img" src="' . $avatar_url . '" alt="' . esc_attr(get_comment_author()) . '" class="avatar" />';
                    }
                ?>

                <div class="common-discolored-text has-no-margin">
                    <?php printf('<b>%s</b>', get_comment_author()); ?>
                    <br>
                    <time datetime="<?php comment_time( 'c' ); ?>">
                        <?php printf( __( '%s ago', 'keennesstoday' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
                    </time>
                </div>
            </div>
            
            <div class="all-common-content">
                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <div><?php _e( 'Your comment is awaiting moderation.', 'keennesstoday' ); ?></div>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
        </article>
    </li>
<?php } ?> 