/**
* Author: Beatrice Huang
* Target: enquire.html/payment.html
* Purpose: Validate enquire form and send results to payment.html
* Created: 30 Sept 2105
* Last updated: 3 Sept 2015
*/
"use strict";

// get variables from form and check validation
function validate(){
	var errMsg = "";
	var result = true;

	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var email = document.getElementById("email").value;
	var street = document.getElementById("streetaddress").value;
	var suburb = document.getElementById("suburb").value;
	var state = document.getElementById("state").value;
	var postcode = document.getElementById("postcode").value;
	var phone = document.getElementById("phone").value;
	var course = document.getElementById("course").value;
	var clocation = getLocation();
	var clength = getCourseLength();
	var seats = document.getElementById("seats").value;
	var comments = document.getElementById("comment").value;

	var tempMsg = checkPostcode(state, postcode);
	if (tempMsg != "") {
		errMsg = errMsg + tempMsg;
		result = false;
	}

	if (errMsg != "") {
		alert(errMsg);
	}

	if (result){
	storeBooking(firstname,lastname,email,street,suburb,state,postcode,phone,course,location,length,comment);
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

// gets the checked radio button of the location
function getLocation() {
	var location = document.getElementsByName("location[]");
	for (var i = 0; i < location.length; i++) {
		if (location[i].checked) {
			return location[i].value;
		}
	}
}

// gets the checked radio button of the course length
function getCourseLength() {
	var length = document.getElementsByName("length[]");
	for (var i = 0; i < length.length; i++) {
		if (length[i].checked) {
			return length[i].value;
		}
	}
}

//get values and assign them to a sessionStorage attribute.
function storeBooking(firstname,lastname,email,street,suburb,state,postcode,phone,course,location,length,comment){
	sessionStorage.firstname = document.getElementById("firstname").value;
	sessionStorage.lastname = document.getElementById("lastname").value;
	sessionStorage.email = document.getElementById("email").value;
	sessionStorage.street = document.getElementById("streetaddress").value;
	sessionStorage.suburb = document.getElementById("suburb").value;
	sessionStorage.state = document.getElementById("state").value;
	sessionStorage.postcode = document.getElementById("postcode").value;
	sessionStorage.phone = document.getElementById("phone").value;
	sessionStorage.course = document.getElementById("course").value;
	sessionStorage.clocation = getLocation();
	sessionStorage.clength = getCourseLength();
	sessionStorage.seats = document.getElementById("seats").value;
	sessionStorage.comments = document.getElementById("comment").value;
	sessionStorage.cost = null;
}

// Init function
function init () {
	var regForm = document.getElementById("enquire");
	regForm.onsubmit = validate;
 }

window.onload = init;
