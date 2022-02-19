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
	<main>
		<h2>Escape</h2>
		<p>In PHP strings, the backslash is used to escape characters that would otherwise have special meaning.</p>
		<p>For example, adding an apostrophe in a single-quoted string prematurely ends the string and confuses PHP.</p>
		<code>echo 'This is Barry'<span class="color-red">s single quoted string</span>';</code>
		<p>Instead, insert a backslash to escape it.</p>
		<code>echo 'This is Barry/'s single quoted string';</code>
		<p>Result:</p>
		<?php echo 'This is Barry\'s single quoted string'; ?>
	</main>
	<img src="./images/escape.png" alt="escape.php source code screenshot" />
</body>

</html>