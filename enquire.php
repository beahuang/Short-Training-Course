<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Enquire about the short training course" />
	<meta name="keywords" content="short, training, course, short training course" />
	<meta name="author" content="Beatrice Huang" />
	<link rel="stylesheet" href="styles/style.css"/>
	<title>Short Training Course</title>
</head>
<body>
	<?php include("includes/nav.php"); ?>
	<header class="small-banner">
		<h3 class="container">Find a course</h3>
	</header>
	<section class="container">
		<form id="enquire" method="post" action="process-enquire.php" novalidate>
			<fieldset>
				<legend>Personal Details</legend>
				<p>
					<label for="firstname">First Name:</label>
					<input type="text" name= "firstname" id="firstname" required="required" pattern="[a-zA-Z]{1,25}" placeholder="Johno" title="Maximum of 25 characters, alphabetical only"/>
				</p>
				<p>
					<label for="lastname">Last Name:</label>
					<input type="text" name= "lastname" id="lastname" required="required" pattern="[a-zA-Z]{1,25}" placeholder="Smith" title="Maximum of 25 characters, alphabetical only"/>
				</p>
			</fieldset>
			<fieldset>
				<legend>Contact Details</legend>
				<p>
					<label for="email">Email Address:</label>
					<input type="email" name= "email" id="email" required="required" placeholder="johnosmith@gmail.com"/>
				</p>
				<p>
					<label for="streetaddress">Street Address:</label>
					<input type="text" name= "streetaddress" id="streetaddress" required="required" pattern=".{1,40}" title="Maximum 40 characters" placeholder="25 Street St"/>
				</p>
				<p>
					<label for="suburb">Suburb:</label>
					<input type="text" name= "suburb" id="suburb" required="required" pattern=".{1,20}" title="Maximum 20 characters" placeholder="Hawthorn"/>
				</p>
				<p>
					<label for="state">State:</label>
					<select name="state" id="state" required="required">
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
					<label for="postcode">Postcode:</label>
					<input type="text" name= "postcode" id="postcode" required="required" pattern="[0-9]{4}" placeholder="1234" title="Exactly 4 digits"/>
				</p>
				<p>
					<label for="phone">Phone Number:</label>
					<input type="text" name= "phone" id="phone" required="required" title="Maximum 10 digits" placeholder="123456789" pattern="[0-9]{1,10}"/>
				</p>
			</fieldset>
			<fieldset>
				<legend>Short Training Course</legend>
				<p>
					<label for="course">Course Study:</label>
					<select name="course" id="course" required="required">
						<option value="">Please Select</option>
						<option value="Digital Photography">Digital Photography</option>
						<option value="Microsoft Office">Microsoft Office</option>
						<option value="Interior Design">Interior Design</option>
						<option value="Photoshop">Photoshop</option>
						<option value="WordPress">WordPress</option>
						<option value="Other">Other</option>
					</select>
				</p>
				<p class="radio">
					<strong>Course Location:</strong>
					<label for="online">Online</label>
					<input type="radio" id="online" name="location" value="Online" checked="checked" />
					<label for="campus">University</label>
					<input type="radio" id="campus" name="location" value="On Campus"/>
				</p>
				<p class="radio">
					<strong>Length of Course:</strong>
					<label for="length1">5 days</label>
					<input type="radio" id="length1" name="length" value="5 days" checked="checked" />
					<label for="length2">10 days</label>
					<input type="radio" id="length2" name="length" value="10 days"/>
					<label for="length3">3 weeks</label>
					<input type="radio" id="length3" name="length" value="3 weeks"/>
					<label for="length4">5 weeks</label>
					<input type="radio" id="length4" name="length" value="5 weeks"/>
					<label for="length5">10 weeks</label>
					<input type="radio" id="length5" name="length" value="10 weeks"/>
				</p>
				<p class="small-text">Cost of course dependent on: 100$ a day, taking a course online is 1/2 the price of on-campus and amount of seats purchasing</p>
				<p><label for="seats">Amount of Seats:</label>
					<input type="text" name= "seats" id="seats" required="required" title="Positive numbers only" pattern="^[1-9]\d*" size="3" placeholder="1"/>
				</p>
				<p>
					<label for="comment">Any comments..?</label>
					<br/>
					<textarea id="comment" name="comment" rows="4" cols="40" placeholder="Write description of your comment here..."></textarea>
				</p>
			</fieldset>
			<input type="submit" name="submit" value="Submit Form"/>
			<input type="reset" value="Reset Form"/>
		</form>
	</section>
	<?php include("includes/footer.php"); ?>
</body>
</html>