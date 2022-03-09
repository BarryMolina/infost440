<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Assignment 2</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="./styles/styles.css" rel="stylesheet">
</head>

<body>
	<main>
		<div class="container">
			<form action="index.php" method="POST">
				<?php
				$fields = array(
					'first-name' => array('value' => '', 'friendly-name' => 'first name'),
					'last-name' => array('value' => '', 'friendly-name' => 'last name'),
					'address' => array('value' => '', 'friendly-name' => 'address'),
					'sex' => array('value' => '', 'friendly-name' => 'sex'),
					'dob-day' => array('value' => 'Day', 'friendly-name' => 'birthday day'),
					'dob-month' => array('value' => 'Month', 'friendly-name' => 'birthday month'),
					'dob-year' => array('value' => 'Year', 'friendly-name' => 'birthday year'),
					'height' => array('value' => '', 'friendly-name' => 'height'),
					'weight' => array('value' => '', 'friendly-name' => 'weight'),
					'eye-color' => array('value' => '', 'friendly-name' => 'eye color'),
					'hair-color' => array('value' => '', 'friendly-name' => 'hair color'),
					'donor' => array('value' => '', 'friendly-name' => 'donor preference'),
					'instructions' => array('value' => '', 'friendly-name' => 'processing instructions'),
				);

				$class_fields = array(
					'class-A' => array('checked' => false, 'value' => 'A'),
					'class-B' => array('checked' => false, 'value' => 'B'),
					'class-C' => array('checked' => false, 'value' => 'C'),
					'class-D' => array('checked' => false, 'value' => 'D'),
					'class-M' => array('checked' => false, 'value' => 'M'),

				);

				$all_valid = false;

				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$all_valid = true;

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

					// Initialize license class fields. Ensure at least one class is selected
					$at_least_one = false;

					foreach ($class_fields as $field => $attrs) {
						if (isset($_POST[$field])) {
							$class_fields[$field]['checked'] = true;
							$at_least_one = true;
						}
					}
					if (!$at_least_one) {
						$all_valid = false;
						echo "<div class='alert alert-danger' role='alert'>";
						echo "You must select at least one license class";
						echo "</div>";
					}

					// Check if user filled out the captcha
					$captcha_input = (isset($_POST['captcha-challenge']) ? $_POST['captcha-challenge'] : '');
					if ($captcha_input) {
						// Check if captcha is correct
						if ($_POST['captcha-challenge'] != $_SESSION['captcha-text']) {
							$all_valid = false;
							echo "<div class='alert alert-danger' role='alert'>";
							echo "CAPTCHA text is incorrect";
							echo "</div>";
						}
					} else {
						$all_valid = false;
						echo "<div class='alert alert-danger' role='alert'>";
						echo "You must fill out the CAPTCHA";
						echo "</div>";
					}

					if ($all_valid) {
						echo '<div class="alert alert-success" role="alert">';
						echo 'Application submitted successfully';
						echo '</div>';
					}
				}

				// Initialize variables with values to be used in form
				$first_name = $fields['first-name']['value'];
				$last_name = $fields['last-name']['value'];
				$address = $fields['address']['value'];
				$sex = $fields['sex']['value'];
				$dob_day = $fields['dob-day']['value'];
				$dob_month = $fields['dob-month']['value'];
				$dob_year = $fields['dob-year']['value'];
				$height = $fields['height']['value'];
				$weight = $fields['weight']['value'];
				$eye_color = $fields['eye-color']['value'];
				$hair_color = $fields['hair-color']['value'];
				$donor = $fields['donor']['value'];
				$instructions = $fields['instructions']['value'];

				// License classes will have value of true or false
				$class_A = $class_fields['class-A']['checked'];
				$class_B = $class_fields['class-B']['checked'];
				$class_C = $class_fields['class-C']['checked'];
				$class_D = $class_fields['class-D']['checked'];
				$class_M = $class_fields['class-M']['checked'];

				// Arrays for DOB
				$days_array = array_merge(array('Day'), range(1, 31));
				$months_array = array('Month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				$years_array = array_merge(array('Year'), range(2022, 1900, -1));

				// Generate the captcha text
				$captcha_string = include 'captchatext.php';
				// Store in session
				$_SESSION['captcha-text'] = $captcha_string;

				?>
				<!-- First name, last name, address -->
				<fieldset class="row gx-3 gy-4">
					<legend>Driver License Application Form</legend>
					<div class="col-md-6">
						<label for="first-name" class="form-label">First Name</label>
						<input type="text" name="first-name" class="form-control" id="first-name" value="<?php echo $first_name ?>">
					</div>
					<div class="col-md-6">
						<label for="last-name" class="form-label">Last Name</label>
						<input type="text" name="last-name" class="form-control" id="last-name" value="<?php echo $last_name ?>">
					</div>
					<div class="col-md-12">
						<label for="address" class="form-label">Address</label>
						<input type="text" name="address" class="form-control" id="address" value="<?php echo $address ?>">
					</div>
					<!-- Demographics -->
					<div class="col-md-1">
						Sex:
					</div>
					<div class="col-md-5">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sex" id="sex-male" value="M" <?php echo ($sex == 'M' ? 'checked' : '') ?>>
							<label class="form-check-label" for="sex-male">Male</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sex" id="sex-female" value="F" <?php echo ($sex == 'F' ? 'checked' : '') ?>>
							<label class="form-check-label" for="sex-female">Female</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sex" id="sex-other" value="Other" <?php echo ($sex == 'Other' ? 'checked' : '') ?>>
							<label class="form-check-label" for="sex-other">Other</label>
						</div>
					</div>
					<!-- Date dropdowns -->
					<div class="col-md-1">
						DOB:
					</div>
					<div class="col-md-5">
						<div class="row gx-1">
							<div class="col">
								<select class="form-select form-select-sm" name="dob-day">
									<?php
									foreach ($days_array as $day) {
										$selected = $dob_day == $day ? 'selected' : '';
										echo "<option value='$day' $selected>$day</option>";
									}
									?>
								</select>
							</div>
							<div class="col">
								<select class="form-select form-select-sm" name="dob-month">
									<?php
									foreach ($months_array as $month) {
										$selected = $dob_month == $month ? 'selected' : '';
										echo "<option value='$month' $selected>$month</option>";
									}
									?>
								</select>
							</div>
							<div class="col">
								<select class="form-select form-select-sm" name="dob-year">
									<?php
									foreach ($years_array as $year) {
										$selected = $dob_year == $year ? 'selected' : '';
										echo "<option value='$year' $selected>$year</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<!-- Physical appearance -->
					<div class="col-md-3">
						<label for="height" class="form-label col">Height</label>
						<input type="text" name="height" class="form-control col" id="height" value="<?php echo $height ?>">
					</div>
					<div class="col-md-3">
						<label for="weight" class="form-label">Weight</label>
						<input type="text" name="weight" class="form-control" id="weight" value="<?php echo $weight ?>">
					</div>
					<div class="col-md-3">
						<label for="eye-color" class="form-label">Eye Color</label>
						<input type="text" name="eye-color" class="form-control" id="eye-color" value="<?php echo $eye_color ?>">
					</div>
					<div class="col-md-3">
						<label for="hair-color" class="form-label">Hair Color</label>
						<input type="text" name="hair-color" class="form-control" id="hair-color" value="<?php echo $hair_color ?>">
					</div>
					<!-- Checkboxes for license class -->
					<div class="col-md-1">
						Class:
					</div>
					<div class="col-md-5">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="class-A" id="class-A" <?php echo ($class_A ? 'checked' : '') ?>>
							<label class="form-check-label" for="class-A">A</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="class-B" id="class-B" <?php echo ($class_B ? 'checked' : '') ?>>
							<label class="form-check-label" for="class-B">B</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="class-C" id="class-C" <?php echo ($class_C ? 'checked' : '') ?>>
							<label class="form-check-label" for="class-C">C</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="class-D" id="class-D" <?php echo ($class_D ? 'checked' : '') ?>>
							<label class="form-check-label" for="class-D">D</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="class-M" id="class-M" <?php echo ($class_M ? 'checked' : '') ?>>
							<label class="form-check-label" for="class-M">M</label>
						</div>
					</div>
					<!-- Donor radiobuttons -->
					<div class="col-md-1">
						Donor:
					</div>
					<div class="col-md-5">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="donor" id="donor-yes" value="yes" <?php echo ($donor == 'yes' ? 'checked' : '') ?>>
							<label class="form-check-label" for="donor-yes">Yes</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="donor" id="donor-no" value="no" <?php echo ($donor == 'no' ? 'checked' : '') ?>>
							<label class="form-check-label" for="donor-no">No</label>
						</div>
					</div>
					<!-- Comment box -->
					<div class="col-md-12">
						<label class="form-label" for="instructions">Processing Instructions</label>
						<textarea class="form-control" id="instructions" name="instructions" rows="5"><?php echo $instructions ?></textarea>
					</div>
					<div class="col-4">
						<!-- CAPTCHA -->
						<!-- Create captcha image using generated string and display it -->
						<label class="form-label" for="captcha">Please Enter the Captcha Text</label>
						<img src="<?php echo "captcha.php?text=$captcha_string" ?>" alt=" CAPTCHA" class="captcha-image">
						<input type="text" class="form-control mt-3" id="captcha" name="captcha-challenge" autocomplete="off">
						<!-- Submit button -->
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-outline-light">Submit</button>
					</div>
				</fieldset>
			</form>
			<?php
			if ($all_valid) {
			}
			// Create one-dimensional array containing only license class values. 
			// etc. ['A', 'B', 'C',]
			$classes = array_reduce($class_fields, function ($selected, $license_class) {
				if ($license_class['checked']) {
					$selected[] = $license_class['value'];
				}
				return $selected;
			}, array());
			// Join classes array into string
			$class_str = implode(' ', $classes);

			// Get month number
			$month_num = array_search($dob_month, $months_array);
			// Create DOB string from dropdown values
			$dob = "$month_num/$dob_day/$dob_year";

			// Get today's date
			$issued = date("n/j/Y");
			?>
			<!-- Show temp license only if all fields are filled out -->
			<div class="<?php echo ($all_valid ? '' : 'd-none') ?>">
				<div class="row">
					<div class="col-12 py-4">
						Success! Here is your new driver's license:
					</div>
				</div>
				<div class="temp-license border shadow row gx-4 gy-3 px-2 pb-3 mx-auto my-4">
					<h3 class="col-12">
						Driver License
					</h3>
					<div class="col-4">
						<img src="./images/default-head.jpeg" class="img-fluid">

					</div>
					<div class="col-8">
						<div class="row">
							<div class="col-6"> <?php echo $last_name ?></div>
							<div class="col-6"><small>class</small> <?php echo $class_str ?></div>
							<div class="col-12"> <?php echo $first_name ?></div>
							<div class="col-12 mt-3 mb-4"><?php echo $address ?></div>
							<div class="col-2"><small>sex</small></div>
							<div class="col-4"><?php echo $sex ?></div>
							<div class="col-2"><small>height</small></div>
							<div class="col-4"><?php echo $height ?></div>
							<div class="col-2"><small>weight</small></div>
							<div class="col-4"><?php echo $weight ?></div>
							<div class="col-2"><small>eyes</small></div>
							<div class="col-4"><?php echo $eye_color ?></div>
							<div class="col-2"><small>hair</small></div>
							<div class="col-4"><?php echo $hair_color ?></div>
							<div class="col-2"><small>donor</small></div>
							<div class="col-4"><?php echo $donor ?></div>
							<div class="col-2"><small>DOB</small></div>
							<div class="col-4"><?php echo $dob ?></div>
							<div class="col-2"><small>issued</small></div>
							<div class="col-4"><?php echo $issued ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>

</html>