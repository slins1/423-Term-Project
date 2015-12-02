function validate_event() {

  var errorFlag = 0;

  if (validate_event_code() == false) {
    document.addEvent.eventCode.focus();
    errorFlag = 1;
  }

  if (validate_name() == false) {
    document.addEvent.eventName.focus();
    errorFlag = 1;
  }

 /* if (validate_end_date() == false) {
    document.addEvent.endDate.focus();
    errorFlag = 1;
  }*/

  if (validate_description() == false) {
    document.addEvent.eventDescription.focus();
    errorFlag = 1;
  }

  if (errorFlag == 1) {
    return false;
  }
	return true;
}

function validate_event_code() {

  var eventCode = document.addEvent.eventCode;
  var eventCodeRegex = /^[0-9A-Z]{11,}$/;
  var errEventCode = document.getElementById("errorEventCode");
  var sucEventCode = document.getElementById("successEventCode");

    if (eventCode.value === "") {
        sucEventCode.innerHTML = "";
		    errEventCode.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
		    return false;
	}

    if (!eventCodeRegex.test(eventCode.value)) {
        sucEventCode.innerHTML = "";
		    errEventCode.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Use at least 11 digits!";
		    return false;
    }

    errEventCode.innerHTML = "";
    sucEventCode.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
	return true;
}


function validate_name() {
  var name = document.addEvent.eventName;
  var nameRegex = /^[0-9A-Za-z\.\,\%\#\= ]*$/;
  var errName = document.getElementById("errorName");
  var sucName = document.getElementById("successName");

  if (name.value === "") {
    sucName.innerHTML = "";
    errName.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
    return false;
  }

  if (!nameRegex.test(name.value)) {
    sucName.innerHTML = "";
    errName.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Invalid special characters used!\n(Use '.', ',', '=', '%' or '#')";
    return false;
  }

  errName.innerHTML = "";
  sucName.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}

/*function validate_end_date() {
  var endDate = document.addEvent.endDate;
  var startDate = document.addEvent.startDate;
  var errEndDate = document.getElementById("errorEndDate");
  var sucEndDate = document.getElementById("successEndDate");

  if (endDate < startDate) {
    sucEndDate.innerHTML = "";
    errEndDate.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> End date should be after start date!";
    return false;
  }
  errEndDate.innerHTML = "";
  sucEndDate.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}*/

function validate_description() {
  var description = document.addEvent.eventDescription;
  var descriptionRegex = /^[0-9]+[\.][0-9][0-9]$/;
  var errDescription = document.getElementById("errorDescription");
  var sucDescription = document.getElementById("successDescription");

  if (description.value === "") {
    sucDescription.innerHTML = "";
    errDescription.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
    return false;
  }

  if (!descriptionRegex.test(decription.value)) {
    sucDescription.innerHTML = "";
    errDescription.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Use format 'X.XX'!";
    return false;
  }

  errDescription.innerHTML = "";
  sucDescription.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}
