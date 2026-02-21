<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php'; 
$stop_id=intval($_GET['stop_id']); 
$trip_id=intval($_GET['trip_id']); 
$conn->query("DELETE FROM trip_stops WHERE stop_id=$stop_id"); 
header('Location: edit_trip.php?trip_id='.$trip_id); exit; ?>