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


	$query = "insert into $sql_table (firstname, lastname,email,streetaddress,suburb,state,postcode,phone,course,location,length,seats,comments,cost,bname,bstreetaddress,bsuburb,bstate,bpostcode,creditcard,creditname,cardnumber,cardexpiry) values ('$firstname','$lastname','$email','$streetaddress','$suburb','$state','$postcode','$phone','$course','$location','$length','$seats','$comments','$cost','$bname','$bstreetaddress','$bsuburb','$bstate','$bpostcode','$creditcard','$creditname','$cardnumber','$cardexpiry')";

	$result = mysqli_query($conn, $query);

	if(!$result) {
		echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";
	} else {
		echo "<p class=\"ok\">Successfully added order</p>";
	}
mysqli_close($conn);
}
?>
</body>
</html>