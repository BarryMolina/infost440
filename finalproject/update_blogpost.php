<?php
session_start();
// Redirect if user not logged in
if ($_SESSION['user_id'] != 1) {
	header('Location: login.php');
	die();
}
$page_title = 'New Blogpost';
include('header.php');
include('functions.php');
include('mysqli_connect.php');

// Flag to determine whether valid blogpost id was passed
$blogpost_found = true;
$errors = array();

// Check if user selected to update a blogpost
if (isset($_GET['update_id'])) {
	$update_id = mysqli_real_escape_string($dbc, trim($_GET['update_id']));
	$update_title = '';
	$update_body = '';

	// Check which stage of update process we are on
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		// Store page name if user came from a page other than this one
		$previous_page = basename(parse_url($_SERVER['HTTP_REFERER'])['path']);
		$this_page = basename(parse_url($_SERVER['REQUEST_URI'])['path']);
		if ($this_page != $previous_page) {
			setcookie('UpdatePreviousPage', $previous_page, time() + 3600);
		}
		// Grab blogpost
		$select_blogpost_query = "SELECT blogpost_body, blogpost_title from blogposts WHERE blogpost_id = $update_id";
		$select_blogpost_result = mysqli_query($dbc, $select_blogpost_query);
		if ($select_blogpost_result && $update_blogpost = mysqli_fetch_array($select_blogpost_result, MYSQLI_ASSOC)) {
			$update_title = $update_blogpost['blogpost_title'];
			$update_body = $update_blogpost['blogpost_body'];
			// echo get_update_modal($update_id, $update_blogpost['blogpost_title'], $update_blogpost['blogpost_body']);
		} else {
			$blogpost_found = false;
		}
		// User has updated comment and clicked "save changes"
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Try to determine whether user came from index.php or view_blogpost.php based on cookie data
		if (isset($_COOKIE['UpdatePreviousPage'])) {
			$previous_page = $_COOKIE['UpdatePreviousPage'];
		} else {
			$previous_page = 'index.php';
		}

		$all_valid = true;

		if (isset($_POST['blogpost_title']) && ($update_title = trim($_POST['blogpost_title'])) != '') {
			$escaped_title = mysqli_real_escape_string($dbc, trim($_POST['blogpost_title']));
		} else {
			$all_valid = false;
			$errors[] = array('alert-level' => 'danger', 'message' => 'Please add a blogpost title');
		}

		if (isset($_POST['blogpost_body']) && ($update_body = trim($_POST['blogpost_body'])) != '') {
			$escaped_body = mysqli_real_escape_string($dbc, trim($_POST['blogpost_body']));
		} else {
			$all_valid = false;
			$errors[] = array('alert-level' => 'danger', 'message' => 'Please add a blogpost body');
		}

		// Perform blogpost update
		if ($all_valid) {
			$update_blogpost_query = "UPDATE blogposts SET blogpost_title = '$escaped_title', blogpost_body = '$escaped_body' WHERE blogpost_id = '$update_id'";
			$update_blogpost_result = mysqli_query($dbc, $update_blogpost_query);

			// Redirect to previous page with update result
			$updated = $update_blogpost_result && mysqli_affected_rows($dbc) > 0;

			header("Location: $previous_page?blogpost_id=$update_id&blogpost_updated=$updated");
			die();
		}
	}
}
?>

<main>
	<div class="container" id="blogposts">
		<?php
		if ($blogpost_found) :
			foreach ($errors as $error) {
				echo display_notification($error['alert-level'], $error['message']);
			}
		?>
			<form action="update_blogpost.php?update_id=<?php echo $update_id ?>" method="post">
				<fieldset class="row gx-3 gy-3">
					<legend>Update Blogpost</legend>
					<div class="col-md-12">
						<label for="blogpost-title" class="form-label">Title:</label>
						<input type="text" name="blogpost_title" class="form-control" id="blogpost-title" value="<?php echo $update_title ?>">
					</div>
					<div class="col-md-12">
						<label class="form-label" for="blogpost-body">Body:</label>
						<textarea class="form-control" id="blogpost-body" name="blogpost_body" rows="15"><?php echo $update_body ?></textarea>
					</div>
					<div class="col-md-12">
						<button type="button" class="btn btn-secondary" onclick='window.location="<?php echo $previous_page . "?blogpost_id=$update_id" ?>"'>Cancel</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</fieldset>
			</form>
		<?php else : ?>
			<p>Blog post not found.</p>
		<?php endif; ?>
	</div>
</main>

<?php
// footer
include('footer.php');
?>