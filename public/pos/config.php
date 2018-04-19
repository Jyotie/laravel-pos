<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/

define('DB_HOST', 'localhost');
define('DB_NAME', 'hazipipe_pos_db');
define('DB_USERNAME','hazipipe_posuser');
define('DB_PASSWORD','haji2031');
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset( $con, 'utf8');
if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();