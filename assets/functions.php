<?php

// Theme Title
add_theme_support('title-tag');

// Theme CSS and JQuery
include_once('inc/enqueue.php');

// Author Functions
include_once('inc/author-settings.php');

// Custom
include_once('inc/post-cnews.php');

// PHP Defaults
include_once('inc/post-extra.php');

// Theme Function
include_once('inc/customizer.php');

// Login Page
include_once('config/login-page.php');

// Dashboard
include_once('config/dashboard.php');

// Email Feature
include_once('config/emailing.php');

// Sitemap Generation
include_once('config/sitemaps.php');

// Menu Register
register_nav_menu( 'footer_menu', __('Footer Menu', 'keennesstoday') );