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
// Getting and setting POSTed fields
if (isset($_POST['submit'])) { // Have we submitted the form?
    if (isset($_POST['firstname']) && isset($_POST['lastname']) !== null) { // if names are set and not NULL
        $firstname = sanitise_input($_POST['firstname']);
        $lastname = sanitise_input($_POST['lastname']);
    } else {failed_validation();}
    if (isset($_POST['email']) && isset($_POST['phone']) !== null) {
        $email = sanitise_input($_POST['email']);
        $phone = sanitise_input($_POST['phone']);
    } else {failed_validation();}
    if (isset($_POST['street_address']) && isset($_POST['suburb']) && isset($_POST['state']) && isset($_POST['postcode']) !== null) { // get address
        $street_address = sanitise_input($_POST['street_address']);
        $suburb = sanitise_input($_POST['suburb']);
        $state = sanitise_input($_POST['state']);
        $postcode = sanitise_input($_POST['postcode']);
    } else {failed_validation();}
    if (isset($_POST['job_reference']) !== null) {
        $job_reference = sanitise_input($_POST['job_reference']);
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
if (is_strlen_toobig($job_reference,5)) {
    failed_validation();
}
if (is_strlen_toobig($firstname,20) || is_strlen_toobig($lastname,20)) {
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
if (!preg_match("/^[0-9, ]{1,10}$/",$phone)) {
    failed_validation();
}
if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/",$email)) {
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
?>
</body>
</html>

