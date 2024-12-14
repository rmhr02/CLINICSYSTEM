<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "clinic_data";

$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch patients data
$sql = "SELECT PatientID, CONCAT(LastName, ', ', FirstName, ' ', MiddleInitial) AS full_name FROM patients";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li class="list-group-item">';
        echo '<a href="view_details.php?id=' . $row['PatientID'] . '" class="text-primary">' . htmlspecialchars($row['full_name']) . '</a>';
        echo '</li>';
    }
} else {
    echo '<li class="list-group-item text-muted">No patients found.</li>';
}

$connection->close();
?>
