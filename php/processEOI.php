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
include "settings.php";

$conn = new mysqli($servername, $username, $password, $dbname);
// We can check if we have submitted the form


// Create variables for readability
$jobRefNum;
$firstName;
$lastName;
$dob;
$gender;
$street_address;
$suburb;
$state;
$postcode;
$emailField;
$pNumber;
$otherSkills;

if (are_fields_set()) {

    $jobRefNum = validate_html($_POST['jobRefNum']);
    $firstName = validate_html($_POST['firstName']);
    $lastName = validate_html($_POST['lastName']);
    $dob = validate_html($_POST['dob']);
    $gender = validate_html($_POST['gender']);
    $street_address = validate_html($_POST['street_address']);
    $suburb = validate_html($_POST['suburb']);
    $state = validate_html($_POST['state']);
    $postcode = validate_html($_POST['postcode']);
    $emailField = validate_html($_POST['emailField']);
    $pNumber = validate_html($_POST['pNumber']);
    $otherSkills = validate_html($_POST['otherSkills']);
};

// Validate items
if (!is_under_size($jobRefNum,6) || !ctype_alnum($jobRefNum)) {
    echo "";
    // handle error here
    fail($jobRefNum);
}
if (!is_under_size($firstName,20) || !ctype_alpha($firstName)) {
    echo "";
    // handle error here
    fail($firstName);
}
if (!is_under_size($lastName,20) || !ctype_alpha($lastName)) {
    echo "";
    // handle error here
    fail($lastName);
}
//TODO: DOB/GENDER
if (!is_under_size($street_address,40)) {
    echo "";
    fail($street_address);
}
if (!is_under_size($suburb,40)) {
    echo "";
    fail($suburb);
}
// TO DO STATE AND POSTCODE HERE
$valid_states = ['NSW','ACT','VIC','QLD','SA','WA','TAS','NT'];
if (!in_array($state, $valid_states)) {
    fail($state);
}
if (!valid_postcode($state,$postcode)) {
    fail($postcode);
};
if (!is_under_size($emailField, 20)) {
    fail($emailField);
}

// FROM PHPMyAdmin
// $sql = "INSERT INTO `eoi`(`job_ref`, `status`, `first_name`, `last_name`, `email`, `phone_number`, `street_address`, `suburb_address`, `state_address`, `postcode`, `skill_1`, `skill_2`, `skill_3`, `skill_4`, `skill_5`, `miscinfo`) VALUES (\'[value-1]\',\'New\',\'[value-4]\',\'[value-5]\',\'[value-6]\',\'[value-7]\',\'[value-8]\',\'[value-9]\',\'VIC\',\'3000\',\'[value-12]\',\'[value-13]\',\'[value-14]\',\'[value-15]\',\'[value-16]\',\'[value-17]\');";
$query = "INSERT INTO eoi('job_ref', 'status', 'first_name', 'last_name', 'email', 'phone_number', 'street_address', 'suburb_address', 'state_address', 'postcode', 'miscinfo') VALUES ('$jobRefNum','New','$firstName','$lastName','$emailField','$pNumber','$street_address','$suburb','$state','$postcode','$skills');";
echo "<h3>$query</h3>";

// Is this not a POST request?
if (!$_SERVER['REQUEST_METHOD'] == "POST") {
    $errorMsg = "You must submit the form.";
    fail($errorMsg);

}




// Returns 1 (TRUE) or 0 (FALSE) based on field and SIZE
function is_under_size($field, $size) : bool {
    $value = trim((string)$field);
    return strlen($value) < $size;
}



function valid_postcode($state, $postcode) : bool {

    // https://stackoverflow.com/questions/14037290/what-does-or-mean-in-php
    // We can use => like the map<> in C++, letting us define
    // values in an array.

    // This is technically creating a two dimensional array, with the second dimension having two indexes (the postcodes).
    $postcodes = [
        'NSW' => [1000, 2999],
        'ACT' => [2600, 2618],
        'VIC' => [3000, 3999],
        'QLD' => [4000, 4999],
        'SA'  => [5000, 5999],
        'WA'  => [6000, 6999],
        'TAS' => [7000, 7999],
        'NT'  => [800, 999]
    ];
// if the postcode is within the bounds of the states second dimension array
    if ($postcode >= $postcodes[$state][0] && $postcode <= $postcodes[$state][1]) {
        return True;
    } else {
        return False;
    }

}


// USE IN AN IF STATEMENT TO CHECK IF WE HAVE SET FIELDS
function are_fields_set() : bool {
$requiredfields = ['firstName','lastName','jobRefNum','suburb','postcode','street_address','gender'];
foreach ($requiredfields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        echo "<p>Sorry, $field or more fields are empty.</p>";
        return false;
    }

}
return true;
}


// SET variables based on usage
// if (isset($_POST['firstName'])) {
//     $firstName = validate_html(firstName);
// };
// if (isset($_POST['lastName'])) {
//     $firstName = validate_html(firstName);
// };
// if (isset($_POST['jobRefNum'])) {
//     $jobRefNum = validate_html(jobRefNum);
// };
// if (isset($_POST['street_address'])) {
//     $street_address = validate_html(street_address);
// };
// if (isset($_POST['suburb'])) {
//     $suburb = validate_html(suburb);
// };
// if (isset($_POST['state'])) {
//     $state = validate_html(state);
// };
// if (isset($_POST['postcode'])) {
//     $postcode = validate_html(postcode);
// };
// if (isset($_POST['gender'])) {
//     $gender = validate_html(gender);
// };



function validate_html($data) {
    // trim, stripslashes, htmlspecialchars
    $data = htmlspecialchars($data);
    return $data;
}

function fail($data)
{
    echo "<h1>Your input information is incorrect.</h1>";
    echo "<h2>".$data."</h2>";
}

?>
</body>
</html>