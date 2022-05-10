<?php # Script 9.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database, and sets the encoding.

// Set the database access information as constants:
DEFINE('DB_USER', '440finalproject');
DEFINE('DB_PASSWORD', '7QZMO9Tx829kwazq');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'infost440-finalproject');

// Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');
