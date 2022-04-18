<?php
include('header.php');
include('mysqli_connect.php');
?>

<main>
	<div class="container">
		<form action="update.php" method="post">
			<?php
			$guestbook_id = '';
			$comment = '';

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$all_valid = true;
				// Populate variable values from POST data if it exists
				// Else, display error message

				if (isset($_POST['guestbook-id']) && $_POST['guestbook-id'] != '') {
					$guestbook_id = $_POST['guestbook-id'];
				} else {
					$all_valid = false;
					echo "<div class='alert alert-danger' role='alert'>";
					echo "Please a guestbook ID";
					echo "</div>";
				}

				if (isset($_POST['comment'])) {
					$comment = $_POST['comment'];
				} else {
					$all_valid = false;
					echo "<div class='alert alert-danger' role='alert'>";
					echo "Please enter a comment";
					echo "</div>";
				}

				if ($all_valid) {
					$query = "UPDATE guestbook SET comment = '$comment' WHERE guestbook_id = '$guestbook_id'";

					$results = mysqli_query($dbc, $query);

					if ($results) {
						echo '<div class="alert alert-success" role="alert">';
						echo 'SQL query ran successfully';
						echo '</div>';
					} else {
						echo "<div class='alert alert-danger' role='alert'>";
						echo "Error updating database: " . mysqli_error($dbc);
						echo "</div>";
					}
				}
			}
			?>
			<fieldset class="row gx-3 gy-3">
				<legend>Update Guestbook Entry</legend>
				<!-- Guestbook id field-->
				<div class="col-md-2">
					<label for="guestbook-id" class="form-label">Guestbook ID</label>
					<input type="text" name="guestbook-id" class="form-control" id="guestbook-id" value="<?php echo $guestbook_id ?>">
				</div>
				<!-- Comment box -->
				<div class="col-md-12">
					<label class="form-label" for="comment">Please enter an updated comment</label>
					<textarea class="form-control" id="comment" name="comment" rows="5"><?php echo $comment ?></textarea>
				</div>
				<div class="col-12">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</fieldset>


		</form>

</main>

<?php include('footer.php'); ?>