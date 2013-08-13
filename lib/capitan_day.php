<?php

class CapitanDay {

  public $day, $shows;

  function __construct($day) {
    $this->day = strtotime($day->day);
    $this->shows = $this->processShows($day->shows);
  }

  private function processShows($json_shows) {
    $shows = array();
     foreach($json_shows as $show) {
       array_push($shows, new CapitanShow($show));
     }

    return $shows;
  }

}

?>