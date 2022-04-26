<?php
include('header.php');
include('mysqli_connect.php');

// Array to hold validation errors and success banners
$notifications = array();

// The sort and pagination params needed to maintain page location while updating and deleting
$page_location = page_location_params();

//***********************************************
//DELETE LOGIC START
//***********************************************
if (isset($_GET['delete_id'])) {
	$delete_id = mysqli_real_escape_string($dbc, trim($_GET['delete_id']));
	$delete_query = "DELETE from guestbook WHERE guestbook_id = $delete_id";
	$delete_results = mysqli_query($dbc, $delete_query);
	if ($delete_results) {
		$notifications[] = array('alert-level' => 'danger', 'message' => 'Guestbook entry deleted');
	}
}

//***********************************************
//DELETE LOGIC END
//***********************************************

//***********************************************
//UPDATE LOGIC START
//***********************************************

function get_update_modal($update_id, $update_comment, $errors = array()) {
	$page_location = page_location_params();
	ob_start(); ?>
	<!-- Update comment modal -->
	<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Comment</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="index.php?<?php echo $page_location ?>&update_id=<?php echo $update_id ?>" method="post">
					<div class="modal-body">
						<?php
						foreach ($errors as $error) {
							echo display_notification($error['alert-level'], $error['message']);
						}

						?>
						<textarea class="form-control" id="comment" name="comment" rows="5"><?php echo $update_comment ?></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
		<!-- javascript to open update modal on page load-->
		<script>
			// Only run once bootstrap js has loaded
			window.onload = function loaded() {
				var myModal = new bootstrap.Modal(document.getElementById('updateModal'))
				myModal.show()
			}
		</script>
	</div>

<?php
	return ob_get_clean();
}

// Check if user selected to update a comment
if (isset($_GET['update_id'])) {
	$update_id = mysqli_real_escape_string($dbc, trim($_GET['update_id']));

	// Check which stage of update process we are on
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		// Grab comment from guestbook entry
		$select_comment_query = "SELECT comment from guestbook WHERE guestbook_id = $update_id";
		$select_comment_result = mysqli_query($dbc, $select_comment_query);
		if ($select_comment_result) {
			$update_comment = mysqli_fetch_array($select_comment_result, MYSQLI_ASSOC)['comment'];
			echo get_update_modal($update_id, $update_comment);
		}
		// User has updated comment and clicked "save changes"
	} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['comment']) && $_POST['comment'] != '') {
			$updated_comment = mysqli_real_escape_string($dbc, trim($_POST['comment']));
			$update_comment_query = "UPDATE guestbook SET comment = '$updated_comment' WHERE guestbook_id = '$update_id'";
			$update_comment_results = mysqli_query($dbc, $update_comment_query);
			if ($update_comment_results) {
				$notifications[] = array('alert-level' => 'success', 'message' => 'Guestbook entry updated');
			}
		} else {
			echo get_update_modal($update_id, $update_comment, array(array('alert-level' => 'danger', 'message' => 'Please enter a comment')));
		}
	}
}
//***********************************************
//UPDATE LOGIC END
//***********************************************


