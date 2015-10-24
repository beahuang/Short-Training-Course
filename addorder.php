<?php
	session_start();
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Creating Web Applications Lab 10" />
	<meta name="keywords" content="PHP, MySql" />
	<title>Process Order</title>
</head>
<body>
	<h1>Processing Order</h1>
<?php
//already checked in process-enquire.php
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
$streetaddress = $_SESSION["streetAddress"];
$suburb = $_SESSION["suburb"];
$state = $_SESSION["state"];
$postcode = $_SESSION["postcode"];
$phone = $_SESSION["phone"];
$course = $_SESSION["course"];
$location = $_SESSION["location"];
$length = $_SESSION["length"];
$seats = $_SESSION["seats"];
$comments = $_SESSION["comments"];
$cost = $_SESSION["cost"];

function sanitise_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$bname = sanitise_input($_POST["bfirstname"]);
$bstreetaddress = sanitise_input($_POST["bstreetaddress"]);
$bsuburb = sanitise_input($_POST["bsuburb"]);
$bstate = sanitise_input($_POST["bstate"]);
$bpostcode = sanitise_input($_POST["bpostcode"]);
$creditcard = sanitise_input($_POST["creditcard"]);
$creditname = sanitise_input($_POST["creditname"]);
$cardnumber = sanitise_input($_POST["cardnumber"]);
$cardexpiry = sanitise_input($_POST["cardexpiry"]);

