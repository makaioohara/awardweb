<?php

function keenness_customizer_register($wp_customize){

    // Site Identity Area
    $wp_customize->add_setting('keenness_logo', array(
        'default' => get_bloginfo('template_directory') . '/assets/img/logo.png',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'keenness_logo', array(
        'label' => 'Logo',
        'setting' => 'keenness_logo',
        'section' => 'title_tagline',
    )));
    
    // Footer Area
    $wp_customize->add_section('keenness_footer_option', array(
        'title' => __('Footer', 'keennesstoday'),
        'description' => 'Change or update your footer from here.'
    ));

    $wp_customize->add_setting('keenness_footer_text', array(
        'default' => '&copy; 2022 - 2025 keennesstoday.com - All rights reserved.<br>Any unauthorized use, reproduction or redistribution of Keenness Today&apos;s content for commercial or advertising purposes is strictly prohibited and constitutes copyright infringement liable to legal action.',
    ));

    $wp_customize->add_control('keenness_footer_text', array(
        'label' => 'Footer Text',
        'setting' => 'keenness_footer_text',
        'section' => 'keenness_footer_option',
        'type' => 'textarea',
        'input_attrs' => array(
            'style' => 'height: 200px;'
        )
    ));

    // Social Media Section
    $wp_customize->add_section('keenness_social_media_option', array(
        'title' => __('Social Media', 'keennesstoday'),
        'description' => 'Add links to your social media profiles here.',
    ));

    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting('keenness_social_media_name_' . $i, array(
            'default' => '',
        ));
    
        $wp_customize->add_control('keenness_social_media_name_' . $i, array(
            'label' => 'Social Media Name ' . $i,
            'type' => 'text',
            'section' => 'keenness_social_media_option',
        ));

        $wp_customize->add_setting('keenness_social_media_link_' . $i, array(
            'default' => '',
        ));
    
        $wp_customize->add_control('keenness_social_media_link_' . $i, array(
            'label' => 'Social Media Link ' . $i,
            'type' => 'text',
            'section' => 'keenness_social_media_option',
        ));

        $wp_customize->add_setting('keenness_social_media_icon_' . $i, array(
            'default' => '',
        ));
    
        $wp_customize->add_control('keenness_social_media_icon_' . $i, array(
            'label' => 'Social Media Icon ' . $i,
            'type' => 'text',
            'section' => 'keenness_social_media_option',
        ));
    }
}
add_action('customize_register', 'keenness_customizer_register');
