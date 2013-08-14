<?php

class CapitanConnection {

  public static function getResponse($url, $cache_key, $cache_time = 24) {
    $base_url = CapitanConnection::baseUrl();
    $url_format = "%s/capi/%s?api_key=%s";
    $response = CapitanConnection::getContent($cache_key,
      sprintf($url_format, $base_url, $url, CapitanConnection::apiKey()),
      $cache_time);

    $jsonResponse = json_decode($response);
    return $jsonResponse;
  }

  public static function baseUrl() {
    return get_option('capitan_domain');
  }

  public static function apiKey() {
    return get_option('capitan_api_key');
  }

/* gets the contents of a file if it exists, otherwise grabs and caches */
 public static function getContent($cache_key, $url, $cache_time) {
	//vars
  $file = $cache_key . ".txt";
	$current_time = time();
  $expire_time = $cache_time * 60 * 60;
  $file_time = filemtime($file);
	//decisions, decisions
	if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
		//echo 'returning from cached file';
		$json = file_get_contents($file);
	}
	else {
		$content = CapitanConnection::getUrl($url);
		file_put_contents($file,$content);
		//echo 'retrieved fresh from '.$url.':: '.$content;
		$json = $content;
	}
  return $json;
}

/* gets content from a URL via curl */
public static function getUrl($url) {


  $defaults = array(
      CURLOPT_POST => 0,
      CURLOPT_HEADER => 0,
      CURLOPT_URL => $url,
      CURLOPT_FRESH_CONNECT => 1,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_FORBID_REUSE => 1,
      CURLOPT_TIMEOUT => 10
  );

  $ch = curl_init();
  curl_setopt_array($ch, ($defaults));
  $response = curl_exec($ch);
  curl_close($ch);
	return $response;
}

}

?>