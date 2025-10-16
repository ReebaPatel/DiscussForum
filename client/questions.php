<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="heading">Questions</h1>
            <?php
            include("./common/db.php");

            // Determine query based on GET parameters
            if (isset($_GET["c-id"])) {
                $cid = (int)$_GET["c-id"];
                $query = "SELECT * FROM questions WHERE category_id=$cid";
            } else if (isset($_GET["u-id"])) {
                $uid = (int)$_GET["u-id"];
                $query = "SELECT * FROM questions WHERE user_id=$uid";
            } else if (isset($_GET["latest"])) {
                $query = "SELECT * FROM questions ORDER BY id DESC";
            } else if (isset($_GET["search"])) {
                $search = $conn->real_escape_string($_GET["search"]);
                $query = "SELECT * FROM questions WHERE `title` LIKE '%$search%'";
            } else {
                $query = "SELECT * FROM questions";
            }

            // Run the query safely
            $result = $conn->query($query);

            if (!$result) {
                echo "<p>Error fetching questions: " . $conn->error . "</p>";
            } elseif ($result->num_rows === 0) {
                echo "<p>No questions found.</p>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $title = htmlspecialchars($row['title']);
                    $id = $row['id'];
                    $user_id = $row['user_id'];
                    echo "<div class='row question-list'>
                            <h4 class='my-question'>
                                <a href='?q-id=$id'>$title</a> ";
                    // Only show delete link if $uid is set and matches
                    if (isset($_SESSION['user']['username']) && $_SESSION['user']['id'] == $user_id) {
                        echo "<a href='./server/requests.php?delete=$id'>Delete</a>";
                    }
                    echo "</h4></div>";
                }
            }
            ?>
        </div>
        <div class="col-4">
            <?php include('categorylist.php'); ?>
        </div>
    </div>
</div>
