<div class = "eventcal group">

<form action="none" class = "select-month" method ="post">
    <select id="month_select">
      <?php
      $option_format = '<option value="%s">%s</option>';
      $interval_format = 'P%sM';
      $month_calc = new DateTime("now");
      for($i = 0; $i<12 ; $i++) {
        $month_calc->add(new DateInterval(sprintf($interval_format, $i)));
        echo(sprintf($option_format, $month_calc->format('Y') . ',' . $month_calc->format('m'), $month_calc->format('M')));
      }
      ?>
    </select>
  </form>
  <?php require("capitan_mini_calendar.php");  ?>

</div>
