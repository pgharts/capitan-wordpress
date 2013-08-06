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
    add_action('admin_menu', array('CapitanAdmin', 'addCapitanAdminMenu'));
    add_action('admin_init', array('CapitanAdmin', 'registerCapitanSettings'));
    //require_once 'lib/jorogumo_functions.php';
    add_action('init', array(__CLASS__, 'enqueueScripts'));
    //add_action( 'widgets_init', create_function( '', 'register_widget( "jorogumo_widget" );' ) );
  }

  function enqueueScripts() {
    add_action('wp_print_styles', array(__CLASS__, 'enqueueCSS'));
  }

  public static function enqueueCSS() {
    wp_enqueue_style('capitanStyle', plugins_url( "/Capitan/lib/css/capitan.css"));
    wp_enqueue_style('capitanBootstrap', plugins_url( "/Capitan/lib/css/capitan.css"));
  }

}
?>