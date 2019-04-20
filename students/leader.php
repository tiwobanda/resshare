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


            <!--Load side bad-->
            <?php
            require "side-students.php";
            ?>
            <!--side bar end-->
        </div>
        <div class="col-md-9">
            <h3 class="text-info">My Dashboard</h3>
            <hr>
        </div>
    </div>
</div>
</main>
<footer>
<?php require "../footer.html" ?>
</footer>

</body>
</html>