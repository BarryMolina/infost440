<?php
//Create Session
// session_start();
//header
include('header.php');
include('functions.php');
include('mysqli_connect.php');

$BLOGPOST_BODY_MAX_LENGTH = 256;

// Array to hold validation errors and success banners
$notifications = array();

// The sort and pagination params needed to maintain page location while updating and deleting
$page_location = page_location_params();

//If a user name is entered display login mesage
if (isset($_SESSION['first_name'])) {
	echo "You currently logged in as {$_SESSION['first_name']}. Welcome to our website!";
}

//***********************************************
//DELETE LOGIC START
//***********************************************
if (isset($_GET['delete_id'])) {
	$delete_id = mysqli_real_escape_string($dbc, trim($_GET['delete_id']));
	$delete_query = "DELETE from blogposts WHERE blogpost_id = $delete_id";
	$delete_results = mysqli_query($dbc, $delete_query);
	if ($delete_results) {
		$notifications[] = array('alert-level' => 'danger', 'message' => 'Blogpost deleted');
	}
}
//***********************************************
//DELETE LOGIC END
//***********************************************

//***********************************************
//UPDATE LOGIC START
//***********************************************

if (isset($_GET['blogpost_updated']) && $_GET['blogpost_updated'] == 1) {
	$notifications[] = array('alert-level' => 'success', 'message' => 'Blog post successfully updated');
}

function get_update_modal($update_id, $update_title, $update_body, $errors = array()) {
	$page_location = page_location_params();
	ob_start(); ?>
	<!-- Update blogpost modal -->
	<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Blogpost</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="index.php?<?php echo $page_location ?>&update_id=<?php echo $update_id ?>" method="post">
					<div class="modal-body">
						<?php
						foreach ($errors as $error) {
							echo display_notification($error['alert-level'], $error['message']);
						}

						?>
						<div class="col-md-12 mb-3">
							<label for="blogpost-title" class="form-label">Title:</label>
							<input type="text" name="blogpost-title" class="form-control" id="blogpost-title" value="<?php echo $update_title ?>">
						</div>
						<div class="col-md-12">
							<label class="form-label" for="blogpost-body">Body:</label>
							<textarea class="form-control" id="blogpost-body" name="blogpost_body" rows="5"><?php echo $update_body ?></textarea>
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

// // Check if user selected to update a blogpost
// if (isset($_GET['update_id'])) {
// 	$update_id = mysqli_real_escape_string($dbc, trim($_GET['update_id']));

// 	// Check which stage of update process we are on
// 	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
// 		// Grab comment from blogpost
// 		$select_blogpost_query = "SELECT blogpost_body, blogpost_title from blogposts WHERE blogpost_id = $update_id";
// 		$select_blogpost_result = mysqli_query($dbc, $select_blogpost_query);
// 		if ($select_blogpost_result) {
// 			$update_blogpost = mysqli_fetch_array($select_blogpost_result, MYSQLI_ASSOC);
// 			echo get_update_modal($update_id, $update_blogpost['blogpost_title'], $update_blogpost['blogpost_body']);
// 		}
// 		// User has updated comment and clicked "save changes"
// 	} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 		if (isset($_POST['blogpost_body']) && $_POST['blogpost_body'] != '') {
// 			$update_blogpost = mysqli_real_escape_string($dbc, trim($_POST['blogpost_body']));
// 			$update_blogpost_query = "UPDATE blogposts SET blogpost_body = '$update_blogpost' WHERE blogpost_id = '$update_id'";
// 			$update_blogpost_result = mysqli_query($dbc, $update_blogpost_query);
// 			if ($update_blogpost_result) {
// 				$notifications[] = array('alert-level' => 'success', 'message' => 'Blogpost updated');
// 			}
// 		} else {
// 			echo get_update_modal($update_id, '', array(array('alert-level' => 'danger', 'message' => 'Please add a blogpost body')));
// 		}
// 	}
// }
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
	$q = "SELECT COUNT(blogpost_id) FROM blogposts";
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
		$order_by = 'first_name ASC';
		break;
	case 'fname_desc':
		$order_by = 'first_name DESC';
		break;
	case 'lname_asc':
		$order_by = 'last_name ASC';
		break;
	case 'lname_desc':
		$order_by = 'last_name DESC';
		break;
	case 'date_asc':
		$order_by = 'blogpost_timestamp ASC';
		break;
	case 'date_desc':
		$order_by = 'blogpost_timestamp DESC';
		break;
	default:
		$order_by = 'blogpost_timestamp DESC';
		$sort = 'date_desc';
		break;
}

