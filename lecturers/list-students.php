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

$query = "SELECT * FROM students"; # select groups

$result = mysqli_query($dbcon, $query); # check is successful
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students - resshare</title>
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
            <h3>Dashboard</h3>
            <div>
                <h5>Details</h5>
                <p>Name: </p>
                <p>Email:</p>
            </div>
            <div>
                <h5>Operations</h5>
                <ul>
                    <li><a href="create.php">Create Groups</a></li>
                    <li><a href="groups.php">View Groups</a></li>

                </ul>

            </div>
        </div>
        <div class="col-md-9">
            <h4>Students in Class</h4>
            <?php

            if (mysqli_num_rows($result) > 0) {
                echo '<p>Students enrolled for this class</p>';
                #echo "<ol>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<p>" . $row['fname'] . " " . $row['lname'] . "</p>";
                }
                #echo  "</ol>";
            }else {
                echo 'There are no students enrolled for this Class</a>' ;
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
