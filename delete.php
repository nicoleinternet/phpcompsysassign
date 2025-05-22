<!--
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
// Simple delete.php that gets the paramters in a GET ?id='x' to delete a user.
-->
<!DOCTYPE html>
<html lang='en'>
<?php
include 'settings.php';
include "menu.inc.php";
draw_headerhtml("Delete User");
?>
<body>

<?php
// Get id parameter value from URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];


    $sql = "DELETE FROM eoi WHERE eoi_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
          header('location: manage.php');
        } else {
            echo "<p>Error deleting record: " . mysqli_error($conn) . "</p>";
            sleep(2);
            header('location: manage.php');
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Error excuting SQL: " . mysqli_error($conn) . "</p>";
        sleep(2);
        header('location: manage.php');
    }
} else {
    echo "<p>Invalid or missing ID parameter</p>";
    sleep(2);
    header('location: manage.php?action=delete&id=$id');
}

// Close database connection
mysqli_close($conn);


// // Delete row from the database table
// $sql = "DELETE FROM eoi WHERE eoi_id = $id";


?>

<main>
  <?php
//   if (mysqli_query($conn, $sql)) {
//   echo "New record created successfully";
//   sleep(2);
//   header("location: manage.php");
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }
  ?>
</main>
<?php draw_footerhtml(); ?>
</body>
</html>