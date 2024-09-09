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

        .container-fluid .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Blog</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <div class="container">

                <img src="logo.png" class="navbar-brand mx-5" alt="Tribond" style="width:40px;" class="rounded-pill">
                &nbsp;&nbsp;&nbsp;

                <ul class="navbar-nav mx-5 ">
                    <p class="text-primary"> hello, User
                    </p>&nbsp;&nbsp;
                    <li>
                        <?php
                        echo "<a href='login.php'>Login</a>";
                        ?>
                    </li>
                </ul>
            </div>
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
                url: "loadcontentforuser.php",
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