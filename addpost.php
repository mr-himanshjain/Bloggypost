<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 5px 10px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        /* Center the image and position the close button */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto;
            /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
    <title>Document</title>
</head>

<body>
    <?php
    include ('config.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $target_dir = "uploads/";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["fileupload"]["name"], PATHINFO_EXTENSION));
        $uniqueFilename = uniqid('img_') . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueFilename;
        // Check if the file is an actual image
        $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileupload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow only certain file formats (you can adjust this list)
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, move the file to the target directory
            if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) {
                $baseUrl = "http://localhost/blog/";
                $imageUrl = $baseUrl . "uploads/" . $uniqueFilename;

                $stmt = $conn->prepare("INSERT INTO fileupload (title, description, filename, imageURL) VALUES (?,?,?,?)");
                $stmt->bind_param("ssss", $title, $description, $uniqueFilename, $imageUrl);
                $stmt->execute();
                $stmt->close();

                // $conn->close();
    
                // echo "Your file has been uploaded";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    $conn->close();


    ?>

    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add post</button>

    <div id="id01" class="modal">

        <form class="modal-content animate" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
            enctype="multipart/form-data">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
            </div>
            <div class="container">
                <label for="title"><b>Title</b></label>
                <input style="width: 100%;" class="form-control" type="text" name="title">

                <label class="mt-3 my-1" for="description">Description:</label>
                <input style="height: auto; width: 100%;" class="form-control" type="text" name="description">

                <!-- <label class="mt-3 my-1" for="file">Image URL:</label> -->
                <!-- <input style="height: auto; width: 100%;" class="form-control" type="text" name="fileupload"> -->

                <label class="mt-3 my-1" for="file">Select the file to upload</label><br><br>
                <input type="file" name="fileupload" id="fileupload"><br><br>
                <input class="btn btn-outline-primary" id="contbtn2" type="submit" value="submit"><br>
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" style="margin-left: 500px; width:200px"
                    onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>



    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>

</body>

</html>