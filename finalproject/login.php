<?php # Script 12.12 - login.php #4
// auth.php starts session
include('auth.php');

$page_title = 'Login';
include('header.php');
include('functions.php');

// This page processes the login form submission.
// The script now stores the HTTP_USER_AGENT value for added security.

// Initialize form values
$e = '';
$p = '';

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	require('login_functions.inc.php');
	require('mysqli_connect.php');

	$e = isset($_POST['email']) ? trim($_POST['email']) : '';
	$p = isset($_POST['pass']) ? trim($_POST['pass']) : '';

	// Check the login:
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

	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
// include('login_page.inc.php');
?>
<main class="container">
	<?php
	// Print any error messages, if they exist:
	if (isset($errors) && !empty($errors)) {
		echo "<div class='col-sm-6 m-auto'>";
		foreach ($errors as $error) {
			echo display_notification($error['alert-level'], $error['message']);
		}
		echo "</div>";
	}
	?>
	<form class="col-sm-6 p-4 bg-light border m-auto " action="login.php" method="POST">
		<fieldset>
			<legend>Login</legend>
			<div class="row g-3">
				<div class="col-md-12">
					<label for="email" class="form-label">Email Address:</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $e ?>">
				</div>
				<div class="col-md-12">
					<label for="password" class="form-label">Password:</label>
					<input type="password" class="form-control" id="password" name="pass" value="<?php echo $p ?>">
				</div>
				<div class="col-md-12">
					<button type="submit" name="submit" class="btn btn-primary">Login</button>
				</div>

			</div>
		</fieldset>
	</form>
</main>
<?php include('footer.php'); ?>