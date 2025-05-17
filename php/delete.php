
<?php
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
// Simple delete.php that gets the paramters in a GET ?id='x' to delete a user.
include "settings.php";

// Get id parameter value from URL
$id = $_GET['id'];

// Delete row from the database table
$result = mysqli_query($mysqli, "DELETE FROM eoi WHERE id = $id");

// Redirect to the main display page (index.php in our case)
header("location:manage.php");
?>