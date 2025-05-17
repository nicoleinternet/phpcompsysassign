<?php
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
// FUNCTIONS FOR WRITING OUT TABLES FOR MANAGE.PHP
include 'settings.php';

// This prints the EOI results, and returns an error if we don't return any results.
function print_eoi_results($result) {
echo "<h2>EOIs for CLAM</h2>";
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
        <td>{$row["status"]}</td>
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

// FUNCTION TO DELETE
// function remove_entry($id) {
//     $result = $conn->query("DELETE")
// }


?>