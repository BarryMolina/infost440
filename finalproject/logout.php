<?php # Script 12.11 - logout.php #2
// This page lets the user logout.
// This version uses sessions.

// session_start(); // Access the existing session.
include('auth.php');

// If no session variable exists, redirect the user:
if (!$logged_in) {

	// Need the functions:
	require('login_functions.inc.php');
	redirect_user();
} else { // Cancel the session:

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0); // Destroy the cookie.
}

// Log out page:
$page_title = 'Logged Out';
include('header.php');
?>
<main>
	<div class="container">
		<p>Successfully logged out.</p>
	</div>
</main>
<?php
include('footer.php');
