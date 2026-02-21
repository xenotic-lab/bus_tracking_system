<?php session_start();
 if(!isset($_SESSION['admin'])) header('Location: index.php'); 
 include '../config.php'; 
 if(isset($_POST['save'])){ $n=$conn->real_escape_string($_POST['bus_name']); 
 $num=$conn->real_escape_string($_POST['bus_number']); 
 $conn->query("INSERT INTO buses (bus_name,bus_number) VALUES('$n','$num')"); 
 header('Location: admin_dashboard.php'); exit; } ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Add Bus</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
    </head>
    <body>
        <div class='center-card'>
            <h2>Add Bus</h2>
            <form method='post'>
                <input name='bus_name' placeholder='Bus Name' required>
                <input name='bus_number' placeholder='Bus Number' required>
                <button name='save'>Save</button>
            </form>
            <p><a class="btn" href='admin_dashboard.php'>Back</a></p>
        </div>
    </body>
</html>