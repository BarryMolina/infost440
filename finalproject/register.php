<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Register';
include('auth.php');
include('header.php');
include('functions.php');

// Initialize form values
$fn = '';
$ln = '';
$e = '';
$p1 = '';
$p2 = '';

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('mysqli_connect.php'); // Connect to the db.

	$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (isset($_POST['first_name']) && ($fn = trim($_POST['first_name'])) != '') {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	} else {
		$errors[] = array('alert-level' => 'danger', 'message' => 'You forgot to enter your first name.');
	}

	// Check for a last name:
	if (isset($_POST['last_name']) && ($ln = trim($_POST['last_name'])) != '') {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	} else {
		$errors[] = array('alert-level' => 'danger', 'message' => 'You forgot to enter your last name.');
	}

	// Check for an email address:
	if (isset($_POST['email']) && ($e = trim($_POST['email'])) != '') {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	} else {
		$errors[] = array('alert-level' => 'danger', 'message' => 'You forgot to enter your email address.');
	}

	$p1 = isset($_POST['pass1']) ? trim($_POST['pass1']) : '';
	$p2 = isset($_POST['pass2']) ? trim($_POST['pass2']) : '';
	// Check for a password and match against the confirmed password:
	if (!empty($p1)) {
		if ($p1 != $p2) {
			$errors[] = array('alert-level' => 'danger', 'message' => 'Your password did not match the confirmed password.');
		} else {
			$p = mysqli_real_escape_string($dbc, $p1);
		}
	} else {
		$errors[] = array('alert-level' => 'danger', 'message' => 'You forgot to enter your password.');
	}

	if (empty($errors)) { // If everything's OK.

		// Register the user in the database...

		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA2('$p',256), NOW() )";
		$r = @mysqli_query($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
			// Log the user in
			require('login_functions.inc.php');
			list($check, $data) = check_login($dbc, $e, $p);

			if ($check) { // OK!

				// Set the session data:
				// session_start();
				$_SESSION['user_id'] = $data['user_id'];
				$_SESSION['first_name'] = $data['first_name'];

				// Store the HTTP_USER_AGENT:
				$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

				// Redirect:
				redirect_user('index.php');
			} else { // Unsuccessful!

				// Assign $data to $errors for login_page.inc.php:
				$errors = $data;
			}
			// Print a message:
		} else { // If it did not run OK.
			$errors[] = array('alert-level' => 'danger', 'message' => mysqli_error($dbc));
		} // End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include('footer.php');
		exit();
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<main class="container">
	<?php
	if (isset($errors) && !empty($errors)) {
		echo "<div class='col-sm-6 m-auto'>";
		foreach ($errors as $error) {
			echo display_notification($error['alert-level'], $error['message']);
		}
		echo "</div>";
	}
	?>
	<form class="col-sm-6 p-4 bg-light border m-auto " action="register.php" method="POST">
		<fieldset>
			<legend>Register</legend>
			<div class="row g-3">
				<div class="col-md-12">
					<label for="first_name" class="form-label">First Name:</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fn ?>">
				</div>
				<div class="col-md-12">
					<label for="last_name" class="form-label">Last Name:</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $ln ?>">
				</div>
				<div class="col-md-12">
					<label for="email" class="form-label">Email Address:</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $e ?>">
				</div>
				<div class="col-md-12">
					<label for="pass1" class="form-label">Password:</label>
					<input type="password" class="form-control" id="pass1" name="pass1" value="<?php echo $p1 ?>">
				</div>
				<div class="col-md-12">
					<label for="pass2" class="form-label">Confirm Password:</label>
					<input type="password" class="form-control" id="password" name="pass2" value="<?php echo $p2 ?>">
				</div>
				<div class="col-md-12">
					<button type="submit" name="submit" class="btn btn-primary">Register</button>
				</div>

			</div>
		</fieldset>
	</form>


</main>
<?php include('footer.php'); ?>