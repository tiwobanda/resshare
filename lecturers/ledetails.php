<?php
session_start();

if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
$email = $_SESSION['email'];
if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    #$email = $_SESSION['email'];
    $school = $_POST['school'];

    require_once '../scripts/db.php';
    if ($dbcon === false) {
        die("Error: Could not connect to database" . mysqli_error());
    } else {


        $sql = "INSERT INTO lecturers (title, fname, lname, email, school) VALUES ('$title', '$fname', '$lname', '$email', '$school')";
        if (mysqli_query($dbcon, $sql)) {
            header ('Location: lecturers.php');
        } else {
            echo "Error: could not execute " . mysqli_error($dbcon);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lecturer details - resshare</title>
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
<h3>Welcome</h3>
<p>You have created your account. Now you need to complete your profile so that we set things up for you.</p>

<p>Please enter your personal details</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <p>Title: <select name="title" required>
            <option value="Prof">Prof</option>
            <option value="Dr">Dr</option>
            <option value="Mr">Mr</option>
            <option value="Ms">Ms</option>
            </select></p>

    <p>First name: <input required name="fname">   </p>
    <p>Last name: <input required name="lname">   </p>
    <p>School: <input required name="school"></p>
    <button name="submit">Submit</button>

</form>

<?php
echo $email;

?>
</body>
</html>