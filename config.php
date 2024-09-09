<?php

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$pword = "root";
$dbname = "FormData";
// $servername = "sql308.infinityfree.com";
// $username = "if0_36688825";
// $pword = "eeOVM04g9Ad";
// $dbname = "if0_36688825_FormData";

$conn = new mysqli($servername, $username, "", $dbname);
// $conn = new mysqli($servername, $username, $pword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>