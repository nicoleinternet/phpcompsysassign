<!--
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : edit.php
// Description: This is the edit PHP file that can parse a POST or GET response from manage.php.
// the POST calls out to the database to change the enum of Status, and the GET has an unimplemented display
// of all the users data in the table (according to PrimaryKey eoi_id).
-->
<!DOCTYPE html>
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
// NICOLE REICHERT
// ERROR REPORTING FOR DEBUGGING
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'settings.php';
include 'manage.inc.php';
include 'functionsite.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = test_input($_POST['status']);
    $id = test_input($_POST['id']);
    if (empty($id) || empty($status)) {
        header('Location: manage.php');
    }
    $result = $conn->query("UPDATE `eoi` SET `status` = '$status' WHERE eoi_id = '$id'");
    //update_user_status($status);
    if ($result = True){
        echo "Updated Successfully";
    }

}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM `eoi` WHERE eoi_id = '$id'");
    //TODO: Could make this a place where a form can update a user
    print_single_eoi($result);
}

?>
</main>
<?php draw_footerhtml(); ?>
</body>
</html>