if (isset ($_POST["submit"])) {
	$errMsg = "";
	if (!preg_match("/[a-zA-Z]{1,25}/",$bname) && ($bname != "")) {
		$errMsg .= "<p>Maximum of 30 characters, alphabetical only for your billing name.</p>";
	}

	if (!preg_match("/.{1,40}/",$bstreetaddress)) {
		$errMsg .= "<p>Maximum 40 characters for your billing street address.</p>";
	}

	if (!preg_match("/.{1,20}/",$bsuburb)) {
		$errMsg .= "<p>Maximum of 20 characters for your billing suburb.</p>";
	}

	if (!preg_match("/[0-9]{4}/",$bpostcode)) {
		$errMsg .= "<p>Exactly four digits for your billing postcode.</p>";
	}
	function checkPostcode($bstate, $bpostcode) {
		$errMsg = "";
		switch ($bstate) {
			case "VIC":
			if (!preg_match("/^[3,8].*$/",$bpostcode)) {
				$errMsg = "If you're from VIC your billing postcode starts with 3 or 8";
			}
			break;
			case "NSW":
			if (!preg_match("/^[1,2].*$/",$bpostcode)) {
				$errMsg = "If you're from NSW your billing postcode starts with 1 or 2";
			}
			break;
			case "QLD":
			if (!preg_match("/^[4,9].*$/",$bpostcode)) {
				$errMsg = "If you're from QLD your billing postcode starts with 4 or 9";
			}
			break;
			case "NT":
			if (!preg_match("/^[0].*$/",$bpostcode)) {
				$errMsg = "If you're from NT your billing postcode starts with 0";
			}
			break;
			case "WA":
			if (!preg_match("/^[6].*$/",$bpostcode)) {
				$errMsg = "If you're from WA your billing postcode starts with 6";
			}
			break;
			case "SA":
			if (!preg_match("/^[5].*$/",$bpostcode)) {
				$errMsg = "If you're from SA your billing postcode starts with 5";
			}
			break;
			case "TAS":
			if (!preg_match("/^[7].*$/",$bpostcode)) {
				$errMsg = "If you're from TAS your billing postcode starts with 7";
			}
			break;
			case "ACT":
			if (!preg_match("/^[0].*$/",$bpostcode)) {
				$errMsg = "If you're from ACT your billing postcode starts with 0";
			}
			break;
		}
		return $errMsg;
	}
	$errMsg .= checkPostcode($bstate,$bpostcode);

	// Checks if the expiration date of the card is earlier than today's date
	function checkExpiry($date) {
		$cmm = substr($date,0,2);
		$cyy = substr($date,3,5);
		$expires = \DateTime::createFromFormat('my', $cmm.$cyy);
		$now     = new \DateTime();

		if ($expires < $now) {
			return "This creditcard has expired";
		}
		else {
			return "";
		}
	}
	$errMsg .= checkExpiry($cardexpiry);

	// checks card number against the card type
	function checkCardNumber($cardtype, $number) {
		$errMsg = "";
		switch ($cardtype) {
			case "Visa":
			if (!preg_match("/4[0-9]{15}/",$number)) {
				$errMsg = "Visa cards have 16 digits and start with a 4";
			}
			break;
			case "Mastercard":
			if (!preg_match("/5[1-5][0-9]{14}/",$number)) {
				$errMsg = "MasterCard have 16 digits and start with digits 51 through to 55";
			}
			break;
			case "American Express":
			if (!preg_match("/3[47][0-9]{13}/",$number)) {
				$errMsg = "American Express has 15 digits and starts with 34 or 37";
			}
			break;
			default:
			$errMsg = "Please choose a card type";
		}
		return $errMsg;
	}
	$errMsg .= checkCardNumber($creditcard,$cardnumber);

	if ($errMsg != ""){
		echo "<h2>Please correct the following errors before submitting again:</h2>
			<p>$errMsg</p>";
	}
	else {
		require_once ("settings.php");
		$conn = @mysqli_connect($host,$user,$pwd,$sql_db);

		if (!$conn) {
			echo "<p>Database connection failure</p>";
		} else {
			$sql_table="orders";
			$create_table = "CREATE TABLE orders(
							order_id int(11)  NOT  NULL  AUTO_INCREMENT,
		 					orderdate timestamp NOT  NULL  DEFAULT CURRENT_TIMESTAMP,
		 					firstname c$har(25)  NOT  NULL,
		 					lastname varchar(25)  NOT  NULL ,
		 					email varchar(255)  NOT  NULL ,
		 					streetaddress varchar(40)  NOT  NULL ,
		 					suburb varchar(20)  NOT  NULL ,
		 					state enum('VIC',  'NSW',  'QLD',  'NT',  'WA',  'SA',  'TAS',  'ACT')  NOT  NULL ,
		 					postcode int(4)  NOT  NULL ,
		 					phone int(10)  NOT  NULL ,
		 					course enum('Digital Photography',  'Microsoft Office',  'Interior Design',  'Photoshop',  'Wordpress',  'other')  NOT  NULL ,
		 					location enum('Online',  'University',  '',  '')  NOT  NULL ,
		 					length enum('5 days',  '10 days',  '3 weeks',  '5 weeks',  '10 weeks')  NOT  NULL ,
		 					seats int(3)  NOT  NULL ,
		 					comments varchar(255)  NOT  NULL ,
		 					cost float NOT  NULL ,
		 					bname varchar(30)  NOT  NULL ,
		 					bstreetaddress varchar(40)  NOT  NULL ,
		 					bsuburb varchar(20)  NOT  NULL ,
		 					bstate enum('',  'VIC',  'NSW',  'QLD',  'NT',  'WA',  'SA',  'TAS',  'ACT',  '')  NOT  NULL DEFAULT  '',
		 					bpostcode int(4)  NOT  NULL ,
		 					creditcard enum('Visa',  'Mastercard',  'American Express')  NOT  NULL ,
		 					creditname varchar(30)  NOT  NULL ,
		 					cardnumber int(16)  NOT  NULL ,
		 					cardexpiry varchar(5)  NOT  NULL ,
		 					order_status enum('PENDING',  'FUFILLED',  'PAID') DEFAULT  'PENDING',
		 					PRIMARY  KEY (order_id))";

				$insert_query = "insert into $sql_table (firstname, lastname,email,streetaddress,suburb,state,postcode,phone,course,location,length,seats,comments,cost,bname,bstreetaddress,bsuburb,bstate,bpostcode,creditcard,creditname,cardnumber,cardexpiry) values ('$firstname','$lastname','$email','$streetaddress','$suburb','$state','$postcode','$phone','$course','$location','$length','$seats','$comments','$cost','$bname','$bstreetaddress','$bsuburb','$bstate','$bpostcode','$creditcard','$creditname','$cardnumber','$cardexpiry')";

				$tableExistsQuery = "SELECT * FROM $sql_table";
				$tableExists = mysqli_query($conn, $tableExistsQuery);

				if(empty($tableExists)) {
					mysqli_query($conn, $create_table);
					$result = mysqli_query($conn, $insert_query);
					if(!$result) {
						echo "<p class='wrong'>Something is wrong with ", $insert_query, "</p>";
					} else {
						echo "<p class='ok'>Successfully added order</p>";
					}
				} else {
					$result = mysqli_query($conn, $insert_query);
					if(!$result) {
						echo "<p class='wrong'>Something is wrong with ", $insert_query, "</p>";
					} else {
						echo "<p class='ok'>Successfully added order</p>";
					}
				}
		mysqli_close($conn);
		}
	}
}
else {
	header("location:enquire.php");
}

?>
</body>
</html>