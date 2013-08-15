<?php

function get_mini_calendar() {
	global $wpdb; // this is how you get access to the database

  $capitan_calendar = new CapitanCalendar($_POST['year'], $_POST['month']);
  ob_start();
  require("views/capitan_mini_calendar.php");
  $calendar_html = ob_get_contents();
  ob_end_clean();
  echo $calendar_html;

	die(); // this is required to return a proper result
}

add_action('wp_ajax_get_mini_calendar', 'get_mini_calendar');
add_action('wp_ajax_nopriv_get_mini_calendar', 'get_mini_calendar');

?>