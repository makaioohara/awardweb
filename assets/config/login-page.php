<?php

// Loading CSS file

function login_enqueue_register(){
  wp_enqueue_style( 'login_enqueue', get_stylesheet_directory_uri(). "/css/login.css", array(), "1.0.1", "all" );

}
add_action('login_enqueue_scripts', 'login_enqueue_register');

// Changing Login form logo

function login_logo_change(){
  ?>
  <style>
    #login h1 a, .login h1 a{
      background-image: url(<?php print get_stylesheet_directory_uri(); ?>/assets/img/logo.png);
      height: 50px;
      width: 200px;
      background-size: contain;
      background-repeat: no-repeat;
      margin-top: 20px;
    }
  </style>

  <?php
}
add_action( 'login_enqueue_scripts', 'login_logo_change');

function login_logo_url_change(){
  return home_url();
}
add_filter( 'login_headerurl', 'login_logo_url_change');