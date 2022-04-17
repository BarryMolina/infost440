<?php include('header.php'); ?>
<main>
	<div class="container">
		<form action="comment.php" method="post">
			<?php
			$first_name = "";
			$last_name = "";
			$email = "";
			$comment = "";
			?>
			<fieldset class="row gx-2 gy-2">
				<legend>New Guestbook Entry</legend>
				<!-- First name, last name, and email inputs -->
				<div class="col-md-6">
					<label for="first-name" class="form-label">First Name</label>
					<input type="text" name="first-name" class="form-control" id="first-name" value="<?php echo $first_name ?>">
				</div>
				<div class="col-md-6">
					<label for="last-name" class="form-label">Last Name</label>
					<input type="text" name="last-name" class="form-control" id="last-name" value="<?php echo $last_name ?>">
				</div>
				<div class="col-md-6">
					<label for="email" class="form-label">Email</label>
					<input type="text" name="email" class="form-control" id="email" value="<?php echo $email ?>">
				</div>
				<!-- Comment box -->
				<div class="col-md-12">
					<label class="form-label" for="comment">What would you like to say?</label>
					<textarea class="form-control" id="comment" name="comment" rows="5"><?php echo $comment ?></textarea>
				</div>
			</fieldset>

		</form>

</main>

<?php include('footer.php'); ?>