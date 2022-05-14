<?php
include('header.php');
include('functions.php');
include('mysqli_connect.php');

// echo $_SERVER['REQUEST_URI'];
$blogpost_found = false;
// echo $previous_page;
// $parts = parse_url($_SERVER['HTTP_REFERER']);
// print_r($parts);

$errors = array();
$notifications = array();

if (isset($_COOKIE['UpdatePreviousPage'])) {
	$previous_page = $_COOKIE['UpdatePreviousPage'];
} else {
	$previous_page = 'index.php';
}


// Check if user selected to update a blogpost
if (isset($_GET['update_id'])) {
	$update_id = mysqli_real_escape_string($dbc, trim($_GET['update_id']));
	$update_title = '';
	$update_body = '';

	// Check which stage of update process we are on
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$previous_page = basename(parse_url($_SERVER['HTTP_REFERER'])['path']);
		$this_page = basename(parse_url($_SERVER['REQUEST_URI'])['path']);
		// Make sure that the GET request didn't come from the same page
		if ($this_page != $previous_page) {
			// Set a cookie to hold the name of previous page
			setcookie('UpdatePreviousPage', $previous_page, time() + 3600);
		}
		// Grab blogpost
		$select_blogpost_query = "SELECT blogpost_body, blogpost_title from blogposts WHERE blogpost_id = $update_id";
		$select_blogpost_result = mysqli_query($dbc, $select_blogpost_query);
		if ($select_blogpost_result && $update_blogpost = mysqli_fetch_array($select_blogpost_result, MYSQLI_ASSOC)) {
			$blogpost_found = true;
			$update_title = $update_blogpost['blogpost_title'];
			$update_body = $update_blogpost['blogpost_body'];
			// echo get_update_modal($update_id, $update_blogpost['blogpost_title'], $update_blogpost['blogpost_body']);
		}
		// User has updated comment and clicked "save changes"
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$all_valid = true;
		if (isset($_POST['blogpost_body']) && $_POST['blogpost_body'] != '') {
			$update_body = mysqli_real_escape_string($dbc, trim($_POST['blogpost_body']));
		} else {
			$all_valid = false;
			$errors[] = array('alert-level' => 'danger', 'message' => 'Please add a blogpost body');
		}

		if (isset($_POST['blogpost_title']) && $_POST['blogpost_title'] != '') {
			$update_title = mysqli_real_escape_string($dbc, trim($_POST['blogpost_title']));
		} else {
			$all_valid = false;
			$errors[] = array('alert-level' => 'danger', 'message' => 'Please add a blogpost title');
		}

		// Perform blogpost update
		if ($all_valid) {
			$update_blogpost_query = "UPDATE blogposts SET blogpost_title = '$update_title', blogpost_body = '$update_body' WHERE blogpost_id = '$update_id'";
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
			<form action="update.php?update_id=<?php echo $update_id ?>" method="post">
				<fieldset class="row gx-3 gy-3">
					<legend>Update Blogpost</legend>
					<div class="col-md-12">
						<label for="blogpost-title" class="form-label">Title:</label>
						<input type="text" name="blogpost_title" class="form-control" id="blogpost-title" value="<?php echo $update_title ?>">
					</div>
					<div class="col-md-12">
						<label class="form-label" for="blogpost-body">Body:</label>
						<textarea class="form-control" id="blogpost-body" name="blogpost_body" rows="5"><?php echo $update_body ?></textarea>
					</div>
					<div class="col-md-12">
						<button type="button" class="btn btn-secondary" onclick='window.location="<?php echo $previous_page . "?blogpost_id=$update_id" ?>"'>Cancel</button>
						<button type=" submit" class="btn btn-primary">Save changes</button>
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