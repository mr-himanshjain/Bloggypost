<?php
include ('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO myData (username, email, password) VALUES ('$uname','$email','$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        echo "data is Inserted successfully!!";
        header("Location: index.php");
    } else {
        echo "data is note inserted!!";
    }
}

$conn->close();


?>