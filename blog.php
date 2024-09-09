<?php header("Cache-Control: no-store, must-revalidate"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            font-family: cursive;
        }

        .card img {
            height: 300px;
            overflow: hidden;
        }

        .navbar-brand {
            margin-left: 5em;
        }

        .mx-5 {
            margin-right: 19rem !important;
            margin-left: 17rem !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Personal Blog</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <img src="logo.png" class="navbar-brand mx-5" alt="Tribond" style="width:40px;" class="rounded-pill">
            &nbsp;&nbsp;&nbsp;
            <div style="margin: auto;">
                <?php include "addpost.php" ?>
            </div>
            <ul class="navbar-nav mx-5 ">
                <li class="text-primary"> hello,
                    admin
                </li>&nbsp;&nbsp;
                <li>
                    <?php
                    echo "<a href='logout.php'>Logout</a>";
                    ?>
                </li>
            </ul>
        </div>
    </nav><br>
    <div id="content-container">
        <!-- Content will be loaded here -->
    </div>

    <script>
        var offset = 0;
        var isLoading = false;
        function loadContent() {
            if (isLoading) return;

            isLoading = true;

            $.ajax({
                type: "POST",
                url: "loadcontent.php",
                data: { offset: offset },
                success: function (response) {
                    $("#content-container").append(response);
                    offset += 10; // Adjust this based on your pagination logic
                    isLoading = false;
                },
                error: function () {
                    console.error("Error loading content.");
                    isLoading = false;
                }
            });
        }
        // Load initial content
        loadContent();
        // Infinite scrolling detection
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                loadContent();
            }
        });
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</body>

</html>