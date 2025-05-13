<?php
// Using MYSQLi (MySQL Improved Extension
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole

/* Explicitly declaring host, user, password and database
so this can be changed by whoever for debugging. */
//defines feenix mariadb
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "100589839_db";
//create a new mySQLi connection
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
} else {printf("Connected successfully\n");}

?>