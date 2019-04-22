<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - resshare</title>
    <link rel="stylesheet" type="text/css" href="css/style-.css">

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
    <br><br><br><br><br><br>
    <div class="row">

        <div class="col-md-6">

<h2>Resshare helps teams collaborate in sharing and reviewing research papers. </h2>



<p>
    Resshare is a collaboration app that helps teams work together in sharing and reviewing research papers. Lectures
    create Groups and sets a Team Leader. Students upload papers and the Team Leader allocates papers to members of the
    Group to review. All see the papers and learn from each other’s review. </p>
<p>
    We know that it can be difficult for group members to keep up-to-date with the research papers that have been identified and which ones they should be reviewing. With resshare, it it is so simple.

</p>





        </div>
        <div class="col-md-6">
            <img src="../img/unsplash.jpg" width="100%">
        </div>


    </div>

</div>


</main>
<footer>
    <?php require "../footer.html" ?>
</footer>

</body>
</html>