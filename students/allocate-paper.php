<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}




//db connection
require_once '../scripts/db.php';

if ($dbcon === false) {
    die("Error: Could not connect to database" . mysqli_connect_error());
}


$grp_id = $_SESSION['grp_id'];

//Insert student_id into papers for the selected reviewer
if(isset($_POST['reviewer'])) {

    $pp_id = $_POST['pp_id'];
    //connect to database
    require_once '../scripts/db.php';

    if ($dbcon === false) {
        die ("Error: could not connect. " . mysqli_connect_error());
    }
    $reviewer_id = $_POST['reviewer_id'];

    $insert = "UPDATE papers 
                SET reviewer = $reviewer_id
                WHERE pp_id = $pp_id";
    $insert_result = mysqli_query($dbcon, $insert);
echo $reviewer_id;
    header('Location: allocate.php');

}
//END

$pp_id = $_GET['pid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Allocate Papers - resshare</title>
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
require "nav-bar-students.html";
?>
</header>

<main>
<div class="container">
    <div class="jumbotron">
        <h2>Students' Portal</h2>

    </div>
    <div class="row">
        <div class="col-md-3">
            <!--Load side bad-->
            <?php
            require "side-students.php";
            ?>
            <!--side bar end-->
        </div>
        <div class="col-md-9">
            <h3 class="text-info">Allocate Papers: <?php echo $_SESSION['grp_name'] ?></h3>

            <hr>


            <div>


            <?php

            $sql = "SELECT pp_id, pp_title, pp_author, grp_id, path, reviewer FROM papers WHERE pp_id = '$pp_id'";

            $result2 = mysqli_query($dbcon, $sql)or die ("Bad Query: $sql");

            $row2 = mysqli_fetch_array($result2);

            echo "<h6>" . $row2['pp_title'] . " by " . $row2['pp_author'] . "<h6>";


            ?>
                <br>
                <p>Select Student to allocate paper to</p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                        <p>

                        <?php

                    $select = "SELECT student_id, fname, lname 
                                FROM students 
                                WHERE grp_id = '$grp_id'";

                        $result3 = mysqli_query($dbcon, $select) or die("Bad query: $select");

                        //$row3 = mysqli_num_rows($result3);
                       echo "<select size='5' name='reviewer_id' required class='form-control'>";

                            while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row3['student_id'] . '">'  . $row3['fname'] . " " . $row3['lname'] . '</option>';

                        }
                        echo "</select>";
                        ?>
                        </p>
                        <input type="hidden" name="pp_id" value="<?php echo $pp_id?>">
                        <p> <button class=" btn btn-block btn-info form-control" type="submit" name="reviewer">Allocate Paper to Selected Student</button></p>
                    </div>

                </form>

            </div>
        </div>
    </div>


</div>
</main>
<footer>

    <?php require "../footer.html" ?>
</footer>
</body>
</html>

