<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>
</head>

<body>
    <?php
    session_start();
    // if (!isset($_SESSION["username"]))
    // header("location: index.html");
    // exit();
    ?>
    <p>
        <?php echo "hello " . $_SESSION['username'] . ", " ?>
    </p>
    <p>hello mate i am a Blog page <br>
        But work is still in Progresss!!! <br>
        see yeah!</p>


    <div>
        <form action="comment.php" method="post">
            <input type="text" name="uname" value="<?php echo $_SESSION['username'] ?>"><br><br>
            <label for="comment">Enter Your Commets:</label><br>
            <input type="textarea" name="comment"><br>
            <input type="submit" value="submit"><br>
        </form>
    </div>

</body>

</html>