<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Assignment 2</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
	<div class="container-sm">
		<form class="row gx-3 gy-4">
			<div class="col-md-6">
				<label for="first-name" class="form-label">First Name</label>
				<input type="text" name="first-name" class="form-control" id="first-name">
			</div>
			<div class="col-md-6">
				<label for="last-name" class="form-label">Last Name</label>
				<input type="text" name="last-name" class="form-control" id="last-name">
			</div>
			<div class="col-md-12">
				<label for="address" class="form-label">Address</label>
				<input type="text" name="address" class="form-control" id="address">
			</div>
			<div class="col-md-1">
				Sex:
			</div>
			<div class="col-md-5">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="sex" id="sex-male" value="option1">
					<label class="form-check-label" for="sex-male">Male</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="sex" id="sex-female" value="option2">
					<label class="form-check-label" for="sex-female">Female</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="sex" id="sex-other" value="option2">
					<label class="form-check-label" for="sex-other">Other</label>
				</div>
			</div>
			<div class="col-md-1">
				DOB:
			</div>
			<div class="col-md-5">
				<div class="row gx-1">
					<div class="col">
						<select class="form-select form-select-sm" aria-label=".form-select-sm example">
							<option selected>Day</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
					<div class="col">
						<select class="form-select form-select-sm" aria-label=".form-select-sm example">
							<option selected>Month</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
					<div class="col">
						<select class="form-select form-select-sm" aria-label=".form-select-sm example">
							<option selected>Year</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<label for="height" class="form-label col">Height</label>
				<input type="text" name="height" class="form-control col" id="height">
			</div>
			<div class="col-md-3">
				<label for="weight" class="form-label">Weight</label>
				<input type="text" name="weight" class="form-control" id="weight">
			</div>
			<div class="col-md-3">
				<label for="eye-color" class="form-label">Eye Color</label>
				<input type="text" name="eye-color" class="form-control" id="eye-color">
			</div>
			<div class="col-md-3">
				<label for="hair-color" class="form-label">Hair Color</label>
				<input type="text" name="hair-color" class="form-control" id="hair-color">
			</div>
			<div class="col-md-1">
				Class:
			</div>
			<div class="col-md-5">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="class-A" id="class-A" value="option1">
					<label class="form-check-label" for="class-A">A</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="class-B" id="class-B" value="option1">
					<label class="form-check-label" for="class-B">B</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="class-C" id="class-C" value="option1">
					<label class="form-check-label" for="class-C">C</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="class-D" id="class-D" value="option1">
					<label class="form-check-label" for="class-D">D</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="class-M" id="class-M" value="option1">
					<label class="form-check-label" for="class-M">M</label>
				</div>
			</div>
			<div class="col-md-1">
				Donor:
			</div>
			<div class="col-md-5">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="donor" id="donor-yes" value="yes">
					<label class="form-check-label" for="donor-yes">Yes</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="donor" id="donor-no" value="no">
					<label class="form-check-label" for="donor-no">No</label>
				</div>
			</div>
			<div class="col-md-12">
				<label class="form-label" for="instructions">Processing Instructions</label>
				<textarea class="form-control" id="instructions" name="instructions" rows="5">Make it fast!</textarea>
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Submit</button>

			</div>
		</form>
	</div>


</body>

</html>