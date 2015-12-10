function clear_form(){

  var errPromoName = document.getElementById("errorPromoName");
  var sucPromoName = document.getElementById("successPromoName");
  var errAmountOff = document.getElementById("errorAmountOff");
  var sucAmountOff = document.getElementById("successAmountOff");

  sucPromoName.innerHTML = "";
  errPromoName.innerHTML = "";
  sucAmountOff.innerHTML = "";
  errAmountOff.innerHTML = "";

}

function validate_promotion() {

  var errorFlag = 0;

	if (validate_promotion_name() == false) {
    document.addPromotion.promoName.focus();
    errorFlag = 1;
  }

  if (validate_amount_off() == false) {
    document.addPromotion.amountOff.focus();
    errorFlag = 1;
  }

  if (errorFlag == 1) {
    return false;
  }
	return true;
}

function validate_promotion_name() {
  var promoName = document.addPromotion.promoName;
  var errPromoName = document.getElementById("errorPromoName");
  var sucPromoName = document.getElementById("successPromoName");

  if (promoName.value === "") {
    sucPromoName.innerHTML = "";
		errPromoName.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
		return false;
	}

    errPromoName.innerHTML = "";
    sucPromoName.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
	return true;
}

function validate_amount_off() {
  var amountOff = document.addPromotion.amountOff;
  var amountOffRegex = /^[0-9]+([\.][0-9][0-9]?)?$/;
  var errAmountOff = document.getElementById("errorAmountOff");
  var sucAmountOff = document.getElementById("successAmountOff");

  if (amountOff.value === "") {
    sucAmountOff.innerHTML = "";
    errAmountOff.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
    return false;
  }

  if (!amountOffRegex.test(amountOff.value)) {
    sucAmountOff.innerHTML = "";
    errAmountOff.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Use format 'X.XX', 'X', or 'X.X'!";
    return false;
  }

  errAmountOff.innerHTML = "";
  sucAmountOff.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}
