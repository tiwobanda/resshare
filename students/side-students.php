
<!--            <h3 class="text-info">Dashboard</h3>-->
<?php

if ($_SESSION['grp_id'] == TRUE) {

?>
            <div class="card">
                <div class="card-header bg-info"><h5>Details</h5></div>
                <div class="card-body">
                <p>Name: <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']?></p>

<p>Group: <?php echo $_SESSION['grp_name'] ?></p>
</div>
</div>
    <?php
}
    ?>
<br>
<?php
if(isset($_SESSION['group_leader'])){

    ?>
    <!-- load leader panel -->

    <div class="card">
        <div class="card-header bg-info"><h5>Operations</h5></div>
        <div class="card-body">

            <p><a href="mygroup.php">My Group</a></p>
            <p><a href="allocate.php">Allocate Papers</a></p>
            <p><a href="upload.php">Upload Paper</a></p>
            <p><a href="papers.php">My Papers</a></p>


        </div>
    </div>

    <!--end of leader panel -->


    <?php
}else{


    ?>
    <!--load general student panel -->
    <div class="card">
        <div class="card-header bg-info"><h5>Operations</h5></div>
        <div class="card-body">
            <p><a href="mygroup.php">My Group</a></p>
            <p><a href="upload.php">Upload Paper</a></p>
            <p><a href="papers.php">My Papers</a></p>
        </div>

    </div>
    <!--end of general student panel -->
    <?php
}
?>