<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>
		<?php
		$title = 'Assignment 1: Conditions';
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
		<h2>Conditions</h2>
		<p>Conditons are how logic is expressed in PHP. They make use of logical operators
			to create expressions whose computed value determines whether or not a section of code is run.</p>
		<p>The simplest condition is a single <code>if</code> statement:</p>
		<!-- Formatted code example for simple if statment -->
		<pre><code class="block">$should_run_code = true;

if ($should_run_code) {
  echo 'Code is running.';
}</code></pre>
		<p>Output:</p>
		<!-- Server PHP code -->
		<?php
		// If statment example 1: simple if statement
		$should_run_code = true;
		// Code runs if $should_code_run evaluates to true
		if ($should_run_code) {
			echo 'Code is running.';
		}
		?>
		<p><code>if</code> statements can optionally include elseif and else clauses:</p>
		<!-- If, elseif, else example -->
		<pre><code class="block">$running_time = 8;

if ($running_time > 12) {
  echo 'You must be new.';
} elseif ($running_time > 9) {
  echo 'You\'re relatively in shape.';
} elseif ($running_time > 5) {
  echo 'I\'m impressed!';
} elseif ($running_time > 4) {
  echo 'You must be an elite marathon runner.';
} else {
  echo 'You\'re joking';
}</code></pre>
		<p>Output:</p>
		<?php
		// If statment example 2: if, elseif, else 
		// Initialize running time variable
		$running_time = 8;
		// Expanded if statement that includes elseif and else clauses
		if ($running_time > 12) {
			echo 'You must be new.';
		} elseif ($running_time > 9) {
			echo 'You\'re relatively in shape.';
		} elseif ($running_time > 5) {
			echo 'I\'m impressed!';
		} elseif ($running_time > 4) {
			echo 'You must be an elite marathon runner.';
		} else {
			// running time is less than 4 minutes
			echo 'You\'re joking.';
		}
		?>
		<p>Sometimes, many <code>elseif</code> clauses can be expressed more succinctly using the
			<code>switch</code> statement:
		</p>
		<!-- Formatted code example of switch statement -->
		<pre><code class="block">$door_choice = 3;

switch ($door_choice) {
  case 1:
    echo 'Wrong door.';
    break;
  case 2:
    echo 'Wrong door.';
    break;
  case 3:
    echo 'You found the goat!';
    break;
}
</code></pre>
		<p>Output:</p>
		<!-- PHP code for switch statment example -->
		<?php
		// Set door choice variable
		$door_choice = 3;
		// Evaluate door choice and take one of three routes depending on its value
		switch ($door_choice) {
			case 1:
				echo 'Wrong door.';
				break;
			case 2:
				echo 'Wrong door.';
				break;
			case 3:
				echo 'You found the goat!';
				break;
		}
		?>
	</main>
	<figure>
		<img src="./images/conditions.png" alt="conditions.php source code screenshot" />
	</figure>
	<figure>
		<img src="./images/conditions2.png" alt="conditions.php source code screenshot" />
	</figure>
</body>

</html>