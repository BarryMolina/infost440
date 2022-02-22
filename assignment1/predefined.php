<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>Predefined</title>
</head>

<body class="background-antiquewhite">
	<header>
		<h1>Assignment 1</h1>
		<h3>Barry Molina</h3>
	</header>
	<nav><a href="./index.php">&lt; Back</a></nav>
	<main>
		<h2>Predefined</h2>
		<p>Predefined variables contain information about the server's operating environment.</p>
		<p>They can be accessed by typing <code>$_SERVER</code> followed by the variable name:</p>
		<!-- use the <pre> tag to preserve whitespace and formatting -->
		<pre><code class="block">$server_addr = $_SERVER['SERVER_ADDR'];
$server_name = $_SERVER['SERVER_NAME'];
$remote_addr = $_SERVER['REMOTE_ADDR'];

echo "The server's host name is $server_name";
echo "The server's IP address is $server_addr";
echo "Your IP address is $remote_addr";</code></pre>
		<p>Output:</p>
		<?php
		// Store values in new variables
		$server_addr = $_SERVER['SERVER_ADDR'];
		$server_name = $_SERVER['SERVER_NAME'];
		$remote_addr = $_SERVER['REMOTE_ADDR'];
		// Output server variables. The new variables allow double quotes to be used.
		echo "The server's host name is $server_name";
		echo '<br>';
		echo "The server's IP address is $server_addr";
		echo '<br>';
		echo "Your IP address is $remote_addr";
		?>
	</main>
	<figure>
		<img src="./images/predefined.png" alt="predefined.php source code screenshot" />
	</figure>
</body>

</html>