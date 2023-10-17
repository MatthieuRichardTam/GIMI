<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hi";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, fullname, room, alarm_time, severity FROM alarmes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
?>
<div class="alarm">
    <div class="severity <?php echo $row['severity']; ?>"></div>
    <div class="details">
        <h2><?php echo $row['fullname']; ?></h2>
        <p>Chambre: <?php echo $row['room']; ?></p>
        <p>Temps restant avant l'alarme: <?php echo $row['alarm_time']; ?></p>
    </div>
</div>
<?php
  }
} else {
  echo "Aucune alarme à afficher";
}
$conn->close();
?>
