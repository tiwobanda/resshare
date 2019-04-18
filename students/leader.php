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
            <div class="card">
                <div class="card-header">Details</div>
                <div class="card-body">
                <p>Name: <?php echo $row['fname'] . " " . $row['lname']?></p>
                <p>Email: <?php echo $row['email'] ?></p>
                <p>Group: <?php echo $row['grp_name'] ?></p>
            </div>
            </div>
            <br>
            <div>
                <h5>Operations</h5>
                <ul>
                    <li><a href="mygroup.php">My Group</a></li>
                    <li><a href="allocate.php">Allocate Papers</a></li>
                    <li><a href="upload.php">Upload Paper</a></li>
                </ul>

            </div>
        </div>
        <div class="col-md-9">
            <h3>My Dashboard</h3>
            <hr>
        </div>
    </div>
</div>
<?php require "../footer.html" ?>

</body>
</html>