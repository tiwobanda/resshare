<?php
session_start();

if (isset($_POST['login'])){

    //connect to database
    require_once 'scripts/db.php';

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

                $_SESSION['user_cat'] = $row['user_cat'];

                if ($row['user_cat'] == "Student") {
                    header('Location: students/students.php?'); //redirect upon success
                }else{
                    header('Location: lecturers/lecturers.php?'); //redirect upon success
                }


            } else {
                //return false;
                echo "Username or password is not correct";
                session_destroy();

            }
        }
    }
}

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
<?php
require "nav-bar.php";
?>

<div class="container">
    <br><br><br><br><br><br>
    <div class="row">

        <div class="col-md-6">

<h2>Resshare helps teams collaborate in sharing and reviewing research papers. </h2>
            <a>Create teams, share research papers with your team and submit reviews  - all in one place. <href ="#">Find out more.</a></p>
        </div>
        <div class="col-md-6">


                <div class="card card-body">
                    <h3>Login to resshare</h3>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                        <p>Enter your Email<br>
                        <input type="text" name="email" required class="form-control"></p>
                        </div>
                            <!-- <span class="error"><?php echo $emailErr;?></span> -->
                        <div class="form-group">
                        <p>Enter your Password<br>
                            <input type="password" name="password" required class="form-control"></p>
                            <!-- <span><?php echo $passwordErr ;?></span> -->
                        </div>
                        <p><button type="submit" name="login" class="btn btn-block btn-info">Sign in</button></p>
                        <p>No account yet, <a href="signup.php">Sign up now!</a> </p>
                    </form>

                </div>





        </div>

    </div>

</div>


</body>
</html>
