<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
//connect to database
require '../scripts/db.php';

    $sql= "SELECT * FROM students WHERE grp_id IS NULL";
    $result = mysqli_query($dbcon, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lecturer  Dashboard - resshare</title>
    <link rel="stylesheet" type="text/css" href="..css/style.css">

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
require "nav-bar-lecturers.html";
?>

<div class="container">
    <div class="jumbotron">
        <h2>Lecturer</h2>

    </div>
    <div class="row">
        <div class="col-md-3">
            <h3>Dashboard</h3>
            <div>
                <h5>Details</h5>
                <p>Name: </p>
                <p>Email:</p>
            </div>
            <div>
                <h5>Operations</h5>
                <ul>
                    <li>Create Groups</li>
                    <li>View Groups</li>
                </ul>

            </div>
        </div>
        <div class="col-md-9">
            <h4>Create a Group</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <p>Name of Group:</p>
                    <p><input type="text" name="grp_name"  required class="form-control"></p>
                    <p>Select students to add to Group</p>

                        <?php
                        echo "<select size = 10>";
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                            echo '<option value="' . $row['student_id'] . '">'  . $row['fname'] . " " . $row['lname'] . '</option>';


                            #$select.='</select>';

                        }
                        echo "<select>";
                        ?>



                        <button>Add</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>