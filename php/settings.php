<?php
// Using MYSQLi (MySQL Improved Extension
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole

/* Explicitly declaring host, user, password and database
so this can be changed by whoever for debugging. */
//defines feenix mariadb
$host = "feenix-mariadb.swin.edu.au";
$user = "s100589839";
$password = "Pa55w.rd";
$database = "s100589839_db";
//create a new mySQLi connection
$mysqli = new mysqli($host, $user, $password, $database);
?>