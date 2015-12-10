function clear_form(){

  var errItemNum = document.getElementById("errorItemNum");
  var sucItemNum = document.getElementById("successItemNum");
  var errPurchaseCost = document.getElementById("errorPurchaseCost");
  var sucPurchaseCost = document.getElementById("successPurchaseCost");
  var errRetailPrice = document.getElementById("errorRetailPrice");
  var sucRetailPrice = document.getElementById("successRetailPrice");

  sucItemNum.innerHTML = "";
  errItemNum.innerHTML = "";
  sucPurchaseCost.innerHTML = "";
  errPurchaseCost.innerHTML = "";
  sucRetailPrice.innerHTML = "";
  errRetailPrice.innerHTML = "";


}

window.onload = function() {
  // categories is an object but you can think of it as a lookup table
  var  categories = {
        'ACCESSORIES/FOOTWEAR': ['ACCESSORIES', 'FOOTWEAR'],
        'BASIC APPAREL': ['CHILDRENS BASICS', 'LADIES BASICS', 'MENS BASICS'],
        'CHILDRENS APPAREL': ['BOYS APPAREL', 'GIRLS APPAREL', 'NEWBORN INF TODDLR'],
        'ELECTRONICS/PREPAID': ['ELECTRONICS', 'PPD PRODUCT/SERVICE'],
        'FOOD CONVENIENCE': ['ADULT BEVERAGE', 'BREAD', 'CANDY', 'REFRIGERATED', 'TOBACCO'],
        'FOOD GROCERY': ['COOKIES/CRACKERS', 'GROCERY', 'PREPARED FOOD', 'READY TO DRINK BEV', 'SALTY SNACKS', 'WAREHOUSE BEVERAGES'],
        'HEALTH/BEAUTY': ['ACUTE HEALTH CARE', 'BABY CARE', 'BATH/BODY', 'BEAUTY CARE', 'CHRONIC HEALTH CARE', 'HAIR CARE', 'ORAL CARE', 'PERSONAL CARE', 'ROUTINE HEALTH'],
        'HOME DECOR': ['HOME DECOR'],
        'HOUSEHOLD PRODUCTS': ['AUTOMOTIVES', 'DISP BAG/WRAP/TABLE', 'HARDWARE', 'HOUSEHOLD CLEANING', 'HOUSEHOLD PAPER', 'LAUNDRY CARE', 'PET'],
        'HOUSEWARES': ['HOUSEWARES'],
        'MENS APPAREL': ['MENS APPAREL'],
        'MISCELLANEOUS': ['MISCELLANEOUS'],
        'OFFICE/PARTY': ['PARTY/CARD SHOP', 'SCHOOL/OFFICE SUPPLY'],
        'SEASONAL MERCHANDISE': ['LAWN AND GDN/PATIO', 'SEASONAL'],
        'SOFT HOME': ['BATH', 'BEDDING', 'FLOORING', 'KITCHEN', 'WINDOW'],
        'SUPPLIES': ['SUPPLIES'],
        'TOYS': ['TOYS'],
        'WOMENS APPAREL': ['LADIES BOTTOMS', 'LADIES TOPS', 'PLUS BOTTOMS', 'PLUS TOPS', 'SLEEPWEAR/SCRUBS']
      },
      // just grab references to the two drop-downs
      category_select = document.querySelector('#category'),
      department_select = document.querySelector('#deptName');

  // populate the drop-downs
  setOptions(category_select, Object.keys(categories));
  setOptions(department_select, categories[category_select.value]);

  // attach a change event listener to the provinces drop-down
  category_select.addEventListener('change', function() {
    setOptions(department_select, categories[category_select.value]);
  });

  function setOptions(dropDown, options) {
    // clear out any existing values
    dropDown.innerHTML = '';
    // insert the new options into the drop-down
    options.forEach(function(value) {
      dropDown.innerHTML += '<option name="' + value + '">' + value + '</option>';
    });
  }
};

function validate_item() {
  var errorFlag = 0;

  if (validate_item_number() == false) {
    document.addItem.itemNum.focus();
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
