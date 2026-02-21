<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php'; 
$stop_id=intval($_GET['stop_id']); 
$stop=$conn->query("SELECT * FROM trip_stops WHERE stop_id=$stop_id")->fetch_assoc(); 
if(!$stop){ echo 'Stop not found'; exit; } 
if(isset($_POST['save'])){ $name=$conn->real_escape_string($_POST['stop_name']); 
$time=$conn->real_escape_string($_POST['arrival_time']); 
$conn->query("UPDATE trip_stops SET stop_name='$name', arrival_time='$time' WHERE stop_id=$stop_id"); 
header('Location: edit_trip.php?trip_id=' . intval($_POST['trip_id'])); exit; } ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Edit Stop</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
    </head>
    <body>
        <div class='center-card'>
            <h2>Edit Stop</h2>
            <form method='post'>
                <input name='stop_name' value='<?php echo htmlspecialchars($stop['stop_name']); ?>' required>
                <input name='arrival_time' type='time' value='<?php echo $stop['arrival_time']; ?>' required>
                <input type='hidden' name='trip_id' value='<?php echo $stop['trip_id']; ?>'>
                <button name='save'>Save</button>
            </form>
            <p><a class="btn" href='edit_trip.php?trip_id=<?php echo $stop['trip_id']; ?>'>Back</a></p>
        </div>
    </body>
</html>