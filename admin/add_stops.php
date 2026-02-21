<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php'; 
$trip_id=intval($_GET['trip_id']); 
$trip=$conn->query("SELECT * FROM trips WHERE trip_id=$trip_id")->fetch_assoc(); 
if(!$trip){ echo 'Trip not found'; exit; } 
if(isset($_POST['save_stops'])){ $names=$_POST['stop_name']; 
$times=$_POST['arrival_time']; 
$conn->query("DELETE FROM trip_stops WHERE trip_id=$trip_id"); 
for($i=0;$i<count($names);$i++){ $n=$conn->real_escape_string($names[$i]);
$t=$conn->real_escape_string($times[$i]);
$ord=$i+1; 
$conn->query("INSERT INTO trip_stops (trip_id,stop_order,stop_name,arrival_time) VALUES($trip_id,$ord,'$n','$t')");
 } 

header('Location: edit_trip.php?trip_id='.$trip_id) ;
 exit; } ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Add Stops</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
        </head>
        <body>
            <div class='wrap'>
                <h2>Add Stops for <?php echo htmlspecialchars($trip['trip_name']); ?></h2>
                <form method='post'>
                    <div id='stops'>
                        <?php for($i=0;$i<3;$i++): ?>
                            <div class='stop-row'>
                                <input name='stop_name[]' placeholder='Stop name' required>
                                <input name='arrival_time[]' type='time' required>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <p><button type='button' id='addRow'>Add + </button></p>
                    <button name='save_stops'>Save Stops</button>
                </form>
                <p><a class="btn" href='trips.php'>Back</a></p>
            </div>
<script>
document.getElementById('addRow').addEventListener('click',function(){var div=document.createElement('div');
div.className='stop-row';
div.innerHTML="<input name='stop_name[]' placeholder='Stop name' required> <input name='arrival_time[]' type='time' required>";
document.getElementById('stops').appendChild(div);
});
</script>
</body>
</html>