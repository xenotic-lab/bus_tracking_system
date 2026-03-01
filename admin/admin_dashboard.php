<?php session_start(); 
if(!isset($_SESSION['admin'])) header('Location: index.php');
include '../config.php'; 
$buses=$conn->query('SELECT * FROM buses'); 
$trips=$conn->query('SELECT t.*, b.bus_name FROM trips t LEFT JOIN buses b ON t.bus_id=b.bus_id'); 
?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Dashboard</title>
        <link rel='stylesheet' href='../assets/style.css?v=<?php echo time();?>'>
       
    </head>
    <body>
        <div class='wrap'>
            <header>
                <h1>Bus_tracking_system - Admin</h1>
                <div class='header-actions'>
                    <a class='btn' href='add_bus.php'>Add Bus</a>
                    <a class='btn' href='report.php'>Report</a>
                    <a class='btn btn-ghost' href='logout.php'>Logout</a>
                </div></header>
                <section class='card'>
                    <h3>All Buses</h3>
                    <table>
                        <tr>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Action</th>
                        </tr>
                         <?php $sn=1?>
                        <?php while($b=$buses->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php echo $sn++?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($b['bus_name']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($b['bus_number']); ?>
                            </td>
                            <td>
                            <a href='edit_bus.php?bus_id=<?php echo $b['bus_id']; ?>'>Edit</a> | 
                            <a href='delete_bus.php?bus_id=<?php echo $b['bus_id']; ?>' onclick='return confirm("Delete?")'>Delete</a> |
                            <a href='trips.php?bus_id=<?php echo $b['bus_id'];?>'>Trips</a>


                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </section>
               
        </div>
    </body>
    </html>