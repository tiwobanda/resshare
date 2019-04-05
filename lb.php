<?php
#LoginBridge
require_once 'scripts/db.php';

if ($dbcon === false) {
    die("Error: Could not connect to database" . mysqli_connect_error());
}

    $query = "SELECT ";