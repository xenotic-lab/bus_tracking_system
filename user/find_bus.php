<?php
include 'db.php';

$route = $_POST['route'];
$stop = $_POST['stop'];
$time = $_POST['time'];

$sql = "SELECT buses.bus_name, buses.bus_number, trips.trip_name, trip_stops.arrival_time
        FROM trips
        JOIN buses ON trips.bus_id = buses.bus_id
        JOIN trip_stops ON trips.trip_id = trip_stops.trip_id
        WHERE trips.route = '$route'
        AND trip_stops.stop_name = '$stop'
        AND trip_stops.arrival_time >= '$time'
        ORDER BY trip_stops.arrival_time ASC
        LIMIT 1";
        

$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $arrival_timestamp = strtotime($row['arrival_time']);
$arrival_12hr = date("g:i A", $arrival_timestamp);
$arrival_24hr = date("H:i:s", $arrival_timestamp);

echo "<div class='result-card'>
        <h2> Bus Detail :</h2>
        <p><strong>Bus:</strong> ".$row['bus_name']." (".$row['bus_number'].")</p>
        <p><strong>Trip:</strong> ".$row['trip_name']."</p>
        <p><strong>Arrival Time:</strong> ".$arrival_12hr."</p>
        <br>
        <h3>now :</h3>
         <p><strong>Status:</strong> <span id='status'>Waiting...</span></p>

        <p><strong>ETA:</strong> <span id='eta'>Calculating...</span></p>
       
        <span id='arrival_time' data-time='".$arrival_24hr."' style='display:none;'></span>
      </div>";
} else {
    echo "<div class='error'>
            <h3>No Upcoming Bus Found</h3>
            <p>No buses are available for this route at this time.</p>
          </div>";
}

?>
