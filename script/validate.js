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

	storeBooking(firstname,lastname,email,street,suburb,state,postcode,phone,course,location,length,comment);
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
