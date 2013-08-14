<div class = "eventcal group">

<form action="none" class = "select-month" method ="post">
    <select id="month_select">
      <?php
      $option_format = '<option value="%s">%s</option>';
      $interval_format = 'P%sM';
      $month_calc = new DateTime("now");
      for($i = 0; $i<12 ; $i++) {
        $month_calc->add(new DateInterval(sprintf($interval_format, $i)));
        echo(sprintf($option_format, $month_calc->format('m'), $month_calc->format('M')));
      }
      ?>
    </select>
  </form>
  <span class="calnav"></span>
  <input type="hidden" name="current_calendar_month" value="<?php ?>" />
  <input type="hidden" name="current_calendar_year" value="<?php ?>" />
  <table class="events-calendar" cellspacing="0">
    <thead>
      <th scope="col">S</th>
      <th scope="col">M</th>
      <th scope="col">T</th>
      <th scope="col">W</th>
      <th scope="col">T</th>
      <th scope="col">F</th>
      <th scope="col">S</th>
    </thead>
    <tbody>
      <?php foreach($capitan_calendar->weeks as $week) { ?>
        <tr>
          <?php foreach($week->days as $day) {
            if(strftime("%B", $day->day) != $capitan_calendar->month) { ?>
              <td class="null">
                <?php echo($day->day->day) ?>
              </td>
            <?php } else { ?>
              <td>
                <?php if(count($day->shows) > 0) { ?>
                  <a href="#"><?php echo(strftime("%e", $day->day)); ?></a>
                  <div class="popup">
                    <h5><?php echo(strftime("%B %d, %Y", $day->day));?></h5>
                    <ul>
                      <?php foreach($day->shows as $show) { ?>
                        <li>
                          <a href="<?php echo($show->show_detail_url); ?>"><?php echo($show->title); ?></a>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                <?php } else { echo(strftime("%e", $day->day)); } ?>
              </td>
            <?php } ?>

          <?php } ?>
        </tr>

      <?php } ?>
    </tbody>
  </table>

</div>
