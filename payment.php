<?php
	session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Enquire about the short training course" />
	<meta name="keywords" content="short, training, course, short training course" />
	<meta name="author" content="Beatrice Huang" />
	<link rel="stylesheet" href="styles/style.css"/>
	<script type="text/javascript" src="script/confirm.js"></script>
	<title>Short Training Course</title>
</head>
<body>
	<?php include("includes/nav.php"); ?>
	<header class="small-banner">
		<h3 class="container">Find a course</h3>
	</header>
	<section class="container">
		<form id="confirmform" method="post" action="addorder.php" novalidate>
			<fieldset>
				<legend>Customer Details</legend>
				<p>Your Name: <?php echo "$firstname $lastname"?></p>
				<p>Email: <?php echo "$email" ?></p>
				<p>Street Address: <?php echo "$streetaddress" ?></p>
				<p>Suburb: <?php echo "$suburb" ?></p>
				<p>State: <?php echo "$state" ?></p>
				<p>Postcode: <?php echo "$postcode" ?></p>
				<p>Phone Number: <?php echo "$phone" ?></p>
			</fieldset>
			<fieldset>
				<legend>Course Details</legend>
				<p>Course Study: <?php echo "$course" ?></p>
				<p>Course Location: <?php echo "$location" ?></p>
				<p>Course Length: <?php echo "$length" ?></p>
				<p>Number of Seats: <?php echo "$seats" ?></p>
				<p>Comments: <?php echo "$comments" ?></p>
				<p>Total Cost: $<?php echo "$cost" ?></p>
		    </fieldset>
		    <fieldset id="billingSection" class="hidden">
		    	<legend>Billing Address</legend>
		    	<p>
		    		<label for="bfirstname">First Name:</label>
		    		<input type="text" name= "bfirstname" id="bfirstname" pattern="[a-zA-Z]{1,25}" placeholder="Johno" title="Maximum of 25 characters, alphabetical only"/>
		    	</p>
		    	<p>
		    		<label for="bstreetaddress">Street Address:</label>
		    		<input type="text" name= "bstreetaddress" id="bstreetaddress" pattern=".{1,40}" title="Maximum 40 characters" placeholder="25 Street St"/>
		    	</p>
		    	<p>
		    		<label for="bsuburb">Suburb:</label>
		    		<input type="text" name= "bsuburb" id="bsuburb" pattern=".{1,20}" title="Maximum 20 characters" placeholder="Hawthorn"/>
		    	</p>
		    	<p>
		    		<label for="bstate">State:</label>
		    		<select name="bstate" id="bstate">
		    			<option value="">Please Select</option>
		    			<option value="VIC">VIC</option>
		    			<option value="NSW">NSW</option>
		    			<option value="QLD">QLD</option>
		    			<option value="NT">NT</option>
		    			<option value="WA">WA</option>
		    			<option value="SA">SA</option>
		    			<option value="TAS">TAS</option>
		    			<option value="ACT">ACT</option>
		    		</select>
		    	</p>
		    	<p>
		    		<label for="bpostcode">Postcode:</label>
		    		<input type="text" name= "bpostcode" id="bpostcode" pattern="[0-9]{4}" placeholder="1234" title="Exactly 4 digits"/>
		    	</p>
		    </fieldset>
		    <fieldset>
		    	<legend>Payment Details</legend>
		    	<p class="radio">
		    		<strong>Separate Billing Address:</strong>
		    		<input type="checkbox" id="separateBilling" value="seperate"/>
		    	</p>
		    	<p>
		    		<label for="creditcard">Credit Card Type:</label>
		    		<select name="creditcard" id="creditcard" required="required">
		    			<option value="">Please Select</option>
		    			<option value="Visa">Visa</option>
		    			<option value="Mastercard">Mastercard</option>
		    			<option value="American Express">American Express</option>
		    		</select>
		    	</p>
		    	<p>
		    		<label for="creditname">Full Name:</label>
		    		<input type="text" name= "creditname" id="creditname" required="required" pattern="[a-zA-Z]{1,30}" placeholder="Johno Smith" title="Maximum of 30 characters, alphabetical only"/>
		    	</p>
		    	<p>
		    		<label for="cardnumber">Credit Card Number:</label>
		    		<input type="text" name= "cardnumber" id="cardnumber" required="required" pattern="[0-9]{15,16}" placeholder="1234123412341234" title="Exactly 15 or 16 digits"/>
		    	</p>
		    	<p>
		    		<label for="cardexpiry">Card Expiry Date:</label>
		    		<input type="text" id="cardexpiry" name="cardexpiry" required="required" placeholder="mm/yy" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" title="Format mm/yy" maxlength="5" size="5" />
		    	</p>
		    </fieldset>
			<input type="submit" name="submit" value="Confirm Payment"/>
			<button type="button" id="cancelButton">Cancel</button>
		</form>
	</section>
	<?php include("includes/footer.php"); ?>
</body>
</html>