<?php
//Establishing connection with the database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'deepcryp');
define('DB_PASSWORD', 'deep1997');
define('DB_DATABASE', 'stdntmngmnt'); //where customers is the database
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
