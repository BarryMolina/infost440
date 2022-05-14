<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include('header.php');
include('functions.php');

// echo '<h1>Error!</h1>
// <p class="error">The following error(s) occurred:<br />';
// foreach ($errors as $msg) {
// 	echo " - $msg<br />\n";
// }
// echo '</p><p>Please try again.</p>';

// }
// if (isset($notifications) && !empty($notifications)) {
// 	foreach ($notifications as $notification) {
// 		echo display_notification($notification);
// 	}
// }

// Display the form:
?>
<!-- <h1>Login</h1>
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" /> </p>
	<p>Password: <input type="password" name="pass" size="20" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
</form> -->
<main class="container">
	<?php
	// Print any error messages, if they exist:
	if (isset($errors) && !empty($errors)) {
		echo "<div class='col-lg-4 m-auto'>";
		foreach ($errors as $error) {
			echo display_notification($error['alert-level'], $error['message']);
		}
		echo "</div>";
	}
	?>
	<form class="col-lg-4 p-4 bg-light border m-auto " action="login.php" method="POST">
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