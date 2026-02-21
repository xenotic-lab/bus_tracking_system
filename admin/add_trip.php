<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php';
 $bus_id=$_SESSION['bus_id']; 
 $buses=$conn->query('SELECT * FROM buses'); 
 if(isset($_POST['create'])){ 
    $trip_name=$conn->real_escape_string($_POST['trip_name']);
    $route=$conn->real_escape_string($_POST['route']);
    $start=$_POST['start_time'];
    $end=$_POST['end_time'];
    $conn->query("INSERT INTO trips (bus_id,trip_name,route,start_time,end_time,day,status) VALUES($bus_id,'$trip_name','$route','$start','$end',CURDATE(),'upcoming')"); 
    $trip_id=$conn->insert_id; 
    header('Location: add_stops.php?trip_id='.$trip_id); exit; } ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Add Trip</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
    </head>
    <body>
        <div class='center-card'>
            <h2>Create Trip</h2>
            <form method='post'>
                
                <input name='trip_name' placeholder='Trip name' required>
                <input name='route' placeholder='Route : Start-End' required>
                <p>Start Time:</p>
                <input type='time' name='start_time' required>
                <p>End Time:</p>
                <input type='time' name='end_time' required>
                <button name='create'>Create Trip</button>
            </form>
            <p><a class="btn" href='trips.php'>Back</a></p>
        </div>
    </body>
</html>