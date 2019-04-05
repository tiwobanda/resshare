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
    <title>Students' Dashboard - resshare</title>
    <!--<link rel="stylesheet" type="text/css" href="../css/style.css"> -->

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
<?php
require "nav-bar-students.html";
?>
<div class="container">
    <div class="jumbotron">
        <h2>Students' Portal</h2>

    </div>
    <div class="row">
        <div class="col-md-3">
            <h3>Dashboard</h3>
            <div>
                <h5>Details</h5>
                <p>Name: <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']?></p>
                <p>Email: <?php echo $_SESSION['email'] ?></p>
                <p>Group: <?php echo $_SESSION['grp_name'] ?></p>
            </div>
            <div>
                <h5>Operations</h5>
                <ul>
                    <li><a href="mygroup.php">My Group</a></li>
                    <li><a href="upload.php">Upload Paper</a></li>
                </ul>

            </div>
        </div>
        <div class="col-md-9">
            <h3>My Group</h3>

            <hr>

            <h5>My Group Members </h5>

            <?php

            require_once '../scripts/db.php';

            if ($dbcon === false) {
                die("Error: Could not connect to database" . mysqli_connect_error());
            }
            $grp_id = $_SESSION['grp_id'];

            $query = "SELECT fname, lname, student_role 
            FROM students  
            WHERE grp_id = '$grp_id'
            ORDER BY student_role DESC";

            $result = mysqli_query($dbcon, $query);

            if (mysqli_num_rows($result) > 0) {

                echo "<ul>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<li>" .  $row['fname'] . " " . $row['lname']." " . $row['student_role'] . "</li>";
                }
                echo "</ul>";
            }else {
                echo 'There is no one in your group</a>' ;
            }


            echo '<h5>My Group Papers </h5>';

            $sql = "SELECT * 
                    FROM papers
                    WHERE grp_id = '$grp_id'
                    ORDER BY date DESC";

            $result2 = mysqli_query($dbcon, $sql);

            if (mysqli_num_rows($result2) > 0) {


                while ($row2 = mysqli_fetch_array($result2)) {
                    echo "<p>" .  $row2['pp_title'] . "</p>";
                }

            }else {
                echo 'There are no papers uploaded in your group yet' ;
            }



            ?>


        </div>
    </div>
</div>

</body>
</html>