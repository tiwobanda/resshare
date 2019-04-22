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
    $session_email = $_SESSION['email'];

if ($dbcon === false) {
    die("Error: Could not connect to database" . mysqli_connect_error());
}

$query = "SELECT a.*, b.* 
            FROM students a, groups b 
            WHERE a.grp_id = b.grp_id AND a.email = '$session_email'";
    $result = mysqli_query($dbcon, $query);
    $row = mysqli_fetch_array($result);

$_SESSION['student_id'] = $row['student_id'];
$_SESSION['fname'] = $row['fname'];
$_SESSION['lname'] = $row['lname'];
#$_SESSION['$email'] = $row['email'];
$_SESSION['grp_name'] = $row['grp_name'];
$_SESSION['grp_id'] = $row['grp_id'];





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
                <?php

                $grp_id = $_SESSION['grp_id'];

                if ($grp_id == TRUE) {

                    ?>
                    <!--            <h3 class="text-info">Dashboard</h3>-->

                    <div class="card">
                        <div class="card-header bg-info"><h5>Details</h5></div>
                        <div class="card-body">
                            <p>Name: <?php echo $row['fname'] . " " . $row['lname']?></p>
                            <!--                <p>Email: --><?php //echo $row['email'] ?><!--</p>-->
                            <p>Group: <?php echo $row['grp_name'] ?></p>
                        </div>
                    </div>

                    <?php
                }
                ?>

                <br>
                <div class="card">
                    <div class="card-header bg-info"><h5>Operations</h5></div>
                    <div class="card-body">
                        <p><a href="mygroup.php">My Group</a></p>
                        <p><a href="upload.php">Upload Paper</a></p>
                        <p><a href="papers.php">My Papers</a></p>
                    </div>

                </div>
            </div>
            <div class="col-md-9">
                <h3 class="text-info">My Dashboard</h3>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h6>Recent Reviews from your Group</h6>
                        <!--query and display reviews -->
                        <?php




                        if ($grp_id == FALSE) {
                            echo "You have not been assigned a group. Wait for your Lecturer to allocate you.";

                        } else {

                            $sql = "SELECT r.rev_id, r.pp_id, r.review, s.fname, s.lname, p.pp_title, p.pp_author, p.date  
                    FROM reviews r
                    INNER JOIN papers p ON r.pp_id = p.pp_id
                    INNER JOIN students s ON r.student_id = s.student_id
                    WHERE r.grp_id = $grp_id";

                            $result2 = mysqli_query($dbcon, $sql);

                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_array($result2)) {

                                    echo "<div class='card'>";
                                    $update = date_create($row2['date']);

                                    echo "<div class='card-header' id='card-reduced-pad'>" . $row2['fname'] . " " . $row2['lname'] . " " . date_format($update, 'd-m-Y') . "</div>";
                                    echo "<div class='card-body' id='card-reduced-pad'>" . "Submitted review to paper: " . "<a href='group-papers.php?pid={$row2['pp_id']}'>" . $row2['pp_title'] . "</a>";
                                    echo  " by " . $row2['pp_author'] . "</div>";
                                    echo "</div>" . "<br>";

                                }

                                echo "<br";
                            }else {
                                echo 'There are no papers uploaded in your class yet' ;
                            }
                        }

                        ?>
                        <!--end query and display reviews -->

                    </div>
                    <div class="col-md-6">
                        <h6>Recent Paper Uploads from your Group</h6>

                        <?php

                        if ($grp_id == FALSE) {
                            echo "You have not been assigned a group. Wait for your Lecturer to allocate you.";

                        } else {

                            $sql3 = "SELECT p.pp_id, p.pp_title, p.student_id, p.path, p.date, p.pp_author, s.fname, s.lname  
                    FROM papers p
                    INNER JOIN students s ON p.student_id = s.student_id
                    
                    WHERE p.grp_id = $grp_id";

                            $result3 = mysqli_query($dbcon, $sql3);

                            if (mysqli_num_rows($result3) > 0) {
                                while ($row3 = mysqli_fetch_array($result3)) {

                                    echo "<div class='card'>";
                                    $update = date_create($row3['date']);

                                    echo "<div class='card-header' id='card-reduced-pad'>" . $row3['fname'] . " " . $row3['lname'] . " " . date_format($update, 'd-m-Y') . "</div>";
                                    echo "<div class='card-body' id='card-reduced-pad'>" . "Uploaded a paper: " . "<a href='group-papers.php?pid={$row3['pp_id']}'>" . $row3['pp_title'] . "</a>";
                                    echo  " by " . $row3['pp_author'] . "</div>";
                                    echo "</div>" . "<br>";

                                }

                                echo "<br";
                            }else {
                                echo 'There are no papers uploaded in your class yet' ;
                            }
                        }

                        ?>

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