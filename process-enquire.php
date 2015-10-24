<?php
if (isset ($_POST["firstname"]) && $_POST["firstname"] != "") {
	$firstname = $_POST["firstname"];

	if (isset ($_POST["lastname"])) {
		$lastname = $_POST["lastname"];
	}
	if (isset ($_POST["email"])) {
		$email = $_POST["email"];
	}
	if (isset ($_POST["streetaddress"])) {
		$streetaddress = $_POST["streetaddress"];
	}
	if (isset ($_POST["suburb"])) {
		$suburb = $_POST["suburb"];
	}
	if (isset ($_POST["state"])) {
		$state = $_POST["state"];
	}
	if (isset ($_POST["postcode"])) {
		$postcode = $_POST["postcode"];
	}
	if (isset ($_POST["phone"])) {
		$phone = $_POST["phone"];
	}
	if (isset ($_POST["course"])) {
		$course = $_POST["course"];
	}

	$location = "";
	if (isset ($_POST["Online"])) $tour = "Online";
	if (isset ($_POST["University"])) $tour = "University";

	$length = "";
	if (isset ($_POST["5 days"])) $tour = "5 days";
	if (isset ($_POST["10 days"])) $tour = "10 days";
	if (isset ($_POST["3 weeks"])) $tour = "3 weeks";
	if (isset ($_POST["5 weeks"])) $tour = "5 weeks";
	if (isset ($_POST["10 weeks"])) $tour = "10 weeks";

	if (isset ($_POST["seats"])) {
		$seats = $_POST["seats"];
	}
	if (isset ($_POST["comment"])) {
		$comments = $_POST["comment"];
	}

	function sanitise_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$firstname = sanitise_input($firstname);
	$lastname = sanitise_input($lastname);
	$email = sanitise_input($email);
	$streetaddress = sanitise_input($streetaddress);
	$suburb = sanitise_input($suburb);
	$state = sanitise_input($state);
	$postcode = sanitise_input($postcode);
	$phone = sanitise_input($phone);
	$course = sanitise_input($course);
	$location = sanitise_input($location);
	$length = sanitise_input($length);
	$seats = sanitise_input($seats);
	$comments = sanitise_input($comments);

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
	if (!preg_match("/[a-zA-Z]{1,25}/",$email)) {
		$errMsg .= "<p>Maximum of 25 characters, alphabetical only for your first name.</p>";
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
	if (!preg_match(".{1,20}",$suburb)) {
		$errMsg .= "<p>Maximum of 20 characters for your suburb.</p>";
	}

	if ($state=="") {
		$errMsg .= "<p>You must enter your state.</p>";
	}

	if ($postcode=="") {
		$errMsg .= "<p>You must enter your postcode.</p>";
	}
	if (!preg_match("/[0-9]{4}/",$postcode)) {
		$errMsg .= "<p>Exactly four digits for your postcode.</p>";
	}

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
		$errMsg .= "<p>You must choose a course.</p>";
	}

	if ($location=="") {
		$errMsg .= "<p>You must choose a location.</p>";
	}

	if ($length=="") {
		$errMsg .= "<p>You must enter choose a length for your course.</p>";
	}

	if ($seats=="") {
		$errMsg .= "<p>You must enter how many seats you want to book.</p>";
	}
	if ((!is_numeric($seats)) || ($seats < 0) || (100 < $seats)) {
		$errMsg .= "<p>You enter a positive number between 1 and 100 for seats.</p>";
	}

	if ($errMsg != ""){
		echo "<p>$errMsg</p>";
	}
	else {
		header("location:payment.php");
	}
}
else {
	header("location:enquire.php");
}
?>