//***********************************************
//PAGINATION SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
	// Count the number of records:
	$q = "SELECT COUNT(guestbook_id) FROM guestbook";
	$r = mysqli_query($dbc, $q);
	$rowp = mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $rowp[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil($records / $display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

//***********************************************
//PAGINATION SETUP END
//***********************************************

//***********************************************
//SORTING SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'date_desc';

// Determine the sorting order:
switch ($sort) {
	case 'fname_asc':
		$order_by = 'fname ASC';
		break;
	case 'fname_desc':
		$order_by = 'fname DESC';
		break;
	case 'lname_asc':
		$order_by = 'lname ASC';
		break;
	case 'lname_desc':
		$order_by = 'lname DESC';
		break;
	case 'date_asc':
		$order_by = 'date ASC';
		break;
	case 'date_desc':
		$order_by = 'date DESC';
		break;
	default:
		$order_by = 'date DESC';
		$sort = 'date_desc';
		break;
}

//***********************************************
//SORTING SETUP END
//***********************************************

// Grab guestbook queries according to pagination location and sort criteria
$select_all_query = "SELECT guestbook_id, CONCAT(fname, ' ', lname) as name, comment, DATE_FORMAT(date, '%M %e, %Y') as last_updated FROM guestbook ORDER BY $order_by LIMIT $start, $display";
$selet_all_results = mysqli_query($dbc, $select_all_query);

?>

<main>
	<div class="container">
		<?php
		foreach ($notifications as $notification) {
			echo display_notification($notification['alert-level'], $notification['message']);
		}
		?>
		<div class="d-flex justify-content-between align-items-center">
			<h1>The Guestbook</h1>
			<!-- Sorting nav pills  -->
			<ul class="nav nav-pills">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle <?php echo str_starts_with($sort, 'fname') ? 'active' : '' ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">First name</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item <?php echo $sort == 'fname_asc' ? 'active' : '' ?>" href="?sort=fname_asc">Ascending</a></li>
						<li><a class="dropdown-item <?php echo $sort == 'fname_desc' ? 'active' : '' ?>" href="?sort=fname_desc">Decending</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle <?php echo str_starts_with($sort, 'lname') ? 'active' : '' ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Last name</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item <?php echo $sort == 'lname_asc' ? 'active' : '' ?>" href="?sort=lname_asc">Ascending</a></li>
						<li><a class="dropdown-item <?php echo $sort == 'lname_desc' ? 'active' : '' ?>" href="?sort=lname_desc">Decending</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle <?php echo str_starts_with($sort, 'date') ? 'active' : '' ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Date</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item <?php echo $sort == 'date_asc' ? 'active' : '' ?>" href="?sort=date_asc">Ascending</a></li>
						<li><a class="dropdown-item <?php echo $sort == 'date_desc' ? 'active' : '' ?>" href="?sort=date_desc">Decending</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Guestbook entires in Bootstrap table -->
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Comment</th>
					<th scope="col">Date</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<!-- Use alternative control structure syntax for code highlighting within PHP code blocks -->
				<?php
				// Generate entry rows
				while ($row = mysqli_fetch_array($selet_all_results, MYSQLI_ASSOC)) :
					$id = $row['guestbook_id'];
					$name = $row['name'];
					$comment = $row['comment'];
					$date = $row['last_updated'];
				?>
					<tr>
						<td class='text-nowrap'><?php echo $name ?></td>
						<td><?php echo $comment ?></td>
						<td class='text-nowrap'><?php echo $date ?></td>
						<td class='text-nowrap'>
							<a class="btn btn-outline-primary" href="index.php?<?php echo $page_location ?>&update_id=<?php echo $id ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
									<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
								</svg>
							</a>
							<a class="btn btn-outline-danger" href="index.php?<?php echo $page_location ?>&delete_id=<?php echo $id; ?>">
								<svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
									<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
								</svg>
							</a>
						</td>
					</tr>
				<?php endwhile ?>
			</tbody>
		</table>
		<?php
		//***********************************************
		//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS START
		//***********************************************
		// Make the links to other pages, if necessary.
		if ($pages > 1) :
			$current_page = ($start / $display) + 1;
		?>
			<nav aria-label="Page navigation">
				<ul class="pagination justify-content-center">
					<?php
					// If it's the first page, disable the previous button
					if ($current_page != 1) {
						echo '<li class="page-item"><a class="page-link" href="?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><span aria-hidden="true">&laquo;</span></a></li>';
					} else {
						echo '<li class="page-item disabled"><span class="page-link">&laquo;</span></li>';
					}
					// Make all the numbered pages:
					for ($i = 1; $i <= $pages; $i++) {
						if ($i != $current_page) {
							echo '<li class="page-item"><a class="page-link" href="?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a></li>';
						} else {
							echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
						}
					} // End of FOR loop.

					// If it's the last page, disable the next button
					if ($current_page != $pages) {
						echo '<li class="page-item"><a class="page-link" href="?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><span aria-hidden="true">&raquo;</span></a></li>';
					} else {
						echo '<li class="page-item disabled"><span class="page-link">&raquo;</span></li>';
					}
					?>

				</ul>
			</nav>
		<?php
		endif
		//***********************************************
		//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS END
		//***********************************************
		?>

	</div>
</main>
<?php
//***********************************************
//UTILITY FUNCTIONS
//***********************************************

// Function to get pagination and sorting query params when reconstructing urls
function page_location_params() {
	// Adapted from source: https://stackoverflow.com/questions/3454993/get-a-subset-of-an-array-based-on-an-array-of-keys
	$location_params = array('s', 'p', 'sort');
	$params_array = array_intersect_key($_GET, array_flip($location_params));
	$query_string = http_build_query($params_array);
	return $query_string;
}

// Reusable function to display notifications
function display_notification($alert_level, $message) {
	ob_start();
?>
	<div class='alert alert-<?php echo $alert_level ?>' role='alert'><?php echo $message ?></div>
<?php
	return ob_get_clean();
}
?>

<?php include('footer.php'); ?>