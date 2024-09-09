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

        .tab {
            margin: 20px 0px 0px 20px;
            text-align: center;
        }

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

        tr,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
            width: 500px;
        }

        #toggleBtn {
            display: inline-block;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
        }

        /* Style for the "on" state */
        #toggleBtn.on {
            background-color: #4CAF50;
            color: #fff;
        }

        /* Style for the "off" state */
        #toggleBtn.off {
            background-color: #ccc;
            color: #000;
        }
    </style>
    <title>Blog</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="#">
                <img src="logo.png" alt="Tribond" style="width:40px;" class="rounded-pill">
                &nbsp;&nbsp;&nbsp;
            </a>
            <ul class="navbar-nav mx-5 ">
                <p class="text-primary  ">Hello, Admin
                </p>&nbsp;&nbsp;
            </ul>
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
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='img col-md-4 p-3'>";
            echo "<img src=" . $row['imageURL'] . " height='300px' width='600px'>";
            echo "</div>";
            echo "<div class='form col-md-8 p-3'>";
            echo "<label for='uname'><b>Username</b></label><br>";
            echo "<p style='width: 100%;' name='uname' rows='2'>Admin</p> <br>";
            echo "<label for='title'><b>Title</b></label><br>";
            echo "<p style='width: 100%;' name='title' rows='2'>" . $row["title"] . "</p> <br>";
            echo "<label class='mt-3 my-1' for='description'><b>Description</b></label><br>";
            echo "<p style='width: 100%;' name='description' rows='2'>" . $row["description"] . "</p> <br>";
            echo "</div>";
            echo "<div class='tab col-md-6 '>";
            echo "<table>";
            $sql = "SELECT * FROM comments WHERE postId={$id}";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<tr><th>Username</th><th>Comments</th><th>Status</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    $initialState = ($row['status'] == 1) ? 'on' : 'off';
                    $displayText = ($row['status'] == 1) ? 'On' : 'Off';
                    echo "<tr><td>" . $row['username'] . "</td><td>" . $row['comment'] . "</td> <td> <div id='toggleBtn' class='$initialState' onclick='toggleState(this, " . $row['id'] . ")'>$displayText</div></td></tr>";
                }
            } else {
                echo "No Comments";
            }
            echo "</table>";
            echo "</div>";
        }
        echo "</div>";
        echo "<a href='blog.php'><button style='margin-left: 30px;'' >Click here to go back</button></a>";
    } else {
        echo "file is not Uploaded!!";
    }

    $conn->close();
    ?>
    <script>
        function toggleState(element, id) {
            // Toggle the class between 'on' and 'off'
            element.classList.toggle('on');
            element.classList.toggle('off');

            // Update the text based on the current class
            element.textContent = (element.classList.contains('on')) ? 'On' : 'Off';

            // Send an AJAX request to update the database
            var newState = (element.classList.contains('on')) ? 1 : 0;
            updateDatabase(id, newState);
        }

        function updateDatabase(id, newState) {
            // Use AJAX to send a request to the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateStatus.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response if needed
                    console.log(xhr.responseText);
                }
            };

            // Send the data to the server
            xhr.send('id=' + id + '&newState=' + newState);
        }
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</body>

</html>