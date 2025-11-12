<?php
session_start();
// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'connect_db.php'; // Your DB connection file (assuming $conn is the MySQLi connection object)

// Fetch user's bookings with event details using MySQLi
$user_id = $_SESSION['user_id'];
$query = "
    SELECT e.name, e.date, e.time, e.venue, e.description, b.booked_at
    FROM bookings b
    JOIN events e ON b.event_id = e.id
    WHERE b.user_id = ?
    ORDER BY b.booked_at DESC
";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id); // "i" for integer
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - JK Events</title>
    <link rel="stylesheet" href="./style.css"> <!-- Reuse your existing CSS -->
        <style>
/* === VIEW BOOKINGS PAGE STYLING WITH LIQUID GLASS === */

/* Page background */
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
    background: url('images/211c977c-d967-41af-b3a0-28053de5d26f.jpg') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Frosted-glass wrapper */
.bookings-container {
    max-width: 1000px;
    margin: 6vh auto;
    padding: 3rem;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1.5px solid rgba(255, 255, 255, 0.25);
    border-radius: 25px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
}

/* Headings */
.bookings-container h2 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #ffffff;
    text-shadow: 0 0 15px rgba(0,0,0,0.5);
}

.bookings-container hr {
    border: none;
    height: 2px;
    background: linear-gradient(to right, #5b70ff, #42d6a4);
    margin-bottom: 2rem;
}

/* Each booking card (frosted mini-panel) */
.booking-card {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.booking-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.5);
}

/* Event image */
.booking-card img {
    width: 180px;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid rgba(255,255,255,0.5);
}

/* Text info */
.booking-info {
    flex: 1;
}

.booking-info h4 {
    font-size: 1.6rem;
    color: #fff;
    margin-bottom: 0.5rem;
    text-shadow: 0 0 10px rgba(0,0,0,0.4);
}

.booking-info p {
    font-size: 1rem;
    color: #f3f3f3;
    margin: 0.3rem 0;
}

.booked-at {
    font-size: 0.9rem;
    color: #ccc;
    margin-top: 0.5rem;
    font-style: italic;
}

/* Empty state */
.no-bookings {
    text-align: center;
    padding: 3rem;
    font-size: 1.2rem;
    color: #eaeaea;
}

/* Footer matches site look */
footer {
    background: rgba(0, 0, 60, 0.85);
    backdrop-filter: blur(10px);
    color: white;
    padding: 20px;
    margin-top: auto;
}

footer a {
    color: #a2c8ff;
    text-decoration: none;
}

footer a:hover {
    text-decoration: underline;
}

.bookings-container
{
    margin-top: 75px;
}
</style>
</head>
<body>
    <?php include 'navbar.php'; ?> <!-- Include your updated navbar -->
    
    <!-- Wrap main content in .content for flexbox (pushes footer to bottom) -->
    <div class="content">
        <div class="bookings-container">
            <h2>Your Bookings</h2>
            <hr>

            <?php if (empty($bookings)): ?>
                <div class="no-bookings">
                    <p>You haven't booked any events yet. <a href="event.php">Browse events</a> to get started!</p>
                </div>
            <?php else: ?>
                <?php foreach ($bookings as $booking): ?>
                    <div class="booking-card">
                        <img src="./images/event_placeholder.jpg" alt="Event Image"> <!-- Placeholder; replace with dynamic image if available -->
                        <div class="booking-info">
                            <h4><?php echo htmlspecialchars($booking['name']); ?></h4>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($booking['date']); ?></p>
                            <p><strong>Time:</strong> <?php echo htmlspecialchars($booking['time']); ?></p>
                            <p><strong>Venue:</strong> <?php echo htmlspecialchars($booking['venue']); ?></p>
                            <p><?php echo htmlspecialchars($booking['description']); ?></p>
                            <p class="booked-at">Booked on: <?php echo date('F j, Y, g:i a', strtotime($booking['booked_at'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer - now sticks to bottom -->
    <footer>
        <!-- Copy your footer from home.php here -->
        <div class="top">
            <div class="links">
                <h5>Useful Links:</h5>
                <a href="../About/about.html">About Us</a>
                <a href="#">Events</a>
                <a href="#">Contact Us</a>
            </div>
            <div class="reach">
                <h5>More About Us:</h5>
                <a href="https://github.com/Koushik-Sharma" target="_blank">GitHub</a>
                <a href="johnpaulfernandes18@gmail.com" target="_blank">Gmail</a>
            </div>
        </div>
        <div class="copyright">
            <h5>&copy; 2025 JK Events Goa. All Rights Reserved</h5>
        </div>
    </footer>

    <script src="./index.js"></script> <!-- Reuse your JS if needed -->
</body>
</html>