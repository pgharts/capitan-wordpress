<?php
/*
Plugin Name: Capitan for Wordpress
Plugin URI: https://github.com/pgharts/capitan-wordpress
Description: Festival and Event management.
Version: 0.1
Author: The Pittsburgh Cultural Trust
Author URI: https://github.com/pgharts/
License: GPL3
*/

/*  Copyright 2013  The Pittsburgh Cultural Trust  (email : sipple@pgharts.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

new Capitan();

class Capitan {

  // set up the initialization hooks for the plugin
  function __construct() {
    require_once "lib/capitan_autoloader.php";
    require_once 'lib/capitan_shortcode.php';
    require_once 'lib/capitan_ajax.php';

    add_action('admin_menu', array('CapitanAdmin', 'addCapitanAdminMenu'));
    add_action('admin_init', array('CapitanAdmin', 'registerCapitanSettings'));
    add_action('init', array(__CLASS__, 'enqueueStylesAndScripts'));
    add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueueJavascripts'));
    //add_action( 'widgets_init', create_function( '', 'register_widget( "capitan_widget" );' ) );
  }

  function enqueueJavascripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('capitan_widget', plugins_url('/capitan/lib/js/calendar_widget.js') );
  }
  function enqueueStylesAndScripts() {
    add_action('wp_print_styles', array(__CLASS__, 'enqueueCSS'));
  }

  public static function enqueueCSS() {
    wp_enqueue_style('capitanStyle', plugins_url( "/capitan/lib/css/capitan.css"));
  }

}
?>