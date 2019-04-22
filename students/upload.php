<?php
session_start();
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}

#require_once '../scripts/db.php';

if (isset($_POST['submit'])) {


    $student_id = $_SESSION['student_id'];
    $pp_title = $_POST['pp_title'];
    $pp_author = $_POST['pp_author'];
#    $email = $row['email'];
    $grp_name = $_SESSION['grp_name'];
    $grp_id = $_SESSION['grp_id'];

    require_once '../scripts/db.php';
    if ($dbcon === false) {
        die("Error: Could not connect to database" . mysqli_connect_error());
    }


  $fileName=$_FILES["paper"]["name"];
  $fileSize=$_FILES["paper"]["size"]/10024;
  $fileType=$_FILES["paper"]["type"];
  $fileTmpName=$_FILES["paper"]["tmp_name"];

  if($fileType=="application/msword" || "application/pdf") {
    if($fileSize<=2000){

      //New file name
      $random=rand(1111,9999);
      $newFileName=$random.$fileName;

      //File upload path
      $uploadPath="../uploads/".$newFileName;

      //function for upload file
      if(move_uploaded_file($fileTmpName,$uploadPath)){
        echo "Successful";
        echo "File Name :".$newFileName;
        echo "File Size :".$fileSize." kb";
        echo "File Type :".$fileType;

        //write to database on successfull upload
          require_once '../scripts/db.php';
          if ($dbcon === false) {
              die("Error: Could not connect to database" . mysqli_connect_error());
          }

          $sql = "INSERT INTO papers (student_id, pp_title, pp_author, grp_id, path) VALUES ('$student_id', '$pp_title', '$pp_author', '$grp_id', '$uploadPath')";
          if (mysqli_query($dbcon, $sql)) {
              echo "Sussessfully inserted into database";
          } else {
              echo "Error, could not insert into database";
          }
      }
    }
    else{
      echo "Maximum upload file size limit is 200 kb";
    }
  }
  else{
    echo "You can only upload a Word doc file.";
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students' Dashboard - resshare</title>
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
            <h3 class="text-info">Upload a Research Paper</h3>
            <hr>

            <?php
            if ($_SESSION['grp_id'] == FALSE) {
                echo "You have not been assigned a group. Wait for your Lecturer to allocate you.";

            } else {


            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">


                <p>Paper title: <input type="text" name="pp_title" required class="form-control"></p>
                <p>First author: <input type="text" name="pp_author" required class="form-control"></p>
                <a>Select research paper from your computer. Please note: file must be .doc, .docx, .pdf</a>
                <p><input type="file" name="paper" id=""></p>

                <p><button type="submit" name="submit" class="btn btn-info form-control">Submit Research Paper</button></p>

            </form>
                <?php
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