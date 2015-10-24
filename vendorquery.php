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
			$_SESSION["vendorQueryBy"] = "order_id";
		break;
		case "name":
			$_SESSION["vendorQueryBy"] = "";
			$_SESSION["vendorQuery"] = "";
		break;
		case "product":
			$_SESSION["vendorQueryBy"] = "";
			$_SESSION["vendorQuery"] = "";
		break;
		case "status":
			$_SESSION["vendorQueryBy"] = "order_status";
		break;
		case "cost":
			$_SESSION["vendorQueryBy"] = "cost";
		break;
	}

	header("location:vendor.php");
?>