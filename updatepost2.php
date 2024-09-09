<?php
include ('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $filename = $_POST['fileupload'];

    $sql = "UPDATE fileupload SET title='$title',description='$description', filename='$filename' WHERE ID=$id";
    echo "1";
    if ($conn->query($sql) === TRUE) {
        echo "2";
        echo "file Updated successfully!!";
        header("location: blog.php");
        exit();
    } else {
        echo "file is not Updated!!" . $conn->error;
    }
}
$conn->close();


?>