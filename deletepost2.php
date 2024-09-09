<?php

include ('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $uname = $_POST['uname'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $filename = $_POST['fileupload'];

    $sql = "DELETE FROM fileupload WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "file Uploaded successfully!!";
        header("location: blog.php");
    } else {
        echo "file is not Uploaded!!";
    }
}
$conn->close();


?>