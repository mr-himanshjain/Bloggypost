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

        .form label {
            margin-top: 10px;
        }

        form {
            font-size: 15px;
            font-family: cursive;
        }

        .img {
            padding: 20px;
        }

        #id {
            display: none;
        }

        .tab {
            margin: 20px 0px 0px 20px;
            text-align: center;
        }

        tr,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
            width: 500px;
        }

        .goback {
            margin: 20px 20px;
            width: 100px;
            height: 30px;
            background-color: white;
            color: #0d6efd;
            border: 1px solid #0d6efd;
            border-radius: 10px;
        }

        .container-fluid .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0;
        }
    </style>
    <title>All Comments</title>
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
            echo "<div class='tab col-md-6 '>";
            echo "<table>";
            $sql = "SELECT * FROM comments WHERE postId='$id' AND status='1'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<tr><th>Username</th><th>Comments</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["username"] . " </td><td>" . $row["comment"] . "</td></tr>";
                }
            } else {
                echo "No Comments";
            }
            echo "</table>";
            echo "</div>";
            echo "<div>";
            echo "<a href='index.php'><button class='goback'>Go Back</button></a>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "file is not Uploaded!!";
    }
    ?>
    <script>
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</body>

</html>