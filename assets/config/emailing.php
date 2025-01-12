<?php

function notify_on_failed_login_attempt($username) {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $device_type = (strpos($user_agent, 'Mobile') !== false) ? 'Mobile' : 'PC';

    $region = '';
    $ip_info = json_decode(file_get_contents("http://ipinfo.io/{$ip_address}/json"));
    if ($ip_info && isset($ip_info->region)) {
        $region = $ip_info->region;
    }

    $to = 'keennesstoday@gmail.com';
    $subject = 'Failed login attempt for user ' . $username . ' at ' . date('Y-m-d H:i:s');
    $message = 'A login attempt failed for user: ' . $username . "\n" . 'IP Address: ' . $ip_address . "\n" . 'User Agent: ' . $user_agent . "\n" . 'Device Type: ' . $device_type . "\n" . 'Region: ' . $region;

    wp_mail($to, $subject, $message);
}
add_action('wp_login_failed', 'notify_on_failed_login_attempt');

function notify_on_new_login($user_login, $user) {
    $to = 'keennesstoday@gmail.com'; // Change this to your email address
    $subject = 'User ' . $user_login . ' has logged in at ' . date('Y-m-d H:i:s');
    $message = 'New login detected on your website';
    wp_mail($to, $subject, $message);
}
add_action('wp_login', 'notify_on_new_login', 10, 2);
?>
