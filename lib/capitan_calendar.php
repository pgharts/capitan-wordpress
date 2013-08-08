<?php

class capitanCalendar {


  private $calendar_url;
  private $calendar_response;
  public  $month, $year, $weeks;

  function __construct($year, $month) {
    // The URL format is: calendar/monthly/[year]/[month]/
    $base_calendar_url = "calendar/monthly/%s/%s";
    $this->calendar_url = sprintf($base_calendar_url, $year, $month);
    $this->calendar_response = CapitanConnection::getResponse($this->calendar_url);
    $this->processResponse($this->calendar_response);
  }

  private function processResponse($response) {
    $this->month = $response->month;
    $this->year = $response->year;
    $this->weeks = processWeeks($response->weeks);
  }

  private function processWeeks($json_weeks) {
    $weeks = array();
    foreach($json_weeks as $week) {
      array_push($weeks, new CapitanWeek($week));
    }
    return $weeks;
  }

}

?>