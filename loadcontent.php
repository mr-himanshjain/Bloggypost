<?php
include ('config.php');

$limit = 9; // Number of items to load per request

// Determine the current cycle (based on the offset)
$cycle = isset($_POST['cycle']) ? (int) $_POST['cycle'] : 0;

// If it's the first request or the end of a cycle, shuffle the content
if ($cycle == 0 || $cycle % ceil($limit / 2) == 0) {
    $sql = "SELECT * FROM fileupload ORDER BY RAND()";
    $result = $conn->query($sql);

    // Save the shuffled content in the session
    $_SESSION['shuffled_content'] = [];
    while ($row = $result->fetch_assoc()) {
        $_SESSION['shuffled_content'][] = $row;
    }
}

// Calculate the starting point for this cycle
$start = ($cycle % ceil($limit / 2)) * $limit;

// Extract the content for this cycle
$content = array_slice($_SESSION['shuffled_content'], $start, $limit);
echo "<div class='container p-0'>";
echo "<div class='row gy-5 gx-5'>";
foreach ($content as $row) {
    echo "<div class='col-md-12 col-lg-6 col-xxl-4'>";
    echo "<div class='card' style='width:400px'>";
    echo "<img class='card-img-top' src='" . $row["imageURL"] . "' style='width:100%'>";
    echo "<div class='card-body'>";
    echo "<h4 class='card-title'>" . $row["title"] . "</h4>";
    echo "<p class='card-text'>" . $row["description"] . "</p>";
    echo "<a href='updatepost.php?id=" . $row["ID"] . "' class='btn btn-primary'>Update Post</a>";
    echo "&nbsp;&nbsp";
    echo "<a href='deletepost.php?id=" . $row["ID"] . "' class='btn btn-danger'>Delete Post</a>";
    echo "&nbsp;&nbsp;";
    echo "<a href='commentap.php?id=" . $row["ID"] . "' class='btn btn-warning'>Comments</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "<br>";
    echo "<br>";
}
echo "</div>";
echo "</div>";
echo "<br>";
echo "<br>";

?>