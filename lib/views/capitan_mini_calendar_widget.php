<div class = "eventcal group">

<form action="none" class = "select-month" method ="post">
    <select id="month_select">
      <?php
      $option_format = '<option value="%s">%s</option>';
      $interval_format = 'P1M';
      $month_calc = new DateTime("now");
      for($i = 0; $i<12 ; $i++) {
        echo(sprintf($option_format, $month_calc->format('Y') . ',' . $month_calc->format('m'), $month_calc->format('M')));
        $month_calc->add(new DateInterval($interval_format));
      }
      ?>
    </select>
  </form>
  <?php require("capitan_mini_calendar.php");  ?>

</div>
