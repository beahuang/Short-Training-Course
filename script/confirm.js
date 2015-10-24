/**
* Author: Beatrice Huang
* Target: enquire.html/payment.html
* Purpose: Validate payment.html
* Created: 30 Sept 2105
* Last updated: 24 Oct 2015
*/
"use strict";

// redirects when you click the cancel button
function cancelPayment(){
	window.location = "enquire.html";
}

// initial function call
function init () {
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
