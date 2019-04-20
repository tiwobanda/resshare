<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}



if (isset($_POST['submit'])){

    //db connection
    require_once '../scripts/db.php';

    if ($dbcon === false) {
        die("Error: Could not connect to database" . mysqli_connect_error());
    }

    $pp_id = $_POST['pp_id'];
    $review_text = $_POST['review'];
    $grp_id = $_SESSION['grp_id'];
    $student_id = $_SESSION['student_id'];

    $insert = "INSERT INTO reviews (pp_id, review, student_id, grp_id)
                VALUES ($pp_id, '$review_text', $student_id, $grp_id)";

    $insert_result = mysqli_query($dbcon, $insert) or die("Bad query: $insert");
    header('Location:papers.php');

}
$pp_id = $_GET['pid'];


//$student_id = $_SESSION['student_id']


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review - resshare</title>
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
            <h3 class="text-info">Review a Paper</h3>

            <hr>

            <?php
            //db connection
            require_once '../scripts/db.php';

            if ($dbcon === false) {
                die("Error: Could not connect to database" . mysqli_connect_error());
            }
            $sql = "SELECT pp_id, pp_title, pp_author, grp_id, path, reviewer FROM papers WHERE pp_id = '$pp_id'";

            $result = mysqli_query($dbcon, $sql)or die ("Bad Query: $sql");

            $row = mysqli_fetch_array($result);

            echo "<h6>" . $row['pp_title'] . "<br>". " by " . $row['pp_author'] . "<h6>";

            ?>
            <br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <p>Type your review in the box below and click Submit</p>
                    <p><textarea type="text" name="review" class="form-control"></textarea></p>
                    <input type="hidden" name="pp_id" value="<?php echo $pp_id?>">
                    <p> <button class=" btn btn-block btn-info" type="submit" name="submit">Submit Review</button></p>
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

