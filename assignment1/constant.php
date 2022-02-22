<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>Constant</title>
</head>

<body class="background-antiquewhite">
	<header>
		<h1>Assignment 1</h1>
		<h3>Barry Molina</h3>
	</header>
	<nav><a href="./index.php">&lt; Back</a></nav>
	<main>
		<h2>Constants</h2>
		<!-- Constants intro text -->
		<p>Constants are variables that cannot be changed once they are defined</p>
		<p>Unlike normal variables, constants are global in scope and don't use the dollar sign</p>
		<!-- Code example using the <pre> tag to preserve formatting -->
		<pre><code class="block">define('APPLES', 2056);
define('APPLE_PICKERS', 8);

echo 'There are ' . APPLES . ' apples and ' . APPLE_PICKERS . ' people to pick them.';
echo 'That\'s ' . APPLES / APPLE_PICKERS . ' apples per person.';</code></pre>
		<p>Output:</p>
		<!-- PHP code run on server -->
		<?php
		// Define two constants
		define('APPLES', 2056);
		define('APPLE_PICKERS', 8);
		// Echo out constants
		echo 'There are ' . APPLES . ' apples and ' . APPLE_PICKERS . ' people to pick them.';
		echo '<br>';
		// Calculate number of apples per apple picker
		echo 'That\'s ' . APPLES / APPLE_PICKERS . ' apples per person.';
		?>

	</main>
	<figure>
		<img src="./images/constant.png" alt="constant.php source code screenshot" />
	</figure>
</body>

</html>