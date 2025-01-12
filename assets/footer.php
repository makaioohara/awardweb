        <footer class="footer-area">
            <div class="footer-social-media">
                <?php
                    for ($i = 1; $i <= 5; $i++) {
                        $social_media_link = get_theme_mod('keenness_social_media_link_' . $i);
                        $social_media_icon = get_theme_mod('keenness_social_media_icon_' . $i);

                        if (!empty($social_media_link) && !empty($social_media_icon)) {
                ?>
                <a href="<?php echo esc_url($social_media_link); ?>" target="_blank" rel="noopener noreferrer">
                    <img class="footer-social-media-icon" src="<?php echo esc_url($social_media_icon); ?>" alt="Social Media Icon <?php echo $i; ?>">
                </a>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="footer-nav-menu common-discolored-text">
                <?php wp_nav_menu( array('theme_location' => 'footer_menu', 'menu_id' => 'nav') ); ?>
            </div>
            <div class="footer-copyright-area all-common-content">
                <p><?php echo get_theme_mod('keenness_footer_text'); ?></p>
            </div>
        </footer>
    
  <?php wp_footer(); ?>
</body>
</html>