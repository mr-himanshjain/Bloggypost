<?php
include ('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $id = intval($_POST['id']);
    $newState = intval($_POST['newState']);

    // Update the database
    $sql = "UPDATE comments SET status = $newState WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>