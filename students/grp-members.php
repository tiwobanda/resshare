<?php
    echo "<div id='demobox'>";
    echo "<h6>Group Members </h6>";
$grp_id = $_SESSION['grp_id'];

$query = "SELECT fname, lname, student_role 
            FROM students  
            WHERE grp_id = '$grp_id'
            ORDER BY student_role DESC";

$result = mysqli_query($dbcon, $query);

if (mysqli_num_rows($result) > 0) {

    echo "<ul>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<li>" .  $row['fname'] . " " . $row['lname']." " . $row['student_role'] . "</li>";
    }
    echo "</ul>";
}else {
    echo "No members have been added to this group yet" ;
}
    echo "</div>";
?>

