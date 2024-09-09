<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <style>
        body {
            font-family: cursive;
            font-size: 20px;
        }

        .container {
            padding: 10%;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        label {
            padding-right: 220px;
        }

        input {
            height: 50px;
            width: 300px;
            font-family: cursive;
            font-size: 20px;
        }

        .form-control {
            width: 260px;
        }

        input {
            box-shadow: 0 0 5px 2px #0d6efd;
            margin-top: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            position: relative;
            flex: 1 1 auto
        }

        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
            width: 200px;
            height: 50px;
            border-radius: 8px;

        }

        .btn:hover {
            background-color: #0d6efd;
            color: white;
        }

        .container-fluid .container1 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <div class="container1">
                <img src="logo.png" class="navbar-brand mx-5 " alt="Tribond" style="width:100px;" class="rounded-pill">
                &nbsp;&nbsp;&nbsp;
            </div>
        </div>
    </nav><br>
    <?php
    include ('config.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM myData WHERE username = '$uname'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($uname === $row['username']) {
                    $hashedPasswordFromDatabase = $row['password'];
                    if (password_verify($password, $hashedPasswordFromDatabase)) {
                        if ($row['is_admin'] == 1) {
                            header("location: blog.php");
                            exit();
                        } else {
                            header("location: index.php");
                            exit();
                        }
                    }
                } else {
                    echo "Invalid username!!";
                }
            }
        } else {
            echo "Invalid Username and Password!!";
        }
    }

    $conn->close();
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" name="uname"><br>
            <label for="password"><b>Password</b></label>
            <div>
                &nbsp;<input class="form-control" type="password" name="password">
                &nbsp;<img id="myImage" onclick="changeImage()" src="hide.png" width="30px"><br>
            </div><br>
            <input class="btn btn-outline-primary" id="contbtn2" type="submit" value="submit"><br>
        </div>
    </form>
    <script>
        function changeImage() {
            var image = document.getElementById("myImage");
            if (image.src.match("eye")) {
                image.src = "hide.png";
                document.getElementsByName('password')[0].type = "password";
            } else {
                image.src = "eye.png";
                document.getElementsByName('password')[0].type = "text";

            }
        }
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</body>

</html>