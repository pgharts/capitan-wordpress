function BindCalendarWidgetControls() {

  jQuery('.eventcal .select-month').change(function(){
    var container = GetContainer(this);
    var selected_values = jQuery(this).find(':selected').val().split(',')
    GetAjaxCalendarForMonth(container, selected_values[0], selected_values[1]);
  });

}

function BindCalendarWidgetPopups() {

  jQuery('.popup').hide();
  jQuery('.events-calendar td').hover(
		function() {
      jQuery(this).find('.popup').slideToggle('fast');
			},
		function() {
      jQuery(this).find('.popup').hide();
			}
	);
}


function GetAjaxCalendarForMonth(scope, year, month) {
  var calendar = scope.find('.events-calendar');
  jQuery.ajax({
    url: 'wp-admin/admin-ajax.php',
    type: "POST",
    data: {month: month, year: year, action: 'get_mini_calendar'},
    success: function(data, textStatus, xhr) {
      calendar.replaceWith(data)
    },
    complete: function() {
      BindCalendarWidgetPopups();
    }
  });

}

function GetContainer(scope) {
  return jQuery(scope).closest('.eventcal');
}

function GetMonth(scope) {
  return scope.find('input[name="current_calendar_month"]').val();
}

function GetYear(scope) {
  return scope.find('input[name="current_calendar_year"]').val();
}

jQuery(document).ready(function() {
  BindCalendarWidgetControls();
  BindCalendarWidgetPopups();
});