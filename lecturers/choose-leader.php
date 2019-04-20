<?php
session_start();
$grp_name_session = $_SESSION['grp_name_session'];
$group_id = $_SESSION['group_id_session'];

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

$sql= "SELECT * FROM students WHERE grp_id = '$group_id'";

$result = mysqli_query($dbcon, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Group Leader - resshare</title>
    <link rel="stylesheet" type="text/css" href="../css/style-all.css">

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

<header>
<?php
require "nav-bar-lecturers.html";
?>
</header>
<main>
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
            <h4>Choose Leader for <?php echo $grp_name_session ?></h4>

            <a>Creating a group takes 3 easy steps</a>
            <br>
            <br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">

                    <p>3. Choose Group Leader</p>
                    <p>Select one Member to become Group Leader.</p>
                    <p>
                        <?php
                        echo "<select size='5' name='leader_id' required class='form-control'>";
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo '<option value="' . $row['student_id'] . '">'  . $row['fname'] . " " . $row['lname'] . '</option>';
                        }
                        echo "</select>";

                        ?>
                    </p>

                    <p> <button class=" btn btn-block btn-dark form-control" type="submit" name="create_group">Create Group</button></p>
                </div>
            </form>

            <?php

            if (isset($_POST['create_group'])){

                //connect to database
                require_once '../scripts/db.php';

                if ($dbcon === false) {
                    die ("Error: could not connect. " . mysqli_connect_error());
                }

                $leader_id = $_POST['leader_id'];

                    $query = "UPDATE students SET student_role = 'Group Leader' WHERE student_id = $leader_id";
                    $query_result = mysqli_query($dbcon,$query) or die($query);

                header('Location: groups.php');

            }

            ?>

        </div>
    </div>
</div>


</main>
<footer>

    <?php require "../footer.html" ?>
</footer>
</body>
</html>
