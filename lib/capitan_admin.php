<?php

class CapitanAdmin {

  public function capitanOptions() {
    include "views/capitan_options.php";
  }

  public function registerCapitanSettings() {
    // whitelist options
    register_setting( 'capitan-settings-group', 'capitan_domain' );
    register_setting( 'capitan-settings-group', 'capitan_api_key' );
  }

  public function enqueueJavascript() {
    wp_enqueue_script("jquery");
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-validate', plugins_url("/js/jquery.validate.min.js", __FILE__));
  }

  public function enqueueCSS() {
    wp_enqueue_style('capitanStyle', plugins_url( "/Festivity/lib/css/capitan.css"));
  }

  public function addCapitanAdminMenu() {
    add_menu_page( 'Capitan', 'Capitan', 'manage_options', 'capitan', array('CapitanAdmin', 'capitanOptions'), NULL);
  }

  private function savecapitanOptions(){
  }


}

?>