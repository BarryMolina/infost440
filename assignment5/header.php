<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Styles for Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Special+Elite&display=swap" rel="stylesheet">

	<!-- Custom styles -->
	<link href="./styles/styles.css" rel="stylesheet">

	<title>Barry's Bed & Breakfast Guestbook</title>
</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">Barry's Bed & Breakfast</a>
			<!-- Dropdown menu for small screen sizes -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav me-auto mb-2 mb-sm-0">
					<!-- Check if the link leads to the current active page. If it does, style link accordingly -->
					<?php $page = basename($_SERVER['REQUEST_URI']); ?>
					<li class="nav-item">
						<a class="nav-link <?php echo $page == 'index.php' || $page == 'assignment4' ? 'active' : ''; ?>" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo $page == 'comment.php' ? 'active' : ''; ?>" href="comment.php">Create</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>