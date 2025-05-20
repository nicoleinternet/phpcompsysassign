!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="CLAM Careers - Your Gateway to the Future of IT">
    <meta name="keywords" content="IT Careers, Cyber Security, CLAM, Web, Australia, Future Tech">
    <meta name="author" content="Arvin Zia">
    <title>CLAM Careers - Login</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>

<header>
    <a href="index.html">
        <img src="../images/logo.png" alt="CLAM Logo" width="100"> <!-- Path changed. Moved all images to corresponding image folder - Cale -->
    </a>
    <h1>Welcome to CLAM Careers</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="jobs.html">Jobs</a></li>
            <li><a href="apply.html">Apply</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="enhancements.html">Enhancements</a></li>
            <li><a href="mailto:105907067@student.swin.edu.au">Contact Us</a></li> <!-- Changed to "Contact Us" rather than "Contact" - Cale -->
        </ul>
    </nav>
</header>
<main>
<?php
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
// Simple delete.php that gets the paramters in a GET ?id='x' to delete a user.
include "settings.php";

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
</body>
</html>