/**
* Author: Beatrice Huang
* Target: enquire.html/payment.html
* Purpose: Validate payment.html
* Created: 30 Sept 2105
* Last updated: 3 Sept 2015
*/
"use strict";

// Check if the form is properly validated
function validate(){
	var errMsg = "";
	var result = true;

	var cardexpiry= document.getElementById("cardexpiry").value;
	var creditcard = document.getElementById("creditcard").value;
	var cardnumber = document.getElementById("cardnumber").value;

	var bstate = document.getElementById("bstate").value;
	var bpostcode = document.getElementById("bpostcode").value;

	var tempMsg = checkExpiry(cardexpiry);
	if (tempMsg != "") {
		errMsg = errMsg + tempMsg + "\n";
		result = false;
	}

	var tempMsg2 = checkCardNumber(creditcard,cardnumber);
	if (tempMsg2 != "") {
		errMsg = errMsg + tempMsg2 + "\n";
		result = false;
	}

	if (document.getElementsByClassName("hidden").length == 0) {
		var tempMsg3 = checkPostcode(bstate, bpostcode);
		if (tempMsg3 != "") {
			errMsg = errMsg + tempMsg3 + "\n";
			result = false;
		}
	}

	if (errMsg != "") {
		alert(errMsg);
	}

	return result;
}

// checks postcode against the state
function checkPostcode(state, postcode) {
	var errMsg = ""
	switch (state) {
		case "VIC":
		if (!postcode.match(/^[3,8].*$/)) {
			errMsg = "If you're from VIC your postcode starts with 3 or 8"
		}
		break;
		case "NSW":
		if (!postcode.match(/^[1,2].*$/)) {
			errMsg = "If you're from NSW your postcode starts with 1 or 2"
		}
		break;
		case "QLD":
		if (!postcode.match(/^[4,9].*$/)) {
			errMsg = "If you're from QLD your postcode starts with 4 or 9"
		}
		break;
		case "NT":
		if (!postcode.match(/^[0].*$/)) {
			errMsg = "If you're from NT your postcode starts with 0"
		}
		break;
		case "WA":
		if (!postcode.match(/^[6].*$/)) {
			errMsg = "If you're from WA your postcode starts with 6"
		}
		break;
		case "SA":
		if (!postcode.match(/^[5].*$/)) {
			errMsg = "If you're from SA your postcode starts with 5"
		}
		break;
		case "TAS":
		if (!postcode.match(/^[7].*$/)) {
			errMsg = "If you're from TAS your postcode starts with 7"
		}
		break;
		case "ACT":
		if (!postcode.match(/^[0].*$/)) {
			errMsg = "If you're from ACT your postcode starts with 0"
		}
		break;
		default:
		errMsg = "Please choose a state"
	}
	return errMsg;
}

// Checks if the expiration date of the card is earlier than today's date
function checkExpiry(date) {
	var today = new Date();
	var mm = today.getMonth()+1;
	var yy = today.getFullYear() % 100;

	var cmm = parseInt(date.substring(0,2));
	var cyy = parseInt(date.substring(3,5));

	if ((yy > cyy) || ((yy == cyy) && (mm > cmm))) {
		return "This creditcard has expired"
	}
	else {
		return "";
	}
}

// checks card number against the card type
function checkCardNumber(cardtype, number) {
	var errMsg = ""
	console.log(number);
	console.log(cardtype);
	switch (cardtype) {
		case "Visa":
		if (!number.match(/4[0-9]{15}/g)) {
			errMsg = "Visa cards have 16 digits and start with a 4"
		}
		break;
		case "Mastercard":
		if (!number.match(/5[1-5][0-9]{14}/g)) {
			errMsg = "MasterCard have 16 digits and start with digits 51 through to 55"
		}
		break;
		case "American Express":
		if (!number.match(/3[47][0-9]{13}/g)) {
			errMsg = "American Express has 15 digits and starts with 34 or 37"
		}
		break;
		default:
		errMsg = "Please choose a card type"
	}
	return errMsg;
}

// redirects when you click the cancel button
function cancelPayment(){
	window.location = "enquire.html";
}

// initial function call
function init () {
	var confirmForm = document.getElementById("confirmform");
	confirmForm.onsubmit = validate;
	getDetails();
	var cancelButton = document.getElementById("cancelButton");
	cancelButton.addEventListener("click", cancelPayment);

	var separate = document.getElementById("separateBilling");
	separate.addEventListener("click", function(){
		if (separate.checked) {
			document.getElementById("billingSection").className = "";
		} else {
			document.getElementById("billingSection").className = "hidden";
		}
	})
 }

window.onload = init;
