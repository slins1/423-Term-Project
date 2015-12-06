function validate_promotion() {

  var errorFlag = 0;

	if (validate_promotion_name() == false) {
    document.addPromotion.promoName.focus();
    errorFlag = 1;
  }

  if (validate_promotion_description() == false) {
    document.addPromotion.promoDescription.focus();
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
  var promoNameRegex = /^[0-9A-Za-z\.\,\#\= ]*$/;
  var errPromoName = document.getElementById("errorPromoName");
  var sucPromoName = document.getElementById("successPromoName");

    if (promoName.value === "") {
        sucPromoName.innerHTML = "";
		errPromoName.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
		return false;
	}

    if (!promoNameRegex.test(promoName.value)) {
        sucPromoName.innerHTML = "";
        errPromoName.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'>Invalid special characters used! \n(Use '.', ',', '%', '=' or '#')";
        return false;
    }

    errPromoName.innerHTML = "";
    sucPromoName.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
	return true;
}

function validate_promotion_description() {
  var promoDescription = document.addPromotion.promoDescription;
  var promoDescriptionRegex = /^[0-9A-Za-z\.\,\#\= ]*$/;
  var errPromoDescription = document.getElementById("errorPromoDescription");
  var sucPromoDescription = document.getElementById("successPromoDescription");

  if (promoDescription.value === "") {
    sucPromoDescription.innerHTML = "";
    errPromoDescription.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
    return false;
  }

  if (!promoDescriptionRegex.test(promoDescription.value)) {
    sucPromoDescription.innerHTML = "";
    errPromoDescription.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Invalid special characters used!\n(Use '.', ',', '%', '=' or '#')";
    return false;
  }

  errPromoDescription.innerHTML = "";
  sucPromoDescription.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}

function validate_amount_off() {
  var amountOff = document.addPromotion.amountOff;
  var amountOff = amountOff.value.replace("%", "");
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
