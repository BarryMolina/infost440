<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include('header.php');
include('functions.php');
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
					<input type="text" class="form-control" id="email" name="email">
				</div>
				<div class="col-md-12">
					<label for="password" class="form-label">Password:</label>
					<input type="password" class="form-control" id="password" name="pass">
				</div>
				<div class="col-md-12">
					<button type="submit" name="submit" class="btn btn-primary">Login</button>
				</div>

			</div>
		</fieldset>
	</form>


</main>

<?php include('footer.php'); ?>