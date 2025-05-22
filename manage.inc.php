<?php
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : Manage.inc.php
// Description: This is a include PHP file that stores the includes for printing EOI results and editing
// EOIs from a corresponding $result (mysqli object) that is a query from the database.
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
// FUNCTIONS FOR WRITING OUT TABLES FOR MANAGE.PHP
include 'settings.php';

// This prints the EOI results, and returns an error if we don't return any results.
function print_eoi_results($result) {
echo "<h2>Expressions of Interest</h2>";
if (mysqli_num_rows($result) == 0) {
    echo "<h3>No entries were found.</h3>";
} else {
    echo "<table class=\"eoi\">";
echo "<tr>
        <th>Job Ref.</th>
        <th>Status</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Skills/Info</th>
        <th>Update</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
    
        // eoi_id is the primarykey/UID of EOIs, can use to delete
        $id = $row["eoi_id"];
        echo "<tr>
        <td>{$row["job_ref"]}</td>
        <!--<td>{$row["status"]}</td>--> 
        <td>
        <form action='edit.php' method='post' novalidate='novalidate'>
        <select name='status' id='status'>
            <option value='{$row["status"]}'>{$row["status"]}</option>
            <option value='New'>New</option>
            <option value='Current'>Current</option>
            <option value='Final'>Final</option>
        </select>
        <input type='hidden' name='id' value='{$id}'>
        <input type='submit' name='update' value='Update'>
        </form>
        </td>
        <td>{$row["first_name"]}</td>
        <td>{$row["last_name"]}</td>
        <td>{$row["email"]}</td>
        <td>{$row["miscinfo"]}</td>
        <td><a href=\"edit.php?id=$id\">Edit</a>
            <a href=\"delete.php?id=$id\">Delete</a>
                </td>
        </tr>";
    }
echo "</table>";
}


}

function print_single_eoi($result)
{
    if (mysqli_num_rows($result) == 0) {
        echo "<h3>No entries were found.</h3>";
    } else {

        echo "<section class=\"eoiresult\">";
        // Print results
        while ($row = $result->fetch_assoc()) {
            $current_status = $row["status"];
            // eoi_id is the primarykey/UID of EOIs, can use to delete
            echo "<h3>{$row["first_name"]} {$row["last_name"]}</h3>";
            echo "<h4>Job Reference: {$row["job_ref"]}</h4>";
            echo "<h4>Skills/Info:</h4>";
            echo "<p>{$row["miscinfo"]}</p>";
            echo "<h4>Details:</h4>";
            echo "<aside class=\"eoidetails\">";
             echo "<h5>{$row["email"]}</h5>
                   <h5>{$row["phone_number"]}</h5>
                   <h5>Address</h5>
                   <p>{$row["street_address"]} {$row["suburb_address"]}</p>
                   <p>{$row["state_address"]} {$row["postcode"]}</p>
                   ";
            echo "</aside>";
        }
        echo "</section>";
        echo "<section class=\"status\">";
        echo "<h3>Current Status: {$current_status}</h3>";
        echo "</section>";


    }
}




// FUNCTION TO DELETE
function delete_notification($id) {
    echo "<section class=\"submission\">
    <h3> User with ID: $id has been deleted. </h3>
    </section>
    ";
}

?>