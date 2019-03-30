<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
//connect to database
require '../scripts/db.php';
if ($dbcon === false) {
    die ("Error: could not connect. " . mysqli_connect_error());
}
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
                    <p>Select students to add to Group. Hold Ctlr key to select multipple students.</p>
<p>
                    <?php
                    echo "<select size='10' name='members[]' required class='form-control' multiple='multiple'>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo '<option value="' . $row['student_id'] . '">'  . $row['fname'] . " " . $row['lname'] . '</option>';
                    }
                    echo "</select>";
                    $student_id = $row['student_id']
                    ?>
</p>

                   <p> <button class=" btn btn-block btn-dark form-control" type="submit" name="create">Create Group</button></p>
                </div>
            </form>




        </div>
    </div>
</div>


</body>
</html>

<?php
if (isset($_POST['create'])){

    $grp_name = mysqli_real_escape_string($dbcon, $_POST['grp_name']);
    $members = $_POST['members'];

    $query = "INSERT INTO groups (grp_name) VALUES ('$grp_name')";

        if (mysqli_query($dbcon, $query)) {
            $get_grp_id = "SELECT * FROM groups WHERE grp_name == $grp_name";

            $grp_id_result = mysqli_query($dbcon, $get_grp_id) or die ("Bad Query: $get_grp_id");
            $row2 = ($row2 = mysqli_fetch_array($grp_id_result));
            $grp_id_from_db = $row2['grp_id'];


            foreach ($members as $student_id) {
                mysqli_query("INSERT INTO grp_members (grp_id, student_id) VALUES ($grp_id_from_db, $student_id)");
            }

            header('Location: choose-leader.php');
        }
}
?>