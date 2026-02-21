<?php
// config.php - update DB credentials if needed
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'bus_db';
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) { die('DB conn error: ' . $conn->connect_error); }
date_default_timezone_set('Asia/Kolkata');
?>