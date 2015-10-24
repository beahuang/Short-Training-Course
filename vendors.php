<?php
	session_start();
	 if (!isset ($_SESSION["vendorQuery"])) {
	 	$_SESSION["vendorQuery"] = "select * FROM orders";
	}

	$vendorQuery = $_SESSION["vendorQuery"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Short training course" />
	<meta name="keywords" content="short, training, course, short training course" />
	<meta name="author" content="Beatrice Huang" />
	<link rel="stylesheet" href="styles/style.css"/>
	<script type="text/javascript" src="script/vendor.js"></script>
	<title>Short Training Course</title>
</head>
<body class="vendor">
	<?php include("includes/nav.php");?>
	<header class='small-banner'>
		<h3 class='container'>Processing Order</h3>
	</header>
	<form class="container" id="vendor" method="post" action="vendorquery.php" novalidate>
		<fieldset id="orderfield">
			<legend>Order By</legend>
			<p class="radio">
				<strong for="order">Order By:</strong>
				<label for="all">All</label>
				<input type="radio" id="all" name="orderType" value="all" checked="checked" />
				<label for="name">Name</label>
				<input type="radio" id="name" name="orderType" value="name"/>
				<label for="product">Product</label>
				<input type="radio" id="product" name="orderType" value="product"/>
				<label for="status">Status</label>
				<input type="radio" id="status" name="orderType" value="status"/>
				<label for="cost">Cost</label>
				<input type="radio" id="cost" name="orderType" value="cost"/>
			</p>
			<p id="nameKey" class="hidden">
				<label for="orderName">Keyword:</label>
				<input type="text" name= "orderName" id="orderName" placeholder="John"/>
			</p>
			<p id="productKey" class="hidden">
				<label for="orderProduct">Keyword:</label>
				<input type="text" name= "orderProduct" id="orderProduct" placeholder="Course Name"/>
			</p>
		</fieldset>
		<fieldset>
			<legend>Update Status</legend>
			<p class="radio">
				<strong>Update an Order:</strong>
				<input type="checkbox" id="showUpdateOrder" value="showUpdateOrder"/>
			</p>
			<span id="hiddenUpdateStatus" class="hidden">
				<p>
					<label for="updateOrderNumber">Input Order ID to Update</label>
					<input type="text" name= "updateOrderNumber" id="updateOrderNumber" placeholder="1"/>
				</p>
				<p>
					<label for="orderStatus">Order Status:</label>
					<select name="orderStatus" id="orderStatus">
						<option value="">Please Select</option>
						<option value="PENDING">Pending</option>
						<option value="FUFILLED">Fufilled</option>
						<option value="PAID">Paid</option>
					</select>
				</p>
			</span>
		</fieldset>
		<fieldset>
			<legend>Delete Order</legend>
			<p class="radio">
				<strong>Delete an Order</strong>
				<input type="checkbox" id="showDeleteOrder" value="showDeleteOrder"/>
			</p>
			<span id="hiddenDelete" class="hidden">
				<p>
					<label for="deleteOrderNumber">Input Order ID to Delete</label>
					<input type="text" name= "deleteOrderNumber" id="deleteOrderNumber" placeholder="1"/>
				</p>
			</span>
		</fieldset>
		<input type="submit" name="submit" value="Submit"/>
	</form>
	<?php
	require_once ("settings.php");
	$conn = @mysqli_connect($host,$user,$pwd,$sql_db);

	if (!$conn) {

	echo "<p>Database connection failure</p>";
	} else {

	$sql_table="orders";
	// $vendorQuery="select order_id, orderdate, firstname, lastname, email, streetaddress, suburb, state, postcode, phone, course, location, length, seats, comments, cost, bname, bstreetaddress, bsuburb, bstate, bpostcode, creditcard, creditname, cardnumber, cardexpiry, order_status FROM orders ORDER BY order_id";
	$result = mysqli_query($conn, $vendorQuery);

	if(!$result) {
	echo "<p>Something is wrong with ", $vendorQuery, "</p>";
	} else {

	echo "<table border=\"1\">";
	echo "<tr>"
	."<th scope=\"col\">order_id</th>"
	."<th scope=\"col\">orderdate</th>"
	."<th scope=\"col\">firstname</th>"
	."<th scope=\"col\">lastname</th>"
	."<th scope=\"col\">email</th>"
	."<th scope=\"col\">streetaddress</th>"
	."<th scope=\"col\">suburb</th>"
	."<th scope=\"col\">state</th>"
	."<th scope=\"col\">postcode</th>"
	."<th scope=\"col\">phone</th>"
	."<th scope=\"col\">course</th>"
	."<th scope=\"col\">location</th>"
	."<th scope=\"col\">length</th>"
	."<th scope=\"col\">seats</th>"
	."<th scope=\"col\">comments</th>"
	."<th scope=\"col\">cost</th>"
	."<th scope=\"col\">bname</th>"
	."<th scope=\"col\">bstreetaddress</th>"
	."<th scope=\"col\">bsuburb</th>"
	."<th scope=\"col\">bstate</th>"
	."<th scope=\"col\">bpostcode</th>"
	."<th scope=\"col\">creditcard</th>"
	."<th scope=\"col\">creditname</th>"
	."<th scope=\"col\">cardnumber</th>"
	."<th scope=\"col\">cardexpiry</th>"
	."<th scope=\"col\">order_status</th>"
	."</tr>";

	while ($row = mysqli_fetch_assoc($result)){
	echo "<tr>";
	echo "<td>",$row["order_id"],"</td>";
	echo "<td>",$row["orderdate"],"</td>";
	echo "<td>",$row["firstname"],"</td>";
	echo "<td>",$row["lastname"],"</td>";
	echo "<td>",$row["email"],"</td>";
	echo "<td>",$row["streetaddress"],"</td>";
	echo "<td>",$row["suburb"],"</td>";
	echo "<td>",$row["state"],"</td>";
	echo "<td>",$row["postcode"],"</td>";
	echo "<td>",$row["phone"],"</td>";
	echo "<td>",$row["course"],"</td>";
	echo "<td>",$row["location"],"</td>";
	echo "<td>",$row["length"],"</td>";
	echo "<td>",$row["seats"],"</td>";
	echo "<td>",$row["comments"],"</td>";
	echo "<td>",$row["cost"],"</td>";
	echo "<td>",$row["bname"],"</td>";
	echo "<td>",$row["bstreetaddress"],"</td>";
	echo "<td>",$row["bsuburb"],"</td>";
	echo "<td>",$row["bstate"],"</td>";
	echo "<td>",$row["bpostcode"],"</td>";
	echo "<td>",$row["creditname"],"</td>";
	echo "<td>",$row["creditcard"],"</td>";
	echo "<td>",$row["cardnumber"],"</td>";
	echo "<td>",$row["cardexpiry"],"</td>";
	echo "<td>",$row["order_status"],"</td>";
	echo "</tr>";
	}
	echo "</table>";

	mysqli_free_result($result);
	}

	mysqli_close($conn);
	}

	include("includes/footer.php");
	?>
</body>
</html>