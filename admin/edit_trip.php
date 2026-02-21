<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php'; 
$trip_id=intval($_GET['trip_id']);
$trip=$conn->query("SELECT * FROM trips WHERE trip_id=$trip_id")->fetch_assoc(); 
if(!$trip){ echo 'Trip not found'; exit; } 
if(isset($_POST['update'])){ $name=$conn->real_escape_string($_POST['trip_name']); 
$route=$conn->real_escape_string($_POST['route']); 
$start=$_POST['start_time']; 
$end=$_POST['end_time']; 
$conn->query("UPDATE trips SET trip_name='$name', route='$route', start_time='$start', end_time='$end' WHERE trip_id=$trip_id");
 } 
$stops = $conn->query("SELECT * FROM trip_stops WHERE trip_id=$trip_id ORDER BY stop_order")->fetch_all(MYSQLI_ASSOC); ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Edit Trip</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
    </head>
    <body>
        <div class='wrap'>
            <h2>Edit Trip</h2>
            <form method='post'>
                <input name='trip_name' value='<?php echo htmlspecialchars($trip['trip_name']); ?>' required>
                <input name='route' value='<?php echo htmlspecialchars($trip['route']); ?>' required>
                <label>Start Time</label>
                <input type='time' name='start_time' value='<?php echo $trip['start_time']; ?>' required>
                <label>End Time</label>
                <input type='time' name='end_time' value='<?php echo $trip['end_time']; ?>' required>
                <button name='update'>Update Trip</button>
            </form>
            <h3>Stops</h3>
            
              
            <table>
                <tr>
                    <th>Order</th>
                    <th>Stop</th>
                    <th>Arrival</th>
                    <th>Action</th>
                </tr>
                <?php foreach($stops as $s): ?>
                    <tr>
                        <td>
                            <?php echo $s['stop_order']; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($s['stop_name']); ?>
                        </td>
                        <td>
                            <?php echo $s['arrival_time']; ?>
                        </td>
                        <td>
                            <a href='edit_stop.php?stop_id=<?php echo $s['stop_id']; ?>'>Edit</a> | <a href='delete_stop.php?stop_id=<?php echo $s['stop_id']; ?>&trip_id=<?php echo $trip_id; ?>' onclick='return confirm("Delete?")'>Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
              
            </table>
                
              
                <p><a class="btn" href="add_stops.php?trip_id=<?php echo $trip_id;?>"> Recreate</a>
                <a class="btn" href='trips.php'>Done</a></p>
        </div>
    </body>
</html>