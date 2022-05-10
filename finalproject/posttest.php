<?php
session_start(); // Start the session.
if (isset($_SESSION['user_id'])) {
	echo 'You are logged in and can post on this page!
			<br />
			<form>
			<textarea name="comment" cols="40" rows="5">
			</textarea>
			<br /><br />
			<input type="submit" name="submit" value="Submit" />
			</form>';
} else { 
	header('Location: http://infost440.uwmsois.com/week10/login_example/login.php');
}
?>