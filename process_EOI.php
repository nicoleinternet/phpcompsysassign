<!DOCTYPE html>
<html lang="en">
<?php
include 'settings.php';
include 'menu.inc.php';
// We can check if we have submitted the form
draw_headerhtml("Thank you!");

// Create variables for readability
$jobRefNum = "";
$firstName = "";
$lastName = "";
$dob = "";
$gender = "";
$street_address = "";
$suburb = "";
$state = "";
$postcode = "";
$emailField = "";
$pNumber = "";
$otherSkills = "";

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
    $gender = validate_html($_POST['gender']);

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
if (!is_under_size($emailField, 20) || !filter_var($emailField, FILTER_VALIDATE_EMAIL)) {
    fail($emailField);
}
};



// FROM PHPMyAdmin
// $sql = "INSERT INTO `eoi`(`job_ref`, `status`, `first_name`, `last_name`, `email`, `phone_number`, `street_address`, `suburb_address`, `state_address`, `postcode`, `skill_1`, `skill_2`, `skill_3`, `skill_4`, `skill_5`, `miscinfo`) VALUES (\'[value-1]\',\'New\',\'[value-4]\',\'[value-5]\',\'[value-6]\',\'[value-7]\',\'[value-8]\',\'[value-9]\',\'VIC\',\'3000\',\'[value-12]\',\'[value-13]\',\'[value-14]\',\'[value-15]\',\'[value-16]\',\'[value-17]\');";
$sql = "INSERT INTO eoi(job_ref, status, first_name, last_name, email, phone_number, street_address, suburb_address, state_address, postcode, miscinfo, dob, gender) VALUES ('$jobRefNum','New','$firstName','$lastName','$emailField','$pNumber','$street_address','$suburb','$state','$postcode','$otherSkills', '$dob','$gender');";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}




// Is this not a POST request?
if (!$_SERVER['REQUEST_METHOD'] == "POST") {
    $errorMsg = "You must submit the form.";
    fail($errorMsg);

}




// Returns 1 (TRUE) or 0 (FALSE) based on field and SIZE
function is_under_size($field, $size) {
    $value = trim((string)$field);
    if (strlen($value) < $size) {
        return true;
    } else {
        return false;
    }

    return strlen($value) < $size;
}



function valid_postcode($state, $postcode) {

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
        return true;
    } else {
        return false;
    }

}


// USE IN AN IF STATEMENT TO CHECK IF WE HAVE SET FIELDS
function are_fields_set() {
$requiredfields = ['firstName','lastName','jobRefNum','suburb','postcode','street_address','gender'];
foreach ($requiredfields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        echo "<p>Sorry, $field or more fields are empty.</p>";
        return false;
    }
    if (isset($_POST['otherSkill'])) {
        if (!isset($_POST['otherSkills']) || empty($_POST['otherSkills'])) {
            echo "<p>Sorry, $field or more fields are empty.</p>";
            return false;
        }
    }

}
return true;
}

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
<body>
</body>

</body>
</html>
