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

<!-- PHP -->
 <?php
 // Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
 // INCLUDES
 include "menu.inc.php";
 include 'settings.php';
 include 'functionsite.php';
 include 'manage.inc.php';
 // Keep PHP session
 session_start();
 // Draw HEAD and HEADER HTML
 draw_headerhtml("Manage EOIs");

  // We can ask if we have set the session from logging in ($_SESSION['account_loggedin'])
 // if not, we can redirect them back to the login page.

 // If the user is not logged in...
 if ($_SESSION['account_loggedin'] != True) {
    echo "Sorry, you are not logged in.";
    header("location: login.php");
 }
 //error_reporting(E_ALL);
//ini_set('display_errors');

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


 ?>
<!-- PHP END -->

<body>



<main>
    <section id="hero">
        <!-- Print EOI results from an included function here -->
        <section class="eoiresult">
        <?php
        // Print from EOI results..
        print_eoi_results($result);

        // Have we deleted an entry from delete.php?
        if (http_response_code(302)
        && preg_match("/delete.php/", $_SERVER['HTTP_REFERER'])) {
            // GET referral will have action = delete and id of deleted user
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            delete_notification($id);
            }
        }
        ?>

        </section>
        <aside>

        <form class="submission" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate="novalidate" class="submission">
            <h3>Search</h3>
            <fieldset>
                <label for="jobRef">Job Reference No.</label>
                <input type="text" placeholder="Enter Job Reference No." id="jobRef" name="jobRef" required>
                <p class="error"><?php echo $jobRefErr;?></p>

                <label for="firstName">First Name</label>
                <input type="text" placeholder="Enter First Name" id="firstName" name="firstName" required>
                <p class="error"><?php echo $firstNameErr;?></p>

                <label for="lastName">Last Name</label>
                <input type="text" placeholder="Enter Last Name" id="lastName" name="lastName" required>
                <p class="error"><?php echo $lastNameErr;?></p>

                <button type="submit" class="video-link">Submit</button>
                <p class="error"><?php echo $formErr;?></p>
                </fieldset>


        </form>

    </aside>



    </section>
</main>
<?php draw_footerhtml(); ?>
</body>
</html>