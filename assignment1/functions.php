<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>
		<?php
		$title = 'Assignment 1: Functions';
		echo $title;
		?>
	</title>
</head>

<body class="background-antiquewhite">
	<header>
		<h1>Assignment 1</h1>
		<h3>Barry Molina</h3>
	</header>
	<nav><a href="./index.php">&lt; Back</a></nav>
	<main>
		<!-- Functions intro -->
		<h2>Functions</h2>
		<p>Functions are reusable chunks of code that can take input and produce output.</p>
		<p>They allow you to tackle complex problems using functional decomposition.</p>
		<p>PHP has many built-in functions. For example, <code>str_repeat()</code>repeats a string a certain number of times.</p>
		<!-- Code example of using a built-in function -->
		<pre><code class="block">$laugh = 'ha';
$funny = str_repeat($laugh, 2);
$very_funny = str_repeat($laugh, 3);
$hilarious = str_repeat($laugh, 10);

echo "$funny that's funny.";
echo "$very_funny that's very funny.";
echo "$hilarious that's hilarious!";</code></pre>
		<p>Output:</p>
		<!-- PHP code for built-in function example -->
		<?php
		// Initialize base string
		$laugh = 'ha';
		// Use built-in function str_repeat to repeat base string
		$funny = str_repeat($laugh, 2);
		$very_funny = str_repeat($laugh, 3);
		$hilarious = str_repeat($laugh, 10);
		// Display results
		echo "$funny that's funny.";
		echo "<br>";
		echo "$very_funny that's very funny.";
		echo "<br>";
		echo "$hilarious that's hilarious!";
		?>
		<p>You can also create your own functions</p>
		<!-- Code example for user-defined function -->
		<pre><code class="block">function make_me_laugh() {
  echo 'What do you call a boomerang that won\'t come back?';
  echo 'A stick.';
}

make_me_laugh();</code></pre>
		<p>Output:</p>
		<!-- PHP code for user-defined function -->
		<?php
		// Define function make_me_laugh that tells a joke
		function make_me_laugh() {
			echo 'What do you call a boomerang that won\'t come back?';
			echo '<br><br>';
			echo 'A stick.';
		}
		// Demonstration of user-defined function
		make_me_laugh();
		?>
	</main>
	<figure>
		<img src="./images/functions.png" alt="functions.php source code screenshot" />
	</figure>
</body>

</html>