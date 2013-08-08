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



class Capitan::Connection
  require 'rest_client'
  require 'json'

  def initialize
    @config = load_config_file
  end

  def invoke_with_path(url, params = {})
    params[:api_key] = api_key
    response = get_response("#{base_url}/#{url}?#{hash_to_querystring(params)}")
    JSON.parse(response)
  end

  def invoke_with_full_url(url, params = {})
    params[:api_key] = api_key
    response = get_response("#{url}?#{hash_to_querystring(params)}")
    JSON.parse(response)
  end

  private

  def get_response(url)

    Rails.cache.fetch(url) do
      RestClient.get(url)
    end

  rescue RestClient::Unauthorized, SocketError => error
    capitan_error = Capitan::Exceptions::ConnectionError.new(error)
    capitan_error.set_backtrace(error.backtrace)
    raise capitan_error
  end

  def base_url
    @config["capitan"]["base_url"]
  end

  def api_key
    @config["capitan"]["api_key"]
  end

  def load_config_file
    YAML.load_file("#{RAILS_ROOT}/config/config.yml")[RAILS_ENV]
  end

  def hash_to_querystring(hash)
    hash.keys.inject('') do |query_string, key|
      query_string << '&' unless key == hash.keys.first
      query_string << "#{URI.encode(key.to_s)}=#{URI.encode(hash[key])}"
    end
  end

end