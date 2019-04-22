<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}

require_once '../scripts/db.php';

if ($dbcon === false) {
    die("Error: Could not connect to database" . mysqli_connect_error());
}

$grp_id = $_SESSION['grp_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students' Dashboard - resshare</title>
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
            <h3 class="text-info">My Group: <?php echo $_SESSION['grp_name'] ?></h3>

            <hr>

            <div class="row">
                <div class="col-md-8">

                    <!-- query and display group papers -->

                    <h6>My Group Papers </h6>
                    <?php
                    if ($grp_id == FALSE) {
                        echo "You have not been assigned a group. Wait for your Lecturer to allocate you.";

                    } else {

                    $sql = "SELECT p.*, s.student_id, s.fname, s.lname, s.grp_id
                    FROM papers p JOIN students s
                    ON p.grp_id = s.grp_id AND p.grp_id = $grp_id AND p.student_id = s.student_id
                    ORDER BY p.grp_id";

                    $result2 = mysqli_query($dbcon, $sql);

                    if (mysqli_num_rows($result2) > 0) {


                        while ($row2 = mysqli_fetch_array($result2)) {
                            echo "<div class='card'>";

                            $update = date_create($row2['date']);

                            echo "<div class='card-header' id='card-reduced-pad'>" . "<a href='group-papers.php?pid={$row2['pp_id']}'>" . $row2['pp_title'] . " by " . $row2['pp_author'] . "</a>" . "</div>";
                            echo "<div class='card-body' id='card-reduced-pad'>" . " Uploaded by " . $row2['fname'] .  " " . $row2['lname'] . " on " . date_format($update, 'd-m-Y') . "</div>";
                            echo "</div>" . "<br>";

                        }

                        echo "<br";
                    }else {
                        echo 'There are no papers uploaded in your group yet' ;
                    }
                    }

                    ?>
        <!--end of group papers display -->

                </div>

                <div class="col-md-4">

                    <!-- group members query and display -->

                    <?php require 'grp-members.php' ?>

                </div>
                <!-- end group members display -->

            </div>



        </div>
            <div>


            </div>
        </div>
    </div>



</main>
<footer>

    <?php require "../footer.html" ?>
</footer>
</body>
</html>
