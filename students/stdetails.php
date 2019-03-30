<?php
session_start();

if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
    }

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
    $lname = mysqli_real_escape_string($dbcon, $_POST['lname']);
    $email = $_SESSION['email'];

    require_once '../scripts/db.php';
    if ($dbcon === false) {
        die("Error: Could not connect to database" . mysqli_error());
    } else {
        $sql = "INSERT INTO students (fname, lname, email) VALUES ('$fname', '$lname', '$email')";
        if (mysqli_query($dbcon, $sql)) {
            header ('Location: students.php');
        } else {
            echo "Error: could not execute" . mysqli_error();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>resshare - Enter personal details</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

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
require "../nav-bar.php";
?>
<div class="container">
    <br><br><br><br><br><br>
    <div class="row">

        <div class="col-md-6">

            <h2>Well done! Your account is almost ready.</h2>
            <a>Please enter your personal details</a>
        </div>
        <div class="col-md-6">


            <div class="card card-body">


<h3>Please enter your personal details</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <p>First name: <br> <input required name="fname" class="form-control">   </p>
    <p>Last name: <br> <input required name="lname" class="form-control">   </p>
    <button type="submit" name="submit" class="btn btn-block btn-dark">Submit</button>

</form>

            </div>
        </div>
</body>
</html>