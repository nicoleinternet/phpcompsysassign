<!--
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : processEOI.php
// Description: This is the processing page for expressions of interest, and parses information from a form.
// The form must only have the specified incoming POST keys:
// firstName, lastName, emailField, pNumber, street_address,suburb, state, postcode, jobrefNum, skills
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="description" content="CLAM">
    <meta name="keywords" content="assignment2,cos10032,php">
    <title>CLAM Careers - EOI Submission</title>
</head>
<body>



<?php
// Connect to database with settings.php, should output 'Connected Successfully'
include 'settings.php';

// Getting and setting POSTed fields
if (isset($_POST['submit'])) { // Have we submitted the form?

    if (isset($_POST['firstName']) && isset($_POST['lastName']) !== null) { // if names are set and not NULL
        $firstName = sanitise_input($_POST['firstName']);
        $lastName = sanitise_input($_POST['lastName']);
    } else {failed_validation();}
    if (isset($_POST['emailField']) && isset($_POST['pNumber']) !== null) {
        $emailField = sanitise_input($_POST['emailField']);
        $pNumber = sanitise_input($_POST['pNumber']);
    } else {failed_validation();}
    if (isset($_POST['street_address']) && isset($_POST['suburb']) && isset($_POST['state']) && isset($_POST['postcode']) !== null) { // get address
        $street_address = sanitise_input($_POST['street_address']);
        $suburb = sanitise_input($_POST['suburb']);
        $state = sanitise_input($_POST['state']);
        $postcode = sanitise_input($_POST['postcode']);
    } else {failed_validation();}
    if (isset($_POST['jobRefNum']) !== null) {
        $jobRefNum = sanitise_input($_POST['jobRefNum']);
    } else {failed_validation();}
    // Not mandatory fields
    if (isset($_POST['skills']) !== null) {
        $skills = sanitise_input($_POST['skills']);
    }
} else { header ("location: register.html");} // has the user not sent a 'submit' value?

function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/* Getting and setting variables from the form should be done now,
and we can process input. */
// Testing sizes of strings
if (is_strlen_toobig($jobRefNum,5)) {
    failed_validation();
}
if (is_strlen_toobig($firstName,20) || is_strlen_toobig($lastName,20)) {
    failed_validation();
}
if (is_strlen_toobig($street_address,40) || is_strlen_toobig($suburb,40) || is_strlen_toobig($postcode,4) || is_strlen_toobig($state,3)) {
    failed_validation();
}

// TODO check if postcode is one of VIC/NSW/QLD/etc

// Testing numbers
if (!ctype_digit($postcode)) {
    failed_validation();
}

// ^[0-9, ]{1,10}$ (digits, space, max 10 char)
if (!preg_match("/^[0-9, ]{1,10}$/",$pNumber)) {
    failed_validation();
}
if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/",$emailField)) {
    failed_validation();
}

function is_strlen_toobig($data, $max) {
    if (strlen($data) > $max) {
        return True;
    }
    return False;

}

function failed_validation() {
    //TODO present a nice screen to the user when the form has hit a failed state.
    // 7 MAY
}


// SQL QUERY
// This inserts a row with the selected variables.
$sql = "INSERT INTO eoi (job_ref,status,first_name,last_name,email,phone_number,street_address,suburb_address,state_address,postcode,skill_1,miscinfo)
VALUES ('$jobRefNum','New','$firstName','$lastName','$emailField','$pNumber','$street_address','$suburb','$state',$postcode,'$skills','SAMPLE')";
// DEBUG PRINT
printf($sql);
// TRY TO EXECUTE QUERY AND CATCH EXCEPTION
try {
    // $mysqli is the connection variable from settings.php
    $mysqli->query($sql);
} catch (Exception $e) {$mysqli. $e->getMessage();}
?>
</body>
</html>
