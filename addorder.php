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
	$firstname = trim($_POST["firstname"]);
	$lastname = trim($_POST["lastname"]);
	$email = trim($_POST["email"]);
	$streetaddress = trim($_POST["streetAddress"]);
	$suburb = trim($_POST["suburb"]);
	$state = trim($_POST["state"]);
	$postcode = trim($_POST["postcode"]);
	$phone = trim($_POST["phone"]);
	$course = trim($_POST["course"]);
	$location = trim($_POST["location"]);
	$length = trim($_POST["length"]);
	$seats = trim($_POST["seats"]);
	$comments = trim($_POST["comments"]);

	$cost = trim($_POST["cost"]);
	$bname = trim($_POST["bfirstname"]);
	$bstreetaddress = trim($_POST["bstreetaddress"]);
	$bsuburb = trim($_POST["bsuburb"]);
	$bstate = trim($_POST["bstate"]);
	$bpostcode = trim($_POST["bpostcode"]);
	$creditcard = trim($_POST["creditcard"]);
	$creditname = trim($_POST["creditname"]);
	$cardnumber = trim($_POST["cardnumber"]);
	$cardexpiry = trim($_POST["cardexpiry"]);



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