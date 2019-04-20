<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}

//db connection
require_once '../scripts/db.php';

if ($dbcon === false) {
    die("Error: Could not connect to database" . mysqli_connect_error());
}

$student_id = $_SESSION['student_id']


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Papers - resshare</title>
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
require "nav-bar-students.html";
?>
</header>

<main>

<div class="container">
    <div class="jumbotron">
        <h2>Students' Portal</h2>

    </div>
    <div class="row">
        <div class="col-md-3">
            <!--Load side bad-->
            <?php
            require "side-students.php";
            ?>
            <!--side bar end-->
        </div>
        <div class="col-md-9">
            <h3 class="text-info">My Papers</h3>

            <hr>

<div class="row">

    <div class="col-md-6">
        <div id="sidebside">
        <h6>Papers Uploaded by Me</h6>

        <?php

        $sql = "SELECT pp_id, pp_title, pp_author, grp_id, path, reviewer FROM papers WHERE student_id = '$student_id'";

        $result = mysqli_query($dbcon, $sql)or die ("Bad Query: $sql");

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {
                echo "<h6>" . "<a href='group-papers.php?pid={$row['pp_id']}'>" . $row['pp_title']   .  " by " . $row['pp_author'] . "</a>" . "<h6>";

            }
        } else {
            echo "You have not uploaded a paper yet.";
        }


        ?>
        </div>
    </div>

    <div class="col-md-6">
        <div id="sidebside">
        <h6>My Paper Review Assignments</h6>
            <?php
            $query = "SELECT pp_id, pp_title, pp_author, grp_id, path FROM papers WHERE reviewer = $student_id";

            $result2 = mysqli_query($dbcon, $query)or die ("Bad Query: $sql");

            if (mysqli_num_rows($result2) > 0) {

                while ($row2 = mysqli_fetch_array($result2)){
                    echo $row2['pp_title'] . "<br>". " by " . $row2['pp_author'] . "<br>";
                    echo "<a href='../uploads/{$row2['path']}'>Download</a>" . '&nbsp; &nbsp;' . "<a href='review.php?pid={$row2['pp_id']}'>Review</a>";


                }
            }else {
                echo "You do not have a new paper assignment.";
            }



            ?>
        </div>
<br>
        <div id="sidebside">
            <h6>Papers I have Reviewed</h6>
        </div>

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

