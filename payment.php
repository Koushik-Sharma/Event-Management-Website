<?php
session_start();
include 'navbar.php';
include 'connect_db.php'; // defines $conn = new mysqli(...)

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to continue.'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Get event data from either GET or POST
$event = $_GET['event'] ?? $_POST['event'] ?? 'Unknown Event';
$name = $_GET['name'] ?? $_POST['name'] ?? 'Guest';
$price = $_GET['price'] ?? $_POST['price'] ?? '₹500';

// Clean inputs
$event = htmlspecialchars(trim($event));
$name = htmlspecialchars(trim($name));
$price = htmlspecialchars(trim($price));

// ✅ Check DB connection
if ($conn->connect_error) {
    die("<h3 style='color:red;'>❌ Connection failed: " . $conn->connect_error . "</h3>");
}

// ✅ Fetch event ID from DB
$event_id = null;
$stmt = $conn->prepare("SELECT id FROM events WHERE LOWER(TRIM(name)) = LOWER(TRIM(?)) LIMIT 1");
$stmt->bind_param("s", $event);
$stmt->execute();
$stmt->bind_result($event_id);
$stmt->fetch();
$stmt->close();

// For debugging
echo "<!-- DEBUG: Event='$event' | EventID='$event_id' | UserID='$user_id' -->";

// ✅ Handle Payment Submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = trim($_POST['card-number'] ?? '');
    $expiry = trim($_POST['expiry'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');
    $nameOnCard = trim($_POST['name-on-card'] ?? '');

    if ($cardNumber && $expiry && $cvv && $nameOnCard) {
        if ($event_id) {
            $insert = $conn->prepare("INSERT INTO bookings (user_id, event_id, booked_at) VALUES (?, ?, NOW())");
            $insert->bind_param("ii", $user_id, $event_id);

            if ($insert->execute()) {
                echo "<script>console.log('✅ Booking saved successfully!');</script>";
                echo "<h3 style='color:lime;'>✅ Booking inserted successfully!</h3>";
            } else {
                echo "<h3 style='color:red;'>❌ Database Error: " . htmlspecialchars($insert->error) . "</h3>";
            }


            $insert->close();
        } else {
            echo "<h3 style='color:orange;'>⚠️ Event not found in database for '$event'.</h3>";
        }
    } else {
        echo "<h3 style='color:red;'>⚠️ Payment details incomplete.</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - JK Events</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <div class="payment-section">
        <h1>Complete Your Payment</h1>
        <p>Securely enter your payment details to confirm your booking.</p>

        <div class="booking-summary glass-effect">
            <h3>Booking Summary</h3>
            <p><strong>Event:</strong> <?php echo $event; ?></p>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Total Amount:</strong> <?php echo $price; ?></p>
        </div>

        <form class="payment-form glass-effect" id="paymentForm">
            <!-- ✅ Preserve data on POST -->
            <input type="hidden" name="event" value="<?php echo $event; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>

            <label for="expiry">Expiry Date:</label>
            <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>

            <label for="name-on-card">Name on Card:</label>
            <input type="text" id="name-on-card" name="name-on-card" placeholder="Full name on card" required>

            <button type="submit" class="pay-btn">Pay Now</button>
        </form>

        <a href="./home.php" class="home-btn">Home</a>
    </div>

    <footer>
        <div class="top">
            <div class="links">
                <h5>Useful Links:</h5>
                <a href="home.php">Home</a>
                <a href="about.php">About</a>
            </div>
            <div class="reach">
                <h5>More About Us:</h5>
                <a href="https://github.com/Koushik-Sharma" target="_blank">GitHub</a>
                <a href="mailto:johnpaulfernandes18@gmail.com">Gmail</a>
            </div>
        </div>
        <div class="copyright">
            <h5>&copy; 2025 JK Events Goa. All Rights Reserved</h5>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="./payment.js"></script>
</body>
</html>
