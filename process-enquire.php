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
	if (isset ($_POST["location"])) {
		$location = $_POST["location"];
	}
	if (isset ($_POST["length"])) {
		$length = $_POST["length"];
	}
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

	if ($state=="") {
		$errMsg .= "<p>You must enter your state.</p>";
	}

	if ($postcode=="") {
		$errMsg .= "<p>You must enter your postcode.</p>";
	}
	if (!preg_match("/[0-9]{4}/",$postcode)) {
		$errMsg .= "<p>Exactly four digits for your postcode.</p>";
	}
	$errMsg = $errMsg + checkPostcode($state,$postcode);

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

	if ($phone=="") {
		$errMsg .= "<p>You must enter your phone number.</p>";
	}
	if (!preg_match("/[0-9]{1,10}/",$phone)) {
		$errMsg .= "<p>Maximum of 10 characters for your phone number.</p>";
	}
	if (!is_numeric($phone)) {
		$errMsg .= "<p>You must enter a number for your phone number.</p>";
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