//***********************************************
//SORTING SETUP END
//***********************************************

// Grab blogpost queries according to pagination location and sort criteria
$select_all_query = "
	SELECT blogpost_id, 
	CONCAT(first_name, ' ', last_name) as author, 
	blogpost_title, 
	LENGTH(blogpost_body) as body_length,
	SUBSTRING(blogpost_body, 1, $BLOGPOST_BODY_MAX_LENGTH) as blogpost_body, 
	DATE_FORMAT(blogpost_timestamp, '%r on %M %e, %Y') as last_updated 
	FROM blogposts 
	JOIN users 
	WHERE blogposts.user_id = users.user_id 
	ORDER BY $order_by 
	LIMIT $start, $display";
// $select_all_query = "SELECT * FROM blogposts ORDER BY $order_by LIMIT $start, $display";
// echo $select_all_query;
$select_all_results = mysqli_query($dbc, $select_all_query);
// while ($row = mysqli_fetch_array($select_all_results, MYSQLI_ASSOC)) {
// 	print_r($row);
// }
?>
<main>
	<div class="container" id="blogposts">
		<?php
		foreach ($notifications as $notification) {
			echo display_notification($notification['alert-level'], $notification['message']);
		}
		?>
		<!-- <div class="d-flex justify-content-between align-items-center"> -->
		<div class="row mb-3">
			<div class="col-sm-4 text-nowrap">
				<h1>Posts</h1>
			</div>
			<!-- Sorting nav pills  -->
			<div class="col-sm-8">
				<ul class="nav nav-pills justify-content-sm-end">
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
		</div>
		<?php
		// Generate blogposts
		if ($select_all_results) :
		?>
			<div class="blogposts">
				<?php
				while ($row = mysqli_fetch_array($select_all_results, MYSQLI_ASSOC)) :
					$id = $row['blogpost_id'];
					$author = $row['author'];
					$title = $row['blogpost_title'];
					$body = $row['blogpost_body'];
					$body_length = $row['body_length'];
					$date = $row['last_updated'];

				?>
					<!-- onclick event to redirect user to blogpost page -->
					<div class="card mb-3 blogpost" onclick="window.location='view_blogpost.php?blogpost_id=<?php echo $id ?>'">
						<div class="row g-0">
							<!-- <div class="col-md-4">
								<img src="..." class="img-fluid rounded-start" alt="...">
							</div> -->
							<div class="col-md-12">
								<div class="card-body">
									<h5 class="card-title"><?php echo $title ?></h5>
									<h6 class="card-title text-muted">By <?php echo $author ?></h6>
									<p class="card-text">
										<?php
										echo $body;
										// Add ellipsis if body is truncated
										if ($body_length > $BLOGPOST_BODY_MAX_LENGTH) {
											echo '&hellip;';
										}
										?>
									</p>
									<div class="d-flex justify-content-between align-items-center">
										<p class="card-text mb-0"><small class="text-muted">Last updated <?php echo $date ?></small></p>
										<div>
											<a class="btn btn-outline-primary" href="update_blogpost.php?update_id=<?php echo $id ?>">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
													<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
												</svg>
											</a>
											<a class="btn btn-outline-danger" href="index.php?<?php echo $page_location ?>&delete_id=<?php echo $id; ?>">
												<svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
													<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
												</svg>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				?>
			</div>
		<?php
		endif;
		?>
		<!-- <tr>
						<td class='text-nowrap'><?php //echo $name 
																		?></td>
						<td><?php //echo $comment 
								?></td>
						<td class='text-nowrap'><?php //echo $date 
																		?></td>
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
					</tr> -->
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
// footer
include('footer.php');
?>