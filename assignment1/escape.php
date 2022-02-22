<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>Escape</title>
</head>

<body class="background-antiquewhite">
	<header>
		<h1>Assignment 1</h1>
		<h3>Barry Molina</h3>
	</header>
	<!-- Navigate back to the index page -->
	<nav><a href="./index.php">&lt; Back</a></nav>
	<main>
		<h2>Escape</h2>
		<!-- Escape intro -->
		<p>In PHP strings, the backslash is used to escape characters that would otherwise have special meaning.</p>
		<p>For example, adding an apostrophe in a single-quoted string prematurely ends the string and confuses PHP:</p>
		<!-- PHP escaping code examples -->
		<code class="block">echo 'This is Barry'<span class="color-red">s single quoted string</span>';</code>
		<p>Instead, insert a backslash to escape it:</p>
		<code class="block">echo 'This is Barry/'s single quoted string';</code>
		<p>Result:</p>
		<!-- Actual PHP code run on server -->
		<?php
		// This is run on the server
		echo 'This is Barry\'s single quoted string';
		?>
	</main>
	<figure>
		<!-- Code screenshot -->
		<img src="./images/escape.png" alt="escape.php source code screenshot" />
	</figure>
</body>

</html>