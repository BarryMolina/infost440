<?php
//This sets the constants with our connection information
DEFINE ('DB_HOST', 'localhost'); //Database server -- Typically "localhost"
DEFINE ('DB_USER', 'bhmolina_assign4user'); //Database User Name
DEFINE ('DB_PASSWORD', 'b6d6rg+)!-$r'); //Database User Password
DEFINE ('DB_NAME', 'bhmolina_440assign4'); //Database Name

//This connects us to the database
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL server with error: ' . mysqli_connect_error());
