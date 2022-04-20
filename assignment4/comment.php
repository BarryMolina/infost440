<?php
include('header.php');
include('mysqli_connect.php');
?>
<main>
	<div class="container">
		<form action="comment.php" method="post">
			<?php
			$fields = array(
				'first-name' => array('value' => '', 'friendly-name' => 'first name'),
				'last-name' => array('value' => '', 'friendly-name' => 'last name'),
				'comment' => array('value' => '', 'friendly-name' => 'comment')
			);

			$all_valid = true;
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Populate variable values from POST data if it exists
				// Else, display error message
				foreach ($fields as $field => $attrs) {
					// Check that the field is set and is different from the default value
					if (isset($_POST[$field]) && $_POST[$field] != $attrs['value']) {
						$fields[$field]['value'] = $_POST[$field];
					} else {
						$all_valid = false;
						echo "<div class='alert alert-danger' role='alert'>";
						echo "Please enter your " . $attrs['friendly-name'];
						echo "</div>";
					}
				}

				if ($all_valid) {
					$first_name = $fields['first-name']['value'];
					$last_name = $fields['last-name']['value'];
					$comment = $fields['comment']['value'];
					$query = "INSERT INTO guestbook (fname, lname, comment) VALUES ('$first_name', '$last_name', '$comment')";

					$results = mysqli_query($dbc, $query);

					if ($results) {
						echo '<div class="alert alert-success" role="alert">';
						echo 'SQL query ran successfully';
						echo '</div>';
					} else {
						echo "<div class='alert alert-danger' role='alert'>";
						echo "Error inserting into database: " . mysqli_error($dbc);
						echo "</div>";
					}
				}
			}
			// Reset fields if SQL was submitted (or form wasn't submitted). Otherwise use previous values
			if ($all_valid) {
				$first_name = '';
				$last_name = '';
				$comment = '';
			} else {
				$first_name = $fields['first-name']['value'];
				$last_name = $fields['last-name']['value'];
				$comment = $fields['comment']['value'];
			}
			?>
			<fieldset class="row gx-3 gy-3">
				<legend>New Guestbook Entry</legend>
				<!-- First name, last name inputs -->
				<div class="col-md-6">
					<label for="first-name" class="form-label">First Name</label>
					<input type="text" name="first-name" class="form-control" id="first-name" value="<?php echo $first_name ?>">
				</div>
				<div class="col-md-6">
					<label for="last-name" class="form-label">Last Name</label>
					<input type="text" name="last-name" class="form-control" id="last-name" value="<?php echo $last_name ?>">
				</div>
				<!-- Comment box -->
				<div class="col-md-12">
					<label class="form-label" for="comment">What would you like to say?</label>
					<textarea class="form-control" id="comment" name="comment" rows="5"><?php echo $comment ?></textarea>
				</div>
				<div class="col-12">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</fieldset>


		</form>

</main>

<?php include('footer.php'); ?>