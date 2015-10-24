<?php
	session_start();

	function sanitise_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$orderType = sanitise_input($_POST["orderType"]);
	$nameKey = sanitise_input($_POST["orderName"]);
	$productKey = sanitise_input($_POST["orderProduct"]);
	$updateOrderNumber = sanitise_input($_POST["updateOrderNumber"]);
	$updateOrderStatus = sanitise_input($_POST["orderStatus"]);
	$deleteOrderNumber = sanitise_input($_POST["deleteOrderNumber"]);

	echo "$orderType $nameKey $productKey $updateOrderNumber $updateOrderStatus $deleteOrderNumber";

	switch ($orderType) {
		case "all":
			$_SESSION["vendorQuery"] = "select * FROM orders ORDER BY order_id";
		break;
		// case "name":
		// 	$_SESSION["vendorQuery"] = "";
		// 	$_SESSION["vendorQuery"] = "";
		// break;
		// case "product":
		// 	$_SESSION["vendorQuery"] = "";
		// 	$_SESSION["vendorQuery"] = "";
		// break;
		case "status":
			$_SESSION["vendorQuery"] = "select * FROM orders ORDER BY order_status";
		break;
		case "cost":
			$_SESSION["vendorQuery"] = "select * FROM orders ORDER BY cost";
		break;
	}

	header("location:vendors.php");
?>