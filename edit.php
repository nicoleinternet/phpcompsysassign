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
<?php
// NICOLE REICHERT
// ERROR REPORTING FOR DEBUGGING
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'settings.php';
include 'manage.inc.php';
include 'menu.inc.php';
include 'functionsite.php';

draw_headerhtml("Edit User");

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
<body>
<main>
</main>
<?php draw_footerhtml(); ?>
</body>
</html>
