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
require_once ("settings.php");
$conn = @mysqli_connect($host,$user,$pwd,$sql_db);

if (!$conn) {
	echo "<p>Database connection failure</p>";
} else {
	$sql_table="orders";

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





	$create_table = "CREATE TABLE orders(
					order_id int(11)  NOT  NULL  AUTO_INCREMENT,
 					orderdate timestamp NOT  NULL  DEFAULT CURRENT_TIMESTAMP,
 					firstname varchar(25)  NOT  NULL,
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
?>
</body>
</html>