<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', ''); //remember to place the db username
define('DB_PASSWORD', ''); //remember to place the db password
define('DB_DATABASE', 'resshare_db');

$dbcon = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
