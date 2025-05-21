<!--
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
// Simple delete.php that gets the paramters in a GET ?id='x' to delete a user.
-->
<!DOCTYPE html>
<html lang='en'>
<?php
include "menu.inc.php";
draw_headerhtml("Delete User");
?>
<body>

<main>
<?php



// Get id parameter value from URL
$id = $_GET['id'];
// Delete row from the database table
$sql = "DELETE FROM eoi WHERE eoi_id = $id";
// DONT EXECUTE HERE JUST YET, NEED TO ADD BUTTON
if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}
// Redirect to the main display page (index.php in our case)
header("location: manage.php");
?>
</main>
<?php draw_footerhtml(); ?>
</body>
</html>