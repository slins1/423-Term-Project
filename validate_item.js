function validate()
{
	console.log("Here");
	if(!validItemNum() ||
		!validDescription() ||
		!validCost() ||
		!validPrice())
	{
		return false;
	}
	
	return true;
}

function validItemNum()
{
	console.log("Made it this far!");
	var elem = document.getElementById("itemNum");
	var itemNum = parseInt(elem.value);
	
	if ((itemNum.length <= 0 || itemNum.length > 7) || itemNum == null)
	{
		alert("You must enter a valid item number");
		return false;
	}
	return true;
}

function validDescription()
{
	var elem = document.getElementById("description");
	var description = elem.value;
	
	if((description.length <=0 || description.length > 50) || description == null)
	{
		alert("You must enter a valid description");
		return false;
	}
	return true;
}

function validCost()
{
	var elem = document.getElementById("purchaseCost");
	var purchaseCost = elem.value;
	
	if ((purchaseCost.length <=0 || purchaseCost.length > 10) || purchaseCost == null)
	{
		alert("You must enter a valid purchase cost");
		return false;
	}
	
	if (/\d+\.\d\d/.test(purchaseCost))
	{
		return true;
	}
	
	alert("You must enter the purchase cost in the proper format");
	return false;
}

function validPrice()
{
	var elem = document.getElementById("retailPrice");
	var retailPrice = elem.value;
	
	if ((retailPrice.length <=0 || retailPrice.length > 10) || retailPrice == null)
	{
		alert("You must enter a valid full retail price");
		return false;
	}
	
	if (/\d+\.\d\d/.test(retailPrice))
	{
		return true;
	}
	
	alert("You must enter the full retail price in the proper format");
	return false;
}