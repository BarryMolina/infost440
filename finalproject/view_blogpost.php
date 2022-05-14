<?php
include('header.php');
include('functions.php');
include('mysqli_connect.php');

$errors = array();
$notifications = array();
$blogpost_found = false;

// // Blogpost default values;
// $id = '';
// $author = '';
// $title = '';
// $body = '';
// $date = '';


// Check if user selected to update a blogpost
if (isset($_GET['blogpost_id'])) {
	$blogpost_id = mysqli_real_escape_string($dbc, trim($_GET['blogpost_id']));
	// Check which stage of update process we are on

	// Query to gather blogpost data
	$select_blogpost_query = "
			SELECT blogpost_id, 
			CONCAT(first_name, ' ', last_name) as author, 
			blogpost_title, blogpost_body, 
			DATE_FORMAT(blogpost_timestamp, '%M %e, %Y') as last_updated 
			FROM blogposts 
			JOIN users 
			WHERE blogpost_id = $blogpost_id AND blogposts.user_id = users.user_id
		";
	// echo $select_blogpost_query;
	$select_blogpost_result = mysqli_query($dbc, $select_blogpost_query);

	// Check that the SQL query ran and that it returned a result
	if ($select_blogpost_result && ($blogpost = mysqli_fetch_array($select_blogpost_result, MYSQLI_ASSOC)) != null) {
		$blogpost_found = true;
		$id = $blogpost['blogpost_id'];
		$author = $blogpost['author'];
		$title = $blogpost['blogpost_title'];
		$body = $blogpost['blogpost_body'];
		$date = $blogpost['last_updated'];

		if (isset($_GET['blogpost_updated']) && $_GET['blogpost_updated'] == 1) {
			$notifications[] = array('alert-level' => 'success', 'message' => 'Blog post successfully updated');
		}

		// Gather all comments belonging to this blog post
		$select_comments_query = "
			SELECT comment_id, comment_body, 
			DATE_FORMAT(comment_timestamp, '%r on %M %e, %Y') as last_updated, 
			CONCAT(first_name, ' ', last_name) as author 
			FROM comments 
			JOIN users 
			WHERE comments.user_id = users.user_id AND blogpost_id = $blogpost_id
		";
		$select_comments_results = mysqli_query($dbc, $select_comments_query);
	}

	// if ($select_comments_result) {
	// 	$comments = mysqli_fetch_all($select_comments_result, MYSQLI_ASSOC);
	// 	print_r($comments);
	// }
}
?>
<main>
	<div class="container">
		<?php
		if ($blogpost_found) :
			foreach ($notifications as $notification) {
				echo display_notification($notification['alert-level'], $notification['message']);
			}
		?>
			<!-- <div class="mb-3 blogpost"> -->
			<!-- <div class="row g-0"> -->
			<!-- <div class="col-md-4">
								<img src="..." class="img-fluid rounded-start" alt="...">
							</div> -->
			<!-- <div class="col-md-12"> -->
			<!-- <div class="card-body"> -->
			<div class="mb-5">
				<div class="d-flex justify-content-between align-items-center">
					<h1 class=""><?php echo $title ?></h1>
					<div>
						<a class="btn btn-outline-primary" href="update.php?update_id=<?php echo $id ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
								<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
							</svg>
						</a>
						<a class="btn btn-outline-danger" href="index.php?delete_id=<?php echo $id; ?>">
							<svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
								<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
							</svg>
						</a>
					</div>
				</div>
				<h5 class="text-muted"><?php echo $author ?></h5>
				<p class=""><small class="text-muted">Updated <?php echo $date ?></small></p>
				<p class=""><?php echo $body ?></p>
			</div>
			<h4 class="text-muted mb-3">Comments</h4>
			<?php
			// Display comments
			if ($select_comments_results) :
			?>
				<div class="comments">
					<?php
					while ($row = mysqli_fetch_array($select_comments_results, MYSQLI_ASSOC)) :
						// print_r($row);
						$id = $row['comment_id'];
						$author = $row['author'];
						$body = $row['comment_body'];
						$date = $row['last_updated'];

					?>
						<div class="card mb-3 comment">
							<div class="row g-0">
								<div class="col-md-12">
									<div class="card-body">
										<h5 class="card-title"><?php echo $author ?></h5>
										<!-- <h6 class="card-title text-muted">By <?php echo $author ?></h6> -->
										<p class="card-text"> <?php echo $body; ?> </p>
										<div class="d-flex justify-content-between align-items-center">
											<p class="card-text mb-0"><small class="text-muted">Last updated <?php echo $date ?></small></p>
											<div>
												<a class="btn btn-outline-primary" href="update.php?update_id=<?php echo $id ?>">
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
			<!-- </div> -->
			<!-- </div>
				</div>
			</div>
		</div> -->
		<?php else : ?>
			<p>No blogpost found</p>
		<?php endif; ?>
	</div>
</main>

<?php
// footer
include('footer.php');
?>