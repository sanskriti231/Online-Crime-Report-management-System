<?php
include "../_connection.php";

// SQL query to get all the reports data
$query = "SELECT r.report_id, r.title, r.location, r.description, r.date_of_incident, u.name as officer_name, o.officer_id, r.status FROM Reports r JOIN Users u ON r.user_id = u.user_id JOIN PoliceOfficers o ON u.user_id = o.user_id LIMIT 0, 25; ";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $reports = array();

    // Fetch all rows as an associative array
    while ($row = mysqli_fetch_assoc($result)) {
        $reports[] = $row; 
    }

    // Return the data as a JSON response
    echo json_encode($reports);
} else {
    // No data found, return an empty array
    echo json_encode([]);
}

mysqli_close($conn);  // Close the database connection
?>