<?php //session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $page_title; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Custom styles -->
	<link href="./styles/styles.css" rel="stylesheet">
	<script src="./js/scripts.js"></script>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">Barry's Blog</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
						<li class="nav-item"><a class="nav-link" href="view_users.php">View Users</a></li>
						<li class="nav-item"><a class="nav-link" href="password.php">Change Password</a></li>
						<li class="nav-item">
						</li>
					</ul>
					<!-- <form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success" type="submit">Search</button>
					</form> -->
					<?php // Create a login/logout link:
					if ((isset($_SESSION['user_id'])) && (basename($_SERVER['PHP_SELF']) != 'logout.php')) {
						$user_first_name = $_SESSION['first_name'];
						echo "<span>Hello, $user_first_name! <a class='' href='logout.php'>Logout</a></span>";
					} else {
						echo '<a class="nav-link" href="login.php">Login</a>';
					}
					?>
				</div>
			</div>
		</nav>
	</header>