<?php
include 'connect_db.php'; 

$sql = "SELECT name, address, date, time, venue, description FROM events";
$result = mysqli_query($conn, $sql);

$events = [];

while ($row = mysqli_fetch_assoc($result)) {
    $events[$row['name']] = [
        'address' => $row['address'],
        'date' => $row['date'],
        'time' => $row['time'],
        'venue' => $row['venue'],
        'description' => $row['description']
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>
