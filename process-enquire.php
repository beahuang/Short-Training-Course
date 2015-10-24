<?php
session_start();

function sanitise_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset ($_POST["submit"]) {
	$firstname = sanitise_input($_POST["firstname"]);
	$lastname = sanitise_input($_POST["lastname"]);
	$email = sanitise_input($_POST["email"]);
	$streetaddress = sanitise_input($_POST["streetaddress"]);
	$suburb = sanitise_input($_POST["suburb"]);
	$state = sanitise_input($_POST["state"]);
	$postcode = sanitise_input($_POST["postcode"]);
	$phone = sanitise_input($_POST["phone"]);
	$course = sanitise_input($_POST["course"]);
	$location = sanitise_input($_POST["location"]);
	$length = sanitise_input($_POST["length"]);
	$seats = sanitise_input($_POST["seats"]);
	$comments = sanitise_input($_POST["comment"]);

	$errMsg = "";
	if ($firstname=="") {
		$errMsg .= "<p>You must enter your first name.</p>";
	}
	if (!preg_match("/[a-zA-Z]{1,25}/",$firstname)) {
		$errMsg .= "<p>Maximum of 25 characters, alphabetical only for your first name.</p>";
	}

	if ($lastname=="") {
		$errMsg .= "<p>You must enter your last name.</p>";
	}
	if (!preg_match("/[a-zA-Z]{1,25}/",$lastname)) {
		$errMsg .= "<p>Maximum of 25 characters, alphabetical only for your first name.</p>";
	}

	if ($email=="") {
		$errMsg .= "<p>You must enter your email.</p>";
	}
	if (!preg_match("/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/",$email)) {
		$errMsg .= "<p>You must enter a valid email.</p>";
	}

	if ($streetaddress=="") {
		$errMsg .= "<p>You must enter your street address.</p>";
	}
	if (!preg_match("/.{1,40}/",$streetaddress)) {
		$errMsg .= "<p>Maximum 40 characters for your street address.</p>";
	}

	if ($suburb=="") {
		$errMsg .= "<p>You must enter your suburb.</p>";
	}
	if (!preg_match("/.{1,20}/",$suburb)) {
		$errMsg .= "<p>Maximum of 20 characters for your suburb.</p>";
	}

	if ($postcode=="") {
		$errMsg .= "<p>You must enter your postcode.</p>";
	}
	if (!preg_match("/[0-9]{4}/",$postcode)) {
		$errMsg .= "<p>Exactly four digits for your postcode.</p>";
	}
	function checkPostcode($state, $postcode) {
		$errMsg = "";
		switch ($state) {
			case "VIC":
			if (!preg_match("/^[3,8].*$/",$postcode)) {
				$errMsg = "If you're from VIC your postcode starts with 3 or 8";
			}
			break;
			case "NSW":
			if (!preg_match("/^[1,2].*$/",$postcode)) {
				$errMsg = "If you're from NSW your postcode starts with 1 or 2";
			}
			break;
			case "QLD":
			if (!preg_match("/^[4,9].*$/",$postcode)) {
				$errMsg = "If you're from QLD your postcode starts with 4 or 9";
			}
			break;
			case "NT":
			if (!preg_match("/^[0].*$/",$postcode)) {
				$errMsg = "If you're from NT your postcode starts with 0";
			}
			break;
			case "WA":
			if (!preg_match("/^[6].*$/",$postcode)) {
				$errMsg = "If you're from WA your postcode starts with 6";
			}
			break;
			case "SA":
			if (!preg_match("/^[5].*$/",$postcode)) {
				$errMsg = "If you're from SA your postcode starts with 5";
			}
			break;
			case "TAS":
			if (!preg_match("/^[7].*$/",$postcode)) {
				$errMsg = "If you're from TAS your postcode starts with 7";
			}
			break;
			case "ACT":
			if (!preg_match("/^[0].*$/",$postcode)) {
				$errMsg = "If you're from ACT your postcode starts with 0";
			}
			break;
			default:
			$errMsg = "Please choose a state";
		}
		return $errMsg;
	}
	$errMsg .= checkPostcode($state,$postcode);

	if ($phone=="") {
		$errMsg .= "<p>You must enter your phone number.</p>";
	}
	if (!preg_match("/[0-9]{1,10}/",$phone)) {
		$errMsg .= "<p>Maximum of 10 characters for your phone number.</p>";
	}
	if (!is_numeric($phone)) {
		$errMsg .= "<p>You must enter a number for your phone number.</p>";
	}

	if ($course=="") {
		$errMsg .= "<p>You must enter choose a course</p>";
	}

	if ($seats=="") {
		$errMsg .= "<p>You must enter how many seats you want to book.</p>";
	}
	if ((!is_numeric($seats)) || ($seats < 0) || (100 < $seats)) {
		$errMsg .= "<p>You enter a positive number between 1 and 100 for seats.</p>";
	}

	//calculates week -> day
	function weekstoDays($length) {
		switch ($length) {
			case "5 days":
			return 100 * 5;
			case "10 days":
			return 100 * 10;
			case "3 weeks":
			return 100 * 21;
			case "5 weeks":
			return 100 * 35;
			case "10 weeks":
			return 100 * 70;
			default:
			return "0";
		}
	}

	// cuts down cost based off the location of the course
	function calcCost($location, $length){
		$cost = weekstoDays($length);
		if ($location == "Online") {
			$cost = $cost / 2;
			return $cost;
		}
		else {
			return $cost;
		}
	}

	if ($errMsg != ""){
		echo "<p>$errMsg</p>";
	}
	else {
		$_SESSION["firstname"] = $firstname;
		$_SESSION["lastname"] = $lastname;
		$_SESSION["email"] = $email;
		$_SESSION["streetAddress"] = $streetaddress;
		$_SESSION["suburb"] = $suburb;
		$_SESSION["state"] = $state;
		$_SESSION["postcode"] = $postcode;
		$_SESSION["phone"] = $phone;
		$_SESSION["course"] = $course;
		$_SESSION["location"] = $location;
		$_SESSION["length"] = $length;
		$_SESSION["seats"] = $seats;
		$_SESSION["comments"] = $comments;
		$_SESSION["cost"] = calcCost($location,$length);

		header("location:payment.php");
	}
}
else {
	header("location:enquire.php");
}
?>