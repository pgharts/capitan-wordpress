<?php

if ( ! function_exists( 'capitan_mini_calendar_func' ) ) :

  /**
  * // [capitan_mini_calendar]
  * Outputs a mini-calendar listing current events.
  *
  */
  function capitan_mini_calendar_func($atts) {
    $capitan_calendar = new CapitanCalendar(date("Y"), date("m"));
    ob_start();
    require("views/capitan_mini_calendar_widget.php");
    $calendar_html = ob_get_contents();
    ob_end_clean();
    return $calendar_html;
}

endif;

add_shortcode( 'capitan_mini_calendar', 'capitan_mini_calendar_func' );

?>