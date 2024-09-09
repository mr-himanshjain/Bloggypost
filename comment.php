<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .form p {
            font-family: cursive;
            font-size: 20px;
        }

        form {
            font-size: 15px;
            font-family: cursive;
        }

        #id {
            display: none;
        }

        textarea {
            box-shadow: 0 0 5px 2px #0d6efd;
            margin-top: 5px;
            border: 1px solid #ccc;
        }

        .container-fluid .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0;
        }

        .goback {
            margin: 20px 20px;
            width: 150px;
            height: 30px;
            background-color: white;
            color: #0d6efd;
            border: 1px solid #0d6efd;
            border-radius: 10px;
            margin-top: 50px;
        }
    </style>
    <title>Blog</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <div class="container">
                <a class="navbar-brand mx-5" href="#">
                    <img src="logo.png" alt="Tribond" style="width:40px;" class="rounded-pill">
                    &nbsp;&nbsp;&nbsp;
                </a>
                <ul class="navbar-nav mx-5 ">
                    <p class="text-primary  ">Hello, User
                    </p>&nbsp;&nbsp;
                </ul>
            </div>
        </div>
    </nav><br>
    <?php

    include ('config.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $uname = $_POST['username'];
        $comment = $_POST['comment'];
        $sql = "INSERT INTO comments (postId,username, comment) VALUES ('$id','$uname','$comment')";
        if ($conn->query($sql) === TRUE) {
            echo "Comment Uploaded successfully!!";
            header("location: index.php");
        } else {
            echo "file is not Uploaded!!";
        }
    }



    $sql = "SELECT * FROM fileupload WHERE ID={$id}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<div class='container p-0'>";
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='img col-md-12 col-lg-6 col-xxl-4 p-3'>";
            echo "<img src=" . $row['imageURL'] . " height='300px' width='100%'>";
            echo "</div>";
            echo "<div class='form col-md-12 col-lg-6 col-xxl-4 p-3'>";
            echo "<label for='title'><b>Title</b></label><br>";
            echo "<p style='width: 100%;' name='title' rows='2'>" . $row["title"] . "</p> <br>";
            echo "<label class='mt-3 my-1' for='description'><b>Description</b></label><br>";
            echo "<p style='width: 100%;' name='description' rows='2'>" . $row["description"] . "</p> <br>";
            echo "</div>";
            echo "<div class='img col-md-12 col-lg-6 col-xxl-4 '>";
            echo "</div>";
            echo "<div class='img col-md-12 col-lg-6 col-xxl-4 '>";
            echo "<a href='index.php'><button class='goback'>Go Back</button></a>";
            echo "</div>";
            echo "<div class='img col-md-12 col-lg-6 col-xxl-4 p-4'>";
            echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='post'>";
            echo "<input id='id' name='id' value=" . $row['ID'] . ">";
            echo "<label for='uname'><b>Username</b></label><br>";
            echo "<textarea style='width: 500px;' type='text' name='username'></textarea><br>";
            echo "<label for='uname'><b>Comments</b></label><br>";
            echo "<textarea style='width: 500px;' type='text' name='comment'></textarea><br>";
            echo "<input class='btn btn-outline-primary' id='contbtn2' type='submit' value='submit'><br><br>";
            echo "</form>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "file is not Uploaded!!";
    }

    $conn->close();
    ?>
    <script>
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</body>

</html>