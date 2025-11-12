<?php
session_start();
include 'connect_db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$event = $_POST['event'] ?? '';
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';

$event_id = null;
$stmt = $conn->prepare("SELECT id FROM events WHERE LOWER(TRIM(name)) = LOWER(TRIM(?))");
$stmt->bind_param("s", $event);
$stmt->execute();
$stmt->bind_result($event_id);
$stmt->fetch();
$stmt->close();

if (!$event_id) {
    echo json_encode(["status" => "error", "message" => "Event not found"]);
    exit;
}

$insert = $conn->prepare("INSERT INTO bookings (user_id, event_id, booked_at) VALUES (?, ?, NOW())");
if (!$insert) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: ".$conn->error]);
    exit;
}

$insert->bind_param("ii", $user_id, $event_id);
if ($insert->execute()) {
    echo json_encode(["status" => "success", "message" => "Booking saved"]);
} else {
    echo json_encode(["status" => "error", "message" => $insert->error]);
}
$insert->close();
$conn->close();
