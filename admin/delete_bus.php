<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php'; 
$bus_id=intval($_GET['bus_id']); 
$conn->query("DELETE FROM buses WHERE bus_id=$bus_id"); 
header('Location: admin_dashboard.php'); exit; ?>