<?php
session_start();
$grp_name_session = $_SESSION['grp_name_session'];

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
        <title>Add Members - resshare</title>
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
                <?php
                require ('side-lecturers.php')
                ?>
            </div>
            <div class="col-md-9">
                <h3 class="text-info">Add Members to <?php echo $grp_name_session ?></h3>
                <hr>

                <a>Creating a group takes 3 easy steps</a>
                <br>
                <br>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">

                        <p>2. Select Students from List below.</p>
                        <p>Hold Ctlr Key to Select Multiple Students. Students listed here do not belong to any Group.</p>
                        <p>
                            <?php
                            echo "<select size='10' name='members[]' required class='form-control' multiple='multiple'>";
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['student_id'] . '">'  . $row['fname'] . " " . $row['lname'] .  '</option>';
                            }
                            echo "</select>";
                            $student_id = $row['student_id']
                            ?>
                        </p>

                        <p> <button class=" btn btn-block btn-info form-control" type="submit" name="add_members">Next</button></p>
                    </div>
                </form>
<?php
                if (isset($_POST['add_members'])){

                    //connect to database
                    require_once '../scripts/db.php';

                    if ($dbcon === false) {
                        die ("Error: could not connect. " . mysqli_connect_error());
                    }

                $members = $_POST['members'];

                $grp_id_query = "SELECT * FROM groups WHERE grp_name = '$grp_name_session'";

                $grp_id_result = mysqli_query($dbcon, $grp_id_query) or die ("Bad Query: $grp_id_query");

                $row2 = mysqli_fetch_array($grp_id_result);

                $grp_id_from_db = $row2['grp_id'];

                foreach ($members as $student_id) {

                    mysqli_query($dbcon,"UPDATE students SET grp_id = '$grp_id_from_db' WHERE student_id = $student_id");

                }
                $_SESSION['group_id_session'] = $grp_id_from_db;
                header('Location: choose-leader.php');

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
