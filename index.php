<?php
session_start();

if (isset($_POST['login'])){

    //connect to database
    require_once 'db.php';

    //define variables
    $email = mysqli_real_escape_string($dbcon, $_POST['email']);
    $password = mysqli_real_escape_string($dbcon, $_POST['password']);



    if ($dbcon === false) {
        die("Error: Could not connect to database" . mysqli_connect_error());
    }

    //run query and select user and check combination is in same row
    $sql = "SELECT email, password, user_cat FROM users WHERE email = '$email'";
    $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            if (password_verify($password, $row['password'])) {
                //return true;
                $_SESSION['email'] = $email; //initiate session
                header('Location: students.php'); //redirect upon success
            } else {
                //return false;
                session_destroy();

            }
        }
    }
}

//    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//    $active = $row['active'];
//    $count = mysqli_num_rows($result);
//    if ($count == 1) {

//    $_SESSION['sessid'] = $email; //initiate session
//    header('Location: students.php'); //redirect upon success

//} else {
//    session_destroy();
//}
//}
//;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>resshare - Review research papers in teams</title>
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
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="#">resshare</a>
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
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <br><br>

                <div class="card card-body login-card">
                    <h3>Login to resshare</h3>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                        <p>Enter your Email<br>
                        <input type="text" name="email" placeholder="email address" required class="form-control"></p>
                        </div>
                            <!-- <span class="error"><?php echo $emailErr;?></span> -->
                        <div class="form-group">
                        <p>Enter your Password<br>
                            <input type="password" name="password" placeholder="password" required class="form-control"></p>
                            <!-- <span><?php echo $passwordErr ;?></span> -->
                        </div>
                        <p><button type="submit" name="login" class="btn btn-block btn-dark">Sign in</button></p>
                        <p>No account yet, <a href="signup.php">Sign up now!</a> </p>
                    </form>

                </div>





        </div>

    </div>
</div>



<h1>resshare</h1>




</body>
</html>