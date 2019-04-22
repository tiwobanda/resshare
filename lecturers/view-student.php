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

$student_id=$_GET['sid'];

$student_name = $_SESSION['student_name'];

$query4 = "SELECT * FROM students WHERE student_id = $student_id";


$result4 = mysqli_query($dbcon, $query4);
$row4 = mysqli_fetch_array($result4);


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

            <?php
            require ('side-lecturers.php')
            ?>

                    </div>
        <div class="col-md-9">
            <h3 class="text-info">Student: <?php echo $row4['fname']. " " .$row4['lname'] ?></h3>
            <hr>
            <div class="row">

                <div class="col-md-6">
                    <div id="sidebside">
                        <h6>Papers Uploaded by Student</h6>

                        <?php

                        $sql = "SELECT pp_id, pp_title, pp_author, grp_id, path, reviewer FROM papers WHERE student_id = '$student_id'";

                        $result = mysqli_query($dbcon, $sql)or die ("Bad Query: $sql");

                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<h6>" . "<a href='group-papers.php?pid={$row['pp_id']}'>" . $row['pp_title']   .  " by " . $row['pp_author'] . "</a>" . "<h6>";

                            }
                        } else {
                            echo "Student has not uploaded a paper yet.";
                        }


                        ?>
                    </div>
                </div>

                <div class="col-md-6">

                    </div>
                    <br>
                    <!--<div id="sidebside">
                        <h6>Papers I have Reviewed</h6>
                    </div>-->

                </div>

            </div>

        </div>
    </div>
</div>


</main>
<footer>

    <?php require "../footer.html" ?>
</footer>
</body>
</html>
