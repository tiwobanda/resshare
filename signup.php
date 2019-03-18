<?php
session_start();

if (isset($_POST['login'])){

    //connect to database
    require_once 'db.php';

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
            header('Location: lecturers.php');

        } else {
           header('Location: students.php');
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
<h1>resshare</h1>
<h3>Sign up to resshare</h3>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <p>User category <select name="user_cat">
            <option value="Student">Student</option>
            <option value="Lecturer">Lecturer</option>
        </select>
    </p>
    <p>Email: <input type="text" name="email" required></p>
        <!-- <span class="error"><?php echo $emailErr;?></span> -->
    <p>Password: <input type="password" name="password" required></p>
        <!-- <span><?php echo $passwordErr ;?></span> -->

    <p>First name: <input required name="fname">   </p>
    <p>Last name: <input required name="lname">   </p>

        <button name="login">Sign up</button>
</form>



</body>
</html>