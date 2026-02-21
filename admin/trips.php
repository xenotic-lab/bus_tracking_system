<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php'); 
if(isset($_GET['bus_id'])){
    $_SESSION['bus_id']=intval($_GET['bus_id']); 
}

include '../config.php';
$bus_id=$_SESSION['bus_id'];
$bus_name=$conn->query("SELECT bus_name FROM buses WHERE bus_id=$bus_id" )->fetch_assoc() ['bus_name'];
$bus_no=$conn->query("SELECT bus_number FROM buses WHERE bus_id=$bus_id" )->fetch_assoc() ['bus_number'];
$trips=$conn->query("SELECT * FROM trips WHERE bus_id=$bus_id");  ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Bus Trips</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
    </head>
    <body>
        <header>
                
                <div class='header-actions'>
                     <h2>Bus Name: <?php echo htmlspecialchars($bus_name );?> </h2>
        <h2>Bus Number: <?php echo htmlspecialchars($bus_no );?> </h2>
                
                   
                </div></header>
        <section class='card'>
       
        <h3> Trips</h3> 
        <table>
                        <tr>
                            <th>S.no</th>
                            <th>Trip Name</th>
                            <th>Route</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Action</th>
                        </tr>
            
            <?php $tn=1?>
           <?php while($t=$trips->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php echo $tn++?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($t['trip_name']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($t['route']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($t['start_time']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($t['end_time']); ?>
                            </td>
                             <td>
                                <a href='edit_trip.php?trip_id=<?php echo $t['trip_id']; ?>'>Edit </a> | 
                                <a href='delete_trip.php?trip_id=<?php echo $t['trip_id']; ?>' onclick='return confirm("Delete?")'>Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
           
           </table>
           
           </section>
              <a class='btn' href='add_trip.php?bus_id=<?php echo $bus_id ?>'>Add Trip</a> 
              
            <a class="btn" href='admin_dashboard.php'>Done</a>
            
    </body>
</html>