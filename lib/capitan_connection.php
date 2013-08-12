<?php

class CapitanConnection {

  public static function getResponse($url) {
    $base_url = CapitanConnection::baseUrl();


    $defaults = array(
        CURLOPT_POST => 0,
        CURLOPT_HEADER => 0,
        CURLOPT_URL => $url,
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FORBID_REUSE => 1,
        CURLOPT_TIMEOUT => 4
    );

    $ch = curl_init();
    curl_setopt_array($ch, ($defaults));
    $response = curl_exec($ch);
    curl_close($ch);
    $jsonResponse = json_decode($response);
    return $jsonResponse;

  }

  public static function baseUrl() {
    return get_option('capitan_domain');
  }

  public static function apiKey() {
    return get_option('capitan_api_key');
  }

}

?>