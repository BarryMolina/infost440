<?php
// session_start();
include('auth.php');
// Redirect if user not logged in
if (!$is_admin) {
	header('Location: login.php');
	die();
}
$page_title = 'New Blogpost';
include('header.php');
include('functions.php');
include('mysqli_connect.php');

$current_user_id = mysqli_real_escape_string($dbc, trim($_SESSION['user_id']));
$errors = array();

$blogpost_title = '';
$blogpost_body = '';
$all_valid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!isset($_POST['blogpost_title']) || ($blogpost_title = trim($_POST['blogpost_title'])) == '') {
		$all_valid = false;
		$errors[] = array('alert-level' => 'danger', 'message' => 'Please add a blogpost title');
	}
	if (!isset($_POST['blogpost_body']) || ($blogpost_body = trim($_POST['blogpost_body'])) == '') {
		$all_valid = false;
		$errors[] = array('alert-level' => 'danger', 'message' => 'Please add a blogpost body');
	}
	if ($all_valid) {
		// Insert new blogpost
		$escaped_title = mysqli_real_escape_string($dbc, $blogpost_title);
		$escaped_body = mysqli_real_escape_string($dbc, $blogpost_body);
		$new_blogpost_query = "INSERT INTO blogposts (user_id, blogpost_title, blogpost_body) VALUES ($current_user_id, '$escaped_title', '$escaped_body')";
		echo $new_blogpost_query;
		$new_blogpost_result = mysqli_query($dbc, $new_blogpost_query);
		$insert_success = $new_blogpost_result ? 1 : 0;
		header("Location: index.php?blogpost_inserted=$insert_success");
		die();
	}
}

?>
<main>
	<div class="container">
		<?php
		foreach ($errors as $error) {
			echo display_notification($error['alert-level'], $error['message']);
		}
		?>
		<form action="new_blogpost.php" method="post">
			<fieldset class="row gx-3 gy-3">
				<legend>New Blogpost</legend>
				<div class="col-md-12">
					<label for="blogpost-title" class="form-label">Title:</label>
					<input type="text" name="blogpost_title" class="form-control" id="blogpost-title" value="<?php echo $blogpost_title ?>">
				</div>
				<div class="col-md-12">
					<label class="form-label" for="blogpost-body">Body:</label>
					<textarea class="form-control" id="blogpost-body" name="blogpost_body" rows="15"><?php echo $blogpost_body ?></textarea>
				</div>
				<div class="col-md-12">
					<button type="button" class="btn btn-secondary" onclick='window.location="index.php"'>Cancel</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</fieldset>
		</form>
	</div>
</main>

<?php
// footer
include('footer.php');
?>