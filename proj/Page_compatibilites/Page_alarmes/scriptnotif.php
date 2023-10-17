<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hi";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, fullname, room, alarm_time FROM alarmes WHERE alarm_time <= 180";
$result = $conn->query($sql);
$notifications = array();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $notifications[] = array(
      'fullname' => $row['fullname'],
      'room' => $row['room'],
      'remaining_time' => $row['alarm_time'],
    );
  }
}

echo json_encode($notifications);

$conn->close();
?>
