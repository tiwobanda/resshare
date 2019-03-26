<?php
session_start();

if (!isset($_SESSION['email'])){
    header('Location: index.php');
    }

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
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
    <title>resshare - Enabling groups to share and review research papers</title>
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
<h1>resshare</h1>
<h3>Welcome</h3>
<p>You have created your account. Now you need to complete your profile so that we set things up for you.</p>

<p>Please enter your personal details</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <p>First name: <input required name="fname">   </p>
    <p>Last name: <input required name="lname">   </p>
    <button name="submit">Submit</button>

</form>


</body>
</html>