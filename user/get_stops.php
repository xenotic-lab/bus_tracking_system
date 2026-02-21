<?php
include 'db.php';
$route = $_GET['route'];
$sql = "SELECT DISTINCT trip_stops.stop_name 
        FROM trip_stops
        JOIN trips ON trip_stops.trip_id = trips.trip_id
        WHERE trips.route = '$route'
        ORDER BY trip_stops.stop_order ASC";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    echo "<option value='".$row['stop_name']."'>";
}
?>
