/**
* Author: Beatrice Huang
* Target: enquire.html/payment.html
* Purpose: Validate payment.html
* Created: 24 Oct 2105
* Last updated: 24 Oct 2015
*/
"use strict";


// initial function call
function init () {
	var radio = document.getElementById("orderfield");
	var orderbyName = document.getElementById("name");
	var orderbyProduct = document.getElementById("product");
	radio.addEventListener("click", function(){
		if (orderbyName.checked) {
			document.getElementById("nameKey").className = "";
			document.getElementById("productKey").className = "hidden";
		}
		else if (orderbyProduct.checked){
			document.getElementById("productKey").className = "";
			document.getElementById("nameKey").className = "hidden";
		}
		else {
			document.getElementById("productKey").className = "hidden";
			document.getElementById("nameKey").className = "hidden";
		}

	});

	var orderStatus = document.getElementById("showUpdateOrder");
	orderStatus.addEventListener("click", function(){
		if (orderStatus.checked) {
			document.getElementById("hiddenUpdateStatus").className = "";
		} else {
			document.getElementById("hiddenUpdateStatus").className = "hidden";
		}
	})

	var deleteOrder = document.getElementById("showDeleteOrder");
	deleteOrder.addEventListener("click", function(){
		if (deleteOrder.checked) {
			document.getElementById("hiddenDelete").className = "";
		} else {
			document.getElementById("hiddenDelete").className = "hidden";
		}
	})
 }

window.onload = init;
