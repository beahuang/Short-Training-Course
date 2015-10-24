<?php
	session_start();

	function sanitise_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$orderType = sanitise_input($_POST["orderType"]);
	$firstNameKey = sanitise_input($_POST["firstNameKey"]);
	$lastNameKey = sanitise_input($_POST["lastNameKey"]);
	$productKey = sanitise_input($_POST["orderProduct"]);
	$statusKey = sanitise_input($_POST["orderStatusKey"]);
	$updateOrderNumber = sanitise_input($_POST["updateOrderNumber"]);
	$updateOrderStatus = sanitise_input($_POST["orderStatus"]);
	$deleteOrderNumber = sanitise_input($_POST["deleteOrderNumber"]);

	switch ($orderType) {
		case "all":
			$_SESSION["vendorQuery"] = "SELECT * FROM orders ORDER BY order_id";
		break;
		case "name":
			$_SESSION["vendorQuery"] = "SELECT * FROM orders WHERE firstname=$firstNameKey AND lastname=$lastNameKey";
		break;
		case "product":
			$_SESSION["vendorQuery"] = "SELECT * FROM orders WHERE course=$productKey";
		break;
		case "status":
			$_SESSION["vendorQuery"] = "SELECT * FROM orders WHERE order_status=$order_status";
		break;
		case "cost":
			$_SESSION["vendorQuery"] = "SELECT * FROM orders ORDER BY cost";
		break;
	}

	if (is_numeric($deleteOrderNumber)) {
		$_SESSION["deleteQuery"] = "DELETE FROM orders WHERE order_id=$deleteOrderNumber";
	}

	if (is_numeric($updateOrderNumber) && ($updateOrderStatus != "")) {
		$_SESSION["updateQuery"] = "UPDATE orders SET order_status=$updateOrderStatus WHERE order_id=$updateOrderNumber";
	}

	header("location:vendors.php");
?>