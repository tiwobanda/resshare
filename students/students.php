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
    <link rel="stylesheet" type="text/css" href="style.css">

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
<h4>Student Dashboard</h4>
<div class="container">
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>

    </div>
</div>

</body>
</html>