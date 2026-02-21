<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
include '../config.php';
$bus_id=intval($_GET['bus_id']); 
$bus=$conn->query("SELECT * FROM buses WHERE bus_id=$bus_id")->fetch_assoc(); 
if(isset($_POST['update'])){ $n=$conn->real_escape_string($_POST['bus_name']); 
$num=$conn->real_escape_string($_POST['bus_number']); 
$conn->query("UPDATE buses SET bus_name='$n', bus_number='$num' WHERE bus_id=$bus_id"); 
header('Location: admin_dashboard.php'); exit; } ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Edit Bus</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
    </head>
    <body>
        <div class='center-card'>
            <h2>Edit Bus</h2>
            <form method='post'>
                <input name='bus_name' value='<?php echo htmlspecialchars($bus['bus_name']); ?>' required>
                <input name='bus_number' value='<?php echo htmlspecialchars($bus['bus_number']); ?>' required>
                <button name='update'>Update</button>
            </form>
            <p><a class="btn" href='admin_dashboard.php'>Back</a></p>
        </div>
    </body>
</html>