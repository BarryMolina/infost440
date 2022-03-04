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
		<form class="row g-3">
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
			<div class="col-md-2">
				<select class="form-select form-select-sm" aria-label=".form-select-sm example">
					<option selected>Open this select menu</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-select form-select-sm" aria-label=".form-select-sm example">
					<option selected>Open this select menu</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-select form-select-sm" aria-label=".form-select-sm example">
					<option selected>Open this select menu</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</select>
			</div>
		</form>
	</div>


</body>

</html>