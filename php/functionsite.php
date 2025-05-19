<!--
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : functionsite.php
// Description: This is a general helperfunction file that allows us to test valid input or reference
// error if needed, we can also check for postcode issues or if there is a valid, unique sign up email.
-->
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Generic Error Function
function fail($data){
    echo "<h1>Your input information is incorrect.</h1>";
    echo "<h2>Source: ".$data."</h2>";
}

function isValidSignUpEmail($email,$conn) : bool {
    if ($stmt = $conn->prepare("SELECT username FROM userdata WHERE email_address = ?")) {
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->store_result();
        $db_email = "";
        $stmt->bind_result($db_email);
        $stmt->fetch();
        if ($db_email == $email) {
            return False;
        }
        if($stmt->num_rows > 0) {
            return False;
        }
    }
    return True;
}
// HELPER FUNCTIONS
// TESTS IF $FIELD IF UNDER $SIZE = TRUE
function is_under_size($field, $size) : bool {
    $value = trim((string)$field);
    return strlen($value) < $size;
}

// VALID POSTCODE
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

function is_array_set($requiredfields) : bool {
    foreach ($requiredfields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo "<p>Sorry, $field or more fields are empty.</p>";
            return false;
        }

    }
    return true;
}

?>

