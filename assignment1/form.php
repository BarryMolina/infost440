<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>Form</title>
</head>

<body class="background-antiquewhite">
	<header>
		<h1>Assignment 1</h1>
		<h3>Barry Molina</h3>
	</header>
	<nav><a href="./index.php">&lt; Back</a></nav>
	<main>
		<h2>Form</h2>
		<form action="https://www.google.com" method="post">
			<fieldset>
				<legend>Please take a moment to complete our survery</legend>
				<label for="first-name">First Name:</label>
				<input type="text" name="first-name" value="John">
				<label for="last-name">Last Name:</label>
				<input type="text" name="last-name" value="James"><br><br>
				<label for="email">Email:</label>
				<input type="text" name="email" value="JohnJames@JimmyJohns.org"><br><br>
				<label for="rating">How would you rate your experience?</label>
				<select name="rating" id="rating">
					<option value="10">10</option>
					<option value="9">9</option>
					<option value="8">8</option>
					<option value="7">7</option>
					<option value="6">6</option>
					<option value="5">5</option>
					<option value="4">4</option>
					<option value="3">3</option>
					<option value="2">2</option>
					<option value="1">1</option>
				</select>
				<p>Do you see yourself returning in the future?</p>
				<input type="radio" id="radio-return-true" name="return" value="true" checked>
				<label for="radio-return-true">Yes</label>
				<input type="radio" id="radio-return-false" name="return" value="false">
				<label for="radio-return-false">No</label>

				<p>What was your favorite part?</p>
				<input type="checkbox" id="checkbox-hospitality" name="hospitality" value="hospitality" checked>
				<label for="checkbox-hospitality">The hospitality</label><br>
				<input type="checkbox" id="checkbox-people" name="people" value="people" checked>
				<label for="checkbox-people">The people</label><br>
				<input type="checkbox" id="checkbox-atmosphere" name="atmosphere" value="atmosphere" checked>
				<label for="checkbox-atmosphere">The vibe</label><br>
				<input type="checkbox" id="checkbox-price" name="price" value="price" checked>
				<label for="checkbox-price">The price</label><br><br>
				<label for="textarea-commments">Please leave any additional comments below</label><br><br>
				<textarea id="textarea-comments" name="comments" rows="10" cols="60">What an amazing experience. I had so much fun.</textarea><br><br>
				<input type="submit" value="Submit">
			</fieldset>
		</form>
	</main>
	<!-- <figure>
		<img src="./images/form.png" alt="form.php source code screenshot" />
	</figure> -->
</body>

</html>