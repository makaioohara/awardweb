<?php
/**
 * Header template.
 *
 * @package Keenness
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#B00E40">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> 
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php
    if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
    }
    ?>
    <nav class="sidenavbar sidenavbar-close all-common-content">
        <header>
            <div class="logo-tagline">
                <span class="main-logo">
                    <img src="<?php echo get_theme_mod('keenness_logo'); ?>" alt="">
                </span>
                <span class="main-tagline"><?php echo get_bloginfo('description'); ?></span>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="unique-menu-bar">
            <div class="top-menu-content">
                <li class="unique-search-box parent-menu-item">
                    <i class='bx bx-search unique-menu-icon' ></i>
                    <input id="search-input" class="all-common-content" type="text" placeholder="Search...">
                </li>
                <li class="parent-menu-item">
                    <div>
                        <a href="<?php echo home_url(); ?>">
                            <i class='bx bx-credit-card-front unique-menu-icon' ></i>
                            <span class="unique-menu-text">Home</span>
                        </a>
                    </div>
                </li>
                <li class="parent-menu-item">
                    <div>
                        <a href="<?php echo home_url(); ?>/whats-new">
                            <i class='bx bx-time-five unique-menu-icon'></i>
                            <span class="unique-menu-text">What's New</span>
                        </a>
                    </div>
                </li>
                <li class="parent-menu-item">
                    <div>
                        <a href="<?php echo home_url(); ?>/reviews">
                            <i class='bx bx-like unique-menu-icon'></i>
                            <span class="unique-menu-text">Reviews</span>
                        </a>
                    </div>
                </li>
                <li class="parent-menu-item">
                    <div>
                        <a href="<?php echo home_url(); ?>/guides">
                            <i class='bx bx-book-bookmark unique-menu-icon'></i>
                            <span class="unique-menu-text">Guides</span>
                        </a>
                    </div>
                </li>
            </div>
            <div class="bottom-menu-content">
                <li class="parent-menu-item">
                    <div>
                        <a id="share-option">
                            <i class='bx bx-share unique-menu-icon' ></i>
                            <span class="unique-menu-text">Share</span>
                        </a>
                    </div>
                </li>
            </div>    
        </div>
    </nav>
    <div class="toppest-bar all-common-content">
        <div>V 2.4.7: The site is still being developed, please adjust with the bugs!</div>
    </div>

<?php
/* This part is for submenu
                <li class="parent-menu-item submenu-containing-menu">
                    <div>
                        <a href="#">
                            <i class='bx bx-bookmark unique-menu-icon' ></i>
                            <span class="unique-menu-text">News</span>
                            <i class='bx bxs-chevron-down unique-menu-icon'></i>
                        </a>
                        <ul class="submenu-content">
                            <li><a href="<?php echo home_url(); ?>/news/anime/"><span class="unique-menu-text">Anime</span></a></li>
                            <li><a href="<?php echo home_url(); ?>/news/manga/"><span class="unique-menu-text">Manga</span></a></li>
                            <li><a href="<?php echo home_url(); ?>/news/other/"><span class="unique-menu-text">Other</span></a></li>
                        </ul>
                    </div>
                </li>
*/
?>