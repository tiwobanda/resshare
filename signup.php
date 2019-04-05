<?php
session_start();

if (isset($_POST['signup'])){

    //connect to database
    require 'scripts/db.php';

    $email = mysqli_real_escape_string($dbcon, $_POST['email']);
    $password = mysqli_real_escape_string($dbcon, $_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $user_cat = $_POST['user_cat'];
    #$fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
    #$lname = mysqli_real_escape_string($dbcon, $_POST['lname']);

    if ($dbcon === false) {
        die("Error: Could not connect to database" . mysqli_connect_error());
    } else {

    //run query and select user and check combination is in same row
    $sql = "INSERT INTO users (email, password, user_cat)  VALUES ('$email', '$password', '$user_cat')";
    if (mysqli_query($dbcon, $sql)) {


        if ($user_cat == "Lecturer") {
            header('Location: lecturers/ledetails.php');

        } elseif ($user_cat == "Student") {

               header('Location: students/stdetails.php');
        } else {
            echo "Invalid user category!";
        }

        $_SESSION['email'] = $email;
        $_SESSION['user_cat'] = $user_cat;
    } else{
        echo "Error: Could not execute." . mysqli_error();

    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>resshare - Sign up</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<?php
require "nav-bar.php";
?>
<div class="container">
    <br><br><br><br><br><br>
    <div class="row">

        <div class="col-md-6">

            <h2>Let's set up your resshare account. </h2>
            <a>Fill in the form on the right.</a></p>
        </div>
        <div class="col-md-6">


            <div class="card card-body">
    <h3>Sign up to resshare</h3>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <p>Select your Account type: <select name="user_cat" class="form-control">
            <option value="Student">Student</option>
            <option value="Lecturer">Lecturer</option>
        </select>
    </p>
    <p>Your email address: <input type="text" name="email" required class="form-control"></p>
        <!-- <span class="error"><?php echo $emailErr;?></span> -->
    <p>Your password: <input type="password" name="password" required class="form-control"></p>
        <!-- <span><?php echo $passwordErr ;?></span> -->

    <!--<p>Your first name: <input required name="fname" class="form-control">   </p>
    <p>Your last name: <input required name="lname" class="form-control">   </p> -->

        <button type="submit" name="signup" class="btn btn-block btn-dark">Sign up</button>
</form>
    </div>
        </div>
</div>
</div>

</body>
</html>