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
	var orderbyName = document.getElementById("name");
	orderbyName.addEventListener("click", function(){
		if (orderbyName.checked) {
			document.getElementById("nameKey").className = "";
		} else {
			document.getElementById("nameKey").className = "hidden";
		}
	})
	var orderbyProduct = document.getElementById("product");
	orderbyProduct.addEventListener("click", function(){
		if (orderbyProduct.checked) {
			document.getElementById("productKey").className = "";
		} else {
			document.getElementById("productKey").className = "hidden";
		}
	})

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