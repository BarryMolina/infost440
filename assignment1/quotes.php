<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css">
	<title>Quotes</title>
</head>

<body class="background-antiquewhite">
	<header>
		<h1>Assignment 1</h1>
		<h3>Barry Molina</h3>
	</header>
	<nav><a href="./index.php">&lt; Back</a></nav>
	<main>
		<h2>Quotes</h2>
		<!-- Quotes examples start -->
		<p>In PHP, both double quotes and single quotes can be used to store strings.</p>
		<p>Single quotes will interpret their contents literally:</p>
		<!-- Example code blocks -->
		<code class="block">
			$my_var = 'fun'; <br>
			echo 'PHP is $my_var';
		</code>
		<p>Output:
			<?php
			$my_var = 'fun';
			echo 'PHP is $my_var'
			?>
		</p>
		<p>Double quotes will resolve variables to the values they contain:</p>
		<code class="block">
			$my_var = 'fun'; <br>
			echo "PHP is $my_var";
		</code>
		<p>Output:
			<?php
			// PHP example of how double quotes can be used to interpret variables
			$my_var = 'fun';
			// This will output the string 'PHP is fun' 
			echo "PHP is $my_var";
			?>
		</p>
	</main>
	<figure>
		<img src="./images/quotes.png" alt="quotes.php source code screenshot" />
	</figure>
</body>

</html>