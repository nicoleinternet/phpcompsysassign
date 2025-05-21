<?php
/*
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : Manage.php
// Description: This is the settings page for the mysqli connection to the database.
 */
// Using MYSQLi (MySQL Improved Extension


/* Explicitly declaring host, user, password and database
so this can be changed by whoever for debugging. */
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "100589839_db";
//create a new mySQLi connection
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_errno) {
    die("Connect failed: ". $conn->connect_error);
}

?>