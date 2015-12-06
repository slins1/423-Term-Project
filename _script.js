$(function() {
	$(document).tooltip();
  $(".button").button();
  $("#startDate, #endDate").datepicker();
});

function goBack() {
	window.history.back();
}
