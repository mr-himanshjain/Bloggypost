<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: cursive;
        }

        .container-fluid .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0;
        }

        .btn {
            position: relative;
            flex: 1 1 auto
        }

        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
            width: 100px;
            height: 30px;
            border-radius: 8px;
        }

        .btn:hover {
            background-color: #0d6efd;
            color: white;
        }

        textarea {
            font-family: cursive;
            font-size: 18px;
        }


        label {
            line-height: 2;
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
            width: 10%;
            height: 50px;
            border-radius: 8px;
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

        #id {
            display: none;
        }

        .container {
            margin-left: 30px;
            margin-right: 30px;
        }

        .text-primary {
            color: #0d6efd;
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
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <div class="container">
                <img src="logo.png" class="navbar-brand mx-5 " alt="Tribond" style="width:40px;" class="rounded-pill">
                &nbsp;&nbsp;&nbsp;
                <p class="text-primary">
                    hello,
                    admin
                </p>
            </div>
        </div>
    </nav><br>
    <?php

    include ('config.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $sql = "SELECT * FROM fileupload WHERE ID={$id}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<img src=" . $row['imageURL'] . " height='400px' width='500px'><br><br>";
            echo "<a href='blog.php'><button style='margin-left: 30px;'' >Click here to go back</button></a>";
            echo "<div id='id01' class='modal'>";
            echo "<form class='modal-content animate' action='deletepost2.php' method='POST'>";
            echo "<div class='container'>";
            echo "<input id='id' name='id' value=" . $row['ID'] . ">";
            echo "<label for='title'><b>Title</b></label><br>";
            echo "<textarea style='width: 99.6%;' name='title' rows='2'>" . $row["title"] . "</textarea> <br>";
            echo "<label class='mt-3 my-1' for='description'>Description:</label><br>";
            echo "<textarea style='width: 99.6%;' name='description' rows='2'>" . $row["description"] . "</textarea> <br>";
            echo "<label class='mt-3 my-1' for='file'>Image URL:</label><br>";
            echo "<textarea style='width: 99.6%;' name='fileupload' rows='2'>" . $row["filename"] . "</textarea> <br><br>";
            echo "<img src=" . $row['imageURL'] . " height='100px' width='200px'><br><br>";
            echo "<input class='btn btn-outline-primary' id='contbtn2' type='submit' value='Delete Post'><br><br>";
            echo "</div>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "file is not Deleted!!";
    }
    $conn->close();
    ?>
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>