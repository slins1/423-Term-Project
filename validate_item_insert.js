function validate_item() {
  var errorFlag = 0;
  
  if (validate_item_number() == false) {
    document.addItem.itemNum.focus();
    errorFlag = 1;
  }
  
  if (validate_item_description() == false) {
    document.addItem.itemDescription.focus();
    errorFlag = 1;
  }
  
  if (validate_purchase_cost() == false) {
    document.addItem.purchaseCost.focus();
    errorFlag = 1;
  }
  
  if (validate_retail_price() == false) {
    document.addItem.retailPrice.focus();
    errorFlag = 1;
  }
  
  if (errorFlag == 1) {
    return false;
  }
	return true;
}

function validate_item_number() {
    
  var itemNum = document.addItem.itemNum;
  var itemNumRegex = /^[0-9]{7}$/;
  var errItemNum = document.getElementById("errorItemNum");
  var sucItemNum = document.getElementById("successItemNum");

    if (itemNum.value === "") {
        sucItemNum.innerHTML = "";
		errItemNum.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
		return false;
	}
	
    if (!itemNumRegex.test(itemNum.value)) {
        sucItemNum.innerHTML = "";
		errItemNum.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Use 7-digit numbers!";
		return false;
    }
    
    errItemNum.innerHTML = "";
    sucItemNum.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
	return true;
}

function validate_item_description() {
  var itemDescription = document.addItem.itemDescription;
  var itemDescriptionRegex = /^[0-9A-Za-z\.\,\#\= ]*$/;
  var errItemDescription = document.getElementById("errorItemDescription");
  var sucItemDescription = document.getElementById("successItemDescription");

  if (itemDescription.value === "") {
    sucItemDescription.innerHTML = "";
    errItemDescription.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
    return false;
  }
  
  if (!itemDescriptionRegex.test(itemDescription.value)) {
    sucItemDescription.innerHTML = "";
    errItemDescription.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Invalid special characters used!\n(Use '.', ',', '=' or '#')";
    return false;
  }
  
  errItemDescription.innerHTML = "";
  sucItemDescription.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}

function validate_purchase_cost() {
  var purchaseCost = document.addItem.purchaseCost;
  var purchaseCostRegex = /^[0-9]+[\.][0-9][0-9]$/;
  var errPurchaseCost = document.getElementById("errorPurchaseCost");
  var sucPurchaseCost = document.getElementById("successPurchaseCost");

  if (purchaseCost.value === "") {
    sucPurchaseCost.innerHTML = "";
    errPurchaseCost.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
    return false;
  }
  
  if (!purchaseCostRegex.test(purchaseCost.value)) {
    sucPurchaseCost.innerHTML = "";
    errPurchaseCost.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Use format 'X.XX'!";
    return false;
  }
  errPurchaseCost.innerHTML = "";
  sucPurchaseCost.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}

function validate_retail_price() {
  var retailPrice = document.addItem.retailPrice;
  var retailPriceRegex = /^[0-9]+[\.][0-9][0-9]$/;
  var errRetailPrice = document.getElementById("errorRetailPrice");
  var sucRetailPrice = document.getElementById("successRetailPrice");

  if (retailPrice.value === "") {
    sucRetailPrice.innerHTML = "";
    errRetailPrice.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Required!";
    return false;
  }
  
  if (!retailPriceRegex.test(retailPrice.value)) {
    sucRetailPrice.innerHTML = "";
    errRetailPrice.innerHTML = "<img class='statusImage' src='images/error.png' alt='error'> Use format 'X.XX'!";
    return false;
  }
  
  errRetailPrice.innerHTML = "";
  sucRetailPrice.innerHTML = "<img class='statusImage' src='images/correct.png' alt='correct'> Complete!";
  return true;
}
