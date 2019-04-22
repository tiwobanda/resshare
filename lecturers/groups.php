<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}

    require_once '../scripts/db.php'; # connect to database

    if ($dbcon === false) {
        die ("Error: could not connect. " . mysqli_connect_error()); # check connection status
    }

    $query = "SELECT * FROM groups"; # select groups

    $result = mysqli_query($dbcon, $query); # check is successful
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Groups - resshare</title>
    <link rel="stylesheet" type="text/css" href="../css/style-all.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>

<header>
<?php
require "nav-bar-lecturers.html";
?>
</header>
<main>
<div class="container">
    <div class="jumbotron">
        <h2>Lecturers' Portal</h2>

    </div>
    <div class="row">
        <div class="col-md-3">

            <?php
            require ('side-lecturers.php')
            ?>

        </div>
        <div class="col-md-9">
            <h3 class="text-info">Groups</h3>
<hr>
            <?php

            if (mysqli_num_rows($result) > 0) {
                echo '<p>Available Student Groups</p>';
                while ($row = mysqli_fetch_array($result)) {
                    echo "<p>" .  "<a href='group-pages.php?id={$row['grp_id']}'>" . $row['grp_name'] . "</a>". "<p>";
                }
            }else {
                echo 'No groups have been created. <a href="create.php">Create Group</a>' ;
            }


            ?>


        </div>
    </div>
</div>


</main>
<footer>

    <?php require "../footer.html" ?>
</footer>
</body>
</html>
