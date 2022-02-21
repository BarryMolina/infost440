<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>Conditions</title>
</head>

<body class="background-antiquewhite">
	<header>
		<h1>Assignment 1</h1>
		<h3>Barry Molina</h3>
	</header>
	<nav><a href="./index.php">&lt; Back</a></nav>
	<main>
		<h2>Conditions</h2>
		<p>Conditons are how logic is expressed in PHP. They make use of logical operators to create expressions whose computed value determines whether or not a section of code is run.</p>
		<p>The simplest condition is a single <code>if</code> statement:</p>
		<pre><code class="block">$should_run_code = true;

if ($should_run_code) {
  echo 'Code is running.';
}</code></pre>
		<p>Output:</p>
		<?php
		$should_run_code = true;
		if ($should_run_code) {
			echo 'Code is running.';
		}
		?>
		<p><code>if</code> statements can optionally include elseif and else clauses.</p>
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
		$running_time = 8;
		if ($running_time > 12) {
			echo 'You must be new.';
		} elseif ($running_time > 9) {
			echo 'You\'re relatively in shape.';
		} elseif ($running_time > 5) {
			echo 'I\'m impressed!';
		} elseif ($running_time > 4) {
			echo 'You must be an elite marathon runner.';
		} else {
			echo 'You\'re joking.';
		}
		?>
		<p>Sometimes, many <code>elseif</code> clauses can be expressed more sucinctly using the <code>switch</code> statement</p>
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
		<?php
		$door_choice = 3;
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
	<!-- <figure>
		<img src="./images/conditions.png" alt="conditions.php source code screenshot" />
	</figure> -->
</body>

</html>