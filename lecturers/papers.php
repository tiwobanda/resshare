<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lecturer  Dashboard - resshare</title>
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
            <h3 class="text-info">Papers</h3>

            <hr>

            <?php
            require_once '../scripts/db.php';

            if ($dbcon === false) {
                die("Error: Could not connect to database" . mysqli_connect_error());
            }

            $sql3 = "SELECT p.pp_id, p.pp_title, p.student_id, p.path, p.date, p.pp_author, s.fname, s.lname
            FROM papers p
            INNER JOIN students s ON p.student_id = s.student_id";

            $result3 = mysqli_query($dbcon, $sql3)or die ("Bad Query: $sql3");

            $row3 = mysqli_fetch_array($result3);



            $result3 = mysqli_query($dbcon, $sql3);

            if (mysqli_num_rows($result3) > 0) {
            while ($row3 = mysqli_fetch_array($result3)) {

            echo "<div class='card'>";
                $update = date_create($row3['date']);

                echo "<div class='card-header' id='card-reduced-pad'>" . "<a href='group-papers.php?pid={$row3['pp_id']}'>" . $row3['pp_title'] . " by " . $row3['pp_author'] . "</a>" . "</div>";

                echo "<div class='card-body' id='card-reduced-pad'>" . "Uploaded by: " . $row3['fname'] . " " . $row3['lname'] . " on " . date_format($update, 'd-m-Y') . "</div>";


                echo "</div>" . "<br>";

            }

            echo "<br";
            }else {
            echo 'There are no papers uploaded in your class yet' ;
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
