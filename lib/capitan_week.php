<?php

class CapitanWeek {

  public $week, $days;

  function __construct($week) {
    $this->week = $week;
    $this->days = $this->processDays($week->days);
  }

  private function processDays($json_days) {
    $days = array();
    foreach($json_days as $day) {
      array_push($days, new CapitanWeek($day));
    }
    return $days;
  }
}

?>