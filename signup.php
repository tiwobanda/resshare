<?php
session_start();

if (isset($_POST['login'])){

    //connect to database
    require_once 'scripts/db.php';

    $email = mysqli_real_escape_string($dbcon, $_POST['email']);
    $password = mysqli_real_escape_string($dbcon, $_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $user_cat = mysqli_real_escape_string($dbcon, $_POST['user_cat']);
    $fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
    $lname = mysqli_real_escape_string($dbcon, $_POST['lname']);


    if ($dbcon === false) {
        die("Error: Could not connect to database" . mysqli_connect_error());
    } else {

    //run query and select user and check combination is in same row
    $sql = "INSERT INTO users (email, password, fname, lname, user_cat)  VALUES ('$email', '$password', '$fname', '$lname', '$user_cat')";
    if (mysqli_query($dbcon, $sql)) {
        $_SESSION['email'] = array($email, $user_cat);

        if ($user_cat = "Lecturer") {
            header('Location: lecturers/lecturers.php');

        } else {
           header('Location: students/students.php');
        }


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

<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="index.php">resshare</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>
</nav>
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

    <p>Your first name: <input required name="fname" class="form-control">   </p>
    <p>Your last name: <input required name="lname" class="form-control">   </p>

        <button type="submit" name="login" class="btn btn-block btn-dark">Sign up</button>
</form>
    </div>
        </div>
</div>
</div>

</body>
</html>