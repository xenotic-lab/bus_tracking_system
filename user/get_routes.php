<?php
include 'db.php';
$q = $_GET['q'];
$sql = "SELECT DISTINCT route FROM trips WHERE route LIKE '%$q%'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    echo "<option value='".$row['route']."'>";
}
?>
