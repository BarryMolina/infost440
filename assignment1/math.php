<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>
		<?php
		$title = 'Assignment 1: Math';
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
		<h2>Math</h2>
		<p>PHP can be used to perform common math operations.</p>
		<!-- PHP math examples for addition, subtraction, multiplication, division, and modulo -->
		<p>Addition uses the <code>+</code> operator</p>
		<code class="block">echo 5 + 6;</code>
		<p>Output:
			<?php
			// Addition example
			echo 5 + 6;
			?>
		</p>
		<p>Subtraction uses the <code>-</code> operator</p>
		<code class="block">echo 76 - 6;</code>
		<p>Output:
			<?php
			// Subtraction example
			echo 76 - 6;
			?>
		</p>
		<p>Multiplication uses the <code>*</code> operator</p>
		<code class="block">echo 7 * 8;</code>
		<p>Output:
			<?php
			// Multiplication example
			echo 7 * 8;
			?>
		</p>
		<p>Division uses the <code>/</code> operator</p>
		<code class="block">echo 25 / 5;</code>
		<p>Output:
			<?php
			// Division example
			echo 25 / 5;
			?>
		</p>
		<p>The modulo operator <code>%</code> finds the integer division remainder</p>
		<code class="block">echo 17 % 3;</code>
		<p>Output:
			<?php
			// Modulo example
			echo 17 % 3;
			?>
		</p>
	</main>
	<figure>
		<img src="./images/math.png" alt="math.php source code screenshot" />
	</figure>
</body>

</html>