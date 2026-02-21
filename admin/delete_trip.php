<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php'; 
$trip_id=intval($_GET['trip_id']); 
$conn->query("DELETE FROM trips WHERE trip_id=$trip_id"); 
header('Location: trips.php'); exit; ?>