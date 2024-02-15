<?php # Script 9.2 - mysqli_connect.php

// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.

// Set the database access information as constants:
Define('DB_USER', 'Eddie');
Define('DB_PASSWORD', '');
Define('DB_HOST', 'localhost');
Define('DB_NAME', 'emusic');
// Make the connection:
$dbcon = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Could not connect to database");
mysqli_set_charset($dbcon, 'utf8'); // Set the encoding...
