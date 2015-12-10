$(function() {
	$(document).tooltip({
		show: {
         effect: 'fade'
        },
        track: false,
        open: function (event, ui) {
            setTimeout(function () {
                $(ui.tooltip).hide('fade');
            }, 2000);
        }
	});
  $(".button").button();
  $("#startDate, #endDate").datepicker();
  //$("#startDate, #endDate").datepicker(new Date());
});

function goBack() {
	window.history.back();
}
