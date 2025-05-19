<!--
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : Manage.php
// Description: This is the managing page for the assignment and will display all rows of EOI by default.
// The user can specify the JobRefNo, LastName or FirstName to search by wildcard rule against the eoi
// table for the respective columns.
// This page is linked to from login.php when a user successfully logs in, and branches out into edit.php
// on editing the status (select) or the Edit link, or delete.php when clicked.
// Uses manage.inc.php to handle most verbose functions.
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
    <!-- TO ADD INTO CSS LATER NICOLE -->
    <style>
        .eoi {
            color: black;
            border: 1px solid;
            border-collapse: collapse;
            padding:1em;
            border-radius:
            margin:1em;
        }
        .eoi th, td {
            color: black;
            border: 1px solid;
            padding: .5em;
        }
        .error {
            color: rgb(213, 13, 13);
            font-size:1em;
            font-weight:600;
            /*display: flex;*/
        }
        .submission {
            text-align: center;
        }

        /* Dropdown Button */
.dropbtn {
  background-color: #0d1b2a;
  color: white;
  padding: 16px;
  font-size: 16px;
  border-radius:3px;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  visibility:none;
  position: absolute;
  opacity: 0;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  transition: all 0.3s ease-out;
  z-index: 1;
  transition: visibility 0s, opacity 0.1s linear, expand 0.6s smooth;
}

/* Links inside the dropdown */
.dropdown-content table {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover
BUG: the hover current takes over space for some of the job reference titles. */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    visibility:visible;
    opacity: 1;
     padding-top: 1.2em;

    }

@keyframes expand {
    from {
        transform: scaleY(0%);
    }
    to {
        transform: scaleY(0%);
    }

}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color:#1b3149;}
    </style>
</head>
<body>

<!-- PHP -->
 <?php
 // Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
 // INCLUDES
 error_reporting(E_ALL);
ini_set('display_errors', 1);
 include 'settings.php';
 include 'functionsite.php';
 include 'manage.inc.php';
 // INIT VARS
  $jobRef = $firstName = $lastName = "";
 $jobRefErr = $firstNameErr = $lastNameErr = $formErr = "";
 $readyToTransact = False;

 // Check if form was submitted and process the inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    if (isset($_POST['jobRef'])) {
        $jobRef = test_input($_POST['jobRef']);
    }
    if (isset($_POST['firstName'])) {
        $firstName = test_input($_POST['firstName']);
    }
    if (isset($_POST['lastName'])) {
        $lastName = test_input($_POST['lastName']);
    }

    // Build and execute query with form data
    $result = $conn->query("SELECT * FROM `eoi` WHERE job_ref LIKE '%$jobRef%' AND first_name LIKE '%$firstName%' AND last_name LIKE '%$lastName%'");
} else {
    // Default query to show all entries when page first loads
    $result = $conn->query("SELECT * FROM `eoi`");
}



 // We can ask if we have set the session from logging in ($_SESSION['username'])
 // if not, we can redirect them back to the login page.
 /*
 if (!$_SESSION['username']) {
    header("location: login.php");
    $formErr = "You aren't logged in. Returning you to login...";
 }
    */

 ?>

<!-- PHP END -->


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
    <section id="hero">

        <!-- Print EOI results from an included function here -->
        <section class="eoiresult">
        <?php print_eoi_results($result); ?>
        </section>

        <aside class="dropdown">
            <button class="dropbtn">Search</button>
            <div class="dropdown-content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate="novalidate" class="submission">
                <label for="Job Reference No."><h4 class="hero-subtext">Job Reference No.</h4></label>
                <input type="text" placeholder="Enter Job Reference No." name="jobRef" required>
                <p class="error"><?php echo $jobRefErr;?></p>

                <label for="First Name"><h4 class="hero-subtext">First Name</h4></label>
                <input type="text" placeholder="Enter First Name" name="firstName" required>
                <p class="error"><?php echo $firstNameErr;?></p>

                <label for="Last Name"><h4 class="hero-subtext">Last Name</h4></label>
                <input type="text" placeholder="Enter Last Name" name="lastName" required>
                <p class="error"><?php echo $lastNameErr;?></p>

                <button type="b" class="video-link">Submit</button>
                <p class="error"><?php echo $formErr;?></p>

        </form>
    </div>
    </aside>

        </form>
    </section>
</main>

</body>
</html>