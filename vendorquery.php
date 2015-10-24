<?php
	session_start();
	$orderType = sanitise_input($_POST["orderType"]);
	$nameKey = sanitise_input($_POST["name"]);
	$productKey = sanitise_input($_POST["product"]);
	$updateOrderNumber = sanitise_input($_POST["updateOrderNumber"]);
	$updateOrderStatus = sanitise_input($_POST["orderStatus"]);
	$deleteOrderNumber = sanitise_input($_POST["deleteOrderNumber"]);

	echo "$orderType $nameKey $productKey $updateOrderNumber $updateOrderStatus $deleteOrderNumber";
?>