<?php

function userIPaddress() {
  // Check if transient exists
  $transient = get_transient('user_ip_address');
  if (!empty($transient)) {
    return $transient;
  } else {

    // GET the IP address
    $url = 'http://bot.whatismyipaddress.com/';
    $response = wp_remote_get($url);
    $ipadd = $response['body'];

    // Store the IP in a transient user_ip_address
    set_transient('user_ip_address', $ipadd, HOUR_IN_SECONDS);

    // Return the user_ip_address
    return $ipadd;
  }
}

add_shortcode('user_ip_address', 'userIPaddress');

?>