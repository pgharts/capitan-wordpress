function BindCalendarWidgetControls() {

  $('.eventcal .select-month').change(function(){
    var container = GetContainer(this);
    var selected_values = $(this).find(':selected').val().split(',')
    GetAjaxCalendarForMonth(container, selected_values[0], selected_values[1]);
  });

}

function BindCalendarWidgetPopups() {

  $('.popup').hide();
	$('.events-calendar td').hover(
		function() {
			$(this).find('.popup').slideToggle('fast');
			},
		function() {
			$(this).find('.popup').hide();
			}
	);
}


function GetAjaxCalendarForMonth(scope, year, month) {
  var calendar = scope.find('.events-calendar');
  $.ajax({
    url: '/ajax-admin.php',
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
  return  $(scope).closest('.eventcal');
}

function GetMonth(scope) {
  return scope.find('input[name="current_calendar_month"]').val();
}

function GetYear(scope) {
  return scope.find('input[name="current_calendar_year"]').val();
}

$(document).ready(function() {
  BindCalendarWidgetControls();
  BindCalendarWidgetPopups()
});